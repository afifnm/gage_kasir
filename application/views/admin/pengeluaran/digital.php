  <ol class="breadcrumb">
    <li><a href="<?php echo site_url('admin/home');?>"><i class="fa fa-dashboard"> </i> Home</a></li>
    <li class="active">Pengeluaran</li>
    <li class="active">Digital</li>
  </ol>
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-xs-12" align="left">
  <div class="box-header">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDigital"><i class="fa fa-plus-square"></i> Tambah Pengeluaran</button>
    <a data-toggle="modal" data-target="#ModalPrint2" class="btn btn-danger pull-right" ><i class="fa fa-print"></i> Laporan Pengeluaran</a>
  </div>
</div>
<div class="col-md-12">
  <div class="box box-solid"> 
    <div class="box-header">
      <h3 class="box-title" align="center">PENGELUARAN DIGITAL</h3>
      <a data-toggle="modal" data-target="#ModalPrint" class="btn btn-danger pull-right" ><i class="fa fa-print"></i> PRINT</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>Tanggal</th>
          <th style="text-align: center;">Gramatur</th>
          <th>Keterangan</th>
          <th style="text-align: center;">Supplier</th>
          <th style="text-align: center;">QTY</th>
          <th style="text-align: center;">Harga</th>
          <th style="text-align: center;">Tagihan</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; $sum =0; $sisa=0;
        foreach ($data2 as $u) {
        ?>
        <tr>
        <td><?php echo mediumdate_indo($u['tanggal']) ?></td>
        <td style="text-align: center;"><?php echo $u['gramatur']; ?></td>
        <td><?php echo $u['keterangan']; ?></td>
        <td style="text-align: center;"><?php echo $u['sup']; ?></td>
        <td style="text-align: center;"><?php echo $u['qty']; ?></td>
        <td style="text-align: right;"><?php echo 'Rp. '.number_format($u['harga'],0,".",","); ?></td>
        <td style="text-align: right;"><?php 
          $tagihan = $u['qty']*$u['harga'];
          echo 'Rp. '.number_format($tagihan,0,".",","); ?>
        </td>
        <td align="center">
          <a href="<?php echo site_url('admin/pengeluaran/digital_hapus/'.$u['id']);?>"  class="btn btn-danger btn-xs"><i class="fa fa-trash"> Hapus</i></a>           
        </td>
        </tr>
        <?php 
        $sum = $sum+$tagihan;
        $no++; } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6" style="text-align: right;">
              <strong> Total Tagihan</strong>
            </td>
            <td colspan="1"  style="text-align: right;"><strong><?php echo 'Rp. '.number_format($sum,0,",","."); ?></strong></td>
            <td> </td>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
</div>


  <div class="modal fade" id="ModalDigital" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">PENGELUARAN DIGITAL
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>

        <div class="box-body">
          <form class="form-horizontal" method="post" action="<?php echo site_url('admin/pengeluaran/digital_input');?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" name="tanggal" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gramatur</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="gramatur" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Jumlah</label>
                <div class="col-sm-5">
                  <input type="number" class="form-control" name="qty" id="id_qty" required onkeyup="total()" onchange="total()">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Harga</label>
                <div class="col-sm-8">
                   <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="number" class="form-control" name="harga" id="id_harga" required onkeyup="total()" onchange="total()">
                  </div>              
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Keterangan</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="keterangan" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Supplier</label>
                <div class="col-sm-8">
                  <select class="form-control select" name="id_sup" required>
                  <?php foreach ($data4 as $u) { ?>
                    <option value="<?php echo$u['id_sup'] ?>"> <?php echo$u['sup'] ?> </option>
                  <?php } ?>
                  <option value="0"> Lain-lain </option>
                  </select>
                </div>
              </div>  
              <div class="form-group">
                <label class="col-sm-3 control-label">Total Tagihan</label>
                <div class="col-sm-8">
                   <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" readonly="" id="id_total">
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

  <script type="text/javascript">
    function total() {
    var qty = parseInt(document.getElementById('id_qty').value);
    var harga = parseInt(document.getElementById('id_harga').value);
    var total = qty*harga;
    var reverse = total.toString().split('').reverse().join(''),
     ribuan = reverse.match(/\d{1,3}/g);
     ribuan = ribuan.join('.').split('').reverse().join('');
    document.getElementById('id_total').value = ribuan;
    }
  </script>


    <div class="modal fade" id="ModalPrint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel" align="center">LAPORAN PENGELUARAN DIGITAL
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="get" action="<?php echo site_url('admin/pengeluaran/digital_cetak');?>">
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
          <h4 class="modal-title" id="myModalLabel" align="center">LAPORAN PENGELUARAN
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </h4>
        </div>
        <div class="box-body">
          <form class="form-horizontal" method="get" action="<?php echo site_url('admin/pengeluaran/laporan');?>">
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
              <div class="checkbox">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" name="cek" > Sembunyikan pendapatan cash 
                  </label>
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