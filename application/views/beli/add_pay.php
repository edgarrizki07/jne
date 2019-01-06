<?php $uri = $this->uri->segment(3); ?>
				<!-- Page Right Column -->
      <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $title;?>
                    </h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
	$this->session->unset_userdata('SUCCESSMSG'); } ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<form class="form" action="" method="post" enctype="multipart/form-data" >
					<?php echo validation_errors(); echo $message;?>
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
									<h3 class="box-title">
										<b>Tagihan : </b><?php echo number_format($info['tot9'], 0, ',', '.');?>
										<b>Proses Bayar : </b><?php echo number_format($this->bbm_model->JmlPayBeli($info['id']), 0, ',', '.');?>
										<b>Sudah Terbayar : </b><?php echo number_format($this->bbm_model->JmlPaidBeli($info['id']), 0, ',', '.');?>
										<b>Belum Bayar : </b><?php echo number_format($this->bbm_model->JmlSisaBayarBeli($info['id']), 0, ',', '.');?>
									</h3>
                                </div>
                                <div class="box-body">
									<div class="hidden">
										<label><strong>ID <?php echo $title;?></strong></label>
										<input name="id" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
									</div>
									<!-- button -->
									<div class="form-group">
										<div class="col-xs-4">
											<label><strong>Tgl Bayar</strong></label>
										</div>
										<div class="input-group"><span class="input-group-btn"><span>
										<input type="hidden" name="id_beli" value="<?php echo $this->uri->segment(3);?>" class="form-control"/>
										<input type="text" name="tglbyr" id="datepicker"  value="<?php echo date('Y-m-d');?>" class="form-control" required/>
										</div>
									</div>
									<?php $t = "SELECT sum(jmlbyr) as jml FROM beli_bayar WHERE id_beli='$uri' "; $d = $this->db->query($t); $r = $d->num_rows(); ?>
									<?php if($r>0){ foreach($d->result() as $h){ $totbyr = $h->jml; } }else{ $totbyr = 0; } ?>
									<div class="form-group">
										<div class="col-xs-4">
											<label><strong>Dibayarkan Sejumlah</strong></label>
										</div>
										<div class="input-group"><span class="input-group-btn"><span>
										<input type="text" name="jmlbyr" value="<?php echo $this->bbm_model->Total9Beli($this->uri->segment(3))-$totbyr;?>" class="form-control"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-4">
											<label><strong>Pembayaran dari akun Bank</strong></label>
										</div>
										<div class="input-group"><span class="input-group-btn"><span>
										<select name="akunbyr" class="form-control" required>
									<?php $this->db->order_by($order_column='id',$order_type='asc'); $this->db->order_by($order_column='kode',$order_type='asc'); ?>
									<?php $akun = $this->db->get_where('akun',array('jenis_akun_id'=> '2' ,'wp_id'=>$this->session->userdata('SESS_WP_ID')));?>
									<?php $item = $akun->result(); ?>
									<?php $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->kelompok_akun_id;?> - <?php echo $row->kode;?> (<?php echo $row->nama;?>)</option>
									<?php endforeach;?>
										</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-4">
											<label><strong>Keterangan</strong></label>
										</div>
										<div class="input-group"><span class="input-group-btn"><span>
											<textarea size="450" type="text" name="keterangan" class="form-control" required/>Dibayarkan Pelunasan PO (<?php echo $this->bbm_model->JmlBeli($this->uri->segment(3));?>L)</textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-4">
											<label><strong>Pilih File Bukti Transfer</strong></label>
										</div>
										<div class="input-group">
											<input name="gbr" type="file" required/>
										</div>
									</div>
									<div class="text-center">
									<?php if($info['status'] >='2'){ ?>
										<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
									<?php } ?>
									</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
			</form>
					</div><!-- /.row -->
                </section><!-- /.content -->
				
<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('beli_bayar',array('cek'=>'0','id_beli'=>$uri));?>
<?php $item = $sat->result(); ?>
<?php $no=0; foreach($item as $row ): $no++;?>
	<section class="content invoice">
		<div class="row">
			<div class="col-xs-6">
			<strong>Pembayaran : <?php echo $no;?></strong>
			<center>
			<?php if($row->bunker_id==''){ ?>
				<?php if($this->session->userdata('ADMIN')<='2'){ ?>
					<a href="<?php echo site_url('beli/acc_pay/'.$info['id'].'/'.$row->id);?>" class="btn btn-info" ><i class="fa fa-lock"></i> Selesai / Paid</a>
				<?php if($this->session->userdata('ADMIN')=='1'){ ?>
					<a href="<?php echo site_url('beli/hapus_pay/'.$row->id);?>" class="btn btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>
				<?php } ?>
					<?php } ?>
			<?php }else{ ?>
					<a target="_blank" href="<?php echo site_url('jurnal_proyek/view/'.$row->bunker_id);?>" class="btn btn-primary" ><i class='fa fa-file'></i> Lihat Jurnal</a>
				<?php if($this->session->userdata('ADMIN')=='1'){ ?>
					<a href="<?php echo site_url('beli/hapus_pay/'.$row->id);?>" class="btn btn-danger" ><i class="fa fa-trash-o"></i> Hapus</a>
				<?php } ?>
			<?php } ?>
			</center>
			<br>
			<table class="table table-bordered">
				<tr>
					<td>
				<?php $supplier = $info['supplier_id'] ; echo $this->supplier_model->CPsupplier($supplier);?> - <?php echo $this->supplier_model->HPsupplier($supplier);?><br>
				<strong><?php echo $this->supplier_model->Namasupplier($supplier);?></strong><br>
				<?php $npwp=$this->supplier_model->NPWPsupplier($supplier);?>
				<strong>NPWP :  <?php echo substr($npwp,0,2);?>.<?php echo substr($npwp,2,3);?>.<?php echo substr($npwp,5,3);?>.<?php echo substr($npwp,8,1);?>-<?php echo substr($npwp,9,3);?>.<?php echo substr($npwp,12,3);?></strong><br>
				<strong>Alamat :</strong><br>
				<?php echo $this->supplier_model->Alamatsupplier($supplier);?><br>
				Phone : <?php echo $this->supplier_model->Telpsupplier($supplier);?> 
				Fax : <?php echo $this->supplier_model->Faxsupplier($supplier);?> 
				Email : <?php echo $this->supplier_model->Emailsupplier($supplier);?>
					</td>
				</tr>
				</table>
			</div><!-- /.col -->
			<div class="col-xs-6">
				<table class="table table-bordered">
					<tr>
						<td>
							<h4>Referensi <h4>
							<h5>PO : <?php echo $info['id_beli'];?>/PO/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $info['id'];?>/<?php echo $this->jurnal_model->ambilBln($info['tgl']);?>/<?php echo $this->jurnal_model->ambilThn($info['tgl']);?> </h5>
							<h5>Tanggal : <?php echo $this->jurnal_model->tgl_indo($info['tgl']);?></h5>
						</td>
					</tr>
				</table>
				<table class="table" width='100%'>
					<h5 class="text-center text-bold">Detail</h5>
					<tr>
						<td>Term</br>Payment Due Date</td>
						<td> : </br> : </td>
						<td><?php echo $info['term'];?></br><?php echo $this->jurnal_model->tgl_str($info['tempo']);?></td>
					</tr>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<!-- Table row -->
		<div class="row invoice-info">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td>Tanggal Bayar</td>
							<td>Akun</td>
							<td align="right">Pembayaran Sejumlah</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $this->jurnal_model->tgl_str($row->tglbyr);?></td>
							<td><?php echo $this->akun_model->KelompokAkun($row->akunbyr);?> <?php echo $this->akun_model->KodeAkun($row->akunbyr);?>-<?php echo $this->akun_model->NamaAkun($row->akunbyr);?></td>
							<td><?php echo ($row->akunbyr);?></td>
							<td align="right"><?php echo number_format($row->jmlbyr, 0, ',', '.');?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row invoice-info">
			<!-- accepted payments column -->
			<div class="col-xs-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<td>
								<p class="lead">Keterangan: <br><?php echo ($row->keterangan);?></p>
							</td>
						</tr>
					</thead>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
<?php endforeach;?>
	<div class="clearfix"></div>
      </div><!-- /.content-wrapper -->
				<!-- end Page Right Column -->