@extends('templates.layout-auth')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
    </div>
    <form action="<?= base_url('login/auth') ?>" method="post" class="user">
        <div class="form-group">
            <input type="text" name="username"
                class="form-control form-control-user <?= form_error('username') ? 'is-invalid' : '' ?>"
                placeholder="Username" autofocus>
            <?= form_error('username') ?>
        </div>
        <div class="form-group">
            <input type="password" name="password"
                class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : '' ?>"
                placeholder="Password">
            <?= form_error('password') ?>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Login
        </button>
    </form>
    <hr>
    <div class="text-left">
        <span class="small">Belum punya akun?<a class="small" href="<?= base_url('register') ?>"> Daftar!</a>.</span>
    </div>

    <?php if ($this->session->flashdata('login_error')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('login_error') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('register_success')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('register_success') ?>',
            class: 'success'
        });
    </script>
    <?php endif; ?>
@endsection
