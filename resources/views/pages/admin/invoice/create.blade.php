@extends('layouts.admin')

@section('title')
    Invoice
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Buat @yield('title')</h1>
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
                    <div class="card">
                        <div class="card-header">
                            <h4>Perpanjangan Sewa</h4>
                        </div>
                        <div class="card-body">
                            <form id="invoice_store" action="{{ $invoice->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $invoice->user_id }}">
                                            <label>Nama Penghuni</label>
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value="{{ $invoice->user_id}}">{{ $invoice->user->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-muted"></span>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Kamar</label>
                                            <select name="room_id" id="room_id" class="form-control">
                                                <option value="{{ $invoice->room_id }}">{{ $invoice->room_id }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tipe Kamar</label>
                                            <select name="name" id="name" class="form-control">
                                                <option value="{{ $invoice->room->room_type->id }}">{{ $invoice->room->room_type->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="departure_date">Tanggal Keluar</label>
                                            <input type="text" class="form-control" value="{{ $invoice->departure_date }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lama Sewa</label>
                                            <select name="duration" id="duration" class="form-control">
                                                <option value="1">1 Bulan</option>
                                                <option value="6">6 Bulan</option>
                                                <option value="12">1 Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <input type="date" class="form-control" id="datepicker" name="arrival_date" value="{{ $new_arrival_date }}" hidden> --}}
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" id="submit" class="btn btn-success px-5 simpan" style="padding: 8px 16px;">
                                            Simpan Data
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
