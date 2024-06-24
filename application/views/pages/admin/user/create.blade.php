@extends('templates/layout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Register New User</h1>
    </div>

    <form action="<?= base_url('admin/users/store') ?>" method="post">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user-email">Nama</label>
                <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid  ' : '' ?>"
                    placeholder="Nama" id="user-nama" required autofocus>
                <?= form_error('nama') ?>
            </div>
            <div class="form-group col-md-6">
                <label for="user-username">Username</label>
                <input type="text" name="username" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>"
                    placeholder="Username here" id="user-username" required>
                <?= form_error('username') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="user-password">Password</label>
            <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>"
                placeholder="Password here" id="user-password" required autocomplete="off" minlength="8">
            <?= form_error('password') ?>
        </div>
        <div class="form-group">
            <label for="repeat_password">Repeat Password</label>
            <input type="password" name="re_password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>"
                placeholder="Password here" id="repeat_password" required autocomplete="off" minlength="8">
            <?= form_error('password') ?>
        </div>

        <button type="submit" class="btn btn-primary">Register user</button>
    </form>

    <?php if ($this->session->flashdata('user_create_error')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('user_create_error') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>
@endsection
