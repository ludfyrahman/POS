<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title ?>
        <!-- <small>advanced tables</small> -->
      </h1>
     <?php Response_Helper::part('breadcrumb') ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?= $title ?></h3>
              <a href="<?= base_url('')."/".$this->uri->segment(1)."/add" ?>">
                <button class="btn btn-primary pull-right">Transaksi Baru</button>
              </a>
            </div>
            <?php Response_Helper::part('alert') ?>
            <!-- /.box-header -->
            <?php 
            $field = "
            <tr>
                  <th>No</th>
                  <th>Waktu Transaksi</th>
                  <th>Total Transaksi</th>
                  <th>Pembayaran</th>
                  <th>Aksi</th>
                </tr>
            ";
            ?>
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <?= $field ?>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($data as $d) {
                    ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $d['waktu_transaksi'] ?></td>
                    <td><?= Response_Helper::toRupiah($d['total_transaksi']) ?></td>
                    <td><?= Pembayaran[$d['pembayaran']] ?></td>
                    <td><a href="<?= base_url('transaksi/detail/'.$d['id']) ?>"><span class="badge bg-blue"><i class="fa fa-book"></i></span></a></td>
                  </tr>
                  <?php $no++;} ?>
                </tbody>
                <tfoot>
                <?= $field ?>
                </tfoot>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>