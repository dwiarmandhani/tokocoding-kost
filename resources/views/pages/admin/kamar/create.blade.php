@extends('layouts.admin')

@section('title')
    Kamar
@endsection
<style>
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
                    <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kamar</h4>
                    </div>
                    <div class="card-body">
                        <form action="/admin/tipe/{{ $tipe_kamar->id }}/kamar" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Nomor Kamar</label>
                                    <input type="text" name="nomor_kamar" class="form-control"
                                    placeholder="Masukkan Nomor Kamar" value="{{ old('nomor_kamar') }}" autocomplete="off">
                                    <small>Contoh: 1</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1"
                                            @if (old('status') == 'Kosong')selected="selected" @endif" >
                                            Kosong
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row tombol">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                    Simpan Data
                                </button>
                                <a href="/admin/tipe/{{ $tipe_kamar->id }}/kamar" class="btn btn-danger px-5" style="padding: 8px 16px; margin-left:10px;">
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
