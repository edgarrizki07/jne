<div class="content-wrapper">

	<section class="content-header no-print">
		<h1><?php echo $title; ?> - <a href="<?php echo base_url();?>cabang" class="btn btn-success"><i class="fa fa-edit"></i> EDIT </a> </h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-edit"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<section class="content invoice">
		<div class="row">
			<div class="col-md-8">
				<div class="table-responsive">
					<table class="table">
						<tr>
							<th>Nama</th>
							<td>:</td>
							<td><?php echo $info['nama'];?></td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td>:</td>
							<td><?php echo $info['alamat'];?></td>
						</tr>
						<tr>
							<th>Kelurahan</th>
							<td>:</td>
							<td><?php echo $info['kelurahan'];?></td>
						</tr>
						<tr>
							<th>Kecamatan</th>
							<td>:</td>
							<td><?php echo $info['kecamatan'];?></td>
						</tr>
						<tr>
							<th>Kota</th>
							<td>:</td>
							<td><?php echo $info['kota'];?></td>
						</tr>
						<tr>
							<th>Provinsi</th>
							<td>:</td>
							<td><?php echo $info['provinsi'];?></td>
						</tr>
						<tr>
							<th>Email Utama</th>
							<td>:</td>
							<td><?php echo $info['email'];?></td>
						</tr>
						<tr>
							<th>Email Pembelian</th>
							<td>:</td>
							<td><?php echo $info['email1'];?></td>
						</tr>
						<tr>
							<th>Email ACC</th>
							<td>:</td>
							<td><?php echo $info['email2'];?></td>
						</tr>
						<tr>
							<th>Rekening</th>
							<td>:</td>
							<td><?php echo $info['rekening'];?></td>
						</tr>
						<tr>
							<th>Identitas Warna</th>
							<td>:</td>
							<td><?php echo $info['warna'];?></td>
						</tr>
						<tr>
							<th>Keterangan</th>
							<td>:</td>
							<td><?php echo $info['keterangan'];?></td>
						</tr>
					</table>
				</div>
			</div><!-- /.col -->
			<div class="col-md-4">
				<div class="table-responsive">
					<table class="table">
						<tr>
							<th>NPWP</th>
							<td>:</td>
							<td><?php echo $info['npwp'];?></td>
						</tr>
						<tr>
							<th>Kode</th>
							<td>:</td>
							<td><?php echo $info['kode'];?></td>
						</tr>
						<tr>
							<th>PBBKB</th>
							<td>:</td>
							<td><?php echo $info['pbbkb'];?></td>
						</tr>
						<tr>
							<th>No Telp</th>
							<td>:</td>
							<td><?php echo $info['telp'];?></td>
						</tr>
						<tr>
							<th>Fax</th>
							<td>:</td>
							<td><?php echo $info['fax'];?></td>
						</tr>
						<tr>
							<th>Pemilik</th>
							<td>:</td>
							<td><?php echo $info['pemilik'];?></td>
						</tr>
						<tr>
							<th>Kepala</th>
							<td>:</td>
							<td><?php echo $info['kepala'];?></td>
						</tr>
						<tr>
							<th>Keuangan</th>
							<td>:</td>
							<td><?php echo $info['keuangan'];?></td>
						</tr>
						<tr>
							<th>Pembelian</th>
							<td>:</td>
							<td><?php echo $info['pembelian'];?></td>
						</tr>
						<tr>
							<th>Penjualan</th>
							<td>:</td>
							<td><?php echo $info['penjualan'];?></td>
						</tr>
						<tr>
							<th>Operasional</th>
							<td>:</td>
							<td><?php echo $info['operasional'];?></td>
						</tr>
						<tr>
							<th>Pemasaran</th>
							<td>:</td>
							<td><?php echo $info['pemasaran'];?></td>
						</tr>
					</table>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-xs-12">
				<p class="lead">Daftar User:</p>
				<div class="table">
				  <table class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th>No</th>
						<th>Nama</th>
						<th>Jabatan</th>
						<th>HP</th>
						<th>Email</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
				<?php $this->db->order_by($order_column='administrator',$order_type='asc'); $cab = $this->db->get_where('login',array('aktif'=>'1','wp_id'=>$info['id']));?>
				<?php $info = $cab->result(); ?>
				<?php $no=0; foreach($info as $row ): $no++;?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></td>
							<td><?php echo $this->user_model->Level($row->administrator);?></td>
							<td><?php echo $row->hp;?></td>
							<td><?php echo $row->email;?></td>
							<td align="right">
								<div class="btn-group">
									<a href="<?php echo site_url('user/view/'.$row->id);?>" title="Lihat Profile" class="btn btn-primary btn-xs" >
									<i class='fa fa-user'></i> Lihat</a>
								</div>
							</td>
						</tr>
				<?php endforeach;?>
					</tbody>
				  </table>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<div class="row">
			<div class="col-xs-12">
				<p class="lead">Supplier:</p>
				<div class="table">
				  <table class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th>No</th>
						<th>Nama</th>
						<th>Kota</th>
						<th>Kontak Person</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
				<?php $this->db->order_by($order_column='nama',$order_type='asc'); $cab = $this->db->get_where('supplier',array('wp_id'=>$this->uri->segment(3)));?>
				<?php $info = $cab->result(); ?>
				<?php $no=0; foreach($info as $row ): $no++;?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row->nama;?></td>
							<td><?php echo $row->kota;?></td>
							<td><?php echo $row->cp;?><br><?php echo $row->hp;?></td>
							<td align="right">
								<div class="btn-group">
									<a href="<?php echo site_url('supplier/lihat/'.$row->id);?>" title="Lihat Profile" class="btn btn-primary btn-xs" >
									<i class='fa fa-user'></i> Lihat</a>
								</div>
							</td>
						</tr>
				<?php endforeach;?>
					</tbody>
				  </table>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
		
		<div class="row">
			<div class="col-xs-12">
				<p class="lead">Customer:</p>
				<div class="table">
				  <table class="table table-bordered table-striped">
					<thead>
					  <tr>
						<th>No</th>
						<th>Nama</th>
						<th>Kota</th>
						<th>Kontak Person</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
				<?php $this->db->order_by($order_column='nama',$order_type='asc'); $cab = $this->db->get_where('customer',array('wp_id'=>$this->uri->segment(3)));?>
				<?php $info = $cab->result(); ?>
				<?php $no=0; foreach($info as $row ): $no++;?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $row->nama;?></td>
							<td><?php echo $row->kota;?></td>
							<td><?php echo $row->cp;?><br><?php echo $row->hp;?></td>
							<td align="right">
								<div class="btn-group">
									<a href="<?php echo site_url('customer/lihat/'.$row->id);?>" title="Lihat Profile" class="btn btn-primary btn-xs" >
									<i class='fa fa-user'></i> Lihat</a>
								</div>
							</td>
						</tr>
				<?php endforeach;?>
					</tbody>
				  </table>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
		
	</section><!-- /.content -->
	<div class="clearfix"></div>
</div><!-- /.content-wrapper -->
