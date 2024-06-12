@extends('layouts.admin')

@section('title')
    Kamar
@endsection

@section('content')

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

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Table @yield('title')</div>
            </div>
        </div>

        <div class="section-body">
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
                        <h4>Edit Kamar</h4>
                    </div>
                    <div class="card-body">
                        <form action="/admin/tipe/{{ $tipe_kamar->id }}/kamar/{{ $kamar->id }}/edit" method="POST" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="required">Nomor Kamar</label>
                                        <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="required">Tipe Kamar</label>
                                        <select name="tipe_kamar_id" class="form-control">
                                            <option value="{{ $tipe_kamar->tipe_kamar_id }}">{{ $tipe_kamar->nama }}</option>
                                            {{-- @foreach ($tipe_kamar as $r)
                                                <option value="{{ $r->id }}">
                                                    {{ $tipe_kamar->name }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="required">Status</label>
                                        <select name="status" id="tersedia" class="form-control">
                                            <option value="Kosong"
                                            @if (old('status') == 'Kosong')selected="selected" @endif" >
                                            Kosong
                                            </option>
                                            <option value="Dipesan"
                                            @if (old('status') == 'Dipesan')selected="selected" @endif" >
                                            Dipesan
                                            <option value="Disewa"
                                            @if (old('status') == 'Disewa')selected="selected" @endif" >
                                            Disewa
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
