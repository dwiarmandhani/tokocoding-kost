@extends('layouts.fe')

@section('content')
<style>
      .form-group{
        margin-bottom: 15px;
    }
    .card .card-header h4 {
        font-size: 16px;
        line-height: 28px;
        color: #F6DB80;
        padding-right: 10px;
    }

    .text-small{
        font-size: 12px;
        line-height: 20px;
    }
    a{
        color: #F6DB80;
        font-weight: 500;
        -webkit-transition: all 0.5s
    }
    .btn:not(:disabled):not(.disabled){
        cursor: pointer;
    }

    .btn.btn-lg{
        padding: .75rem 1.5rem;
        font-size: 12px;
    }
    .btn-primary, .btn-primary.disabled {
    box-shadow: 0 2px 6px #acb5f6;
    background-color: #F6DB80;
    border-color: #F6DB80;
}
.btn {
    font-weight: 600;
    font-size: 12px;
    line-height: 30px;
    padding: 5rem 3rem;
    letter-spacing: 0.5px;
}
    .btn-block{
        display: block;
        width: 100%;
    }
    .btn-group-lg>.btn, .btn-lg {
    padding: .5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: .3rem;
}
.btn-primary {
    color: #fff;
    background-color: #F6DB80;
    border-color: #F6DB80;
}
#small {
  font-size: 12px;
  line-height: 20px; }



.required:after {
    content:" *";
    color: red;
}
</style>
<div class="app">
    <section class="section" style="background: #F2F6FF" data-aos="fade-up">
        <div class="container">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                <div class="login-brand">
                    <img src="../dist/img/stisla-fill.svg" style="opacity: 0" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>
                <div class="card card-primary" style="margin-bottom: 20px;">
                    <div class="card-header" style="margin-bottom: -20px;">
                        <h4 style="text-align: center"><strong>Pendaftaran Akun</strong></h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" class="needs-validation" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group" style="margin-bottom: 20px">
                                    <label for="name" class="required">Nama Lengkap</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Masukkan Nama Lengkap Anda"
                                    oninvalid="this.setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 20px">
                                    <label for="email" class="required">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Masukkan Email Anda"
                                    oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 20px">
                                    <label for="email" class="required">Nomor Telepon</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                    <input id="no_hp" type="numeric" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="off" placeholder="Masukkan Nomor Telepon Anda Anda"
                                    oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')">
                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 20px">
                                    <label for="password"class="d-block required">Kata Sandi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off" placeholder="Masukkan Kata Sandi Anda"
                                    oninvalid="this.setCustomValidity('Kata sandi tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <div class="input-group-append" >
                                        <div class="input-group-text">
                                            <i class="fas fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group"> <button type="submit" class="btn btn-primary btn-lg btn-block">Daftar</button> </div>
                                <div class="row mb-3 px-3 text-center">
                                    <small class="font-weight-bold">Sudah Punya Akun? <a href="{{ route('login') }}" style="color: #1966BA">Masuk</a>
                                    </small>
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
@push('after-script')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye');
    });

</script>
@endpush
