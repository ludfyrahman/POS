<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title ?>
        <!-- <small>Preview</small> -->
      </h1>
      <?php Response_Helper::part('breadcrumb') ?>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $this->uri->segment(2) ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <?php Response_Helper::part('alert') ?>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="<?= base_url('transaksi/tambah_detail') ?>" method="post">
          
            <div class="row">
              <?php 
              if(Account_Helper::getTipe() == '1'){
              ?>
              <div class="form-group col-md-6">
                  <label>Jenis</label>
                  <select class="form-control select2" id="jenis" name="jenis" style="width: 100%;" >
                  <option value="">Pilih Jenis</option>
                  <?php
                  $jenis = Input_Helper::postOrOr('jenis', (isset($data['jenis']) ? $data['jenis'] : ""));
                  for ($i=1; $i < count(TIPE); $i++) {
                  ?>
                    <option <?= ($jenis == $i ? "selected" : "")?> value="<?= $i ?>"><?= TIPE[$i] ?></option>
                  <?php } ?>
                  </select>
              </div>
              <?php } ?>
                <div class="form-group col-md-6">
                    <label>Produk</label>
                    <?php 
                    $pro = Input_Helper::postOrOr('id_produk', (isset($data['id_produk']) ? $data['id_produk'] : '-'));
                    ?>
                    <select name="id_produk" class="form-control" id="id_produk" required>
                      <option value="">Pilih Produk</option>
                      <?php
                      foreach ($produk as $p) {
                      ?>
                      <option <?= ($pro == $p['id'] ? 'selected' : '') ?> value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                      <?php } ?>
                    </select>
                    <input type="hidden" value="0" id="harga">
                </div>
                <div class="form-group col-md-6">
                  <span>Jumlah (ml/pcs)</span>
                    <input type="number" id="jumlah" min="1" value='<?= Input_Helper::postOrOr('jumlah', 1) ?>' name="jumlah" class="form-control" placeholder="Masukkan jumlah " >
                    <select class="form-control  d-none" id="tipe" name="tipe" style="width: 100%;">
                      <option value="">Pilih Jumlah</option>
                      <?php
                      $tipe = Input_Helper::postOrOr('tipe', (isset($data['tipe']) ? $data['tipe'] : ""));
                      for ($i=0; $i < count(BARANG_JUAL); $i++) {
                      ?>
                        <option value="<?= BARANG_JUAL[$i] ?>"><?= BARANG_JUAL[$i] ?></option>
                      <?php } ?>
                      </select>
                </div>
              
                <div class="col-md-2">
                  <h1 style="margin:0!important" id="subtotal">Rp 0</h1>
                </div>
              </div>
              <button class="pull-right btn-primary btn duplicate" type="submit"><i class="fa fa-plus"></i> Tambahkan</button>
            
            </form>
            <table class="table table-striped" id="table">
              <tr>
                <th>Produk</th><th>Jumlah</th><th>Total</th><th>Aksi</th>
              </tr>
              <?php
              $total = 0;
              foreach ($order as $d) {
                $total+=$d['subtotal'];
              ?>
              <tr>
                <td><?= $d['nama_produk'] ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td><?= Response_Helper::toRupiah($d['subtotal']) ?></td>
                <td>
                  <a href="<?= base_url($this->uri->segment(1)."/delete/".$d['id']) ?>" class="delete"><span class="badge bg-red"><i class="fa fa-trash"></i></span></a>
                </td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="2"><h1>Total</h1></td><td colspan="2"><h1><?= Response_Helper::toRupiah($total) ?></h1><input type="hidden" id="total" value="<?= $total ?>"></td>
              </tr>
            </table>
            <form action="<?= base_url('transaksi/store') ?>" method="post">
              <input type="hidden" value="<?= $total ?>" name="total_transaksi">
              <div class="form-group col-md-6">
                    <label>Pelanggan</label>
                    <?php 
                    $pel = Input_Helper::postOrOr('id_pelanggan', (isset($data['id_pelanggan']) ? $data['id_pelanggan'] : '-'));
                    ?>
                    <select name="id_pelanggan" class="form-control" id="id_pelanggan" >
                      <option value="">Pilih Pelanggan</option>
                      <?php
                      foreach ($pelanggan as $pl) {
                      ?>
                      <option <?= ($pel == $pl['id'] ? 'selected' : '') ?> value="<?= $pl['id'] ?>"><?= $pl['nama'] ?></option>
                      <?php } ?>
                    </select>
                    <input type="hidden" value="0" id="harga">
                </div>
                <div class="form-group col-md-6">
                  <label>Jenis Pembayaran</label>
                  <select class="form-control select2" name="pembayaran" style="width: 100%;" required>
                  <?php
                  $pembayaran = Input_Helper::postOrOr('pembayaran', (isset($data['pembayaran']) ? $data['pembayaran'] : ""));
                  ?>
                  <option value="">Pilih Pembayaran</option>
                    <option <?= ($pembayaran == 1 ? "selected" : "")?> value="3">Piutang</option>
                    <option <?= ($pembayaran == 2 ? "selected" : "")?> value="2">Cash</option>
                  </select>
              </div>
             <div class="bayar">
             <div class="form-group col-md-6 ">
                <label for="">Bayar</label>
                <input type="number" class="form-control" id="bayar" name="bayar">
              </div>
              <div class="col-md-6">
                <h1>Kembalian: <span id="kembalian"></span></h1>
                <input type="hidden" name="kembalian">
              </div>
             </div>
              <div style="clear:both"></div>
              <div class="form-group">
              <button type="submit" id="simpan" class="d-none btn btn-primary" onclick="return confirm('apakah data sudah sesuai?')">Simpan</button>
              </div>
            </form>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer">
          Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
          the plugin.
        </div> -->
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>