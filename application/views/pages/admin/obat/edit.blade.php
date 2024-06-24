@extends('templates/layout')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Edit obat</h1>
        <a href="<?= base_url('admin/obat') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <form action="<?= base_url('admin/obat/' . $data['obat']->id . '/update') ?>" method="post">

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="obat-merk">Merk</label>
                <input type="text" name="merk" value="<?= $data['obat']->merk ?>"
                    class="form-control <?= form_error('merk') ? 'is-invalid' : '' ?>" placeholder="Merk obat"
                    id="obat-merk" autocomplete="off" autofocus required>
                <?= form_error('merk') ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="obat-harga">Harga</label>
                <input type="number" name="harga" value="<?= $data['obat']->harga ?>"
                    class="form-control <?= form_error('harga') ? 'is-invalid' : '' ?>" placeholder="Harga obat"
                    id="obat-harga" autocomplete="off" autofocus required>
                <?= form_error('merk') ?>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="obat-stok">Stok</label>
                <input type="number" name="stok" value="<?= $data['obat']->stok ?>"
                    class="form-control <?= form_error('stok') ? 'is-invalid' : '' ?>" placeholder="Stok obat"
                    id="obat-stok" autocomplete="off" autofocus required>
                <?= form_error('stok') ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="obat-harga">Kategori</label>
                <input type="text" name="kategori_obat" value="<?= $data['obat']->kon ?>"
                    class="form-control <?= form_error('kategori_obat') ? 'is-invalid' : '' ?>" placeholder="Kategori obat"
                    id="kategori-obat" autocomplete="off" autofocus required>
                <?= form_error('merk') ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <script>
        $(document).ready(function() {
            $(async function() {
                const response = await fetch("<?= base_url('admin/obat/kategori-obat/fetch') ?>");
                const obat_categories = await response.json();

                $('#kategori-obat').autocomplete({
                    source: obat_categories
                });
            });
        });
    </script>

    <?php if ($this->session->flashdata('obat_edit_error')) : ?>
    <script>
        $.toast({
            display: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('obat_edit_error') ?>',
            class: 'red'
        });
    </script>
    <?php endif; ?>
@endsection
