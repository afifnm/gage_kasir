<?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=nota.xls");
 header("Pragma: no-cache");
 header("setWrapText: false");
 header("Expires: 0");
foreach ($data2 as $produksi) {  ?>
<table>
  <tr> 
    <td style="height: 45px;"><img style="width: 230px;height: 45px;" src="<?php echo base_url('assets');?>/upload/logo.png"> </td>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> <b>#<?php echo $produksi['id_produksi']; ?> </td>
  </tr>
</table>
<table>
  <tr>
    <td> Alamat</td>
    <td> : <?php echo $alamat; ?> </td>
    <td style="width: 100px"> </td>
    <td> PIC</td>
    <td> : <?php echo $produksi['pic']; ?> </td>
    <td> Nama</td>
    <td> : <?php echo $produksi['nama']; ?> </td>
  </tr>
  <tr>
    <td> Phone</td>
    <td> : <?php echo $phone; ?> </td>
    <td style="width: 100px"> </td>
    <td> Tanggal</td>
    <td> : <?php echo mediumdate_indo($produksi['tanggal']); ?> </td>
    <td> Alamat</td>
    <td> : <?php echo $produksi['alamat']; ?> </td>
  </tr>
  <tr>
    <td> Email</td>
    <td> : <?php echo $email; ?> </td>
    <td style="width: 100px"> </td>
    <td> </td>
    <td> </td>
    <td> Contact Person</td>
    <td> : <?php echo $produksi['cp']; ?> </td>
  </tr>
</table>
  <table>
    <thead>
    <tr style="border-top: solid 1px black; border-bottom: solid 1px black;">
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
    <tr style="border-bottom: solid 1px black;">
    <td style="text-align: center;"><?php echo $no; ?></td>
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
    </tbody>
  </table>
  Perhatian, mohon barang dicek kembali, komplain lebih dari 1 hari tidak kami layani <br>
  <?php echo $norek ?>
<table>
  <?php if($produksi['biaya_design']>0) {  ?>
  <tr>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> Biaya Design </td>
    <td style="text-align: right;"> <?php echo 'Rp. '.number_format($produksi['biaya_design'],0,",","."); ?></td>
  </tr>
  <?php } ?>
  <?php if($produksi['diskon']>0) { $potongan = $sum*$produksi['diskon']/100; ?>
  <tr>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td> 
    <td> Potongan </td>
    <td style="text-align: right;"> <?php echo '- Rp. '.number_format($potongan,0,",","."); ?></td>
  </tr>
 <?php } ?>
</table>
          

<table>
  <tr>
    <td> </td>
    <td> Hormat kami</td>
    <td> </td>
    <td> Penerima </td>
    <td style="width: 70px;"> </td>
    <td> Total Tagihan </td>
    <td style="text-align: right;"> <?php echo 'Rp. '.number_format($produksi['total_tagihan'],0,",","."); ?></td>
  </tr>
  <tr>
    <td>  </td>
    <td>  </td>
    <td>  </td>
    <td> </td>
    <td> </td>
    <td> Bayar </td>
    <td style="text-align: right;"> <?php echo 'Rp. '.number_format($produksi['total_tagihan']-$produksi['sisa_tagihan'],0,",","."); ?></td>
  </tr>
  <tr>
    <td> </td>
    <td> <?php echo $this->session->userdata('nama') ?></td>
    <td style="width: 50px;"> </td>
    <td> <?php echo $produksi['nama'] ?> </td>
    <td> </td>
    <td> Sisa Tagihan </td>
    <td style="text-align: right;"> <?php echo 'Rp. '.number_format($produksi['sisa_tagihan'],0,",","."); ?> </td>
  </tr>
</table>
    <?php } ?>