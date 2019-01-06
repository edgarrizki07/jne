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
              <div class="box box-info">
				<?php
					if($this->session->userdata('SUCCESSMSG'))
					{
						echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>";
						$this->session->unset_userdata('SUCCESSMSG');
					}
				?>
                <div class="box-header">
					<div class="btn-group">
						<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>customer/add"><i class="fa fa-plus"></i> Tambah Customer Baru</a>
						<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>tawaran/add"><i class="fa fa-edit"></i> Tambah Penawaran</a>
					<?php if($this->session->userdata('ADMIN') <='5'){ ?>
						<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>jual/tambah"><i class="fa fa-edit"></i> Tambah Penjualan</a>
					<?php } ?>
					<?php if($this->uri->segment(2) == 'terhapus'){ ?>
						<a class="btn btn-success" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('customer');?>');"><i class='fa fa-user'></i> Customer Aktif</a>
					<?php }else{ ?>
						<a class="btn btn-info" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('customer/baru');?>');"><i class='fa fa-user'></i> Customer Baru</a>
						<a class="btn btn-danger" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('customer/terhapus');?>');"><i class='fa fa-user'></i> Customer Telah Dihapus</a>
					<?php } ?>
					</div>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Kode</th>
							<th>Direktur</th>
							<th>Telpon</th>
							<th>Email</th>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<th>Cabang</th>
						<?php } ?>
							<th>By</th>
							<th>Action</th>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<th>Hapus</th>
						<?php } ?>
						</tr>
					</thead>						
					<tbody>
				<?php  if($client_data) { ?>
				<?php $no=0; foreach($client_data as $row ): $no++;?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row->nama;?></td>
							<td><?php echo $row->kode;?></td>
							<td><?php echo $row->nama_dirut;?> <?php echo $row->hp_dirut;?></td>
							<td><?php echo $row->telpon_1;?></td>
							<td><?php echo $row->email;?></td>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
						<?php } ?>
							<td><?php echo $this->user_model->NamaUser($row->login_id);?></td>
							<td>
								<div class="btn-group-vertical">
									<a title="Lihat Profile" class="btn btn-success btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('customer/view/'.$row->id);?>');"><i class='fa fa-user'></i> Lihat</a>
						<?php if($this->session->userdata('SESS_WP_ID') == $row->wp_id){ ?>
									<a title="Edit Profile" class="btn btn-primary btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('customer/edit/'.$row->id);?>');"><i class='fa fa-edit'></i> Edit</a>
						<?php } ?>
								</div>
							</td>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<td align="right">
								<div class="btn-group">
								<?php if($row->cek == '0'){ ?>
									<a title="Hapus Customer" class="btn btn-danger btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('customer/delete/'.$row->id);?>');"><i class='fa fa-trash-o'></i> Hapus</a>
								<?php }else{ ?>
									<a title="Kembalikan Customer" class="btn btn-success btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('customer/kembali/'.$row->id);?>');"><i class='fa fa-reply'></i> Kembalikan</a>
								<?php } ?>
								</div>
							</td>
						<?php } ?>
						</tr>
				<?php endforeach;?>
				<?php } ?>
					</tbody>
				</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
