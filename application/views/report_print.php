<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body>
    <h4 class="font-weight-bold mt-4 mb-2">Data penjualan</h4>
    <p class="small">Tanggal: <?= $data['transaction_date'] ?></p>

    <table class="table table-sm table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID Resep</th>
                <th>Pasien</th>
                <th>Tagihan</th>
                <th>Dibayar</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php if (count($data['sellings']) < 1) :  ?>
                <tr>
                    <td colspan="3" class="text-center small">No data available in this date</td>
                </tr>
            <?php else : ?>
                <?php foreach ($data['sellings'] as $selling) : ?>
                    <tr>
                        <td><?= $selling->r_i ?></td>
                        <td><?= $selling->p_n ?></td>
                        <td class="text-monospace">Rp <?= number_format($selling->r_th, 2, ',', '.') ?></td>
                        <td class="text-monospace">Rp <?= number_format($selling->dibayar, 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot id="table-footer">
            <th colspan="2">Total Pendapatan</th>
            <?php if (count($data['sellings']) < 1) : ?>
                <th colspan="2">Rp 0,00</th>
            <?php else : ?>
                <th colspan="2">Rp <?= number_format($data['total_transactions'], 2, ',', '.') ?></th>
            <?php endif; ?>
        </tfoot>
    </table>

</body>

</html>