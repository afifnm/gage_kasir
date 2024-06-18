  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
    <li><a href="<?php echo site_url('admin/Pelanggan');?>"> Data Pelanggan</a></li>
    <li class="active">Perbarui Biodata Pelanggan</li>
  </ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-md-8">
  <div class="box box-danger">
<?php foreach ($pelanggan as $u) { ?>
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/pelanggan/updatedata');?>">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">ID Pelanggan</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="id_pelanggan" value="<?php echo $u->id_pelanggan; ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama" value="<?php echo $u->nama; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Order</label>
            <div class="col-sm-8">
              <select class="form-control select" name="broker" required>
              <option value="Non Broker" <?php if($u->broker=="Non Broker"){echo"selected";}?> > Non Broker </option>
              <option value="Broker" <?php if($u->broker=="Broker"){echo"selected";}?> > Broker </option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">CV</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="cv" value="<?php echo $u->cv; ?>">
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-3 control-label">Contact Person</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="cp" value="<?php echo $u->cp; ?>">
            </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-3 control-label">Alamat</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="alamat" value="<?php echo $u->alamat; ?>">
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
<?php } ?>
  </div>
</div>