@extends('templates/layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Halaman Dokter</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dokter Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <a href="<?= base_url('admin/docters/create') ?>" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i>
                        Register dokter</a>
                </div>
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data['docters'] as $docter)
                            <tr>
                                <td><?= $docter->id ?></td>
                                <td><?= $docter->nama ?></td>
                                <td><?= $docter->nip ?></td>
                                <td><?= $docter->alamat ?></td>
                                <td><?= $docter->no_telp ?></td>
                                <td class="d-flex">
                                    <a href="<?= base_url('admin/docters/' . $docter->id . '/edit') ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <form action="<?= base_url('admin/docters/' . $docter->id . '/delete') ?>"
                                        method="post" onsubmit="return confirm('Yakin hapus dokter?')">
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

    <?php if ($this->session->flashdata('dokter_create_success')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('dokter_create_success') ?>',
            class: 'success'
        });
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('dokter_edit_success')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('dokter_edit_success') ?>',
            class: 'success'
        });
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('dokter_delete_success')) : ?>
    <script>
        $.toast({
            displayTime: 'auto',
            showProgress: 'bottom',
            title: 'Notification',
            message: '<?= $this->session->flashdata('dokter_delete_success') ?>',
            class: 'yellow'
        });
    </script>
    <?php endif; ?>
@endsection
