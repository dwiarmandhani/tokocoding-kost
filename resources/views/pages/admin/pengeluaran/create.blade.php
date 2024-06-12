@extends('layouts.admin')

@section('title')
    Pengeluaran
@endsection
<style>
    .required:after {
        content:" *";
        color: red;
    }
    @media (max-width: 417px) {
        .tombol .btn.simpan {
        margin-bottom: 10px;
        }
    }
</style>

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card">
                    <div class="card-header">
                        <h4>Tambah Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control"
                                    placeholder="Masukkan deskripsi pengeluaran" autocomplete="off">
                                    <small>Contoh: Air, Listrik, Wifi</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Nominal</label>
                                    <input type="number" name="nominal" class="form-control"
                                    placeholder="Masukkan Nominal" autocomplete="off">
                                    <small>Contoh: 10000</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Foto Bukti Pengeluaran</label>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                            </div>
                        </div>
                            <div class="row tombol">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                        Simpan Data
                                    </button>
                                    <a href="{{ route('pengeluaran.index') }}" class="btn btn-danger px-5" style="padding: 8px 16px">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
