<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
	<?php if($info['cek'] =='0'){ ?>
			<a href="<?php echo site_url('jual/list_po');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
		<?php if($info['status'] =='2'){ ?>
			<a title="Buat Penjualan" href="<?php echo site_url('jual/add_frompo/'.$info['id']);?>" class="btn btn-primary" ><i class='fa fa-plus'></i> Buat Penjualan dari PO ini </a>
		<?php } ?>
	<?php }else{ ?>
			<a href="<?php echo site_url('jual/cancel');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
	<?php } ?>
			<h4 class="text-center text-bold">PO MASUK NO <?php echo $info['id_po'];?> <?php if($info['cek'] !='0'){ ?>INI TELAH DIHAPUS oleh : <?php echo $this->user_model->NamaUser($info['login_id']); ?> <?php echo $this->user_model->NamaBUser($info['login_id']); ?><?php } ?></h4>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
	$this->session->unset_userdata('SUCCESSMSG'); } ?>
	<!-- Main content -->
	<section class="content invoice">
		<!-- info row -->
		<div class="row">
			<div class="col-xs-6">
				<table class="table table-bordered">
				<tr>
					<td><strong>Order From :</strong></td>
				</tr>
				<tr>
					<td>
				<?php $Customer = $info['customer_id'];?><strong><?php echo $this->customer_model->NamaCustomer($Customer);?></strong><br>
				<?php $npwp=$this->customer_model->NPWPCustomer($Customer);?>
				<strong>NPWP :  <?php echo substr($npwp,0,2);?>.<?php echo substr($npwp,2,3);?>.<?php echo substr($npwp,5,3);?>.<?php echo substr($npwp,8,1);?>-<?php echo substr($npwp,9,3);?>.<?php echo substr($npwp,12,3);?></strong><br>
				<strong>Alamat :</strong><br>
				<?php echo $this->customer_model->AlamatCustomer($Customer);?><br>
				Phone : <?php echo $this->customer_model->TelpCustomer($Customer);?> 
				Fax : <?php echo $this->customer_model->FaxCustomer($Customer);?> 
				Email : <?php echo $this->customer_model->EmailCustomer($Customer);?>
					</td>
				</tr>
				</table>
			</div><!-- /.col -->
			<div class="col-xs-6">
				<table class="table" width='100%'>
				<h5 class="text-center text-bold">Detail</h5>
				<tr>
					<td>Date</br>No PO</br>Tgl PO</br>Customer ID</td>
					<td> : </br> : </br> : </br> : </td>
					<td><?php echo $this->jurnal_model->tgl_singkatan($info['tgl']);?></br><?php echo $info['nopo'];?></br><?php echo $this->jurnal_model->tgl_singkatan($info['tglpo']);?></br>C-<?php echo $info['customer_id'];?>/<?php echo $this->customer_model->KodeCustomer($info['customer_id']);?></td>
				</tr>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<!-- Table row -->
		<div class="row invoice-info">
			<div class="col-xs-8 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td>Sales Person</td>
							<td>Payment Terms</td>
							<td>Due Date</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $this->user_model->NamaUser($info['login_id']);?></td>
							<td><?php echo $info['term'];?></td>
							<td><?php echo $this->jurnal_model->tgl_singkatan($info['tempo']);?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
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
							<p class="lead">Terbilang :</p>
								<?php echo $info['terbilang'];?>
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
							<th>Tax PBBKB <?php echo $info['npbbkb'];?>%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot5'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PPh 0,3%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot6'], 2, '.', ',');?></td>
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
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 ">
				<div class="box-body">
					<!-- button -->
					<div class="form-group has-success">
						<div class="box-body text-center">
							<?php if($info['filepo']==''){ ?>
							<img width="400px" src="<?php echo base_url();?>images/logo.png"/>
							<?php }else{ ?>
							Nama File : <?php echo $info['filepo'];?><br/><br/>
							<img width="400px" src="<?php echo base_url('/files/so/'.$info['filepo']);?>"/>
							<?php } ?>
						</div><!-- /.box-body -->
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
	<div class="clearfix"></div>
</div><!-- /.content-wrapper -->
