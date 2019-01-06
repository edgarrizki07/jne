	<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><b><?php echo $title;?></b><small></small></h1>
          <ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><b><?php echo $title;?></b></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box">
				<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>"; $this->session->unset_userdata('SUCCESSMSG'); } ?>
                <div class="box-header with-border">
                  <h3 class="box-title">Laporan Rekap</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center">
                        <strong>Grafik Per Bulan Tahun : <?php echo date('Y'); ?> </strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="salesChart" style="height: 370px;"></canvas>
                      </div><!-- /.chart-responsive -->
                      <p class="text-center">
                        <strong>Grafik Total Bulanan Tahun : <?php echo date('Y'); ?> </strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="areaChart" style="height: 370px;"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Total Per Bulan</strong>
                      </p>
				<?php $m1 = date('m')-1; $m = date('m'); $y = date('Y'); $tgl1 = $y.'-'.$m1.'-1'; $tgl = $y.'-'.$m.'-1';  ?>
				<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl >='$tgl' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $blnbeli = $h->jml; } }else{ $blnbeli = 0; } ?>
				<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND MONTH(tgl) ='$m1' AND YEAR(tgl) ='$y' "; ?>
				<?php $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $blnbeli1 = $h->jml; } }else{ $blnbeli1 = 0; } ?>
				<?php $t = "SELECT sum(jml*harga) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl >='$tgl' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $rpblnbeli = $h->jml; } }else{ $rpblnbeli = 0; } ?>
				<?php $t = "SELECT sum(jml*harga) as jml FROM beli WHERE cek='0' AND status >'1' AND MONTH(tgl) ='$m1' AND YEAR(tgl) ='$y' ";  ?>
				<?php $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $rpblnbeli1 = $h->jml; } }else{ $rpblnbeli1 = 0; } ?>
				<?php if($blnbeli==0 || $blnbeli1==0){ $persenblnbeli = 0; }else{ $persenblnbeli = (($blnbeli-$blnbeli1)/$blnbeli1)*100; } ?>
                      <div class="progress-group text-red">
                        <span class="progress-text">Pembelian</span>
                        <span class="progress-number"><b><?php if($persenblnbeli <'0'){ ?><i class="fa fa-caret-down"> turun </i><?php } else { ?><i class="fa fa-caret-up"> naik </i><?php } ?> <?php echo number_format ($persenblnbeli, 2, ',', '.');?>%</b> dari <?php echo $this->jurnal_model->getBulan($m1);?></span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m);?></span>
                        <span class="progress-number"><?php echo number_format ($blnbeli, 0, ',', '.');?> L /<b> Rp <?php echo number_format ($rpblnbeli, 0, ',', '.');?></b></span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m1);?></span>
                        <span class="progress-number"><?php echo number_format ($blnbeli1, 0, ',', '.');?> L /<b> Rp <?php echo number_format ($rpblnbeli1, 0, ',', '.');?></b></span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-red" style="width: <?php echo $persenblnbeli;?>%"></div>
                        </div>
                      </div><!-- /.progress-group -->
				<?php $m1 = date('m')-1; $m = date('m'); $y = date('Y'); $tgl1 = $y.'-'.$m1.'-1'; $tgl = $y.'-'.$m.'-1';  ?>
				<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl >='$tgl' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $blnjual = $h->jml; } }else{ $blnjual = 0; } ?>
				<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' AND MONTH(tgl) ='$m1' AND YEAR(tgl) ='$y' "; ?>
				<?php $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $blnjual1 = $h->jml; } }else{ $blnjual1 = 0; } ?>
				<?php $t = "SELECT sum(jml*harga) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl >='$tgl' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $rpblnjual = $h->jml; } }else{ $rpblnjual = 0; } ?>
				<?php $t = "SELECT sum(jml*harga) as jml FROM jual WHERE cek='0' AND status >'1' AND MONTH(tgl) ='$m1' AND YEAR(tgl) ='$y' ";  ?>
				<?php $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $rpblnjual1 = $h->jml; } }else{ $rpblnjual1 = 0; } ?>
				<?php if($blnjual==0 || $blnjual1==0){ $persenblnjual = 0; }else{ $persenblnjual = (($blnjual-$blnjual1)/$blnjual1)*100; } ?>
                      <div class="progress-group text-green">
                        <span class="progress-text">Penjualan</span>
                        <span class="progress-number"><b><?php if($persenblnjual <'0'){ ?><i class="fa fa-caret-down"> turun </i><?php } else { ?><i class="fa fa-caret-up"> naik </i><?php } ?> <?php echo number_format ($persenblnjual, 2, ',', '.');?>%</b> dari <?php echo $this->jurnal_model->getBulan($m1);?></span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m);?></span>
                        <span class="progress-number"><?php echo number_format ($blnjual, 0, ',', '.');?> L /<b> Rp <?php echo number_format ($rpblnjual, 0, ',', '.');?></b></span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m1);?></span>
                        <span class="progress-number"><?php echo number_format ($blnjual1, 0, ',', '.');?> L /<b> Rp <?php echo number_format ($rpblnjual1, 0, ',', '.');?></b></span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-green" style="width: <?php echo $persenblnjual;?>%"></div>
                        </div>
                      </div><!-- /.progress-group -->
				<?php $m1 = date('m')-1; $m = date('m'); $y = date('Y'); $tgl1 = $y.'-'.$m1.'-1'; $tgl = $y.'-'.$m.'-1';  ?>
				<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tglkirim >='$tgl' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $blndo = $h->jml; } }else{ $blndo = 0; } ?>
				<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND MONTH(tglkirim) ='$m1' AND YEAR(tglkirim) ='$y' "; ?>
				<?php $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
				<?php if($r>0){ foreach($d->result() as $h){ $blndo1 = $h->jml; } }else{ $blndo1 = 0; } ?>
				<?php if($blndo==0 || $blndo1==0){ $persenblndo = 0; }else{ $persenblndo = (($blndo-$blndo1)/$blndo1)*100; } ?>
                      <div class="progress-group text-yellow">
                        <span class="progress-text">Delivery Order</span>
                        <span class="progress-number"><b><?php if($persenblndo <='0'){ ?><i class="fa fa-caret-down"> turun </i><?php } else { ?><i class="fa fa-caret-up"> naik </i><?php } ?> <?php echo number_format ($persenblndo, 2, ',', '.');?>%</b> dari <?php echo $this->jurnal_model->getBulan($m1);?></span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m);?></span>
                        <span class="progress-number"><?php echo number_format ($blndo, 0, ',', '.');?> L</span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m1);?></span>
                        <span class="progress-number"><?php echo number_format ($blndo1, 0, ',', '.');?> L</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-green" style="width: <?php echo $persenblndo;?>%"></div>
                        </div>
                      </div><!-- /.progress-group -->
				<?php $blnstok = $blnbeli-$blndo; $blnstok1 = $blnbeli1-$blndo1; ?>
				<?php if($blnstok==0 || $blnstok1==0){ $persenblnstok = 0; }else{ $persenblnstok = (($blnstok-$blnstok1)/$blnstok1)*100; } ?>
                      <div class="progress-group text-aqua">
                        <span class="progress-text">Inventory</span>
                        <span class="progress-number"><b><?php if($persenblnstok <'0'){ ?><i class="fa fa-caret-down"> turun </i><?php } else { ?><i class="fa fa-caret-up"> naik </i><?php } ?> <?php echo number_format ($persenblnstok, 2, ',', '.');?>%</b> dari <?php echo $this->jurnal_model->getBulan($m1);?></span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m);?></span>
                        <span class="progress-number"><b><?php echo number_format ($blnstok, 0, ',', '.');?> L</b></span><br>
                        <span class="progress-text"><?php echo $this->jurnal_model->getBulan($m1);?></span>
                        <span class="progress-number"><b><?php echo number_format ($blnstok1, 0, ',', '.');?> L</b></span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-aqua" style="width: <?php echo $persenblnstok;?>%"></div>
                        </div>
                      </div><!-- /.progress-group -->
					  
              <!-- Info Boxes Style 2 -->
                      <p class="text-center">
                        <strong>Total Bulanan</strong>
                      </p>
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="glyphicon glyphicon-briefcase"></i></span>
                <div class="info-box-content">
					<?php $t = "SELECT sum(jml*harga) as jml FROM beli WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $rptotbeli = $h->jml; } }else{ $rptotbeli = 0; } ?>
                  <span class="info-box-text">Pembelian : Rp <?php echo number_format ($rptotbeli, 0, ',', '.');?></span>
					<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $totbeli = $h->jml; } }else{ $totbeli = 0; } ?>
					<?php $m = date('m')-1; $y = date('Y');  $d = date('d');  $tgl30 = $y.'-'.$m.'-'.$d;  ?>
					<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl <='$tgl30' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $totbeli30 = $h->jml; } }else{ $totbeli30 = 0; } ?>
					<?php if($totbeli==0 || $totbeli30==0){ $persenbeli = 0; }else{ $persenbeli = (($totbeli-$totbeli30)/$totbeli30)*100; } ?>
                  <span class="info-box-number">PO : <?php echo number_format ($totbeli, 0, ',', '.');?> L </span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $persenbeli;?>%"></div>
                  </div>
                  <span class="progress-description pull-right">
                    <i class="fa fa-caret-up"></i> <?php echo number_format ($persenbeli, 2, ',', '.');?>% dalam 30 hari (<?php echo number_format ($totbeli30, 0, ',', '.');?> L)
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                <div class="info-box-content">
					<?php $t = "SELECT sum(jml*harga) as jml FROM jual WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $rptotjual = $h->jml; } }else{ $rptotjual = 0; } ?>
                  <span class="info-box-text">Penjualan  : Rp <?php echo number_format ($rptotjual, 0, ',', '.');?></span>
					<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $totjual = $h->jml; } }else{ $totjual = 0; } ?>
					<?php $m = date('m')-1; $y = date('Y');  $d = date('d');  $tgl30 = $y.'-'.$m.'-'.$d;  ?>
					<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl <='$tgl30' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $totjual30 = $h->jml; } }else{ $totjual30 = 0; } ?>
					<?php if($totjual==0 || $totjual30==0){ $persenjual = 0; }else{ $persenjual = (($totjual-$totjual30)/$totjual30)*100; } ?>
                  <span class="info-box-number">Jual : <?php echo number_format ($totjual, 0, ',', '.');?> L</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $persenjual;?>%"></div>
                  </div>
                  <span class="progress-description pull-right">
                    <i class="fa fa-caret-up"></i> <?php echo number_format ($persenjual, 2, ',', '.');?>% dalam 30 hari (<?php echo number_format ($totjual30, 0, ',', '.');?> L)
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Delivery Order</span>
					<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $totdo = $h->jml; } }else{ $totdo = 0; } ?>
					<?php $m = date('m')-1; $y = date('Y');  $d = date('d');  $tgl30 = $y.'-'.$m.'-'.$d;  ?>
					<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tglkirim <='$tgl30' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
					<?php if($r>0){ foreach($d->result() as $h){ $totdo30 = $h->jml; } }else{ $totdo30 = 0; } ?>
					<?php if($totdo==0 || $totdo30==0){ $persendo = 0; }else{ $persendo = (($totdo-$totdo30)/$totdo30)*100; } ?>
                  <span class="info-box-number">DO : <?php echo number_format ($totdo, 0, ',', '.');?> L</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $persendo;?>%"></div>
                  </div>
                  <span class="progress-description pull-right">
                    <i class="fa fa-caret-up"></i> <?php echo number_format ($persendo, 2, ',', '.');?>% dalam 30 hari (<?php echo number_format ($totdo30, 0, ',', '.');?> L)
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="glyphicon glyphicon-oil"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Inventory : </span>
					<?php $stok = ($totbeli-$totdo); $stok30 = ($totbeli30-$totdo30) ;?>
					<?php if($stok==0 || $stok30==0){ $persenstok = 0; }else{ $persenstok = (($stok-$stok30)/$stok30)*100; } ?>
                  <span class="info-box-number"><?php echo number_format ($stok, 0, ',', '.');?> L</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $persenstok;?>%"></div>
                  </div>
                  <span class="progress-description pull-right">
                    <?php if($persenstok <'0'){ ?><i class="fa fa-caret-down"></i><?php } else { ?><i class="fa fa-caret-up"></i><?php } ?> <?php echo number_format ($persenstok, 2, ',', '.');?>% dalam 30 hari (<?php echo number_format ($stok30, 0, ',', '.');?> L)
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->

                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafik Harga Rata-Rata Akumulatif</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                      <p class="text-center">
                        <strong>Grafik Per Periode 1/2 Bulan Tahun : <?php echo date('Y'); ?> </strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="hargaChart" style="height: 370px;"></canvas>
                      </div><!-- /.chart-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?php echo site_url('harga');?>" class="btn btn-sm btn-default btn-flat pull-right">Lihat Detail</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

			<!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">

              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Inventory Gudang Utama</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead title="load time: {elapsed_time}" >
                        <tr>
                          <th>Cabang</th>
                          <th>In from PO</th>
                          <th>Out from DO</th>
                          <th>Inventory</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get('wp');?>
						<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
			<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND storage='0' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabbeli0 = $h->jml; } }else{ $cabbeli0 = 0; } ?>
			<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND storage='0' AND wp_id='$row->id' AND status ='0' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabdo0 = $h->jml; } }else{ $cabdo0 = 0; } ?>
			<?php $cabstok0 = $cabbeli0-$cabdo0;?>
						<tr>
							<td><?php echo $row->id;?> / <?php echo $row->kota;?></td>
							<td><b class="pull-right"><?php echo number_format ($cabbeli0, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabdo0, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabstok0, 0, ',', '.');?> L</b></td>
						</tr>
						<?php endforeach;?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Inventory Gudang Cadangan</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead title="load time: {elapsed_time}" >
                        <tr>
                          <th>Cabang</th>
                          <th>In from PO</th>
                          <th>Out from DO</th>
                          <th>Inventory</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get('wp');?>
						<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
			<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND storage='1' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabbeli1 = $h->jml; } }else{ $cabbeli1 = 0; } ?>
			<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND storage='1' AND wp_id='$row->id' AND status ='0' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabdo1 = $h->jml; } }else{ $cabdo1 = 0; } ?>
			<?php $cabstok1 = $cabbeli1-$cabdo1;?>
						<tr>
							<td><?php echo $row->id;?> / <?php echo $row->kota;?></td>
							<td><b class="pull-right"><?php echo number_format ($cabbeli1, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabdo1, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabstok1, 0, ',', '.');?> L</b></td>
						</tr>
						<?php endforeach;?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Inventory Gudang Supplier</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead title="load time: {elapsed_time}" >
                        <tr>
                          <th>Cabang</th>
                          <th>In from PO</th>
                          <th>Out from DO</th>
                          <th>Inventory</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get('wp');?>
						<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
			<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND storage='2' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabbeli2 = $h->jml; } }else{ $cabbeli3 = 0; } ?>
			<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND storage='2' AND wp_id='$row->id' AND status ='0' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabdo2 = $h->jml; } }else{ $cabdo2 = 0; } ?>
			<?php $cabstok2 = $cabbeli2-$cabdo2;?>
						<tr>
							<td><?php echo $row->id;?> / <?php echo $row->kota;?></td>
							<td><b class="pull-right"><?php echo number_format ($cabbeli2, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabdo2, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabstok2, 0, ',', '.');?> L</b></td>
						</tr>
						<?php endforeach;?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Inventory Gudang Lain</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead title="load time: {elapsed_time}" >
                        <tr>
                          <th>Cabang</th>
                          <th>In from PO</th>
                          <th>Out from DO</th>
                          <th>Inventory</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get('wp');?>
						<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
			<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND storage='3' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabbeli3 = $h->jml; } }else{ $cabbeli3 = 0; } ?>
			<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND storage='3' AND wp_id='$row->id' AND status ='0' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabdo3 = $h->jml; } }else{ $cabdo3 = 0; } ?>
			<?php $cabstok3 = $cabbeli3-$cabdo3;?>
						<tr>
							<td><?php echo $row->id;?> / <?php echo $row->kota;?></td>
							<td><b class="pull-right"><?php echo number_format ($cabbeli3, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabdo3, 0, ',', '.');?> L</b></td>
							<td><b class="pull-right"><?php echo number_format ($cabstok3, 0, ',', '.');?> L</b></td>
						</tr>
						<?php endforeach;?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  			  
            </div><!-- /.col -->

            <div class="col-md-4">

              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Inventory Cabang</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="chart-responsive">
                        <canvas id="pieChart" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-5">
                      <ul class="chart-legend clearfix">
						<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('wp');?>
						<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
                        <li><i class="fa fa-circle-o text-<?php echo $row->warna;?>"></i> <?php echo $row->kota;?></li>
						<?php endforeach;?>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="nav nav-pills nav-stacked">
					<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('wp');?>
					<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
			<?php $t = "SELECT sum(jml*harga) as jml FROM beli WHERE cek='0' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $rpcabbeli = $h->jml; } }else{ $rpcabbeli = 0; } ?>
			<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabbeli = $h->jml; } }else{ $cabbeli = 0; } ?>
			<?php $t = "SELECT sum(jml*harga) as jml FROM jual WHERE cek='0' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $rpcabjual = $h->jml; } }else{ $rpcabjual = 0; } ?>
			<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabjual = $h->jml; } }else{ $cabjual = 0; } ?>
			<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND wp_id='$row->id' AND status ='0' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabdo = $h->jml; } }else{ $cabdo = 0; } ?>
			<?php $cabstok = $cabbeli-$cabdo; ?>
			<?php if($cabstok==0){ $persencabstok = 0; }else{ $persencabstok = ($cabstok/$stok)*100; } ?>
                    <li><a href="#" class="text-<?php echo $row->warna;?>"><?php echo $row->kota;?><span class="pull-right"><i class="fa fa-angle-down"></i> <?php echo number_format ($persencabstok, 2, ',', '.');?>%</span></a></li>
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="chart-legend">
                        <li><i class="glyphicon glyphicon-briefcase text-red"></i> Pembelian <b class="pull-right">Rp <?php echo number_format ($rpcabbeli, 0, ',', '.');?> / <?php echo number_format ($cabbeli, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-shopping-cart text-green"></i> Penjualan <b class="pull-right">Rp <?php echo number_format ($rpcabjual, 0, ',', '.');?> / <?php echo number_format ($cabjual, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-log-in text-red"></i> In from PO<b class="pull-right"><?php echo number_format ($cabbeli, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-log-out text-green"></i> Out from DO <b class="pull-right"><?php echo number_format ($cabdo, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-oil text-aqua"></i> Inventory  <b class="pull-right"><?php echo number_format ($cabstok, 0, ',', '.');?> L</b></li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
					<?php endforeach;?>
                    <li><a href="#">SEMUA<span class="pull-right text-black"><i class="fa fa-angle-down"></i> 100%</span></a></li>
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="chart-legend">
                        <li><i class="glyphicon glyphicon-briefcase text-red"></i> Pembelian <b class="pull-right">Rp <?php echo number_format ($rptotbeli, 0, ',', '.');?> / <?php echo number_format ($totbeli, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-shopping-cart text-green"></i> Penjualan <b class="pull-right">Rp <?php echo number_format ($rptotjual, 0, ',', '.');?> / <?php echo number_format ($totjual, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-log-in text-red"></i> In from PO <b class="pull-right"><?php echo number_format ($totbeli, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-log-out text-green"></i> Out from DO <b class="pull-right"><?php echo number_format ($totdo, 0, ',', '.');?> L</b></li>
                        <li><i class="glyphicon glyphicon-oil text-aqua"></i> Inventory  <b class="pull-right"><?php echo number_format ($stok, 0, ',', '.');?> L</b></li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                  </ul>
                </div><!-- /.footer -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-12">

              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Pembelian Terakhir</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead title="load time: {elapsed_time}" >
                        <tr>
                          <th>Nomor</th>
                          <th>Vendor</th>
                          <th>Item</th>
                          <th>Status</th>
                          <th>Cabang</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php $this->db->order_by($order_column='id',$order_type='desc'); $sat = $this->db->get_where('beli',array('cek'=>'0'),10);?>
						<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
						<tr>
							<td><a title="tgl <?php echo $this->app_model->tgl_str($row->tgl);?>" href=""><?php echo $row->id_beli;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?>/<?php echo $row->id;?></a></td>
							<td><?php echo $this->supplier_model->NamaSupplier($row->supplier_id);?></td>
							<td class="pull-right"><?php echo number_format ($row->jml, 0, ',', '.');?> L</td>
							<td><?php if($row->cek =='1'){ ?><span class="label label-danger">Cancel</span><?php } else { ?><?php if($row->status =='2'){ ?><span class="label label-success">Sudah ACC</span><?php } else if($row->status =='3'){ ?><span class="label label-warning">Proses Bayar</span><?php } else if($row->status =='4'){ ?><span title="bayar tgl <?php echo $this->app_model->tgl_str($row->tglbyr);?>" class="label label-info">Sudah Bayar</span><?php } else if($row->status =='0'){ ?><span class="label label-primary">Draft</span><?php } else if($row->status =='1'){ ?><span class="label label-warning">Proses ACC</span><?php } ?><?php } ?>
							</td>
							<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
						</tr>
						<?php endforeach;?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?php echo site_url('beli');?>" class="btn btn-sm btn-default btn-flat pull-right">Lihat Semua Pembelian</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
			  
              <!-- TABLE: LATEST SELLER -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Penjualan Terakhir</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead title="load time: {elapsed_time}" >
                        <tr>
                          <th>Nomor</th>
                          <th>Customers</th>
                          <th>Item</th>
                          <th>Status</th>
                          <th>Cabang</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php $this->db->order_by($order_column='id',$order_type='desc'); $sat = $this->db->get_where('jual',array('cek'=>'0'),10);?>
						<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
						<tr>
							<td><a title="tgl <?php echo $this->app_model->tgl_str($row->tgl);?>" href=""><?php echo $row->id_jual;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?>/<?php echo $row->id;?></a></td>
							<td><?php echo $this->customer_model->NamaCustomer($row->customer_id);?></td>
							<td class="pull-right"><?php echo number_format ($row->jml, 0, ',', '.');?> L</td>
							<td><?php if($row->cek =='1'){ ?><span class="label label-danger">Cancel</span><?php } else { ?><?php if($row->status =='2'){ ?><span class="label label-success">Sudah ACC</span><?php } else if($row->status =='3'){ ?><span class="label label-warning">Proses Bayar</span><?php } else if($row->status =='4'){ ?><span class="label label-info">Sudah Bayar</span><?php } else if($row->status =='0'){ ?><span class="label label-primary">Draft</span><?php } else if($row->status =='1'){ ?><span class="label label-warning">Proses ACC</span><?php } ?><?php } ?>
							</td>
							<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
						</tr>
						<?php endforeach;?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?php echo site_url('jual');?>" class="btn btn-sm btn-default btn-flat pull-right">Lihat Semua Penjualan</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
			  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    </div><!-- ./wrapper -->
<?php if($this->bbm_model->JmlInventory($this->session->userdata('SESS_WP_ID')) >'0'){ ?>
        <script type="text/javascript">
$(function () {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */
  //-----------------------
  //- MONTHLY HARGA CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var hargaChartCanvas = $("#hargaChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var hargaChart = new Chart(hargaChartCanvas);

  var hargaChartData = {
    labels: 
	[
			<?php $tahun=date('Y');?>
			<?php if(date('m')>=1){  ?>"1-15 <?php echo $this->jurnal_model->getBln(1);?>",<?php if(date('Ymd')>=date('Y').'-1-16'){  ?>"16-<?php echo days_in_month(1,$tahun);?> <?php echo $this->jurnal_model->getBln(1);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=2){  ?>"1-15 <?php echo $this->jurnal_model->getBln(2);?>",<?php if(date('Ymd')>=date('Y').'-2-16'){  ?>"16-<?php echo days_in_month(2,$tahun);?> <?php echo $this->jurnal_model->getBln(2);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=3){  ?>"1-15 <?php echo $this->jurnal_model->getBln(3);?>",<?php if(date('Ymd')>=date('Y').'-3-16'){  ?>"16-<?php echo days_in_month(3,$tahun);?> <?php echo $this->jurnal_model->getBln(3);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=4){  ?>"1-15 <?php echo $this->jurnal_model->getBln(4);?>",<?php if(date('Ymd')>=date('Y').'-4-16'){  ?>"16-<?php echo days_in_month(4,$tahun);?> <?php echo $this->jurnal_model->getBln(4);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=5){  ?>"1-15 <?php echo $this->jurnal_model->getBln(5);?>",<?php if(date('Ymd')>=date('Y').'-5-16'){  ?>"16-<?php echo days_in_month(5,$tahun);?> <?php echo $this->jurnal_model->getBln(5);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=6){  ?>"1-15 <?php echo $this->jurnal_model->getBln(6);?>",<?php if(date('Ymd')>=date('Y').'-6-16'){  ?>"16-<?php echo days_in_month(6,$tahun);?> <?php echo $this->jurnal_model->getBln(6);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=7){  ?>"1-15 <?php echo $this->jurnal_model->getBln(7);?>",<?php if(date('Ymd')>=date('Y').'-7-16'){  ?>"16-<?php echo days_in_month(7,$tahun);?> <?php echo $this->jurnal_model->getBln(7);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=8){  ?>"1-15 <?php echo $this->jurnal_model->getBln(8);?>",<?php if(date('Ymd')>=date('Y').'-8-16'){  ?>"16-<?php echo days_in_month(8,$tahun);?> <?php echo $this->jurnal_model->getBln(8);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=9){  ?>"1-15 <?php echo $this->jurnal_model->getBln(9);?>",<?php if(date('Ymd')>=date('Y').'-9-16'){  ?>"16-<?php echo days_in_month(9,$tahun);?> <?php echo $this->jurnal_model->getBln(9);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=10){  ?>"1-15 <?php echo $this->jurnal_model->getBln(10);?>",<?php if(date('Ymd')>=date('Y').'-10-16'){  ?>"16-<?php echo days_in_month(10,$tahun);?> <?php echo $this->jurnal_model->getBln(10);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=11){  ?>"1-15 <?php echo $this->jurnal_model->getBln(11);?>",<?php if(date('Ymd')>=date('Y').'-11-16'){  ?>"16-<?php echo days_in_month(11,$tahun);?> <?php echo $this->jurnal_model->getBln(11);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=12){  ?>"1-15 <?php echo $this->jurnal_model->getBln(12);?>"<?php } ?>
	],
    datasets: [
		{
        label: "Beli Exclude",
        fillColor: "#00a65a",
        strokeColor: "green",
        pointColor: "#00a65a",
        pointStrokeColor: "green",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: 
		[
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-1-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-1-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-2-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-2-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-3-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-3-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-4-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-4-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-5-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-5-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-6-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-6-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-7-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-7-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-8-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-8-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-9-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-9-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-10-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-10-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-11-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-11-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-12-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-12-16');?> 
		]
      }
    ]
  };

  var hargaChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 5,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  hargaChart.Line(hargaChartData, hargaChartOptions);

  //---------------------------
  //- END MONTHLY HARGA CHART -
  //---------------------------
   
  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
    labels: 
	[
			<?php if(date('m')>=1){  ?>"<?php echo $this->jurnal_model->getBulan(1);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=2){  ?>"<?php echo $this->jurnal_model->getBulan(2);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=3){  ?>"<?php echo $this->jurnal_model->getBulan(3);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=4){  ?>"<?php echo $this->jurnal_model->getBulan(4);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=5){  ?>"<?php echo $this->jurnal_model->getBulan(5);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=6){  ?>"<?php echo $this->jurnal_model->getBulan(6);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=7){  ?>"<?php echo $this->jurnal_model->getBulan(7);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=8){  ?>"<?php echo $this->jurnal_model->getBulan(8);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=9){  ?>"<?php echo $this->jurnal_model->getBulan(9);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=10){  ?>"<?php echo $this->jurnal_model->getBulan(10);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=11){  ?>"<?php echo $this->jurnal_model->getBulan(11);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=12){  ?>"<?php echo $this->jurnal_model->getBulan(12);?>"<?php } ?>
	],
    datasets: [
		{
        label: "Penjualan",
        fillColor: "#00a65a",
        strokeColor: "green",
        pointColor: "#00a65a",
        pointStrokeColor: "green",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: 
		[
		<?php echo $this->jurnal_model->GrafikJmlJual(1);?>,
		<?php echo $this->jurnal_model->GrafikJmlJual(2);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(3);?>,
		<?php echo $this->jurnal_model->GrafikJmlJual(4);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(5);?>,
		<?php echo $this->jurnal_model->GrafikJmlJual(6);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(7);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(8);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(9);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(10);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(11);?>, 
		<?php echo $this->jurnal_model->GrafikJmlJual(12);?> 
		]
      },
      {
        label: "Pembelian",
        fillColor: "#f56954",
        strokeColor: "red",
        pointColor: "#f56954",
        pointStrokeColor: "red",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: 
		[ 
		<?php echo $this->jurnal_model->GrafikJmlBeli(1);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(2);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(3);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(4);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(5);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(6);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(7);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(8);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(9);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(10);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(11);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(12);?> 
		]
      },
      {
        label: "Delivery Order",
        fillColor: "#f7c716",
        strokeColor: "yellow",
        pointColor: "#f7c716",
        pointStrokeColor: "yellow",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: 
		[ 
		<?php echo $this->jurnal_model->GrafikJmlDO(1);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(2);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(3);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(4);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(5);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(6);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(7);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(8);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(9);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(10);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(11);?>, 
		<?php echo $this->jurnal_model->GrafikJmlDO(12);?> 
		]
      },
      {
        label: "Inventory",
        fillColor: "#00c0ef",
        strokeColor: "aqua",
        pointColor: "#00c0ef",
        pointStrokeColor: "aqua",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: 
		[ 
		<?php echo $this->jurnal_model->GrafikJmlBeli(1)-$this->jurnal_model->GrafikJmlDO(1);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(2)-$this->jurnal_model->GrafikJmlDO(2);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(3)-$this->jurnal_model->GrafikJmlDO(3);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(4)-$this->jurnal_model->GrafikJmlDO(4);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(5)-$this->jurnal_model->GrafikJmlDO(5);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(6)-$this->jurnal_model->GrafikJmlDO(6);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(7)-$this->jurnal_model->GrafikJmlDO(7);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(8)-$this->jurnal_model->GrafikJmlDO(8);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(9)-$this->jurnal_model->GrafikJmlDO(9);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(10)-$this->jurnal_model->GrafikJmlDO(10);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(11)-$this->jurnal_model->GrafikJmlDO(11);?>, 
		<?php echo $this->jurnal_model->GrafikJmlBeli(12)-$this->jurnal_model->GrafikJmlDO(12);?> 
		]
      }
    ]
  };

  var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 5,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels: 
			[
			<?php if(date('m')>=1){  ?>"<?php echo $this->jurnal_model->getBulan(1);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=2){  ?>"<?php echo $this->jurnal_model->getBulan(2);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=3){  ?>"<?php echo $this->jurnal_model->getBulan(3);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=4){  ?>"<?php echo $this->jurnal_model->getBulan(4);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=5){  ?>"<?php echo $this->jurnal_model->getBulan(5);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=6){  ?>"<?php echo $this->jurnal_model->getBulan(6);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=7){  ?>"<?php echo $this->jurnal_model->getBulan(7);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=8){  ?>"<?php echo $this->jurnal_model->getBulan(8);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=9){  ?>"<?php echo $this->jurnal_model->getBulan(9);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=10){  ?>"<?php echo $this->jurnal_model->getBulan(10);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=11){  ?>"<?php echo $this->jurnal_model->getBulan(11);?>",<?php } else { ?><?php } ?>
			<?php if(date('m')>=12){  ?>"<?php echo $this->jurnal_model->getBulan(12);?>"<?php } ?>
			],
    datasets: [
<?php if($totbeli > $totjual){  ?>
      {
        label: "Pembelian",
        fillColor: "#f56954",
        strokeColor: "red",
        pointColor: "#f56954",
        pointStrokeColor: "red",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: 
		[ 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-1-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-2-29');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-3-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-4-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-5-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-6-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-7-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-8-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-9-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-10-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-11-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-12-31');?>
		]
      },
<?php } ?>
		{
        label: "Penjualan",
        fillColor: "#00a65a",
        strokeColor: "green",
        pointColor: "#00a65a",
        pointStrokeColor: "green",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: 
		[
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-1-31');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-2-29');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-3-31');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-4-30');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-5-31');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-6-30');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-7-31');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-8-31');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-9-30');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-10-31');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-11-30');?>,
		<?php echo $this->jurnal_model->GrafikTotJual($y.'-12-31');?>
		]
      },
<?php if($totbeli < $totjual){  ?>
      {
        label: "Pembelian",
        fillColor: "#f56954",
        strokeColor: "red",
        pointColor: "#f56954",
        pointStrokeColor: "red",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: 
		[ 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-1-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-2-29');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-3-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-4-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-5-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-6-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-7-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-8-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-9-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-10-31');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-11-30');?>,
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-12-31');?>
		]
      },
<?php } ?>
      {
        label: "Delivery Order",
        fillColor: "#f7c716",
        strokeColor: "yellow",
        pointColor: "#f7c716",
        pointStrokeColor: "yellow",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: 
		[ 
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-1-31');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-2-29');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-3-31');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-4-30');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-5-31');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-6-30');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-7-31');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-8-31');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-9-30');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-10-31');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-11-30');?>,
		<?php echo $this->jurnal_model->GrafikTotDO($y.'-12-31');?>
		]
      },
      {
        label: "Inventory",
        fillColor: "#00c0ef",
        strokeColor: "aqua",
        pointColor: "#00c0ef",
        pointStrokeColor: "aqua",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: 
		[ 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-1-31')-$this->jurnal_model->GrafikTotDO($y.'-1-31');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-2-29')-$this->jurnal_model->GrafikTotDO($y.'-2-29');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-3-31')-$this->jurnal_model->GrafikTotDO($y.'-3-31');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-4-30')-$this->jurnal_model->GrafikTotDO($y.'-4-30');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-5-31')-$this->jurnal_model->GrafikTotDO($y.'-5-31');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-6-30')-$this->jurnal_model->GrafikTotDO($y.'-6-30');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-7-31')-$this->jurnal_model->GrafikTotDO($y.'-7-31');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-8-31')-$this->jurnal_model->GrafikTotDO($y.'-8-31');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-9-30')-$this->jurnal_model->GrafikTotDO($y.'-9-30');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-10-31')-$this->jurnal_model->GrafikTotDO($y.'-10-31');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-11-30')-$this->jurnal_model->GrafikTotDO($y.'-11-30');?>, 
		<?php echo $this->jurnal_model->GrafikTotBeli($y.'-12-31')-$this->jurnal_model->GrafikTotDO($y.'-12-31');?> 
		]
      }
    ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: true,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 5,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: false,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);
 
  
  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
		<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('wp');?>
		<?php $item = $sat->result(); $no=0; foreach($item as $row ): $no++;?>
			<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabbeli = $h->jml; } }else{ $cabbeli = 0; } ?>
			<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND wp_id='$row->id' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
			<?php if($r>0){ foreach($d->result() as $h){ $cabjual = $h->jml; } }else{ $cabjual = 0; } ?>
			<?php $cabstok = $cabbeli-$cabjual; $persencabstok = ($cabstok/$stok)*100;?>
			{
			  value: <?php echo $cabstok;?>,
			  color: "<?php echo $row->warna;?>",
			  highlight: "<?php echo $row->warna;?>",
			  label: "L / <?php echo number_format ($persencabstok, 0, ',', '.');?>"
			},
		<?php endforeach;?>
  ];
  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> <%=label%> %"
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------
});
        </script>
<?php }?>
