<script type="text/javascript">
$(document).ready(function(){

	$("#nama").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kode").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kota").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#provinsi").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#depo").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#rekening").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
		
});	
</script>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Edit <?php echo $title; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Edit <?php echo $title; ?></li>
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
                                            <label><strong>Nama Perusahaan <?php echo $title;?></strong></label>
                                            <input name="nama" id="nama" maxlength="80" type="text" class="form-control" value="<?php echo $info['nama'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>NPWP <?php echo $title;?></strong></label>
                                            <input name="npwp" type="text" class="form-control" value="<?php echo $info['npwp'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Alamat</strong></label>
                                            <input name="alamat" maxlength="80" type="text" class="form-control" value="<?php echo $info['alamat'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Kota</strong></label>
                                            <input name="kota" id="kota" maxlength="80" type="text" class="form-control" value="<?php echo $info['kota'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Provinsi</strong></label>
                                            <input name="provinsi" id="provinsi" maxlength="80" type="text" class="form-control" value="<?php echo $info['provinsi'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input name="email" maxlength="50" type="text" class="form-control" value="<?php echo $info['email'];?>" required/>
                                        </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <div class="col-md-6">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-body">
                                        <div class="form-group">
                                            <label><strong>Kode</strong></label>
                                            <input name="kode" id="kode" maxlength="10" type="text" class="form-control" value="<?php echo $info['kode'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Status</strong></label>
											<select name="status" class="form-control" required>
												<option value="<?php echo $info['status'];?>"><?php echo $info['status'];?></option>
												<option value="Cabang">Cabang</option>
												<option value="Pusat">Pusat</option>
											</select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>No Telp</strong></label>
                                            <input name="telp" maxlength="30" type="text" class="form-control" value="<?php echo $info['telp'];?>" required/>
                                        </div>
										<div class="form-group">
											<label><strong>No Fax</strong></label>
											<input name="fax" maxlength="20" type="text" class="form-control" value="<?php echo $info['fax'];?>" required/>
										</div>
                                        <div class="form-group">
                                            <label><strong>Kontak Person</strong></label>
                                            <input name="cp" maxlength="30" type="text" class="form-control" value="<?php echo $info['cp'];?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>HP</strong></label>
                                            <input name="hp" maxlength="20" type="text" class="form-control" value="<?php echo $info['hp'];?>" required/>
                                        </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-body">
									<div class="form-group">
										<label><strong>Alamat Depo</strong></label>
										<input name="depo" id="depo" type="text" class="form-control" value="<?php echo $info['depo'];?>" required/>
									</div>
									<div class="form-group">
										<label><strong>Rekening</strong></label>
										<input name="rekening" id="rekening" type="text" class="form-control" value="<?php echo $info['rekening'];?>" required/>
									</div>
									<div class="form-group">
										<label><strong>Keterangan</strong></label>
										<input name="keterangan" type="text" class="form-control" value="<?php echo $info['keterangan'];?>" required/>
									</div>
									<div class="text-center">
										<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
										<a href="<?php echo base_url();?>supplier/tambah"><button type="button" name="tambah_data" id="tambah_data" class="btn btn-success">
										<i class="fa fa-plus"></i> TAMBAH BARU</button></a>
										<a href="<?php echo base_url();?>supplier/"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
										<i class="fa fa-undo"></i> KEMBALI</button></a>
									</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
			</form>
		</section><!-- /.content -->
	<div class="clearfix"></div>
      </div>