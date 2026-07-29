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
        DB::beginTransaction();

        try {
            // Preload semua data yang mungkin digunakan
            $emails = $rows->pluck('email')->unique()->filter()->all();
            $existingUsers = User::whereIn('email', $emails)->get()->keyBy('email');

            $kelasList = Kelas::all()->keyBy('nama_kelas');

            foreach ($rows as $index => $row) {
                $rowNumber = $index + 2; // heading row + 1
                $rowArray = $row->toArray();

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
                $user = $existingUsers[$email] ?? new User(['email' => $email]);
                $isNewUser = !$user->exists;

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
                $user->syncRoles(['siswa']);

                if ($isNewUser) {
                    $this->summary['created_users']++;
                } else {
                    $this->summary['updated_users']++;
                }

                // SISWA
                $siswa = Siswa::firstOrNew(['user_id' => $user->id]);
                if (!$siswa->exists) {
                    $siswa->uuid = (string) Str::uuid();
                }

                $siswa->fill([
                    'nisn' => $row['nisn'] ?? null,
                    'nis' => $row['nis'] ?? null,
                    'nis_lokal' => $row['nis_lokal'] ?? null,
                    'status' => strtoupper((string) ($row['nama_kelas'] ?? '')) === 'LULUS' ? 'LULUS' : 'aktif'
                ]);
                $siswa->save();

                // ANGGOTA ROMBEL
                $namaKelas = $row['nama_kelas'] ?? null;
                $kelas = $kelasList[$namaKelas] ?? null;

                if ($kelas) {
                    $sudahTerdaftar = AnggotaRombel::where('peserta_didik_id', $siswa->id)
                        ->where('kelas_id', $kelas->id)
                        ->exists();

                    if (!$sudahTerdaftar) {
                        AnggotaRombel::create([
                            'peserta_didik_id' => $siswa->id,
                            'kelas_id' => $kelas->id,
                        ]);
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
            throw $e;
        }
    }

    public function chunkSize(): int
    {
        return 300; // Boleh sesuaikan
    }
}
