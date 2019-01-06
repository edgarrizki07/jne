				<!-- Page Right Column -->
      <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header no-print">
			<div class="input-group-btn">
				<button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
				<a href="<?php echo base_url();?>index.php/alamat_kirim/"><button type="button" class="btn btn-primary">
				<i class="fa fa-undo"></i> KEMBALI</button></a>
			</div><!-- /btn-group -->
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
				<li class="active"><?php echo $title; ?></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content invoice">
			<!-- title row -->
			<div class="row">
				<div class="col-md-12">
					<h2>
						<div class="box-body text-center">
							<b><?php echo $title;?></b>
						</div><!-- /.col -->
					</h2>
				</div><!-- /.col -->
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Perusahaan</th>
										<th>Alamat</th>
										<th>Telp</th>
										<th>Email</th>
										<th>CP</th>
										<th>HP</th>
									</tr>
								</thead>
								<tbody>
		<?php $no=0; foreach($info as $row ): $no++;?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $row->nama;?></td>
										<td width="300"><?php echo $row->alamat;?></td>
										<td><?php echo $row->telp;?></td>
										<td><?php echo $row->email;?></td>
										<td><?php echo $row->cp;?></td>
										<td><?php echo $row->hp;?></td>
									</tr>
		<?php endforeach;?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					
				</div>
			</div>

		</section><!-- /.content -->
      </div>
			<!-- end Page Content -->