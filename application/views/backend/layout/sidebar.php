<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= Account_Helper::get('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php 
        if($_SESSION['userlevel'] == 1){
        ?>
        <li class="">
          <a href="<?= base_url() ?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?= ($this->uri->segment(1) == 'pengguna' ? 'active' : '') ?>"><a href="<?= base_url('pengguna') ?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
        <li class="<?= ($this->uri->segment(1) == 'kategori' ? 'active' : '') ?>"><a href="<?= base_url('kategori') ?>"><i class="fa fa-bus"></i> <span>Kategori</span></a></li>
        <li class="<?= ($this->uri->segment(1) == 'suplier' ? 'active' : '') ?>"><a href="<?= base_url('suplier') ?>"><i class="fa fa-bus"></i> <span>Suplier</span></a></li>
        <li class="<?= ($this->uri->segment(1) == 'toko' ? 'active' : '') ?>"><a href="<?= base_url('toko') ?>"><i class="fa fa-list"></i> <span>Toko</span></a></li>
        <li class="<?= ($this->uri->segment(1) == 'pelanggan' ? 'active' : '') ?>"><a href="<?= base_url('pelanggan') ?>"><i class="fa fa-list"></i> <span>Pelanggan</span></a></li>
        
        <li class="<?= ($this->uri->segment(1) == 'barang_masuk' ? 'active' : '') ?>"><a href="<?= base_url('barang_masuk') ?>"><i class="fa fa-product-hunt"></i> <span>Barang Masuk</span></a></li>
        <li class="<?= ($this->uri->segment(1) == 'pengaturan' ? 'active' : '') ?>"><a href="<?= base_url('pengaturan') ?>"><i class="fa fa-gear"></i> <span>Pengaturan</span></a></li>
        <!-- <li class="<?= ($this->uri->segment(1) == 'barang_keluar' ? 'active' : '') ?>"><a href="<?= base_url('barang_keluar') ?>"><i class="fa fa-list"></i> <span>Penjualan</span></a></li> -->
        <?php }
        if($_SESSION['userlevel'] == 1 || $_SESSION['userlevel'] == 2){ ?>
        <li class="<?= ($this->uri->segment(1) == 'produk' ? 'active' : '') ?>"><a href="<?= base_url('produk') ?>"><i class="fa fa-list"></i> <span>Produk</span></a></li>
        <li class="<?= ($this->uri->segment(1) == 'transaksi' ? 'active' : '') ?>"><a href="<?= base_url('transaksi') ?>"><i class="fa fa-money"></i> <span>Transaksi</span></a></li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>