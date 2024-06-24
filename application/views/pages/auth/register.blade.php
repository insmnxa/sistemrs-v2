@extends('templates.layout-auth')   

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Halaman Register</h1>
    </div>
    <form action="<?= base_url('register/auth') ?>" method="post" class="user">
        <div class="form-group">
            <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control form-control-user <?= form_error('nama') ? 'is-invalid' : '' ?>" placeholder="Nama">
            <?= form_error('nama') ?>
        </div>
        <div class="form-group">
            <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control form-control-user <?= form_error('username') ? 'is-invalid' : '' ?>" placeholder="Username">
            <?= form_error('username') ?>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" name="password" class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : '' ?>" placeholder="Password">
                <?= form_error('password') ?>
            </div>
            <div class="col-sm-6">
                <input type="password" name="repeat_password" class="form-control form-control-user <?= form_error('username') ? 'is-invalid ' : '' ?>" placeholder="Repeat Password">
                <?= form_error('repeat_password') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Register Account
        </button>
    </form>
    <hr>
    <div class="text-center">
        <span class="small">Sudah punya akun? <a class="small" href="<?= base_url('login') ?>">Login</a>.</span>
    </div>
@endsection