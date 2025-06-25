<h1>REKAP KTP {{ $kelas }}</h1>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NISN</th>
            <th>NIK</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pesertaDidiks as $i => $siswa)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $siswa->user->name ?? '-' }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->user->nik ?? '-' }}</td>
                <td>{{ $siswa->user->jenis_kelamin ?? '-' }}</td>
                <td>{{ isset($siswa->user->tempat_lahir) ? ucwords(strtolower($siswa->user->tempat_lahir)) : '-' }}</td>
                <td>
                    @if(!empty($siswa->user->tanggal_lahir))
                        {{ \Carbon\Carbon::parse($siswa->user->tanggal_lahir)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($siswa->user->foto)
                        <img src="{{ asset('storage/' . $siswa->user->foto) }}" alt="Foto" width="70">
                    @else
                        -
                    @endif
            </tr>
        @endforeach
    </tbody>
</table>
