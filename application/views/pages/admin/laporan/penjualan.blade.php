@extends('templates/layout')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Halaman Laporan</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Penjualan</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                
                    <div class="col-md-2 row">
                        <input type="date" class="form-control mb-2" id="datepicker">
                        <a class="btn btn-sm btn-secondary mb-3" id="download-btn">Download Report</a>
                    </div>

                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Resep</th>
                                <th>Dibayar</th>
                                <th>Tagihan</th>
                            </tr>
                        </thead>
                        <tfoot id="table-footer">
                            <th colspan="2">Total Pendapatan</th>
                            <th>Rp 0,00</th>
                        </tfoot>
                        <tbody id="table-body">
                            <tr>
                                <td colspan="3" class="text-center small">No data available in this date</td>
                            </tr>
                        </tbody>
                    </table>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#datepicker').on('input', async function () {
                const reportTable = $('#table-body').get();

                let reportElement = '';

                $(reportTable).html('');

                const response = await fetch("<?= base_url('admin/sellings/fetch/') ?>" + $(this).val());
                const sellings = await response.json();

                const report = {
                    total_transactions: sellings.total_transactions.total_harga,
                    receipts: sellings.sellings
                }
                
                const rupiah = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });

                if (report.receipts.length == 0 ) {
                    reportElement +=
                    `
                        <tr>
                            <td colspan="3" class="text-center small">No data available in this date</td>
                        </tr>
                    `
                } else {
                    report.receipts.forEach(receipt => {
                        reportElement += 
                        `
                            <tr>
                                <td>${receipt.r_i}</td>
                                <td>${rupiah.format(receipt.dibayar)}</td>
                                <td>${rupiah.format(receipt.r_th)}</td>
                            </tr>
                        `
                    });
                }

                $(reportTable).append(reportElement);
                $('#table-footer th:last-child').text(`${rupiah.format(report.total_transactions ? report.total_transactions : 0)}`);

                $('#download-btn').attr('href', "<?= base_url() ?>admin/report/print/" + $(this).val());
                $('#download-btn').attr('download', '');
            });
        });
    </script>
@endsection