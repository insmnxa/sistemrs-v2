@extends('templates/layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Halaman Peresepan</h1>

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
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>No KTP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>No KTP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data['patients'] as $patient)    
                            <tr>
                                <td><?= $patient->p_i ?></td>
                                <td><?= $patient->p_n ?></td>
                                <td><?= $patient->p_tgl ?></td>
                                <td><?= $patient->p_ktp ?></td>
                                @if ($patient->status === 'in_queue')
                                    <td><span class="badge badge-warning"><?= $patient->status ?></span></td>
                                @else
                                    <td><span class="badge badge-success"><?= $patient->status ?></span></td>
                                @endif

                                <td class="d-flex">
                                    <a href="<?= base_url('admin/receipts/' . $patient->p_i . '/create') ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-fw fa-pencil-alt" disabled></i>
                                    </a>
                                    <a href="<?= base_url('admin/receipts/' . $patient->p_i . '/show') ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-fw fa-eye" disabled></i>
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