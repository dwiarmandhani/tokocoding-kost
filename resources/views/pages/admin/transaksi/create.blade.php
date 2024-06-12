@extends('layouts.admin')

@section('title')
    Buat Pemesanan
@endsection

@section('content')
<style>
    /* Styles tetap sama seperti sebelumnya */
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
                    <!-- Grid untuk memilih tipe kamar -->
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
                                            {{-- <p class="room-price">Lantai : {{$tipe_kamar->lantai}}</p> --}}
                                            <p class="room-price">Jumlah kamar kosong :
                                                @php $arrayTipe = array(); @endphp
                                                @foreach ($tipe_kamar->kamars->where('status',"Kosong") as $t)
                                                @php $arrayTipe[] = $t @endphp
                                                @endforeach
                                                @php $jum = count($arrayTipe); @endphp
                                                {{ $jum }}</p>
                                            <p class="room-price">Rp {{number_format($tipe_kamar->harga)}}/bulan</p>
                                        </div>
                                        <!-- Tambahkan tombol "Pesan Kamar" dengan link ke halaman selanjutnya -->
                                        <a href="{{ route('pesan-kamar',$tipe_kamar->id) }}" class="btn btn-fill text-white d-block" style="background-color: #F6DB80">Pesan Kamar</a>
                                        {{-- <a href="" class="btn btn-try text-white d-block" style="background-color: #F6DB80">Pesan Kamar</a> --}}
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p>Tidak ada Kamar</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
