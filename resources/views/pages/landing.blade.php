@extends('layouts.fe')

@section('title')
    Kost KIta
@endsection

@section('content')
<style>
    .owl-carousel .owl-dots button:focus {
  box-shadow: none !important;
  outline: 0; }

    .testi-carousel .owl-stage-outer {
  padding: 50px 0; }

.testi-carousel .owl-item {
  overflow: hidden; }

.testi-carousel__item {
  background: #f7f9f9;
  padding: 30px 25px;
  transition: all .3s ease; }
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
  background: #cacccf; }

.testi-carousel .owl-dots .owl-dot.active span {
  width: 12px;
  height: 12px;
  background: #6777EF; }
</style>
{{-- Hero --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="beranda">
    <div class="container-xxl mx-auto p-0  position-relative header-2-2" style="font-family: 'Poppins', sans-serif">
    <div>
        <div class="mx-auto d-flex flex-lg-row flex-column hero">
            <!-- Left Column -->
            <div
                class="left-column d-flex flex-lg-grow-1 flex-column align-items-lg-start text-lg-start align-items-center text-center">
                <h1 class="title-text-big">
                Punya Impian<br class="d-lg-block d-none" />
                Kamar Kost Yang Nyaman
                </h1>
                <p>Kost KIta merupakan kost <strong>putri</strong> yang nyaman dan bersih. Bagi kamu yang ingin mendapat suasana tersebut, Ayo segera miliki kamar di sini.</p>
                <div class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                <a href="#kamar" class="btn d-inline-flex mb-md-0 btn-try text-white">
                    Pesan Kamar
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

{{-- Benefit --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="benefit" data-aos="fade-up">
    <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="d-flex flex-lg-row flex-column align-items-center">
        <!-- Left Column -->
        <div class="img-hero text-center justify-content-center d-flex">
            <img id="hero" class="img-fluid"
            src="{{ asset('fe/img/Home-search.png') }}"
            alt="" />
        </div>

        <!-- Right Column -->
        <div class="right-column d-flex flex-column align-items-lg-start align-items-center text-lg-start text-center">
            <h2 class="title-text">3 Keuntungan Kost di Sini</h2>
            <ul style="padding: 0; margin: 0">
            <li class="list-unstyled" style="margin-bottom: 2rem">
                <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    1
                </span>
                Harga Terjangkau
                </h4>
                <p class="text-caption">
                Dengan harga yang terjangkau<br class="d-sm-inline d-none" />
                sudah bisa merasakan fasilitas yang cukup.
                </p>
            </li>
            <li class="list-unstyled" style="margin-bottom: 2rem">
                <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    2
                </span>
                Lokasi Strategis
                </h4>
                <p class="text-caption">
                Lokasi yang strategis memudahkan kamu untuk<br class="d-sm-inline d-none" />
                mencari makan, kuliah, belanja kebutuhan sehari-hari.
                </p>
            </li>
            <li class="list-unstyled" style="margin-bottom: 4rem">
                <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    3
                </span>
                Suasana nyaman
                </h4>
                <p class="text-caption">
                Meskipun dekat dengan kampus mahasiswa<br class="d-sm-inline d-none" />
                kost ini masih memiliki suasana nyaman.
                </p>
            </li>
            </ul>
        </div>
        </div>
    </div>
</section>

{{-- Review --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box;margin-top: 3rem" id="review" data-aos="fade-down">
    <div class="review container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Review Kost</h1>
            <p>Berikut review dari mereka</p>
        </div>
        <div class="container" style="margin-top: 4rem">
            <div class="row">
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($reviews as $r)
                    <div class="item">
                        <h3 class="review-title text-center" style="opacity: 0.5">
                            {{ $r->review }}</h3>
                        <h4 class="review-caption text-center">
                            {{ $r->user->name }}
                        </h4>
                        <h6 class="review-caption text-center">
                            {{ $r->user->profession }}
                        </h6>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <a class="nav-link button4" role="button" data-toggle="collapse" href="#bni"
                            style="margin-buttom:10px; text-align:left">
                            <img src="https://bimbel.ruangguru.com/hubfs/BNI.png"
                                style="width:55px; margin-bottom: 10px;margin-top: 10px;">
                            <br>Bank Transfer BNI
                        </a>
                        <div class="collapse" id="bni">
                            <ol style="text-align:left;margin-left:10%; color: #4a4a4a">
                                <li>1. Masukkan kartu pilih <b>bahasa</b>, dan masukkan PIN
                                    Anda.</li>
                                <li>2. Pada menu utama, pilih <b>Transaksi Lainnya.</b></li>
                                <li>3. Pilih <b>Transfer</b> dan pilih <b>ke rekening BNI.</b>
                                </li>
                                <li>4. Masukkan nominal transfer sesuai dengan total tagihan
                                    transaksi di aplikasi Inofa Bimbel <b>ke no rek 585420531
                                        a.n Muhammad Dzakwan Zaky.</b></li>
                                <li>5. <b>Simpan bukti pembayaran dan unggah bukti </b>pada
                                    halaman yang tersedia di Inofa Bimbel.</li>
                            </ol>
                        </div>
</section>

{{-- Room --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="kamar" data-aos="fade-down">
    <div class="content-2-2 container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Pilihan Kamar Kost</h1>
            <p class="text-caption" style="margin-left: 3rem; margin-right: 3rem">
                Setiap kamar kost memiliki harga yang berbeda
            </p>
        </div>

        <div class="grid-padding text-center">
            <div class="row">
                @php $incrementRoomType = 0 @endphp
                @forelse ($room_types as $room_type)
                <div class="col-lg-4 column">
                    <div class="card card-explore">
                    <div class="card-explore__img">
                        <img class="card-img" src="{{ Storage::url($room_type->photo) }}"
                        alt="" />
                    </div>
                    <div class="card-body">
                        <h3 class="room-title">{{ $room_type->name }}</h3>
                        <p class="room-price">Rp {{number_format($room_type->price)}}/bulan</p>
                        <a href="{{ route('detail-kost',$room_type->id) }}" class="btn btn-fill text-white">Pesan Kamar</a>
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
            <h3 class="icon-title">Registrasi Akun</h3>
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
                Anda melakukan pemesanan kamar
            </p>
            </div>
            <div class="col-lg-4 column">
            <div class="icon">
                <img src="{{ asset('fe/img/confirm.png') }}" style="width:200px; height:200px"
                alt="" />
            </div>
            <h3 class="icon-title">Konfirmasi</h3>
            <p class="icon-caption">
                Pesan anda akan dikonfirmasi Admin<br />
                Anda bisa menempati kamar kost
            </p>
            </div>
        </div>
        </div>
    </div>
</section>

{{-- Review --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box;margin-top: 3rem" id="review" data-aos="fade-down">
    <div class="review container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Review Kost</h1>
            <p>Berikut review dari mereka</p>
        </div>
        <div class="container" style="margin-top: 4rem">
            <div class="row">
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($reviews as $r)
                    <div class="item">
                        <h3 class="review-title text-center" style="opacity: 0.5">
                            {{ $r->review }}</h3>
                        <h4 class="review-caption text-center">
                            {{ $r->user->name }}
                        </h4>
                        <h6 class="review-caption text-center">
                            {{ $r->user->profession }}
                        </h6>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <a class="nav-link button4" role="button" data-toggle="collapse" href="#bni"
                            style="margin-buttom:10px; text-align:left">
                            <img src="https://bimbel.ruangguru.com/hubfs/BNI.png"
                                style="width:55px; margin-bottom: 10px;margin-top: 10px;">
                            <br>Bank Transfer BNI
                        </a>
                        <div class="collapse" id="bni">
                            <ol style="text-align:left;margin-left:10%; color: #4a4a4a">
                                <li>1. Masukkan kartu pilih <b>bahasa</b>, dan masukkan PIN
                                    Anda.</li>
                                <li>2. Pada menu utama, pilih <b>Transaksi Lainnya.</b></li>
                                <li>3. Pilih <b>Transfer</b> dan pilih <b>ke rekening BNI.</b>
                                </li>
                                <li>4. Masukkan nominal transfer sesuai dengan total tagihan
                                    transaksi di aplikasi Inofa Bimbel <b>ke no rek 585420531
                                        a.n Muhammad Dzakwan Zaky.</b></li>
                                <li>5. <b>Simpan bukti pembayaran dan unggah bukti </b>pada
                                    halaman yang tersedia di Inofa Bimbel.</li>
                            </ol>
                        </div>
</section>
@endsection
@push('after-script')
<script>
    $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
</script>
@endpush
