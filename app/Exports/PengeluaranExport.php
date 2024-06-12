<?php

namespace App\Exports;

use App\Pengeluaran;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PengeluaranExport implements FromCollection, WithMapping, WithHeadings,WithColumnFormatting,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengeluaran::get();
    }

    public function map($pengeluarans): array
    {
        return [
            $pengeluarans->id,
            $pengeluarans->tanggal,
            $pengeluarans->deskripsi,
            number_format($pengeluarans->nominal),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Deskripsi',
            'Nominal',
        ];
    }

    public function columnFormats(): array
    {
        return[
            'D' => '"Rp "#,##0.00_-',
        ];
    }
}
