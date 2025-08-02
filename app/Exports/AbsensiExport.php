<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $seluruhAbsensi;
    protected $waktu;
    protected $kelasName;
    protected $customDate;

    public function __construct($seluruhAbsensi, $waktu, $kelasName, $customDate = null)
    {
        $this->seluruhAbsensi = $seluruhAbsensi;
        $this->waktu = $waktu;
        $this->kelasName = $kelasName;
        $this->customDate = $customDate;
    }

    public function collection()
    {
        return $this->seluruhAbsensi;
    }

    public function headings(): array
    {
        if (in_array($this->waktu, ['hari_ini', 'kemarin', 'custom_date'])) {
            return ['Nama', 'NIS', 'NISN', 'Kelas', 'Status', 'Waktu'];
        } else {
            return ['Nama', 'NIS', 'NISN', 'Kelas', 'Hadir', 'Sakit', 'Ijin', 'Alpa'];
        }
    }

    public function map($absen): array
    {
        if (in_array($this->waktu, ['hari_ini', 'kemarin', 'custom_date'])) {
            $absensi = $absen->pesertaDidik->absensi->first();
            $status = $absensi->status ?? '-';
            $waktu = $absensi?->tanggal ? Carbon::parse($absensi->tanggal)->format('H:i') : '-';

            if ($this->waktu === 'kemarin' || $this->waktu === 'custom_date') {
                $waktu = $absensi?->tanggal ? Carbon::parse($absensi->tanggal)->format('d/m/Y H:i') : '-';
            }

            return [
                $absen->pesertaDidik->user->name ?? '',
                $absen->pesertaDidik->nis ?? '',
                $absen->pesertaDidik->nisn ?? '',
                $absen->kelas->nama_kelas,
                $status,
                $waktu
            ];
        } else {
            $absensi = $absen->pesertaDidik->absensi;
            $hadir = $absensi->where('status', 'hadir')->count();
            $sakit = $absensi->where('status', 'sakit')->count();
            $ijin = $absensi->where('status', 'ijin')->count();
            $alpa = $absensi->where('status', 'alpha')->count();

            return [
                $absen->pesertaDidik->user->name ?? '',
                $absen->pesertaDidik->nis ?? '',
                $absen->pesertaDidik->nisn ?? '',
                $absen->kelas->nama_kelas,
                $hadir,
                $sakit,
                $ijin,
                $alpa
            ];
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Get the highest row number
                $highestRow = $event->sheet->getHighestRow();

                // Insert title rows at the top
                $event->sheet->insertNewRowBefore(1, 4);

                // Set title
                $event->sheet->setCellValue('A1', 'REKAP ABSENSI PESERTA DIDIK');
                $event->sheet->mergeCells('A1:' . $event->sheet->getHighestColumn() . '1');

                // Set class info
                $event->sheet->setCellValue('A2', 'Kelas: ' . ($this->kelasName ?? 'Tidak Diketahui'));
                $event->sheet->mergeCells('A2:' . $event->sheet->getHighestColumn() . '2');

                // Set period info
                $periodText = 'Periode: ';
                if($this->waktu == 'hari_ini') {
                    $periodText .= 'Hari Ini (' . Carbon::today()->isoFormat('dddd, D MMMM Y') . ')';
                } elseif($this->waktu == 'kemarin') {
                    $periodText .= 'Kemarin (' . Carbon::yesterday()->isoFormat('dddd, D MMMM Y') . ')';
                } elseif($this->waktu == 'minggu_ini') {
                    $periodText .= 'Minggu Ini (' . Carbon::now()->startOfWeek()->isoFormat('D MMMM Y') . ' - ' . Carbon::now()->endOfWeek()->isoFormat('D MMMM Y') . ')';
                } elseif($this->waktu == 'bulan_ini') {
                    $periodText .= 'Bulan Ini (' . Carbon::now()->isoFormat('MMMM Y') . ')';
                } elseif($this->waktu == 'custom_date') {
                    $periodText .= $this->customDate ? Carbon::parse($this->customDate)->isoFormat('dddd, D MMMM Y') : 'Tanggal Belum Dipilih';
                } else {
                    $periodText .= ucfirst(str_replace('_', ' ', $this->waktu));
                }
                $event->sheet->setCellValue('A3', $periodText);
                $event->sheet->mergeCells('A3:' . $event->sheet->getHighestColumn() . '3');

                // Set print date
                $event->sheet->setCellValue('A4', 'Tanggal Cetak: ' . Carbon::now()->isoFormat('dddd, D MMMM Y HH:mm'));
                $event->sheet->mergeCells('A4:' . $event->sheet->getHighestColumn() . '4');

                // Style the title rows
                $event->sheet->getStyle('A1:A4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]
                ]);

                // Style the title specifically
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ]
                ]);

                // Style the header row (now at row 6)
                $headerRow = 6;
                $event->sheet->getStyle('A' . $headerRow . ':' . $event->sheet->getHighestColumn() . $headerRow)->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'F2F2F2'
                        ]
                    ]
                ]);

                // Auto-size columns
                foreach(range('A', $event->sheet->getHighestColumn()) as $column) {
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }

                // Add borders to data
                $dataStartRow = $headerRow + 1;
                $dataEndRow = $highestRow + 4; // +4 because we inserted 4 rows
                $event->sheet->getStyle('A' . $dataStartRow . ':' . $event->sheet->getHighestColumn() . $dataEndRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => 'DDDDDD']
                        ]
                    ]
                ]);
            }
        ];
    }
}
