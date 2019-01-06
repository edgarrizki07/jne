<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
								<div class="form-group">
									<div class="col-xs-1">
										<label><strong>Harga</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><input name="cek_harga" value="1" type="checkbox" checked> <b>Include</b></span>
										<span class="input-group-addon"> Rp </span>
									<input name="harga" type="text" class="form-control" required/>
										<span class="input-group-addon"> / Ltr </span>
										<span class="input-group-addon"> <b>Jumlah</b> </span>
									<input name="jml" type="text" class="form-control" required/>
										<span class="input-group-addon"> / Ltr </span>
									</div>
									<p align="center"><b>untuk input desimal Gunakan titik "." contoh : 9725.55 </b></p>
								</div>
								<div class="form-group">
									<div class="col-xs-1">
										<label><strong>Pajak</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon">
										<input name="ppn" value="1" type="checkbox" checked> <b>PPN</b>
										</span>
										<input name="nppn" type="text" class="form-control" value="10" readonly="readonly"/>
										<span class="input-group-addon"> 10 % </span>
										<span class="input-group-addon">
										<input name="pph" value="1" type="checkbox" checked> <b>PPH</b>
										</span>
										<input name="npph" type="text" class="form-control" value="0.3" readonly="readonly"/>
										<span class="input-group-addon"> 0,3 % </span>
										<span class="input-group-addon">
										<input name="pbbkb" value="1" type="checkbox" > <b>PBBKB</b>
										</span>
										<input name="npbbkb" type="text" class="form-control" value="<?php echo $this->pajak_model->PbbkbCabang($this->session->userdata('SESS_WP_ID'));?>"  placeholder="Nilai PBBKB "/>
										<span class="input-group-addon"> % </span>
									</div>
									<p align="center"><b>apabila tanpa pajak (PPN/PBBKB/PPH) hilangkan cek diatas ini.</b></p>
								</div>
						  <h2 class="page-header"></h2>
								<div class="form-group col-md-12">
									<div class="input-group">
											<span class="input-group-addon"><b> Tgl PO </b></span>
										<input type="text" name="tgl" id="datepicker-tgl" value="<?php echo $tgl;?>" class="form-control"/>
											<span class="input-group-addon"><b> SH </b></span>
										<input type="text" name="sh" class="form-control"/>
											<span class="input-group-addon"><b> SP </b></span>
										<input type="text" name="sp" class="form-control"/>
											<span class="input-group-addon"><b> Metode </b></span>
										<select name="term" class="form-control" required>
											<option value="Loco">Loco</option>
											<option value="Franco">Franco</option>
										</select>
											<span class="input-group-addon"><b> Storage </b></span>
										<select name="storage" class="form-control" required>
											<option value="0">Gudang Utama</option>
											<option value="1">Gudang Cadangan</option>
											<option value="2">Supplier</option>
											<option value="3">Other Storage</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<label><strong>Supplier</strong></label>
								</div>
								<div class="form-group col-md-10">
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-truck"></i></div>
										<select name="supplier_id" class="form-control select2" required>
											<option> - Pilih Supplier - </option>
										<?php $this->db->order_by($order_column='nama',$order_type='asc'); ?>
										<?php $cust = $this->db->get_where('supplier',array('cek'=>'0','wp_id'=>$this->session->userdata('SESS_WP_ID'))); $item = $cust->result(); $no=0; foreach($item as $row ): $no++;?>
											<option value="<?php echo $row->id;?>"><?php echo $row->nama;?></option>
										<?php endforeach;?>
										</select>
										<span class="input-group-btn">
										  <a href="<?php echo site_url('supplier/tambah');?>" class="btn btn-info btn-flat" type="button">Tambah Supplier</a>
										</span>
									</div>
								</div>
								<div class="col-md-2">
									<label><strong>Transportir</strong></label>
								</div>
								<div class="form-group col-md-10">
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-truck"></i></div>
										<select name="transportir" class="form-control select2" required>
											<option> - Pilih Transportir - </option>
										<?php $supp = $this->db->get_where('transportir',array('wp_id'=>$this->session->userdata('SESS_WP_ID'))); $item = $supp->result(); $no=0; foreach($item as $row ): $no++;?>
											<option value="<?php echo $row->id;?>"><?php echo $no;?>. <?php echo $row->nama;?></option>
										<?php endforeach;?>
										</select>
										<span class="input-group-btn">
										  <a href="<?php echo site_url('transportir/tambah');?>" class="btn btn-info btn-flat" type="button">Tambah Transportir</a>
										</span>
									</div>
								</div>
							</div>
						</div><!-- /.row -->
					</div><!-- /.box-body -->
					<div class="box-body">
						<div class="row">
							<div class="text-center">
								<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
								<a href="<?php echo site_url('beli');?>"><button type="button" class="btn btn-primary"><i class="fa fa-undo"></i> BATAL</button></a>
							</div>
						</div><!-- /.row -->
					</div>
				</div><!-- /.box -->
			</div><!--/.col (right) -->
		</div>
	</section><!-- /.content -->
</form>
</div><!-- /.content-wrapper -->
