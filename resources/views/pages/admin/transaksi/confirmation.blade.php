@extends('layouts.admin')

@section('title', 'Konfirmasi Pemesanan')

@section('content')
<div class="main-content">
    
    <section class="section">
        <div class="section-header">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h1>Konfirmasi Pemesanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Konfirmasi Pemesanan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Pemesanan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th width="30%">Tipe Kamar</th>
                                    <td>{{ $tipe_kamar->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Masuk</th>
                                    <td>{{ $new_tanggal_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Keluar</th>
                                    <td>{{ $new_tanggal_keluar }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Durasi</th>
                                    <td>{{ $durasi }} Bulan</td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td>Rp {{ number_format($total_harga) }}</td>
                                </tr>
                                <tr>
                                    <th>Kode Pemesanan</th>
                                    <td>{{ $kode }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pemesan</th>
                                    <td>{{ $name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $email }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Kontak</th>
                                    <td>{{ $no_hp }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <!-- Ubah link menjadi form POST -->
                    <form action="{{ route('bookingadmin') }}" method="POST">
                        @csrf
                        <!-- Sisipkan input hidden untuk data yang diperlukan -->
                        <input type="hidden" name="tipe_kamar_id" value="{{ $tipe_kamar_id }}">
                        <input type="hidden" name="tanggal_masuk" value="{{ $new_tanggal_masuk }}">
                        <input type="hidden" name="durasi" value="{{ $durasi }}">
                        <input type="hidden" name="kode" value="{{ $kode }}">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="harga" value="{{ $total_harga }}">
                        <button type="submit" class="btn btn-primary px-5">Selesai</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
