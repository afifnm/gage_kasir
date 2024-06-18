<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->

    
    <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGASI</li>
        <li class="<?php echo activate_menu('home'); ?>">
          <a href="<?php echo site_url('admin/home');?>">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?php echo activate_menu('produksi'); ?>">
          <a href="<?php echo site_url('admin/produksi');?>">
                <i class="fa fa-opencart"></i>
                <span>Produksi</span>
            </a>
        </li>
      <li class="<?php echo activate_menu('pelanggan');  ?> treeview">
        <a href="#"><i class="fa fa-user"></i> <span>Pelanggan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        <ul class="treeview-menu">
          <li class="<?php echo activate_menu(''); ?>">
            <a href="<?php echo site_url('admin/pelanggan/broker');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Broker</span>
              </a>
          </li>
          <li class="<?php echo activate_menu(''); ?>">
            <a href="<?php echo site_url('admin/pelanggan/non');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Non Broker</span>
              </a>
          </li>
          <li class="<?php echo activate_menu(''); ?>">
            <a href="<?php echo site_url('admin/pelanggan/pajak');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Kena Pajak</span>
              </a>
          </li>
        </ul>
      </li>
        <li class="<?php echo activate_menu('piutang'); ?>">
          <a href="<?php echo site_url('admin/piutang');?>">
                <i class="fa fa-dollar"></i>
                <span>Piutang</span>
            </a>
        </li>

<?php if($this->session->userdata('level') == "Admin") {?> 

        <li class="<?php echo activate_menu('supplier'); ?>">
          <a href="<?php echo site_url('admin/supplier');?>">
                <i class="fa fa-users"></i>
                <span>Supplier</span>
            </a>
        </li>
      <li class="<?php echo activate_menu('pengeluaran');  ?> treeview">
        <a href="#"><i class="fa fa-cart-plus"></i> <span>Pengeluaran</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php echo activate_menu('pengeluaran/pendapatan'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/pendapatan');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Pendapatan</span>
              </a>
          </li>
          <li class="<?php echo activate_menu('pengeluaran/digital'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/digital');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Digital</span>
              </a>
          </li>
          <li class="<?php echo activate_menu('pengeluaran/offset'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/offset');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Offset</span>
              </a>
          </li>
          <li class="<?php echo activate_menu('pengeluaran/merchandise'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/merchandise');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Merchandise</span>
              </a>
          </li>
          <li class="<?php echo activate_menu('pengeluaran/rm'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/rm');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Rumah Tangga</span>
              </a>
          </li>
          <li class="<?php echo activate_menu('pengeluaran/prive'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/prive');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Prive</span>
              </a>
          </li>
          <!-- <li class="<?php echo activate_menu('pengeluaran/lain'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/lain');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Lain-lain</span>
              </a>
          </li>
          <li class="<?php echo activate_menu('pengeluaran/maintenance'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/maintenance');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Maintenance</span>
              </a>
          </li>
          <li class="<?php echo activate_menu('pengeluaran/zakat'); ?>">
            <a href="<?php echo site_url('admin/pengeluaran/zakat');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Zakat</span>
              </a>
          </li> -->
        </ul>
      </li>
    
<?php }?> 


      <li class="<?php echo activate_menu('pengaturan');  ?> treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Pengaturan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        <ul class="treeview-menu">
          <li class="<?php echo activate_menu('pengaturan/akun'); ?>">
            <a href="<?php echo site_url('admin/pengaturan/akun');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Akun</span>
              </a>
          </li>
<?php if($this->session->userdata('level') == "Admin") {?> 
          <li class="<?php echo activate_menu('pengaturan/user'); ?>">
            <a href="<?php echo site_url('admin/pengaturan/user');?>">
                  <i class="fa fa-circle-o text-aqua"></i>
                  <span>Daftar Pengguna Sistem</span>
              </a>
          </li>
        <li class="<?php echo activate_menu('pengaturan/profil'); ?>">
          <a href="<?php echo site_url('admin/pengaturan/profil');?>">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>Profil CV</span>
            </a>
        </li>
        <li class="<?php echo activate_menu('pengaturan/jenis'); ?>">
          <a href="<?php echo site_url('admin/pengaturan/jenis');?>">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>Kategori Produksi</span>
            </a>
        </li>
<?php } ?>
        </ul>
        <li class="<?php echo activate_menu('logout'); ?>">
          <a href="<?php echo site_url('auth/logout');?>">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
            </a>
        </li>
      </li>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
