<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo $title;?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>"; $this->session->unset_userdata('SUCCESSMSG'); } ?>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
			<?php if($this->pajak_model->Accso($this->session->userdata('SESS_WP_ID'))=='1'){ ?>
				<div class="box">
					<div class="box-header">
						<h4><i class="fa fa-check-square-o"></i>Belum ACC</h4>
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
							<?php $vou = $this->db->get_where('po',array('cek'=>'0','status'=>'1')); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
								<tr>
									<td><?php echo $no;?></td>
									<td><a title="lihat PO" href="<?php echo site_url('so/view/'.$row->id);?>" class="btn btn-success btn-xs" ><?php echo $row->id_po;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?></a>
									<br><?php echo $this->jurnal_model->tgl_singkatan($row->tglso);?></td>
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
			<?php } ?>
				<div class="box">
					<div class="box-header">
						<h4><i class="fa fa-check-square-o"></i> ACC</h4>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example2" class="table table-bordered table-striped">
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
									<td><a title="lihat PO" href="<?php echo site_url('so/view/'.$row->id);?>" class="btn btn-success btn-xs" ><?php echo $row->id_po;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?></a>
									<br><?php echo $this->jurnal_model->tgl_singkatan($row->tglso);?></td>
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
				<div class="box">
					<div class="box-header">
						<h4><i class="fa fa-check-square-o"></i>Sudah Melalui Proses Penjualan</h4>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example3" class="table table-bordered table-striped">
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
							<?php $this->db->order_by($order_column='id',$order_type='asc'); $vou = $this->db->get_where('po',array('cek'=>'0','status'=>'3')); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
								<tr>
									<td><?php echo $no;?></td>
									<td><a title="lihat PO" href="<?php echo site_url('so/view/'.$row->id);?>" class="btn btn-success btn-xs" ><?php echo $row->id_po;?>/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?></a>
									<br><?php echo $this->jurnal_model->tgl_singkatan($row->tglso);?></td>
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
	<div class="clearfix"></div>
</div><!-- /.content-wrapper -->