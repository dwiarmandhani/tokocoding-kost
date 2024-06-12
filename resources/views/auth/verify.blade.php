@extends('layouts.fe')

@section('content')
<div class="container mb-5">
    <div class="row align-items-sm-center align-items-l-stretch">
        <div class="col-md-8">
            <div class="card">
                <div class="d-flex align-item-center justify-content-between" style="margin-left: 25px">
                    <div>
                        {{ __('Silakan verifikasi email Anda') }}
                    </div>
                    <div>
                        {{Auth::user()->email}}
                    </div>
                </div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link verifikasi baru telah dikirim ke email Anda') }}
                        </div>
                    @endif

                    {{ __('Silakan periksa email Anda untuk memverifikasinya.') }}
                    {{ __('Jika Anda belum menerima email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik di sini untuk verifikasi ulang') }}</button>.
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="learning_img">
                <center><a href="https://storyset.com/internet" target="_blank"><img src="{{asset('fe/img/email.png')}}" height="70%" width="70%" alt="email logo" style=""></center>
            </div>
        </div>
    </div>
</div>
@endsection
