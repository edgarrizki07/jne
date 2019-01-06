				<!-- Page Right Column -->
            <aside class="right-side">
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
				  <div class="row">
					<div class="col-md-12">
					  <div class="box box-primary">
						<div class="box-body">
							<div class="text-center">
								<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
								<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('profile');?>'"<button type="button" name="kembali" id="kembali" class="btn btn-primary">
								<i class="fa fa-undo"></i> Kembali</button></a>
								<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('profile/photo');?>'"><button type="button" class="btn btn-primary">
								<i class="fa fa-picture-o"></i> Edit Photo</button></a>
							</div>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="row">
					<div class="col-md-7">
					  <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Data User</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<!-- text input -->
							<div class="hidden">
								<label><strong>ID <?php echo $title;?></strong></label>
								<input name="kode" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
							</div>
							<div class="form-group">
								<label><strong>Nama Depan</strong></label>
								<input name="nama_depan" type="text" class="form-control" value="<?php echo $info['nama_depan'];?>" required/>
							</div>
							<div class="form-group">
								<label><strong>Nama Belakang</strong></label>
								<input name="nama_belakang" type="text" class="form-control" value="<?php echo $info['nama_belakang'];?>" required/>
							</div>
							<div class="form-group">
								<label><strong>JK / Tempat / Tanggal Lahir</strong></label>
								<div class="input-group">
								<select name="jk" id="jk" class="form-control" required>
									<option value="<?php echo $info['jk'];?>"><?php if($info['jk']=='Laki-laki'){ ?>Laki-Laki<?php }else{ ?>Perempuan<?php } ?></option>
									<option value="Laki-laki">Laki-laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
								<span class="input-group-addon"> / </span>
								<input name="kota" type="text" class="form-control" value="<?php echo $info['kota'];?>" required/>
								<span class="input-group-addon"> / </span>
								<input name="tgl" type="text" id="datepicker" class="form-control" value="<?php echo $info['tgl'];?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label><strong>Alamat</strong></label>
								<input name="alamat" type="text" class="form-control" value="<?php echo $info['alamat'];?>" required/>
							</div>
							<div class="form-group">
								<label><strong>No Telp / No HP</strong></label>
								<div class="input-group">
								<input name="telp" type="text" class="form-control" value="<?php echo $info['telp'];?>" required/>
								<span class="input-group-addon"> / </span>
								<input name="hp" type="text" class="form-control" value="<?php echo $info['hp'];?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label><strong>Email</strong></label>
								<input name="email" type="text" class="form-control" value="<?php echo $info['email'];?>" required/>
							</div>
							<div class="form-group">
								<label><strong>Bank & No Rekening</strong></label>
								<input name="rekening" type="text" class="form-control" value="<?php echo $info['rekening'];?>" required/>
							</div>
							<div class="form-group">
								<label><strong>Tentang saya</strong></label>
								<textarea name="keterangan" type="text" class="form-control" /><?php echo $info['keterangan'];?></textarea>
							</div>
						</div><!-- /.box-body -->
					  </div>
					</div>
					<div class="col-md-5">
					  <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Untuk Login</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="form-group">
								<label><strong>Username</strong></label>
								<input  type="text" name="username" class="form-control"  value="<?php echo $info['username'];?>" />
							</div>
							<div class="form-group">
								<label><strong>Password</strong></label>
								<input  type="password" name="password" class="form-control"  value="" />
							</div>
						</div><!-- /.box-body -->
						<div class="box-header with-border">
						  <h3 class="box-title">Photo</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="form-group">
								<div class="box-body text-center">
									<?php if($info['photo']==''){ ?>
									<img width="385px" src="<?php echo base_url();?>images/photo.png"/>
									<?php }else{ ?>
									File Name : <?php echo $info['photo'];?>
									<img width="385px" src="<?php echo base_url('images/photo/'.$info['photo']);?>"/>											
									<?php } ?>
								</div><!-- /.box-body -->
							</div>
						</div><!-- /.box-body -->
					  </div>
					</div>
				  </div>
				</form>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
				<!-- end Page Right Column -->