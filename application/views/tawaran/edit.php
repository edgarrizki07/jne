<script type="text/javascript" src="<?php echo base_url();?>js/jurnal.js"></script>
      <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Buat <?php echo $title;?> Nomor : <?php echo $no;?>.<?php echo date('d');?>/PO/<?php echo $this->pajak_model->KodeCabang($this->session->userdata('SESS_WP_ID'));?>/<?php echo date('m');?>/<?php echo date('Y');?>
                    </h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
			<form class="form" action="" method="post" enctype="multipart/form-data" >
			<div class="hidden">
				<label><strong>ID <?php echo $title;?></strong></label>
				<input name="id" type="text" class="form-control" value="ID" required/>
				<label><strong>Kode <?php echo $title;?></strong></label>
				<input name="id_beli" type="text" class="form-control" value="<?php echo $no;?>" required/>
			</div>
                <section class="content">
					<?php echo validation_errors(); echo $message;?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning">
                                <div class="box-body">
									<div class="row">
										<div class="col-lg-12">
									  <h2 class="page-header">Head</h2>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>Tgl Penawaran</strong></label>
												</div>
												<div class="input-group">
													<input type="text" name="tgl" id="datepicker-tgl"  value="<?php echo $tgl;?>" class="form-control"/>
														<span class="input-group-addon"> Lampiran </span>
													<select name="lampiran" class="form-control" required>
														<option value="2 Lembar">2 Lembar</option>
														<option value="1 Lembar">1 Lembar</option>
														<option value="2 Lembar">2 Lembar</option>
														<option value="3 Lembar">3 Lembar</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>Perihal</strong></label>
												</div>
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-truck"></i></div>
													<input name="termbyr" type="text" class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>Customer</strong></label>
												</div>
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-truck"></i></div>
													<select name="supplier_id" class="form-control" required>
													<option></option>
												<?php $supp = $this->db->get_where('supplier',array('wp_id'=>$this->session->userdata('SESS_WP_ID')));?>
												<?php $item = $supp->result(); ?>
												<?php $no=0; foreach($item as $row ): $no++;?>
													<option value="<?php echo $row->id;?>"><?php echo $row->nama;?> (<?php echo $row->cp;?>)</option>
												<?php endforeach;?>
													</select>
														<span class="input-group-addon"> Tambah Calon Customer</span>
													<input name="termbyr" type="text" class="form-control"/>
												</div>
											</div>
									  <h2 class="page-header">Isi Penawaran</h2>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>1. Harga</strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> Rp </span>
												<input name="harga1" type="text" class="form-control" required/>
													<span class="input-group-addon"> / Ltr </span>
													<span class="input-group-addon">
													<input name="ppn" value="1" type="checkbox" checked> <b>PPN</b>
													</span>
													<input name="nppn" type="text" class="form-control" value="10" readonly="readonly"/>
													<span class="input-group-addon"> 10 % </span>
													<span class="input-group-addon">
													<input name="pbbkb" value="1" type="checkbox"> <b>PBBKB</b>
													</span>
													<input name="npbbkb" type="text" class="form-control" value="<?php echo $this->pajak_model->PbbkbCabang($this->session->userdata('SESS_WP_ID'));?>"  placeholder="Nilai PBBKB "/>
													<span class="input-group-addon"> % </span>
													<span class="input-group-addon">
													<input name="pph" value="1" type="checkbox"> <b>PPH</b>
													</span>
													<input name="npph" type="text" class="form-control" value="0.3" readonly="readonly"/>
													<span class="input-group-addon"> 0,3 % </span>
												</div>
												<p align="right"><b>apabila tanpa pajak (PPN/PBBKB/PPH) hilangkan cek diatas ini.</b></p>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>2. </strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
													<input type="text" name="isi2" value="Spesifikasi BBM sesuai dengan standarisasi Dirjen Migas." class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>3. </strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
													<input type="text" name="isi3" value="Pengiriman dilakukan maksimal 2 (dua) hari setelah Purchase Order (PO) diterima." class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>4. </strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
													<input type="text" name="isi4" value="Toleransi susut yang berlaku 0.5%" class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>5. </strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> Pembayaran </span>
													<input type="text" name="isi5" size="5" value="COD" class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
												</div>
												<div class="input-group">
													<span class="input-group-addon"> Bank </span>
													<input type="text" name="isi5" value="<?php echo $this->pajak_model->RekeningCabang($this->session->userdata('SESS_WP_ID'));?>" class="form-control"/>
												</div>
											</div>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>6. </strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
													<input type="text" name="isi6" value="Untuk Informasi lebih lanjut dapat menhubungi <b>Bapak Taufan (0821-3650-7575)</b>" class="form-control"/>
												</div>
											</div>
									  <h2 class="page-header"></h2>
											<div class="form-group">
												<div class="col-xs-2">
													<label><strong>Tembusan</strong></label>
												</div>
												<div class="input-group">
													<span class="input-group-addon"> : </span>
													<textarea id="editor1" name="tembusan" type="text" class="form-control" />- Direktur Utama (adienergy@jagadgroup.net)<br>- Direktur Marketing(arif.jne@jagadgroup.net)</textarea>
												</div>
											</div>
										</div>
									</div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <div class="box-body">
									<div class="row">
										<div class="text-center">
											<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
											<a href="<?php echo site_url('beli');?>"><button type="button" class="btn btn-primary">
											<i class="fa fa-undo"></i> KEMBALI</button></a>
										</div>
									</div><!-- /.row -->
								</div>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>
                </section><!-- /.content -->
			</form>
</div><!-- /.content-wrapper -->
