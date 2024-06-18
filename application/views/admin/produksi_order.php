<?php 
 foreach ($data2 as $u) { 
  $id=$u['id'];
  $id_pelanggan=$u['id_pelanggan'];
  $nama=$u['nama'];
  }
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
  }
  elseif($count<9999){
    $count++;
    $nonota = $gage.$count;
  }
?> 

<ol class="breadcrumb">
  <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
  <li><a href="<?php echo site_url('admin/produksi');?>">Produksi</a></li>
  <li class="active"><?php echo $nonota; ?></li>
</ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>


<div class="col-md-6">
  <div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/produksi/tambah_order');?>">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">Deskripsi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
              <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
              <input type="hidden" class="form-control" name="id_produksi" value="<?php echo $nonota; ?>">
            </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Order</label>
            <div class="col-sm-8">
              <select class="form-control select" name="id_jenis" required>
              <?php foreach ($data4 as $u) { ?>
                <option value="<?php echo$u['id_jenis'] ?>"> <?php echo$u['jenis'] ?> </option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Panjang</label>
            <div class="col-sm-8">
              <input type="number" min="0.01" step="0.01" class="form-control" name="panjang" placeholder="Panjang" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Lebar</label>
            <div class="col-sm-8">
              <input type="number" min="0.01" step="0.01" class="form-control" name="lebar" placeholder="Lebar" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Bahan</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="bahan" placeholder="penulisan huruf kecil, cont : clouth banner" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="number" min="1" step="1" class="form-control" name="jumlah" placeholder="Jumlah" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Harga</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="number" class="form-control" name="harga" min="0" step="1" required>
              </div><hr>
              <button type="submit" class="form-control btn btn-danger"><i class="fa fa-plus"></i> Tambah daftar order</button>
            </div>
          </div>
          
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
      </form>
    </div>

  </div>
</div>


<div class="col-md-6">
  <div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/produksi/inputproduksi');?>">
        <div class="box-body">
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Pelanggan</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" readonly>
              <input type="hidden" class="form-control" name="id_produksi" value="<?php echo $nonota; ?>">
            </div>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">PIC</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="pic" placeholder="PIC" onkeyup="total()" onchange="total()" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Biaya Design</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="number" class="form-control" name="biaya_design" id="harga_biayadesign" value="0" min="0" step="500" onkeyup="total()" onchange="total()" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Diskon</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="number" class="form-control" name="diskon" id="harga_diskon" value="0" min="0" step="1" onkeyup="total()" onchange="total()">
                <span class="input-group-addon">%</span>
              </div>
            </div> 
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Total Tagihan</label>
            <div class="col-sm-8">
               <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="text" class="form-control" name="total_tagihan2" id="id_total" readonly>
                <input type="hidden" class="form-control" name="total_tagihan" id="id_total2" >
              </div>              
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Pembayaran</label>
            <div class="col-sm-8">
              <select class="form-control select" name="pembayaran" required>
              <option value="Tunai"> Tunai </option>
              <option value="Bank"> Bank</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Bayar</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="number" class="form-control" value="0" name="bayar" min="0" step="1">
              </div>
               <hr>
              <button type="submit" class="form-control btn btn-danger">Bayar <i class="fa fa-chevron-right"></i> Cetak Nota</button>
            </div>
          </div>

           <script type="text/javascript">
            function total() {
            var vbiayadesign = parseInt(document.getElementById('harga_biayadesign').value);
            var vdiskon = parseInt(document.getElementById('harga_diskon').value);
            var vtotal = parseInt(document.getElementById('harga_total').value);
            var potong = vtotal*vdiskon/100;
            var jumlah_harga = vtotal+vbiayadesign-potong;
            var pembulatan = jumlah_harga % 500;
            var abc = parseInt(jumlah_harga /500)*500;
            if(pembulatan<=500){
              abc = parseInt(jumlah_harga /500)*500+500;
            } else {
              abc = parseInt(jumlah_harga /500)*500+1000;
            }
            if(pembulatan==0){
              abc = parseInt(jumlah_harga /500)*500;
            }
            var reverse = abc.toString().split('').reverse().join(''),

             ribuan = reverse.match(/\d{1,3}/g);
             ribuan = ribuan.join('.').split('').reverse().join('');
            document.getElementById('id_total').value = ribuan;
            document.getElementById('id_total2').value = abc;
            }
          </script>       
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
      </form>
    </div>

  </div>
</div>

<div class="col-md-12">
  <div class="box box-danger">
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th style="width: 20px;">No</th>
          <th style="text-align: center;">Deskripsi</th>
          <th style="text-align: center;">P x L</th>
          <th style="text-align: center;">Bahan</th>
          <th style="text-align: center;">Harga</th>
          <th style="text-align: center;">Jumlah</th>
          <th style="text-align: center;">Total</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1;
        $sum = 0;
        foreach ($data3 as $produksi) {
        ?>
        <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $produksi['deskripsi']; ?></td>
        <td style="text-align: center;"><?php echo $produksi['panjang'].' x '.$produksi['lebar']; ?></td>
        <td style="text-align: center;"><?php echo $produksi['bahan']; ?></td>
        <td style="text-align: right;"><?php echo 'Rp. '.number_format($produksi['harga'],0,",","."); ?></td>
        <td style="text-align: center;"><?php echo $produksi['jumlah']; ?></td>
        <td style="text-align: right;">
          <?php 
          $total = $produksi['panjang']*$produksi['lebar']*$produksi['harga']*$produksi['jumlah'];
          $sum = $sum+$total;
          echo 'Rp. '.number_format($total,0,",","."); ?>
        </td>
        <td align="center">
          <a href="<?php echo site_url('admin/produksi/delete_order/'.$produksi['id'].'/'.$id);?>"  class="btn btn-danger btn-xs"><i class="fa fa-trash"> Hapus</i></a> 
          <a href="<?php echo site_url('admin/produksi/edit_order/'.$produksi['id'].'/'.$id);?>"  class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit </i></a>           
        </td>
        </tr>
        <?php $no++; } ?>
                <tr>
          <td colspan="6" style="text-align: right;">
            <strong> Jumlah Total </strong>
          </td>
          <td colspan="1"  style="text-align: right;"><strong><?php echo 'Rp. '.number_format($sum,0,",","."); ?></strong></td>
          <td>
          <input type="hidden" id="harga_total" value="<?php echo $sum; ?>" readonly>
          </td>
        </tr>
        </tbody>
      </table>
    </div> 
    <!-- /.box-body -->
  </div>
</div>