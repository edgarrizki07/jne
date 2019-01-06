<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
	<?php if($info['cek'] =='0'){ ?>
			<?php if($info['status'] =='1'){ ?>
			<?php } ?>
			<?php if($info['status'] =='2'){ ?>
			<a target="_blank" href="<?php echo site_url('beli/pdf/'.$info['id']);?>" class="btn btn-success" ><i class='fa fa-print'></i> Print</a>
			<a target="_blank" href="<?php echo site_url('jurnal_proyek/view/'.$info['jurnal_id']);?>" class="btn btn-primary" ><i class='fa fa-file'></i>  Lihat Jurnal</a>
				<?php if($this->session->userdata('ADMIN')<='3'){ ?>
			<a target="_blank" href="<?php echo site_url('beli/add_pay/'.$info['id']);?>" class="btn btn-primary" ><i class='fa fa-file'></i> Bayar</a>
				<?php } ?>
			<?php } ?>
			<?php if($info['bukti'] ==''){ ?>
				<?php if($info['status'] =='2'){ ?>
				<a href="<?php echo site_url('beli/add_pay/'.$info['id']);?>" class="btn btn-danger" ><i class='fa fa-money'></i>  Bayar Pelunasan</a>
				<?php } ?>
			<?php } ?>
			<?php if($info['status'] =='4'){ ?>
			<a target="_blank" href="<?php echo site_url('jurnal_proyek/view/'.$info['jurnal_id']);?>" class="btn btn-primary" ><i class='fa fa-file'></i>  Lihat Jurnal Pembelian</a>
			<a target="_blank" href="<?php echo site_url('jurnal_proyek/view/'.$info['bunker_id']);?>" class="btn btn-primary" ><i class='fa fa-file'></i>  Lihat Jurnal Pelunasan</a>
			<?php } ?>
			<a href="<?php echo site_url('beli');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
	<?php }else{ ?>
			<a href="<?php echo site_url('beli/cancel');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
	<?php } ?>
			<h4 class="text-center text-bold">PURCHASE ORDER 	<?php if($info['cek'] !='0'){ ?>INI TELAH DIHAPUS oleh : <?php echo $this->user_model->NamaUser($info['login_id']); ?> <?php echo $this->user_model->NamaBUser($info['login_id']); ?><?php } ?></h4>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
	$this->session->unset_userdata('SUCCESSMSG'); } ?>
	<!-- Main content -->
	<section class="invoice">
		<div class="row invoice-info">
			<div class="col-sm-7">
				<strong>Kepada :</strong><br>
				<strong>Up. <?php echo $this->supplier_model->CPSupplier($info['supplier_id']);?></strong><br>
				<?php echo $this->supplier_model->NamaSupplier($info['supplier_id']);?><br>
				<?php echo $this->supplier_model->AlamatSupplier($info['supplier_id']);?><br>
				<table width='80%'>
				<tr>
					<td>Phone : <?php echo $this->supplier_model->TelpSupplier($info['supplier_id']);?></td>
				</tr>
				</table>
				Email : <?php echo $this->supplier_model->EmailSupplier($info['supplier_id']);?></br></br>
			</div><!-- /.col -->
			<div class="col-sm-5">
				</br>
				<p>
				No PO : <?php echo $info['id_beli'];?>.<?php echo $this->jurnal_model->ambilTgl($info['tgl']);?>/PO/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $info['id'];?>/<?php echo $this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tgl']));?>/<?php echo $this->jurnal_model->ambilThn($info['tgl']);?></br>
				Tanggal : <?php echo $this->app_model->tgl_indo($info['tgl']);?></br>
				Metode : <strong><?php echo $info['term'];?></strong><br>
				Hauler : <strong><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?></strong><br>
				</p>
			</div><!-- /.col -->
		</div><!-- /.row -->
	<br>
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 ">
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td><b>Uraian</b></td>
							<td><b>Satuan</b></td>
							<td><b>Harga Include</b></td>
							<td><b>Jumlah</b></td>
							<td><b>Harga Satuan</b></td>
							<td align="right"><b>Jumlah</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>High Speed Diesel</td>
							<td>Liter</td>
							<td><?php echo number_format($info['tot9']/$info['jml']);?></td>
							<td><?php echo number_format($info['jml']);?></td>
							<td><?php echo number_format($info['harga'], 2, '.', ',');?></td>
							<td align="right"><?php echo number_format(($info['harga']*$info['jml']), 2, '.', ',');?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-7">
				<table class="table table-striped">
					<thead>
						<tr>
							<td>Sistem Pembayaran</td>
							<td><b>: <?php echo $info['termbyr'];?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b>: <?php echo $info['rekening'];?></b></td>
						</tr>
						<tr>
							<td>Pengambilan</td>
							<td></td>
						</tr>
						<tr>
							<td>Lokasi</td>
							<td><b>: Depo <?php echo $this->supplier_model->NamaSupplier($info['supplier_id']);?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b>: <?php echo $info['depo'];?></b></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td><b>: <?php echo $this->app_model->tgl_indo($info['tglambil']);?></b></td>
						</tr>
						<tr>
							<td>Koordinator</td>
							<td><b>: <?php echo $info['koordinator'];?></b></td>
						</tr>
						<tr>
							<td>Metode</td>
							<td><b>: <?php echo $info['termambil'];?></b></td>
						</tr>
						<tr>
							<td>Invoice ditujukan ke</td>
							<td><b>: <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?> <u><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?></u></b></td>
						</tr>
						<tr>
							<td>Storage</td>
							<td><b>: <?php if($info['storage'] =='0'){ ?>Gudang Utama<?php } else if($info['storage'] =='1'){ ?>Gudang Cadangan<?php } else if($info['storage'] =='2'){ ?>On Supplier<?php } else if($info['storage'] =='3'){ ?>Other Storage<?php } ?></b></td>
						</tr>
					</thead>
				</table>
			</div><!-- /.col -->
	<?php 
	$item = '1'; $jml=$info['jml']*$info['harga']; 
	$d=$info['discount']; $disc=$jml*$d/100; 
	$disctotal=$jml-$disc; $ppn=$disctotal/10*($info['ppn']);
	$pbbkb=$disctotal*($info['npbbkb']/100)*($info['pbbkb']); 
	$pph=$disctotal*3/1000*($info['pph']); $t=($info['ohp']); 
	$td=($t*$jml); $tt=($td)+($info['ppnohp']*$td/10); 
	$gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt); 
	?>
			<div class="col-xs-5">
				<div class="">
					<table width='100%'>
						<tr>
							<th>Subtotal</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot1'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PPn 10%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot4'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PPh 0.3%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot6'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PBBKB <?php echo $info['npbbkb'];?>%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot5'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Rounding</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['rounding'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Total</th>
							<td>Rp</td>
							<td align="right"><b><?php echo number_format ($info['tot9'], 2, '.', ',');?></b></td>
						</tr>
					</table>
				</div>
				<br>
				<p class="lead">Terbilang:</p>
				<b><?php echo $info['terbilang'];?></b>
				</br>________________________________________________</br>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</section><!-- /.content -->
	<div class="clearfix"></div>
</div><!-- /.content-wrapper -->
