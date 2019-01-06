<script type="text/javascript">
$(document).ready(function(){

	$("#nama").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kode").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kota").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#provinsi").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#namarek").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
		
});	
</script>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Tambah <?php echo $title; ?> <?php echo $no; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Tambah <?php echo $title; ?> <?php echo $nocab; ?></li>
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
				<div class="col-md-8">
					<!-- general form elements disabled -->
					<div class="box box-warning">
						<div class="box-body">
								<!-- text input -->
								<div class="hidden">
									<label><strong>ID <?php echo $title;?></strong></label>
									<input name="id" type="text" class="form-control" value="<?php echo $no; ?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Nama</strong></label>
									<input name="nama" id="nama" type="text" maxlength="100" class="form-control" value="" required/>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>NPWP</b> </span>
									<input name="npwp" type="text" class="form-control" value="" required/>
									<span class="input-group-addon"> <b>Kode</b> </span>
									<input name="kode" id="kode" maxlength="10" type="text" class="form-control" value="" required/>
									<span class="input-group-addon"> <b>PBBKB</b> </span>
									<input name="pbbkb" type="text" class="form-control" value="" required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Alamat</strong></label>
									<input name="alamat" maxlength="80" type="text" class="form-control" value="" required/>
									<input name="alamat1" maxlength="80" type="text" class="form-control" value=""/>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>Kelurahan</b> </span>
									<input name="kelurahan" maxlength="80" type="text" class="form-control" value="" required/>
									<span class="input-group-addon"> <b>Kecamatan</b> </span>
									<input name="kecamatan" maxlength="80" type="text" class="form-control" value="" required/>
									</div>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>Kota</b> </span>
									<input name="kota" id="kota" maxlength="80" type="text" class="form-control" value="" required/>
									<span class="input-group-addon"> <b>Provinsi</b> </span>
									<input name="provinsi" id="provinsi" maxlength="80" type="text" class="form-control" value="" required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Email Utama</strong></label>
									<input name="email" maxlength="80" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Email (Note PO)</strong></label>
									<input name="email1" maxlength="80" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Email (Penawaran)</strong></label>
									<input name="email2" maxlength="80" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Bank</strong></label>
									<input name="bank" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>Nama Rekening</b> </span>
									<input name="namarek" id="namarek" type="text" class="form-control" value="" required/>
									<span class="input-group-addon"> <b>No Rekening</b> </span>
									<input name="rekening" type="text" class="form-control" value="" required/>
									</div>
								</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!--/.col (right) -->
				<div class="col-md-4">
					<!-- general form elements disabled -->
					<div class="box box-warning">
						<div class="box-body">
								<div class="form-group">
									<label><strong>No Telp</strong></label>
									<input name="telp" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Fax</strong></label>
									<input name="fax" type="text" class="form-control" value=""/>
								</div>
								<div class="form-group">
									<label><strong>Pemilik</strong></label>
									<input name="pemilik" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Kepala</strong></label>
									<input name="kepala" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Keuangan</strong></label>
									<input name="keuangan" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Pembelian</strong></label>
									<input name="pembelian" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Penjualan</strong></label>
									<input name="penjualan" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Operasional</strong></label>
									<input name="operasional" type="text" class="form-control" value="" required/>
								</div>
								<div class="form-group">
									<label><strong>Pemasaran</strong></label>
									<input name="pemasaran" type="text" class="form-control" value="" required/>
								</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!--/.col (right) -->
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="box box-warning">
						<div class="box-body">
							<div class="form-group">
								<label><strong>Keterangan</strong></label>
								<input name="keterangan" type="text" class="form-control" value=""/>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
								<a href="<?php echo base_url();?>cabang"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
								<i class="fa fa-undo"></i> KEMBALI</button></a>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!--/.col (right) -->
			</form>
                </section><!-- /.content -->
	<div class="clearfix"></div>
      </div>
				<!-- end Page Right Column -->