<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,  shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="" />
<meta name="author" content="" />
<title>Kost KIta</title>

@include('includes.main.style')
</head>
<body>
@include('includes.main.navbar')
<main class="site-main">

    <!-- ================ start banner area ================= -->
    <section class="home-banner-area" id="home">
        <div class="container">
            <div class="home-banner">
            <div class="text-center">
                <h4>Rumah Kost yang bersih dan nyaman</h4>
                <h1>Rumah Kost KIta</h1>
                <a class="button home-banner-btn" href="#">Silakan Memilih Kamar</a>
            </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!-- ================ welcome section start ================= -->
    <section class="welcome">
        <div class="container">
            <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="row welcome-images">
                <div class="col-sm-12">
                    <div class="card">
                    <img class="" src="{{ url('/seapalace/img/home/welcomeBanner1.png')}}" alt="Card image cap" style="border-radius: 20px">
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="welcome-content">
                <h2 class="mb-4">Selamat Datang</h2>
                <h4>Cara Pemesanan Kamar</h4>
                <p>1. <a href="{{ route('register') }}">Daftar</a> dan <a href="{{ route('login') }}">Masuk</a> ke Website </p>
                <p>2. Pilih Kamar, Tanggal Masuk, dan Durasi Sewa</p>
                <p>3. Lakukan pembayaran sesuai dengan harga yang tertera</p>
                <p>4. Masuk ke Dashboard dan upload bukti pembayaran</p>
                <p>5. Admin akan mengkonfirmasi pembayaran</p>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- ================ welcome section end ================= -->


    <!-- ================ Explore section start ================= -->
    <section class="section-margin" id="kost">
        <div class="container">
            <div class="section-intro text-center pb-80px">
            <h2>Tipe Kamar Rumah Kost KIta</h2>
            </div>

            <div class="row">
                @php $incrementRoomType = 0 @endphp
                @forelse ($room_types as $room_type)
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade-up">
                    <div class="card card-explore">
                    <div class="card-explore__img">
                        <img class="card-img" src="{{ Storage::url($room_type->photo) }}" alt="">
                    </div>
                    <div class="card-body">
                        <h3 class="card-explore__price">Rp {{ number_format($room_type->price) }} <sub>/ Per Bulan</sub></h3>
                        <h4 class="card-explore__title">{{ $room_type->name }}</></h4>
                        <h6>Jumlah Kamar Tersedia <h7 style="color: red">{{ count($room_type->rooms) }}</h7></h6>
                        <a class="card-explore__link" href="{{ route('detail-kost',$room_type->id) }}">Book Now <i class="ti-arrow-right"></i></a>
                    </div>
                    </div>
                </div>
                @empty
                    <p>Tidak ada data ditampilkan</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- ================ Explore section end ================= -->

    <!-- ================ carousel section start ================= -->
    <section class="section-margin">
    <div class="container">
        <div class="section-intro text-center pb-20px">
        <h2>Review Penghuni</h2>
        </div>
        <div class="owl-carousel owl-theme testi-carousel">
        <div class="testi-carousel__item">
            <div class="media">
            @php $incrementRoomType = 0 @endphp
            @forelse ($reviews as $review)
            <div class="media-body">
                <p>{!! $review->review !!}</p>
                <div class="testi-carousel__intro">
                    <h3>{{ $review->user->name }}</h3>
                    <p>{{ $review->user->profession }}</p>
                </div>
            </div>
            </div>
        </div>
        @empty
            <p>Tidak ada data yang ditampilkan</p>
        @endforelse

        </div>
    </div>
    </section>
    <!-- ================ carousel section end ================= -->

</main>

@include('includes.main.footer')

@include('includes.main.script')
</body>
</html>
