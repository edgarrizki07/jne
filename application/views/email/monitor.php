				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="input-group-btn">
                        <a style="cursor: pointer;" onclick="location.href='<?php echo site_url('t_barang/cetak');?>'" class="btn btn-warning"><i class="fa fa-print"></i><b> Cetak <?php echo $title;?></b></a>
        			<?php if($this->session->userdata('level')=='06'){ ?>
                        <a style="cursor: pointer;" onclick="location.href='<?php echo site_url('t_barang/tambah');?>'" class="btn btn-primary"><i class="fa fa-plus"></i><b> Tambah <?php echo $title;?></b></a>
        			<?php } ?>
                    </div><!-- /btn-group -->
                    <ol class="breadcrumb">
                        <li><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('dashboard');?>'"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="active"><?php echo $title;?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $title;?></h3>
                                </div><!-- /.box-header -->
                                <div class="timeline-body">
								<div class="text-center">
									<button type="submit" class="btn btn-primary"><i class="fa fa-play"></i> Kirim Email Auto</button>
									<a href="<?php echo site_url('email/monitor');?>" class="btn btn-warning"><i class="fa fa-desktop"></i><b> Monitor Auto</b></a>
									<a href="<?php echo site_url('email/mulai');?>" class="btn btn-danger"><i class="fa fa-play"></i><b> Lanjutkan Kirim Auto</b></a>
									<a href="<?php echo site_url('email/ulang');?>" class="btn btn-danger"><i class="fa fa-play"></i><b> Ulang Kirim Auto</b></a>
									<a href="<?php echo site_url('email/daftar');?>" class="btn btn-info"><i class="fa fa-list"></i><b> Daftar Email</b></a>
								</div>
                                    <iframe src="<?php echo base_url('datainput');?>" frameborder="0" height="900" width="1100"></iframe>
								</div><!-- /.box-body -->
                            </div><!-- /.box -->
							
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			<!-- end Page Content -->