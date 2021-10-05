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
          <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-md-6">
                  <label>Nama</label>
                  <input type="text" value='<?= Input_Helper::postOrOr('nama', (isset($data['nama']) ? $data['nama'] : "")) ?>' name="nama" class="form-control" placeholder="Masukkan nama anda" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Logo</label>
                  <input type="file" value='<?= Input_Helper::postOrOr('logo', (isset($data['logo']) ? $data['logo'] : "")) ?>' name="logo" class="form-control" placeholder="Masukkan logo" >
              </div>
              <div class="form-group col-md-12">
                  <label>Kurs</label>
                  <input type="number" value='<?= Input_Helper::postOrOr('kurs', (isset($data['kurs']) ? $data['kurs'] : "")) ?>' name="kurs" class="form-control" placeholder="Masukkan kurs" required>
              </div>
              <div class="form-group col-md-12">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"><?= Input_Helper::postOrOr('deskripsi', (isset($data['deskripsi']) ? $data['deskripsi'] : "")) ?></textarea>
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