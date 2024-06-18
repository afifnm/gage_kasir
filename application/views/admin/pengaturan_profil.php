  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
    <li class="active">Pengaturan</li>
    <li class="active">Profil CV</li>
  </ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-md-8">
  <div class="box box-danger">
<?php foreach ($profil as $u) { ?>
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/pengaturan/update_profil');?>" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama CV</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama" value="<?php echo $u->nama; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" name="email" value="<?php echo $u->email; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Alamat</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="alamat" value="<?php echo $u->alamat; ?>">
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-3 control-label">No. Telp </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="phone" value="<?php echo $u->phone; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">No. Rekening </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="norek" value="<?php echo $u->norek; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Judul Website</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="judul" value="<?php echo $u->judul; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Saldo Cash</label>
            <div class="col-sm-5">
              <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="number" class="form-control" name="saldo" min="0" value="<?php echo $u->saldo; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Saldo Bank</label>
            <div class="col-sm-5">
              <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="number" class="form-control" name="saldo2" min="0" value="<?php echo $u->saldo2; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Logo</label>
            <div class="col-sm-5">
              <input type="file" class="form-control" placeholder="Logo" name="fileForUpload">
            </div>
          </div>  
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('admin/pengaturan/profil');?>" class="btn btn-default">Batal</a>
          <button type="submit" class="btn btn-danger pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
<?php } ?>
  </div>
</div>