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
              <div class="form-group col-md-4">
                  <label>Nama</label>
                  <input type="text" value='<?= Input_Helper::postOrOr('nama', (isset($data['nama']) ? $data['nama'] : '')) ?>' name="nama" class="form-control" placeholder="Masukkan nama anda" required>
              </div>
              <div class="form-group col-md-4">
                  <label>No Telp</label>
                  <input type="text" value='<?= Input_Helper::postOrOr('no_telp', (isset($data['no_telp']) ? $data['no_telp'] : '')) ?>' name="no_telp" class="form-control" placeholder="Masukkan no_telp anda" required>
              </div>
              <div class="form-group col-md-4">
                  <label>Tipe</label>
                  <select class="form-control select2" id="tipe" name="tipe" style="width: 100%;" required>
                  <option value="">Pilih Tipe</option>
                  <?php
                  $tipe = Input_Helper::postOrOr('tipe', (isset($data['tipe']) ? $data['tipe'] : ""));
                  for ($i=1; $i < count(TIPE); $i++) {
                  ?>
                    <option <?= ($tipe == $i ? "selected" : "")?> value="<?= $i ?>"><?= TIPE[$i] ?></option>
                  <?php } ?>
                  </select>
              </div>
              <div class="form-group col-md-12">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control" id="" cols="30" rows="10"><?= Input_Helper::postOrOr('alamat', (isset($data['alamat']) ? $data['alamat'] : '')) ?></textarea>
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