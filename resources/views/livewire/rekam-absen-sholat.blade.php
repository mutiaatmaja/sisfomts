<div x-data x-init="$nextTick(() => $refs.nisn.focus());
$watch('$wire.nisn', () => $nextTick(() => $refs.nisn.focus()));" @click.window="if ($event.target !== $refs.nisn) $nextTick(() => $refs.nisn.focus())">
    {{-- Status jadwal sholat aktif --}}
    @if ($sholatAktif)
        <div class="alert alert-light-success border border-success d-flex align-items-center gap-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
            </svg>
            <div>
                Jadwal aktif:
                <strong>Sholat {{ $sholatAktif->nama_sholat }}</strong>
                &mdash;
                {{ \Carbon\Carbon::parse($sholatAktif->jam_mulai)->format('H:i') }}
                s/d
                {{ \Carbon\Carbon::parse($sholatAktif->jam_selesai)->format('H:i') }}
            </div>
        </div>
    @else
        <div class="alert alert-light-warning border border-warning mb-3">
            Tidak ada jadwal sholat aktif saat ini. Absen tidak dapat direkam.
        </div>
    @endif

    {{-- Input NISN --}}
    <label for="nisn" class="form-label">Scan / Masukkan NISN</label>
    <div class="input-group mb-3">
        <input wire:model.live="nisn" wire:keydown.enter.prevent="cekNisn" wire:loading.attr="disabled"
            wire:target="cekNisn" x-ref="nisn" type="text" id="nisn" class="form-control"
            placeholder="Scan barcode atau ketik NISN, tekan Enter" autocomplete="off"
            {{ $sholatAktif ? '' : 'disabled' }}>
        <span class="input-group-text">
            {{-- spinner --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-loader spin" wire:loading wire:target="cekNisn">
                <line x1="12" y1="2" x2="12" y2="6" />
                <line x1="12" y1="18" x2="12" y2="22" />
                <line x1="4.93" y1="4.93" x2="7.76" y2="7.76" />
                <line x1="16.24" y1="16.24" x2="19.07" y2="19.07" />
                <line x1="2" y1="12" x2="6" y2="12" />
                <line x1="18" y1="12" x2="22" y2="12" />
                <line x1="4.93" y1="19.07" x2="7.76" y2="16.24" />
                <line x1="16.24" y1="7.76" x2="19.07" y2="4.93" />
            </svg>
            {{-- search icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                wire:loading.remove wire:target="cekNisn">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
        </span>
    </div>

    {{-- Pesan hasil --}}
    @if ($pesan)
        <div class="alert {{ $pesanError ? 'alert-danger' : 'alert-success' }} mb-3">
            {{ $pesan }}
        </div>
    @endif

    {{-- Tabel riwayat absen sholat hari ini --}}
    <div style="position: relative;">
        <div wire:loading.flex wire:target="cekNisn"
            style="position:absolute;top:0;left:0;right:0;bottom:0;background:rgba(255,255,255,.6);z-index:10;align-items:center;justify-content:center;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <h6 class="mb-2">Riwayat Absen Sholat Hari Ini</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Sholat</th>
                        <th>Jam Absen</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayat as $i => $absen)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $absen->pesertaDidik->user->name ?? '-' }}</td>
                            <td>{{ $absen->pesertaDidik->nisn ?? '-' }}</td>
                            <td>{{ $absen->nama_sholat }}</td>
                            <td>{{ \Carbon\Carbon::parse($absen->jam_absen)->format('H:i') }}</td>
                            <td>
                                <span class="badge badge-light-success">Hadir</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada absen sholat hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
