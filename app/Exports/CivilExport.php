<?php

namespace App\Exports;

use App\Models\CivilRepair;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CivilExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithDrawings
{
    protected $no = 1;
    protected $month;
    protected $data;

    public function __construct($month = null)
    {
        $this->month = $month;

        $query = CivilRepair::query();

        // ✅ FILTER BULAN
        if ($month) {
            $date = Carbon::parse($month);
            $query->whereMonth('tgl', $date->month)
                  ->whereYear('tgl', $date->year);
        }

        $this->data = $query->orderBy('tgl', 'desc')->get();
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
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
    }

    public function map($row): array
    {
        return [
            $this->no++,
            Carbon::parse($row->tgl)->format('d-m-Y'),
            $row->lokasi,
            $row->pekerjaan,
            '',
            '',
            '',
            $row->keterangan,
            $row->petugas
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $totalRows = count($this->data) + 4;

        // ================= HEADER =================
        $sheet->insertNewRowBefore(1, 3);

        $bulan = $this->month
            ? strtoupper(Carbon::parse($this->month)->format('F Y'))
            : strtoupper(date('F Y'));

        $sheet->setCellValue('A1', 'CIVIL REPAIR MAINTENANCE');
        $sheet->setCellValue('A2', 'PATRA SEMARANG HOTEL & CONVENTION');
        $sheet->setCellValue('A3', $bulan);

        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');
        $sheet->mergeCells('A3:I3');

        $sheet->getStyle('A1:I3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 14
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2563EB']
            ]
        ]);

        // HEADER TABLE
        $sheet->getStyle('A4:I4')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB']
            ]
        ]);

        // BORDER
        $sheet->getStyle("A4:I{$totalRows}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // ALIGN
        $sheet->getStyle("A4:I{$totalRows}")
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle("A5:I{$totalRows}")
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // HEIGHT ROW
        for ($i = 5; $i <= $totalRows; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(80);
        }

        return [];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 5;

        foreach ($this->data as $item) {

            if ($item->gambar_temuan && file_exists(public_path('storage/'.$item->gambar_temuan))) {
                $drawing = new Drawing();
                $drawing->setPath(public_path('storage/'.$item->gambar_temuan));
                $drawing->setHeight(80);
                $drawing->setCoordinates('E'.$row);
                $drawings[] = $drawing;
            }

            if ($item->gambar_progress && file_exists(public_path('storage/'.$item->gambar_progress))) {
                $drawing2 = new Drawing();
                $drawing2->setPath(public_path('storage/'.$item->gambar_progress));
                $drawing2->setHeight(80);
                $drawing2->setCoordinates('F'.$row);
                $drawings[] = $drawing2;
            }

            if ($item->gambar_selesai && file_exists(public_path('storage/'.$item->gambar_selesai))) {
                $drawing3 = new Drawing();
                $drawing3->setPath(public_path('storage/'.$item->gambar_selesai));
                $drawing3->setHeight(80);
                $drawing3->setCoordinates('G'.$row);
                $drawings[] = $drawing3;
            }

            $row++;
        }

        return $drawings;
    }
}