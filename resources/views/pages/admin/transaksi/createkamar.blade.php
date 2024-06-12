@extends('layouts.admin')

@section('title')
    Buat Pemesanan
@endsection

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
                            <form action="{{ route('confirmation-kamar', $tipe_kamar->id) }}" id="form-sewa" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="kode" value="{{ 'KOS'.date('ymd').mt_rand(000,999) }}">
                                <input type="hidden" name="tipe_kamar_id" value="{{ $tipe_kamar->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">Nama Pengguna</label>
                                            <select name="user_id" id="user_select" class="form-control">
                                                <option value="" disabled selected>Pilih Pengguna</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" data-email="{{ $user->email }}" data-no_hp="{{ $user->no_hp }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Kontak</label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">Tipe Kamar</label>
                                            <p>{{ $tipe_kamar->nama }}</p>
                                            <img src="{{ Storage::url($tipe_kamar->galeri->first()->foto ?? '') }}" alt="Gambar Kamar" style="max-width: 100%">
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Tanggal Masuk</label>
                                            <input type="date" name="tanggal_masuk" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Durasi</label>
                                            <select name="durasi" id="durasi" class="form-control">
                                                <option value="1">1 Bulan</option>
                                                <option value="6">6 Bulan</option>
                                                <option value="12">1 Tahun</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Harga</label>
                                            <input type="hidden" name="total" id="total" value="">
                                            <input type="text" name="total_harga" id="total_harga" class="form-control" readonly value="{{ $tipe_kamar->harga }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary px-5" style="padding: 8px 16px">
                                            Buat Pesanan
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
        </div>
    </section>
</div>
@endsection

@push('addon-script')
<script>
    const userSelect = document.getElementById('user_select');
    const emailInput = document.getElementById('email');
    const noHpInput = document.getElementById('no_hp');

    userSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const email = selectedOption.getAttribute('data-email');
        const no_hp = selectedOption.getAttribute('data-no_hp');

        emailInput.value = email;
        noHpInput.value = no_hp;
    });
</script>
@endpush
