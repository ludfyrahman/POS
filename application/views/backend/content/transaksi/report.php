<div class="content-wrapper">
    <section class="content-header">
    </section>

    <?php if(count($data) < 1){ ?>
        <div class="pad margin no-print">
      <div class="callout callout-warning" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Catatan:</h4>
        Data yang anda cari masih belum tersedia untuk saat ini
      </div>
    </div>
    <?php } ?>
    <section class="invoice">
        <div class="form-group">
            <label for="">Produk</label>
            <?php 
            $end = $this->uri->segment(count($this->uri->segment_array()));
            // print_r($end);
                $bar = Input_Helper::postOrOr('barang', $end);
            ?>
            <select name="barang" class="form-control" id="filter_produk" required>
            <option value="">Pilih Barang</option>
            <?php
            foreach ($barang as $b) {
            ?>
            <option <?= ($bar == $b['id'] ? 'selected' : '') ?> value="<?= $b['id'] ?>"><?= $b['nama'] ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#nota" data-toggle="tab">Nota</a></li>
                <li><a href="#produk" data-toggle="tab">Produk</a></li>
                
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="nota">
                <?php foreach ($data as $d) { ?>
                <!-- Main content -->
                <section class="">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?= Account_Helper::kurs('nama') ?>
                        <!-- <small class="pull-right">Date: 2/10/2014</small> -->
                    </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong><?= $d['pengguna'].",".$d['toko'] ?></strong><br>
                        <p><?= $d['toko'] ?></p>
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?= (is_null($d['pelanggan']) ? "Umum" : $d['pelanggan']) ?></strong><br>
                        <p><?= $d['alamat_pelanggan'] ?></p>
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                    <b>Invoice #<?= date("Ymd").$d['id'] ?></b><br>
                    <br>
                    <!-- <b>Order ID:</b> 4F3S8J<br> -->
                    <b>Tanggal Transaksi:</b> <?= $d['tanggal_transaksi'] ?><br>
                    <!-- <b>Account:</b> 968-34567 -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($d['detail'] as $dt) { ?>
                            <tr>
                            <td><?= $dt['jumlah'] ?></td>
                            <td><?= $dt['produk'] ?></td>
                            <td><?= Response_Helper::toRupiah($dt['harga']) ?></td>
                            <td><?= Response_Helper::toRupiah($dt['subtotal']) ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                    <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                    <div class="table-responsive">
                        <table class="table table-striped">
                        <tr>
                            <th style="width:50%">Total:</th>
                            <td><?= Response_Helper::toRupiah($d['total_transaksi']) ?></td>
                        </tr>
                        <tr>
                            <th>Bayar:</th>
                            <td><?= Response_Helper::toRupiah($d['bayar']) ?></td>
                        </tr>
                        <tr>
                            <th>Kembalian:</th>
                            <td><?= Response_Helper::toRupiah($d['kembalian']) ?></td>
                        </tr>
                        </table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <!-- <div class="row no-print">
                    <div class="col-xs-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Generate PDF
                    </button>
                    </div>
                </div> -->
                </section>
                <!-- /.content -->
                <div class="clearfix"></div>
                <?php } ?>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="produk">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($produk as $p) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $p['jumlah'] ?></td>
                                    <td><?= $p['produk'] ?></td>
                                    <td><?= Response_Helper::toRupiah($p['harga']) ?></td>
                                    <td><?= Response_Helper::toRupiah($p['subtotal']) ?></td>
                                    <td><?= $p['tanggal_transaksi'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
                <!-- /.tab-content -->
        </div>
    </section>
</div>