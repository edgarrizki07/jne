				<!-- Page Right Column -->
            <aside class="right-side">
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
			<form class="form" action="" method="post" enctype="multipart/form-data" >
					<?php echo validation_errors(); echo $message;?>
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-body">
                                        <div class="hidden">
                                            <label><strong>ID <?php echo $title;?></strong></label>
                                            <input name="id" type="text" class="form-control" value="<?php echo $this->uri->segment(3);?>" required/>
                                        </div>
										<div class="text-center">
										<?php if($info['status'] =='3'){ ?>
											<?php if($this->session->userdata('ADMIN')=='1'){ ?>
											<a href="<?php echo site_url('beli/bunker/'.$info['id']);?>" class="btn btn-info" ><i class="fa fa-lock"></i> Selesai / Paid</a>
											<?php } ?>
										<?php } ?>
										<?php if($info['status'] =='2'){ ?>
											<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
										<?php } ?>
										</div>
                                </div><!-- /.box-body -->
                                <div class="box-body">
                                        <!-- button -->
										<div class="form-group">
											<div class="col-xs-3">
												<label><strong>Tgl Bayar</strong></label>
											</div>
											<div class="input-group">
											<input type="text" name="tglbyr" id="datepicker"  value="<?php echo date('Y-m-d');?>" class="form-control"/>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-3">
												<label><strong>Pembayaran dari akun</strong></label>
											</div>
											<div class="input-group">
											<select name="akunbyr" class="form-control" required>
											<option></option>
										<?php $this->db->order_by($order_column='id',$order_type='asc'); $this->db->order_by($order_column='kode',$order_type='asc'); ?>
										<?php $akun = $this->db->get_where('akun',array('jenis_akun_id'=> '2' ,'wp_id'=>$this->session->userdata('SESS_WP_ID')));?>
										<?php $item = $akun->result(); ?>
										<?php $no=0; foreach($item as $row ): $no++;?>
											<option value="<?php echo $row->id;?>"><?php echo $row->kelompok_akun_id;?> - <?php echo $row->kode;?> (<?php echo $row->nama;?>)</option>
										<?php endforeach;?>
											</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-3">
												<label><strong>Pilih File Bukti Transfer</strong></label>
											</div>
											<div class="input-group">
                                            <input name="gbr" type="file"/>
											</div>
										</div>
										<div class="form-group has-success">
											<div class="box-body text-center">
												<?php if($info['bukti']==''){ ?>
												<img width="485px" src="<?php echo base_url();?>images/faktur.png"/>
												<?php }else{ ?>
												File Name : <?php echo $info['bukti'];?><br/><br/>
												<img width="485px" src="<?php echo base_url('files/pelunasan/'.$info['bukti']);?>"/>											
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