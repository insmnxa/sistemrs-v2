@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Update User</h1>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/user/' . $data['user']->id .'/update') ?>" method="post">
        <div class="input-group mb-3">
            <input type="text" name="username" value="<?= $data['user']->username ?>" class="form-control" placeholder="Username" aria-label="Username" autofocus  required>
        </div>
        
        <div class="input-group mb-3">
            <input type="text" name="nama" value="<?= $data['user']->nama ?>" class="form-control" placeholder="Nama" aria-label="Username" required>
        </div>
        
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" autocomplete="off" minlength="8">
            <input type="password" name="repeat_password" class="form-control" placeholder="Repeat Password" aria-label="Repeat Password" autocomplete="off" minlength="8">
        </div>

        <button type="submit" class="btn btn-primary">Update user</button>
    </form>
@endsection