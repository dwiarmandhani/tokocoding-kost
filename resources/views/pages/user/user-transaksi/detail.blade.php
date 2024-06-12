@extends('layouts.user')

@section('title')
    Detail Pemesanan
@endsection

<style type="text/css">

.inpFile {
    margin-left: 3rem;
    margin-top: 2rem;
    color: #000;
}
input[type="file"]{
    display: none;
}
.image-preview {
    width: 250px;
    min-height: 170px;
    border: 2px dashed #afeeee;
    margin-top: 15px;
    /* margin-left: 3em; */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #cccccc;
}
.image-preview__image{
    display: none;
    width: 100%;
}
.image-preview__default-text {
    color:#87ceeb;

}
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.required:after {
    content:" *";
    color: red;
}

</style>
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('user-transaksi') }}">Booking</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    @foreach ($transaction as $index => $tf)
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="300px">Status</td>
                                <td>
                                    @if($tf->status == "Menunggu")
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($tf->status == "Sukses")
                                        <span class="badge badge-success">Sukses</span>
                                    @elseif($tf->status == "Dibatalkan")
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Kode Pemesanan</td>
                                <td>
                                    {{ $tf->kode }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Total Harga</td>
                                <td>
                                    Rp {{ number_format($tf->total_harga,2,',','.') }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tanggal Pesan</td>
                                <td>
                                    <?php
                                        $date = new DateTime($tf->tanggal_pesan);
                                        echo $date->format('d F Y H:i:s');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Durasi</td>
                                <td>
                                    {{ $tf->durasi }} Bulan
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tanggal Masuk</td>
                                <td>
                                    <?php
                                        $date = new DateTime($tf->tanggal_masuk);
                                        echo $date->format('d F Y');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tanggal Keluar</td>
                                <td>
                                    <?php
                                        $date = new DateTime($tf->tanggal_keluar);
                                        echo $date->format('d F Y');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Tipe Kamar</td>
                                <td>
                                    {{ $tf->kamar->tipe_kamar->nama }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Nomor Kamar</td>
                                <td>
                                    {{ $tf->kamar->nomor_kamar }}
                                </td>
                            </tr>
                            <tr>
                                <td width="300px">Bukti Pembayaran <br>
                                    <small class="required">Pastikan mengunggah foto dengan benar</small>
                                </td>
                                <td>
                                    @if ($tf->bukti_pembayaran == null)
                                        <img src="{{ asset('assets/img/default.jpg') }}" width="200px" height="150px" alt=""
                                        style="display: block; margin-bottom:15px; margin-right:auto">
                                    @else
                                        <img id="img_ktp" src="{{ Storage::url($tf->bukti_pembayaran) }}" name="bukti_pembayaran" width="200px" height="250px" alt="foto"
                                        style="display: block; margin-bottom:15px; margin-right:auto">
                                    @endif
                                    @if($tf->status == "Menunggu" || $tf->status == "Dibatalkan")
                                    <a title="Upload Bukti" data-toggle="modal" data-target="#uploadBukti" data-placement="top" class="btn btn-success btn-lg edit">
                                        <i class="fas fa-upload" style="color: white;"> Upload Bukti</i>
                                    </a>
                                    @else
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                            <div class="justify-content-left">
                                <a href="{{ route('user-transaksi') }}" class="btn btn-info">Kembali</a>
                            </div>
                        </td>
                        </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @foreach ($transaction as $tf)
    <div class="modal fade" id="uploadBukti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="img">
            <form action="{{ route('user-transaksi-upload',$tf->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif
                    <div class="image-preview" id="imagePreview">
                        <img src="" alt="Image Preview" class="image-preview__image">
                            <span class="image-preview__default-text">
                            +</span>
                    </div>
                    <input type="file" name="bukti_pembayaran" id="inpFile">
                    <label for="inpFile" style="color: white;
                        height: 35px;
                        width: 105px;
                        background-color: #03a9f4;
                        position: absolute;
                        margin-left: 6em;
                        padding: 10px;
                        border-radius: 10px;
                        padding-top: 8px;
                        padding-left: 20px;
                        font-weight: lighter;
                        font-size: 12px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin-top: 1em;">
                    <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                        Pilih foto
                    </label>

                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
@push('addon-script')
<script>
    @if($errors->has('bukti_pembayaran'))
        $('#uploadBukti').modal({
            show: true
        });
    @endif
    $(function () {
        $("#bukti_pembayaran").change(function () {
            readURL(this);
        });
    });
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_ktp').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
