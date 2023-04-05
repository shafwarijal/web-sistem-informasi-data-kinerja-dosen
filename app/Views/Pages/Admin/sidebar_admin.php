<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading"></div>
                    <a class="nav-link" href="<?= base_url('admin'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">User</div>
                    <a class="nav-link" href="<?= base_url('dosen'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Dosen
                    </a>


                    <a class="nav-link <?php echo session()->get('username') != "admin" ? 'disabled' : '' ?>" href="<?= base_url('akunadmin'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Admin
                    </a>


                    <div class="sb-sidenav-menu-heading">Data</div>
                    <a class="nav-link" href="<?= base_url('penelitian'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Penelitian
                    </a>
                    <a class="nav-link" href="<?= base_url('pemakalah'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Pemakalah
                    </a>
                    <a class="nav-link" href="<?= base_url('jurnal'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Jurnal
                    </a>
                    <a class="nav-link" href="<?= base_url('hki'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        HKI
                    </a>
                    <a class="nav-link" href="<?= base_url('buku_ajar'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Buku Ajar
                    </a>

                    <div class="sb-sidenav-menu-heading">Laporan</div>
                    <a class="nav-link" href="<?= base_url('export'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-excel"></i></div>
                        EXCEL
                    </a>
                    <div class="sb-sidenav-menu-heading">Logout</div>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
                        Logout
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= session()->get('nama_admin'); ?>
            </div>
        </nav>
    </div>