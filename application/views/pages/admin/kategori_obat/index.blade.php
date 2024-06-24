@extends('templates/layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Halaman Kategori Obat</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kategori Obat Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <a href="<?= base_url('admin/obat/kategori-obat/create') ?>" class="btn btn-primary"><i
                            class="fas fa-fw fa-plus"></i> Kategori Baru</a>
                </div>
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data['obat_categories'] as $obat_category)
                            <tr>
                                <td><?= $obat_category->id ?></td>
                                <td><?= $obat_category->nama ?></td>
                                <td class="d-flex">
                                    <a href="<?= base_url('admin/obat/kategori-obat/' . $obat_category->id . '/edit') ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <form
                                        action="<?= base_url('admin/obat/kategori-obat/' . $obat_category->id . '/delete') ?>"
                                        method="post" onsubmit="return confirm('Yakin delete kategori?')">
                                        <button class="btn btn-sm btn-danger" type="submit"><i
                                                class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('kategori_obat_success')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('kategori_obat_success') ?>',
            class: 'success'
        });
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('kategori_obat_success_edit')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('kategori_obat_success_edit') ?>',
            class: 'success'
        });
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('kategori_obat_success_delete')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('kategori_obat_success_delete') ?>',
            class: 'yellow'
        });
    </script>
    <?php endif; ?>
@endsection
