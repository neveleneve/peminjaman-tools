<nav class="navbar navbar-default navbar-fixed-top">
    <?php
        function PageName() {
            return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
        }      
        $current_page = PageName();
    ?>
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admindashboard_page.php">Peminjaman Tools</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="<?php echo $current_page == 'admindashboard_page.php' ? 'active':NULL ?>"><a href="admindashboard_page.php">Dashboard</a></li>
                <li class="<?php echo $current_page == 'admintoolslist_page.php' || $current_page == 'adminedittool_page.php' || $current_page == 'admintambahtool_page.php' ? 'active':NULL ?>"><a href="admintoolslist_page.php">Data Tools</a></li>
                <li class="<?php echo $current_page == 'adminkaryawanlist_page.php' || $current_page == 'admintambahkaryawan_page.php' ? 'active':NULL ?>"><a href="adminkaryawanlist_page.php">Karyawan</a></li>
                <li class="<?php echo $current_page == 'adminpeminjamanlist_page.php' || $current_page == 'adminlihatpeminjamanuser_page.php'? 'active':NULL ?>"><a href="adminpeminjamanlist_page.php">Peminjaman</a></li>
                <li class="<?php echo $current_page == 'adminpengembalianlist_page.php' ? 'active':NULL ?>"><a href="adminpengembalianlist_page.php">Pengembalian</a></li>
                <li class="<?php echo $current_page == 'adminreport_page.php' ? 'active':NULL ?>"><a href="adminreport_page.php">Cetak Laporan</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> <?php echo $namaadmin ?><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="adminsetting_page.php"><i class="fa fa-gear"></i> Ubah Password</a></li>
                        <li><a href="proses/logout_proses.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>