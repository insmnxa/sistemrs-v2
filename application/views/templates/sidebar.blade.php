<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sistem RS <sup>2</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= $this->uri->segment(2) === 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Management
    </div>

    <li class="nav-item <?= $this->uri->segment(2) === 'users' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-user"
            aria-expanded="true" aria-controls="collapse-user">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapse-user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Manajemen</h6>
                <a class="collapse-item" href="<?= base_url('admin/users') ?>">Daftar user</a>
                <a class="collapse-item" href="<?= base_url('admin/users/create') ?>">Register user</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?= $this->uri->segment(2) === 'patients' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-pasien"
            aria-expanded="true" aria-controls="collapse-pasien">
            <i class="fas fa-fw fa-user-injured"></i>
            <span>Pasien</span>
        </a>
        <div id="collapse-pasien" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pasien Manajemen</h6>
                <a class="collapse-item" href="<?= base_url('admin/patients') ?>">Daftar pasien</a>
                <a class="collapse-item" href="<?= base_url('admin/patients/create') ?>">Register pasien</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?= $this->uri->segment(2) === 'docters' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-dokter"
            aria-expanded="true" aria-controls="collapse-dokter">
            <i class="fas fa-fw fa-user-nurse"></i>
            <span>Dokter</span>
        </a>
        <div id="collapse-dokter" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Dokter Manajemen</h6>
                <a class="collapse-item" href="<?= base_url('admin/docters') ?>">Daftar Dokter</a>
                <a class="collapse-item" href="<?= base_url('admin/docters/create') ?>">Register Dokter</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?= $this->uri->segment(2) === 'obat' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-obat"
            aria-expanded="true" aria-controls="collapse-obat">
            <i class="fas fa-fw fa-book-medical"></i>
            <span>Obat</span>
        </a>
        <div id="collapse-obat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Obat Manajemen</h6>
                <a class="collapse-item" href="<?= base_url('admin/obat/create') ?>">Input Obat</a>
                <a class="collapse-item" href="<?= base_url('admin/obat/kategori-obat/create') ?>">Input Kategori Obat Baru</a>
                <a class="collapse-item" href="<?= base_url('admin/obat') ?>">Daftar Obat</a>
                <a class="collapse-item" href="<?= base_url('admin/obat/kategori-obat') ?>">Daftar Kategori Obat</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Selling
    </div>

    <li class="nav-item <?= $this->uri->segment(2) === 'receipts' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/receipts') ?>">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Peresepan</span></a>
    </li>

    <li class="nav-item <?= $this->uri->segment(2) === 'sellings' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/sellings') ?>">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Penjualan</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>