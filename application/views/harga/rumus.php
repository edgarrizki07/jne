<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() { var cabang = $('#cabang').val();
			window.open('<?php echo site_url();?>harga/cabang/'+cabang);
		});
	});
</script>
<?php	
$this->db->select_min('tgl'); $d = $this->db->get('beli');
$r=$d->num_rows();if($r>0){foreach($d->result()as$h){$tbl=$h->tgl;}}else{$tbl='';} 
$all=  (((strtotime(date('Y-m-d')))-(strtotime($tbl)))/86400)+1; 
?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><b><?php echo $title;?></b> <small>Mulai tgl <?php echo $this->jurnal_model->tgl_singkatan($tbl);?> (<?php echo $all;?> Hari) </small></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<?php
		if($this->session->userdata('SUCCESSMSG')) {
			echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>";
			$this->session->unset_userdata('SUCCESSMSG');
		}
	?>
	<!-- Main content -->
	<?php $t = "SELECT avg(harga) as jml FROM beli WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
	<?php if($r>0){ foreach($d->result() as $h){ $avgexbeli = $h->jml; } }else{ $avgexbeli = 0; } ?>
	<?php $t = "SELECT avg(tot9/jml) as jml FROM beli WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
	<?php if($r>0){ foreach($d->result() as $h){ $avginbeli = $h->jml; } }else{ $avginbeli = 0; } ?>
	<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
	<?php if($r>0){ foreach($d->result() as $h){ $jmlbeli = $h->jml; } }else{ $jmlbeli = 0; } ?>
	<?php $t = "SELECT avg(harga) as jml FROM jual WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
	<?php if($r>0){ foreach($d->result() as $h){ $avgexjual = $h->jml; } }else{ $avgexjual = 0; } ?>
	<?php $t = "SELECT avg(tot9/jml) as jml FROM jual WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
	<?php if($r>0){ foreach($d->result() as $h){ $avginjual = $h->jml; } }else{ $avginjual = 0; } ?>
	<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
	<?php if($r>0){ foreach($d->result() as $h){ $jmljual = $h->jml; } }else{ $jmljual = 0; } ?>
	<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
	<?php if($r>0){ foreach($d->result() as $h){ $jmldo = $h->jml; } }else{ $jmldo = 0; } ?>
	<?php $jmlstok = ($jmlbeli-$jmldo);?>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<table class="table table-bordered table-striped">
							<thead>
							<?php if($this->session->userdata('ADMIN') =='1'){ ?>
								<tr><?php echo form_label('Cabang','cabang'); ?>
										<div class="input-group margin">
										<select name="cabang" id="cabang" class="form-control" >
										<?php $cab = $this->db->get_where('wp'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
											<option value="<?php echo $row->id;?>"><?php echo $row->id;?> - <?php echo $row->kota;?></option>
										<?php endforeach;?>
										</select>
										<span class="input-group-btn">
										  <?php echo form_button('lihat', 'Lihat', "id = 'button-view', class = 'btn btn-info btn-flat'" ); ?>
										</span>
										</div>
								</tr>
							<?php } ?>
								<tr>
									<th>Total Keseluruhan</th>
									<th>Beli Exclude : <br><?php echo number_format ($avgexbeli, 0, ',', '.');?></th>
									<th>Beli Include : <br><?php echo number_format ($avginbeli, 0, ',', '.');?></th>
									<th>Beli : <br><?php echo number_format ($jmlbeli, 0, ',', '.');?> L</th>
									<th>Jual Exclude : <br><?php echo number_format ($avgexjual, 0, ',', '.');?></th>
									<th>Jual Include : <br><?php echo number_format ($avginjual, 0, ',', '.');?></th>
									<th>Jual : <br><?php echo number_format ($jmljual, 0, ',', '.');?> L</th>
									<th>Out from DO : <br><?php echo number_format ($jmldo, 0, ',', '.');?> L</th>
									<th>Stok : <br><?php echo number_format ($jmlstok, 0, ',', '.');?> L</th>
								</tr>
							</thead>
						</table>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>HPP</th>
									<th>AVG Beli</th>
									<th>PO</th>
									<th>Total Beli</th>
									<th>AVG Jual</th>
									<th>Invoice</th>
									<th>Total Jual</th>
									<th>DO</th>
									<th>Total DO</th>
									<th>Stok</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=0; foreach($info as $row ): $no++;?>
<?php $start= $this->setting_model->Start(); ?>
<?php $day=strtotime('-'.($row->id-1).' day',strtotime(date('Y-m-d'))); $tg= date('Y-m-d', $day); ?>
<?php $d1=strtotime('-'.($row->id).' day',strtotime(date('Y-m-d'))); $tgl1= date('Y-m-d', $d1);?>
<?php $day1=strtotime('-'.($row->id+14).' day',strtotime(date('Y-m-d')));?>
<?php if($this->jurnal_model->ambilTgl($tg)>15){ $ftg= date('Y-m-16', $day); $ftg1= date('Y-m-01', $day);}else{ $ftg= date('Y-m-01', $day); $ftg1= date('Y-m-16', $day1); }?>
<?php $dim=days_in_month($this->jurnal_model->ambilBln($ftg1), $this->jurnal_model->ambilThn($ftg1));?>
<?php if($this->jurnal_model->ambilTgl($tg)>15){ $tg1= date('Y-m-15', $day1); }else{ $tg1= date('Y-m-', $day1).$dim;}?>
<?php $fromtgl= $this->jurnal_model->tgl_singkatan($ftg); $fromtgl1= $this->jurnal_model->tgl_singkatan($ftg1); ?>
<?php $totgl= $this->jurnal_model->tgl_singkatan($tg); $totgl1= $this->jurnal_model->tgl_singkatan($tg1); ?>
<!-- tgl beli -->
<?php $t = "SELECT * FROM beli WHERE cek='0' AND status >'1' AND tgl<'$tg'"; $d=$this->bbm_model->manualQuery($t);$r=$d->num_rows();if($r>0){foreach($d->result()as$h){$tglbeli=$h->tgl;}}else{$tglbeli='';} ?>
<!-- beli -->
<?php $t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl='$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $avgexbelitgl = $h->jml; } }else{ $avgexbelitgl = 0; } ?>
<?php $t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl='$tglbeli' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $avgexbelitgl1 = $h->jml; } }else{ $avgexbelitgl1 = 0; } ?>
<?php $t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl BETWEEN '$ftg' AND '$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $realavgexbelitgl = $h->jml; } }else{ $realavgexbelitgl = 0; } ?>
<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl BETWEEN '$ftg' AND '$tg'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $totbeli = $h->jml; } }else{ $totbeli = 0; } ?>
<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl='$tg'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $jmlbeli = $h->jml; } }else{ $jmlbeli = 0; } ?>
<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl BETWEEN '$start' AND '$tg'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $realtotbeli = $h->jml; } }else{ $realtotbeli = 0; } ?>
<?php $t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl BETWEEN '$start' AND '$tgl1'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $realtotbeli1 = $h->jml; } }else{ $realtotbeli1 = 0; } ?>
<!-- jual -->
<?php $t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl='$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $avgexjualtgl = $h->jml; } }else{ $avgexjualtgl = 0; } ?>
<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl BETWEEN '$ftg' AND '$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $totjual = $h->jml; } }else{ $totjual = 0; } ?>
<?php $t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl='$tg'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $jmljual = $h->jml; } }else{ $jmljual = 0; } ?>
<!-- do & stok -->
<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tglkirim BETWEEN '$ftg' AND '$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $totdo = $h->jml; } }else{ $totdo = 0; } ?>
<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tglkirim='$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $jmldo = $h->jml; } }else{ $jmldo = 0; } ?>
<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tglkirim BETWEEN '$start' AND '$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $realtotdo = $h->jml; } }else{ $realtotdo = 0; } ?>
<?php $t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tglkirim BETWEEN '$start' AND '$tgl1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); ?>
<?php if($r>0){ foreach($d->result() as $h){ $realtotdo1 = $h->jml; } }else{ $realtotdo1 = 0; } ?>
<?php $stok = ($totbeli-$totdo);?>
<?php $realstok = ($realtotbeli-$realtotdo);?>
<?php $realstok1 = ($realtotbeli1-$realtotdo1);?>
<?php $ratgl = (($avgexbelitgl*$jmlbeli)+($avgexbelitgl1*$realstok1))/($jmlbeli+$realstok1);?>
								<?php if($ftg==$tg){ ?><tr class="text-red"><?php }else{ ?><tr><?php }?>
									<td><?php echo $no;?></td>
									<td class="time"><?php if($ftg!=$tg){ ?><?php echo $this->jurnal_model->ambilTgl($ftg);?> -<br><?php }?><p><?php echo $totgl;?></p></td>
									
									<td><p title="(pembelian baru(<?php echo number_format ($avgexbelitgl, 0, ',', '.');?> x <?php echo number_format ($jmlbeli, 0, ',', '.');?>) + stok sebelummya(<?php echo number_format ($avgexbelitgl1, 0, ',', '.');?> x <?php echo number_format ($realstok1, 0, ',', '.');?>))/(<?php echo number_format ($jmlbeli, 0, ',', '.');?> + <?php echo number_format ($realstok1, 0, ',', '.');?>)" class="pull-right"><?php echo number_format ($ratgl, 0, ',', '.');?></p><br><p title=" sum(volume x beli) dari tgl <?php echo $start;?> sampai <?php echo $totgl;?>" class="pull-right"><?php echo number_format ($realavgexbelitgl, 0, ',', '.');?></p></td>
									
									<td><p title=" sum(volume x beli) pada tgl <?php echo $totgl;?>"class="pull-right"><?php echo number_format ($avgexbelitgl, 0, ',', '.');?></p><br><p title="sum(volume x beli) pada tgl <?php echo $this->jurnal_model->tgl_singkatan($tglbeli);?>" class="pull-right"><?php echo number_format ($avgexbelitgl1, 0, ',', '.');?></p></td>
									
									<td><?php if($this->bbm_model->JmlBeliTgl($tg)==0){ ?><?php }else{ ?><?php echo $this->bbm_model->JmlBeliTgl($tg);?> PO<a class="pull-right" href="<?php echo site_url('beli/success/'.$tg);?>" ><?php echo number_format ($jmlbeli, 0, ',', '.');?> L</a><?php } ?></td>
									
									<td><p class="pull-right" ><?php echo number_format ($totbeli, 0, ',', '.');?> L</p></td>
									
									<td><p class="pull-right"><?php echo number_format ($avgexjualtgl, 0, ',', '.');?></p></td>
									
									<td><?php if($this->bbm_model->JmlJualTgl($tg)==0){ ?><?php }else{ ?><?php echo $this->bbm_model->JmlJualTgl($tg);?> INV<a class="pull-right" href="<?php echo site_url('jual/success/'.$tg);?>" ><?php echo number_format ($jmljual, 0, ',', '.');?> L</a><?php } ?></td>
									
									<td><p class="pull-right" ><?php echo number_format ($totjual, 0, ',', '.');?> L</p></td>
									
									<td><?php if($this->bbm_model->JmlDOTgl($tg)==0){ ?><?php }else{ ?><?php echo $this->bbm_model->JmlDOTgl($tg);?> DO<a class="pull-right" href="<?php echo site_url('jual/do_list/'.$tg);?>" ><?php echo number_format ($jmldo, 0, ',', '.');?> L</a><?php } ?></td>
									
									<td><p class="pull-right" ><?php echo number_format ($totdo, 0, ',', '.');?> L</p></td>
									
									<td><p class="pull-right"><?php echo number_format ($realstok, 0, ',', '.');?> L</p><br><p class="pull-right"><?php echo number_format ($realstok1, 0, ',', '.');?> L</p></td>
								</tr>
							<?php endforeach;?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->