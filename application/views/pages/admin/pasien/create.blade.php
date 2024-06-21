@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Register pasien baru</h1>
        <a href="<?= base_url('admin/patients') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/patients/store') ?>" method="post">        
        <div class="input-group mb-3">
            <input type="text" value="<?= set_value('nama') ?>" name="nama" class="form-control" placeholder="Nama" aria-label="Nama" required>
            <input type="date" value="<?= set_value('tgl_lahir') ?>" name="tgl_lahir" class="form-control" aria-label="Tanggal Lahir" required>
        </div>

        <div class="input-group mb-3">
            <input type="text" value="<?= set_value('no_ktp') ?>" name="no_ktp" class="form-control" minlength="16" maxlength="16" placeholder="No KTP">
        </div>

        <div class="input-group mb-3">
            <input type="text" value="<?= set_value('no_telp') ?>" name="no_telp" class="form-control" placeholder="No Telepon">
        </div>

        <div class="input-group row mb-3">
            <div class="col-md-4">
                <input type="text" value="<?= set_value('dokter') ?>" name="dokter" id="dokter" class="form-control" placeholder="Dokter">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Register user</button>
    </form>

    <script>

        // best approach 
        $(document).ready(function () {
            $(async function () {
                const response = await fetch("<?= base_url('admin/docters/fetch') ?>");
                const docters = await response.json();

                $('#dokter').autocomplete({
                    source: docters
                });
            });
        });
    </script>
@endsection