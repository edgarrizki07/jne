<div class="wrapper">
                <section class="content invoice">
                    <div class="row">
						<div class="col-xs-3">
							<img align='left' alt='<?php echo $this->setting_model->Logo1();?>' src='<?php echo base_url();?>images/<?php echo $this->setting_model->Logo1();?>' style="padding:0; margin:0;" height="100">
						</div><!-- /.col -->
						<div class="col-xs-9">
							<h4 class="text-bold" ><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></h4>
							<p class="text-bold">
								<?php echo $this->pajak_model->AlamatCabang($info['wp_id']);?>
								<?php echo $this->pajak_model->KotaCabang($info['wp_id']);?> INDONESIA<br>
									<td>Email : <?php echo $this->pajak_model->EmailCabang($info['wp_id']);?></td>
									<td>Phone : <?php echo $this->pajak_model->PhoneCabang($info['wp_id']);?></td>
									<td>Fax : <?php echo $this->pajak_model->FaxCabang($info['wp_id']);?> </td>
							</p>
						</div><!-- /.col -->
                    </div>
				  <div class="row">
					<div class="col-xs-12">
					  <h2 class="page-header"></h2>
					</div><!-- /.col -->
				  </div>
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table-condensed" width="100%" >
                                <thead>
                                    <tr align="center">
                                        <th>
											<div class="col-xs-12 text-center"><h4><b><u>SURAT JALAN</u></b></h4>
											<h5>Nomor :  <?php echo $info['nodo'];?>/PO/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $this->setting_model->singkatan();?>/<?php echo $this->jurnal_model->ambilBln($info['tgldo']);?>/<?php echo $this->jurnal_model->ambilThn($info['tgldo']);?></br>
												Tanggal Kirim :  <?php echo $this->app_model->tgl_indo($info['tgldo']);?></h5>
											</div>
										</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- /.col -->
                    </div>
				<div class="clear"></div>
				
				<div class="row">
				  <!-- accepted payments column -->
				  <div class="col-xs-6">
					<table class="table table-bordered">
						<tr>
							<td><strong>Nama dan Alamat Pembeli</strong></td>
						</tr>
						<tr>
							<td>
								<?php $klien = $this->proyek_model->KlienProyek($info['proyek_id']) ; echo $this->klien_model->CPKlien($klien);?> - <?php echo $this->klien_model->HPKlien($klien);?><br>
								<strong><?php echo $this->klien_model->NamaKlien($klien);?></strong><br>
								<strong>NPWP : <?php echo $this->klien_model->NPWPKlien($klien);?></strong><br>
								<strong>Alamat :</strong><br>
								<?php echo $this->klien_model->AlamatKlien($klien);?><br>
								Phone : <?php echo $this->klien_model->TelpKlien($klien);?> 
								Fax : <?php echo $this->klien_model->FaxKlien($klien);?> 
								Email : <?php echo $this->klien_model->EmailKlien($klien);?>
							</td>
						</tr>
					</table>
				  </div><!-- /.col -->
				  <div class="col-xs-6">
					<table class="table table-bordered">
						<tr>
							<td><strong>Dikirim ke</strong></td>
						</tr>
						<tr>
							<td><?php echo $info['kirim'];?></td>
						</tr>
					</table>
					<table class="table">
						<tr>
							<td><b>Transportir</b></br><b>Vehicle</b></br><b>Volume</b></br><b>Driver</b></td>
							<td> : </br> : </br> : </br> : </br></td>
							<td><?php echo $info['armada'];?></br><?php echo $info['angkutan'];?></br><?php echo $info['volume'];?></br><?php echo $info['driver'];?></td>
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
                                        <td><b>Product</b></td>
                                        <td><b>Volume</b></td>
                                        <td><b>Nomor Segel</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>High Speed Diesel</th>
                                        <th><?php echo number_format($info['volume']);?> L</th>
                                        <th><?php echo $info['detail'];?></th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
								<h5 class="text-center text-bold">Catatan</h5>
                                <tbody>
                                    <tr>
                                        <td width="10%">Density</td>
                                        <td> : </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">Temperatur</td>
                                        <td> : </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
						<table class="table table-bordered" width="100%">
						<tr>
							<td width="30%" valign="top" align="center">
							<b><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></b></td>
							<td width="25%" valign="top" align="center">
							<b>PT. </b></td>
							<td width="25%" valign="top" align="center">
							<b>Transportir</b></td>
							<td width="25%" valign="top" align="center">
							<b>Penerima</b></td>
						</tr>
						<tr>
							<td width="25%" valign="top" align="center"></br></br></br></td>
							<td width="25%" valign="top" align="center"></br></br></br></td>
							<td width="25%" valign="top" align="center"></br></br></br></td>
							<td width="25%" valign="top" align="center"></br></br></br></td>
						</tr>
						<tr>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['owner'];?></u></b></br><b>Direktur Utama</b></td>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['chief'];?></u></b></br><b>Kepala Depot</b></td>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['driver'];?></u></b></br><b>Pengemudi</b></td>
							<td width="25%" valign="top" align="center">
							<b></b></td>
						</tr>
						</table>    
                    </div><!-- /.row -->
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
                            <p>Notes:</p><b></b>
                            <p style="margin-top: 10px;">
                            1. <b>Harap diperiksa</b> sebelum BBM dibongkar.</br>
							2. <b>Komplain tidak dilayani</b> setelah BBM dibongkar dan surat Jalan (Tanda Terima) telah ditanda tangani Penerima/Fuel Man.
                            </p>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section><!-- /.content -->
                <!-- Main content -->
                <section class="content invoice">
                    <div class="row">
						<div class="col-xs-3">
							<img align='left' alt='<?php echo $this->setting_model->Logo1();?>' src='<?php echo base_url();?>images/<?php echo $this->setting_model->Logo1();?>' style="padding:0; margin:0;" height="100">
						</div><!-- /.col -->
						<div class="col-xs-9">
							<h4 class="text-bold" ><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></h4>
							<p class="text-bold">
								<?php echo $this->pajak_model->AlamatCabang($info['wp_id']);?>
								<?php echo $this->pajak_model->KotaCabang($info['wp_id']);?> INDONESIA<br>
									<td>Email : <?php echo $this->pajak_model->EmailCabang($info['wp_id']);?></td>
									<td>Phone : <?php echo $this->pajak_model->PhoneCabang($info['wp_id']);?></td>
									<td>Fax : <?php echo $this->pajak_model->FaxCabang($info['wp_id']);?> </td>
							</p>
						</div><!-- /.col -->
                    </div>
				  <div class="row">
					<div class="col-xs-12">
					  <h2 class="page-header"></h2>
					</div><!-- /.col -->
				  </div>
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table-condensed" width="100%" >
                                <thead>
                                    <tr align="center">
                                        <th>
											<div class="col-xs-12 text-center"><h4><b><u>BERITA ACARA PEMUATAN</u></b></h4>
											<h5>Nomor :  <?php echo $info['nodo'];?>/BAP/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $this->setting_model->singkatan();?>/<?php echo $this->jurnal_model->ambilBln($info['tgldo']);?>/<?php echo $this->jurnal_model->ambilThn($info['tgldo']);?></br>
												Tanggal Kirim :  <?php echo $this->app_model->tgl_indo($info['tgldo']);?></h5>
											</div>
										</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- /.col -->
                    </div>
				<div class="clear"></div>
				<div class="row">
				  <!-- accepted payments column -->
				  <div class="col-xs-5">
						<table class="table">
							<h5 class="text-center text-bold">Transport</h5>
							<tr>
								<td><b>Transportir</b></br><b>Vehicle</b></br><b>Volume</b></br><b>Driver</b></td>
								<td> : </br> : </br> : </br> : </br></td>
								<td><?php echo $info['armada'];?></br><?php echo $info['angkutan'];?></br><?php echo $info['volume'];?></br><?php echo $info['driver'];?></td>
							</tr>
						</table>
				  </div><!-- /.col -->
				  <div class="col-xs-7">
						<table class="table">
							<h5 class="text-center text-bold">Supplier</h5>
							<b><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?></b><br>
								<?php echo $this->pajak_model->AlamatCabang($info['wp_id']);?><br>
								<?php echo $this->pajak_model->KotaCabang($info['wp_id']);?>
							<tr>
								<td>Port<br>KPS</td>
								<td>:<br>:</td>
								<td><?php echo $info['port'];?><br><?php echo $info['kps'];?></td>
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
                                        <td><b>Product</b></td>
                                        <td><b>Volume</b></td>
                                        <td><b>Nomor Segel</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>High Speed Diesel</th>
                                        <th><?php echo number_format($info['volume']);?> L</th>
                                        <th><?php echo $info['detail'];?></th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
								<h5 class="text-center text-bold">Catatan</h5>
                                <tbody>
                                    <tr>
                                        <td width="10%">Density</td>
                                        <td> : </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">Temperatur</td>
                                        <td> : </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
						<table class="table table-bordered" width="100%">
						<tr>
							<td width="30%" valign="top" align="center">
							<b><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></b></td>
							<td width="25%" valign="top" align="center">
							<b>PT. </b></td>
							<td width="25%" valign="top" align="center">
							<b>Transportir</b></td>
							<td width="25%" valign="top" align="center">
							<b>Penerima</b></td>
						</tr>
						<tr>
							<td width="25%" valign="top" align="center"></br></br></br></td>
							<td width="25%" valign="top" align="center"></br></br></br></td>
							<td width="25%" valign="top" align="center"></br></br></br></td>
							<td width="25%" valign="top" align="center"></br></br></br></td>
						</tr>
						<tr>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['owner'];?></u></b></br><b>Direktur Utama</b></td>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['chief'];?></u></b></br><b>Kepala Depot</b></td>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['driver'];?></u></b></br><b>Pengemudi</b></td>
							<td width="25%" valign="top" align="center">
							<b></b></td>
						</tr>
						</table>    
						<table class="table table-bordered" width="100%">
							<h5 class="text-center text-bold">Keamanan</h5>
						<tr>
							<td width="25%" valign="top" align="center">
							Jam Masuk</td>
							<td width="25%" valign="top" align="center">
							Jam Keluar</td>
							<td width="25%" valign="top" align="center">
							Jam Masuk</td>
							<td width="25%" valign="top" align="center">
							Jam Keluar</td>
						</tr>
						<tr>
							<td width="25%" valign="top" align="center"></br></td>
							<td width="25%" valign="top" align="center"></br></td>
							<td width="25%" valign="top" align="center"></br></td>
							<td width="25%" valign="top" align="center"></br></td>
						</tr>
						</table>    
                    </div><!-- /.row -->

                </section><!-- /.content -->
</div><!-- /.content-wrapper -->

