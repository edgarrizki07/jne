<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;?>
		</h1>
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
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<div class="btn-group">
							<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>jual/tambah"><i class="fa fa-plus"></i> Tambah Penjualan</a>
							<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>jual/add_invoice"><i class="fa fa-plus"></i> Tambah Invoice</a>
							<a class="btn btn-primary" disabled><i class="fa fa-filter"></i> Pilih Status :</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>jual/wait"> <?php echo $this->bbm_model->JmlJualWaiting();?> Draft</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>jual/prosses"> <?php echo $this->bbm_model->JmlJualProsses();?> Proses ACC</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>jual/success"> <?php echo $this->bbm_model->JmlJualSuccess();?> Sudah ACC</a>
						<?php if($this->session->userdata('ADMIN') <='3'){ ?>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>jual/pay"> <?php echo $this->bbm_model->JmlJualPay();?> Proses Bayar</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>jual/paid"> <?php echo $this->bbm_model->JmlJualPaid();?> Sudah Bayar</a>
						<?php } ?>
							<a target="_blank" class="btn btn-danger" href="<?php echo site_url();?>jual/cancel"><i class="fa fa-chevron-right"></i> Cancel</a>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tgl/ID</th>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>ID ALL</th>
									<th>Cabang</th>
								<?php } ?>
									<th>Customer</th>
									<th>Volume</th>
									<th>Delivered / Sisa</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
	<?php $no=0; foreach($info as $row ): $no++;?>
	<?php $item = '1'; $qty=$row->jml; $jml=$row->jml*$row->harga; $d=$row->discount; $disc=$jml*$d/100; $disctotal=$jml-$disc; $ppn=$disctotal/10*($row->ppn);
	$pbbkb=$disctotal*($row->npbbkb/100)*($row->pbbkb); $pph=$disctotal*3/1000*($row->pph); $t=($row->ohp); $td=($t*$qty); $tt=($td)+($row->ppnohp*$td/10); $gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt); ?>
								<tr>
									<td><?php echo $no;?></td>
									<td ><?php echo $this->jurnal_model->tgl_str($row->tgl);?></br><a title="nomor urut penjualan dari masing-masing cabang"><?php echo $row->id_jual;?></a></td>
								<?php if($this->session->userdata('ADMIN') =='1'){ ?>
									<td><a title="nomor urut semua penjualan dari semua cabang"><?php echo $row->id;?></a></td>
									<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></br>create by : <?php echo $this->user_model->NamaUser($row->login_id);?><br>acc by : <?php if($row->admin_id =='0'){ ?><p class="text-red">Blm Acc<p><?php }else{ ?><?php echo $this->user_model->NamaUser($row->admin_id);?><?php } ?></td>
								<?php } ?>
									<td><b><?php echo $this->customer_model->NamaCustomer($row->customer_id);?></b></td>
									<td><b class="pull-right"><?php echo number_format ($qty, 0, ',', '.');?> L</b></td>
									<td><?php $sell = $this->bbm_model->JmlJual($row->id) ; ?><?php $delivered = $this->bbm_model->DeliveredDO($row->id) ; echo number_format ($delivered, 0, ',', '.');?> L / <?php $sisa = $sell-$delivered ; ?><p class="text-red"><?php echo  number_format ($sisa, 0, ',', '.');?> L<p></td>
									<td><?php if($row->status =='2'){ ?>Success<?php } else if($row->status =='0'){ ?>Waiting<?php } else if($row->status =='1'){ ?>On Prosses<?php } else if($row->status =='3'){ ?>Pay Prosses<?php } else if($row->status =='4'){ ?>Paid<?php } ?></td>
									<td align="center">
										<div class="btn-group-vertical">
										<!-- Invoice -->
									<?php if($row->harga =='0'){ ?>
											<a title="Tambah Invoice" href="<?php echo site_url('jual/add_in/'.$row->id);?>" class="btn btn-success btn-xs" ><i class='fa fa-plus'></i> Tambah Invoice</a>
									<?php }else{ ?>
										<?php if($row->status =='0'){ ?>
											<?php if( $row->login_id==$this->session->userdata('SESS_USER_ID')){ ?>
												<?php if($row->cek =='0'){ ?>
												<a title="Edit PO" href="<?php echo site_url('jual/rounding/'.$row->id);?>" class="btn btn-success btn-xs" >
												<i class='fa fa-edit'></i> Edit Invoice </a>
												<?php }else{ ?>
												<a title="lihat PO" href="<?php echo site_url('jual/view/'.$row->id);?>" class="btn btn-primary btn-xs" >
												<i class='fa fa-file'></i> Lihat Draft Invoice </a>
												<?php } ?>
											<?php }else{ ?>
											<a title="lihat Invoice" href="<?php echo site_url('jual/view/'.$row->id);?>" class="btn btn-primary btn-xs"><i class='fa fa-print'></i> Lihat Draft Invoice</a>
											<?php } ?>
										<?php }else{ ?>
											<a title="lihat Invoice" href="<?php echo site_url('jual/view/'.$row->id);?>" class="btn btn-primary btn-xs"><i class='fa fa-print'></i> Lihat Invoice</a>
										<?php } ?>
									<?php } ?>
									
										<!-- PO Masuk -->
										<?php if($row->filepo==''){ ?><?php }else{ ?>
											<a title="Download PO Masuk" href="<?php echo site_url('jual/download_po/'.$row->id);?>" class="btn btn-info btn-xs" >
											<i class='fa fa-print'></i> PO Masuk</a>
										<?php } ?>
										</div><br><br>
									</td>
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
