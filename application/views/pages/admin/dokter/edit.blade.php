@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit dokter</h1>
        <a href="<?= base_url('admin/docters') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/docters/' . $data['docter']->id . '/docters') ?>" method="post">        
        <div class="col-md-6">
            
            <div class="input-group mb-3">
                <input type="text" name="nama" value="<?= $data['docter']->nama ?>" class="form-control" placeholder="Nama" aria-label="Nama" required>
                <input type="text" name="nip" value="<?= $data['docter']->nip ?>" class="form-control" placeholder="NIP" aria-label="NIP" minlength="18" maxlength="18" required>
            </div>

            <div class="input-group mb-3">
                <textarea class="form-control" name="alamat" placeholder="Alamat" id="alamat" required><?= $data['docter']->alamat ?></textarea>
            </div>
        
            <div class="input-group mb-3">
                <input type="text" name="no_telp" value="<?= $data['docter']->no_telp ?>" class="form-control" placeholder="No Telepon" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Register user</button>
        </div>
    </form>
@endsection