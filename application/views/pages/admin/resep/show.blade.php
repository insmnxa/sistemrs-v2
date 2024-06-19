@extends('templates/layout')

@section('content')
    <h1 class="h3 mb-3 text-gray-800">Halaman Resep</h1>
    <a href="<?= base_url('admin/receipts') ?>" class="btn btn-secondary btn-sm">Back</a>
    <hr>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nama-pasien">Nama Pasien</label>
        <input type="text" value="<?= $data['result']->p_nama ?>" class="form-control" id="nama-pasien" disabled>
      </div>
      <div class="form-group col-md-6">
        <label for="nama-dokter">Nama Dokter</label>
        <input type="text" value="<?= $data['result']->d_n ?>" class="form-control" id="nama-dokter" disabled>
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Diresepkan pada</label>
            <input type="date" value="<?= $data['result']->r_dp ?>" class="form-control" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="inputAddress">ID Resep</label>
            <input type="text" value="<?= $data['result']->r_i ?>" class="form-control" disabled>
        </div>
    </div>

    <h1 class="h3 mb-2 mt-3 text-gray-800">Detail Obat</h1>
    <hr>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Merk Obat</th>
                <th>Satuan</th>
                <th>Qty</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="3">Total Harga</th>
                <th>Rp <?= $data['result']->r_th ?>,-</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($data['result']->detail_resep as $row)    
                <tr>
                    <td><?= $row->merk_obat ?></td>
                    <td><?= $row->satuan ?></td>
                    <td><?= $row->qty ?></td>
                    <td>Rp <?= $row->sub_total ?>,-</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection