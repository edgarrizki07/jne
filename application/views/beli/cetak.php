<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/iCheck/flat/blue.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue">
<div class="content">
	<section class="invoice">
		<div class="row invoice-info">
			<div class="col-sm-7">
				<strong>Kepada :</strong><br>
				<strong>Up. <?php echo $this->supplier_model->CPSupplier($info['supplier_id']);?></strong><br>
				<?php echo $this->supplier_model->NamaSupplier($info['supplier_id']);?><br>
				<?php echo $this->supplier_model->AlamatSupplier($info['supplier_id']);?><br>
				<table width='80%'>
				<tr>
					<td>Phone : <?php echo $this->supplier_model->TelpSupplier($info['supplier_id']);?></td>
				</tr>
				</table>
				Email : <?php echo $this->supplier_model->EmailSupplier($info['supplier_id']);?></br></br>
			</div><!-- /.col -->
			<div class="col-sm-5">
				</br>
				<p>
				No PO : <?php echo $info['id_beli'];?>.<?php echo $this->jurnal_model->ambilTgl($info['tgl']);?>/PO/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $info['id'];?>/<?php echo $this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tgl']));?>/<?php echo $this->jurnal_model->ambilThn($info['tgl']);?></br>
				Tanggal : <?php echo $this->app_model->tgl_indo($info['tgl']);?></br>
				Metode : <strong><?php echo $info['term'];?></strong><br>
				Hauler : <strong><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?></strong><br>
				</p>
			</div><!-- /.col -->
		</div><!-- /.row -->
	<br>
		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 ">
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td><b>Uraian</b></td>
							<td><b>Satuan</b></td>
							<td><b>Harga Include</b></td>
							<td><b>Jumlah</b></td>
							<td><b>Harga Satuan</b></td>
							<td align="right"><b>Jumlah</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>High Speed Diesel</td>
							<td>Liter</td>
							<td><?php echo number_format($info['tot9']/$info['jml']);?></td>
							<td><?php echo number_format($info['jml']);?></td>
							<td><?php echo number_format($info['harga'], 2, '.', ',');?></td>
							<td align="right"><?php echo number_format(($info['harga']*$info['jml']), 2, '.', ',');?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row">
			<!-- accepted payments column -->
			<div class="col-xs-7">
				<table class="table table-striped">
					<thead>
						<tr>
							<td>Sistem Pembayaran</td>
							<td><b>: <?php echo $info['termbyr'];?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b>: <?php echo $info['rekening'];?></b></td>
						</tr>
						<tr>
							<td>Pengambilan</td>
							<td></td>
						</tr>
						<tr>
							<td>Lokasi</td>
							<td><b>: Depo <?php echo $this->supplier_model->NamaSupplier($info['supplier_id']);?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b>: <?php echo $info['depo'];?></b></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td><b>: <?php echo $this->app_model->tgl_indo($info['tglambil']);?></b></td>
						</tr>
						<tr>
							<td>Koordinator</td>
							<td><b>: <?php echo $info['koordinator'];?></b></td>
						</tr>
						<tr>
							<td>Metode</td>
							<td><b>: <?php echo $info['termambil'];?></b></td>
						</tr>
						<tr>
							<td>Invoice ditujukan ke</td>
							<td><b>: <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?> <u><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?></u></b></td>
						</tr>
						<tr>
							<td>Storage</td>
							<td><b>: <?php if($info['storage'] =='0'){ ?>Gudang Utama<?php } else if($info['storage'] =='1'){ ?>Gudang Cadangan<?php } else if($info['storage'] =='2'){ ?>On Supplier<?php } else if($info['storage'] =='3'){ ?>Other Storage<?php } ?></b></td>
						</tr>
					</thead>
				</table>
			</div><!-- /.col -->
	<?php 
	$item = '1'; $jml=$info['jml']*$info['harga']; 
	$d=$info['discount']; $disc=$jml*$d/100; 
	$disctotal=$jml-$disc; $ppn=$disctotal/10*($info['ppn']);
	$pbbkb=$disctotal*($info['npbbkb']/100)*($info['pbbkb']); 
	$pph=$disctotal*3/1000*($info['pph']); $t=($info['ohp']); 
	$td=($t*$jml); $tt=($td)+($info['ppnohp']*$td/10); 
	$gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt); 
	?>
			<div class="col-xs-5">
				<div class="">
					<table width='100%'>
						<tr>
							<th>Subtotal</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot1'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PPn 10%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot4'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PPh 0.3%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot6'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PBBKB <?php echo $info['npbbkb'];?>%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot5'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Rounding</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['rounding'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Total</th>
							<td>Rp</td>
							<td align="right"><b><?php echo number_format ($info['tot9'], 2, '.', ',');?></b></td>
						</tr>
					</table>
				</div>
				<br>
				<p class="lead">Terbilang:</p>
				<b><?php echo $info['terbilang'];?></b>
				</br>________________________________________________</br>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</section><!-- /.content -->
	<div class="clearfix"></div>
</div><!-- /.content-wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>lte/plugins/select2/select2.full.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>lte/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>lte/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>lte/dist/js/demo.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>lte/plugins/iCheck/icheck.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
        //Add text editor
        $("#tulis-textarea").wysihtml5();
        //Initialize Select2 Elements
        $("#tulis-textarea1").wysihtml5();
        //Initialize Select2 Elements
        $("#tulis-textarea2").wysihtml5();
        //Initialize Select2 Elements
        $("#tulis-textarea3").wysihtml5();
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
  </body>
</html>
