<?php $inbox=$this->m_pesan->JmlInbox($this->session->userdata('SESS_USER_ID'));?>
<?php $outbox=$this->m_pesan->JmlOutbox($this->session->userdata('SESS_USER_ID'));?>
<?php $binbox = $this->m_pesan->JmlBInbox($this->session->userdata('SESS_USER_ID'));?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inbox
            <small><?php echo $binbox;?> new messages</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
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
				<?php
					if($this->session->userdata('SUCCESSMSG')) {
						echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>";
						$this->session->unset_userdata('SUCCESSMSG');
					}
				?>
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      Showing 1-<?php echo $inbox;?> / Unread <?php echo $binbox;?> / All <?php echo $inbox;?>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <thead>
						<tr>
                          <th>Read</th>
                          <th width="170">From</th>
                          <th>Messages</th>
                          <th width="20"></th>
                          <th width="150"></th>
                          <th width="20"><button class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i></button></th>
                        </tr>
                      </thead>
                      <tbody>
					<?php $this->db->order_by('id', 'desc'); $mail = $this->db->get_where('pesan',array('cekdari'=>'0','kepada'=>$this->session->userdata('SESS_USER_ID'))); $text = $mail->result(); $no=0; foreach($text as $row ): $no++;?>
					<?php $tgl= $this->jurnal_model->tgl_singkatan($this->jurnal_model->ambilDate($row->tgl)); ?>
					<?php $jam= $this->jurnal_model->ambilJamMenit($this->jurnal_model->ambilTime($row->tgl)); ?>
					<?php if($row->bdari=='0'){ ?>
						<tr class="unread">
					<?php }else{ ?>
						<tr>
					<?php } ?>
						  <td>
						  <?php if($row->bdari=='0'){ ?>
							<i class="fa fa-eye-slash" title="unread"></i> <i class="text-red"> New</i>
						  <?php }else{ ?>
							<i class="fa fa-eye" title="read <?php echo $row->btgl;?>"></i>
						  <?php } ?>
						  </td>
                          <td width="170" class="mailbox-name"><a href="<?php echo site_url('pesan/baca/'.$row->id);?>"><?php echo $this->user_model->NamaUser($row->dari);?> <?php echo $this->user_model->NamaBUser($row->dari);?></a></td>
                          <td class="mailbox-subject"><b><?php echo substr($row->judul,0,20);?></b> - <?php echo substr($row->pesan,0,40);?></td>
                          <td width="20" class="mailbox-attachment"><a title="download lampiran : <?php echo $row->lampiran;?>" style="cursor: pointer;" onclick="location.href=('<?php echo base_url();?>pesan/download/<?php echo $row->id;?>');"><?php if($row->lampiran==''){ ?><?php }else{ ?><i class="fa fa-paperclip"></i><?php } ?></a></td>
                          <td width="150" class="mailbox-date"><?php echo $tgl;?> / <?php echo $jam;?></td>
						  <td width="20" class="mailbox-star" align="center"><a title="Hapus" href="<?php echo base_url();?>pesan/hapus_inbox/<?php echo $row->id;?>" class="btn btn-default btn-xs" onClick="return confirm('Anda yakin ingin menghapus pesan ini?')"> <i class='fa fa-trash-o'></i></a></td>
                        </tr>
					<?php endforeach;?>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->