@extends('layouts.fe')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('fe/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/owl.carousel.min.css') }}">
@endpush

@section('title')
    Kost KIta
@endsection

@section('content')
<style type="text/css">


#owl-image .item{
    margin: 3px;
    }
#owl-image .item img{
    display: block;
    width: 100%;
    height: auto;
}
.owl-carousel .owl-dots button:focus {
    box-shadow: none !important;
    outline: 0;
}

.testi-carousel .owl-stage-outer {
    padding: 50px 0;
}

.testi-carousel .owl-item {
    overflow: hidden;
}

.testi-carousel__item {
    background: #f7f9f9;
    padding: 30px 25px;
    transition: all .3s ease;
}
.testi-carousel__item .media-body p {
    margin-bottom: 12px; }
.testi-carousel__item::after {
    content: '';
    width: 0;
    height: 0;
    position: absolute;
    left: 0;
    bottom: 0;
    border-bottom: 15px solid #ffffff;
    border-left: 500px solid rgba(255, 255, 255, 0.13);
    /* Maintain smooth edge of triangle in FF */
    -moz-transform: scale(0.9999); }
.testi-carousel__item:hover {
    box-shadow: 0px 10px 20px 0px rgba(153, 153, 153, 0.2);
    background: #fff; }

.testi-carousel__img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    margin-right: 20px; }

.testi-carousel__intro h3 {
    font-size: 24px;
    font-weight: 400;
    margin-bottom: 5px; }

.testi-carousel__intro p {
    font-size: 14px;
    color: #999999; }

.testi-carousel .owl-dots .owl-dot span {
    background: #CACCCF; }

.testi-carousel .owl-dots .owl-dot.active span {
    width: 12px;
    height: 12px;
    background: #6777EF; }

    .client-avater {
  margin-bottom: 20px;
}

.testimonail-section .title-text {
    padding-top: 5rem;
    margin-bottom: 3rem;
}

.testimonail-section .text-title {
    font: 600 2.25rem/2.5rem Poppins, sans-serif;
    color: #121212;
    margin-bottom: 0.625rem;
}

.testimonail-section .text-caption{
    font: 400 1rem/1.75rem Poppins, sans-serif;
    letter-spacing: 0.025em;
    color: #565656;
}
.client-meta h3 {
  font-size: 20px;
  font-weight: 600;
}
.client-meta span {
    display: block;
    font-size: 70%;
    margin-top: 10px;
    color: $text-color;
    font-weight: 600;
    opacity: 0.5;
  }

p.testimonial-body {
  font-size: 17px;
  font-style: italic;
  font-family: 'Poppins', sans-serif;
  width: 700px;
  margin: 0 auto;
  line-height: 1.8;
  color: $text-color-light;
  margin-top: 20px;
}

.last-icon {
  margin-top: 20px;
  font-size: 25px;
  opacity: 0.3;
  margin-bottom: 3rem;
}

.client-avater img {
  max-width: 100px;
  border-radius: 50%;
  margin: 0 auto;
}
</style>
{{-- Hero --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="beranda" data-aos="fade-down" data-aos-delay="100">
    <div class="container-xxl mx-auto p-0  position-relative header-2-2" style="font-family: 'Poppins', sans-serif">
    <div>
        <div class="mx-auto d-flex flex-lg-row flex-column hero">
            <!-- Left Column -->
            <div
                class="left-column d-flex flex-lg-grow-1 flex-column align-items-lg-start text-lg-start align-items-center text-center">
                <h1 class="title-text-big">
                Ingin Punya<br class="d-lg-block d-none" />
                Kamar Kost Yang Nyaman
                </h1>
                <p>Kost KIta merupakan kost <strong>putri</strong> yang nyaman dan bersih. Bagi kamu yang ingin mendapat suasana tersebut, Ayo segera miliki kamar di sini.</p>
                <div class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                <a href="#kamar" class="btn d-inline-flex mb-md-0 btn-try text-white">
                    Pilih Kamar
                </a>
                @guest
                <a href="{{ route('register') }}" class="btn btn-outline">
                    <div class="d-flex align-items-center">
                        Daftar
                    </div>
                </a>
                @endguest
                </div>
            </div>
            <!-- Right Column -->
            <div class="right-column text-center d-flex justify-content-center pe-0">
                <img id="img-fluid" class="h-auto mw-100"
                src="{{ asset('fe/img/hero.png') }}"
                alt="" />
            </div>
        </div>
    </div>
    </div>
</section>

{{-- Fasilitas --}}
<section class="h-100 w-100" style="box-sizing: border-box; background-color: #f2f6ff" data-aos="fade-up">
    <div class="content-3-7 overflow-hidden container-xxl mx-auto position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="container mx-auto">
            <div class="d-flex flex-column text-center w-100" style="margin-bottom: 2.25rem">
            <h2 class="title-text">Fasilitas dan Peraturan Kost</h2>
            <p class="caption-text mx-auto">
                Berikut ini adalah fasilitas umum kost<br />
                dan kamar tersedia beserta peraturan kost
            </p>
            </div>
            <div class="d-flex flex-wrap">
            <div class="mx-auto card-item position-relative">
                <div class="card-item-outline bg-white d-flex flex-column position-relative overflow-hidden h-100">
                <h2 class="price-title">Fasilitas</h2>
                <p class="price-caption">
                    Fasilitas bersama<br />
                    untuk penghuni kos
                </p>
                <div class="price-list">
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Wifi
                    </p>
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Tempat Parkir
                    </p>
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Dapur Bersama
                    </p>
                    <p class="d-flex align-items-center check">
                        <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Ruang Tamu
                    </p>
                </div>
                </div>
            </div>
            <div class="mx-auto card-item position-relative">
                <div class="card-item-outline bg-white d-flex flex-column position-relative overflow-hidden h-100">
                <h2 class="price-title">Kamar Tersedia</h2>
                <p class="price-mulai">
                    Harga Mulai
                </p>
                <h2 class="price-value d-flex align-items-center">
                    <span>Rp300.000 </span>
                    <span class="price-duration">/Bulan</span>
                </h2>
                <div class="price-list">
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>{{ $kamar }} Kamar Tersedia
                    </p>
                    <p class="d-flex align-items-center no-check">
                        <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                            src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-3.png"
                            alt="" /> </span>dari {{ $kam }} Total Kamar
                    </p>
                </div>
                </div>
            </div>
            <div class="mx-auto card-item position-relative">
                <div class="card-item-outline bg-white d-flex flex-column position-relative overflow-hidden h-100">
                <h2 class="price-title">Peraturan</h2>
                <p class="price-caption">
                    Beberapa peraturan yang<br />
                    harus ditaati penghuni
                </p>
                <div class="price-list">
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span><strong>Kost Khusus Putri</strong>
                    </p>
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Tamu lawan jenis di ruang tamu
                    </p>
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Wajib mematuhi jam malam
                    </p>
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Memarkir kendaraan dengan rapi
                    </p>
                    <p class="d-flex align-items-center check">
                    <span class="span-icon d-inline-flex align-items-center justify-content-center flex-shrink-0">
                        <img class="img-fluid"
                        src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-4.png"
                        alt="" /> </span>Menjaga kebersihan kost
                    </p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

{{-- Review --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box id="review" data-aos="fade-up">
<div class="testimonail-section container-xxl mx-auto p-0  position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="text-center title-text">
                    <h1 class="text-title">Review Kost</h1>
                    <p class="text-caption">Berikut review dari mereka</p>
                </div>
                <div class="testimonial-sliders owl-carousel featured-carousel owl-theme">
                    @foreach ($reviews as $r)
                    <div class="single-testimonial-slider">
                        <div class="client-avater">
                            @if($r->booking->user->avatar)
                                <img src="{{ Storage::url($r->booking->user->avatar)}}" width="100px" height="100px" style="rounded-circle mt-5" alt="">
                            @else
                                <img src="{{asset('/assets/img/avatar/avatar-4.png')}}" width="100px" height="100px" style="rounded-circle mt-5" alt="">
                            @endif
                        </div>
                        <div class="client-meta">
                            <h3>{{ $r->booking->user->name }} <span>{{ $r->booking->user->pekerjaan }}</span></h3>
                            <p class="testimonial-body">
                                "{{ $r->review }}"
                            </p>
                            <div class="last-icon">
                                <i class="fas fa-quote-right"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- end testimonail-section -->
{{-- <section class="h-100 w-100 bg-white" style="box-sizing: border-box id="review" data-aos="fade-up">
    <div class="review container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Review Kost</h1>
            <p class="text-caption">Berikut review dari mereka</p>
        </div>
        <div class="container" style="margin-top: 4rem">
            <div class="row">
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($reviews as $r)
                    <div class="item">
                        <h3 class="review-title text-center">
                            {{ $r->review }}</h3>
                        <h4 class="review-caption text-center" style="opacity: 0.5">
                            {{ $r->booking->user->name }}
                        </h4>
                        <h6 class="review-caption text-center">
                            {{ $r->booking->user->pekerjaan }}
                        </h6>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- Room --}}
<section class="h-100 w-100" style="box-sizing: border-box" id="kamar" data-aos="fade-up">
    <div class="content-2-2 container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Pilihan Kamar Kost</h1>
            <p class="text-caption" style="margin-left: 3rem; margin-right: 3rem">
                Setiap kamar kost memiliki harga yang berbeda
            </p>
        </div>

        <div class="grid-padding text-center">
            <div class="row">
                @php $incrementTipeKamar = 0 @endphp
                @forelse ($tipe_kamars as $tipe_kamar)
                <div class="col-lg-4 column">
                    <div class="card card-explore">
                    <div class="card-explore__img">
                        <img class="card-img" src="{{ Storage::url($tipe_kamar->galeri->first()->foto ?? '') }}"
                        alt="" height="200px" width="150px" />
                    </div>
                    <div class="card-body">
                        <div class="row" style="text-align: left">
                            <h3 class="room-title">{{ $tipe_kamar->nama }}</h3>
                            <p class="room-price">Lantai : {{$tipe_kamar->lantai}}</p>
                            <p class="room-price">Jumlah kamar kosong :
                                @php $arrayTipe = array(); @endphp
                                @foreach ($tipe_kamar->kamars->where('status',"Kosong") as $t)
                                    @php $arrayTipe[] = $t @endphp

                                @endforeach
                                @php $jum = count($arrayTipe); @endphp
                                {{ $jum }}</p>
                            <p class="room-price">Rp {{number_format($tipe_kamar->harga)}}/bulan</p>
                        </div>
                        <a href="{{ route('detail-kost',$tipe_kamar->id) }}" class="btn btn-fill text-white d-block">Pilih Kamar</a>
                    </div>
                    </div>
                </div>
                @empty
                    <p>Tidak ada Kamar</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- Pembayaran --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box; margin-bottom: 3rem" data-aos="fade-up">
    <div class="content-4-2 container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Cara Pembayaran</h1>
            <p class="text-caption" style="margin-left: 3rem; margin-right: 3rem">
                Tata Cara Pembayaran Melalui Website
            </p>
        </div>

        <div class="grid-padding text-center" style="margin-top: 2rem">
        <div class="row">
            <div class="col-lg-4 column">
            <div class="icon">
                <img src="{{ asset('fe/img/login.png') }}" style="width:200px; height:200px"
                alt="" />
            </div>
            <h3 class="icon-title">Pendaftaran Akun</h3>
            <p class="icon-caption">
                Anda perlu mendaftar<br />
                ke dalam sistem
            </p>
            </div>
            <div class="col-lg-4 column">
            <div class="icon">
                <img src="{{ asset('fe/img/payment.png') }}" style="width:200px; height:200px"
                alt="" />
            </div>
            <h3 class="icon-title">Transaksi</h3>
            <p class="icon-caption">
                Anda melakukan pemesanan kamar kemudian mengunggah bukti pembayaran
            </p>
            </div>
            <div class="col-lg-4 column">
            <div class="icon">
                <img src="{{ asset('fe/img/confirm.png') }}" style="width:200px; height:200px"
                alt="" />
            </div>
            <h3 class="icon-title">Konfirmasi</h3>
            <p class="icon-caption">
                Pemesanan anda akan dikonfirmasi Admin<br/>
            </p>
            </div>
        </div>
        </div>
    </div>
</section>

@endsection
@push('after-script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script> --}}
<script src="{{ asset('fe/js/owl.carousel.js') }}"></script>
<script src="{{ asset('fe/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#owl-image").owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true, //Set AutoPlay to 3 seconds
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true,
            },
            600:{
                items:3,
                nav:true,
            },
            1000:{
                items:1,
                nav:true,
            }
        }
    });
});
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
})
</script>
@endpush
