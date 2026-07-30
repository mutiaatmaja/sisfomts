<?php

namespace App\Imports\Admin;

use App\Models\User;
use App\Models\PesertaDidik as Siswa;
use App\Models\Kelas;
use App\Models\AnggotaRombel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public array $summary = [
        'total_rows' => 0,
        'processed' => 0,
        'created_users' => 0,
        'updated_users' => 0,
        'failed' => 0,
        'errors' => [],
    ];

    private const REQUIRED_FIELDS = ['email', 'nama', 'password'];

    public function collection(Collection $rows)
    {
        $this->summary['total_rows'] += $rows->count();
        if ($rows->isEmpty()) {
            return;
        }

        $rows = $rows->map(function ($row) {
            return collect($row)->map(function ($value) {
                return is_string($value) ? trim($value) : $value;
            })->toArray();
        });

        $emails = $rows->pluck('email')
            ->filter()
            ->map(fn ($email) => trim((string) $email))
            ->unique()
            ->values();

        $kelasList = DB::table('kelas')->get()->keyBy('nama_kelas');
        $roleIdSiswa = DB::table('roles')->where('name', 'siswa')->value('id');

        $usersByEmail = DB::table('users')
            ->whereIn('email', $emails)
            ->get()
            ->keyBy('email');

        $existingUserIds = $usersByEmail->pluck('id')->all();

        $siswaByUserId = DB::table('peserta_didiks')
            ->whereIn('user_id', $existingUserIds)
            ->get()
            ->keyBy('user_id');

        $kelasIds = $kelasList->pluck('id')->all();
        $existingAnggota = DB::table('anggota_rombels')
            ->whereIn('kelas_id', $kelasIds)
            ->get()
            ->keyBy(function ($item) {
                return $item->peserta_didik_id . '-' . $item->kelas_id;
            });

        DB::beginTransaction();

        try {
            foreach ($rows as $index => $row) {
                $rowNumber = $index + 2; // heading row + 1
                $rowArray = $row;

                $validator = Validator::make($rowArray, [
                    'email' => 'required|email',
                    'nama' => 'required|string|max:255',
                    'password' => 'required|string|min:6',
                    'jenis_kelamin' => 'nullable|in:L,P',
                    'tanggal_lahir' => 'nullable|date',
                ]);

                // Pastikan kolom wajib benar-benar ada di heading file import.
                foreach (self::REQUIRED_FIELDS as $field) {
                    if (!array_key_exists($field, $rowArray)) {
                        $validator->errors()->add($field, "Kolom {$field} tidak ditemukan di file import.");
                    }
                }

                if ($validator->fails()) {
                    $this->summary['failed']++;
                    $this->summary['errors'][] = [
                        'row' => $rowNumber,
                        'email' => $rowArray['email'] ?? '-',
                        'message' => implode('; ', $validator->errors()->all()),
                    ];
                    continue;
                }

                $email = trim((string) ($row['email'] ?? ''));
                if (!$email) {
                    $this->summary['failed']++;
                    $this->summary['errors'][] = [
                        'row' => $rowNumber,
                        'email' => '-',
                        'message' => 'Email kosong.',
                    ];
                    continue;
                }

                // USER
                $userRecord = $usersByEmail->get($email);
                $user = $userRecord ? $this->hydrateUser($userRecord) : new User(['email' => $email]);
                $isNewUser = !$userRecord;

                if ($isNewUser) {
                    $user->uuid = (string) Str::uuid();
                }

                $alamat = preg_replace("/\r\n|\r|\n/", ', ', (string) ($row['alamat'] ?? ''));

                // Untuk user existing: password hanya diubah jika diisi dan belum berupa hash bcrypt.
                $passwordInput = (string) ($row['password'] ?? '');
                $passwordToStore = $user->password;
                if ($passwordInput !== '') {
                    $passwordToStore = Str::startsWith($passwordInput, '$2y$')
                        ? $passwordInput
                        : Hash::make($passwordInput);
                }

                $user->fill([
                    'name' => $row['nama'],
                    'password' => $passwordToStore,
                    'nik' => $row['nik'] ?? null,
                    'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
                    'no_hp' => $row['no_hp'] ?? null,
                    'alamat' => $alamat,
                    'tempat_lahir' => $row['tempat_lahir'] ?? null,
                    'tanggal_lahir' => $row['tanggal_lahir'] ?? null,
                ]);
                $user->save();

                $usersByEmail->put($email, (object) [
                    'id' => $user->id,
                    'email' => $user->email,
                ]);

                if ($roleIdSiswa) {
                    DB::table('role_user')->insertOrIgnore([
                        'role_id' => $roleIdSiswa,
                        'user_id' => $user->id,
                        'user_type' => User::class,
                    ]);
                }

                if ($isNewUser) {
                    $this->summary['created_users']++;
                } else {
                    $this->summary['updated_users']++;
                }

                // SISWA
                $siswaRecord = $siswaByUserId->get($user->id);
                $siswa = $siswaRecord ? $this->hydrateSiswa($siswaRecord) : new Siswa(['user_id' => $user->id]);
                if (!$siswaRecord) {
                    $siswa->uuid = (string) Str::uuid();
                }

                $siswa->fill([
                    'nisn' => $row['nisn'] ?? null,
                    'nis' => $row['nis'] ?? null,
                    'nis_lokal' => $row['nis_lokal'] ?? null,
                    'status' => strtoupper((string) ($row['nama_kelas'] ?? '')) === 'LULUS' ? 'LULUS' : 'aktif'
                ]);
                $siswa->save();

                $siswaByUserId->put($user->id, (object) [
                    'id' => $siswa->id,
                    'user_id' => $siswa->user_id,
                ]);

                // ANGGOTA ROMBEL
                $namaKelas = $row['nama_kelas'] ?? null;
                $kelas = $kelasList[$namaKelas] ?? null;

                if ($kelas) {
                    $anggotaKey = $siswa->id . '-' . $kelas->id;
                    $sudahTerdaftar = $existingAnggota->has($anggotaKey);

                    if (!$sudahTerdaftar) {
                        AnggotaRombel::create([
                            'peserta_didik_id' => $siswa->id,
                            'kelas_id' => $kelas->id,
                        ]);

                        $existingAnggota->put($anggotaKey, true);
                    }
                } elseif (!empty($namaKelas) && strtoupper((string) $namaKelas) !== 'LULUS') {
                    $this->summary['errors'][] = [
                        'row' => $rowNumber,
                        'email' => $email,
                        'message' => "Kelas '{$namaKelas}' tidak ditemukan. Data user/siswa tetap disimpan.",
                    ];
                }

                $this->summary['processed']++;
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            Log::error('Gagal import siswa', ['message' => $e->getMessage()]);
            throw $e;
        }
    }

    private function hydrateUser(object $record): User
    {
        $user = new User();
        $user->forceFill((array) $record);
        $user->exists = true;

        return $user;
    }

    private function hydrateSiswa(object $record): Siswa
    {
        $siswa = new Siswa();
        $siswa->forceFill((array) $record);
        $siswa->exists = true;

        return $siswa;
    }

    public function chunkSize(): int
    {
        return 300; // Boleh sesuaikan
    }
}
