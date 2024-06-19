@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Register pasien baru</h1>
        <a href="<?= base_url('admin/patients') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/patients/store') ?>" method="post">        
        <div class="input-group mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama" aria-label="Nama" required>
            <input type="date" name="tgl_lahir" class="form-control" aria-label="Tanggal Lahir" required>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="no_ktp" class="form-control" minlength="16" placeholder="No KTP">
        </div>

        <div class="input-group mb-3">
            <input type="text" name="no_telp" class="form-control" placeholder="No Telepon">
        </div>

        <button type="submit" class="btn btn-primary">Register user</button>
    </form>
@endsection