<script type="text/javascript" src="<?php echo base_url();?>js/jurnal.js"></script>
			<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $title;?> Nomor : <b>INV-<?php echo $no;?></b><br><small> Bill To : <?php $customer = $this->bbm_model->CustomerJual($this->uri->segment(3)) ;?> <b><?php echo $this->customer_model->NamaCustomer($customer);?></b> Sebanyak : <b><?php echo $this->bbm_model->JmlJual($this->uri->segment(3)) ;?> L</b></small>
                    </h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
			<form class="form" action="" method="post" enctype="multipart/form-data" >
			<!-- text input -->
			<div class="hidden">
				<label><strong>ID <?php echo $title;?></strong></label>
				<input name="id" type="text" class="form-control" value="ID" required/>
				<label><strong>Kode <?php echo $title;?></strong></label>
				<input name="id_jual" type="text" class="form-control" value="<?php echo $no;?>" required/>
			</div>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
								<div class="box-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>Harga</strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"><input name="cek_harga" value="1" type="checkbox" checked> <b>Include</b></span>
													<span class="input-group-addon"> Rp </span>
												<input name="harga" type="text" class="form-control" required/>
													<span class="input-group-addon"> / Ltr </span>
												</div>
												<p align="center"><b>untuk input desimal Gunakan titik "." contoh : 9725.55 </b></p>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>Pajak</strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon">
													<input name="ppn" value="1" type="checkbox" checked> <b>PPN</b>
													</span>
													<input name="nppn" type="text" class="form-control" value="10" readonly="readonly"/>
													<span class="input-group-addon"> 10 % </span>
													<span class="input-group-addon">
													<input name="pph" value="1" type="checkbox"> <b>PPH</b>
													</span>
													<input name="npph" type="text" class="form-control" value="0.3" readonly="readonly"/>
													<span class="input-group-addon"> 0,3 % </span>
													<span class="input-group-addon">
													<input name="pbbkb" value="1" type="checkbox"> <b>PBBKB</b>
													</span>
													<input name="npbbkb" type="text" class="form-control" value="<?php echo $this->pajak_model->PbbkbCabang($this->session->userdata('SESS_WP_ID'));?>"  placeholder="Nilai PBBKB "/>
													<span class="input-group-addon"> % </span>
												</div>
												<p align="center"><b>apabila tanpa pajak (PPN/PBBKB/PPH) hilangkan cek diatas ini.</b></p>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>Beban Transport */Ltr</strong></label> (dalam invoice)
												</div>
												<div class="input-group">
													<span class="input-group-addon"> Rp </span>
													<input name="ohp" type="text" class="form-control"/>
													<span class="input-group-addon"> / Ltr  +  <input name="ppnohp" value="1" type="checkbox"> PPN 10 % </span>
												</div>
											</div>
									  <h2 class="page-header"></h2>
										</div>
									</div><!-- /.row -->
								</div><!-- /.box-body -->
                                <div class="box-body">
									<div class="row">
										<div class="text-center">
											<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
											<a href="<?php echo site_url('jual/add_invoice');?>" class="btn btn-primary" ><i class="fa fa-undo"></i> BATAL</a>
											<a href="<?php echo site_url('jual/delivery_order/'.$this->uri->segment(3));?>" class="btn btn-primary"><i class="fa fa-undo"></i> KEMBALI KE DO</a>
										</div>
									</div><!-- /.row -->
								</div>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>
                </section><!-- /.content -->
			</form>
            </aside><!-- /.right-side -->
				<!-- end Page Right Column -->