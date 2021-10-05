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
          <h3 class="box-title text-capitalize"><?= $this->uri->segment(2)." ".$data[0]['nama_produk'] ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <?php Response_Helper::part('alert') ?>
        <!-- /.box-header -->
        <div class="box-body">
          
            <table class="table table-striped">
              <tr>
                <th>Produk</th><th>Jumlah</th><th>Tanggal</th><th>Total</th>
              </tr>
              <?php
              $total = 0;
              foreach ($data as $d) {
                // $total+=($d['harga'] * $d['jumlah']);
              ?>
              <tr>
                <td><?= $d['nama_produk'] ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td><?= $d['created_at'] ?></td>
                <td><?= Response_Helper::toRupiah($d['total']) ?></td>
              </tr>
              <?php } ?>
              <!-- <tr>
                <td colspan="2"><h1>Total</h1></td><td><h1><?= Response_Helper::toRupiah($total) ?></h1></td>
              </tr> -->
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


    </section>
    <!-- /.content -->
  </div>