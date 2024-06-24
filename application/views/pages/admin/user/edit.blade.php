@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Update User</h1>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/users/' . $data['user']->id . '/update') ?>" method="post">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user-email">Nama</label>
                <input type="text" name="nama" value="<?= $data['user']->nama ?>"
                    class="form-control <?= form_error('nama') ? 'is-invalid  ' : '' ?>" placeholder="Nama" id="user-nama"
                    required autofocus>
                <?= form_error('nama') ?>
            </div>
            <div class="form-group col-md-6">
                <label for="user-username">Username</label>
                <input type="text" name="username" value="<?= $data['user']->username ?>"
                    class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" placeholder="Username here"
                    id="user-username" required>
                <?= form_error('username') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="user-password">Password</label>
            <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>"
                placeholder="Password here" id="user-password" autocomplete="off" minlength="8">
            <?= form_error('password') ?>
        </div>
        <div class="form-group">
            <label for="repeat_password">Repeat Password</label>
            <input type="password" name="re_password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>"
                placeholder="Password here" id="repeat_password" autocomplete="off" minlength="8">
            <?= form_error('password') ?>
        </div>

        <button type="submit" class="btn btn-primary">Update user</button>
    </form>

    <?php if ($this->session->flashdata('user_edit_error')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('user_edit_error') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>
@endsection
