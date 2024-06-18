  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
    <li class="active">Data Pelanggan</li>
    <li class="active"><?php  echo $pelanggan; ?></li>
  </ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-xs-12" align="left">
  <div class="box-header">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalJenis"><i class="fa fa-plus-square"></i> Tambah Pelanggan</button>
    <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#ModalPrint"><i class="fa fa-print"></i> Print</button>
  </div>
</div>
<div class="col-md-12">
  <div class="box box-solid">
    <div class="box-header">
      <h3 class="box-title" align="center">Data Pelanggan <?php  echo $pelanggan; ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th style="width: 20px;">No</th>
          <th>ID </th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Contact Person</th>
          <th>Transaksi</th>
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
        <?php $total_tagihan = $this->CRUD_model->total_tagihan($u['id_pelanggan']); ?>
        <td style="text-align: right;"><?php echo number_format($total_tagihan,0,".",","); ?></td>
        <td align="center">
          <a href="<?php echo site_url('admin/pelanggan/editdata/'.$u['id']);?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"> </i></a>  
          <a href="<?php echo site_url('admin/pelanggan/transaksi/'.$u['id_pelanggan']);?>" class="btn btn-success btn-xs"><i class="fa fa-opencart"> </i></a>  
          <a href="<?php echo site_url('admin/pelanggan/hapus/'.$u['id']);?>"  class="btn btn-danger btn-xs"><i class="fa fa-trash"> </i></a>           
        </td>
        </tr>
        <?php $no++; } ?>
        </tbody>
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
          <a href="<?php echo site_url('admin/pelanggan');?>" class="btn btn-default">Batal</a>
          <button type="submit" class="btn btn-danger pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>


      </div>
    </div>
  </div>

  <div class="modal fade" id="ModalPrint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">PRINT PELANGGAN
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>

        <div class="box-body">
          <form class="form-horizontal" method="get" action="<?php echo site_url('admin/pelanggan/cetak');?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="alamat">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Broker</label>
                <div class="col-sm-8">
                  <select class="form-control select" name="broker">
                  <option value="0" selected> Semua </option>
                    <option value="1"> Broker </option>
                    <option value="2"> Non Broker </option>
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