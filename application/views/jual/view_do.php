<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<a class="btn btn-warning" href="<?php echo site_url('jual/delivery_order/'.$this->bbm_model->Id_jualDO($this->uri->segment(3)));?>"><i class="fa fa-list"></i> List of Delivery Order</a>
			<?php if($info['cek'] =='0'){ ?>
			<?php if($info['status'] =='0'){ ?>
			<a target="_blank" href="<?php echo site_url('jurnal_proyek/view/'.$info['jurnal_id']);?>" class="btn btn-primary" ><i class='fa fa-file'></i>  Lihat Jurnal</a>
			<a class="btn btn-primary" target="_blank" href="<?php echo site_url('jual/print_li/'.$this->uri->segment(3));?>"><i class="fa fa-print"></i> Print Loading Instruction</a>
			<a class="btn btn-primary" target="_blank" href="<?php echo site_url('jual/print_do/'.$this->uri->segment(3));?>"><i class="fa fa-print"></i> Print Delivery Order</a>
			<a class="btn btn-primary" target="_blank" href="<?php echo site_url('jual/print_ba/'.$this->uri->segment(3));?>"><i class="fa fa-print"></i> Print Berita Acara</a>
			<?php } else { ?>
			<a class="btn btn-success"href="<?php echo site_url('jual/edit_do/'.$this->uri->segment(3));?>" ><i class='fa fa-edit'></i> Edit </a>
			<a class="btn btn-primary" disabled><i class="fa fa-lock"></i> UNTUK MENCETAK TUNGGU ACC</a>
			<?php if($this->session->userdata('ADMIN')<='2'){ ?>
				<a href="<?php echo site_url('jual/acc_do/'.$this->uri->segment(3));?>" class="btn btn-primary" ><i class='fa fa-check-square-o'></i> Selesai/ACC</a>
			<?php } ?>
			<?php } ?>
			<?php } ?>
			<h4 class="text-center text-bold">LOADING INSTRUCTION, DELIVERY ORDER DAN BERITA ACARA SERAH TERIMA
			<br><?php if($info['cek'] !='0'){ ?>INI TELAH DIHAPUS oleh : <?php echo $this->user_model->NamaUser($info['login_id']); ?> <?php echo $this->user_model->NamaBUser($info['login_id']); ?><?php } ?></h4>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>

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
					<td><b>No LI </b></br><b>Reff LO </b></br><b>Reff PO </b></br><b>Reff DO </b></td>
					<td> : </br> : </br> : </br> : </td>
					<td><?php echo $info['id_jual'];?>/<?php echo $info['id_do'];?></br><?php echo $info['reff_lo'];?></br><?php echo $info['reff_po'];?></br><?php echo $info['reff_do'];?></td>
				</tr>
				<tr>
					<td><b>Transport</b></br><b>Vehicle ID</b></br><b>Driver</b></br><b>Tank Capacity</b></br><b>Seals</b></br><b>Transportir Vehicle ID</b></td>
					<td> : </br> : </br> : </br> : </br> : </br> : </td>
					<td><?php echo $info['angkutan'];?></br><?php echo $info['vehicle_id'];?></br><?php echo $info['driver'];?></br><?php echo $info['capacity'];?></br><?php echo $info['seals'];?></br><?php echo $info['vehicle_transport'];?></td>
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
				<tr><td><strong>Delivery to </strong></td></tr>
				<tr><td><b><?php echo $info['delivery'];?></b><br><?php echo $info['kirim'];?><br><?php echo $info['kirim1'];?></td></tr>
				<tr><td><strong>Storage from</strong></td></tr>
				<tr><td><?php if($info['storage'] =='0'){ ?>Gudang Utama<?php } else if($info['storage'] =='1'){ ?>Gudang Cadangan<?php } else if($info['storage'] =='2'){ ?>On Supplier<?php } else if($info['storage'] =='3'){ ?>Other Storage<?php } ?></td></tr>
				</table>
			</div><!-- /.col -->
			<div class="col-sm-4">
				<table class="table">
				<tr>
					<td><b>Ship Date</b></br><b>Print Date</b></br><b>Print Time</b></br><b>DO / BR Number</b></td>
					<td> : </br> : </br> : </br> : </br></td>
					<td><?php echo $this->jurnal_model->tgl_string($info['tglkirim']);?></br><?php echo $this->jurnal_model->tgl_string($this->jurnal_model->ambilDate($info['tgldo']));?></br><?php echo $this->jurnal_model->ambilJamMenit($this->jurnal_model->ambilTime($info['tgldo']));?></br><?php echo $info['id_jual'];?>/<?php echo $info['id_do'];?></td>
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
							<th><?php echo $info['volume'];?> L</th>
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
							<td><?php echo $info['armada'];?></br><?php echo $info['angkutan'];?></br><?php echo $info['id_jual'];?>/<?php echo $info['id_do'];?></br><?php echo $info['volume'];?></br><?php echo $info['vehicle_id'];?></br><?php echo $info['seals'];?></td>
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

