      <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
					<h1>
						<?php echo $title;?>
					</h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>Tanggal</th>
												<th>IP Address</th>
												<th>Level</th>
												<th>User</th>
												<th>Nama</th>
												<th>Cabang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php $no=0; foreach($info as $row ): $no++;?>
												<?php $tgl= $this->jurnal_model->tgl_singkatan($this->jurnal_model->ambilDate($row->tgl)); ?>
												<?php $jam= $this->jurnal_model->ambilTime($row->tgl); ?>
                                            <tr>
												<td><?php echo $no;?></td>
                                                <td class="time" ><?php echo $tgl;?> / <?php echo substr($jam,0,5);?></td>
												<td><?php echo $row->ip_address;?></td>
												<td><?php echo $row->level;?></td>
												<td><b><?php echo $this->user_model->NamaUser($row->user_id);?></b> - <?php echo $this->user_model->Level($this->user_model->LevelUser($row->user_id));?> <?php echo $this->user_model->KotaUser($row->user_id);?></td>
												<td><?php echo $row->nama;?></td>
												<td><?php echo $row->wp_id;?></td>
                                            </tr>
				<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							
                        </div>
                    </div>
                </section><!-- /.content -->
			</div>
			<!-- end Page Content -->