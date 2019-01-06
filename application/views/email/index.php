			<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
					<div class="input-group-btn">
						<a href="<?php echo site_url('email/tulis');?>" class="btn btn-warning"><i class="fa fa-edit"></i><b> Tulis Email</b></a>
						<a href="<?php echo site_url('email');?>" class="btn btn-primary"><i class="fa fa-refresh"></i><b> Refresh</b></a>
					</div><!-- /btn-group -->
                    <ol class="breadcrumb">
                        <li class="active"><?php echo $title;?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<?php echo validation_errors(); echo $message;?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $title;?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>No</td>
            <td>ID</td>
			<td>Tanggal / Jam</td>
			<td>Dari -> Kepada</td>
            <td>Judul</td>
            <td>Isi Pesan</td>
            <td>Status</td>
            <td><i class="fa fa-paperclip"></i></td>
        </tr>
    </thead>
	<?php $this->db->order_by($order_column='id',$order_type='desc');
	$sat = $this->db->get('email'); $pesan = $sat->result(); ?>
    <?php $no=0; foreach($pesan as $row ): $no++; $tgl= $this->app_model->tgl_str($this->app_model->ambilDate($row->tgl)); ?>
	<?php $jam= $this->app_model->ambilTime($row->tgl); ?>
    <tr>
        <td><?php echo $no;?></td>
		<td><?php echo $row->id;?></br></td>
        <td><?php echo $tgl;?></br><?php echo $jam;?></td>
		<td>Dari : <?php echo $row->dari;?></br>Kepada : <?php echo $row->kepada;?></td>
        <td><?php echo $row->judul;?></td>
        <td><?php echo substr($row->pesan,0,150);?></td>
        <td><?php if($row->cek=='0'){ ?>Tidak Terkirim<?php }else{ ?>Terkirim<?php } ?></td>
        <td><?php if($row->lampiran==''){ ?><?php }else{ ?><i class="fa fa-paperclip"></i><?php } ?></td>
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