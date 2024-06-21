@extends('templates/layout')

@section('content')
    <h1 class="h3 mb-3 text-gray-800">Halaman Resep</h1>
    <a href="<?= base_url('admin/sellings') ?>" class="btn btn-secondary btn-sm">Back</a>
    <hr>

    <form action="<?= base_url('admin/sellings/store') ?>" method="post">

        <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nama-pasien">Nama Pasien</label>
            <input type="text" value="<?= $data['receipt']->p_nama ?>" class="form-control" id="nama-pasien" disabled>
        </div>
        <div class="form-group col-md-6">
            <label for="nama-dokter">Nama Dokter</label>
            <input type="text" value="<?= $data['receipt']->d_n ?>" class="form-control" id="nama-dokter" disabled>
        </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress">Diresepkan pada</label>
                <input type="date" value="<?= $data['receipt']->r_dp ?>" class="form-control" disabled>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress">ID Resep</label>
                <input type="text" name="id_resep" value="<?= $data['receipt']->r_i ?>" class="form-control" readonly>
            </div>
        </div>

        <h1 class="h3 mb-2 mt-3 text-gray-800">Detail Obat</h1>
        <hr>

        <table class="table table-bordered" width="100%" cellspacing="0">
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
                    <th>Rp <span id="total_harga"><?= $data['receipt']->r_th ?></span>,-</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data['receipt']->detail_resep as $row)    
                    <tr>
                        <td><?= $row->merk_obat ?></td>
                        <td><?= $row->satuan ?></td>
                        <td><?= $row->qty ?></td>
                        <td>Rp <?= $row->sub_total ?>,-</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-md-4">
            <div class="input-group row mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Dibayar</span>
                </div>            
                <input type="text" name="dibayar" class="form-control" id="dibayar" autofocus>
            </div>

            <div class="input-group row mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Kembali</span>
                </div>            
                <input type="text" name="kembali" class="form-control" id="kembali" readonly>
            </div>

            <div class="input-group row mb-3">
                <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
        </div>
    </form>


    <script>
        $(document).ready(function () {
            $('#dibayar').on('input', function () {
                const totalHarga = parseFloat($('#total_harga').text())
                const dibayar = parseFloat(this.value);
                const kembali = dibayar - totalHarga;

                $('#kembali').val((kembali <= 0) ? 0 : kembali);
            });
        });
    </script>

@endsection