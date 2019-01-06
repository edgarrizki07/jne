            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="input-group-btn">
                        <a class="btn btn-warning" href="<?php echo site_url('jual');?>"><i class="fa fa-file"></i> Invoice</a>
                        <a target="_blank" href="<?php echo site_url('jual/add_do/'.$this->uri->segment(3));?>" class="btn btn-primary"><i class="fa fa-plus"></i><b> Tambah <?php echo $title;?></b></a>
                    </div><!-- /btn-group -->
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
                                <div class="box-header">
                                    <i class="fa fa-file"></i>
                                    <h3 class="box-title"> Delivery Order</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>Nomor</th>
												<th>Tanggal</th>
        			<?php if($this->session->userdata('ADMIN')=='1'){ ?>
												<th>Cabang</th>
        			<?php } ?>
    											<th>Transportir</th>
    											<th>Kendaraan</th>
    											<th>Muatan</th>
    											<th>Driver</th>
												<th>Action</th>
												<th>Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php if($this->session->userdata('ADMIN')=='1'){ ?>
				<?php $jual = $this->db->get_where('do',array('cek'=>'0','id_jual'=>'0')); $dorder = $jual->result();?>
				<?php }else{ ?>
				<?php $jual = $this->db->get_where('do',array('cek'=>'0','id_jual'=>'0','wp_id'=>$this->session->userdata('SESS_WP_ID'))); $dorder = $jual->result();?>
				<?php } ?>
				<?php $no=0; foreach($dorder as $row ): $no++;?>
				<?php $item = '1'; $jml=$row->volume;?>
                                            <tr>
												<td><?php echo $no;?></td>
												<td><a><?php echo $row->nodo;?>/PO/<?php echo $this->pajak_model->KodeCabang($row->wp_id);?></a></td>
												<td><?php echo $this->app_model->tgl_str($row->tgldo);?></td>
											<?php if($this->session->userdata('ADMIN')=='1'){ ?>
												<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
											<?php } ?>
												<td><?php echo $row->armada;?></td>
												<td><?php echo $row->angkutan;?></td>
												<td>HSD / <?php echo $row->volume;?> L</td>
												<td><?php echo $row->driver;?></td>
												<td align="center">
													<div class="btn-group-vertical">
														<a title="lihat DO" href="<?php echo site_url('jual/view_do/'.$row->id);?>" class="btn btn-primary btn-xs" >
														<i class='fa fa-print'></i> Lihat </a>
														<a title="Hapus DO" href="<?php echo base_url();?>index.php/jual/hapusdo/<?php echo $row->id;?>" class="btn btn-danger btn-xs" 
														onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus </a>
													</div>
												</td>
												<td align="center">
													<div class="btn-group-vertical">
													<?php if($row->id_jual=='0'){ ?>
														<?php if($this->session->userdata('SESS_WP_ID')==$row->wp_id){ ?>
														<a title="Tambah Invoice" href="<?php echo site_url('jual/add_out/'.$row->id);?>" class="btn btn-success btn-xs" >
														<i class='fa fa-plus'></i> Tambah Invoice </a>
														<?php } ?>
													<?php }else{ ?>
														<a title="lihat Invoice" href="<?php echo site_url('jual/view/'.$row->id_jual);?>" class="btn btn-info btn-xs" >
														<i class='fa fa-file'></i> Lihat Invoice </a>
													<?php } ?>
													</div>
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
            </aside><!-- /.right-side -->

