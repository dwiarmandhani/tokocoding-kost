@extends('layouts.user')

@section('title')
    Profil
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/viewProfil.css') }}" type="text/css">
<style type="text/css">
<style>
        .inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
input[type="file"]{
    display: none;
}
.inputfile + label {
    color: white;
    font: 500 1.5rem/1.5rem Poppins, sans-serif;
    background-color: black;
    display: inline-block;
    margin-left: 3rem;
    margin-top: 2rem;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: red;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
.inputfile:focus + label,
.inputfile.has-focus + label {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;
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
.inpFile {
    margin-left: 3rem;
    margin-top: 2rem;
    color: #000;
}
input[type="file"]{
    display: none;
}
/* label {
    color: white;
    height: 35px;
    width: 105px;
    background-color: #03a9f4;
    position: absolute;
    margin-left: 8.5em;
    padding: 10px;
    border-radius: 10px;
    padding-top: 8px;
    padding-left: 20px;
    font-weight: lighter;
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1em;
} */
label:hover {
    opacity: 80%;
}</style>
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
            {{-- <div class="row"> --}}
                @php $no = 1; @endphp
                @foreach ($data as $u)
                <div class="container bg-white">
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <h5 class="mt-4">Informasi Pengguna</h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-3">
                                @if ($u->avatar != null)
                                    <img src="{{ Storage::url($u->avatar) }}" width="200px" height="200px" alt="foto"
                                    style="rounded-circle mt-5">
                                @else
                                    <img src="{{ asset('assets/img/avatar/avatar-4.png') }}" width="200px" height="200px" alt="foto"
                                    style="rounded-circle mt-5">
                                @endif
                                <a title="Upload Bukti" data-toggle="modal" data-target="#uploadBukti" data-placement="top" class="btn btn-success btn-xs edit mt-3">
                                    <i class="fas fa-camera" style="color: white;"> Ubah Foto</i>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-8 border-right">
                            <div class="p-3 py-3">
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Nama</label>
                                        <div class="col-8">
                                    <input id="name" name="name" value="{{ $u->name }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Nomor Telepon</label>
                                        <div class="col-8">
                                    <input id="name" name="no_hp" value="{{ $u->no_hp }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Email</label>
                                        <div class="col-8">
                                    <input id="name" name="email" value="{{ $u->email }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Alamat</label>
                                        <div class="col-8">
                                    <input id="name" name="alamat" value="{{ $u->alamat }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Pekerjaan</label>
                                        <div class="col-8">
                                    <input id="name" name="pekerjaan" value="{{ $u->pekerjaan }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Nama Bank</label>
                                        <div class="col-8">
                                    <input id="name" name="bank" value="{{ $u->bank }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Nomor Rekening</label>
                                        <div class="col-8">
                                    <input id="name" name="no_rekening" value="{{ $u->no_rekening }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Foto KTP</label>
                                        <div class="col-8">
                                            @if ($u->foto_ktp != null)
                                                <img src="{{ Storage::url($u->foto_ktp) }}" alt="foto" width="200px" height="150px"
                                                style="display: block; margin-right:auto">
                                            @else
                                                <img src="{{ asset('assets/img/default.jpg') }}" width="200px" height="150px" alt="">
                                            @endif
                                        </div>
                                </div>
                                <div class="mt-5">
                                    <a class="btn btn-primary profile-button" href="{{ route('change-profil-user') }}">Ubah Profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    </div>
                </div>
            {{-- </div> --}}
            @endforeach
        </div>
    </section>
</div>
<!-- Modal -->
@foreach ($data as $u)
<div class="modal fade" id="uploadBukti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="img">
        <form action="{{ route('change-avatar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profil</h5>
            @error('avatar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @if($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Image Preview" class="image-preview__image">
                        <span class="image-preview__default-text">
                        +</span>
                </div>
                <input type="file" name="avatar" id="inpFile" style="margin-top: 10px">
                <label for="inpFile" style="color: white;
                    height: 35px;
                    width: 105px;
                    background-color: #03a9f4;
                    position: absolute;
                    margin-left: 6em;
                    padding: 10px;
                    border-radius: 10px;
                    padding-top: 8px;
                    padding-left: 20px;
                    font-weight: lighter;
                    font-size: 12px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-top: 1em;">
                <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                    Pilih foto
                </label>
            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
@push('addon-script')
<script>
    @if($errors->has('avatar'))
        $('#uploadBukti').modal({
            show: true
        });
    @endif

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
</script>
@endpush
