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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title text-capitalize"><?= $this->uri->segment(2)." " ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <?php Response_Helper::part('alert') ?>
        <!-- /.box-header -->
        <!-- <div class="container"> -->
        <!-- <a href="#" data-toggle="modal" data-target="#laporan">
          <button class="btn btn-primary ">Laporan</button>
        </a> -->
        <div class="btn-group pull-right">
          <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button> -->
          <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#laporan">Penjualan</button>
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nambah-stok">Tambah</button>
        </div>
        <div class="modal fade" id="nambah-stok">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Stok</h4>
              </div>
              <form action="<?= base_url("$this->low/storeStok/".$this->uri->segment(3)) ?>" method="POST">
                <div class="modal-body">
                  <div class="form-group ">
                    <label>Produk</label>
                    <?php 
                    $pro = Input_Helper::postOrOr('id_produk', (isset($data['id_produk']) ? $data['id_produk'] : ""));
                    ?>
                    <select name="id_produk" class="form-control select2" style="width: 100%;" id="" required>
                      <option value="">Pilih Produk</option>
                      <?php
                      foreach ($produkAll as $p) {
                      ?>
                      <option <?= ($pro == $p['id'] ? 'selected' : '') ?> value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group ">
                    <label>Jumlah</label>
                    <input type="number" min="0" value='<?= Input_Helper::postOrOr('jumlah', (isset($data['jumlah']) ? $data['jumlah'] : "")) ?>' name="jumlah" class="form-control" placeholder="Masukkan jumlah" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <div class="modal fade bd-example-modal-xl" id="laporan">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Laporan Penjualan</h4>
              </div>
              <!-- <form action="<?= base_url("$this->low/transaksi/".$this->uri->segment(3)) ?>" method="POST"> -->
                <div class="modal-body">
                  <div class="form-group">
                    <label for="">Tanggal</label>
                    <div class="row">
                      <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="dari" name="from" id='datepicker1'>
                      </div>
                      <div class="col-md-2">
                        Sampai
                      </div>
                      <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="Sampai" name="from" id='datepicker2'>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="button" id="filter" class="btn btn-primary">Send</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- </div> -->
        <div class="box-body">
            <table class="table table-striped">
              <tr>
                <th>Produk</th><th>Sisa Stok</th>
              </tr>
              <?php
              $total = 0;
              foreach ($produk as $d) {
                // $total+=($d['harga'] * $d['jumlah']);
              ?>
              <tr class="<?= $d['jumlah'] < 10 ? 'bg-warning' : '' ?>">
                <td><?= $d['nama'] ?></td>
                <td><?= $d['jumlah'] ?></td>
              </tr>
              <?php } 
              
              if(count($produk) < 1){?>
              <tr>
                <td colspan="5" class="text-center">Data Kosong</td>
              </tr>
              <?php } ?>
            </table>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer">
          Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
          the plugin.
        </div> -->
      </div>
      <!-- /.box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title text-capitalize">Penjualan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <?php Response_Helper::part('alert') ?>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped" >
              <tr>
                <th>Kode</th><th>Pelanggan</th><th>Total</th><th>Tanggal</th>
              </tr>
              <?php
              $total = 0;
              foreach ($penjualan as $p) {
                $detailProduk = $this->db->query("SELECT * FROM produk p JOIN detail_transaksi dt ON p.id=dt.id_produk 
                where dt.id_transaksi='$p[id]'")->result_array();
              ?>
              
              <tr>
                <td><a href="#" data-toggle="modal" data-target="#modal-default<?=$p['id']?>"><?= KODE.$p['id'] ?></a>
                <div class="modal fade" id="modal-default<?=$p['id']?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Detail Transaksi</h4>
                    </div>
                    <div class="modal-body">
                      Pelanggan:<?= ($p['pelanggan'] == null ?  'Umum' :$p['pelanggan']) ?>
                      <table class="table ">
                          <thead>
                            <tr>
                              <th>No</th><th>Kode Barang</th><th>Nama Barang</th><th>Harga Satuan</th><th>Jumlah Beli</th><th>Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $no = 1;
                            $total = 0;
                            foreach ($detailProduk as $dp) {
                              $total+=$dp['subtotal'];
                            ?>
                            <tr>
                              <th><?= $no ?></th><th><?= $dp['id'] ?></th><th><?= $dp['nama'] ?></th><th><?= $dp['harga'] ?></th><th><?= $dp['jumlah'] ?></th><th><?= Response_Helper::toRupiah($dp['subtotal']) ?></th>
                            </tr>
                            <?php $no++;} ?>
                          </tbody>
                          <tr>
                            <td colspan="5">Total</td><td><?= Response_Helper::toRupiah($total) ?></td>
                          </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                      <button type="button" class="btn btn-primary">Cetak</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
                </td>
                <td><?= ($p['pelanggan'] == null ?  '-' :$p['pelanggan']) ?></td>
                <td><?=  Response_Helper::toRupiah($p['total_transaksi']) ?></td>
                <td><?= $p['tanggal_transaksi'] ?></td>
              </tr>
              
              <!-- /.modal -->
              
              <?php } 
              
              if(count($produk) < 1){?>
              <tr>
                <td colspan="5" class="text-center">Data Kosong</td>
              </tr>
              <?php } ?>
            </table>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer">
          Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
          the plugin.
        </div> -->
      </div>
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title text-capitalize">Karyawan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <?php Response_Helper::part('alert') ?>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped" >
              <tr>
                <th>No</th><th>Karyawan</th><th>Total Transaksi</th>
              </tr>
              <?php
              $noKaryawan=1;
              foreach ($karyawan as $k) {
              ?>
              
              <tr>
                <td><?= $noKaryawan ?></a></td>
                <td><?= ($k['nama']) ?></td>
                <td><?=  Response_Helper::toRupiah($k['total']) ?></td>
              </tr>
              
              <!-- /.modal -->
              
              <?php $noKaryawan++;} 
              
              if(count($produk) < 1){?>
              <tr>
                <td colspan="5" class="text-center">Data Kosong</td>
              </tr>
              <?php } ?>
            </table>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer">
          Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
          the plugin.
        </div> -->
      </div>

    </section>
    <!-- /.content -->
  </div>