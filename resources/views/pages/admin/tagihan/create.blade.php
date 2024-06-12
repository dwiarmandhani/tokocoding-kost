@extends('layouts.admin')

@section('title')
    Buat Tagihan Sewa
@endsection

@section('content')
<style>
         .inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
input[type="file"]{
    display: none;
}
.inputfile + label {
    color: white;
    font: 500 1.5rem/1.5rem Poppins, sans-serif;
    background-color: black;
    display: inline-block;
    margin-left: 3rem;
    margin-top: 2rem;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: red;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
.inputfile:focus + label,
.inputfile.has-focus + label {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;
}
.image-preview {
    width: 225px;
    min-height: 150px;
    border: 2px dashed #afeeee;
    margin-top: 15px;
    margin-left: 3em;
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
.inpFile {
    margin-left: 3rem;
    margin-top: 2rem;
    color: #000;
}
input[type="file"]{
    display: none;
}
/* label {
    color: white;
    height: 35px;
    width: 105px;
    background-color: #03a9f4;
    position: absolute;
    margin-left: 8.5em;
    padding: 10px;
    border-radius: 10px;
    padding-top: 8px;
    padding-left: 20px;
    font-weight: lighter;
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1em;
} */
label:hover {
    opacity: 80%;
}
.required:after {
    content:" *";
    color: red;
}
@media (max-width: 427px) {
    .tombol .btn.simpan {
        margin-bottom: 10px;
    }
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

        <div class="section-body">
            <div class="row">
                <div class="col-12">
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
                        <h4>@yield('title')</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store-tagihan',$transaction->id) }}" id="form-sewa" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="transaction" value="{{ $transaction }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Nama</label>
                                    <input type="text" name="nama" value="{{ $transaction->user->name }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Kamar</label>
                                    <input type="text" name="numeric" id="nomor_kamar" class="form-control" value="{{ $transaction->kamar->nomor_kamar }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Durasi</label>
                                    <select name="durasi" id="durasi" class="form-control">
                                        <option value="1">1 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="12">1 Tahun</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Harga</label>
                                    <input type="hidden" name="total" id="total" value="{{ $tipe_kamar->harga }}">
                                    <input type="text" name="total_harga" id="total_harga" class="form-control" readonly value="{{ number_format($tipe_kamar->harga) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary px-5" style="padding: 8px 16px">
                                    Simpan Data
                                </button>
                                <a href="{{ route('sukses') }}" class="btn btn-danger px-5" style="padding: 8px 16px; margin-left:10px;">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('addon-script')
<script>
    let harga = {!! $tipe_kamar->harga !!}
    let selectedDuration = $("#durasi");
    selectedDuration.on('change', (event) => {
        let durasi = event.target.value;
        let total = updatePrice(durasi, harga);

        $("#total").val(total);
        $("#total_harga").val(total.toLocaleString());
    })

    function updatePrice(durasi, harga) {
        let total_harga = 0 ;

        if (durasi == 1){
            total_harga = durasi * harga;
        } else if (durasi == 6){
            total_harga = durasi * harga - (0.5 * harga);
        } else if(durasi == 12){
            total_harga = durasi * harga - (1 * harga);
        }
        return total_harga;
    }

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
</script>
@endpush
