@extends('layouts.user')

@section('title')
    Data Pemesanan
@endsection

@section('content')
<style>
.required:after {
    content:" *";
    color: red;
}
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            <h6>{{$errors->first()}}</h6>
        </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-1">
                            <p class="required">Silakan unggah bukti pembayaran pada bagian detail </p>
                            <p class="required">Untuk memperpanjang sewa kamar, pilih tombol (+) akan muncul setelah status sukses </p>
                            {{-- @if ($transaction->count() > 0)
                            <a href="{{ route('lanjut-sewa') }}" class="btn btn-primary mb-3"><span i class="fas fa-plus"></span> Perpanjang Sewa</a>
                            @endif --}}
                            <thead>
                                <tr style="text-align: center">
                                    <th scope="col" style="width: 5px">
                                    No
                                    </th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Kamar</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Tanggal Keluar</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transaction as $tf)
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $tf->kode }}</td>
                                    <td><span class="badge badge-info">{{ $tf->kamar->tipe_kamar->nama }} ({{ $tf->kamar->nomor_kamar }})</span>
                                    </td>
                                    <td>
                                        <?php
                                            $date = new DateTime($tf->tanggal_masuk);
                                            echo $date->format('d F Y');
                                        ?>
                                        {{-- {{ $tf->tanggal_masuk }} --}}
                                    </td>
                                    <td>
                                        {{-- {{ $tf->tanggal_keluar }} --}}
                                        <?php
                                            $date = new DateTime($tf->tanggal_keluar);
                                            echo $date->format('d F Y');
                                        ?>
                                    </td>
                                    <td>Rp{{ number_format($tf->total_harga) }}</td>
                                    <td>
                                        @if($tf->status == "Menunggu")
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($tf->status == "Sukses")
                                            <span class="badge badge-success">Sukses</span>
                                        @elseif($tf->status == "Dibatalkan")
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tf->status == "Sukses")
                                            <a title="Invoice" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-sm" href="{{ route('user-invoice',$tf->id) }}">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </a>
                                            <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" href="{{ route('user-transaksi-detail',$tf->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <a title="Perpanjang Sewa" data-toggle="tooltip" data-placement="top" href="{{ route('perpanjang-sewa',$tf->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            @elseif($tf->status == "Dibatalkan")
                                            <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" href="{{ route('user-transaksi-detail',$tf->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            @else
                                        <form action="{{ route('user-transaksi-cancel',$tf->id) }} method="POST" enctype="multipart/form-data"">
                                            @csrf
                                            @method('PUT')
                                            <a title="Invoice" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-sm" href="{{ route('user-invoice',$tf->id) }}">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </a>
                                            <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" href="{{ route('user-transaksi-detail',$tf->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                            <button value="Dibatalkan" type="submit" title="Batalkan" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm" onclick="return confirm('Anda ingin membatalkan pemesanan kamar ini ?')">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endif
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
<script src="{{ url('/assets/js/page/bootstrap-modal.js') }}"></script>
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            responsive: true,
            "language":{
                "emptyTable": "Tidak ada data yang ditampilkan"
            }
        });
    } );


    const inpFile = document.getElementById("inpFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

    inpFile.addEventListener("change", function(){

        const file = this.files[0];

        if (file){
            const reader = new FileReader();

            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";

            reader.addEventListener("load", function(){

                previewImage.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);
        }else {
            previewDefaultText.style.display = null;
            previewImage.style.display = null;
            previewImage.setAttribute("src", "");
        }
    });

    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }
</script>
@endpush
