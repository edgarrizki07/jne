				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
					<div class="input-group-btn">
						<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/kepada');?>'" class="btn btn-info"><i class="fa fa-plus"></i><b> Tambah <?php echo $title;?></b></a>
					</div><!-- /btn-group -->
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<?php echo $message;?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
<?php echo $message;?>
                                    <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>No.</td>
			<td>Tanggal</td>
			<td>Jam</td>
			<td>Dari</td>
            <td>Kepada</td>
            <td>Judul</td>
            <td>Isi Pesan</td>
            <td>C/D</td>
            <td>C/K</td>
            <td>Baca</td>
            <td><i class="fa fa-paperclip"></i></td>
        </tr>
    </thead>
    <?php $no=0; foreach($pesan as $row ): $no++; $tgl= $this->app_model->tgl_str($this->app_model->ambilDate($row->tgl)); ?>
	<?php $jam= $this->app_model->ambilTime($row->tgl); ?>
    <tr>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $no;?></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $tgl;?></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $jam;?></a></td>
		<td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $this->user_model->NamaUser($row->dari);?></br></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $this->user_model->NamaUser($row->kepada);?></br></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $row->judul;?></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo substr($row->pesan,0,45);?></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $row->cekdari;?></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $row->cekkepada;?></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php echo $row->bdari;?> / <?php echo $this->app_model->tgl_str($this->app_model->ambilDate($row->btgl));?> <?php echo $this->app_model->jam_str($this->app_model->ambilTime($row->btgl));?></a></td>
        <td><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/lihat/'.$row->id);?>'"><?php if($row->lampiran==''){ ?><?php }else{ ?><i class="fa fa-paperclip"></i><?php } ?></a></td>
    </tr>
    <?php endforeach;?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			<!-- end Page Content -->
