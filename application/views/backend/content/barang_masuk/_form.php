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
          <form action="" method="post">
            <div class="row">
              <div class="form-group col-md-6">
                  <label>Suplier</label>
                  <?php 
                  $sup = Input_Helper::postOrOr('id_suplier', (isset($data['id_suplier']) ? $data['id_suplier'] : ""));
                  ?>
                  <select name="id_suplier" class="form-control" id="" required>
                    <option value="">Pilih Suplier</option>
                    <?php
                    foreach ($suplier as $s) {
                    ?>
                    <option <?= ($sup == $s['id'] ? 'selected' : '') ?> value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="form-group col-md-6">
                  <label>Produk</label>
                  <?php 
                  $pro = Input_Helper::postOrOr('id_produk', (isset($data['id_produk']) ? $data['id_produk'] : ""));
                  ?>
                  <select name="id_produk" class="form-control" id="" required>
                    <option value="">Pilih Produk</option>
                    <?php
                    foreach ($produk as $p) {
                    ?>
                    <option <?= ($pro == $p['id'] ? 'selected' : '') ?> value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="form-group col-md-6">
                  <label>Jumlah (ml) / (pcs)</label>
                  <input type="number" min="0" value='<?= Input_Helper::postOrOr('jumlah', (isset($data['jumlah']) ? $data['jumlah'] : "")) ?>' name="jumlah" class="form-control" placeholder="Masukkan jumlah" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Harga</label>
                  <input type="number" min="0" value='<?= Input_Helper::postOrOr('total', (isset($data['total']) ? $data['total'] : "")) ?>' name="total" class="form-control" placeholder="Masukkan jumlah" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Jenis Pembayaran</label>
                  <select class="form-control select2" name="pembayaran" style="width: 100%;" required>
                  <?php
                  $pembayaran = Input_Helper::postOrOr('pembayaran', (isset($data['pembayaran']) ? $data['pembayaran'] : ""));
                  ?>
                  <option value="">Pilih Pembayaran</option>
                    <option <?= ($pembayaran == 1 ? "selected" : "")?> value="1">Hutang</option>
                    <option <?= ($pembayaran == 2 ? "selected" : "")?> value="2">Cash</option>
                  </select>
              </div>
              <div class="form-group col-md-12">
                  <label>keterangan</label>
                  <textarea name="keterangan" class="form-control" id="" cols="30" rows="10"><?= Input_Helper::postOrOr('keterangan', (isset($data['keterangan']) ? $data['keterangan'] : "")) ?></textarea>
              </div>
              <div class="col-md-12">
                <button class="btn btn-primary"><?= $type ?></button>
              </div>
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