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
	<div class="col-md-5">
	  <!-- The time line -->
	  <ul class="timeline">
		<?php $user = $this->db->get('wp'); $item = $user->result(); $no=0; foreach($item as $row2 ): $no++;?>
		<li class="time-label"><span class="bg-<?php echo $row2->warna;?>"><i class="fa fa-home"></i> <?php echo $row2->kota;?> - <?php echo $row2->provinsi;?></span></li>
		<li>
		  <i class="fa fa-user bg-blue"></i>
		  <div class="timeline-item">
			<span class="time"><i class="fa fa-users"></i> User</span>
			  <div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $row2->kota;?></h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div><!-- /.box-header -->
		<?php $user = $this->db->get_where('level',array('id_level !='=>'1')); $item = $user->result(); $no=0; foreach($item as $row1 ): $no++;?>
				<div class="box-body">
				  <b><?php echo $row1->keterangan;?></b>
				  <ul class="users-list clearfix">
					<?php $user = $this->db->get_where('login',array('aktif'=>'1','wp_id'=>$row2->id,'administrator'=>$row1->id_level)); $item = $user->result(); $no=0; foreach($item as $row ): $no++;?>
                        <div class="direct-chat-msg">
                          <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left"><?php echo $row->username;?></span>
                            <span class="direct-chat-timestamp pull-right"><?php echo $row->keterangan;?></span>
                          </div><!-- /.direct-chat-info -->
						<?php if($row->photo==""){ ?>
						  <img class="direct-chat-img" src="<?php echo base_url('images/photo.png');?>">
						<?php } else{ ?>
						  <img class="direct-chat-img" src="<?php echo base_url('images/photo/'.$row->photo);?>"/>
						<?php } ?>
                          <div class="direct-chat-text"><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->
					<?php endforeach;?>
				  </ul><!-- /.users-list -->
				</div><!-- /.box-footer -->
		<?php endforeach;?>
			  </div><!--/.box -->
		  </div>
		</li>
		<?php endforeach;?>
	  </ul>
	</div><!-- /.col -->
	<div class="col-md-7">
	  <div class="box box-info">
		<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>";
		$this->session->unset_userdata('SUCCESSMSG'); } ?>
		<div class="box-header">
			<div class="btn-group">
				<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>user/add"><i class="fa fa-plus"></i> Tambah Baru</a>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
		  <table id="example1" class="table table-bordered table-striped">
			<thead>
			  <tr>
				<th>No</th>
				<th>Level</th>
				<th>Username</th>
				<th>Nama</th>
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
				<th>Cabang</th>
	<?php } ?>
				<th>Action</th>
			  </tr>
			</thead>
			<tbody>
		<?php $no=0; foreach($user_data as $row ): $no++;?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $this->user_model->Level($row->administrator);?> <?php if($row->aktif =='0'){ ?><b class="text-red">- NON AKTIF- <b><?php } ?></td>
					<td><?php echo $row->username;?></td>
					<td><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></td>
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
	<?php } ?>
					<td align="right">
						<div class="btn-group-vertical">
							<a title="Lihat Profile" class="btn btn-primary btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('user/view/'.$row->id);?>');">
							<i class='fa fa-user'></i> Lihat</a>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<a title="Edit Profile" class="btn btn-success btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('user/edit/'.$row->id);?>');">
							<i class='fa fa-edit'></i> Edit</a>
					<?php if($row->aktif =='1'){ ?>
							<a title="Jadikan tidak bisa login" class="btn btn-danger btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('user/lock/'.$row->id);?>');"><i class='fa fa-lock'></i> Non Aktif-kan</a>
					<?php }else{ ?>
							<a title="Jadikan bisa login" class="btn btn-warning btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('user/key/'.$row->id);?>');"><i class='fa fa-key'></i> Aktif-kan Lagi</a>
					<?php } ?>
				<?php } ?>
						</div>
					</td>
				</tr>
		<?php endforeach;?>
			</tbody>
		  </table>
		</div><!-- /.box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row -->
  <div class="row">
	<div class="col-xs-12">
	</div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
