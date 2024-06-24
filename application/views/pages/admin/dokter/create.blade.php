@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Register dokter baru</h1>
        <a href="<?= base_url('admin/docters') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/docters/store') ?>" method="post">

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="dokter-name">Nama Dokter</label>
                <input type="text" name="nama" value="<?= set_value('nama') ?>"
                    class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" placeholder="Nama dokter" required
                    autofocus autocomplete="off">
                <?= form_error('nama') ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="dokter-nip">NIP</label>
                <input type="text" name="nip" value="<?= set_value('nip') ?>"
                    class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" placeholder="NIP dokter" required
                    autofocus minlength="18" maxlength="18" autocomplete="off">
                <?= form_error('nip') ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="alamat-dokter">Alamat Dokter</label>
                <textarea name="alamat" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" id="alamat-dokter"
                    cols="30" rows="5" placeholder="Alamat" required><?= set_value('alamat') ?></textarea>
                <?= form_error('alamat') ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="dokter-nip">No Telepon</label>
                <input type="text" name="no_telp" value="<?= set_value('no_telp') ?>"
                    class="form-control <?= form_error('no_telp') ? 'is-invalid' : '' ?>" placeholder="No telepon dokter"
                    required autofocus autocomplete="off">
                <?= form_error('no_telp') ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Register user</button>
    </form>

    <?php if ($this->session->flashdata('dokter_create_error')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('dokter_create_error') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>
@endsection
