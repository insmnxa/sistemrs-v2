@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Register pasien baru</h1>
        <a href="<?= base_url('admin/patients') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/patients/store') ?>" method="post">

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="pasien-nama">Nama Pasien</label>
                <input type="text" value="<?= set_value('nama') ?>" name="nama"
                    class="form-control <?= form_error('nama') ?>" id="pasien-nama" placeholder="Nama Pasien" required
                    autofocus>
                <?= form_error('nama') ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="pasien-tgl-lahir">Tanggal Lahir</label>
                <input type="date" value="<?= set_value('tgl_lahir') ?>" name="tgl_lahir"
                    class="form-control <?= form_error('tgl_lahir') ?>" id="pasien-tgl-lahir" required>
                <?= form_error('tgl_lahir') ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="pasien-no-ktp">No KTP</label>
                <input type="text" value="<?= set_value('no_ktp') ?>" name="no_ktp"
                    class="form-control <?= form_error('no_ktp') ?>" id="pasien-nama-no-ktp" placeholder="Nomor KTP Pasien"
                    minlength="16" maxlength="16" required>
                <?= form_error('no_ktp') ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="pasien-no-telp">No Telepon</label>
                <input type="text" value="<?= set_value('no_telp') ?>" name="no_telp"
                    class="form-control <?= form_error('no_telp') ?>" id="pasien-nama-no-telp"
                    placeholder="Nomor Telepon Pasien" required>
                <?= form_error('no_telp') ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="pasien-dokter">Dokter</label>
                <input type="text" value="<?= set_value('dokter') ?>" name="dokter" id="dokter" class="form-control"
                    placeholder="Dokter" required>
                <?= form_error('dokter') ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Register pasien</button>
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

    <?php if ($this->session->flashdata('pasien_create_error')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('pasien_create_error') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>
@endsection
