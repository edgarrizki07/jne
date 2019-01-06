<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
	<?php if($info['cek'] =='0'){ ?>
			<a target="_blank" href="<?php echo site_url('tawaran/pdf/'.$info['id']);?>" class="btn btn-success" ><i class='fa fa-print'></i> Print</a>
			<a href="<?php echo site_url('tawaran');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
	<?php }else{ ?>
			<a href="<?php echo site_url('tawaran/cancel');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
	<?php } ?>
			<h4 class="text-center text-bold">SURAT PENAWARAN 	<?php if($info['cek'] !='0'){ ?>INI TELAH DIHAPUS oleh : <?php echo $this->user_model->NamaUser($info['login_id']); ?> <?php echo $this->user_model->NamaBUser($info['login_id']); ?><?php } ?></h4>
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
<?php $this->load->view('kop'); ?>
		<div class="row invoice-info">
			<div class="col-sm-6">
				<strong>Kepada :</strong><br>
				<strong>Up. <?php echo $this->customer_model->CPCustomer($info['customer_id']);?></strong><br>
				<?php echo $this->customer_model->NamaCustomer($info['customer_id']);?><br>
				<?php echo $this->customer_model->AlamatCustomer($info['customer_id']);?><br>
				<table width='80%'>
				<tr>
					<td>Phone : <?php echo $this->customer_model->TelpCustomer($info['customer_id']);?></td>
				</tr>
				</table>
				Email : <?php echo $this->customer_model->EmailCustomer($info['customer_id']);?></br></br>
			</div><!-- /.col -->
			<div class="col-sm-6">
				</br>
				<p>
				No : <?php echo $info['id_tawaran'];?>.<?php echo $this->jurnal_model->ambilTgl($info['tgl']);?>/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/HSD/<?php echo $this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tgl']));?>/<?php echo $this->jurnal_model->ambilThn($info['tgl']);?></br>
				Tanggal : <?php echo $this->app_model->tgl_indo($info['tgl']);?></br>
				Perihal : <strong><?php echo $info['perihal'];?></strong><br>
				Lampiran : <strong><?php echo $info['lampiran'];?></strong><br>
				</p>
			</div><!-- /.col -->
		</div><!-- /.row -->
	<br>
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 ">
				<p>
				Dengan hormat,<br>Kami <strong><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?></strong> pemegang Izin Niaga Umum BBM No. 05.NW.03.18.00.123 dengan ini mengajukan penawaran harga untuk periode saat ini dengan rincian sebagai berikut :<br>
				</p>
				<table class="table">
					<tbody>
						<tr>
							<td>1. </td>
							<td><b>Harga</b>
							<table class="table">
								<thead>
									<tr class="text-bold">
										<td align="center"><b>Jenis BBM</b></td>
										<td align="center"><b>Rincian Harga</b></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center"><?php echo $info['produk'];?></td>
										<td>
										<table class="table">
											<tr>
												<td>
													<table class="table">
														<td>Harga Dasar</td>
													</table>
											<?php if($info['ppn'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>PPn</td>
														<td align="right">10 %</td>
													</table>
											<?php } ?>
											<?php if($info['pph'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>PPh</td>
														<td align="right">0.3 %</td>
													</table>
											<?php } ?>
											<?php if($info['pbbkb'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>Pbbkb</td>
														<td align="right"><?php echo $info['npbbkb'];?> %</td>
													</table>
											<?php } ?>
													<table class="table">
														<th>Harga BBM</th>
													</table>
											<?php if($info['oat'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>Transport (OAT)</td>
													</table>
											<?php } ?>
													<table class="table">
														<th>Total Harga</th>
													</table>
												</td>
												<td>
													<table class="table">
														<td>Rp</td>
														<td align="right"><?php echo number_format($info['harga'], 2, ',', '.');?></td>
													</table>
											<?php if($info['ppn'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>Rp</td>
														<td align="right"><?php echo number_format(($info['ppn']*(10/100))*$info['harga'], 2, ',', '.');?></td>
													</table>
											<?php } ?>
											<?php if($info['pph'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>Rp</td>
														<td align="right"><?php echo number_format(($info['pph']*(3/1000))*$info['harga'], 2, ',', '.');?></td>
													</table>
											<?php } ?>
											<?php if($info['pbbkb'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>Rp</td>
														<td align="right"><?php echo number_format(($info['pbbkb']*($info['npbbkb']/100))*$info['harga'], 2, ',', '.');?></td>
													</table>
											<?php } ?>
													<table class="table">
														<th>Rp</th>
														<td align="right"><b><?php echo number_format($info['include']-$info['oat'], 2, ',', '.');?></b></td>
													</table>
											<?php if($info['oat'] =='0'){ ?><?php }else{ ?>
													<table class="table">
														<td>Rp</td>
														<td align="right"><?php echo number_format($info['oat'], 2, ',', '.');?></td>
													</table>
											<?php } ?>
													<table class="table">
														<th>Rp</th>
														<td align="right"><b><?php echo number_format($info['include'], 2, ',', '.');?></b></td>
													</table>
												</td>
											</tr>
										</table>
										</td>
									</tr>
								</tbody>
							</table>
							</td>
						</tr>
						<tr>
							<td>2. </td>
							<td><b><?php echo $info['isi2'];?></b></td>
						</tr>
						<tr>
							<td>3. </td>
							<td><b><?php echo $info['isi3'];?></b></td>
						</tr>
						<tr>
							<td>4. </td>
							<td><b><?php echo $info['isi4'];?></b></td>
						</tr>
						<tr>
							<td>5. </td>
							<td><b><?php echo $info['isi5'];?></b></td>
						</tr>
						<tr>
							<td>6. </td>
							<td><b>Pembayaran  <?php echo $info['pembayaran'];?></b>, dan ditransfer melalui rekening :</td>
						</tr>
						<tr>
							<td></td>
							<td><b>Bank : <?php echo $info['bank'];?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b>Nama : <?php echo $info['namarek'];?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b>No. Rek : <?php echo $info['rekening'];?></b></td>
						</tr>
						<tr>
							<td>7. </td>
							<td><b><?php echo $info['isi6'];?></b></td>
						</tr>
						<tr>
							<td>8. </td>
							<td><b><?php echo $info['isi7'];?></b></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-12">
				<p>
				Demikian surat penawaran harga yang dapat kami sampaikan, besar harapan kami dapat memenuhi kebutuhan BBM perusahaan Bapak/Ibu. Atas perhatian dan kerjasamanya kami ucapkan terima kasih. <br>
				</p>
				<table class="table table-striped">
					<thead>
						<tr>
							<td>Hormat kami,</td>
						</tr>
						<tr>
							<td><b><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?></b></td>
						</tr>
					</thead>
				</table>
				<br><br><br>
				<table class="table table-striped">
					<thead>
						<tr>
							<td><b><u><?php echo $this->pajak_model->PemasaranCabang($info['wp_id']);?></u></b></td>
						</tr>
						<tr>
							<td><b>Direktur Marketing</b></td>
						</tr>
					</thead>
				</table>
				<br>
				<p class="lead">Tembusan:</p>
				<b><?php echo $info['tembusan'];?></b>
				<b><?php echo $info['tembusan1'];?></b>
				<b><?php echo $info['tembusan2'];?></b>
				</br>________________________________________________</br>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</section><!-- /.content -->
	<div class="clearfix"></div>
</div><!-- /.content-wrapper -->
