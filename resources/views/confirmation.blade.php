@extends('layouts.fe')

@section('title')
    Pengajuan Sewa
@endsection

@section('content')
<style>
.btn-fill{
    background-color: #6777ef;
    border-radius: 12px;
    padding: 12px 28px;
    transition: 0.3s;
}
.sewa-table{
    margin-left: 1rem;
}
.table{
    border-collapse: separate;
    border-spacing:0 20px;
}
.td{
    padding: 0 15px;
}
</style>
<section class="h-100 w-100 bg-white pb-5" style="box-sizing: border-box">
    <div class="confirmation container mx-auto p-0  position-relative confirmation-content"
        style="font-family: 'Poppins', sans-serif">
        {{-- <div class="row">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </nav>
        </div> --}}

        <div class="container-fluid">
            <div class="card">
                <div class="card">
                    <div class="card-header justify-content-center">
                    <h4 class="d-flex justify-content-center mb-3">
                        Konfirmasi Pemesanan Kamar
                    </h4>
                    </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group mb-3" style="border:none">
                                <li class="list-group-item  mb-1"  style="border:none">
                                    <div>
                                    <h6 class="my-0 mb-1">Nama Lengkap :</h6>
                                    </div>
                                    <span class="text-muted">{{ Auth::user()->name }}</span>
                                </li>
                                <li class="list-group-item mb-1"  style="border:none">
                                    <div>
                                    <h6 class="my-0  mb-1">E-mail :</h6>
                                    </div>
                                    <span class="text-muted">{{ Auth::user()->email }}</span>
                                </li>
                                <li class="list-group-item  mb-1"  style="border:none">
                                    <div>
                                    <h6 class="my-0  mb-1">Nomor Telepon :</h6>
                                    </div>
                                    <span class="text-muted">{{ Auth::user()->no_hp }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 order-md-2 mb-4">
                            <ul class="list-group mb-3">
                                <li class="list-group-item mb-3" style="border:none">
                                    <div>
                                    <h6 class="my-0 mb-1">Kode Pemesanan :</h6>
                                    </div>
                                    <span class="text-muted">{{ $kode }}</span>
                                </li>
                                <p class="alert alert-warning">Terimakasih sudah melakukan pemesanan kamar. </br>
                                Selanjutnya klik tombol pesan untuk menyelesaikan pemesanan kamar.</p>
                            </ul>
                        </div>
                    </div>
                    <div class="sewa-table">
                    <h6>Sewa Kamar :</h6>
                        <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="thead-light" style="margin-bottom: 10px">
                            <tr style="margin-bottom: 10px">
                                <th scope="col">Nomor Kamar</th>
                                <th scope="col">Tanggal Masuk</th>
                                <th scope="col">Tanggal Keluar</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                            </thead>
                            <tbody style="margin-bottom: 10px">
                            <tr>
                                <td>{{ $tipe_kamar->nama }} ({{ $nomor_kamar }}) </td>
                                <td>
                                    <?php
                                        $date = new DateTime($new_tanggal_masuk);
                                        echo $date->format('d F Y');
                                    ?>
                                    {{-- {{ $new_tanggal_masuk }} --}}
                                </td>
                                <td>
                                    {{-- {{ $new_tanggal_keluar}} --}}
                                    <?php
                                    $date = new DateTime($new_tanggal_keluar);
                                    echo $date->format('d F Y');
                                ?>
                                </td>
                                <td>{{ $durasi }} bulan</td>
                                <td>Rp. {{ number_format($total_harga,2,',','.') }}</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <form class="card p-2 float-right" action="{{ route('booking', $tipe_kamar_id) }}" method="POST">
                            @csrf
                                <input name="booking_validation" type="hidden" value="0">
                                <input type="date" class="form-control" id="datepicker" name="tanggal_masuk" value="{{ $new_tanggal_masuk }}" hidden>
                                <input name="kode" id="kode" class="form-control" value="{{ $kode }}" hidden>
                                <input name="durasi" id="durasi" class="form-control" value="{{ $durasi }}" hidden>
                                <button type="submit" class="btn btn-fill text-white px-5" style="padding: 8px 16px">Pesan</button>
                        </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
</section>
@endsection
