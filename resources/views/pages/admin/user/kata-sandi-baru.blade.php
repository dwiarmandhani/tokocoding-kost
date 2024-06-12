@extends('layouts.admin')

@section('title')
    Kata Sandi Baru
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($user as $u)
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <h5>@yield('title')</h5>
                            </div>
                            <hr>
                            <form action="{{ route('save-new-password',$u->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Kata Sandi Baru</label>
                                    <div class="col-6">
                                        <div class="input-group">
                                            {{-- <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div> --}}
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
                                </div>
                                <div class="row tombol">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                            Simpan Data
                                        </button>
                                        <a href="{{ route('user') }}" class="btn btn-danger px-5" style="padding: 8px 16px; margin-left:10px;">
                                            Batal
                                        </a>
                                    </div>
                                </div>
                            </form>
                            @endforeach
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
