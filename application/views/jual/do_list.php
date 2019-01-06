            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="input-group-btn">
                        <a class="btn btn-warning" href="<?php echo site_url('jual');?>"><i class="fa fa-file"></i> Daftar Penjualan</a>
                        <a class="btn btn-danger" href="<?php echo site_url('jual/do_cancel');?>"><i class="fa fa-file"></i> Daftar DO telah dihapus</a>
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
                                    <i class="fa fa-list"></i><h3 class="box-title"> List of Delivery Order </h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
        			<?php if($this->session->userdata('ADMIN')=='1'){ ?>
												<th>Cabang</th>
        			<?php } ?>
												<th>Status</th>
												<th>ID</th>
												<th>Sold to</th>
												<th>Total Delivered Sisa</th>
												<th>Ship Date</th>
    											<th>Terminal Loading</th>
    											<th>Storage</th>
    											<th>Kendaraan</th>
    											<th>Capacity Quantity</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php $this->db->order_by($order_column='id',$order_type='desc'); if($this->uri->segment(3)==''){ }else{$this->db->where('tglkirim', $this->uri->segment(3)); }?>
				<?php if($this->session->userdata('ADMIN')=='1'){ ?><?php }else{ ?><?php $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); ?><?php } ?>
				<?php $jual = $this->db->get_where('do',array('cek'=>'0')); $dorder = $jual->result();?>
				<?php $no=0; foreach($dorder as $row ): $no++;?>
				<?php $item = '1'; $jml=$row->volume;?>
                                            <tr>
												<td><?php echo $no;?></td>
											<?php if($this->session->userdata('ADMIN')=='1'){ ?>
												<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?><br>create by : <?php echo $this->user_model->NamaUser($row->login_id);?></td>
											<?php } ?>
												<td><?php if($row->status =='0'){ ?>ACC<?php }else{ ?>Blm ACC<?php } ?><br>by : <?php if($row->admin_id =='0'){ ?>Blm Acc<?php }else{ ?><?php echo $this->user_model->NamaUser($row->admin_id);?><?php } ?></td>
												<td><?php echo $row->nodo;?><br><?php echo $row->id_jual;?>/<?php echo $row->id_do;?></td>
												<td><?php $customer = $this->bbm_model->CustomerJual($row->id_jual) ;?> <strong><?php echo $this->customer_model->NamaCustomer($customer);?></strong></td>
												<td><?php $sell = $this->bbm_model->JmlJual($row->id_jual) ; echo $sell;?> L <br><?php $delivered = $this->bbm_model->DeliveredDO($row->id_jual) ; echo number_format ($delivered, 0, ',', '.');?> L <br><?php $sisa = $sell-$delivered ; echo  number_format ($sisa, 0, ',', '.');?> L</td>
												<td><?php echo $this->jurnal_model->tgl_string($row->tglkirim);?><br><?php echo $this->jurnal_model->ambilDate($row->tgldo);?></td>
												<td><?php echo $row->terminal_loading;?></td>
												<td><?php if($row->storage =='0'){ ?>Gudang Utama<?php } else if($row->storage =='1'){ ?>Gudang Cadangan<?php } else if($row->storage =='2'){ ?>On Supplier<?php } else if($row->storage =='3'){ ?>Other Storage<?php } ?></td>
												<td><?php echo $row->angkutan;?></td>
												<td><?php echo $row->capacity;?> L<br><?php echo $row->volume;?> L</td>
												<td align="center">
													<a title="lihat DO" href="<?php echo site_url('jual/view_do/'.$row->id);?>" class="btn btn-primary btn-xs" >
													<i class='fa fa-print'></i> Lihat </a>
													<a title="Hapus DO" href="<?php echo base_url();?>index.php/jual/hapusdo/<?php echo $row->id;?>" class="btn btn-danger btn-xs" 
													onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i></a>
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

