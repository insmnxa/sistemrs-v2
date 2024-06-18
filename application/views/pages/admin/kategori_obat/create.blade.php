@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Input kategori obat baru</h1>
        <a href="<?= base_url('admin/obat/kategori-obat') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/obat/kategori-obat/store') ?>" method="post">        
        <div class="input-group row mb-3 col-md-4">
            <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control" placeholder="Nama" aria-label="Nama" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection