@extends('layouts.admin')

@section('title')
    Data User Aktif
@endsection

@push('addon-style')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
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
                            <a href="{{ route('buat-user') }}" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Buat User</a>
                            <div class="table-responsive">
                        @include('pages.admin.user.navbarr')
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align:center">
                            <th class="text-center" scope="col">
                            #
                            </th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr style="text-align: center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_hp }}</td>
                                    <td>
                                        @if($user->status == 1)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('nonaktifkan-user',$user->id) }}" method="POST" enctype="multipart/form-data" style="display:inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button value="0" type="submit" title="Nonaktifkan" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-sm" onclick="return confirm('Anda ingin menonaktifkan user ini ?')">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input style="display:none" value="0" id="status"
                                            name="status"></input>
                                            <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('detail-user',$user->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </form>
                                        <form action="{{ route('delete-user',$user->id) }}" method="POST" enctype="multipart/form-data" style="display:inline-block">
                                            @method('DELETE')
                                            @csrf
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $user->id }})">
                                            <i class="far fa-trash-alt" style="color: white;"></i>
                                        </a>
                                        {{-- <button ty class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="return confirm('Anda yakin mau menonaktifkan siswa?')">
                                            <i class="fas fa-times" style="color: white;"></i>
                                        </button> --}}
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
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            responsive: true,
            "language":{
                "emptyTable": "Tidak ada data yang ditampilkan"
            }
        });
    } );

    $(document).ready( function () {
        $('.toggle-class').on('change',function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            console.log(status);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/user/changeStatus',
                data: {'status': status, 'id': id},
                success: function(data){
                console.log(data.success)
                }
            });
        })
    })

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda akan menghapus user!",
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
                    url: "user/" + id,
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
                                window.location.href = "user"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "user"
                    }
                });
            }
        })
    }
</script>
@endpush
