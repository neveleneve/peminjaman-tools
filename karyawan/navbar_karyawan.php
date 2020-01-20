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
            <a class="navbar-brand" href="karyawandashboard_page.php">Peminjaman Tools</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="<?php echo $current_page == 'karyawandashboard_page.php' ? 'active':NULL ?>"><a href="karyawandashboard_page.php">Dashboard</a></li>
                <li class="<?php echo $current_page == 'karyawanpinjam_page.php'  ? 'active':NULL ?>"><a href="karyawanpinjam_page.php">Peminjaman</a></li>
                <li class="<?php echo $current_page == 'karyawanpinjamanlist_page.php' ? 'active':NULL ?>"><a href="karyawanpinjamanlist_page.php">Pinjaman</a></li>
                <li class="<?php echo $current_page == 'karyawanpengembalianlist_page.php' ? 'active':NULL ?>"><a href="karyawanpengembalianlist_page.php">Pengembalian</a></li>                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> <?php echo $karyawan?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>                        
                        <li><a href="karyawansetting_page.php"><i class="fa fa-gear"></i> Ubah Password</a></li>
                        <li><a href="../proses/logout_proses.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>