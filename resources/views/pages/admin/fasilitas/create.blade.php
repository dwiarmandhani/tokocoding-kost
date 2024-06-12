@extends('layouts.admin')

@section('title')
    Fasilitas
@endsection
<style type="text/css">
.required:after {
    content:" *";
    color: red;
}
@media (max-width: 427px) {
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

        <div class="section-body" id="facilities_create">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="card-header">
                        <h4>Tambah Fasilitas</h4>
                    </div>
                    <div class="card-body">
                        <form id="facilitas_store" action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Nama Fasilitas</label>
                                        <input type="text" name="nama" class="form-control" autocomplete="off" placeholder="Masukkan Fasilitas"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Icon Fasilitas</label>
                                        <input type="file" name="icon" class="form-control" autocomplete="off" placeholder="Masukkan Fasilitas"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row tombol">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                        Simpan Data
                                    </button>
                                    <a href="{{ route('fasilitas.index') }}" class="btn btn-danger px-5" style="padding: 8px 16px; margin-left:10px;">
                                        Batal
                                    </a>
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
