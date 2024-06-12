@extends('layouts.admin')

@section('title')
    Update Status Booking
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
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
                        <h4>Update Status Booking</h4>
                    </div>
                    <div class="card-body">
                        <form action="/admin/booking/{{$transaksis->id}}/edit" method="POST" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" value="{{ $transaksis->user->name }}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode Pemesanan</label>
                                        <input type="text" name="kode" value="{{ $transaksis->kode }}" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Menunggu"
                                            @if ($transaksis->status == 'Menunggu')
                                                selected="selected"
                                            @endif>Menunggu
                                            </option>
                                            <option value="Selesai"
                                            @if ($transaksis->status == 'Selesai')
                                                selected="selected"
                                            @endif>Selesai
                                            </option>
                                            <option value="Dibatalkan"
                                            @if ($transaksis->status == 'Dibatalkan')
                                                selected="selected"
                                            @endif>Dibatalkan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5" style="padding: 8px 16px">
                                        Update Status
                                    </button>
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
