  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
    <li class="active">Pengaturan</li>
    <li class="active">Kategori Produksi</li>
  </ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-xs-12" align="left">
  <div class="box-header">
  </div>
</div>
<div class="col-md-12">
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title" align="center">Daftar Kategori Produksi</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example3" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th style="width: 20px;">No</th>
          <th>Kategori Produksi</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1;
        foreach ($data3 as $u) {
        ?>
        <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $u['jenis']; ?></td>
        <td align="center">
          <a href="<?php echo site_url('admin/pengaturan/edit_jenis/'.$u['id']);?>"  class="btn btn-danger btn-xs"><i class="fa fa-edit"> EDIT</i></a>           
        </td>
        </tr>
        <?php $no++; } ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</div>



  <div class="modal fade" id="ModalJenis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-ld" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">Tambah Data Pengguna Sistem
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>

    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/pengaturan/input_user');?>">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">Username</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama" placeholder="Nama" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Hak Akses</label>
            <div class="col-sm-6">
              <select class="form-control select" name="level" required>
              <option value="Admin"> Admin </option>
              <option value="Front Office"> Front Office </option>
              </select>
            </div>
          </div>    
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo site_url('admin/pengaturan/user');?>" class="btn btn-default">Batal</a>
          <button type="submit" class="btn btn-danger pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>


      </div>
    </div>
  </div>