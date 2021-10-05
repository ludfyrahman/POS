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
              <div class="form-group col-md-12">
                  <label>Nama</label>
                  <input type="text" value='<?= Input_Helper::postOrOr('nama', (isset($data['nama']) ? $data['nama'] : '')) ?>' name="nama" class="form-control" placeholder="Masukkan nama produk" required>
              </div>
              <div class="form-group col-md-8">
                  <label>Harga</label>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group">
                      <input type="number"  step="any" value='<?= Input_Helper::postOrOr('harga', (isset($data['harga']) ? $data['harga'] : '')) ?>' name="harga" class="form-control" placeholder="harga " required>
                        <div class="input-group-addon">
                          /ml
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group">
                      <input type="number"  step="any" value='<?= Input_Helper::postOrOr('100gr', (isset($data['100gr']) ? $data['100gr'] : '')) ?>' name="100gr" class="form-control" placeholder="100gr " required>
                        <div class="input-group-addon">
                          /100gr
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group">
                      <input type="number"  step="any" value='<?= Input_Helper::postOrOr('500gr', (isset($data['500gr']) ? $data['500gr'] : '')) ?>' name="500gr" class="form-control" placeholder="500gr " required>
                        <div class="input-group-addon">
                          /500gr
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group">
                      <input type="number"  step="any" value='<?= Input_Helper::postOrOr('kg', (isset($data['kg']) ? $data['kg'] : '')) ?>' name="kg" id="kg" class="form-control" placeholder="kg " required>
                        <div class="input-group-addon">
                          /kg
                        </div>
                      </div>
                    </div>
                  </div>
                  
              </div>
              <div class="form-group col-md-4">
                  <label>Kategori</label>
                  <?php 
                  $pro = Input_Helper::postOrOr('id_kategori', (isset($data['id_kategori']) ? $data['id_kategori'] : ""));
                  ?>
                  <select name="id_kategori" class="form-control" id="" required>
                    <option value="">Pilih Kategori</option>
                    <?php
                    foreach ($kategori as $p) {
                    ?>
                    <option <?= ($pro == $p['id'] ? 'selected' : '') ?> value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                    <?php } ?>
                  </select>
              </div>
              <!-- <div class="form-group col-md-6">
                  <label>Stok</label>
                  <input type="number" <?= ($type == 'Ubah' ? 'disabled' : '') ?> min="0" value='<?= Input_Helper::postOrOr('stok', (isset($data['stok']) ? $data['stok'] : '')) ?>' name="stok" class="form-control" placeholder="Masukkan stok" required>
              </div> -->
              <div class="form-group col-md-12">
                  <label>Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" id="" cols="30" placeholder="Deskripsi" rows="10"><?= Input_Helper::postOrOr('deskripsi', (isset($data['deskripsi']) ? $data['deskripsi'] : '')) ?></textarea>
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