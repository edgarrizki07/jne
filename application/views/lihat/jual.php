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
	<!-- Main content -->
	<section class="content invoice">
		<!-- info row -->
		<div class="row">
			<div class="col-xs-6">
				<table class="table table-bordered">
				<tr>
					<td><strong>Bill to :</strong></td>
				</tr>
				<tr>
					<td>
				<?php $Customer = $info['customer_id'];?><strong><?php echo $this->customer_model->NamaCustomer($Customer);?></strong><br>
				<?php $npwp=$this->customer_model->NPWPCustomer($Customer);?>
				<strong>NPWP :  <?php echo substr($npwp,0,2);?>.<?php echo substr($npwp,2,3);?>.<?php echo substr($npwp,5,3);?>.<?php echo substr($npwp,8,1);?>-<?php echo substr($npwp,9,3);?>.<?php echo substr($npwp,12,3);?></strong><br>
				<strong>Alamat :</strong><br>
				<?php echo $this->customer_model->AlamatCustomer($Customer);?><br>
				Phone : <?php echo $this->customer_model->TelpCustomer($Customer);?> 
				Fax : <?php echo $this->customer_model->FaxCustomer($Customer);?> 
				Email : <?php echo $this->customer_model->EmailCustomer($Customer);?>
					</td>
				</tr>
				</table>
			</div><!-- /.col -->
			<div class="col-xs-6">
				<table class="table" width='100%'>
				<h5 class="text-center text-bold">Detail</h5>
				<tr>
					<td>Date</br>No Invoice</br>No DO</br>No PO</br>Customer ID</td>
					<td> : </br> : </br> : </br> : </br> : </td>
					<td><?php echo $this->jurnal_model->tgl_inggris($info['tgl_invoice']);?></br>INV-<?php echo $info['id_jual'];?></br><?php echo $info['id_jual'];?></br><?php echo $info['nopo'];?></br>C-<?php echo $info['customer_id'];?>/<?php echo $this->customer_model->KodeCustomer($info['customer_id']);?></td>
				</tr>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<!-- Table row -->
		<div class="row invoice-info">
			<div class="col-xs-8 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td>Sales Person</td>
							<td>Delivery Method</td>
							<td>Payment Terms</td>
							<td>Due Date</td>
							<td>Delivery Date</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $info['sales'];?></td>
							<td><?php echo $info['angkutan'];?></td>
							<td><?php echo $info['term'];?></td>
							<td><?php echo $this->jurnal_model->tgl_singkatan($info['tempo']);?></td>
							<td><?php echo $this->jurnal_model->tgl_singkatan($info['tglkirim']);?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td>Description</td>
							<td>Qty</td>
							<td>Unit</td>
							<td>Unit Price</td>
							<td align="right">Amount</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>High Speed Diesel (HSD) / Solar JN-ENERGI</td>
							<td><?php echo number_format($info['jml']);?></td>
							<td>Liter</td>
							<td><?php echo number_format(($info['tot9']-$info['rounding']-$info['tot8']-$info['tot7'])/$info['jml'], 2, '.', ',');?></td>
							<td align="right"><?php echo number_format((($info['tot9']-$info['rounding']-$info['tot8']-$info['tot7'])), 2, '.', ',');?></td>
						</tr>
        			<?php if($info['tot8']!='0'){ ?>
						<tr>
							<td>Transport <?php if($info['tot9']!='0'){ ?>+ PPn 10%<?php } ?></td>
							<td><?php echo number_format($info['jml']);?></td>
							<td>Liter</td>
							<td><?php echo number_format(($info['tot8']+$info['tot7'])/$info['jml'], 2, '.', ',');?></td>
							<td align="right"><?php echo number_format((($info['tot8']+$info['tot7'])), 2, '.', ',');?></td>
						</tr>
        			<?php } ?>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row invoice-info">
			<!-- accepted payments column -->
			<div class="col-xs-7">
				<table class="table table-striped">
					<thead>
						<tr>
							<td>
							<p class="lead">Terbilang :</p>
								<?php echo $info['terbilang'];?>
							</td>
						</tr>
						<tr>
							<td>
							<p class="lead">Pembayaran :</p>
								<?php echo $info['bank'];?></br>
								<?php echo $info['namarek'];?></br>
								<?php echo $info['rekening'];?></br>
							</td>
						</tr>
						<tr>
							<td>
							<p class="lead">Special Notes & Instruction :</p>
								<?php echo $info['keterangan'];?>
							</td>
						</tr>
					</thead>
				</table>
			</div><!-- /.col -->
	<?php $item = '1'; $jml=$info['harga']*$info['jml']; $d=$info['discount']; $disc=$jml*$d/100; $disctotal=$jml-$disc; $ppn=$disctotal/10*($info['ppn']);
	$pbbkb=$disctotal*($info['npbbkb']/100)*($info['pbbkb']); $pph=$disctotal*3/1000*($info['pph']); $t=($info['ohp']); $td=$t*$info['jml']; $tt=($td)+($info['ppnohp']*$td/10); $gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt); ?>
			<div class="col-xs-5">
				<div class="table">
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
							<th>Tax PBBKB <?php echo $info['npbbkb'];?>%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot5'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax PPh 0,3%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot6'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Feul Distribution/OAT,etc</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot7'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Tax FD/OAT,etc 10%</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot8'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Rounding</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['rounding'], 2, '.', ',');?></td>
						</tr>
						<tr>
							<th>Total</th>
							<td>Rp</td>
							<td align="right"><?php echo number_format ($info['tot9'], 2, '.', ',');?></td>
						</tr>
					</table>
				</div>
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
