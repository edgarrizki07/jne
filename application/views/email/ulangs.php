<head>
	<title>Email Sudah Diproses</title>
</head>
<script>
	var time = null
	function move() {
	window.location = '<?php echo site_url('email/ulang');?>'; }
</script>
<body onload="timer=setTimeout('move()',1000)">
<audio controls autoplay>
	<source src="<?php echo base_url('sound/'.$this->app_model->Gagal());?>" type="audio/mpeg" />
</audio>
<br><br><br>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
								<div class="text-center">
									<a class="btn btn-flat"><b><?php echo $no;?> Kepada : <?php echo $this->app_model->EmailKirim($no);?></b></a>
									<a href="<?php echo site_url('email/ulang');?>" class="btn btn-danger"><i class="fa fa-play"></i><b> Ulang</b></a>
									<a href="<?php echo site_url('email/auto');?>" class="btn btn-warning"><i class="fa fa-stop"></i><b> Stop Auto</b></a>
									<a href="<?php echo site_url('email/daftar');?>" class="btn btn-info"><i class="fa fa-list"></i><b> Daftar Email</b></a>
									<a href="<?php echo site_url('email');?>" class="btn btn-warning"><i class="fa fa-undo"></i><b> Kembali</b></a>
								</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
