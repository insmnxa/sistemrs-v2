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

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="pasien-nama">Nama Pasien</label>
                <input type="text" value="<?= $data['patient']->p_n ?>" name="nama"
                    class="form-control <?= form_error('nama') ? 'is-invalid  ' : '' ?>" id="pasien-nama"
                    placeholder="Nama Pasien" required autofocus>
                <?= form_error('nama') ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="pasien-tgl-lahir">Tanggal Lahir</label>
                <input type="date" value="<?= $data['patient']->p_tgl ?>" name="tgl_lahir"
                    class="form-control <?= form_error('tgl_lahir') ? 'is-invalid ' : '' ?>" id="pasien-tgl-lahir" required>
                <?= form_error('tgl_lahir') ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="pasien-no-ktp">No KTP</label>
                <input type="text" value="<?= $data['patient']->p_ktp ?>" name="no_ktp"
                    class="form-control <?= form_error('no_ktp') ? 'is-invalid' : '' ?>" id="pasien-nama-no-ktp"
                    placeholder="Nomor KTP Pasien" minlength="16" maxlength="16" required>
                <?= form_error('no_ktp') ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="pasien-no-telp">No Telepon</label>
                <input type="text" value="<?= $data['patient']->p_tlp ?>" name="no_telp"
                    class="form-control <?= form_error('no_telp') ? 'is-invali' : '' ?>" id="pasien-nama-no-telp"
                    placeholder="Nomor Telepon Pasien" required>
                <?= form_error('no_telp') ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="pasien-dokter">Dokter</label>
                <input type="text" value="<?= $data['patient']->dn ?>" name="dokter" id="dokter"
                    class="form-control <?= form_error('no_telp') ? 'is-invalid  ' : '' ?>" placeholder="Dokter">
            </div>
        </div>


        <button type="submit" class="btn btn-primary mt-2">Update user</button>
    </form>

    <script>
        $(document).ready(function() {
            $(async function() {
                const response = await fetch("<?= base_url('admin/docters/fetch') ?>");
                const docters = await response.json();

                $('#dokter').autocomplete({
                    source: docters
                });
            });
        });
    </script>

    <?php if ($this->session->flashdata('pasien_edit_error')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('pasien_edit_error') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>
@endsection
