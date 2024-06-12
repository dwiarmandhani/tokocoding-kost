@extends('layouts.admin')

@section('title')
    Fasilitas
@endsection

@section('content')

<style type="text/css">
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
                        <h4>Edit Fasilitas</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('fasilitas.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Nama Fasilitas</label>
                                        <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Icon Fasilitas</label>
                                        <input type="file" name="icon" id="input_photo" class="form-control">
                                        @if ($data->icon != null)
                                            <img id="img_photo" src="{{ Storage::url($data->icon) }}" width="30px" height="30px" alt="foto"
                                            style="display: block; margin:left; margin-top: 10px;">
                                        @else
                                            <img id="img_photo" src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="30px" height="30px" alt="foto"
                                            style="display: block; margin:left; margin-top:10px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        <div class="row tombol">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                    Simpan Data
                                </button>
                                <a href="{{ route('fasilitas.index') }}" class="btn btn-danger px-5" style="padding: 8px 16px">
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
@push('addon-script')
<script type="text/javascript">
    $(function () {
        $("#input_photo").change(function () {
            readURL(this);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
