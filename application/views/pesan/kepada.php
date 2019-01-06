				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
					<div class="input-group-btn">
						<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/masuk');?>'" class="btn btn-primary"><i class="fa fa-inbox"></i><b> Pesan Masuk</b></a>
						<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/keluar');?>'" class="btn btn-primary"><i class="fa fa-envelope-o"></i><b> Pesan Keluar</b></a>
					</div><!-- /btn-group -->
                    <ol class="breadcrumb">
                        <li><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('dashboard');?>'"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="active"><?php echo $title;?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<td>No.</td>
												<td></td>
												<td>User</td>
												<td></td>
											</tr>
										</thead>
										<?php $user = $this->db->get_where('login',array('id !='=>$this->session->userdata('SESS_USER_ID')))->result();?>
										<?php $no=0; foreach($user as $row): $no++;?>
										<?php $nama = $this->user_model->NamaUser($row->id);?>
										<?php $kota = $this->user_model->NamaBUser($row->id);?>
										<?php $level = $this->user_model->Level($row->administrator);?>
										<tr>
											<td Width="30"><?php echo $no;?></td >
											<td width="150px" >
												<div class="pull-left">
												<?php if($row->photo==''){ ?>
												<img width="150px" src="<?php echo base_url('images/'.'photo.png');?>">
												<?php }else{ ?>
												<img width="150px" src="<?php echo base_url('images/photo/'.$row->photo);?>">
												<?php } ?>
												</div>
											</td>
											<td><?php echo $level;?> - <?php echo $kota;?></br><?php echo $nama;?></td>
											<td Width="100" align="center"><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('pesan/tambah/'.$row->id);?>'"><i class="fa fa-edit"></i> Tulis Pesan</a></td>
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
