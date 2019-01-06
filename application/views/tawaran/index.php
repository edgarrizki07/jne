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
							<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>tawaran/add"><i class="fa fa-plus"></i> Tambah Penawaran</a>
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
									<th>Customer</th>
									<th>Harga</th>
									<th>Pajak</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=0; foreach($info as $row ): $no++;?>
							<?php 
							$item = '1'; 
							$jml=$row->harga; 
							$disctotal=$jml; 
							$ppn=$disctotal/10*($row->ppn);
							$pbbkb=$disctotal*($row->npbbkb/100)*($row->pbbkb); 
							$pph=$disctotal*3/1000*($row->pph); 
							$gr_total=$disctotal+$ppn+$pbbkb+$pph; 
							?>
								<tr>
									<td><?php echo $no;?></td>
									<td>
										<div class="btn-group-vertical">
											<a title="lihat Penawaran" href="<?php echo site_url('tawaran/view/'.$row->id);?>" class="btn btn-primary btn-xs" >
											<i class='fa fa-eye'></i> Lihat Penawaran </a>
										</div>
									<br><?php echo $row->id_tawaran;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?>
									<br><?php echo $this->app_model->tgl_str($row->tgl);?>
										<?php if($this->session->userdata('ADMIN')<='2'){ ?>
											<?php if($row->status <'2'){  if($row->cek =='0'){ ?>
												<br>
												<div class="btn-group">
													<a title="Batal" href="<?php echo base_url();?>index.php/tawaran/hapus/<?php echo $row->id;?>" class="btn btn-danger btn-xs" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus </a>
												</div>
											<?php } } ?>
										<?php } ?>
									</td>
								<?php if($this->session->userdata('ADMIN') =='1'){ ?>
									<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?>,<br> create by <?php echo $this->user_model->NamaUser($row->login_id);?><br><?php echo $row->id;?></td>
								<?php } ?>
									<td><b><?php echo $this->customer_model->NamaCustomer($row->customer_id);?></b></br><?php echo $this->customer_model->CPCustomer($row->customer_id);?></td>
									<td>Dasar<b class="pull-right"><?php echo number_format ($row->harga, 0, ',', '.');?></b>
									<br>Include<b class="pull-right"><?php echo number_format ($row->include, 0, ',', '.');?></b></td>
									<td>PPN<a class="pull-right"><?php echo number_format ($ppn, 0, ',', '.');?></a>
									<br>PPH<a class="pull-right"><?php echo number_format ($pph, 0, ',', '.');?></a>
									<br>PBBKB<a class="pull-right"><?php echo number_format ($pbbkb, 0, ',', '.');?></a></td>
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