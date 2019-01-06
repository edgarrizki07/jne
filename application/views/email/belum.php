			<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
					<div class="input-group-btn">
						<a href="<?php echo site_url('email/auto');?>" class="btn btn-warning"><i class="fa fa-random"></i><b> Auto Email</b></a>
						<a href="<?php echo site_url('email/import');?>" class="btn btn-primary"><i class="fa fa-sign-in"></i><b> Import Data</b></a>
						<a href="<?php echo site_url('email/export');?>" class="btn btn-primary"><i class="fa fa-sign-out"></i><b> Export Data</b></a>
						<a href="<?php echo site_url('email');?>" class="btn btn-warning"><i class="fa fa-undo"></i><b> Kembali</b></a>
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
			<td>Email</td>
            <td>Status</td>
            <td>Proses</td>
        </tr>
    </thead>
	<?php $uri3 = $this->uri->segment(3); ?>
	<?php $this->db->order_by($order_column='id',$order_type='desc');
	$sat = $this->db->get_where('emailauto',array('cek'=>'0')); $pesan = $sat->result(); ?>
    <?php $no=0; foreach($pesan as $row ): $no++;?>
    <tr>
        <td><?php echo $no;?></td>
		<td><?php echo $row->id;?></br></td>
		<td><?php echo $row->email;?></br></td>
        <td><?php if($row->status=='0'){ ?>Tidak Terkirim<?php }else{ ?>Terkirim<?php } ?></td>
        <td><?php if($row->cek=='0'){ ?>Belum<?php }else{ ?>Sudah<?php } ?></td>
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