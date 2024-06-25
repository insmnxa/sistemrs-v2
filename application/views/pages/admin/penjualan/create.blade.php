@extends('templates/layout')

@php
    use Brick\Money\Money;
@endphp

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
                    <th><span id="total_harga"><?= Money::of($data['receipt']->r_th, 'IDR')->formatTo('id_ID') ?></span>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data['receipt']->detail_resep as $row)
                    <tr>
                        <td><?= $row->merk_obat ?></td>
                        <td><?= $row->satuan ?></td>
                        <td><?= $row->qty ?></td>
                        <td><?= Money::of($row->sub_total, 'IDR')->formatTo('id_ID') ?></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-md-4">
            <div class="input-group row mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Rp</span>
                </div>
                <input type="text" name="dibayar" class="form-control" id="dibayar" autofocus>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon3">Dibayar</span>
                </div>
            </div>

            <div class="input-group row mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Rp</span>
                </div>
                <input type="text" name="kembali" class="form-control" id="kembali" readonly>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon3">Kembali</span>
                </div>
            </div>

            <div class="input-group row mb-3">
                <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            $('#dibayar').on('keyup', function() {
                const totalHarga = "<?= $data['receipt']->r_th ?>"
                const dibayar = parseFloat(this.value);
                const kembali = $(this).val().split('.').join('') - totalHarga;

                $(this).val(formatRupiah($(this).val()));

                $('#kembali').val((kembali <= 0) ? 0 : kembali);

            });
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
