  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
    <li class="active">Data Suplier2</li>
  </ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-xs-12" align="left">
  <div class="box-header">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalSup"><i class="fa fa-plus-square"></i> Tambah Suplier</button>
  </div>
</div>
<div class="col-md-12">
  <div class="box box-solid">
    <div class="box-header">
      <h3 class="box-title" align="center">Data Suplier</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th style="width: 20px;">No</th>
          <th>Nama</th>
         <!--  <th>Transaksi</th> -->
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
        <td><?php echo $u['sup']; ?></td>
        <?php $total_tagihan = 0; ?>
  <!--       <td style="text-align: right;"><?php echo number_format($total_tagihan,0,".",","); ?></td> -->
        <td align="center">
          <a href="<?php echo site_url('admin/supplier/editdata/'.$u['id_sup']);?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</i></a>  
          <a href="<?php echo site_url('admin/supplier/hapus/'.$u['id_sup']);?>"  class="btn btn-danger btn-xs"><i class="fa fa-trash"> Hapus</i></a>           
        </td>
        </tr>
        <?php $no++; } ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</div>

  <div class="modal fade" id="ModalSup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">Tambah Supplier
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>

        <div class="box-body">
          <form class="form-horizontal" method="post" action="<?php echo site_url('admin/supplier/input');?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 control-label">Nama Supplier</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="nama" required>
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
  </div