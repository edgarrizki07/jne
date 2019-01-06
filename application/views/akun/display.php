<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	<?php echo $title; ?>
  </h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active"><?php echo $title; ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
		$this->session->unset_userdata('SUCCESSMSG'); } ?>
	  <div class="nav-tabs-custom">
		<div class="box-header">
			<div class="btn-group">
				<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>akun/add"><i class="fa fa-plus"></i> Tambah Baru</a>
				<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>akun/cetak"><i class="fa fa-print"></i> Print</a>
			</div>
	  <!-- Custom Tabs -->
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#tab_0" data-toggle="tab">SEMUA</a></li>
		<?php $vou = $this->db->get('akun_kelompok'); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
			<li><a href="#tab_<?php echo $row->id;?>" data-toggle="tab"> <?php echo $row->nama;?></a></li>
		<?php endforeach;?>
		</ul>
		</div><!-- /.box-header -->
		
		
	<div class="tab-content">
	  <div class="tab-pane active" id="tab_0">
		<div class="box-body">
		  <table id="example0" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th width="60">Kode</th>									
					<th>Nama Akun</th>
					<th>Grup</th>
					<th>Kategori</th>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<th>Cabang</th>
				<?php } ?>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php  if($account_data) { ?>
		<?php $no=0; foreach($account_data as $row ): $no++;?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->kelompok_akun_id;?>-<?php echo $this->akun_model->KodeKategori($row->kategori_akun_id);?><?php echo $this->akun_model->KodeJenis($row->jenis_akun_id);?><?php echo $row->kode;?></td>
					<td><?php echo $row->nama;?></td>
					<td><?php echo $row->groups_name;?></td>
					<td><?php echo $this->akun_model->NamaKategori($row->kategori_akun_id);?><br><?php echo $this->akun_model->NamaJenis($row->jenis_akun_id);?></td>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
				<?php } ?>
					<td align="center">
						<div class="btn-group-vertical">
							<a title="Lihat Profile" class="btn btn-success btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('akun/view/'.$row->id);?>');">
							<i class='fa fa-user'></i> Lihat</a>
							<a title="Edit Profile" class="btn btn-primary btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('akun/edit/'.$row->id);?>');">
							<i class='fa fa-edit'></i> Edit</a>
						</div>
					</td>
				</tr>
		<?php endforeach;?>
		<?php } ?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.tab-pane -->
	<?php $vou = $this->db->get('akun_kelompok'); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
	  <div class="tab-pane" id="tab_<?php echo $row->id;?>">
		<div class="box-body">
		  <table id="example<?php echo $row->id;?>" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode</th>									
					<th>Nama Akun</th>
					<th>Kategori</th>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<th>Cabang</th>
				<?php } ?>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $this->db->order_by('akun.kelompok_akun_id', 'asc'); $this->db->order_by('akun.kategori_akun_id', 'asc'); 
			$this->db->order_by('akun.jenis_akun_id', 'asc'); $this->db->order_by('akun.wp_id', 'asc'); $this->db->order_by('akun.kode', 'asc'); 
			$akun=$this->db->get_where('akun',array('kelompok_akun_id'=>$row->id)); $item = $akun->result(); $no=0; foreach($item as $rows ): $no++;?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $rows->kelompok_akun_id;?>-<?php echo $this->akun_model->KodeKategori($rows->kategori_akun_id);?><?php echo $this->akun_model->KodeJenis($rows->jenis_akun_id);?><?php echo $rows->kode;?></td>
					<td><?php echo $rows->nama;?></td>
					<td><?php echo $this->akun_model->NamaKategori($rows->kategori_akun_id);?><br><?php echo $this->akun_model->NamaJenis($rows->jenis_akun_id);?></td>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<td><?php echo $this->pajak_model->KotaCabang($rows->wp_id);?></td>
				<?php } ?>
					<td align="center">
						<div class="btn-group-vertical">
							<a title="Lihat Profile" class="btn btn-primary btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('akun/view/'.$rows->id);?>');">
							<i class='fa fa-user'></i> Lihat</a>
							<a title="Edit Profile" class="btn btn-success btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('akun/edit/'.$rows->id);?>');">
							<i class='fa fa-edit'></i> Edit</a>
						</div>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.tab-pane -->
	<?php endforeach;?>
	</div><!-- /.tab-content -->
	  </div><!-- nav-tabs-custom -->
					
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
