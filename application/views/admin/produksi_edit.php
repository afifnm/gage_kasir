<?php 
 foreach ($data2 as $u) { ?> 

<ol class="breadcrumb">
  <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
  <li><a href="<?php echo site_url('admin/produksi');?>">Produksi</a></li>
  <li class="active"><?php echo $u->id_produksi; ?></li>
  <li class="active">Edit Data Order</li>
</ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>


<div class="col-md-6">
  <div class="box box-danger">
    <div class="box-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('admin/produksi/perbarui_order');?>">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">Deskripsi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="deskripsi" value="<?php echo $u->deskripsi; ?>" required>
              <input type="hidden" class="form-control" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>">
              <input type="hidden" class="form-control" name="id" value="<?php echo $u->id; ?>">
            </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Order</label>
            <div class="col-sm-8">
              <select class="form-control select" name="id_jenis" required>
              <?php foreach ($data4 as $uu) { ?>
                <option value="<?php echo$uu['id_jenis'] ?>" <?php if($u->id_jenis==$uu['id_jenis']){echo"selected";}?> > <?php echo$uu['jenis'] ?> </option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Panjang</label>
            <div class="col-sm-8">
              <input type="number" min="0.01" step="0.01" class="form-control" name="panjang" value="<?php echo $u->panjang; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Lebar</label>
            <div class="col-sm-8">
              <input type="number" min="0.01" step="0.01" class="form-control" name="lebar" value="<?php echo $u->lebar; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Bahan</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="bahan" value="<?php echo $u->bahan; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="number" min="1" step="1" class="form-control" name="jumlah" value="<?php echo $u->jumlah; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Harga</label>

            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="number" class="form-control" name="harga" min="0" step="500" value="<?php echo $u->harga; ?>" required>
              </div><hr>
              <a href="<?php echo site_url('admin/produksi/order/'.$id_pelanggan);?>" class="btn btn-default"><i class="fa fa-back"></i> Batal</a>
              <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save"></i> Simpan </button>
            </div>


          </div>
          
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
      </form>
    </div>

  </div>
</div>

<?php } ?>