@extends('layouts.admin')

@section('title')
    Detail Pemesanan
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin-dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                {{-- <div class="card-header">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    Detail Pemesanan
                </h4>
                </div> --}}
            <div class="card-body">
                <div class="row">
                    @foreach ($pemesanans as $index => $tf)
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="300px">Status</td>
                                <td>
                                    @if($tf->status == "Menunggu")
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($tf->status == "Sukses")
                                        <span class="badge badge-success">Sukses</span>
                                    @elseif($tf->status == "Dibatalkan")
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Kode Pemesanan</td>
                                <td>
                                    {{ $tf->kode }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Nama Lengkap</td>
                                <td>
                                    {{ $tf->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Email</td>
                                <td>
                                    {{ $tf->user->email }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Nomor Telepon</td>
                                <td>
                                    {{ $tf->user->no_hp }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Total Harga</td>
                                <td>
                                    Rp {{ number_format($tf->total_harga,2,',','.') }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tanggal Pesan</td>
                                <td>
                                    <?php
                                        $date = new DateTime($tf->tanggal_pesan);
                                        echo $date->format('d F Y H:i:s');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Durasi</td>
                                <td>
                                    {{ $tf->durasi }} Bulan
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tanggal Masuk</td>
                                <td>
                                    <?php
                                        $date = new DateTime($tf->tanggal_masuk);
                                        echo $date->format('d F Y');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tanggal Keluar</td>
                                <td>
                                    <?php
                                        $date = new DateTime($tf->tanggal_keluar);
                                        echo $date->format('d F Y');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tipe Kamar</td>
                                <td>
                                    {{ $tf->kamar->tipe_kamar->nama }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Nomor Kamar</td>
                                <td>
                                    {{ $tf->kamar->nomor_kamar }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Bukti Pembayaran</td>
                                <td>
                                    @if ($tf->bukti_pembayaran == null)
                                        <img src="{{ asset('assets/img/default.jpg') }}" width="150px" height="150px" alt="">
                                    @else
                                        <img id="img_ktp" src="{{ Storage::url($tf->bukti_pembayaran) }}" name="bukti_pembayaran" width="150px" height="200px" alt="foto"
                                        style="display: block; margin-bottom:15px; margin-right:auto">

                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                            <div class="justify-content-left">
                                <a href="{{ route('transaksi') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </td>
                        </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
