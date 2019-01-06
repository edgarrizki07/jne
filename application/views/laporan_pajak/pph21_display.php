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
					if($this->session->userdata('SUCCESSMSG')) {
						echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>";
						$this->session->unset_userdata('SUCCESSMSG');
					}
				?>
                <div class="box-header">
					<div class="btn-group">
						<a target="_blank" class="btn btn-success" href="<?php echo site_url();?>laporan_pph21/add"><i class="fa fa-plus"></i> Tambah Baru</a>
					</div>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Bulan</th>
							<th>Tahun</th>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<th>Cabang</th>
						<?php } ?>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php $no=0; foreach($laporan_data as $row ): $no++;?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo nama_bulan($row->bulan);?></td>
							<td><?php echo $row->tahun;?></td>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
						<?php } ?>
							<td align="right">
								<div class="btn-group">
									<a title="Lihat Profile" class="btn btn-success btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('laporan_pph21/view/'.$row->id);?>');">
									<i class='fa fa-user'></i> Lihat</a>
									<a title="Edit Profile" class="btn btn-success btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('laporan_pph21/edit/'.$row->id);?>');">
									<i class='fa fa-edit'></i> Edit</a>
									<a title="Hapus Profile" class="btn btn-danger btn-xs" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('laporan_pph21/delete/'.$row->id);?>');"> 
									<i class='fa fa-trash-o'></i> Hapus</a>
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
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
