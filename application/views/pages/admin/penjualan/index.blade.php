@extends('templates/layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Halaman Pasien</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pasien Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <a href="<?= base_url('admin/patients/create') ?>" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Register pasien</a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total Tagihan</th>
                            <th>Dokter</th>
                            <th>Pasien</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Total Tagihan</th>
                            <th>Dokter</th>
                            <th>Pasien</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data['receipts'] as $receipt)    
                            <tr>
                                <td><?= $receipt->r_i ?></td>
                                <td>Rp <?= $receipt->r_th ?>,-</td>
                                <td><?= $receipt->da ?></td>
                                <td><?= $receipt->pa ?></td>
                                @if ($receipt->r_s === 'belum_bayar')
                                    <td><span class="badge badge-danger">Belum Bayar</span></td>
                                @else 
                                    <td><span class="badge badge-info">Lunas</span></td>
                                @endif
                                <td class="d-flex">
                                    <a href="<?= base_url('admin/sellings/' . $receipt->p_i . '/create') ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <form action="<?= base_url('admin/sellings/' . $receipt->p_i . '/delete') ?>" method="post" onsubmit="return confirm('Yakin delete pasien?')">
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
@endsection