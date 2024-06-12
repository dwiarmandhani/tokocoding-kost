<!-- resources/views/pages/admin/transaksi/success.blade.php -->

@extends('layouts.admin')

@section('title', 'Pemesanan Berhasil')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pemesanan Berhasil</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Pemesanan Berhasil</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Pemesanan kamar Anda berhasil.</h5>
                    <p>Terima kasih telah melakukan pemesanan.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
