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
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tgl</th>
									<th>ID</th>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>Cabang</th>
								<?php } ?>
									<th>Customer</th>
									<th>Volume</th>
									<th>Harga Dasar</th>
									<th>Total</th>
									<th>Term</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $no=0; foreach($info as $row ): $no++;?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo $this->app_model->tgl_str($row->tgl);?></td>
									<td><?php echo $row->id_po;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?>/<?php echo $row->id;?></td>
								<?php if($this->session->userdata('ADMIN') =='1'){ ?>
									<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?>, create by <?php echo $this->user_model->NamaUser($row->login_id);?></td>
								<?php } ?>
									<td><b><?php echo $this->customer_model->NamaCustomer($row->customer_id);?></b></br><?php echo $this->customer_model->CPCustomer($row->customer_id);?></td>
									<td><b class="pull-right"><?php echo number_format ($row->jml, 0, ',', '.');?></b></td>
									<td><b class="pull-right"><?php echo number_format ($row->harga, 0, ',', '.');?></b></td>
									<td><b class="pull-right"><?php echo number_format ($row->tot9, 0, ',', '.');?></b></td>
									<td><?php echo $row->term;?></td>
									<td align="center" width="70">
										<div class="btn-group-vertical">
											<a title="lihat PO" href="<?php echo site_url('so/view_po/'.$row->id);?>" class="btn btn-primary btn-xs" >
											<i class='fa fa-file'></i> Lihat PO </a>
											<a title="Buat SO" href="<?php echo site_url('so/add/'.$row->id);?>" class="btn btn-success btn-xs" >
											<i class='fa fa-plus'></i> Buat SO </a>
										</div>
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