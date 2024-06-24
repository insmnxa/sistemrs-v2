@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit kategori obat</h1>
        <a href="<?= base_url('admin/obat/kategori-obat') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/obat/kategori-obat/' . $data['obat_category']->id . '/update') ?>" method="post">
        <div class="input-group row mb-3 col-md-4">
            <input type="text" name="nama" value="<?= $data['obat_category']->nama ?>"
                class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" placeholder="Nama" aria-label="Nama"
                required>
            <?= form_error('nama') ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <?php if ($this->session->flashdata('kategori_obat_error_edit')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('kategori_obat_error_edit') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>
@endsection
