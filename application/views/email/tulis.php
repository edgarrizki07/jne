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
                                    <h3 class="box-title">Kirim Email</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
							   <?php echo form_open_multipart('email/kirim'); ?>
                                        <!-- text input -->
                                        <div class="form-group has-success">
                                            <label><strong>Kepada</strong></label>
                                            <input name="to" type="email" class="form-control" value=""/>
                                        </div>
                                        <div class="form-group has-success">
                                            <label><strong>Subject / Judul</strong></label>
                                            <input name="subject" type="text" class="form-control" value=""/>
                                        </div>
                                        <div class="form-group has-success">
                                            <label><strong>Pesan / Isi</strong></label>
                                            <textarea id="editor1" rows="10" cols="80" name="isi" type="text" class="form-control" /></textarea>
                                        </div>
                                        <div class="form-group has-success">
                                            <label><strong>Pilih File Lampiran</strong></label>
                                            <input type="file" name="lampiran[]">
                                        </div>
										<div class="text-center">
											<button type="submit" class="btn btn-primary"><i class="fa fa-rocket"></i> KIRIM</button>
										</div>
								<?php echo form_close();?>
                                </div><!-- /.box-body -->
                                <div class="box-body table-responsive">
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			<!-- end Page Content -->