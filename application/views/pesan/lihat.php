      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Read Mail
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Read Mail</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="<?php echo site_url('pesan/tambah');?>" class="btn btn-primary btn-block margin-bottom">Tulis Pesan</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo site_url('pesan/masuk');?>"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php echo $this->m_pesan->JmlInbox($this->session->userdata('SESS_USER_ID'));?></span></a></li>
                    <li><a href="<?php echo site_url('pesan/keluar');?>"><i class="fa fa-envelope-o"></i> Sent <span class="label label-success pull-right"><?php echo $this->m_pesan->JmlOutbox($this->session->userdata('SESS_USER_ID'));?></span></a></li>
                    <li><a href="<?php echo site_url('pesan/sampah');?>"><i class="fa fa-trash-o"></i> Trash <span class="label label-warning pull-right"><?php echo $this->m_pesan->JmlTInbox($this->session->userdata('SESS_USER_ID'))+$this->m_pesan->JmlTOutbox($this->session->userdata('SESS_USER_ID'));?></span></a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Your Mail</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
				<div class="box-body text-center">
					<?php $inbox=$this->m_pesan->JmlInbox($this->session->userdata('SESS_USER_ID'));?>
					<?php $outbox=$this->m_pesan->JmlOutbox($this->session->userdata('SESS_USER_ID'));?>
					<?php $tinbox=$this->m_pesan->JmlTInbox($this->session->userdata('SESS_USER_ID'));?>
					<?php $toutbox=$this->m_pesan->JmlTOutbox($this->session->userdata('SESS_USER_ID'));?>
					<?php $all=$tinbox+$toutbox;?>
					<div class="progress progress-striped vertical">
					<?php if($all>'100'){ ?>
						<div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?php echo $inbox/10;?>%"></div>
					<?php }else{ ?>
						<div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?php echo $inbox;?>%"></div>
					<?php } ?>
					</div>
					<div class="progress vertical sm progress-striped active">
					<?php if($all>'100'){ ?>
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="height: <?php echo $all/10;?>%"></div>
					<?php }else{ ?>
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="height: <?php echo $all;?>%"></div>
					<?php } ?>
					</div>
					<div class="progress progress-striped vertical">
					<?php if($all>'100'){ ?>
						<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?php echo $outbox/10;?>%"></div>
					<?php }else{ ?>
						<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: <?php echo $outbox;?>%"></div>
					<?php } ?>
					</div>
				</div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
	<?php echo validation_errors();?>
	<?php echo $message;?>
	<?php $tgl= $this->jurnal_model->tgl_singkatan($this->jurnal_model->ambilDate($pesan['tgl'])); ?>
	<?php $jam= $this->jurnal_model->ambilJamMenit($this->jurnal_model->ambilTime($pesan['tgl'])); ?>
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
					<span class="mailbox-read-time pull-right"><?php echo $tgl;?> / <?php echo $jam;?></span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message">
                    <?php echo $pesan['pesan'];?>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
				<?php if($pesan['lampiran']==''){ ?>
				<?php }else{ ?>
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
                        <a href="<?php echo base_url();?>pesan/download/<?php echo $pesan['id'];?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo $pesan['lampiran'];?></a>
                        <span class="mailbox-attachment-size">
                          <?php echo $lampiran; ?> File
                          <a href="<?php echo base_url();?>pesan/download/<?php echo $pesan['id'];?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                  </ul>
				<?php } ?>
                </div><!-- /.box-footer -->
                <div class="box-footer">
				<?php if($this->uri->segment(2)=='baca'){ ?>
                  <a target="_blank" href="<?php echo site_url('pesan/cetak_in/'.$pesan['id']);?>" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
				<?php }else{ ?>
                  <a target="_blank" href="<?php echo site_url('pesan/cetak_out/'.$pesan['id']);?>" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
				<?php } ?>
                </div><!-- /.box-footer -->
				<div class="box-header bg-blue with-border">
					<i class="fa fa-mail-forward"></i>
					<?php if($pesan['dari']==$this->session->userdata('SESS_USER_ID')){ ?><h3 class="box-title">Tulis Pesan lagi kepada <?php echo $namakepada;?> - <?php echo $kotakepada;?></h3>
					<?php }else{ ?><h3 class="box-title">Balas Pesan kepada <?php echo $nama;?> - <?php echo $kota;?></h3>
					<?php } ?>
				</div>
<?php echo validation_errors();?>
<?php echo $message;?>
				<form action="" method="post" enctype="multipart/form-data">
                <div class="box-body">
					<div class="hidden">
						<input type="hidden" name="id" class="form-control" value="id" readonly="readonly"/>
						<input type="text" class="form-control" name="kepada" value="<?php if($pesan['dari']==$this->session->userdata('SESS_USER_ID')){ ?><?php echo $pesan['kepada'];?><?php }else{ ?><?php echo $pesan['dari'];?><?php } ?>" placeholder="Kepada"/>
					</div>
					<div class="form-group">
						<input name="judul" value="balas '<?php echo $pesan['judul'];?>'" class="form-control" placeholder="Subject:">
					</div>
					<div class="form-group">
						<textarea name="pesan" id="compose-textarea" class="form-control" placeholder="Isi Pesan:" style="height: 300px"></textarea>
					</div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="form-group pull-left">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Lampiran
					  <input type="file" name="lampiran"/>
                    </div>
                  </div>
                  <div class="pull-right">
                    <button id="kirim" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Kirim</button>
                  </div>
                </div><!-- /.box-footer -->
				</form>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->