			<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
					<div class="input-group-btn">
						<a href="<?php echo site_url('email');?>" class="btn btn-warning"><i class="fa fa-undo"></i><b> Kembali</b></a>
					</div><!-- /btn-group -->
                    <ol class="breadcrumb">
                        <li class="active"><?php echo $title;?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<?php echo validation_errors(); echo $message;?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Kirim Email Auto ID: <?php echo $no;?> <?php echo $this->app_model->EmailKirim($this->app_model->AutoEmail()+1);?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
							   <?php echo form_open_multipart('email/kirimauto'); ?>
								<div class="text-center">
									<a class="btn btn-flat"><b>Kepada : <?php echo $this->app_model->EmailKirim($no);?></b></a>
									<a href="<?php echo site_url('email/monitor');?>" class="btn btn-warning"><i class="fa fa-desktop"></i><b> Monitor Auto</b></a>
									<button type="submit" class="btn btn-primary"><i class="fa fa-play"></i><b>  Kirim Email Auto</b></button>
									<a href="<?php echo site_url('email/mulai');?>" class="btn btn-danger"><i class="fa fa-play"></i><b> Lanjutkan Kirim Auto</b></a>
									<a href="<?php echo site_url('email/ulang');?>" class="btn btn-danger"><i class="fa fa-play"></i><b> Ulang Kirim Auto</b></a>
									<a href="<?php echo site_url('email/daftar');?>" class="btn btn-info"><i class="fa fa-list"></i><b> Daftar Email</b></a>
									<input name="to" type="hidden" class="form-control" value="<?php echo $this->app_model->EmailKirim($no);?>"/>
								</div>
								<div class="form-group has-success">
									<label><strong>Subject / Judul</strong></label>
									<input name="subject" type="text" class="form-control" value=""/>
								</div>
								<div class="form-group has-success">
									<label><strong>Pesan / Isi</strong></label>
									<textarea id="editor1" rows="10" cols="80" name="isi" type="text" class="form-control" /></textarea>
								</div>
								<?php echo form_close();?>
								<div class="form-group has-success">
									<label><strong>Pesan Sebelumnya</strong></label>
									<?php $this->db->where('id',$this->db->count_all_results('email')); $sat = $this->db->get('email'); $pesan = $sat->result(); ?>
									<?php $no=0; foreach($pesan as $row ): $no++; ?><p><?php echo $row->pesan;?></p><?php endforeach;?>
								</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			<!-- end Page Content -->