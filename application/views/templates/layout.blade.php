<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>
    <script src="<?= base_url() ?>semantic/dist/semantic.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

</head>

<body id="page-top">

    <div id="wrapper">

        @include('templates.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('templates.topbar')

                <div class="container-fluid">

                    @yield('content')

                </div>

            </div>

            @include('templates.footer')

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="<?= base_url('logout') ?>" method="post">
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
