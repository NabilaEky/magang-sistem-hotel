<?php

namespace App\Exports;

use App\Models\KeluhanAdmin;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KeluhanExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    public function array(): array
    {
        $keluhans = KeluhanAdmin::all();
        $data = [];

        // Judul dan tanggal cetak (baris 1 & 2)
        $data[] = ['Daily Work'];
        $data[] = ['Tanggal Cetak: ' . now()->format('d M Y')];
        $data[] = ['ENGINEERING DEPARTMENT', '', 'Periode: -', '', 'Status: -'];
        $data[] = []; // spasi sebelum tabel

        // Header tabel
        $data[] = [
            'No',
            'Nama',
            'Jam',
            'Lokasi',
            'Problem',
            'Petugas',
            'Status',
            'Material',
            'Keterangan',
            'Paraf SPV',
        ];

        // Data keluhan
        $no = 1;
        foreach ($keluhans as $k) {
            $data[] = [
                $no++,
                $k->jenis_masalah,
                $k->created_at?->format('H:i'),
                $k->lokasi,
                $k->kategori ?? '-',
                $k->petugas,
                $k->status,
                '-',                  // Material kosong
                $k->prioritas,
                '',                   // Paraf SPV kosong
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        // Kosong karena kita sudah menambahkan header manual di array
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold dan merge judul & info cetak
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');
        $sheet->mergeCells('A3:B3');
        $sheet->mergeCells('C3:D3');
        $sheet->mergeCells('E3:J3');

        $sheet->getStyle('A1:A3')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:J2')->getAlignment()->setHorizontal('left');
        $sheet->getStyle('A3:J3')->getAlignment()->setHorizontal('left');

        // Header tabel (baris 5)
        $sheet->getStyle('A5:J5')->getFont()->setBold(true);
        $sheet->getStyle('A5:J5')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('1E40AF'); // biru
        $sheet->getStyle('A5:J5')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A5:J5')->getAlignment()->setHorizontal('center');

        // Border untuk seluruh tabel
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A5:J$lastRow")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 20,  // Nama
            'C' => 10,  // Jam
            'D' => 20,  // Lokasi
            'E' => 20,  // Problem
            'F' => 20,  // Petugas
            'G' => 15,  // Status
            'H' => 15,  // Material
            'I' => 15,  // Keterangan
            'J' => 15,  // Paraf SPV
        ];
    }
}