@extends('layouts.admin')

@section('title')
    Kamar
@endsection
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('izitoast/dist/css/iziToast.min.css') }}"> --}}
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
                        <a href="/admin/tipe/{{ $tipe_kamar->id }}/kamar/create" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Kamar</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-1">
                            <thead>
                                <tr style="text-align:center">
                                <th scope="col">
                                    No
                                </th>
                                <th scope="col">Tipe Kamar</th>
                                <th scope="col">Nomor Kamar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pemesan</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipe_kamar->kamars as $index => $kamar)
                                <tr style="text-align:center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $tipe_kamar->nama}}</td>
                                    <td>{{ $kamar->nomor_kamar }}</td>
                                    <td>
                                        @if($kamar->status == "Kosong")
                                        <span class="badge badge-success">Kosong</span>
                                        @elseif($kamar->status == "Dipesan")
                                        <span class="badge badge-warning">Dipesan</span>
                                        @else
                                        <span class="badge badge-danger">Disewa</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($kamar->bookings as $k)
                                        @if($kamar->status == "Dipesan")
                                        {{ $k->user->name }}
                                        @elseif($kamar->status == "Disewa")
                                        {{ $k->user->name }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="/admin/tipe/{{ $tipe_kamar->id }}/kamar/{{ $kamar->id }}" method="POST">
                                            @csrf
                                            <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="/admin/tipe/{{ $tipe_kamar->id }}/kamar/{{ $kamar->id }}/edit">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $kamar->id }})">
                                                <i class="far fa-trash-alt delete" style="color: white;"></i>
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

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    url: "/admin/tipe/{{ $tipe_kamar->id }}/kamar/" + id,
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil di hapus!',
                            icon: 'success',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/admin/tipe/{{ $tipe_kamar->id }}/kamar"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/tipe/{{ $tipe_kamar->id }}/kamar"
                    }
                });
            }
        })
    }
</script>
@endpush
