@extends('layouts.admin')

@section('title')
    Profil
@endsection
<style>
.required:after {
    content:" *";
    color: red;
}
@media (max-width: 417px) {
    .tombol .btn.simpan {
    margin-bottom: 10px;
    }
}
</style>
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
                    <div class="card">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-header">
                            <h4>Informasi Admin</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('change-profil-redirect',$user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="required">Nama Admin</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp" class="required">No Telepon</label>
                                    <input type="numeric" name="no_hp" id="no_hp" value="{{ $user->no_hp }}" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary px-5" style="padding: 8px 16px">
                                            Simpan Data
                                        </button>
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
