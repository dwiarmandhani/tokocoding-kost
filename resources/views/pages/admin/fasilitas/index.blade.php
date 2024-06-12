@extends('layouts.admin')

@section('title')
    Fasilitas
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
                        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary mb-3 btn-tambah" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Fasilitas</a>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="table-1" cellspacing="0" style="width: 100%">
                                <thead>
                                <tr style="text-align:center">
                                    <th scope="col"class="text-center" style="width: 5%">
                                    No
                                    </th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fasilitas as $index => $fas)
                                    <tr style="text-align: center">
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $fas->nama }}</td>
                                        <td>
                                            <img style="color:#aaa" height="24px" src="{{ Storage::url($fas->icon) }}" alt="">
                                        </td>
                                        <td>
                                            <form action="{{ route('fasilitas.destroy',$fas->id) }}" method="POST">
                                                @csrf
                                                <a href="{{ route('fasilitas.edit',$fas->id) }}" title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm btn-edit">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $fas->id }})">
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

    // $(".btn-edit").on('click',function(){
    //     let id = $(this).data('id')
    //     $.ajax({
    //         url: `fasilitas/${id}/edit`,
    //         method: "GET",
    //         success: function(data){
    //             $('#modal-edit').find('.modal-body').html(data)
    //             $('#modal-edit').modal('show')
    //         },
    //         error: function(error){
    //             console.log(error)
    //         }
    //     })
    // });

    // $(".btn-update").on('click',function(){
    //     let id = $('#form-edit').find('#id_fasilitas').val()
    //     let formData = $('#form-edit').serialize()
    //     $.ajax({
    //         url: `fasilitas/${id}`,
    //         method: "PUT",
    //         data: formData,
    //         success: function(data){
    //             // $('#modal-edit').find('.modal-body').html(data)
    //             $('#modal-edit').modal('hide')
    //             window.location.assign('fasilitas')
    //         },
    //         error: function(error){
    //             console.log(error)
    //         }
    //     })
    // });

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
                    url: `fasilitas/${id}`,
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
                                window.location.href = "fasilitas"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "fasilitas"
                    }
                });
            }
        })
    }
</script>
@endpush
{{-- <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah fasilitas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="facilitas_store" action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Fasilitas</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" autocomplete="off" placeholder="Masukkan Fasilitas"/>
                                @error('nama')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="required">Foto</label>
                                <input type="file" name="icon" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            {{-- @foreach ($fasilitas as $fas) --}}
            {{-- <form action="{{ route('fasilitas.update',$fas->id) }}" method="POST" enctype="multipart/form-data" id="form-edit">
                @method("PUT")
                @csrf
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-update">Simpan</button>
                </div>
            </form> --}}
            {{-- @endforeach --}}
        {{-- </div>
    </div>
</div> --}}
