<?php 
  $gage=date('ymd');
  if($count==0){
    $nonota = $gage.'0001';
  }
  elseif($count<9){
    $count++;
    $nonota = $gage.'000'.$count;
  }
  elseif($count<99){
    $count++;
    $nonota = $gage.'00'.$count;
  }
  elseif($count<999){
    $count++;
    $nonota = $gage.'0'.$count;
  }else {
    $count++;
    $nonota = $gage.$count;
  }
?> 
<ol class="breadcrumb">
  <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
  <li class="active">Produksi</li>
</ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-xs-12" align="left">
  <div class="box-header">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalAdd"><i class="fa fa-plus-square"></i> Tambah Pelanggan</button>
    <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#ModalPrint"><i class="fa fa-print"></i> Print Laporan</button>
  </div>
</div>
<div class="col-md-4">
  <div class="box box-solid">
    <div class="box-body">
      <form class="form-horizontal">
        <div class="form-group"> <br>
          <label class="col-sm-1 control-label"></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="id_pelanggan" value="<?php echo '#'.$nonota; ?>" readonly> <br>
            <a class="form-control btn btn-danger" data-toggle="modal" data-target="#ModalPelanggan"><i class="fa fa-opencart"></i> Produksi</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="box box-solid">
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/produksi/cek_nota');?>">
        <div class="form-group"> <br>
          <label class="col-sm-1 control-label"></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="id_produksi" placeholder="Masukan No. Nota" required> <br>
            <button type="submit" class="form-control btn btn-danger" ><i class="fa fa-search"></i> Cek Nota</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-4">
  <div class="box box-solid">
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/produksi/cancel_order');?>">
        <div class="form-group"> <br>
          <label class="col-sm-1 control-label"></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="id_produksi" placeholder="Masukan No. Nota" required> <br>
            <button type="submit" class="form-control btn btn-danger" ><i class="fa fa-close"></i> Batalkan Order</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="box box-solid">
    <div class="box-header" style="text-align: center;">
      <h3 class="box-title" style="text-align: center;">PRODUKSI HARI INI</h3>
       <a href="<?php echo site_url('admin/produksi/cetaknow/');?>" target="_blank" class="btn btn-danger pull-right" ><i class="fa fa-print"></i> PRINT</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th style="width: 20px;">No</th>
          <th style="text-align: center;">Nota</th>
          <th style="text-align: center;">Nama</th>
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
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; $sum = 0;
        foreach ($data3 as $produksi) { ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td>
            <a href="<?php echo site_url('admin/produksi/invoice/'.$produksi['id_produksi']);?>">
            <?php echo $produksi['id_produksi']; ?>
            </a>
          </td>
          <td><?php echo $produksi['nama']; ?></td>
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
        </tr>
        <?php $no++; } ?>
        </tbody>
        <tfoot>
        <tr>
          <td style="text-align: right;" colspan="3">Jumlah Total</td>
          <td style="text-align: right;"><strong><?php echo 'Rp. '.number_format($sum,0,",","."); ?></strong></td>
        </tr>
        </tfoot>
      </table>
    </div> 
    <!-- /.box-body -->
  </div>
</div>



<?php 
  if($countpelanggan==0){
    $id_pelanggan = 'GG0001';
  }
  elseif($countpelanggan<10){
    $countpelanggan++;
    $id_pelanggan = 'GG000'.$countpelanggan;
  }
  elseif($countpelanggan<100){
    $countpelanggan++;
    $id_pelanggan = 'GG00'.$countpelanggan;
  }
  elseif($countpelanggan<1000){
    $countpelanggan++;
    $id_pelanggan = 'GG0'.$countpelanggan;
  }
  else{
    $countpelanggan++;
    $id_pelanggan = 'GG'.$countpelanggan;
  }

?>
  <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">TAMBAH PELANGGAN BARU
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>

    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/produksi/inputpelanggan');?>">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">ID Pelanggan</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama" placeholder="Nama Pelanggan" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Kategori Pelanggan</label>
            <div class="col-sm-8">
              <select class="form-control select" name="broker" required>
              <option value="Non Broker"> Non Broker </option>
              <option value="Broker"> Broker </option>
              <option value="Pajak"> Kena Pajak </option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">CV</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="cv" placeholder="CV">
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-3 control-label">Contact Person</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="cp" placeholder="Contact Person">
            </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-3 control-label">Alamat</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="alamat" placeholder="Alamat">
            </div>
          </div>    
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-danger pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>


      </div>
    </div>
  </div>

   <div class="modal fade" id="ModalPelanggan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">Pilih pelanggan yang akan melakukan order...
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th style="width: 20px;">No</th>
              <th>ID Pelanggan</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Contact Person</th>
              <th>Broker</th>
              <th style="text-align: center;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            foreach ($data2 as $u) {
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $u['id_pelanggan']; ?></td>
              <td><?php echo $u['nama']; ?></td>
              <td><?php echo $u['alamat']; ?></td>
              <td><?php echo $u['cp']; ?></td>
              <td><?php echo $u['broker']; ?></td>
              <td align="center">
                <a href="<?php echo site_url('admin/produksi/order/'.$u['id']);?>" class="btn btn-danger btn-xs"><i class="fa fa-check"> PILIH</i></a>
              </td>
            </tr>
            <?php $no++; } ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="ModalPrint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">PRINT LAPORAN
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>

        <div class="box-body">
          <form class="form-horizontal" method="get" action="<?php echo site_url('admin/produksi/laporan');?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Awal</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" name="tanggal1" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Berakhir</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" name="tanggal2" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Filter</label>
                <div class="col-sm-8">
                  <select class="form-control select" name="id_jenis" required>
                  <option value="0"> Semua </option>
                  <?php foreach ($data4 as $u) { ?>
                    <option value="<?php echo$u['id_jenis'] ?>"> <?php echo$u['jenis'] ?> </option>
                  <?php } ?>
                  </select>
                </div>
              </div>  

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right">Print</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>


      </div>
    </div>
  </div>