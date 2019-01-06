<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;?> | Stok : <?php $stok = $this->bbm_model->JmlInventory($this->session->userdata('SESS_WP_ID')) ; echo  number_format ($stok, 0, ',', '.');?> Liter
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
							<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>beli/add"><i class="fa fa-plus"></i> Pembelian</a>
							<a class="btn btn-primary" disabled><i class="fa fa-filter"></i> Status :</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>beli/wait"> <?php echo $this->bbm_model->JmlBeliWaiting();?> Draft</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>beli/prosses"> <?php echo $this->bbm_model->JmlBeliProsses();?> Proses ACC</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>beli/success"> <?php echo $this->bbm_model->JmlBeliSuccess();?> Sudah ACC</a>
						<?php if($this->session->userdata('ADMIN') <='3'){ ?>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>beli/pay"> <?php echo $this->bbm_model->JmlBeliPay();?> Proses Bayar</a>
							<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>beli/paid"> <?php echo $this->bbm_model->JmlBeliPaid();?> Sudah Bayar</a>
						<?php } ?>
							<a target="_blank" class="btn btn-danger" href="<?php echo site_url();?>beli/cancel"> <?php echo $this->bbm_model->JmlBeliCancel();?> Cancel</a>
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
									<th>Supplier</th>
									<th>Detail</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=0; foreach($info as $row ): $no++;?>
							<?php $qty=$row->jml; $jml=$row->jml*$row->harga; $d=$row->discount; $disc=$jml*$d/100; $disctotal=$jml-$disc; 
							$ppn=$disctotal/10*($row->ppn); $pbbkb=$disctotal*($row->npbbkb/100)*($row->pbbkb); $pph=$disctotal*3/1000*($row->pph); $t=($row->ohp); $td=($t*$qty); $tt=($td)+($row->ppnohp*$td/10); $gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt); ?>
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
												<?php if($row->status =='0'){ ?>
													<?php if( $row->login_id==$this->session->userdata('SESS_USER_ID')){ ?>
														<?php if($row->cek =='0'){ ?>
															<a title="Edit PO" href="<?php echo site_url('beli/rounding/'.$row->id);?>" class="btn btn-success btn-xs" ><i class='fa fa-file'></i> Edit PO </a>
														<?php }else{ ?>
															<a title="lihat PO" href="<?php echo site_url('beli/view/'.$row->id);?>" class="btn btn-primary btn-xs" ><i class='fa fa-file'></i> Lihat Draft PO </a>
														<?php } ?>
													<?php }else{ ?>
														<a title="lihat PO" href="<?php echo site_url('beli/view/'.$row->id);?>" class="btn btn-primary btn-xs" ><i class='fa fa-file'></i> Lihat Draft PO </a>
													<?php } ?>
												<?php }else{ ?>
													<a title="lihat PO" href="<?php echo site_url('beli/view/'.$row->id);?>" class="btn btn-primary btn-xs" ><i class='fa fa-file'></i> Lihat PO </a>
												<?php } ?>
												<br>
												<?php if($this->session->userdata('ADMIN')=='1'){ ?>
													<?php if($row->cek =='0'){ ?>
														<a title="cancel" href="<?php echo base_url();?>jual/hapus/<?php echo $row->id;?>" class="btn btn-danger btn-xs" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus</a>
													<?php } ?>
												<?php } ?>
											</div>
										  </ul>
										</div>
									<br><?php echo $this->jurnal_model->tgl_singkatan($row->tgl);?> /
									<br><a title="nomor urut pembelian dari masing-masing cabang"><?php echo $row->id_beli;?></a> /
									</td>
								<?php if($this->session->userdata('ADMIN') =='1'){ ?>
									<td><a title="nomor urut semua pembelian dari semua cabang"><?php echo $row->id;?></a>
									<br><?php echo $this->pajak_model->KotaCabang($row->wp_id);?><br>create by : <?php echo $this->user_model->NamaUser($row->login_id);?><br>acc by : <?php if($row->admin_id =='0'){ ?>Blm Acc<?php }else{ ?><?php echo $this->user_model->NamaUser($row->admin_id);?><?php } ?></td>
								<?php } ?>
									<td><b><?php echo $this->supplier_model->NamaSupplier($row->supplier_id);?></b><br><?php echo $this->supplier_model->CPSupplier($row->supplier_id);?></td>
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