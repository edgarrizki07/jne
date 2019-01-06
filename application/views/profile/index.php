				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header no-print">
					<div class="input-group-btn">
						<button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
						<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href=('<?php echo site_url('profile/edit');?>')">
						<i class='fa fa-edit'></i> Edit Profile</a>
						<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('profile/photo');?>'"><button type="button" class="btn btn-primary">
						<i class="fa fa-picture-o"></i> Edit Photo</button></a>
                    </div><!-- /btn-group -->
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
                <section class="content invoice">
				<?php echo $message;?>

                    <div class="row">
                        <div class="col-xs-9">
                            <p class="lead">Data User:</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Username</th>
                                        <td>:</td>
                                        <td><?php echo $info['username'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td>:</td>
                                        <td><?php echo $this->user_model->Level($info['administrator']);?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Depan</th>
                                        <td>:</td>
                                        <td><?php echo $info['nama_depan'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Belakang</th>
                                        <td>:</td>
                                        <td><?php echo $info['nama_belakang'];?></td>
                                    </tr>
                                    <tr>
                                        <th>JK</th>
                                        <td>:</td>
                                        <td><?php if($info['jk']=='Laki-laki'){ ?>Laki-Laki<?php }else{ ?>Perempuan<?php } ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat/Tgl Lahir</th>
                                        <td>:</td>
                                        <td><?php echo $info['kota'];?> / <?php echo $this->jurnal_model->tgl_indo($info['tgl']);?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td><?php echo $info['alamat'];?></td>
                                    </tr>
                                    <tr>
                                        <th>No Telp</th>
                                        <td>:</td>
                                        <td><?php echo $info['telp'];?></td>
                                    </tr>
                                    <tr>
                                        <th>No HP</th>
                                        <td>:</td>
                                        <td><?php echo $info['hp'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td><?php echo $info['email'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Bank & No Rekening</th>
                                        <td>:</td>
                                        <td><?php echo $info['rekening'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>:</td>
                                        <td><?php echo $info['keterangan'];?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                        <!-- accepted payments column -->
                        <div class="col-xs-3">
                            <p class="lead">Photo Profile:</p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
								<?php if($info['photo']==''){ ?>
								<img width="215px" src="<?php echo base_url();?>images/photo.png"/>
								<?php }else{ ?>
								<img width="215px" src="<?php echo base_url('images/photo/'.$info['photo']);?>"/>											
								<?php } ?>
                            </p>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			<!-- end Page Content -->