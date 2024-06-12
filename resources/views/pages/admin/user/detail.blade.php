@extends('layouts.admin')

@section('title')
    User
@endsection
<style type="text/css">

    .inpFile {
        margin-left: 3rem;
        margin-top: 2rem;
        color: #000;
    }
    input[type="file"]{
        display: none;
    }
    .image-preview {
        width: 250px;
        min-height: 170px;
        border: 2px dashed #afeeee;
        margin-top: 15px;
        /* margin-left: 3em; */
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
    .image-preview__image{
        display: none;
        width: 100%;
    }
    .image-preview__default-text {
        color:#87ceeb;

    }
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */

</style>
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Detail @yield('title')</div>
            </div>
        </div>

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                @foreach ($user as $u)
                    <div class="col-md-6">
                        <div class="p-3 py-5">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels mt-2">Nama</label>
                                    <input type="text" class="form-control" value="{{ $u->name }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels mt-2">Nomor Handphone</label>
                                    <input type="text" class="form-control" value="{{ $u->no_hp }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels mt-2">Alamat</label>
                                    <input type="text" class="form-control" value="{{ $u->alamat }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels mt-2">Email</label>
                                    <input type="text" class="form-control" value="{{ $u->email }}" disabled>
                                </div>
                            </div>
                            <a href="{{ route('new-password',$u->id) }}" class="btn btn-success" style="margin-top: 100px">Buat Kata Sandi Baru</a>
                            <a href="{{ route('user') }}" class="btn btn-danger" style="margin-top: 100px">Kembali</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 py-5">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels mt-2">Pekerjaan</label>
                                    <input type="text" class="form-control" value="{{ $u->pekerjaan }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels mt-2">Bank</label>
                                    <input type="text" class="form-control" value="{{ $u->bank }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels mt-2">Nomor rekening</label>
                                    <input type="text" class="form-control" value="{{ $u->no_rekening }}" disabled>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels mt-2">Foto Ktp</label>
                                    @if ($u->foto_ktp == null)
                                    <div class="image-preview" id="imagePreview">
                                        <img src="" alt="Image Preview" class="image-preview__image">
                                            <span class="image-preview__default-text">
                                            +</span>
                                    </div>
                                    @else
                                        <img id="img_ktp" src="{{ Storage::url($u->foto_ktp) }}" name="foto_ktp" width="250px" height="150px" alt="foto"
                                        style="display: block; margin-bottom:15px; margin-right:auto">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- <div class="section-body">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($user as $u)
                            <form>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <h5>Detail User</h5>
                                </div>
                                <hr>
                                <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Nama</label>
                                    <div class="col-9">
                                    <input id="name" name="name" value="{{ $u->name }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-3 col-form-label">Nomor Handphone</label>
                                    <div class="col-9">
                                    <input id="lastname" name="no_hp" value="{{ $u->no_hp }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Alamat</label>
                                    <div class="col-9">
                                    <input id="text" name="alamat" value="{{ $u->alamat }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Pekerjaan</label>
                                    <div class="col-9">
                                    <input id="text" name="pekerjaan" value="{{ $u->pekerjaan }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Bank</label>
                                    <div class="col-9">
                                    <input id="text" name="bank" value="{{ $u->bank }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Nomor Rekening</label>
                                    <div class="col-9">
                                    <input id="text" name="no_rekening" value="{{ $u->no_rekening }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Foto KTP</label>
                                    <div class="col-9">
                                        @if ($u->foto_ktp == null)
                                        <div class="image-preview" id="imagePreview">
                                            <img src="" alt="Image Preview" class="image-preview__image">
                                                <span class="image-preview__default-text">
                                                +</span>
                                        </div>
                                        @else
                                            <img id="img_ktp" src="{{ Storage::url($u->foto_ktp) }}" name="foto_ktp" width="250px" height="200px" alt="foto"
                                            style="display: block; margin-bottom:15px; margin-right:auto">
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('new-password',$u->id) }}" class="btn btn-success">Kata Sandi Baru</a>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> --}}
    </section>
</div>
@endsection
