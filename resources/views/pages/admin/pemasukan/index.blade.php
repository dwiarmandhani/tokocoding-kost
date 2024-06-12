@extends('layouts.admin')

@section('title')
    Pemasukan
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body">
                    {{-- <form action="pemasukan" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="from" name="from" value="old('from')">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="to" name="to" value="old('to')">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="search">Filter</button>
                        <button type="submit" class="btn btn-success" name="exportPDF">Cetak PDF</button>
                    </form> --}}
                    <a href="{{ route('pemasukan-pdf') }}" class="btn btn-info mb-3" id="cetakPDF"><span i class="fas fa-print"></span> Unduh PDF</a>
                    <a href="{{ route('pemasukan-excel') }}" class="btn btn-success mb-3" id="cetakExcel"><span i class="fas fa-print"></span> Unduh Excel</a>
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align:center">
                            <th style="width: 10px" class="text-center" scope="col">
                            No
                            </th>
                            <th scope="col">Kode Pemesanan</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Pemasukan</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanans as $index => $tf)
                                <tr style="text-align:center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $tf->kode }}</td>
                                    <td>{{ $tf->user->name }}</td>
                                    <td>
                                        <?php
                                            $date = new DateTime($tf->tanggal_pesan);
                                            echo $date->format('d F Y h:i:s');
                                        ?>
                                    </td>
                                    <td>Rp {{ number_format($tf->total_harga,2,',','.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            responsive: true,
            "language":{
                "emptyTable": "Tidak ada data yang ditampilkan"
            }
        });
    } );
</script>
@endpush
