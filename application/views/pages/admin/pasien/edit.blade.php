@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit pasien</h1>
        <a href="<?= base_url('admin/patients') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <h1 class="h4 text-gray-600">Informasi pasien</h1>

    <div class="col-md-4">
        <label class="form-label">Dokter</label>
        <div class="input-group mb-2">
            <input type="text" value="<?= $data['patient']->dn ?>" class="form-control" disabled>
        </div>
        
        <label class="form-label">User</label>
        <div class="input-group mb-4">
            <input type="text" value="<?= $data['patient']->un ?>" class="form-control" disabled>
        </div>
    </div>
    
    
    <form action="<?= base_url('admin/patients/' . $data['patient']->p_i . '/update') ?>" method="post">        
        <label for="">Nama Pasien</label>
        <div class="input-group mb-3">
            <input type="text" name="nama" value="<?= $data['patient']->p_n ?>" class="form-control" placeholder="Nama" aria-label="Nama" required>
            <input type="date" name="tgl_lahir" value="<?= $data['patient']->p_tgl ?>" class="form-control" aria-label="Tanggal Lahir" required>
        </div>

        <label for="">No KTP Pasien</label>
        <div class="input-group mb-3">
            <input type="text" name="no_ktp" value="<?= $data['patient']->p_ktp ?>" class="form-control" minlength="16" placeholder="No KTP">
        </div>

        <label for="">No Telepon Pasien</label>
        <div class="input-group mb-3">
            <input type="text" name="no_telp" value="<?= $data['patient']->p_tlp ?>" class="form-control" placeholder="No Telepon">
        </div>

        <label for="dokter">Dokter Penangan</label>
        <select name="id_dokter" class="form-control" id="dokter">
            <option aria-readonly="true" value="<?= $data['patient']->di ?>"><?= $data['patient']->dn ?></option>
            @foreach ($data['docters'] as $docter)
                <option value="<?= $docter->id ?>"><?= $docter->nama ?></option>
            @endforeach
        </select>
    

        <button type="submit" class="btn btn-primary mt-2">Update user</button>
    </form>
@endsection