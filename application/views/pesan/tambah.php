      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tulis Pesan
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tulis Pesan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="<?php echo site_url('pesan/masuk');?>" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
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
                <div class="box-header with-border">
                  <h3 class="box-title">Tulis Pesan</h3>
                </div><!-- /.box-header -->
<?php echo validation_errors();?>
<?php echo $message;?>
				<form action="" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
					<input type="hidden" name="id" class="form-control" value="id" readonly="readonly"/>
                    <select name="kepada" class="form-control select2" multiple="multiple" data-placeholder="To:" style="width: 100%;">
					<?php $sup = $this->db->get_where('login',array('aktif'=>'1','id !='=>$this->session->userdata('SESS_USER_ID'))); $item = $sup->result(); $no=0; foreach($item as $row ): $no++;?>
						<option value="<?php echo $row->id;?>"><?php echo $row->nama_depan;?> <?php echo $row->nama_belakang;?> : <?php echo $row->email;?></option>
					<?php endforeach;?>
                    </select>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <input name="judul" class="form-control" placeholder="Subject:">
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
