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
<?php foreach ($supplier as $u) { ?>
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/supplier/updatedata');?>">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama" value="<?php echo $u->sup; ?>" required>
              <input type="hidden" class="form-control" name="id_sup" value="<?php echo $u->id_sup; ?>" readonly>
            </div>
          </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('admin/supplier');?>" class="btn btn-default">Batal</a>
          <button type="submit" class="btn btn-danger pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
<?php } ?>
  </div>
</div>