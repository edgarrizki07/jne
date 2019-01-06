				<!-- Page Right Column -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Edit <?php echo $title;?></h1>
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
									<label><strong>Nama Usaha / Singkatan</strong></label>
									<div class="input-group">
									<input name="nama" type="text" class="form-control" value="<?php echo $info['nama'];?>" required/>
									<span class="input-group-addon"> / </span>
									<input name="singkatan" type="text" class="form-control" value="<?php echo $info['singkatan'];?>" required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Alamat</strong></label>
									<input name="alamat" type="text" class="form-control" value="<?php echo $info['alamat'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>No Telp / No Fax</strong></label>
									<div class="input-group">
									<input name="telp" type="text" class="form-control" value="<?php echo $info['telp'];?>" required/>
									<span class="input-group-addon"> / </span>
									<input name="fax" type="text" class="form-control" value="<?php echo $info['fax'];?>" required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Email PO Pusat</strong></label>
									<div class="input-group">
									<span class="input-group-addon"> : </span>
									<input name="web" type="text" class="form-control" value="<?php echo $info['web'];?>" required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Keterangan</strong></label>
									<textarea name="keterangan" type="text" class="form-control"/><?php echo $info['keterangan'];?></textarea>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!--/.col (right) -->
			</form>
                </section><!-- /.content -->
	<div class="clearfix"></div>
            </div><!-- /.right-side -->
				<!-- end Page Right Column -->