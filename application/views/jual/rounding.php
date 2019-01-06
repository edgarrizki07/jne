<script type="text/javascript">
$(document).ready(function(){

	$("#term").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#angkutan").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
		
});	
</script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Bill To : <?php $Customer = $info['customer_id'];?><b><?php echo $this->customer_model->NamaCustomer($Customer);?></b>
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
	<section class="content invoice">
		<div class="row invoice-info">
			<div class="col-xs-12 table-responsive">
			<h4 class="text-center text-bold">HARGA JUAL</h4>
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td>Description</td>
							<td>Qty</td>
							<td>Unit</td>
							<td>Unit Price</td>
							<td align="right">Amount</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>High Speed Diesel (HSD) / Solar JN-ENERGI</td>
							<td><?php echo number_format($info['jml']);?></td>
							<td>Liter</td>
							<td><?php echo number_format(($info['tot9']-$info['rounding']-$info['tot8']-$info['tot7'])/$info['jml'], 2, '.', ',');?></td>
							<td align="right"><?php echo number_format((($info['tot9']-$info['rounding']-$info['tot8']-$info['tot7'])), 2, '.', ',');?></td>
						</tr>
        			<?php if($info['tot8']!='0'){ ?>
						<tr>
							<td>Transport <?php if($info['tot9']!='0'){ ?>+ PPn 10%<?php } ?></td>
							<td><?php echo number_format($info['jml']);?></td>
							<td>Liter</td>
							<td><?php echo number_format(($info['tot8']+$info['tot7'])/$info['jml'], 2, '.', ',');?></td>
							<td align="right"><?php echo number_format((($info['tot8']+$info['tot7'])), 2, '.', ',');?></td>
						</tr>
        			<?php } ?>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row invoice-info">
			<!-- accepted payments column -->
			<div class="col-xs-7">
				<table class="table table-striped">
					<thead>
						<tr>
							<td>
							<p class="lead">Terbilang:</p>
								<?php echo $info['terbilang'];?><br>
								________________________________________________</br>
							</td>
						</tr>
					</thead>
				</table>
			</div><!-- /.col -->
	<?php $item = '1'; $jml=$info['harga']*$info['jml']; $d=$info['discount']; $disc=$jml*$d/100; $disctotal=$jml-$disc; $ppn=$disctotal/10*($info['ppn']);
	$pbbkb=$disctotal*($info['npbbkb']/100)*($info['pbbkb']); $pph=$disctotal*3/1000*($info['pph']); $t=($info['ohp']); $td=$t*$info['jml']; $tt=($td)+($info['ppnohp']*$td/10); $gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt); ?>
			<div class="col-xs-5">
				<div class="table">
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
							<th>Feul Distribution/OAT,etc</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot7'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax FD/OAT,etc 10%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot8'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Total</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot9'], 2, '.', ',');?></td>
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
									<input name="id" type="text" class="form-control" value="<?php echo $info['id_jual'];?>" required/>
										<span class="input-group-addon"> Rp </span>
									<?php $sum=$info['tot3']+$info['tot4']+$info['tot5']+$info['tot6']+$info['tot7']+$info['tot8'];?>
									<input name="tot9" type="text" class="form-control" value="<?php echo $sum;?>" />
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Tambah Rounding</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> Rp </span>
									<input name="rounding" type="text" value="<?php echo $info['rounding'] ;?>" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Terbilang</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<input name="terbilang" type="text" value="<?php echo $info['terbilang'] ;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Status Penjualan</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<select name="import" class="form-control" required>
										<?php if($info['export'] =='0'){ $export = 'Dalam Negeri';}else{ $export = 'Export Luar Negeri';} ?>
											<option value="<?php echo $info['export'];?>"><?php echo $export;?></option>
											<option value="0">1. Dalam Negeri</option>
											<option value="1">2. Export Luar Negeri</option>
										</select>
										<span class="input-group-addon"><b> Sektor </b></span>
										<select name="sektor" class="form-control" required>
										<?php if($info['sektor'] =='0'){ $sektor = 'Industri';}elseif($info['sektor'] =='1'){ $sektor = 'Transportasi Laut';}elseif($info['sektor'] =='2'){ $sektor = 'Transportasi Darat';}elseif($info['sektor'] =='3'){ $sektor = 'Transportasi Udara';} ?>
											<option value="<?php echo $info['sektor'];?>"><?php echo $sektor;?></option>
											<option value="0">1. Industri</option>
											<option value="1">2. Transportasi Laut</option>
											<option value="2">3. Transportasi Darat</option>
											<option value="3">4. Transportasi Udara</option>
											<option value="3">5. Rumah Tangga</option>
											<option value="3">6. Listrik</option>
											<option value="3">7. Own Use / Loses</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Date</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><b> Invoice Date</b></span>
										<?php if($info['tgl_invoice'] ==''){ $tgl_invoice = $tgl;}else{ $tgl_invoice = $info['tgl_invoice'];} ?>
									<input type="text" name="tgl_invoice" id="datepicker-tgl" value="<?php echo $tgl_invoice ;?>" class="form-control" required/>
										<span class="input-group-addon"><b> Due Date</b></span>
										<?php if($info['tempo'] ==''){ $tempo = $tgl;}else{ $tempo = $info['tempo'];} ?>
									<input type="text" name="tempo" id="datepicker-tempo" value="<?php echo $tempo ;?>" class="form-control" required/>
										<span class="input-group-addon"><b> Delivery Date</b></span>
										<?php if($info['tglkirim'] ==''){ $tglkirim = $tgl;}else{ $tglkirim = $info['tglkirim'];} ?>
									<input type="text" name="tglkirim" id="datepicker" value="<?php echo $tglkirim ;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Sales</strong></label>
									</div>
									<div class="input-group">
										<input name="sales" value="<?php echo $info['sales'] ;?>" type="text" class="form-control" required/>
										<span class="input-group-addon"><b> Delivery Method</b></span>
										<?php if($info['angkutan'] ==''){ $angkutan = 'TRUCK TANK';}else{ $angkutan = $info['angkutan'];} ?>
										<input name="angkutan" id="angkutan" value="<?php echo $angkutan ;?>" type="text" class="form-control" required/>
										<span class="input-group-addon"><b> Payment Terms</b></span>
										<?php if($info['term'] ==''){ $term = 'COD';}else{ $term = $info['term'];} ?>
										<input name="term" id="term" value="<?php echo $term ;?>" type="text" class="form-control" required/>
										<span class="input-group-addon"><b>Carrier</b> </span>
										<select name="carrier" class="form-control" required>
										<?php if($info['carrier'] ==''){ $carrier = 'LOCO';}else{ $carrier = $info['carrier'];} ?>
											<option value="<?php echo $carrier ;?>"><?php echo $carrier ;?></option>
											<option value="LOCO">LOCO</option>
											<option value="FRANKO">FRANKO</option>
										</select>
									</div>
								</div>
						  <h2 class="page-header"></h2>
								<div class="form-group">
									<div class="col-xs-1">
										<label><strong>Pembayaran</strong></label>
									</div>
									<div class="col-xs-2"><i align="right">Nama Bank</i></div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<?php if($info['bank'] ==''){ $bank = $this->pajak_model->BankCabang($this->session->userdata('SESS_WP_ID'));}else{ $bank = $info['bank'];} ?>
										<input name="bank" type="text" value="<?php echo $bank;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-1"></div>
									<div class="col-xs-2"><i align="right">Nama Rekening</i></div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<?php if($info['namarek'] ==''){ $namarek = $this->pajak_model->NamaRekeningCabang($this->session->userdata('SESS_WP_ID'));}else{ $namarek = $info['namarek'];} ?>
										<input name="namarek" type="text" value="<?php echo $namarek;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-1"></div>
									<div class="col-xs-2"><i align="right">Nomor Rekening</i></div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<?php if($info['rekening'] ==''){ $rekening = $this->pajak_model->RekeningCabang($this->session->userdata('SESS_WP_ID'));}else{ $rekening = $info['rekening'];} ?>
										<input name="rekening" type="text" value="<?php echo $rekening;?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-3">
										<label><strong>Special Notes & Instruction</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<?php if($info['keterangan'] ==''){ $keterangan = 'Payment receipt is valid when payment has been done and customer should attach the transfer receipt. The goods which is not paid off, the status will be consignment.';}else{ $keterangan = $info['keterangan'];} ?>
										<textarea id="editor1" name="keterangan" type="text" class="form-control" /><?php echo $keterangan;?></textarea>
									</div>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
									<a class="btn btn-primary btn-flat" href="<?php echo site_url('jual/edit_in/'.$info['id']);?>"> <i class="fa fa-edit"></i> EDIT HARGA</a>
								</div>
							</div>
						</div><!-- /.row -->
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!--/.col (right) -->
			</form>
		</div>
	</section><!-- /.content -->
	<!-- Main content -->
        <div class="clearfix"></div>
</div><!-- /.content-wrapper -->

