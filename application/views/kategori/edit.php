      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>
		<section class="content-header">
			<div class="input-group-btn">
			</div><!-- /btn-group -->
		</section>

		<!-- Main content -->
		<section class="content">
			<form class="form" action="" method="post" enctype="multipart/form-data" >
					<?php echo validation_errors(); echo $message;?>
                        <div class="col-md-6">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-body">
                                        <!-- text input -->
                                        <div class="hidden">
                                            <label><strong>ID <?php echo $title;?></strong></label>
                                            <input name="id" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Nama Kategori</strong></label>
                                            <input name="nama" type="text" class="form-control" value="<?php echo $info['nama'];?>" required/>
                                        </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <div class="col-md-6">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-body">
									<div class="form-group">
										<label><strong>Kelompok Akun</strong></label>
										<?php $KelompokId=$this->akun_model->KelompokAkunKategori($this->uri->segment(3));?>
										<select name="kelompok_akun_id" id="kelompok_akun_id" class="form-control" required>
										<?php if($this->uri->segment(3) == ''){  ?>
										<?php }else{  ?>
											<option value="<?php echo $KelompokId; ?>"><?php echo $this->akun_model->NamaKelompok($KelompokId); ?></option>
										<?php } ?>
									<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('kelompok_akun',array('id !='=>'0'));?>
									<?php $item = $sat->result(); ?>
									<?php $no=0; foreach($item as $row ): $no++;?>
											<option value="<?php echo $row->id;?>"><?php echo $row->id;?> - <?php echo $row->nama;?></option>
									<?php endforeach;?>
										</select>
									</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-body">
										<div class="text-center">
											<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
											<a href="<?php echo site_url('kategori/tambah');?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Kategori</a>
											<a href="<?php echo base_url();?>kategori/"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
											<i class="fa fa-undo"></i> KEMBALI</button></a>
										</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
			</form>
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
												<th>No</th>
												<th>Nama</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
											<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('kelompok_akun',array('id !='=>'0'));?>
											<?php $item = $sat->result(); ?>
											<?php $no=0; foreach($item as $row ): $no++;?>
                                        <thead>
                                            <tr>
												<th width="10"><?php echo $no;?></th>
												<th><?php echo $row->nama;?></th>
												<th colspan="4"></th>
                                            </tr>
                                        </thead>
												<tbody>
													<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('kategori_akun',array('kelompok_akun_id'=>$row->id));?>
													<?php $item = $sat->result(); ?>
													<?php $nom=0; foreach($item as $row1 ): $nom++;?>	
													<tr>
														<td width="10"><?php echo $no;?>.<?php echo $nom;?></td>
														<td><?php echo $row1->nama;?></td>
														<td width="120">
														<?php if($this->session->userdata('ADMIN') <='1'){ ?>
															<a class="label label-success" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/editkategori/<?php echo $row1->id;?>'"> Edit</a>
														<?php } ?>
														</td>
													</tr>
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
      </div>
