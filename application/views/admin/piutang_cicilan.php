<?php foreach ($data2 as $produksi) { ?> 
<ol class="breadcrumb">
  <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
  <li><a href="<?php echo site_url('admin/piutang');?>">Data Piutang</a></li>
  <li class="active">Bayar #<?php echo $produksi['id_produksi']; ?></li>

</ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-dollar"></i> Cicilan Piutang
            <small class="pull-right"><?php echo $produksi['tanggal']; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong><?php echo $produksi['nama']; ?></strong> <?php echo $produksi['cv']; ?><br>
            <?php echo $produksi['alamat']; ?><br>
            Contact Person : <?php echo $produksi['cp']; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Nomor Nota #<?php echo $produksi['id_produksi']; ?></b><br>
          <b>PIC :</b> <?php echo $produksi['pic']; ?>
          <br>
          <b>ID Client :</b> <?php echo $produksi['id_pelanggan']; ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="example" class="table table-striped">
            <thead>
            <tr>
              <th style="width: 20px;">No</th>
              <th style="text-align: center;">Cicilan Ke</th>
              <th style="text-align: center;">Pembayaran</th>
              <th style="text-align: center;">Nominal</th>
              <th style="text-align: center;">Sisa Tagihan</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1; $sum = 0; $total_tagihan = $produksi['total_tagihan'];
            foreach ($data3 as $u) {
            ?>
            <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $u['cicilan_ke']; ?></td>
            <td style="text-align: center;"><?php echo $u['pembayaran']; ?></td>
            <td style="text-align: right;"><?php echo 'Rp. '.number_format($u['nominal'],0,",","."); ?></td>
            <td style="text-align: right;"><?php echo 'Rp. '.number_format($total_tagihan-$u['nominal'],0,",","."); ?></td>
            </tr>
            <?php 
            $total_tagihan = $total_tagihan-$u['nominal'];
            $no++; } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-8">   
         <div class="box-body">
          <form class="form-horizontal" method="post" action="<?php echo site_url('admin/piutang/bayarpiutang');?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 control-label">Nominal</label>
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="number" class="form-control" name="nominal" min="0" step="1" required>
                    <input type="hidden" class="form-control" name="id_produksi" value="<?php echo $produksi['id_produksi']; ?>">
                    <input type="hidden" class="form-control" name="sisa_tagihan" value="<?php echo $produksi['sisa_tagihan']; ?>">
                  </div>
                </div>
              </div> 
              <div class="form-group">
                <label class="col-sm-3 control-label">Pembayaran</label>
                <div class="col-sm-6">
                  <select class="form-control select" name="pembayaran" required>
                  <option value="Tunai"> Tunai </option>
                  <option value="Bank"> Bank </option>
                  </select>
                  <hr>
                  <button type="submit" class="form-control btn btn-danger pull-right">Bayar</button>
                </div>
              </div>  
            </div>
          </form>
        </div>      
        </div>
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <?php if($produksi['biaya_design']>0) { ?>
              <tr>
                <th style="width:50%">Biaya Design</th>
                <td style="text-align: right;"><?php echo 'Rp. '.number_format($produksi['biaya_design'],0,",","."); ?></td>
              </tr>
              <?php } ?>
              <tr>
                <th>Total Tagihan</th>
                <td style="text-align: right;"><strong><?php echo 'Rp. '.number_format($produksi['total_tagihan'],0,",","."); ?></strong></td>
              </tr>
              <tr>
                <th>Sudah Dibayar</th>
                <td style="text-align: right;"><?php echo 'Rp. '.number_format($produksi['total_tagihan']-$produksi['sisa_tagihan'],0,",","."); ?></td>
              </tr>
              <tr>
                <th>Sisa Tagihan</th>
                <td style="text-align: right;"><?php echo 'Rp. '.number_format($produksi['sisa_tagihan'],0,",","."); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo site_url('admin/piutang/');?>" class="btn btn-default pull-left"></i> Kembali
          </a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
    <?php } ?> 