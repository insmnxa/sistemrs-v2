@extends('templates/layout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Register New User</h1>
    </div>

    <form action="<?= base_url('admin/user/store') ?>" method="post">
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" autofocus  required>
        </div>
        
        <div class="input-group mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama" aria-label="Username" required>
        </div>
        
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" required autocomplete="off" minlength="8">
            <input type="password" name="repeat_password" class="form-control" placeholder="Repeat Password" aria-label="Repeat Password" required autocomplete="off" minlength="8">
        </div>

        <button type="submit" class="btn btn-primary">Register user</button>
    </form>
@endsection