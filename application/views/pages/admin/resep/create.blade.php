@extends('templates/layout')

@section('content')

    <style>
        /* Style for the dropdown container */
        .dropdown-container {
            position: relative;
            display: inline-block;
        }

        /* Style for the dropdown */
        .dropdown-kategori {
            position: absolute;
            top: 100%; /* Position it below the input */
            left: 0;
            background-color: #f9f9f9;
            min-width: 100px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 0;
            z-index: 1; /* Ensure it's above other elements */
        }

        /* Style for dropdown items */
        .dropdown-item {
            padding: 8px 16px;
            display: block;
            text-decoration: none;
            color: #333;
            cursor: pointer;
        }
        
        /* Style for dropdown items on hover */
        .dropdown-item:hover {
        background-color: #ddd;
        }
    </style>

    <div class="mb-4">
        <h1 class="h3 mb-2 text-gray-800">Buat resep</h1>
        <a href="<?= base_url('admin/receipts') ?>" class="btn btn-secondary btn-sm">Back</a>
    </div>

    <h1 class="h4 text-gray-600">Informasi pasien</h1>

    <div class="col-md-4">
        <label class="form-label">Dokter</label>
        <div class="input-group mb-2">
            <input type="text" value="<?= $data['patient']->dn ?>" class="form-control" disabled>
        </div>
        
        <label class="form-label">User</label>
        <div class="input-group mb-4">
            <input type="text" value="<?= $data['patient']->un ?>" class="form-control" disabled>
        </div>
    </div>
    
    
    <form action="<?= base_url('admin/receipts/' . $data['patient']->p_i . '/store') ?>" method="post">        
        <label for="">Nama Pasien</label>
        <div class="input-group mb-3">
            <input type="text" name="nama" value="<?= $data['patient']->p_n ?>" class="form-control" placeholder="Nama" aria-label="Nama" required>
        </div>

        <div class="input-group mb-3">
            <input type="date" name="tgl_lahir" value="<?= $data['patient']->p_tgl ?>" class="form-control"  placeholder="tgl_lahir-pasien" aria-label="tgl_lahir-pasien" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2">Tanggal Lahir</span>
            </div>
          </div>
          

        <label for="">No KTP Pasien</label>
        <div class="input-group mb-3">
            <input type="text" name="no_ktp" value="<?= $data['patient']->p_ktp ?>" class="form-control" minlength="16" placeholder="No KTP">
        </div>

        <label for="">No Telepon Pasien</label>
        <div class="input-group mb-3">
            <input type="text" name="no_telp" value="<?= $data['patient']->p_tlp ?>" class="form-control" placeholder="No Telepon">
        </div>

        <label for="dokter">Dokter Penangan</label>
        <select name="id_dokter" class="form-control" id="dokter">
            <option aria-readonly="true" value="<?= $data['patient']->di ?>"><?= $data['patient']->dn ?></option>
            @foreach ($data['docters'] as $docter)
                <option value="<?= $docter->id ?>"><?= $docter->nama ?></option>
            @endforeach
        </select>

        <h1 class="h3 text-gray-600 mt-4 mb-2">Detail Obat</h1>
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Obat</th>
                    <th>Kode</th>
                    <th>Harga</th>
                    <th>Satuan</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                    <th>
                        <button type="button" class="btn btn-sm btn-info" id="tambah-obat"><i class="fas fa-fw fa-plus"></i></button>
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="2" class="text-right">Total Harga</th>
                    <th colspan="2" class="text-right">
                        <input type="text" id="total_harga" name="total_harga" readonly>
                    </th>
                </tr>
            </tfoot>
            <tbody id="obat-table">
                <tr>
                    <td class="position-relative">
                        <input type="text" id="nama_1" data-row="1" class="obat input input-sm input-bordered w-full max-w-xs" autocomplete="off" required />
                        <div id="kategori_list" class="dropdown-kategori ml-4 d-none"></div>
                    </td>
                    <td>
                        <input type="text" name="kode[]" id="kode_1" class="input input-sm input-bordered w-full max-w-xs" readonly />
                        <?php echo form_error('kode[]'); ?>
                    </td>
                    <td>
                        <input type="text" id="harga_1" class="input input-sm input-bordered w-full max-w-xs" disabled />
                    </td>
                    <td>
                        <select name="satuan[]" class="select select-bordered select-sm w-full max-w-xs" required>
                            <option disabled>Satuan</option>
                            <option value="pcs">Pcs</option>
                            <option value="kpl">Kapsul</option>
                            <option value="tbl">Tablet</option>
                            <option value="btl">Botol</option>
                        </select>
                        <?php echo form_error('satuan[]'); ?>
                    </td>
                    <td>
                        <input type="number" name="qty[]" id="qty_1" data-row="1" class="input input-sm input-bordered max-w-24" required/>
                        <?php echo form_error('qty[]'); ?>
                    </td>
                    <td>
                        <input type="text" name="sub_total[]" id="subTotal_1" class="input input-sm input-bordered max-w-24" readonly />
                        <?php echo form_error('sub_total[]'); ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger delete-obat"><i class="fas fa-fw fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

    

        <button type="submit" class="btn btn-primary mt-2">Buat resep</button>
    </form>

    <script>
        $(document).ready(function () {

            $('#tambah-obat').on('click', function () {
                let newObatRow = $('#obat-table tr:last-child').clone();

                $('#obat-table').append(newObatRow);

                const lastRow = $('#obat-table tr:last-child').children().children()['0'];
                const lastRowId = parseInt($(lastRow).attr('id').split('_')[1]);
                const lastRowInput = $('#obat-table tr:last-child').find('input');
                
                lastRowInput.each(function() {
                    const oldId = $(this).attr('id');

                    const newId = oldId.replace(oldId.split('_')[1], parseInt(lastRowId) + 1);
                    $(this).attr('id', newId);

                    $(this).attr('data-row', parseInt(lastRowId) + 1);
                });

                newObatRow.find('input[type=text], input[type=number]').val('');
                newObatRow.find('select').prop('selectedIndex', 0);
            });
        });

        $(document).on('click', '.delete-obat', function () {
            if ($('#obat-table').children().length !== 1) {
                $(this).closest('tr').remove();
            }
        });

        $(document).on('keyup', '.obat', function () {
            $('#kategori_list').removeClass('d-none');

            const row = $(this).data('row');
            
            let query = $(this).val();

            if (query != '') {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>admin/obat/fetch",
                    data: {search:query},
                    success: function(data) {
                        let response = JSON.parse(data);

                        $('#kategori_list').fadeIn();
                        $('#kategori_list').html(function () {
                            let htmlElement = '';

                            response.forEach(a => {
                                htmlElement +=  "<div class='dropdown-item text-left text-sm'>" + a.merk + "</div>";
                            });

                            return htmlElement;
                        });

                        $('#kode_' + row).val(response[0].id);
                        $('#harga_' + row).val(response[0].harga);
                    }
                });

            } else {
                $('#kategori_list').addClass('d-none');
            }
        });

        $(document).on('click', '.dropdown-kategori div', function() {
            
            $('.obat').val($(this).text());
            $('#autocomplete').fadeOut();
            $('#kategori_list').addClass('d-none');
        });

        $(document).on('input', '[id^=qty_]', function() {
            const row = $(this).data('row');
            const qty = $(this).val();
            let price = $('#harga_' + row).val();

            price = parseFloat(price.replace('/[^0-9.-]+/g',""));
            
            const subTotal = qty * price;
            $('#subTotal_' + row).val(subTotal.toFixed(2));

            updateTotalPrice();
        });

        function updateTotalPrice() {
            var total = 0;
            $('[id^=subTotal_]').each(function() {
                var subtotal = parseFloat($(this).val().replace(/[^0-9.-]+/g, ""));
                if (!isNaN(subtotal)) {
                    total += subtotal;
                }
            });
            $('#total_harga').val(total.toFixed(2));
        }
    </script>
@endsection