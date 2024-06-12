@extends('layouts.fe')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('fe/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/owl.carousel.min.css') }}">
@endpush

@section('title')
    Detail Kamar
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.min.css" integrity="sha512-9h7XRlUeUwcHUf9bNiWSTO9ovOWFELxTlViP801e5BbwNJ5ir9ua6L20tEroWZdm+HFBAWBLx2qH4l4QHHlRyg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css" integrity="sha512-+0Vhbu8sRUlg+R/NKgTv7ahM+szPDF10G6J5PcHb1tOrAaquZIUiKUV3TH16mi6fuH4NjvHqlok6ppBhR6Nxuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style type="text/css">

#owl-image .item{
    margin: 3px;
    }
#owl-image .item img{
    display: block;
    /* width: 100%;
    height: auto; */
}
.btn-fill{
    background-color: #F6DB80;
    border-radius: 12px;
    padding: 12px 28px;
    transition: 0.3s;
}
p.pfield-wrapper input {
  float: right;
}
p.pfield-wrapper::after {
  content: "\00a0\00a0 "; /* keeps spacing consistent */
  float: right;
}
p.required-field::after {
  content: "*";
  float: right;
  margin-left: -3%;
  color: red;
}
.r1 {
    border-right: 1px solid #d1d1d1;
}
.facility {
    /*width: 30%;*/
    float: left;
    /* padding: 10px; */
}
</style>
<section class="h-100 w-100 bg-white pb-5" style="box-sizing: border-box" data-aos="fade-up" data-aos-delay="100">
    <div class="detail-1 container mx-auto p-0  position-relative detail-content" style="font-family: 'Poppins', sans-serif">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" style="text-decoration: none;color:#0c0d36;font-weight: 300;">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </nav>
        </div>

        <div class="kost-gallery mt-3" id="gallery">
            <div class="container">
                <div class="row">
                    @php $incrementTipeKamar = 0 @endphp
                    @foreach ($tipe_kamars as $tipe_kamar)
                    <div class="col-lg-8">
                        <div class="owl-carousel featured-carousel owl-theme">
                        @foreach ($tipe_kamar->galeri as $galerii)
                            <img class="owl-image" style="width: 100%; height:500px;" src="{{Storage::url($galerii->foto) }}" alt="">
                        @endforeach
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-4">
                        <div class="card-body shadow-lg p-3 mb-5 bg-white rounded">
                            <form action="{{ route('confirmation',$tipe_kamar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="booking_validation" type="hidden" value="0">
                            <div class="price mb-2"> <strong style="font-size: 20px"> Rp {{ number_format($tipe_kamar->harga) }} </strong>/Bulan</div>
                            <div class="form-group" style="margin-bottom: 0.5rem">
                                <label for="date" style="margin-bottom: 0.5rem; font-family: poppins">Pilih tanggal masuk</label>
                                <div class="input-group mb-2">
                                        <input type="text" style="background-color: white" data-provide="datepicker" class="form-control" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal Masuk" value="" readonly="">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 10px">
                                <label for="durasi" style="margin-bottom: 0.5rem">Durasi Sewa</label>
                                <select name="durasi" id="durasi" class="form-select">
                                    <option value="1">1 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">1 Tahun</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" style="margin-bottom: 0.5rem">Total Harga</label>
                                    <input type="hidden" name="total" id="total" value="{{ $tipe_kamar->harga }}">
                                    <input type="text" style="background-color:#f2f2f0" name="total_harga" id="total_harga" class="form-control" readonly value="{{ number_format($tipe_kamar->harga,2,',','.') }}">
                            </div>
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                            @endif
                            <br>
                            @auth
                            <button type="submit" class="btn btn-fill px-5 text-white btn-block mb-3" style="width: 100%">
                                Pesan Kamar
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-danger px-5 text-white btn-block mb-3" style="width: 100%; border-radius: 12px;
                            padding: 12px 28px;">
                                Masuk Untuk Pesan
                            </a>
                            @endauth
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kost-detail mb-4">
            <section class="kost-heading">
                <div class="container">
                    <div class="row">
                        @php
                        $incrementRoomTypes = 0
                        @endphp
                        @foreach ($tipe_kamars as $tipe_kamar)
                        <div class="col-lg-3">
                            <h5 style="color:#F6DB80">Tipe Kamar</h5>
                                <input type="hidden" name="id" value="{{ $tipe_kamar->kamar }}">
                                <div class="owner" style="margin-bottom: 0.5rem">{{ $tipe_kamar->nama }}</div>
                        </div>
                        <div class="col-lg-3">
                                <h5 style="color:#F6DB80">Deskripsi</h5>
                                <p>Berada di lantai {{ $tipe_kamar->lantai }} dan memiliki ukuran kamar {{ $tipe_kamar->ukuran }} </p>
                        </div>
                        <div class="col-lg-8">
                        <h5 style="color:#F6DB80">Fasilitas</h5>
                        @foreach ($tipe_kamar->fasilitas->chunk(3) as $facilityy)
                            @php $incrementRoomType = 0 @endphp
                            @forelse ($facilityy as $facility)
                            <div class="facility col-md-3">
                                <img style="float:left; margin-right: 10px; opacity:0.5; color: #F6DB80;" src="{{ Storage::url($facility->icon) }}" height="24pxs" alt="">
                                <p style="margin-right: 5px;">{{ $facility->nama }}</p>
                            </div>
                            @empty
                            <div class="col-12 text-left">
                                Tida ada fasilitas
                            </div>
                            @endforelse
                        @endforeach
                    </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

{{-- Cek Profil --}}
@if(Auth::check() && !Auth::user()->foto_ktp)
<div id="myModal" class="modal fade hide fade in" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: red">Data diri belum lengkap</h5>
            </div>
            <div class="modal-body">
                <p>Untuk melakukan pemesanan kamar, Anda perlu melengkapi data diri terlebih dahulu. <br>
                    Silakan lengkapi data diri anda pada halaman profil.
                </p>
            </div>
            <div class="modal-footer">
                <a href={{ route('home') }} class="btn btn-success">Halaman utama</a>
                <a href={{ route('profil-user') }} class="btn btn-danger">Buka Profil</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@push('after-script')
<script src="{{ asset('fe/js/owl.carousel.js') }}"></script>
<script src="{{ asset('fe/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript">
    $('.featured-carousel').owlCarousel({
    loop:true,
    // margin:20,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true,
        },
        600:{
            items:1,
            nav:true,
        },
        1000:{
            items:1,
            nav:true,
        }
    }
    });

    $('#myModal').modal('show');

    $(function () {
        var $dp1 = $("#tanggal_masuk");
        $(document).ready(function () {

            $dp1.datepicker({
            changeYear: true,
            changeMonth: true,
                minDate: '0',
                maxDate: '2m',
            dateFormat: "yy-mm-dd",
            yearRange: "-100:+20",
            });
        });
    });
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
</script>
@endpush
