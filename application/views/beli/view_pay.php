<?php $uri = $this->uri->segment(3); ?>
				<!-- Page Right Column -->
      <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $title;?>
                    </h1>
					<h5>
						| <b>Tagihan : </b><?php echo number_format($info['tot9'], 0, ',', '.');?>
						| <b>Proses Bayar/Belum ACC : </b><?php echo number_format($this->bbm_model->JmlPayBeli($info['id']), 0, ',', '.');?>
						| <b>Sudah Terbayar/Sudah ACC : </b><?php echo number_format($this->bbm_model->JmlPaidBeli($info['id']), 0, ',', '.');?>
						| <b>Belum Bayar : </b><?php echo number_format($this->bbm_model->JmlSisaBayarBeli($info['id']), 0, ',', '.');?>
					</h5>
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
	$this->session->unset_userdata('SUCCESSMSG'); } ?>
				
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
					<a href="<?php echo site_url('beli/pdf_pay/'.$info['id'].'/'.$row->id);?>" class="btn btn-info" ><i class="fa fa-print"></i> Cetak</a>
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
							<h5>PO : <?php echo $info['id_beli'];?> Tanggal <?php echo $this->jurnal_model->tgl_indo($info['tgl']);?></h5>
							<h5>Invoice : <?php echo $info['jurnal_id'];?>/INV/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $info['id'];?>/<?php echo $this->jurnal_model->ambilBln($info['tgl']);?>/<?php echo $this->jurnal_model->ambilThn($info['tgl']);?> Tanggal <?php echo $this->jurnal_model->tgl_indo($info['tgl']);?></h5>
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
							<td>
								<p class="lead">Bukti: <br>
								<?php if($row->bukti==''){ ?>
								<img width="215px" src="<?php echo base_url();?>images/photo.png"/>
								<?php }else{ ?><a target="_blank" href="<?php echo base_url('files/pelunasan/'.$row->bukti);?>">
								<img width="215px" src="<?php echo base_url('files/pelunasan/'.$row->bukti);?>"/></a>									
								<?php } ?>
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