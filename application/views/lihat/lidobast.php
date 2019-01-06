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
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table-condensed" width="100%" >
					<thead><tr align="center"><th><div class="col-xs-12 text-center"><h4><b>LOADING INSTRUCTION</b></h4></div></th></tr></thead>
				</table>
			</div><!-- /.col -->
		</div>
	<div class="clear"></div>
		<div class="row invoice-info">
			<div class="col-sm-6">
				<table class="table table-bordered">
				<tr>
					<td><strong>TERMINAL LOADING</strong></td>
				</tr>
				<tr>
					<td>
						<strong><?php echo $info['terminal_loading'];?></strong><br>
						<?php echo $info['alamat_loading'];?><br><?php echo $info['wilayah_loading'];?>
					</td>
				</tr>
				<tr><td><strong>HAULER</strong></td></tr>
					<td>
						<strong>PT. JAGAD NUSANTARA ENERGI</strong><br>
						<?php echo $info['alamat_loading'];?><br>
						<?php echo strtoupper($this->pajak_model->AlamatCabang($info['wp_id']));?><br>
						<?php echo strtoupper($this->pajak_model->KelurahanCabang($info['wp_id']));?>, 
						<?php echo strtoupper($this->pajak_model->KecamatanCabang($info['wp_id']));?><br>
						<?php echo strtoupper($this->pajak_model->KotaCabang($info['wp_id']));?>, 
						<?php echo strtoupper($this->pajak_model->ProvinsiCabang($info['wp_id']));?> - INDONESIA<br>
						IZIN ANGKUT BBM : 05.NW.03.18.00.123
					</td>
				</table>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<table class="table">
				<tr>
					<td><b>Loading Date</b></br><b>Loading Time</b></td>
					<td> : </br> : </td>
					<td><?php echo $this->jurnal_model->tgl_string($info['tglkirim']);?></br><?php echo $this->jurnal_model->ambilJamMenit($info['time1_loading']);?> - <?php echo $this->jurnal_model->ambilJamMenit($info['time2_loading']);?></td>
				</tr>
				<tr>
					<td><b>Reff LO </b></br><b>Reff PO </b></br><b>Reff DO </b></td>
					<td> : </br> : </br> : </td>
					<td><?php echo $info['reff_lo'];?></br><?php echo $info['reff_po'];?></br><?php echo $info['reff_do'];?></td>
				</tr>
				<tr>
					<td><b>Transport</b></br><b>Vehicle ID</b></br><b>Driver</b></br><b>Tank Capacity</b></br><b>Seals</b></td>
					<td> : </br> : </br> : </br> : </br> : </td>
					<td><?php echo $info['angkutan'];?></br><?php echo $info['vehicle_id'];?></br><?php echo $info['driver'];?></br><?php echo $info['capacity'];?></br><?php echo $info['seals'];?></td>
				</tr>
				<tr>
					<td><b>PRODUCT NAME</b></br><b>DETAIL OF PRODUCT</b></br><b>QUANTITY</b></br><b>CARRIER</b></td>
					<td> : </br> : </br> : </br> : </td>
					<td><?php echo $info['produk'];?></br>High Speed Diesel (HSD)</br><?php echo $info['volume'];?></br><?php echo $info['carrier_li'];?></td>
				</tr>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->

	<!-- Main content -->
	<section class="content invoice">
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table-condensed" width="100%" >
					<thead><tr align="center"><th><div class="col-xs-12 text-center"><h4><b>DELIVERY ORDER</b></h4></div></th></tr></thead>
				</table>
			</div><!-- /.col -->
		</div>
	<div class="clear"></div>
		<div class="row invoice-info">
			<div class="col-sm-8">
				<table class="table table-bordered">
				<tr>
					<td><strong>Sold to</strong></td>
				</tr>
				<tr>
					<td>
						<?php $customer = $info['customer_id'] ; echo $this->customer_model->CPCustomer($customer);?> - <?php echo $this->customer_model->HPCustomer($customer);?><br>
						<strong><?php echo $this->customer_model->NamaCustomer($customer);?></strong><br>
						<strong>NPWP : <?php echo $this->customer_model->NPWPCustomer($customer);?></strong><br>
						<strong>Alamat :</strong><br>
						<?php echo $this->customer_model->AlamatCustomer($customer);?><br>
						Phone : <?php echo $this->customer_model->TelpCustomer($customer);?> 
						Fax : <?php echo $this->customer_model->FaxCustomer($customer);?> 
						Email : <?php echo $this->customer_model->EmailCustomer($customer);?>
					</td>
				</tr>
				<tr><td><strong>Delivery to</strong></td></tr>
				<tr><td><?php echo $info['delivery'];?><br><?php echo $info['kirim'];?><br><?php echo $info['kirim1'];?></td></tr>
				<tr><td><strong>Storage from</strong></td></tr>
				<tr><td><?php if($info['storage'] =='0'){ ?>Gudang Utama<?php } else if($info['storage'] =='1'){ ?>Gudang Cadangan<?php } else if($info['storage'] =='2'){ ?>On Supplier<?php } else if($info['storage'] =='3'){ ?>Other Storage<?php } ?></td></tr>
				</table>
			</div><!-- /.col -->
			<div class="col-sm-4">
				<table class="table">
				<tr>
					<td><b>Ship Date</b></br><b>Print Date</b></br><b>Print Time</b></br><b>DO / BR Number</b></td>
					<td> : </br> : </br> : </br> : </br></td>
					<td><?php echo $this->jurnal_model->tgl_string($info['tglkirim']);?></br><?php echo $this->jurnal_model->tgl_string($this->jurnal_model->ambilDate($info['tgldo']));?></br><?php echo $this->jurnal_model->ambilJamMenit($this->jurnal_model->ambilTime($info['tgldo']));?></br><?php echo $info['nodo'];?></td>
				</tr>
				<tr>
					<td><b>Transport</b></br><b>Carrier</b></br><b>Vehicle ID</b></br><b>Capacity</b></br><b>Driver</b></td>
					<td> : </br> : </br> : </br> : </br></td>
					<td><?php echo $info['angkutan'];?></br><?php echo $info['carrier'];?></br><?php echo $info['vehicle_id'];?></br><?php echo $info['capacity'];?></br><?php echo $info['driver'];?></td>
				</tr>
				<tr>
					<td><b>Density</b></br><b>Temperature</b></br><b>Remarks</b></br><b>Seals</b></td>
					<td> : </br> : </br> : </br> : </br></td>
					<td><?php echo $info['density'];?></br><?php echo $info['temperature'];?> `C</br><?php echo $info['remarks'];?></br><?php echo $info['seals'];?></td>
				</tr>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<!-- Table row -->
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td><b>PRODUCT</b></td>
							<td><b>PO NUMBER</b></td>
							<td><b>QUANTITY</b></td>
							<td><b>UM</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>High Speed Diesel</th>
							<th><?php echo $info['nopo'];?></th>
							<th><?php echo number_format($info['volume']);?> L</th>
							<th>Ltr</th>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</section><!-- /.content -->

	<!-- Main content -->
	<section class="content invoice">
		<div class="row">
			<div class="col-xs-12 table-responsive">
				<table class="table-condensed" width="100%" >
					<thead>
						<tr align="center">
							<th>
								<div class="col-xs-12 text-center"><h4><b>BERITA ACARA SERAH TERIMA</b></h4>
								<h5>Nomor :  <?php echo $info['nodo'];?>/BAP/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $this->setting_model->singkatan();?>/<?php echo $this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tglkirim']));?>/<?php echo $this->jurnal_model->ambilThn($info['tglkirim']);?></h5>
								</div>
							</th>
						</tr>
						<tr>
							<th><h5>Pada hari, Tanggal : <?php echo $this->jurnal_model->hari($info['tglkirim']);?>, <?php echo $this->jurnal_model->tgl_indo($info['tglkirim']);?>, Telah dilakukan proses penerimaan barang dari :</h5></th>
						</tr>
						<tr>
							<td><b>Nama Perusahaan</b></br><b>Nama Barang </b></br><b>No. DO</b></br><b>Sebanyak</b></br><b>No. Pol Kendaraan</b></br><b>Nomor Segel </b></td>
							<td> : </br> : </br> : </br> : </br> : </br> : </td>
							<td><?php echo $info['armada'];?></br><?php echo $info['angkutan'];?></br><?php echo $info['nodo'];?></br><?php echo $info['volume'];?></br><?php echo $info['vehicle_id'];?></br><?php echo $info['seals'];?></td>
						</tr>
						<tr>
							<th><h5>Sebelum dilakukan pemindahan barang dari tangki transporter ke tangki penampung, terlebih dahulu Dilakukan pemeriksaan sebagai berikut :</h5></th>
						</tr>
						<tr>
							<th>
							Kelengkapan dokumen pengiriman : Ya / Tidak Keterangan :________</br>
							Segel di tangki transporter dalam kondisi baik dan benar (tersegel) : Ya / Tidak Keterangan :________</br>
							Kualitas barang sesuai dengan pesanan : Ya / Tidak Keterangan :________</br>
							Volume barang yang diterima sesuai dengan pesanan : Ya / Tidak Keterangan :________</br>
							Setelah barang diterima, kondisi tangki transporter dalam keadaan kosong : Ya / Tidak Keterangan :________
							</th>
						</tr>
						<tr>
							<th><h5>Demikian berita acara serah terima ini dibuat dengan kondisi sebenar-benarnya dan dapat dipertanggung jawabkan di kemudian hari.</h5></th>
						</tr>
					</thead>
				</table>
			</div><!-- /.col -->
		</div>
	<div class="clear"></div>
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

