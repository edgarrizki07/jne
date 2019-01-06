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
				<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
				$this->session->unset_userdata('SUCCESSMSG'); } ?>
        			<?php if($this->session->userdata('ADMIN') <='1'){ ?>
					<form class="form" action="" method="post" enctype="multipart/form-data" >
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Tambah/Edit <?php echo $title;?></h3>
                                </div>
                                <div class="box-body well">
                                        <!-- text input -->
										<div class="hidden">
                                            <label><strong>ID <?php echo $title;?></strong></label>
                                            <input name="id" type="text" class="form-control" value="id" required/>
										</div>

                                    <div class="row">
                                        <div class="col-lg-12">
											<div class="form-group">
												<div class="col-xs-3">
												<label><strong>Nama Akun</strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
													<?php if($this->uri->segment(3)=='0'){ ?>
													<input name="nama" type="text" class="form-control" value="" required/>
													<?php }else{ ?>
													<input name="nama" type="text" class="form-control" value="<?php echo $this->akun_model->NamaAkunStandar($this->uri->segment(3)); ?>" required/>
													<?php } ?>
												</div><!-- /input-group -->
											</div>
											<div class="form-group">
												<div class="col-xs-3">
												<label><strong>Kode</strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
													<?php if($this->uri->segment(3)=='0'){ ?>
													<input name="kode" type="text" class="form-control" value="" required/>
													<?php }else{ ?>
													<input name="kode" type="text" class="form-control" value="<?php echo $this->akun_model->KodeAkunStandar($this->uri->segment(3)); ?>" required/>
													<?php } ?>
												</div><!-- /input-group -->
											</div>
											<div class="form-group">
												<div class="col-xs-3">
												<label><strong>Sub Kategori</strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
                                                <?php $KategoriId=$this->akun_model->JenisAkunIdStandar($this->uri->segment(3));?>
                                                <select name="jenis_akun_id" id="jenis_akun_id" class="form-control" required>
												<?php if($this->uri->segment(3) == ''){  ?>
												<?php }else{  ?>
													<option value="<?php echo $KategoriId; ?>"><?php echo $this->akun_model->NamaJenis($KategoriId); ?></option>
												<?php } ?>
											<?php $this->db->order_by($order_column='kategori_id',$order_type='asc'); $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_jenis',array('id !='=>'0'));?>
											<?php $item = $sat->result(); ?>
											<?php $no=0; foreach($item as $row ): $no++;?>
                                                    <option value="<?php echo $row->id;?>"><?php echo ($this->akun_model->KelompokAkunKategori($row->kategori_id));?> - <?php echo $this->akun_model->NamaKelompok($this->akun_model->KelompokAkunKategori($row->kategori_id));?> - <?php echo $this->akun_model->NamaKategori($row->kategori_id);?> - <?php echo $row->nama;?></option>
											<?php endforeach;?>
                                                </select>
												</div><!-- /input-group -->
											</div>

                                        </div><!-- /.col-lg-6 -->
                                    </div><!-- /.row -->
                                        <!-- button -->
										<div class="text-center">
											<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah/Simpan</button>
											<a href="<?php echo site_url('kategori/standart');?>" class="btn btn-warning"><i class="fa fa-times"></i> Batal</a>
											<a href="<?php echo site_url('kategori/subkategori');?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Sub Kategori</a>
											<a href="<?php echo site_url('akun/add');?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Akun</a>
											<a href="<?php echo site_url('akun');?>" class="btn btn-primary"><i class="fa fa-list"></i> Daftar Akun</a>
											<a href="<?php echo site_url('kategori');?>" class="btn btn-primary"><i class="fa fa-list"></i> Daftar Kategori</a>
										</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
					</form>
        			<?php } ?>
				  </div><!-- /.row -->
				  <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Daftar <?php echo $title;?></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
											<tr>												
												<th>Kode</th>
												<th>Nama</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
											<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_kelompok',array('id !='=>'0'));?>
											<?php $item = $sat->result(); ?>
											<?php $no=0; foreach($item as $row ): $no++;?>
                                        <thead>
                                            <tr>
												<td><?php echo $row->id;?></td>
												<th><?php echo $row->nama;?></th>
												<th colspan="3"></th>
                                            </tr>
                                        </thead>
												<tbody>
													<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_kategori',array('kelompok_akun_id'=>$row->id));?>
													<?php $item = $sat->result(); ?>
													<?php $nom=0; foreach($item as $row1 ): $nom++;?>
													<tr>
														<td><?php echo $row->id;?>-<b><?php echo $row1->kode;?></b></td>
														<td><ol><?php echo $row1->nama;?></td>
														<td width="120">
														<?php if($this->session->userdata('ADMIN') <='1'){ ?>
															<a class="label label-success" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/editkategori/<?php echo $row1->id;?>'"> Edit</a>
														<?php } ?>
														</td>
													</tr>
														<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_jenis',array('kategori_id'=>$row1->id));?>
														<?php $item = $sat->result(); ?>
														<?php $nomer=0; foreach($item as $row2 ): $nomer++;?>
														<tr>
															<td><?php echo $row->id;?>-<?php echo $row1->kode;?> <b><?php echo $row2->kode;?></b></td>
															<td><ol><ol><?php echo $row2->nama;?></td>
															<td width="120">
															<?php if($this->session->userdata('ADMIN') <='1'){ ?>
																<a class="label label-success" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/edit/<?php echo $row2->id;?>'"> Edit</a>
															<?php } ?>
																<a class="label label-info" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/akun/<?php echo $row2->id;?>'"> Lihat</a>
															</td>
														</tr>
															<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_standar',array('cek'=>'0','jenis_akun_id'=>$row2->id));?>
															<?php $item = $sat->result(); ?>
															<?php $nomere=0; foreach($item as $row3 ): $nomere++;?>
															<tr>
																<td width="100"><?php echo $row->id;?>-<?php echo $row1->kode;?> <?php echo $row2->kode;?> <b><?php echo $row3->kode;?></b></td>
																<td><ol><ol><ol><?php echo $row3->nama;?></td>
																<td width="120">
																<?php if($this->session->userdata('ADMIN') <='1'){ ?>
																	<a class="label label-success" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/editstandart/<?php echo $row3->id;?>'"> Edit</a>
																<?php } ?>
																	<a class="label label-danger" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/hapusstandart/<?php echo $row3->id;?>'"> Hapus</a>
																</td>
															</tr>
															<?php endforeach;?>
														<?php endforeach;?>
													<?php endforeach;?>
												</tbody>
											<?php endforeach;?>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <!-- general form elements disabled -->
                        </div><!--/.col (right) -->
				  </div><!-- /.row -->
                </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
