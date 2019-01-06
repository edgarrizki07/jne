<!-- Page Right Column -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Edit <?php echo $title;?></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
		<li class="active"><?php echo $title; ?></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<form class="form" action="" method="post" enctype="multipart/form-data" >
	<?php echo validation_errors(); echo $message;?>
	<div class="col-md-12">
		<!-- general form elements disabled -->
		<div class="box box-warning">
			<div class="box-body">
				<div class="hidden">
					<label><strong>ID <?php echo $title;?></strong></label>
					<input name="kode" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
					<a style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting');?>'"<button type="button" name="kembali" id="kembali" class="btn btn-primary">
					<i class="fa fa-undo"></i> Kembali</button></a>
					<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/logo');?>'"><i class="fa fa-picture-o"></i> Edit Logo</a>
					<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/header');?>'"><i class="fa fa-picture-o"></i> Edit Header</a>
				</div>
			</div><!-- /.box-body -->
			<div class="box-body">
				<!-- button -->
				<div class="form-group has-success">
					<label><strong>Pilih Foto</strong></label>
					<input name="gambar" type="file"/>
					<div class="box-body text-center">
						<?php if($info['logo_2']==''){ ?>
						<img width="400px" class="img-circle" src="<?php echo base_url();?>uploads/setting/photo.png"/>
						<?php }else{ ?>
						Nama File : <?php echo $info['logo_2'];?><br/><br/>
						<img width="400px" class="img-circle" src="<?php echo base_url('/uploads/setting/'.$info['logo_2']);?>"/>
						<?php } ?>
					</div><!-- /.box-body -->
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!--/.col (right) -->
</form>
</section><!-- /.content -->
<div class="clearfix"></div>
</div><!-- /.right-side -->
<!-- end Page Right Column -->