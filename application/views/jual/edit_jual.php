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
			<h4 class="text-center text-bold">INFORMASI TAMBAHAN INVOICE 	<?php if($info['cek'] !='0'){ ?>INI TELAH DIHAPUS oleh : <?php echo $this->user_model->NamaUser($info['login_id']); ?> <?php echo $this->user_model->NamaBUser($info['login_id']); ?><?php } ?></h4>
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
								<?php echo $info['terbilang'];?>
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
							<th>Rounding</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['rounding'], 2, '.', ',');?></td>
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
								<div class="hidden">
									<label><strong>ID <?php echo $title;?></strong></label>
									<input name="id" type="text" class="form-control" value="<?php echo $info['id_jual'];?>" required/>
										<span class="input-group-addon"> Rp </span>
									<?php $sum=$info['tot3']+$info['tot4']+$info['tot5']+$info['tot6']+$info['tot7']+$info['tot8'];?>
									<input name="tot9" type="text" class="form-control" value="<?php echo $sum;?>" />
								</div>
							<div class="form-group">
								<div class="col-xs-2">
									<label><strong>Customer</strong></label>
								</div>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-user"></i></div>
									<select name="customer_id" class="form-control" required>
									<option value="<?php echo $Customer;?>"><?php echo $this->customer_model->NamaCustomer($Customer);?> up. <?php echo $this->customer_model->CPCustomer($Customer);?></option>
								<?php $byr = $this->db->get_where('customer',array('wp_id'=>$this->session->userdata('SESS_WP_ID')));?>
								<?php $item = $byr->result(); ?>
								<?php $no=0; foreach($item as $row ): $no++;?>
									<option value="<?php echo $row->id;?>"><?php echo $row->id_customer;?> - <?php echo $row->nama;?> up. <?php echo $row->cp;?></option>
								<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-2">
									<label><strong>Product</strong></label>
								</div>
								<div class="input-group">
									<input type="text" class="form-control" value="High Speed Diesel (HSD) / Solar"/>
									<span class="input-group-addon"> Name </span>
									<input name="produk" id="produk" type="text" class="form-control" value="JN-ENERGY" required/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-2">
									<label><strong>No Purchase Order</strong></label>
								</div>
								<div class="input-group">
									<input name="nopo" type="text" class="form-control" value="<?php echo $info['nopo'];?>" placeholder="Nomor PO " required/>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input name="tglpo" id="datepicker" type="text" class="form-control" value="<?php echo $info['tglpo'];?>" placeholder="Tanggal PO " required/>
									<span class="input-group-addon"><i class="fa fa-upload"></i></span>
									<input name="filepo" type="file" class="form-control" />
								</div>
							</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Tambah Rounding</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> Rp </span>
									<input name="rounding" type="text" value="<?php echo $info['rounding'];?>" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Terbilang</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<input name="terbilang" type="text" value="<?php echo $info['terbilang'];?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Date</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><b> Invoice Date</b></span>
									<input type="text" name="tgl_invoice" id="datepicker-tgl"  value="<?php echo $info['tgl_invoice'];?>" class="form-control" required/>
										<span class="input-group-addon"><b> Due Date</b></span>
									<input type="text" name="tempo" id="datepicker-tempo"  value="<?php echo $info['tempo'];?>" class="form-control" required/>
										<span class="input-group-addon"><b> Delivery Date</b></span>
									<input type="text" name="tglkirim" id="datepicker"  value="<?php echo $info['tglkirim'];?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Sales</strong></label>
									</div>
									<div class="input-group">
									<input name="sales" value="<?php echo $info['sales'];?>" type="text" class="form-control" required/>
										<span class="input-group-addon"><b> Delivery Method</b></span>
									<input name="angkutan" id="angkutan" value="<?php echo $info['angkutan'];?>" type="text" class="form-control" required/>
										<span class="input-group-addon"><b> Payment Terms</b></span>
									<input name="term" id="term" value="<?php echo $info['term'];?>" type="text" class="form-control" required/>
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
										<input name="bank" type="text" value="<?php echo $info['bank'];?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-1"></div>
									<div class="col-xs-2"><i align="right">Nama Rekening</i></div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<input name="namarek" type="text" value="<?php echo $info['namarek'];?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-1"></div>
									<div class="col-xs-2"><i align="right">Nomor Rekening</i></div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<input name="rekening" type="text" value="<?php echo $info['rekening'];?>" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-3">
										<label><strong>Special Notes & Instruction</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<textarea id="editor1" name="keterangan" type="text" class="form-control" /><?php echo $info['keterangan'];?></textarea>
									</div>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
									<a class="btn btn-primary btn-flat" href="<?php echo site_url('jual/edit_in/'.$info['id']);?>"> <i class="fa fa-edit"></i> EDIT HARGA INCLUDE</a>
									<a class="btn btn-primary btn-flat" href="<?php echo site_url('jual/edit_out/'.$info['id']);?>"> <i class="fa fa-edit"></i> EDIT HARGA DASAR</a>
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

