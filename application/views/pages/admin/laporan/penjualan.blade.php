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
                    <a href="<?= base_url('admin/obat/kategori-obat/create') ?>" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Kategori Baru</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Penjualan</th>
                            <th>Pasien</th>
                            <th>Tagihan</th>
                            <th>Dibayar</th>
                            <th>Kembali</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID Penjualan</th>
                            <th>Pasien</th>
                            <th>Tagihan</th>
                            <th>Dibayar</th>
                            <th>Kembali</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data['sellings'] as $selling)    
                            <tr>
                                <td><?= $selling->id ?></td>
                                <td><?= $selling->p_n ?></td>
                                <td><?= $selling->r_th ?></td>
                                <td><?= $selling->dibayar ?></td>
                                <td><?= $selling->kembali ?></td>
                                <td><?= explode(' ', $selling->dibuat_pada)[0] ?></td>
                                <td class="d-flex">
                                    <a href="<?= base_url('admin/obat/kategori-obat/' . $selling->id . '/edit') ?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-fw fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
@endsection