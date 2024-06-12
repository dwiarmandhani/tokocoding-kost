@extends('layouts.user')

@section('title')
    Ubah Profil
@endsection
{{-- <link rel="stylesheet" href="{{ asset('assets/css/editProfil.css') }}" type="text/css"> --}}
<style type="text/css">
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
.required:after {
        content:" *";
        color: red;
    }
</style>
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                @php $no = 1; @endphp
                @foreach ($data as $u)
                <div class="container">
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{ route('change-profil-user-redirect',$u->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <h5>Informasi Anda</h5>
                                    </div>
                                    <hr>
                            <form>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label required">Nama</label>
                                    <div class="col-9">
                                    <input id="name" name="name" value="{{ $u->name }}" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-3 col-form-label required">Nomor Handphone</label>
                                    <div class="col-9">
                                    <input id="lastname" name="no_hp" value="{{ $u->no_hp }}" class="form-control here" type="numeric">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-3 col-form-label required">Email</label>
                                    <div class="col-9">
                                    <input id="name" name="email" value="{{ old('email',$u->email) }}" class="form-control here" required="required" type="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label required">Alamat</label>
                                    <div class="col-9">
                                    <input id="text" name="alamat" value="{{ old('alamat',$u->alamat) }}" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label required">Pekerjaan</label>
                                    <div class="col-9">
                                    <input id="text" name="pekerjaan" value="{{ old('pekerjaan',$u->pekerjaan) }}" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label required">Bank</label>
                                    <div class="col-9">
                                    <input id="text" name="bank" value="{{ old('bank',$u->bank) }}" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label required">Nomor Rekening</label>
                                    <div class="col-9">
                                    <input id="text" name="no_rekening" value="{{ old('no_rekening',$u->no_rekening) }}" class="form-control here" required="required" type="numeric">
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="text" class="col-3 col-form-label required">Foto KTP</label>
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
                                    <input type="file" name="foto_ktp" id="inpFile" style="margin-top: 10px">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8" style="margin-top: 30px">
                                    <button type="submit" class="btn btn-primary px-5">
                                        Simpan
                                    </button>
                                    <a href="{{ route('profil-user') }}" class="btn btn-danger px-5 text-white">
                                        Batal
                                    </a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </form>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
@push('addon-script')
<script>
    $(function () {
        $("#foto_ktp").change(function () {
            readURL(this);
        });
    });
    const inpFile = document.getElementById("inpFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

    inpFile.addEventListener("change", function(){

        const file = this.files[0];

        if (file){
            const reader = new FileReader();

            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";

            reader.addEventListener("load", function(){

                previewImage.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);
        }else {
            previewDefaultText.style.display = null;
            previewImage.style.display = null;
            previewImage.setAttribute("src", "");
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_ktp').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
