				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Edit <?php echo $title;?>
                    </h1>
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
                            <div class="box box-warning">
                                <div class="box-body">
                                        <div class="hidden">
                                            <label><strong>ID <?php echo $title;?></strong></label>
                                            <input name="kode" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
                                        </div>
										<div class="text-center">
											<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
											<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('profile/edit');?>'"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
											<i class="fa fa-edit"></i> Edit Profile</button></a>
											<a style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>profile/'"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
											<i class="fa fa-undo"></i> Kembali</button></a>
										</div>
                                </div><!-- /.box-body -->
                                <div class="box-body">
                                        <!-- button -->
										<div class="form-group has-success">
                                            <label><strong>Pilih Photo</strong></label>
                                            <input name="gbr" type="file"/>
											<div class="box-body text-center">
												<?php if($info['photo']==''){ ?>
												<img width="485px" src="<?php echo base_url();?>images/photo.png"/>
												<?php }else{ ?>
												File Name : <?php echo $info['photo'];?><br/><br/>
												<img width="485px" src="<?php echo base_url('images/photo/'.$info['photo']);?>"/>											
												<?php } ?>
											</div><!-- /.box-body -->
										</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
			</form>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
				<!-- end Page Right Column -->