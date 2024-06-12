<?php

namespace App\Exports;

use App\Booking;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PemasukanExport implements FromCollection, WithMapping, WithHeadings,WithColumnFormatting,ShouldAutoSize
{

    // use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Booking::with('user','kamar')->where('status',"Sukses")->get();
    }

    public function map($pemesanans): array
    {
        return [
            $pemesanans->id,
            $pemesanans->user->name,
            $pemesanans->kode,
            $pemesanans->tanggal_pesan,
            number_format($pemesanans->total_harga),
        ];
        // return view('pages.admin.pemasukan.pemasukan_excel',[
        //     'pemesanans' => Booking::where('status',"Sukses")
        // ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Kode Pemesanan',
            'Tanggal Pesan',
            'Harga'
        ];
    }

    public function columnFormats(): array
    {
        return[
            'E' => '"Rp "#,##0.00_-',
        ];
    }
}
