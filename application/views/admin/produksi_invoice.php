<?php foreach ($data2 as $produksi) { ?> 
<ol class="breadcrumb">
  <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
  <li><a href="<?php echo site_url('admin/produksi');?>">Produksi</a></li>
  <li class="active">Invoice #<?php echo $produksi['id_produksi']; ?></li>

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
            <i class="fa fa-opencart"></i> <?php echo $nama; ?>
            <small class="pull-right"><?php echo $produksi['tanggal']; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong></i> <?php echo $nama; ?></strong><br>
            </i> <?php echo $alamat; ?><br>
            Phone : </i> <?php echo $phone; ?><br>
            Email : </i> <?php echo $email; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
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
          <br>
          <b>Pembayaran :</b> <?php echo $produksi['pembayaran']; ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table id="example2" class="table table-striped">
            <thead>
            <tr>
              <th style="width: 20px;">No</th>
              <th style="text-align: center;">Deskripsi</th>
              <th style="text-align: center;">P x L</th>
              <th style="text-align: center;">Bahan</th>
              <th style="text-align: center;">Harga</th>
              <th style="text-align: center;">Jumlah</th>
              <th style="text-align: center;">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            $sum = 0;
            foreach ($data3 as $u) {
            ?>
            <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $u['deskripsi']; ?></td>
            <td style="text-align: center;">
              <?php 
              if($u['id_jenis']==1){
              echo $u['panjang'].' x '.$u['lebar'];  } else { echo '-'; }
              ?>
            </td>
            <td style="text-align: center;"><?php echo $u['bahan']; ?></td>
            <td style="text-align: right;"><?php echo 'Rp. '.number_format($u['harga'],0,",","."); ?></td>
            <td style="text-align: center;"><?php echo $u['jumlah']; ?></td>
            <td style="text-align: right;">
              <?php 
              $total = $u['panjang']*$u['lebar']*$u['harga']*$u['jumlah'];
              $sum = $sum+$total;
              echo 'Rp. '.number_format($total,0,",","."); ?>
            </td>
            </tr>
            <?php $no++; } ?>
                    <tr>
              <td colspan="6" style="text-align: right;">
                <strong> Jumlah Total </strong>
              </td>
              <td colspan="1"  style="text-align: right;"><?php echo 'Rp. '.number_format($sum,0,",","."); ?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <?php if($produksi['biaya_design']>0) { ?>
              <tr>
                <th style="width:50%">Biaya Design</th>
                <td style="text-align: right;"><?php echo 'Rp. '.number_format($produksi['biaya_design'],0,",","."); ?></td>
              </tr>
              <?php } ?>
              <?php if($produksi['diskon']>0) { $potongan = $sum*$produksi['diskon']/100; ?>
              <tr>
                <th>Diskon</th>
                <td style="text-align: right;"><?php echo number_format($produksi['diskon'],0,",","."); ?>%</td>
              </tr>
              <tr>
                <th>Potongan</th>
                <td style="text-align: right;"><?php echo '- Rp. '.number_format($potongan,0,",","."); ?></td>
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
          <a href="<?php echo site_url('admin/produksi/excel2/'.$produksi['id_produksi']);?>" class="btn btn-success" target="_blank"><i class="fa fa-credit-card"></i> Ekspor Excell
          </a>
          <a href="<?php echo site_url('admin/produksi/cetaknota/'.$produksi['id_produksi']);?>" class="btn btn-danger pull-right" target="_blank"><i class="fa fa-credit-card"></i> Cetak Nota PDF
          </a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
    <?php } ?> 