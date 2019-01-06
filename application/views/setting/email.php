				<!-- Page Right Column -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php echo $title;?></h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
                <section class="content">
			<form class="form" action="" method="post" enctype="multipart/form-data" >
					<?php echo validation_errors(); echo $message;?>
					<div class="col-md-12">
						<!-- general form elements disabled -->
						<div class="box box-primary">
							<div class="box-body well">
								<div class="text-center">
									<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
									<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting');?>'"<button type="button" name="kembali" id="kembali" class="btn btn-primary">
									<i class="fa fa-undo"></i> Kembali</button></a>
									<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/photo');?>'">
									<i class="fa fa-picture-o"></i> Edit Foto</a>
									<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/logo');?>'">
									<i class="fa fa-picture-o"></i> Edit Logo</a>
									<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/header');?>'">
									<i class="fa fa-picture-o"></i> Edit Header</a>
								</div>
								<!-- text hidden -->
								<div class="hidden">
									<label><strong>ID <?php echo $title;?></strong></label>
									<input name="kode" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
								</div>
								<!-- text input -->
								<div class="form-group">
									<label><strong>Email / Password</strong></label>
									<div class="input-group has-success">
									<input name="email" type="text" class="form-control" value="<?php echo $info['email'];?>" required/>
									<span class="input-group-addon"> / </span>
									<input name="password" type="text" class="form-control" value="<?php echo $info['password'];?>" required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Protocol / Host / Port</strong></label>
									<div class="input-group has-success">
									<input name="protocol" type="text" class="form-control" value="<?php echo $info['protocol'];?>" required/>
									<span class="input-group-addon"> / </span>
									<input name="host" type="text" class="form-control" value="<?php echo $info['host'];?>" required/>
									<span class="input-group-addon"> / </span>
									<input name="port" type="text" class="form-control" value="<?php echo $info['port'];?>" required/>
									</div>
								</div>
								  <div class="form-group">
									<input name="subject_po" type="text" class="form-control"  placeholder="Judul PO:" value="<?php echo $info['subject_po'];?>" required/>
								  </div>
								  <div class="form-group">
									<input name="subject_do" type="text" class="form-control"  placeholder="Judul DO:" value="<?php echo $info['subject_do'];?>" required/>
								  </div>
								  <div class="form-group">
									<input name="subject_invoice" type="text" class="form-control"  placeholder="Judul Invoice:" value="<?php echo $info['subject_invoice'];?>" required/>
								  </div>
								  <div class="form-group">
									<textarea name="header_mail" id="compose-textarea" class="form-control" placeholder="Header Pesan:" style="height: 150px"><?php echo $info['header_mail'];?></textarea>
								  </div>
								  <div class="form-group">
									<textarea name="footer_mail" id="tulis-textarea" class="form-control" placeholder="Footer Pesan:" style="height: 150px"><?php echo $info['footer_mail'];?></textarea>
								  </div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!--/.col (right) -->
			</form>
                </section><!-- /.content -->
	<div class="clearfix"></div>
            </div><!-- /.right-side -->
				<!-- end Page Right Column -->