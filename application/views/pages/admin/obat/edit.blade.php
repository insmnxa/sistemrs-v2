@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Input obat baru</h1>
        <a href="<?= base_url('admin/obat') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/obat/' . $data['obat']->id . '/update') ?>" method="post">        
        <div class="input-group mb-3">
            <input type="text" name="merk" value="<?= $data['obat']->merk ?>" class="form-control" placeholder="Merk" aria-label="Merk" required>
            <input type="number" name="harga" value="<?= $data['obat']->harga ?>" class="form-control" placeholder="Harga" aria-label="Harga" required>
        </div>

        <div class="input-group mb-3">
            <input type="number" name="stok" value="<?= $data['obat']->stok ?>" class="form-control" minlength="16" placeholder="Stok">
        </div>

        <div class="input-group mb-3 col-md-4 row">
            <select name="kategori" value="<?= set_value('kategori') ?>" class="form-control" id="obat">
                <option value="<?= $data['obat']->koi ?>" selected><?= $data['obat']->kon ?></option>
                @foreach ($data['obat_categories'] as $obat_category)
                    <option value="<?= $obat_category->id ?>"><?= $obat_category->nama ?></option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection