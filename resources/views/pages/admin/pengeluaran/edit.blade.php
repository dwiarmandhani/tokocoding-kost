@extends('layouts.admin')

@section('title')
    Pengeluaran
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
            <div class="breadcrumb-data active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-data">@yield('title')</div>
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
                        <h4>Edit Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pengeluaran.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control"
                                    value="{{$data->deskripsi  }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal" class="form-control"
                                    value="{{$data->tanggal  }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Nominal</label>
                                    <input type="number" name="nominal" class="form-control"
                                    value="{{ $data->nominal }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Foto Bukti Pengeluaran</label>
                                    <input type="file" id="input_photo" name="photo" class="form-control mb-2">
                                    @if ($data->foto != null)
                                        <img id="img_photo" src="{{ Storage::url($data->foto) }}" width="150px" height="180px" alt="foto"
                                        style="display: block; margin:auto">
                                    @else
                                        <img id="img_photo" src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="170px" height="170px" alt="foto"
                                        style="display: block; margin:auto">
                                    @endif
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
