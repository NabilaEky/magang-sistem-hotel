<?php

namespace App\Exports;

use App\Models\MeRepair;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MeExport implements FromArray, WithStyles, WithColumnWidths
{
    protected $data;
    protected $month;

    public function __construct($month = null)
    {
        $this->month = $month;

        $query = MeRepair::query();

        if ($month) {
            $date = Carbon::parse($month);
            $query->whereMonth('tgl', $date->month)
                  ->whereYear('tgl', $date->year);
        }

        $this->data = $query->orderBy('tgl', 'desc')->get();
    }

    public function array(): array
    {
        $rows = [];

        // HEADER ATAS (judul)
        $rows[] = ['ME REPAIR MAINTENANCE'];
        $rows[] = ['PATRA SEMARANG HOTEL & CONVENTION'];
        $rows[] = [strtoupper($this->month ?? date('F Y'))];
        $rows[] = []; // spasi

        // HEADER TABEL
        $rows[] = [
            'NO',
            'TGL',
            'LOKASI',
            'PEKERJAAN',
            'GAMBAR TEMUAN',
            'GAMBAR PROGRESS',
            'SELESAI',
            'KETERANGAN',
            'PETUGAS'
        ];

        foreach ($this->data as $i => $item) {
            $rows[] = [
                $i + 1,
                Carbon::parse($item->tgl)->format('d-m-Y'),
                $item->lokasi,
                $item->pekerjaan,
                $item->gambar_temuan ? asset('storage/'.$item->gambar_temuan) : '-',
                $item->gambar_progress ? asset('storage/'.$item->gambar_progress) : '-',
                $item->selesai ? asset('storage/'.$item->selesai) : '-',
                $item->keterangan,
                $item->petugas,
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        // MERGE HEADER
        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');
        $sheet->mergeCells('A3:I3');

        // STYLE HEADER BIRU
        $sheet->getStyle('A1:A3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2563EB'] // biru
            ]
        ]);

        // HEADER TABEL
        $sheet->getStyle('A5:I5')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB'] // abu
            ]
        ]);

        // BORDER SEMUA TABEL
        $lastRow = count($this->data) + 5;

        $sheet->getStyle("A5:I$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ]);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 12,
            'C' => 15,
            'D' => 20,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 25,
            'I' => 20,
        ];
    }
}