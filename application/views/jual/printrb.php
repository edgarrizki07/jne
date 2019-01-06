<div class="wrapper">
                <section class="content invoice">
                    <div class="row">
						<div class="col-xs-3">
							<img align='left' alt='<?php echo $this->setting_model->Logo1();?>' src='<?php echo base_url();?>images/<?php echo $this->setting_model->Logo1();?>' style="padding:0; margin:0;" height="100">
						</div><!-- /.col -->
						<div class="col-xs-9">
							<h4 class="text-bold" ><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></h4>
							<h5 class="text-bold" >TRANSPORTIR BAHAN BAKAR MINYAK</h5>
							<h5 class="text-bold" >Izin Transportir : <?php echo $info['kps'];?></h5>
							<p class="text-bold"><?php echo $this->pajak_model->AlamatCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></p>
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
											<div class="col-xs-12 text-center"><h4><b><u>RECEIPT FOR BUNKER</u></b></h4>
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
					<table class="table">
						<tr>
							<td><strong>Supplier Shipment :</strong></td>
						</tr>
						<tr>
							<td>
								KTM. : <?php echo $info['kmt'];?>
							</td>
						</tr>
					</table>
				  </div><!-- /.col -->
				  <div class="col-xs-6">
					<table class="table">
						<tr>
							<td><strong>Serial No</strong></td>
						</tr>
						<tr>
							<td><?php echo $info['nodo'];?>/RFB/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $this->setting_model->singkatan();?>/<?php echo $this->jurnal_model->ambilBln($info['tgldo']);?>/<?php echo $this->jurnal_model->ambilThn($info['tgldo']);?></td>
						</tr>
					</table>
				  </div><!-- /.col -->
				  <h5 class="text-center">Received for use as bunkers, together with a representative sample, on board the </h5>
				</div><!-- /.row -->
				
				<div class="row">
				  <!-- accepted payments column -->
				  <div class="col-xs-6">
					<table class="table">
						<tr>
							<td>
								TB. : <?php echo $info['tb'];?>
							</td>
						</tr>
					</table>
				  </div><!-- /.col -->
				  <div class="col-xs-6">
					<table class="table">
						<tr>
								Date : <?php echo $this->app_model->tgl_indo($info['tgldo']);?></br>Port : <?php echo $info['port'];?>
						</tr>
					</table>
				  </div><!-- /.col -->
				</div><!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td><b>The Quantity of <?php echo number_format($info['volume']);?> LTR</b></td>
                                        <td><b></b></td>
                                        <td><b>Lighter *)</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>(....)</th>
                                        <th></th>
                                        <th>*) Delete whichever</br>; Not applicable</th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Grade of oil .............................. Temperature of Oil .............................`F (.......................`C)</td>
                                    </tr>
                                    <tr>
                                        <td>Specific Gravity ...................@................. `F(....................`C) Specific Gravity @ `F (.................`C)................</td>
                                    </tr>
                                    <tr>
                                        <td>Flashpoint ................................. `F (..................`C) Water .....................)</td>
                                    </tr>
                                    <tr>
                                        <td>Approxiamate viscosity (Redwood No. 1 @ 100 `F) .......................... Seconds)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
						<table class="table" width="100%">
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
							<b><u><?php echo $info['chief'];?></u></b></br><b>Cheif</b></td>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['master'];?></u></b></br><b>Master</b></td>
							<td width="25%" valign="top" align="center">
							<b><u><?php echo $info['juragan'];?></u></b></br><b>Juragan</b></td>
						</tr>
						</table>    
                    </div><!-- /.row -->
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
							<h4 class="text-bold" ><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></h4>
                            <p style="margin-top: 10px;">Notes: Apabila dalam Receipt For Bunker ini terdapat Coretan (Correction Pen) Maka Receipt For Bunker Tersebut Dianggap Tidak Sah.
                            </p>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section><!-- /.content -->
                <!-- Main content -->
</div><!-- /.content-wrapper -->

