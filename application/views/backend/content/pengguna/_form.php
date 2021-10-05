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
                  <label>Nama</label>
                  <input type="text" value='<?= Input_Helper::postOrOr('nama', (isset($data['nama']) ? $data['nama'] : "")) ?>' name="nama" class="form-control" placeholder="Masukkan nama anda" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Username</label>
                  <input type="username" value='<?= Input_Helper::postOrOr('username', (isset($data['username']) ? $data['username'] : "")) ?>' name="username" class="form-control" placeholder="Masukkan username anda" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Password</label>
                  <input type="password" value='<?= Input_Helper::postOrOr('password') ?>' name="password" class="form-control" placeholder="Masukkan password anda" <?= ($type == 'Tambah' ? 'required' : '') ?>>
              </div>
              <div class="form-group col-md-6">
                  <label>Password Konfirmasi</label>
                  <input type="password" value='<?= Input_Helper::postOrOr('password_konfirmasi') ?>' name="password_konfirmasi" class="form-control" placeholder="Masukkan password konfirmasi anda" <?= ($type == 'Tambah' ? 'required' : '') ?>>
              </div>
              <div class="form-group col-md-6">
                  <label>Level</label>
                  <select class="form-control select2" id="level" name="level" style="width: 100%;">
                  <?php
                  $level = Input_Helper::postOrOr('level', (isset($data['level']) ? $data['level'] : ""));
                  for ($i=1; $i < count(LEVEL); $i++) {
                  ?>
                    <option <?= ($level == $i ? "selected" : "")?> value="<?= $i ?>"><?= LEVEL[$i] ?></option>
                  <?php } ?>
                  </select>
              </div>
              <div class="form-group col-md-6">
                  <label>Status</label>
                  <select class="form-control select2" name="status" style="width: 100%;">
                  <?php
                  $status = Input_Helper::postOrOr('status', (isset($data['status']) ? $data['status'] : ""));
                  ?>
                    <option <?= ($status == 1 ? "selected" : "")?> value="1">Aktif</option>
                    <option <?= ($status == 0 ? "selected" : "")?> value="0">Tidak Aktif</option>
                  </select>
              </div>
              <div class="form-group col-md-6 hide" id="toko">
                  <label>Toko</label>
                  <?php 
                  $sup = Input_Helper::postOrOr('id_toko', (isset($data['id_toko']) ? $data['id_toko'] : ""));
                  ?>
                  <select name="id_toko" class="form-control" id="" required>
                    <option value="">Pilih Toko</option>
                    <?php
                    foreach ($toko as $s) {
                    ?>
                    <option <?= ($sup == $s['id'] ? 'selected' : '') ?> value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                    <?php } ?>
                  </select>
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