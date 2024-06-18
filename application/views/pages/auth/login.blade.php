@extends('templates.layout-auth')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
    </div>
    <form action="<?= base_url('login/auth') ?>" method="post" class="user">
        <div class="form-group">
            <input type="text" name="username" class="form-control form-control-user" placeholder="Enter Email Address...">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Login
        </button>
    </form>
    <hr>
    <div class="text-left">
        <span class="small">Belum punya akun?<a class="small" href="<?= base_url('register') ?>"> Daftar!</a>.</span>
    </div>
@endsection