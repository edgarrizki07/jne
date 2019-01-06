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
												<th>Cabang - User</th>
												<th>Action</th>
												<th>Link</th>
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php $no=0; foreach($info as $row ): $no++;?>
												<?php $tgl= $this->app_model->ambilDate($this->app_model->ambilTgl($row->tgl)); ?>
												<?php $bln= $this->app_model->ambilDate($this->app_model->ambilBln($row->tgl)); ?>
												<?php $thn= $this->app_model->ambilDate($this->app_model->ambilThn($row->tgl)); ?>
												<?php $jam= $this->app_model->ambilTime($row->tgl); ?>
                                            <tr>
												<td><?php echo $no;?></td>												
                                                <td class="time" ><?php echo $tgl;?> <?php echo $bln;?> <?php echo $thn;?> / <?php echo substr($jam,0,5);?></td>
												<td><b>Cabang <?php echo $this->pajak_model->KotaCabang($row->wp_id);?></b> - <?php echo ($this->user_model->NamaUser($row->login_id));?>
												  <?php if($row->cek=='0'){ ?>
													<i class="fa fa-eye-slash" title="unread"></i> <i class="text-red"> Baru</i>
												  <?php }else{ ?>
													<i class="fa fa-eye" title="read"></i>
												  <?php } ?>
												</td>
												<td><?php echo $row->action;?></td>
												<td>
												<?php if($row->kode=='1'){ ?>
												  <?php if($row->cek=='0'){ ?>
												<a title="lihat PO" href="<?php echo site_url('beli/view/'.$row->link_id.'/'.$row->id);?>" class="btn btn-success btn-xs" >Lihat PO</a>
												  <?php }else{ ?>
												<a title="lihat PO" href="<?php echo site_url('beli/view/'.$row->link_id.'/'.$row->id);?>" class="btn btn-success btn-xs" >Lihat PO</a>
												  <?php } ?>
												<?php }if($row->kode=='2'){ ?>
												  <?php if($row->cek=='0'){ ?>
												<a title="lihat Invoice" href="<?php echo site_url('jual/view/'.$row->link_id.'/'.$row->id);?>" class="btn btn-success btn-xs" >Lihat Invoice</a>
												  <?php }else{ ?>
												<a title="lihat Invoice" href="<?php echo site_url('jual/view/'.$row->link_id.'/'.$row->id);?>" class="btn btn-success btn-xs" >Lihat Invoice</a>
												  <?php } ?>
												<?php }if($row->kode=='3'){ ?>
												<a title="lihat Invoice" href="<?php echo site_url('beli/add_pay/'.$row->link_id.'/'.$row->id);?>" class="btn btn-success btn-xs" >Lihat Pelunasan PO</a>
												<?php }if($row->kode=='4'){ ?>
												<a title="lihat Invoice" href="<?php echo site_url('jual/add_pay/'.$row->link_id.'/'.$row->id);?>" class="btn btn-success btn-xs" >Lihat Pembayaran Invoice</a>
												<?php } ?>
												</td>
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