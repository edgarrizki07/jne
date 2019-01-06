<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;?> | Stok : <?php $stok = $this->bbm_model->JmlInventory($this->session->userdata('SESS_WP_ID')) ; echo  number_format ($stok, 0, ',', '.');?> Liter
			  <?php if($this->bbm_model->JmlInventory($this->session->userdata('SESS_WP_ID')) =='0'){ ?>, <br><small class="text-red">Anda Tidak dapat melakukan penjualan, silahkan melakukan pembelian terlebih dahulu</small><?php }?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>";
	$this->session->unset_userdata('SUCCESSMSG');} ?>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<div class="btn-group">
							<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>jual/add"><i class="fa fa-plus"></i> Penjualan</a>
							<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>jual/add_invoice"><i class="fa fa-plus"></i> Invoice</a>
							<a class="btn btn-primary" disabled><i class="fa fa-filter"></i> Status :</a>
							<a class="btn btn-primary" href="<?php echo site_url();?>jual/wait"> <?php echo $this->bbm_model->JmlJualWaiting();?> Draft</a>
							<a class="btn btn-primary" href="<?php echo site_url();?>jual/prosses"> <?php echo $this->bbm_model->JmlJualProsses();?> Proses ACC</a>
							<a class="btn btn-primary" href="<?php echo site_url();?>jual/success"> <?php echo $this->bbm_model->JmlJualSuccess();?> Sudah ACC</a>
						<?php if($this->session->userdata('ADMIN') <='3'){ ?>
							<a class="btn btn-primary" href="<?php echo site_url();?>jual/pay"> <?php echo $this->bbm_model->JmlJualPay();?> Proses Bayar</a>
							<a class="btn btn-primary" href="<?php echo site_url();?>jual/paid"> <?php echo $this->bbm_model->JmlJualPaid();?> Sudah Bayar</a>
						<?php } ?>
							<a class="btn btn-danger" href="<?php echo site_url();?>jual/cancel"> <?php echo $this->bbm_model->JmlJualCancel();?> Cancel</a>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tgl/ID/Status</th>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>Cabang</th>
								<?php } ?>
									<th>Customer</th>
									<th>Detail</th>
								</tr>
							</thead>
							<tbody>
	<?php $no=0; foreach($info as $row ): $no++;?>
	<?php $qty=$row->jml; $jml=$row->jml*$row->harga; $d=$row->discount; $disc=$jml*$d/100; $disctotal=$jml-$disc; $ppn=$disctotal/10*($row->ppn); $pbbkb=$disctotal*($row->npbbkb/100)*($row->pbbkb); $pph=$disctotal*3/1000*($row->pph); $t=($row->ohp); $td=($t*$qty); $tt=($td)+($row->ppnohp*$td/10); $gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt); ?>
								<tr>
									<td><?php echo $no;?></td>
									<td>
										<div class="btn-group">
										  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
											<?php if($row->cek =='0'){ ?><?php if($row->status =='0'){ ?>Draft<?php } else if($row->status =='1'){ ?> Proses ACC<?php } else if($row->status =='2'){ ?> Sudah ACC<?php } else if($row->status =='3'){ ?> Proses Bayar<?php } else if($row->status =='4'){ ?> Sudah Bayar<?php } ?><?php } else { ?>Telah Di-Cancel<?php } ?>
											 | <span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu" role="menu">
											<div class="btn-group-vertical">
											<!-- DO -->
											<?php if($row->cek=='0'){ ?>
												<?php if($this->bbm_model->ItemDO($row->id)=='0'){ ?>
												<a title="Buat DO" href="<?php echo site_url('jual/add_do/'.$row->id);?>" class="btn btn-success btn-xs">
												<i class='fa fa-plus'></i> DO</a>
												<?php }else{ ?>
												<a title="Telah dibuat <?php echo $this->bbm_model->ItemDO($row->id);?> DO pada penjualan ini" href="<?php echo site_url('jual/delivery_order/'.$row->id);?>" class="btn btn-primary btn-xs" >
												<i class='fa fa-file'></i> <?php echo $this->bbm_model->ItemDO($row->id);?> DO</a>
												<?php } ?>
											<?php }else{ ?>
												<a title="lihat DO" href="<?php echo site_url('jual/delivery_order/'.$row->id);?>" class="btn btn-primary btn-xs" >
												<i class='fa fa-print'></i> DO</a>
											<?php } ?>
											
											<!-- Invoice -->
											<?php if($row->harga =='0'){ ?>
												<a title="Tambah Invoice" href="<?php echo site_url('jual/add_in/'.$row->id);?>" class="btn btn-success btn-xs" ><i class='fa fa-plus'></i> Tambah Invoice</a>
											<?php }else{ ?>
												<?php if($row->status =='0'){ ?>
													<?php if( $row->login_id==$this->session->userdata('SESS_USER_ID')){ ?>
														<?php if($row->cek =='0'){ ?>
														<a title="Edit PO" href="<?php echo site_url('jual/rounding/'.$row->id);?>" class="btn btn-success btn-xs" ><i class='fa fa-edit'></i> Edit Invoice </a>
														<?php }else{ ?>
														<a title="lihat PO" href="<?php echo site_url('jual/view/'.$row->id);?>" class="btn btn-primary btn-xs" ><i class='fa fa-file'></i> Lihat Draft Invoice </a>
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
												<a title="Download PO Masuk" href="<?php echo site_url('jual/download_po/'.$row->id);?>" class="btn btn-info btn-xs" ><i class='fa fa-print'></i> PO Masuk</a>
											<?php } ?>
											<br>

											<!-- Hapus -->
											<?php if($this->session->userdata('ADMIN')=='1'){ ?>
												<?php if($row->cek =='0'){ ?>
													<a title="cancel" href="<?php echo base_url();?>jual/hapus/<?php echo $row->id;?>" class="btn btn-danger btn-xs" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus</a>
												<?php } ?>
											<?php } ?>
											</div>
										  </ul>
										</div>
									<br><?php echo $this->jurnal_model->tgl_singkatan($row->tgl);?>
									<br><a title="nomor urut penjualan dari masing-masing cabang"><?php echo $row->id_jual;?></a></td>
								<?php if($this->session->userdata('ADMIN') =='1'){ ?>
									<td><a title="nomor urut semua penjualan dari semua cabang"><?php echo $row->id;?></a>
									<br><?php echo $this->pajak_model->KotaCabang($row->wp_id);?><br>create by : <?php echo $this->user_model->NamaUser($row->login_id);?><br>acc by : <?php if($row->admin_id =='0'){ ?><b class="text-red">Blm Acc</b><?php }else{ ?><?php echo $this->user_model->NamaUser($row->admin_id);?><?php } ?></td>
								<?php } ?>
									<td><b><?php echo $this->customer_model->NamaCustomer($row->customer_id);?></b></td>
									<td>Qty <b class="pull-right"><?php echo number_format ($qty, 0, ',', '.');?> Ltr</b>
									<br>Sub Total <a class="pull-right"><?php echo number_format ($disctotal, 0, ',', '.');?></a>
									<br>PPN <a title="PPN" class="pull-right"><?php echo number_format ($ppn, 0, ',', '.');?></a>
									<br>PPh <a title="PPh" class="pull-right"><?php echo number_format ($pph, 0, ',', '.');?></a>
									<br>PBBKb <a title="PBBKb" class="pull-right"><?php echo number_format ($pbbkb, 0, ',', '.');?></a>
									<br><?php if($row->ohp==''){ ?>Transport - <br>Total <a class="pull-right"><?php echo number_format ($gr_total, 0, ',', '.');?></a><?php }else{ ?>Transport <a class="pull-right"><?php echo number_format (($tt), 0, ',', '.');?></a><br>Total <b class="pull-right"><?php echo number_format ($row->tot9, 0, ',', '.');?><?php } ?></b></td>
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
