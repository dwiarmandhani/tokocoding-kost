@extends('layouts.admin')

@section('title')
    Pengeluaran
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
                        <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Pengeluaran</a>
                        <a href="{{ route('pengeluaran-pdf') }}" class="btn btn-info mb-3" id="cetakPDF"><span i class="fas fa-print"></span> Unduh PDF</a>
                        <a href="{{ route('pengeluaran-excel') }}" class="btn btn-success mb-3" id="cetakExcel"><span i class="fas fa-print"></span> Unduh Excel</a>
                        <div class="table-responsive">
                        <table class="table table-bordered" id="table-1">
                            <thead>
                                <tr style="text-align:center;">
                                    <th scope="col" style="width:5%">
                                        No
                                    </th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col" style="width:15%">Nominal</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluarans as $index => $p)
                                <tr style="text-align:center">
                                    <td>{{ $index+1 }}</td>
                                    <td>
                                        <?php
                                            $date = new DateTime($p->tanggal);
                                            echo $date->format('d F Y');
                                        ?>
                                    </td>
                                    <td>{!! substr($p->deskripsi,0,20) !!} ..</td>
                                    <td>Rp{{ number_format($p->nominal,2,',','.') }}</td>
                                    <td>
                                        @if($p->foto != null)
                                            <img height="100px" src="{{ Storage::url($p->foto) }}" alt="" onclick="blank">
                                        @else
                                            <span class="badge badge-warning">Belum Upload</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('pengeluaran.destroy',$p->id) }}" method="POST">
                                            <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('pengeluaran.edit',$p->id) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $p->id }})">
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
                    url: "pengeluaran/" + id,
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
                                window.location.href = "pengeluaran/"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "pengeluaran/"
                    }
                });
            }
        })
    }
</script>
@endpush
