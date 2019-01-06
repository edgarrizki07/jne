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
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
	$this->session->unset_userdata('SUCCESSMSG'); } ?>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<div class="btn-group">
							<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>tawaran/add_po"><i class="fa fa-plus"></i> Tambah PO Masuk</a>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>ID / Tgl</th>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>Cabang</th>
								<?php } ?>
									<th>Customer / Term</th>
									<th>Detail</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=0; foreach($info as $row ): $no++;?>
								<tr>
									<td><?php echo $no;?></td>
									<td>
										<div class="btn-group">
										  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
											<?php if($row->cek =='0'){ ?><?php if($row->status =='0'){ ?>Baru Input<?php } else if($row->status =='1'){ ?> Proses ACC<?php } else if($row->status =='2'){ ?> Sudah ACC<?php } else if($row->status =='3'){ ?> Proses Penjualan<?php } ?><?php } else { ?>Telah Di-Cancel<?php } ?>
											 | <span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu" role="menu">
											<div class="btn-group-vertical">
											<?php if($this->session->userdata('ADMIN')=='6'){ ?>
												<a title="lihat Penawaran" href="<?php echo site_url('tawaran/view_po/'.$row->id);?>" class="btn btn-success btn-xs" >
												<i class='fa fa-eye'></i> Lihat PO </a>
											<?php } ?>
											<?php if($this->session->userdata('ADMIN')<='2'){ ?>
												<a title="lihat PO" href="<?php echo site_url('tawaran/view_po/'.$row->id);?>" class="btn btn-success btn-xs" >
												<i class='fa fa-eye'></i> Lihat PO </a>
												<?php if($row->status <'2'){  if($row->cek =='0'){ ?>
													<a title="Batal" href="<?php echo base_url();?>index.php/tawaran/hapus_po/<?php echo $row->id;?>" class="btn btn-danger btn-xs" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus </a>
												<?php } } ?>
											<?php } ?>
											</div>
										  </ul>
										</div>
									<br><?php echo $row->id_po;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?>
									<br><?php echo $this->app_model->tgl_str($row->tgl);?></td>
								<?php if($this->session->userdata('ADMIN') =='1'){ ?>
									<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?>, <br>create by <?php echo $this->user_model->NamaUser($row->login_id);?><br><?php echo $row->id;?></td>
								<?php } ?>
									<td><b><?php echo $this->customer_model->NamaCustomer($row->customer_id);?></b></br><?php echo $this->customer_model->CPCustomer($row->customer_id);?>
									<br><?php echo $row->term;?></td>
									<td>Volume<b class="pull-right"><?php echo number_format ($row->jml, 0, ',', '.');?></b>
									<br>Harga Dasar <b class="pull-right"><?php echo number_format ($row->harga, 0, ',', '.');?></b>
									<br>Total<b class="pull-right"><?php echo number_format ($row->tot9, 0, ',', '.');?></b></td>
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