@extends('layouts.admin')

@section('title')
    Tipe Kamar
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
                <div class="card-body" style="overflow-x:auto;">
                    <a href="{{ route('tipe.create') }}" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Tipe Kamar</a>
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align:center">
                            <th scope="col" style="width: 5px" class="text-center">
                            No
                            </th>
                            <th scope="col">Nama</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Lantai</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Kamar Kosong</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipe_kamars as $index => $tipe)
                                <tr style="text-align:center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $tipe->nama }}</td>
                                    <td>
                                        <img height="100px" src="{{ Storage::url($tipe->galeri->first()->foto ?? '') }}" alt="">
                                    </td>
                                    <td>{{ $tipe->lantai }}</td>
                                    <td>Rp{{ number_format($tipe->harga,2,',','.') }}</td>
                                    <td>{{ $tipe->ukuran }}</td>
                                    <td>
                                        @php $arrayTipe = array(); @endphp
                                        @foreach ($tipe->kamars->where('status',"Kosong") as $t)
                                            @php $arrayTipe[] = $t @endphp

                                        @endforeach
                                        @php $jum = count($arrayTipe); @endphp
                                        {{ $jum }}
                                    </td>
                                    <td>
                                        <form action="/admin/tipe/{{ $tipe->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('tipe.edit', $tipe->id) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a title="manage kamar" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm edit" href="/admin/tipe/{{ $tipe->id }}/kamar"  >
                                                <i class="fas fa-bed"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $tipe->id }})">
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
                    url: "tipe/" + id,
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
                                window.location.href = "tipe/"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "tipe/"
                    }
                });
            }
        })
    }
</script>
@endpush
