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
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="box box-warning">
						<div class="box-body">
							<div class="hidden">
								<label><strong>ID <?php echo $title;?></strong></label>
								<input name="id" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
							</div>
							<div class="form-group">
								<label><strong>Alamat Kirim</strong></label>
								<input name="alamat" id="alamat" type="text" class="form-control" value="<?php echo $info['alamat'];?>" required/>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
								<a href="<?php echo base_url();?>alamat_kirim/tambah"><button type="button" name="tambah_data" id="tambah_data" class="btn btn-success">
								<i class="fa fa-plus"></i> TAMBAH BARU</button></a>
								<a href="<?php echo base_url();?>alamat_kirim/"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
								<i class="fa fa-undo"></i> KEMBALI</button></a>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!--/.col (right) -->
			</form>
		</section><!-- /.content -->
	<div class="clearfix"></div>
      </div>