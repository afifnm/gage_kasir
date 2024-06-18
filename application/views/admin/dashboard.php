<?php 
  date_default_timezone_set("Asia/Jakarta");
  $jam = date("H:i");
  $tanggal = date("y-m-d");
  $hari = date('l'); if($hari=='Monday'){$indo='Senin';}
  if($hari=='Tuesday'){$indo='Selasa';}if($hari=='Wednesday'){$indo='Rabu';}
  if($hari=='Thursday'){$indo='Kamis';}if($hari=='Friday'){$indo='Jumat';}
  if($hari=='Saturday'){$indo='Sabtu';}if($hari=='Sunday'){$indo='Minggu';}
  $id_jenis = 1;
  $jenis1 = $this->CRUD_model->produksi_jenis($id_jenis); 
  $id_jenis = 2;
  $jenis2 = $this->CRUD_model->produksi_jenis($id_jenis); 
  $id_jenis = 3;
  $jenis3 = $this->CRUD_model->produksi_jenis($id_jenis); 
  $id_jenis = 4;
  $jenis4 = $this->CRUD_model->produksi_jenis($id_jenis); 
  $id_jenis = 5;
  $jenis5 = $this->CRUD_model->produksi_jenis($id_jenis); 
  $id_jenis = 6;
  $jenis6 = $this->CRUD_model->produksi_jenis($id_jenis); 
  $i=0;
  $bahan1 = $this->CRUD_model->produksi_bahan('260','1');
  $bahan2 = $this->CRUD_model->produksi_bahan('280','1');
  $bahan3 = $this->CRUD_model->produksi_bahan('300','1'); 
  $bahan4 = $this->CRUD_model->produksi_bahan('340','1');
  $bahan440 = $this->CRUD_model->produksi_bahan('440','1');
  $bahan5 = $this->CRUD_model->produksi_bahan('stiker','1');
  $bahan6 = $this->CRUD_model->produksi_bahan('one way','1');
  $bahan7 = $this->CRUD_model->produksi_bahan('cloth banner','1');
  $bahan8 = $this->CRUD_model->produksi_bahan('albatros','5');
  $bahan9 = $this->CRUD_model->produksi_bahan('luster','5');
  $bahan10 = $this->CRUD_model->produksi_bahan('stiker','5');
  $bahan1h = $this->CRUD_model->produksi_bahan2('260','1');
  $bahan2h = $this->CRUD_model->produksi_bahan2('280','1');
  $bahan3h = $this->CRUD_model->produksi_bahan2('300','1'); 
  $bahan4h = $this->CRUD_model->produksi_bahan2('340','1');
  $bahan440h = $this->CRUD_model->produksi_bahan2('440','1');
  $bahan5h = $this->CRUD_model->produksi_bahan2('stiker','1');
  $bahan6h = $this->CRUD_model->produksi_bahan2('one way','1');
  $bahan7h = $this->CRUD_model->produksi_bahan2('cloth banner','1');
  $bahan8h = $this->CRUD_model->produksi_bahan2('albatros','5');
  $bahan9h = $this->CRUD_model->produksi_bahan2('luster','5');
  $bahan10h = $this->CRUD_model->produksi_bahan2('stiker','5');
  foreach ($data3 as $uu) { 
   $nama[$i] = $uu['jenis']; 
   $i++;
  }
    $omsetharini = $this->CRUD_model->omset_harini(); 
    $omset_bulan = $this->CRUD_model->omset_bulan(); 
    $biayadesenhari = $this->CRUD_model->biayadesenhari(); 
    $biayadesenbulan = $this->CRUD_model->biayadesenbulan(); 
    $total_tagihan = $this->CRUD_model->total_tagihan2(); 
?> 
<ol class="breadcrumb" style="margin-bottom: 0px; padding-bottom: 0px;">
  <li><a href="<?php date_default_timezone_set("Asia/Jakarta"); echo site_url();?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol> 
<div id="myalert">
  <?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="col-md-10">
	<h3 align="left"> 
  <small>Anda login sebagai <?php echo $this->session->userdata('level') ?> (<?php echo $this->session->userdata('nama') ?>)</small></h3>  
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">LAPORAN PRODUKSI</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <p class="text-center">
              <strong>PRODUKSI ORDER BULAN INI</strong>
            </p>

          <div>
            <canvas id="myChart"></canvas>
          </div>
            <!-- /.chart-responsive -->
          </div>
          <!-- /.col -->
          <div class="col-md-4">
            <br><br>
            <div class="progress-group">
              <span class="progress-text"><?php echo$nama[0];?></span>
              <span class="progress-number">Rp. <?php echo number_format($jenis1,0,".",","); ?></span>

              <div class="progress sm">
                <div class="progress-bar progress-bar-red" style="width: 100%"></div>
              </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
              <span class="progress-text"><?php echo$nama[1];?></span>
              <span class="progress-number">Rp. <?php echo number_format($jenis2,0,".",","); ?></span>

              <div class="progress sm">
                <div class="progress-bar progress-bar-yellow" style="width: 100%"></div>
              </div>
            </div>

            <div class="progress-group">
              <span class="progress-text"><?php echo$nama[2];?></span>
              <span class="progress-number">Rp. <?php echo number_format($jenis3,0,".",","); ?></span>

              <div class="progress sm">
                <div class="progress-bar progress-bar-blue" style="width: 100%"></div>
              </div>
            </div> 
            <div class="progress-group">
              <span class="progress-text"><?php echo$nama[3];?></span>
              <span class="progress-number">Rp. <?php echo number_format($jenis4,0,".",","); ?></span>

              <div class="progress sm">
                <div class="progress-bar progress-bar-green" style="width: 100%"></div>
              </div>
            </div>

            <div class="progress-group">
              <span class="progress-text"><?php echo$nama[4];?></span>
              <span class="progress-number">Rp. <?php echo number_format($jenis5,0,".",","); ?></span>

              <div class="progress sm">
                <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
              </div>
            </div>
            <div class="progress-group">
              <span class="progress-text"><?php echo$nama[5];?></span>
              <span class="progress-number">Rp. <?php echo number_format($jenis6,0,".",","); ?></span>

              <div class="progress sm">
                <div class="progress-bar progress-bar-primary" style="width: 100%"></div>
              </div>
            </div>
            <!-- /.progress-group -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <div class="row">

          <div class="col-sm-3 col-xs-6">
            <div class="description-block border-right">
              <h5 class="description-header">Rp. <?php echo number_format($omsetharini,0,".",","); ?></h5>
              <span class="description-text">OMSET HARI INI</span>
            </div>
          </div>

          <div class="col-sm-3 col-xs-6">
            <div class="description-block border-right">
              <h5 class="description-header">Rp. <?php echo number_format($omset_bulan,0,".",","); ?></h5>
              <span class="description-text">OMSET BULAN INI</span>
            </div>
          </div>

          <div class="col-sm-3 col-xs-6">
            <div class="description-block border-right">
              <span class="description-text">Rp. <?php echo number_format($biayadesenhari,0,".",","); ?></span>
              <h5 class="description-header">Rp. <?php echo number_format($biayadesenbulan,0,".",","); ?></h5>
              <span class="description-text">BIAYA DESIGN BULAN INI</span>
            </div>
          </div>

          <div class="col-sm-3 col-xs-6">
            <div class="description-block border-right">
              <h5 class="description-header">Rp. <?php echo number_format($total_tagihan,0,".",","); ?></h5>
              <span class="description-text">TOTAL BULAN INI</span>
            </div>
          </div>
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-body">
          <div class="col-sm-6 col-xs-6">
              <table class="table table-striped">
                <tbody>
                <tr>
                  <td style="text-align: left;">Pendapatan Cash</td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pendapatanhari_cash(),0,".",","); ?></td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pendapatanbulan_cash(),0,".",","); ?></td>
                </tr>
                <tr>
                  <td style="text-align: left;">Pendapatan Transfer</td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pendapatanhari_tf(),0,".",","); ?></td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pendapatanbulan_tf(),0,".",","); ?></td>
                </tr>
                <tr>
                  <td style="text-align: left;">Total Pendapatan</td>
                  <td style="text-align: right;">
                    Rp. <?php echo number_format($this->CRUD_model->pendapatanhari_cash()+$this->CRUD_model->pendapatanhari_tf(),0,".",","); ?></td>
                  <td style="text-align: right;">
                    Rp. <?php echo number_format($this->CRUD_model->pendapatanbulan_cash()+$this->CRUD_model->pendapatanbulan_tf(),0,".",","); ?></td>
                </tr>
                </tbody>
              </table>
          </div>
          <div class="col-sm-6 col-xs-6">
              <table class="table table-striped">
                <tbody>
                <tr>
                  <td style="text-align: left;">Pengeluaran Cash</td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pengeluaranhari_cash(),0,".",","); ?></td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pengeluaranbulan_cash(),0,".",","); ?></td>
                </tr>
                <tr>
                  <td style="text-align: left;">Pengeluaran Transfer</td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pengeluaranhari_tf(),0,".",","); ?></td>
                  <td style="text-align: right;">Rp. <?php echo number_format($this->CRUD_model->pengeluaranbulan_tf(),0,".",","); ?></td>
                </tr>
                <tr>
                  <td style="text-align: left;">Total Pengeluaran</td>
                  <td style="text-align: right;">
                    Rp. <?php echo number_format($this->CRUD_model->pengeluaranhari_cash()+$this->CRUD_model->pengeluaranhari_tf(),0,".",","); ?></td>
                  <td style="text-align: right;">
                    Rp. <?php echo number_format($this->CRUD_model->pengeluaranbulan_cash()+$this->CRUD_model->pengeluaranbulan_tf(),0,".",","); ?></td>
                </tr>
                </tbody>
              </table>
          </div>
        </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PRODUKSI BAHAN OUTDOOR DAN INDOOR</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="box-body">
              <table class="table table-striped">
                <tbody>
                <tr>
                  <td>260</td>
                  <td><?php if($bahan1h==NULL){
                    echo(0);
                  } else { echo number_format($bahan1h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan1==NULL){
                    echo(0);
                  } else { echo number_format($bahan1,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>280</td>
                  <td><?php if($bahan2h==NULL){
                    echo(0);
                  } else { echo number_format($bahan2h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan2==NULL){
                    echo(0);
                  } else { echo number_format($bahan2,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>300</td>
                  <td><?php if($bahan3h==NULL){
                    echo(0);
                  } else { echo number_format($bahan3h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan3==NULL){
                    echo(0);
                  } else { echo number_format($bahan3,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>340</td>
                  <td><?php if($bahan4h==NULL){
                    echo(0);
                  } else { echo number_format($bahan4h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan4==NULL){
                    echo(0);
                  } else { echo number_format($bahan4,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>440</td>
                  <td><?php if($bahan440h==NULL){
                    echo(0);
                  } else { echo number_format($bahan440h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan440==NULL){
                    echo(0);
                  } else { echo number_format($bahan440,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>stiker outdoor</td>
                  <td><?php if($bahan5h==NULL){
                    echo(0);
                  } else { echo number_format($bahan5h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan5==NULL){
                    echo(0);
                  } else { echo number_format($bahan5,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>

                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-body">
              <table class="table table-striped">
                <tbody>
                <tr>
                  <td>one way</td>
                  <td><?php if($bahan6h==NULL){
                    echo(0);
                  } else { echo number_format($bahan6h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan6==NULL){
                    echo(0);
                  } else { echo number_format($bahan6,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>cloth banner</td>
                  <td><?php if($bahan7h==NULL){
                    echo(0);
                  } else { echo number_format($bahan7h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan7==NULL){
                    echo(0);
                  } else { echo number_format($bahan7,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>albatros</td>
                  <td><?php if($bahan8h==NULL){
                    echo(0);
                  } else { echo number_format($bahan8h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan8==NULL){
                    echo(0);
                  } else { echo number_format($bahan8,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>luster</td>
                  <td><?php if($bahan9h==NULL){
                    echo(0);
                  } else { echo number_format($bahan9h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan9==NULL){
                    echo(0);
                  } else { echo number_format($bahan9,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>
                <tr>
                  <td>stiker indoor</td>
                  <td><?php if($bahan10h==NULL){
                    echo(0);
                  } else { echo number_format($bahan10h,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                  <td><?php if($bahan10==NULL){
                    echo(0);
                  } else { echo number_format($bahan10,2,",",".").'<sub>m2 </sub>'; }?>
                  </td>
                </tr>

                </tbody>
              </table>
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["<?php echo$nama[0]?>", "<?php echo$nama[1]?>", "<?php echo$nama[2]?>", "<?php echo$nama[3]?>", "<?php echo$nama[4]?>", "<?php echo$nama[5]?>"],
      datasets: [{
        label: ' ',
        data: [<?php echo $jenis1.','.$jenis2.','.$jenis3.','.$jenis4.','.$jenis5.','.$jenis6 ?>],
        backgroundColor: [
        'rgba(244, 66, 66, 0.2)',
        'rgba(255, 140, 0, 0.2)',
        'rgba(0, 25, 255, 0.2)',
        'rgba(28, 188, 0, 0.2)',
        'rgba(0, 233, 255, 0.2)',
        'rgba(0, 233, 255, 0.2)'
        ],
        borderColor: [
        'red',
        'yellow',
        'blue',
        'green',
        'aqua',
        'primary'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script>