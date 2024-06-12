@extends('layouts.admin')

@section('title')
    Invoice
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin-dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align: center">
                            <th>
                            No
                            </th>
                            <th>Nama</th>
                            <th>No Kamar</th>
                            <th>Tipe</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Aksi</>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $index => $inv)
                            <tr style="text-align: center">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $inv->user->name }}</td>
                                <td>{{ $inv->room->room_number }}</td>
                                <td>{{ $inv->room->room_type->name }}</td>
                                <td>{{ $inv->arrival_date }}</td>
                                <td>{{ $inv->departure_date }}</td>
                                <td>
                                    <form action="{{ route('booking.destroy',$inv->id) }}" method="POST">
                                        <a title="Buat Invoice" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="/admin/invoice/{{ $inv->id }}">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="#">
                                            <i class="far fa-trash-alt" style="color: white;"></i>
                                        </a>
                                    </form>
                                </td>
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
