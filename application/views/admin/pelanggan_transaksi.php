<?php foreach ($data2 as $uu) { ?>
<ol class="breadcrumb">
  <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
  <li><a href="<?php echo site_url('admin/pelanggan');?>">Data Pelanggan</a></li>
  <li class="active"> <?php echo $uu['nama']; ?></li>
</ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-md-5">
  <div class="box box-solid">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">ID #<?php echo $uu['id_pelanggan']; ?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <strong><i class="fa fa-user margin-r-5"></i> <?php echo $uu['nama']; ?></strong> <?php echo $uu['cv']; ?> 
        <p class="text-muted">
          <?php echo $uu['alamat']; ?>  - <?php echo $uu['cp']; ?>
        </p>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="box box-solid">
    <div class="box-body">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th style="text-align: center;">Nota</th>
          <th style="text-align: center;">B.Design</th>
          <th style="text-align: center; width: 70%;">
            <table>
              <tbody>
                <tr>
                  <td style="width: 190px;">Deskripsi</td>
                  <td style="text-align: center; width: 15%;">P x L</td>
                  <td style="text-align: center; width: 15%;">Bahan</td>
                  <td style="text-align: right; width: 15%;">Harga</td>
                  <td style="text-align: right; width: 10%;">Jumlah</td>
                  <td style="text-align: right; width: 15%;"> Total </td>          
                </tr>
              </tbody>
            </table>
          </th>
          <th style="text-align: center; width: 13%;">Sub Total</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; $sum = 0; $sumdesen = 0; $subtotal = 0;
        foreach ($data3 as $produksi) { ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td>
            <a href="<?php echo site_url('admin/produksi/invoice/'.$produksi['id_produksi']);?>">
              <?php echo $produksi['id_produksi'];?></a> </td>
          <td style="text-align: right;"><?php echo 'Rp. '.number_format($produksi['biaya_design'],0,",","."); ?></td>
          <td>
            <table>
              <?php
            $this->db->select('*');
            $this->db->from('detail_produksi');
            $this->db->where('id_produksi', $produksi['id_produksi']); 
            $detail = $this->db->get()->result_array();
            foreach ($detail as $row) { ?>
              <tr style="border-bottom: 1px solid #e1e0e0">
                <td style="width: 200px;"><?php echo $row['deskripsi']; ?></td>
                <td style="text-align: center; width: 15%;">
                <?php if($row['id_jenis']==1){ echo $row['panjang'].' x '.$row['lebar'];  } else { echo '-'; }?> </td>
                <td style="text-align: center; width: 15%;"><?php echo $row['bahan']; ?></td>
                <td style="text-align: right; width: 15%;"><?php echo 'Rp. '.number_format($row['harga'],0,",","."); ?></td>
                <td style="text-align: center; width: 10%;"><?php echo $row['jumlah']; ?></td>
                <td style="text-align: right; width: 15%;">
                  <?php 
                  $total = $row['panjang']*$row['lebar']*$row['harga']*$row['jumlah'];
                  $sum = $sum+$total;
                  echo 'Rp. '.number_format($total,0,",","."); ?>
                </td>           
              </tr>
              <?php  } ?>  
          </table>
          </td>
          <td style="text-align: right;"><?php echo 'Rp. '.number_format($produksi['total_tagihan'],0,",","."); ?></td>
        </tr>
        <?php $no++; 
        $sumdesen = $sumdesen+$produksi['biaya_design'];
        $subtotal = $subtotal+$produksi['total_tagihan'];
        } ?>
        </tbody>
        <tfoot>
        <tr>
          <td style="text-align: right;" colspan="3">Jumlah Total</td>
          <td style="text-align: right;"><strong><?php echo 'Rp. '.number_format($sum,0,",","."); ?></strong></td>
          <td style="text-align: right;"><strong><?php echo 'Rp. '.number_format($subtotal,0,",","."); ?></strong></td>
        </tr>
        </tfoot>
      </table>
    </div> 
    <!-- /.box-body -->
  </div>
</div>
<?php } ?>


<!--                   $tampung = $row['panjang']*$row['lebar']*$row['harga']*$row['jumlah'];
                  $sisa = $tampung % 100;
                  if($sisa>0){
                   $tampung = $tampung - $sisa + 100; 
                  } else {
                    $tampung = $tampung - $sisa;
                  }
                  $total = $tampung; -->