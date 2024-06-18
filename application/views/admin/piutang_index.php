  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
    <li class="active">Data Piutang</li>
  </ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-xs-12" align="left">
  <div class="box-header">
    <a data-toggle="modal" data-target="#ModalPrint1" class="btn btn-danger pull-right" style="margin-left: 10px;"><i class="fa fa-print"></i> PRINT DATA PIUTANG</a>
    <a data-toggle="modal" data-target="#ModalPrint2" class="btn btn-danger pull-right" style="margin-left: 10px;"><i class="fa fa-print"></i> PRINT PEMBAYARAN PIUTANG</a>
    <a data-toggle="modal" data-target="#ModalPrint3" class="btn btn-danger pull-right" style="margin-left: 10px;"><i class="fa fa-print"></i> PRINT CICILAN PIUTANG</a>
  </div>
</div>
<div class="col-md-12">

  <div class="box box-solid">

    <!-- /.box-header -->
    <div class="box-body">

      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th style="width: 20px;">No</th>
          <th style="text-align: center;">No. Nota</th>
          <th style="text-align: center;">Nama</th>
          <th style="text-align: center;">Total Tagihan</th>
          <th style="text-align: center;">Sisa Tagihan</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; $sum1 = 0; $sum2 = 0;
        foreach ($data3 as $row) {
        ?>
        <tr>
        <td><?php echo $no; ?></td>
        <td style="text-align: center;">
          <a href="<?php echo site_url('admin/produksi/invoice/'.$row['id_produksi']);?>">
          <?php echo $row['id_produksi']; ?>
          </a>
        </td>
        <td><?php echo $row['nama']; ?></td>
        <td style="text-align: right;"><?php echo 'Rp. '.number_format($row['total_tagihan'],0,",","."); ?></td>
        <td style="text-align: right;"><?php echo 'Rp. '.number_format($row['sisa_tagihan'],0,",","."); ?></td>
        <td align="center">
          <a href="<?php echo site_url('admin/piutang/cicilan/'.$row['id_produksi']);?>"  class="btn btn-danger btn-xs"><i class="fa fa-dollar"> Bayar</i></a>           
        </td>
        </tr>

        <?php 
        $sum1 = $sum1+$row['total_tagihan'];
        $sum2 = $sum2+$row['sisa_tagihan'];
        $no++; } ?>
        </tbody>
        <tfoot>
        <tr>
          <td style="text-align: right;" colspan="3">Sub Total</td>
          <td style="text-align: right;"><strong><?php echo 'Rp. '.number_format($sum1,0,",","."); ?></strong></td>
          <td style="text-align: right;"><strong><?php echo 'Rp. '.number_format($sum2,0,",","."); ?></strong></td>
          <td> </td>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</div>


<?php 
  if($count==0){
    $id_pelanggan = 'GG0001';
  }
  elseif($count<10){
    $count++;
    $id_pelanggan = 'GG000'.$count;
  }
  elseif($count<100){
    $count++;
    $id_pelanggan = 'GG00'.$count;
  }
  elseif($count<1000){
    $count++;
    $id_pelanggan = 'GG0'.$count;
  }
  elseif($count<10000){
    $count++;
    $id_pelanggan = 'GG'.$count;
  }

?>




  <div class="modal fade" id="ModalJenis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-ld" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">Tambah Pelanggan Baru
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>

    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/pelanggan/input');?>">
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
          <a href="<?php echo site_url('admin/pelanggan');?>" class="btn btn-default">Batal</a>
          <button type="submit" class="btn btn-danger pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>


      </div>
    </div>
  </div>


  <div class="modal fade" id="ModalPrint1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">PRINT DATA PIUTANG
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="get" action="<?php echo site_url('admin/piutang/cetak1');?>">
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
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-8">
                  <select class="form-control" name="kategori" required>
                    <option value="0">Semua</option>
                    <option value="1">Lunas</option>
                    <option value="2">Belum Lunas</option>
                  </select> 
                </div>
              </div> 
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right">Print</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="ModalPrint2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">PRINT PEMBAYARAN PIUTANG
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="get" action="<?php echo site_url('admin/piutang/cetak2');?>">
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
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-8">
                  <select class="form-control" name="kategori" required>
                    <option value="0">Semua</option>
                    <option value="1">Lunas</option>
                    <option value="2">Belum Lunas</option>
                  </select> 
                </div>
              </div> 
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right">Print</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="ModalPrint3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">PRINT CICILAN PIUTANG
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="get" action="<?php echo site_url('admin/piutang/cetak3');?>">
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
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-8">
                  <select class="form-control" name="kategori" required>
                    <option value="0">Semua</option>
                    <option value="1">Lunas</option>
                    <option value="2">Belum Lunas</option>
                  </select> 
                </div>
              </div> 
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-danger pull-right">Print</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>