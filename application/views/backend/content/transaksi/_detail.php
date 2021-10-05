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
            <div class="row">
              <div class="col-md-4 form-group">
                <b>Toko</b>
                <p><?= $detail['toko'] ?></p>
              </div>
              <div class="col-md-4 form-group">
                <b>Kasir</b>
                <p><?= $detail['kasir'] ?></p>
              </div>
              <div class="col-md-4 form-group">
                <b>Alamat</b>
                <p><?= $detail['alamat'] ?></p>
              </div>
            </div>
            <table class="table table-striped">
              <tr>
                <th>Produk</th><th>Jumlah</th><th>Subtotal</th>
              </tr>
              <?php
              $total = 0;
              foreach ($data as $d) {
                $total+=($d['subtotal']);
              ?>
              <tr>
                <td><?= $d['nama_produk'] ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td><?= Response_Helper::toRupiah($d['subtotal']) ?></td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="2"><h1>Total</h1></td><td><h1><?= Response_Helper::toRupiah($total) ?></h1></td>
              </tr>
              <tr>
                <td colspan="2"><h1>Tunai</h1></td><td><h1><?= Response_Helper::toRupiah($detail['bayar']) ?></h1></td>
              </tr>
              <tr>
                <td colspan="2"><h1>Kembalian</h1></td><td><h1><?= Response_Helper::toRupiah($detail['kembalian']) ?></h1></td>
              </tr>
            </table>
            <?php 
            $isWebView = false;
            $url = base_url('transaksi/printPdf/'.$transaksi);
            if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) {
                $isWebView = true;
                $url = "activity_a://a/".$transaksi;
            }elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                $isWebView = true;
                $url = "activity_a://a/".$transaksi;
            }
            ?>
            <a href="<?= $url ?>"><button class="btn btn-primary">print</button></a>
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