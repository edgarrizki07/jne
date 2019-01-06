<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>To : <b><?php echo $this->supplier_model->NamaSupplier($info['supplier_id']);?></b>
			<?php if($info['cek'] !='0'){ ?><h4 class="text-center text-bold">DATA INI TELAH DIHAPUS oleh : <?php echo $this->user_model->NamaUser($info['login_id']); ?> <?php echo $this->user_model->NamaBUser($info['login_id']); ?></h4><?php } ?>
			<?php if($info['jurnal_id'] !=''){ ?><h4 class="text-center text-bold">DATA INI TELAH DI ACC oleh : <?php echo $this->user_model->NamaUser($info['admin_id']); ?> <?php echo $this->user_model->NamaBUser($info['admin_id']); ?></h4><?php } ?>
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
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
			<h4 class="text-center text-bold">HARGA DO</h4>
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
							<td>HIGH SPEED DIESEL FUEL</td>
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
				<br>
				<p class="lead">Terbilang:</p>
				<b><?php echo $info['terbilang'];?></b>
				</br>________________________________________________</br>
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
							<th>Total</th>
							<td>Rp</td>
							<td align="right"><b><?php echo number_format ($info['tot9'], 2, '.', ',');?></b></td>
						</tr>
					</table>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</section><!-- /.content -->
	<section class="content-header">
		<div class="row">
			<form class="form" action="" method="post" enctype="multipart/form-data" >
			<div class="col-md-12">
				<!-- general form elements disabled -->
				<div class="box box-warning">
					<div class="box-body">
						<div class="row">
							<div class="col-lg-12">
								<h4 class="text-center text-bold">INFORMASI TAMBAHAN</h4>
								<div class="hidden">
									<label><strong>ID <?php echo $title;?></strong></label>
									<input name="id" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
										<span class="input-group-addon"> Rp </span>
									<?php $sum=$info['tot3']+$info['tot4']+$info['tot5']+$info['tot6']+$info['tot7']+$info['tot8'];?>
									<input name="tot9" type="text" class="form-control" value="<?php echo $sum;?>" />
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Tambah Rounding </strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> Rp </span>
										<input name="rounding" type="text" value="<?php echo $info['rounding'];?>" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Terbilang Sejumlah</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> <i class='fa fa-money'></i>
										</span><input name="terbilang" type="text" value="<?php echo $info['terbilang'];?>" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Status Pembelian</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<select name="import" class="form-control" required>
										<?php if($info['import'] =='0'){ $import = 'Dalam Negeri';}else{ $import = 'Import Luar Negeri';} ?>
											<option value="<?php echo $info['import'];?>"><?php echo $import;?></option>
											<option value="0">1. Dalam Negeri</option>
											<option value="1">2. Import Luar Negeri</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Cara Bayar</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<select name="bayar" class="form-control" style="width: 100%;" required>
										<?php if($info['bayar'] =='0'){ $bayar = 'Cash';}else{ $bayar = 'Credit';} ?>
											<option value="<?php echo $info['bayar'];?>"><?php echo $bayar;?></option>
											<option value="0">1. Cash</option>
											<option value="1">2. Credit</option>
										</select>
										<span class="input-group-addon"> Due Date </span>
										<?php if($info['tempo'] =='0000-00-00'){ $tempo = $tgl;}else{ $tempo = $info['tempo'];} ?>
										<input type="text" name="tempo" id="datepicker-tempo" value="<?php echo $tempo ;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Sistem Pembayaran</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> Baris 1 </span>
										<input name="termbyr" type="text" value="<?php echo $info['termbyr'];?>" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong></strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> Baris 2 </span>
										<?php if($info['rekening'] ==''){ $rekening = $this->supplier_model->RekeningSupplier($this->bbm_model->SupplierBeli($info['id']));}else{ $rekening = $info['rekening'];} ?>
										<input name="rekening" type="text" value="<?php echo $rekening;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Alamat Depo</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<?php if($info['depo'] ==''){ $depo = $this->supplier_model->DepoSupplier($this->bbm_model->SupplierBeli($info['id']));}else{ $depo = $info['depo'];} ?>
										<input name="depo" type="text" value="<?php echo $depo;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Pengambilan</strong></label>
									</div>
									<div class="input-group">
											<span class="input-group-addon"> Tgl </span>
										<?php if($info['tglambil'] =='0000-00-00'){ $tglambil = $tgl;}else{ $tglambil = $info['tglambil'];} ?>
										<input type="text" name="tglambil" id="datepicker" value="<?php echo $tglambil ;?>" class="form-control" required/>
											<span class="input-group-addon"> Metode </span>
										<select name="termambil" class="form-control" required>
										<?php if(!$info['termambil'] ==''){ ?>
											<option value="<?php echo $info['termambil'];?>"><?php echo $info['termambil'];?></option>
										<?php } ?>		
											<option value="Kargo">1. Kargo</option>
											<option value="Retail">2. Retail</option>
										</select>
											<span class="input-group-addon"> Koordinator </span>
										<input name="koordinator" type="text" value="<?php echo $info['koordinator'];?>" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Keterangan Tambahan</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<textarea id="editor1" name="keterangan" type="text" class="form-control" /><?php echo $info['keterangan'];?></textarea>
									</div>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-warning btn-flat" type="button">SIMPAN</button>
									<a class="btn btn-primary btn-flat" href="<?php echo site_url('beli/edit/'.$info['id']);?>"> <i class="fa fa-edit"></i> EDIT HARGA</a>
								</div>
							</div>
						</div><!-- /.row -->
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!--/.col (right) -->
			</form>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

