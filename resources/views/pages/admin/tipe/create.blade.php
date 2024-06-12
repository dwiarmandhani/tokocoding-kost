@extends('layouts.admin')

@section('title')
    Tipe Kamar
@endsection

<style type="text/css">
.facility {
    width: 30%;
    float: left;
    /* padding: 10px; */
}
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
                        <h4>Tambah Tipe Kamar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tipe.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Tipe Kamar</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama kamar" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Thumbnail Kamar</label>
                                        <input type="file" name="foto" class="form-control">
                                        <small>
                                            Format: jpg, png, jpeg
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Lantai</label>
                                        <input type="number" name="lantai" class="form-control" placeholder="Masukkan lantai kamar" autocomplete="off">
                                        <small>Contoh: 1</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Harga</label>
                                        <input type="number" name="harga" class="form-control" placeholder="Masukkan Harga Kamar" autocomplete="off">
                                        <small>Contoh: 500000</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Ukuran</label>
                                        <input type="text" name="ukuran" class="form-control" placeholder="Masukkan Ukuran Kamar" autocomplete="off">
                                        <small>Contoh: 3 x 3</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="required">Fasilitas</h6>
                                    <div class="form-group mt-2">
                                    @forelse($fasilitas as $fas)
                                        <div class="form-check">
                                            <label class="checkbox" name="fas">
                                                <input name="fas[{{$fas->id}}]" value={{ $fas->nama }} class="form-check-input" type="checkbox" data-toggle="checkbox" id="defaultCheck1" >
                                                {{ $fas->nama }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>Maaf tidak ada fasilitas tersedia</p>
                                    @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="row tombol">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                        Simpan Data
                                    </button>
                                    <a href="{{ route('tipe.index') }}" class="btn btn-danger px-5" style="padding: 8px 16px; margin-left:10px;">
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
