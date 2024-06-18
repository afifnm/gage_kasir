<!DOCTYPE html>
<html>
<head>
	<title>
	<?php echo $title ?>
	</title>
	<link href='<?php echo base_url("assets/upload/images/$favicon"); ?>' rel='shortcut icon' type='image/x-icon' />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- css -->
	<link href="<?php echo base_url('assets');?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets');?>/vendor/iCheck/minimal/blue.css" rel="stylesheet">
	<link href="<?php echo base_url('assets');?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets');?>/vendor/Ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets');?>/vendor/AdminLTE-2.4.3/css/AdminLTE.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets');?>/vendor/AdminLTE-2.4.3/css/skins/_all-skins.min.css" rel="stylesheet">
	  <!-- Bootstrap time Picker -->
	<link href="<?php echo base_url('assets');?>/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<!-- jQuery 2.2.3 -->
	<script src="<?php echo base_url('assets');?>/vendor/jquery/jquery.min.js"></script>
</head>
<body>
<?php
foreach ($data2 as $produksi) {  ?>
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="<?php echo base_url('assets');?>/upload/logo.png">

            <small class="pull-right">
            	<b>#<?php echo $produksi['id_produksi']; ?> </b> <br>
            	<?php echo date("d F Y", strtotime($produksi['tanggal'])) ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            Alamat :<?php echo $alamat; ?><br>
            Phone : </i> <?php echo $phone; ?><br>
            Email : </i> <?php echo $email; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>PIC :</b> <?php echo $produksi['pic']; ?>
          <br>
          <b>Nama :</b> <?php echo $produksi['nama']; ?> <?php echo $produksi['cv']; ?>
          <br>
          <b>Contact Person </b> : <?php echo $produksi['cp']; ?><br>
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
	        	<td colspan="5" >
	Perhatian, mohon barang dicek kembali, komplain lebih dari 1 hari tidak kami layani. <br>
        	<?php echo $norek ?>
	        	</td>
              <td colspan="1" style="text-align: right;">
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
        <div class="col-xs-8">
             <table>
             <tr>
             	<td style="text-align: center; width: 200px;"> 
             	Hormat Kami
             	</td>
             	<td style="text-align: center; width: 200px"> 
             	Penerima
             	</td>
             </tr>
             <tr>
             	<td style="text-align: center; height: 40px;"> 
             	</td>
             </tr>
             <tr>
             	<td style="text-align: center; width: 200px"> 
             	<?php echo $this->session->userdata('nama') ?>
             	</td>
             	<td style="text-align: center; width: 200px"> 
             	<?php echo $produksi['nama'] ?>
             	</td>
             </tr>
            </table>       	

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
    </section>

    <?php } ?>
</body>
</html>