@extends('layouts.user')

@section('title')
Review Kost
@endsection

@section('content')
<style>
    .btn-filll{
        background-color: #F6DB80;
        border-radius: 12px;
        padding: 12px 28px;
    }
    .btn-fill:hover{
        background: #000;
    }
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
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- @foreach ($user as $rev) --}}
                            <form action="{{ route('review-user-update','review-user') }}" method="POST" enctype="multipart/form-data">
                                @foreach ($booking as $book)
                                    <input type="hidden" name="booking_id" value="{{ $book->id }}">
                                @endforeach
                                @csrf
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled>
                            </div>
                            {{-- @endforeach --}}
                            @if(count($booking) > 0)
                            @foreach ($booking as $revv)
                                <div class="form-group">
                                    <label for="review" class="required">Review</label>
                                    <input type="text" name="review" id="review" class="form-control"
                                    value="{{ $revv->review->review ?? '' }}" autocomplete="off" placeholder="Masukkan Review">
                                    <small>Contoh: Kost bersih dan nyaman</small>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary px-5 text-white mb-3" style="padding: 8px 16px" >
                                            Simpan Data
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p class="required">Maaf, Silakan lakukan pemesanan kamar terlebih dahulu</p>

                                @endif
                            {{-- @if(count($review) > 0)
                                @foreach ($review as $revv)
                                <div class="form-group">
                                    <label for="review" class="required">Review</label>
                                    <input type="text" name="review" id="review" class="form-control"
                                    value="{{ $revv->review }}" autocomplete="off" placeholder="Masukkan Review">
                                    <small>Contoh: Kost bersih dan nyaman</small>
                                </div>
                                @endforeach
                            @else
                                <div class="form-group">
                                    <label for="review" class="required">Review</label>
                                    <input type="text" name="review" id="review" class="form-control"
                                    value="" autocomplete="off" placeholder="Masukkan Review" required>
                                    <small>Contoh: Kost bersih dan nyaman</small>
                                </div>
                            @endif --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- Cek Profil --}}
{{-- @if($booking_id)
<div id="myModal" class="modal fade hide fade in" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: red">Pesan Kamar Terlebih Dahulu</h5>
            </div>
            <div class="modal-body">
                <p>Untuk mengisi review, Pastikan Anda sudah pernah melakukan pemesanan kamar. <br>
                </p>
            </div>
            <div class="modal-footer">
                <a href={{ route('home') }} class="btn btn-danger">Halaman Utama</a>
                <a href={{ route('profil-user') }} class="btn btn-info">Buka Profil</a>
            </div>
        </div>
    </div>
</div>
@endif --}}
@endsection

{{-- @push('addon-script')
<script>
    $('#myModal').modal('show')
</script>
@endpush --}}

