<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="input-group-btn">
			<a class="btn btn-warning" href="<?php echo site_url('jual');?>"><i class="fa fa-file"></i> Daftar Penjualan</a>
		<?php if($this->bbm_model->CekJual($this->uri->segment(3))=='0'){ ?>
			<a target="_blank" href="<?php echo site_url('jual/add_do/'.$this->uri->segment(3));?>" class="btn btn-primary"><i class="fa fa-plus"></i><b> Tambah <?php echo $title;?></b></a>
			<?php if($this->bbm_model->HargaJual($this->uri->segment(3))=='0'){ ?>
				<?php if($this->session->userdata('SESS_WP_ID')==$this->bbm_model->WPJual($this->uri->segment(3))){ ?>
				<a target="_blank" title="Tambah Invoice" href="<?php echo site_url('jual/add_in/'.$this->uri->segment(3));?>" class="btn btn-success" ><i class='fa fa-plus'></i><b> Tambah Invoice </b></a>
				<?php } ?>
			<?php }else{ ?>
				<a target="_blank" title="lihat Invoice" href="<?php echo site_url('jual/view/'.($this->uri->segment(3)));?>" class="btn btn-info" ><i class='fa fa-file'></i> Lihat Invoice </a>
			<?php } ?>
		<?php } ?>
		</div><!-- /btn-group -->
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<i class="fa fa-file"></i>
						<h3 class="box-title"> Delivery Order Nomor : <b><?php echo $this->uri->segment(3);?></b> Sold to : <?php $customer = $this->bbm_model->CustomerJual($this->uri->segment(3)) ;?> <strong><?php echo $this->customer_model->NamaCustomer($customer);?></strong></h3>
						<h5>
						Jumlah Jual : <?php $sell = $this->bbm_model->JmlJual($this->uri->segment(3)) ; echo number_format ($sell, 0, ',', '.');?> Ltr 
						- Delivered (acc) : <?php $delivered = $this->bbm_model->DeliveredDO($this->uri->segment(3)) ; echo number_format ($delivered, 0, ',', '.');?> Ltr 
						- Created (blm acc) : <?php $created = $this->bbm_model->CreatedDO($this->uri->segment(3)) ; echo number_format ($created, 0, ',', '.');?> Ltr 
						= Sisa : <?php $sisa = $sell-$delivered-$created ; echo  number_format ($sisa, 0, ',', '.');?> Ltr
						</h5>
					</div>
					<div class="box-body">
						<h4><i class="fa fa-check-square-o"></i> ACC</h4>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Ship Date</th>
		<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>Cabang</th>
		<?php } ?>
									<th>Terminal Loading</th>
									<th>Storage</th>
									<th>Kendaraan</th>
									<th>Capacity / Quantity</th>
									<th>Driver</th>
								</tr>
							</thead>
							<tbody>
	<?php if($this->session->userdata('ADMIN')=='1'){ ?>
	<?php $jual = $this->db->get_where('do',array('cek'=>'0','status'=>'0','id_jual'=>$this->uri->segment(3))); $dorder = $jual->result();?>
	<?php }else{ ?>
	<?php $jual = $this->db->get_where('do',array('cek'=>'0','status'=>'0','id_jual'=>$this->uri->segment(3),'wp_id'=>$this->session->userdata('SESS_WP_ID'))); $dorder = $jual->result();?>
	<?php } ?>
	<?php $no=0; foreach($dorder as $row ): $no++;?>
	<?php $item = '1'; $jml=$row->volume;?>
								<tr>
									<td><?php echo $no;?></td>
									<td>
										<div class="btn-group">
										  <button type="button" class="btn btn-info btn-xs">Action</button>
										  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu" role="menu">
											<div class="btn-group-vertical">
												<a title="lihat DO" href="<?php echo site_url('jual/view_do/'.$row->id);?>" class="btn btn-primary btn-xs" ><i class='fa fa-print'></i> Lihat </a>
											</div>
										  </ul>
										</div>
									<br><?php echo $this->jurnal_model->tgl_singkatan($row->tglkirim);?></td>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?><br>create by : <?php echo $this->user_model->NamaUser($row->login_id);?>, acc by : <?php if($row->admin_id =='0'){ ?><p class="text-red">Blm Acc<p><?php }else{ ?><?php echo $this->user_model->NamaUser($row->admin_id);?><?php } ?></td>
								<?php } ?>
									<td><?php echo $row->terminal_loading;?></td>
									<td><?php if($row->storage =='0'){ ?>Gudang Utama<?php } else if($row->storage =='1'){ ?>Gudang Cadangan<?php } else if($row->storage =='2'){ ?>On Supplier<?php } else if($row->storage =='3'){ ?>Other Storage<?php } ?></td>
									<td><?php echo $row->angkutan;?></td>
									<td><?php echo $row->capacity;?> / <br><?php echo $row->volume;?> L</td>
									<td><?php echo $row->driver;?></td>
								</tr>
	<?php endforeach;?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
					<div class="box-body">
						<h4><i class="fa fa-square-o"></i> Belum ACC</h4>
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Ship Date</th>
		<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>Cabang</th>
		<?php } ?>
									<th>Terminal Loading</th>
									<th>Storage</th>
									<th>Kendaraan</th>
									<th>Capacity / Quantity</th>
									<th>Driver</th>
								</tr>
							</thead>
							<tbody>
	<?php if($this->session->userdata('ADMIN')=='1'){ ?>
	<?php $jual = $this->db->get_where('do',array('cek'=>'0','status'=>'1','id_jual'=>$this->uri->segment(3))); $dorder = $jual->result();?>
	<?php }else{ ?>
	<?php $jual = $this->db->get_where('do',array('cek'=>'0','status'=>'1','id_jual'=>$this->uri->segment(3),'wp_id'=>$this->session->userdata('SESS_WP_ID'))); $dorder = $jual->result();?>
	<?php } ?>
	<?php $no=0; foreach($dorder as $row ): $no++;?>
	<?php $item = '1'; $jml=$row->volume;?>
								<tr>
									<td><?php echo $no;?></td>
									<td>
									<td>
										<div class="btn-group">
										  <button type="button" class="btn btn-info btn-xs">Action</button>
										  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu" role="menu">
											<div class="btn-group-vertical">
												<a title="lihat DO" href="<?php echo site_url('jual/view_do/'.$row->id);?>" class="btn btn-primary btn-xs" ><i class='fa fa-print'></i> Lihat </a>
												<br>
												<a title="Hapus DO" href="<?php echo base_url();?>index.php/jual/hapusdo/<?php echo $row->id;?>" class="btn btn-danger btn-xs" 
												onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i></a>
												onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i></a>
											</div>
										  </ul>
										</div>
									<br><?php echo $this->jurnal_model->tgl_singkatan($row->tglkirim);?></td>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?><br>create by : <?php echo $this->user_model->NamaUser($row->login_id);?>, acc by : <?php if($row->admin_id =='0'){ ?><p class="text-red">Blm Acc<p><?php }else{ ?><?php echo $this->user_model->NamaUser($row->admin_id);?><?php } ?></td>
								<?php } ?>
									<td><?php echo $row->terminal_loading;?></td>
									<td><?php if($row->storage =='0'){ ?>Gudang Utama<?php } else if($row->storage =='1'){ ?>Gudang Cadangan<?php } else if($row->storage =='2'){ ?>On Supplier<?php } else if($row->storage =='3'){ ?>Other Storage<?php } ?></td>
									<td><?php echo $row->angkutan;?></td>
									<td><?php echo $row->capacity;?> / <br><?php echo $row->volume;?> L</td>
									<td><?php echo $row->driver;?></td>
								</tr>
	<?php endforeach;?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
				
			</div>
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->

