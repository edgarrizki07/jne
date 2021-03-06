<script type="text/javascript">
$(document).ready(function(){

	$("#terminal_loading").focus();
	
	$("#terminal_loading").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#alamat_loading").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#wilayah_loading").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#delivery").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kirim").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kirim1").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#produk").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#angkutan").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#vehicle_id").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#armada").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
		
});	
</script>
				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <b>Sold to : <?php echo $this->customer_model->NamaCustomer($this->bbm_model->CustomerDO($this->uri->segment(3)));?> (C-<?php echo $this->bbm_model->CustomerDO($this->uri->segment(3));?>) </b><br>
						<small>
						Jumlah Jual : <?php $sell = $this->bbm_model->JmlJual($this->uri->segment(3)) ; echo number_format ($sell, 0, ',', '.');?> Ltr 
						- Delivered (acc) : <?php $delivered = $this->bbm_model->DeliveredDO($this->uri->segment(3)) ; echo number_format ($delivered, 0, ',', '.');?> Ltr 
						- Created (blm acc) : <?php $created = $this->bbm_model->CreatedDO($this->uri->segment(3)) ; echo number_format ($created, 0, ',', '.');?> Ltr 
						= Sisa : <?php $sisa = $sell-$delivered-$created ; echo  number_format ($sisa, 0, ',', '.');?> Ltr
						</small>
                    </h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
			<form class="form" action="" method="post" enctype="multipart/form-data" >
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
							<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>"; $this->session->unset_userdata('SUCCESSMSG'); } ?>
                                <div class="box-body">
                                        <!-- text input -->
                                        <div class="hidden">
                                            <label><strong>ID</strong></label>
                                            <input name="id" type="text" class="form-control" value="ID" required/>
                                            <label><strong>DO</strong></label>
											<input name="nodo" type="text" class="form-control" value="<?php echo $nodor;?>" placeholder="Jumlah DO per cabang"/>
											<input name="id_do" type="text" class="form-control" value="<?php echo $iddor;?>" placeholder="Nomor Urut DO per jual"/>
                                            <label><strong>Customer</strong></label>
											<input name="customer_id" type="text" class="form-control" value="<?php echo $this->bbm_model->CustomerJual($this->uri->segment(3));?>" />
                                        </div>
                                </div><!-- /.box-body -->
                                <div class="box-header">
                                    <i class="fa fa-file"></i>
                                    <h3 class="box-title"> Loading Instruction</h3>
                                </div>
                                <div class="box-body">
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Terminal Loading</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input type="text" name="terminal_loading" id="terminal_loading" maxlength="80" class="form-control" value=""/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Alamat Loading</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input type="text" name="alamat_loading" id="alamat_loading" maxlength="80" value="" class="form-control" required/>
                                                <span class="input-group-addon"><b> Wilayah </b></span>
                                            <input type="text" name="wilayah_loading" id="wilayah_loading" maxlength="80" value="" class="form-control" placeholder="Kota - Provinsi" required/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Date Loading</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
											<input type="text" name="date_loading" id="datepicker"  value="<?php echo $tgl;?>" class="form-control" required/>
                                                <span class="input-group-addon"><b> Time Loading </b></span>
												<div class="bootstrap-timepicker">
                                            <input type="text" name="time1_loading" value="" class="form-control timepicker"/>
												</div>
                                                <span class="input-group-addon"><b> - </b></span>
												<div class="bootstrap-timepicker">
                                            <input type="text" name="time2_loading" value="" class="form-control timepicker1"/>
												</div>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Referensi</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"><b> LI </b></span>
                                            <input type="text" name="reff_li" value="<?php echo $nodor;?>" class="form-control" required/>
                                                <span class="input-group-addon"><b> LO </b></span>
                                            <input type="text" name="reff_lo" value="" class="form-control" required/>
                                                <span class="input-group-addon"><b> PO </b></span>
                                            <input type="text" name="reff_po" value="" class="form-control" required/>
                                                <span class="input-group-addon"><b> DO </b></span>
                                            <input type="text" name="reff_do" value="" class="form-control" required/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Carrier</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon">: </span>
											<select name="carrier_li" class="form-control" required>
												<option value="LOCO">LOCO</option>
												<option value="FRANKO">FRANKO</option>
											</select>
												<span class="input-group-addon"><b> Tank Capacity </b></span>
                                            <input type="text" name="capacity" class="form-control" required/>
                                                <span class="input-group-addon"> Ltr </span>
                                                <span class="input-group-addon"><b> Transportir Vehicle ID </b></span>
                                            <input type="text" name="vehicle_id" id="vehicle_transport" value="" class="form-control" required/>
											</div>
                                        </div>
                                </div><!-- /.box-body -->
                                <div class="box-header">
                                    <i class="fa fa-file"></i>
                                    <h3 class="box-title"> Delivery Order No : <?php echo $nodor;?> /PO/<?php echo $this->pajak_model->KodeCabang($this->session->userdata('SESS_WP_ID'));?>/<?php echo $this->jurnal_model->ambilBln($tgl);?>/<?php echo $this->jurnal_model->ambilThn($tgl);?></h3>
                                </div>
                                <div class="box-body">
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Delivery to</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input name="delivery" id="delivery" type="text" maxlength="45" value="<?php echo $this->customer_model->NamaCustomer($this->bbm_model->CustomerJual($this->uri->segment(3)));?>"class="form-control"/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong></strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input name="kirim" id="kirim" type="text" maxlength="80" value="<?php echo $this->customer_model->KirimCustomer($this->bbm_model->CustomerJual($this->uri->segment(3)));?>"class="form-control" placeholder="Alamat Kirim"/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong></strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input name="kirim1" id="kirim1" type="text" maxlength="80" value="" class="form-control" placeholder="Kota - Provinsi"/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Ship Date</strong></label>
                                        </div>
											<div class="input-group">
												<span class="input-group-addon"> : </span>
												<input type="text" name="tglkirim" id="datepicker-tgl"  value="<?php echo $tgl;?>" class="form-control" required/>
												<span class="input-group-addon"><b> Storage </b></span>
												<select name="storage" class="form-control" required>
													<option value="0">Gudang Utama</option>
													<option value="1">Gudang Cadangan</option>
													<option value="2">Supplier</option>
													<option value="3">Other Storage</option>
												</select>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Product</strong></label>
                                        </div>
											<div class="input-group">
												<div class="input-group-addon"> : </div>
                                            <input type="text" name="produk" id="produk" value="JN-ENERGI (HSD)" class="form-control" required/>
												<span class="input-group-addon"><b> PO Number </b></span>
                                            <input name="nopo" type="text" class="form-control" value="<?php echo $this->bbm_model->NopoJual($this->uri->segment(3)) ; ?>"/>
												<span class="input-group-addon"><b> Quantity </b></span>
                                            <input type="text" name="volume" value="<?php echo $sisa;?>"class="form-control" required/>
                                                <span class="input-group-addon"> Ltr </span>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Made of Transport</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input type="text" name="angkutan" id="angkutan" value="Truck Tangki" class="form-control" required/>
                                                <span class="input-group-addon"><b> Carrier</b></span>
											<select name="carrier" class="form-control" required>
												<option value="LOCO">LOCO</option>
												<option value="FRANKO">FRANKO</option>
											</select>
                                                <span class="input-group-addon"><b> Vehicle ID </b></span>
                                            <input type="text" name="vehicle_id" id="vehicle_id" value="" class="form-control" required/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Seals</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input name="seals" type="text" class="form-control" required/>
                                                <span class="input-group-addon"><b> Density</b></span>
                                            <input type="text" name="density" value="" class="form-control" required/>
                                                <span class="input-group-addon"><b> Temperature </b></span>
                                            <input type="text" name="temperature" value="" class="form-control" required/>
                                                <span class="input-group-addon"> `C </span>
                                                <span class="input-group-addon"><b> Remarks </b></span>
                                            <input type="text" name="remarks" value="" class="form-control" required/>
											</div>
                                        </div>
                                        <div class="form-group">
                                        <div class="col-xs-2">
                                            <label><strong>Driver</strong></label>
                                        </div>
											<div class="input-group">
                                                <span class="input-group-addon"> : </span>
                                            <input name="driver" type="text" class="form-control" required/>
												<span class="input-group-addon"><b> Perusahaan Transport </b></span>
                                            <input type="text" name="armada" id="armada" class="form-control"  value="PT. JAGAD NUSANTARA ENERGI" required/>
											</div>
                                        </div>
                                </div><!-- /.box-body -->
                                <div class="box-body">
                                        <!-- button -->
										<div class="text-center">
											<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
											<a href="<?php echo site_url('jual/delivery_order/'.$this->uri->segment(3));?>"><button type="button" class="btn btn-warning">
											<i class="fa fa-undo"></i> KEMBALI</button></a>
										</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>
                </section><!-- /.content -->
			</form>
            </aside><!-- /.right-side -->
				<!-- end Page Right Column -->