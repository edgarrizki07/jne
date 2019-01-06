  <div class="wrapper">
	<!-- Main content -->
	<section class="invoice">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
				  <div class="box box-primary">
		<?php $tgl= $this->app_model->ambilDate($this->app_model->ambilTgl($pesan['tgl'])); ?>
		<?php $bln= $this->app_model->ambilDate($this->app_model->ambilBln($pesan['tgl'])); ?>
		<?php $thn= $this->app_model->ambilDate($this->app_model->ambilThn($pesan['tgl'])); ?>
		<?php $jam= $this->app_model->ambilTime($pesan['tgl']); ?>
		<?php $nama= $this->user_model->NamaUser($pesan['dari']); ?>
		<?php $kota= $this->user_model->NamaBUser($pesan['dari']); ?>
		<?php $kotakepada= $this->user_model->NamaBUser($pesan['kepada']); ?>
		<?php $namakepada= $this->user_model->NamaUser($pesan['kepada']); ?>
					<div class="box-header with-border">
					  <h3 class="box-title">Read Mail</h3>
					  <div class="box-tools pull-right">
						<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
						<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body no-padding">
					  <div class="mailbox-read-info">
						<h3><?php echo $pesan['judul'];?></h3>
						<h5>From: <a style="cursor: pointer;" onclick="location.href='#'"><?php if($pesan['dari']==$this->session->userdata('SESS_USER_ID')){ ?> Anda <?php }else{ ?><?php echo $nama;?> - <?php echo $kota;?><?php } ?></a>   <i class="fa fa-sign-out"></i> To : <a style="cursor: pointer;" onclick="location.href='#'"><?php if($pesan['kepada']==$this->session->userdata('SESS_USER_ID')){ ?> Anda <?php }else{ ?><?php echo $namakepada;?> - <?php echo $kotakepada;?><?php } ?></a>
						<span class="mailbox-read-time pull-right"><?php echo $tgl;?> <?php echo $bln;?>. <?php echo $thn;?> <?php echo substr($jam,0,5);?></span></h5>
					  </div><!-- /.mailbox-read-info -->
					  <div class="mailbox-controls with-border text-center">
					  </div><!-- /.mailbox-controls -->
					  <div class="mailbox-read-message">
						<?php echo $pesan['pesan'];?>
					  </div><!-- /.mailbox-read-message -->
					</div><!-- /.box-body -->
					<div class="box-footer">
					  <ul class="mailbox-attachments clearfix">
					  <?php $exp = explode('.',$pesan['lampiran']); if(count($exp) == 2) { $lampiran = $exp[1].' '; } ?>
						<li>
						  <?php if($lampiran=='pdf'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
						  <?php }else if($lampiran=='zip'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-zip-o"></i></span>
						  <?php }else if($lampiran=='rar'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-zip-o"></i></span>
						  <?php }else if($lampiran=='doc'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
						  <?php }else if($lampiran=='docx'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
						  <?php }else if($lampiran=='xls'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-excel-o"></i></span>
						  <?php }else if($lampiran=='xlsx'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-excel-o"></i></span>
						  <?php }else if($lampiran=='ppt'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-powerpoint-o"></i></span>
						  <?php }else if($lampiran=='pptx'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-powerpoint-o"></i></span>
						  <?php }else if($lampiran=='txt'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-text-o"></i></span>
						  <?php }else if($lampiran=='mp3'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-sound-o"></i></span>
						  <?php }else if($lampiran=='mp4'){ ?>
						  <span class="mailbox-attachment-icon"><i class="fa fa-file-video-o"></i></span>
						  <?php }else{ ?>
						  <span class="mailbox-attachment-icon has-img"><img src="<?php echo base_url();?>files/pesan/<?php echo $pesan['lampiran'];?>" ></span>
						  <?php } ?>
						  <div class="mailbox-attachment-info">
							<i class="fa fa-paperclip"></i> <?php echo $pesan['lampiran'];?>
							<span class="mailbox-attachment-size">
							  <?php echo $lampiran; ?> File
							  <i class="fa fa-cloud-download"></i>
							</span>
						  </div>
						</li>
					  </ul>
					</div><!-- /.box-footer -->
				  </div><!-- /. box -->
				</div><!-- /.col -->
			</div>
		</div><!-- /.col -->
	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
