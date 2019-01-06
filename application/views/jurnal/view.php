<?php 
$nama = $this->setting_model->Nama(); 
$singkatan=$this->setting_model->singkatan();
$cab = $this->pajak_model->KodeCabang($info['wp_id']);
$judul=$this->jurnal_model->NamaVoucher($info['voucher_id']); 
$kode=$this->jurnal_model->KodeVoucher($info['voucher_id']); 
$payment=$this->jurnal_model->PayVoucher($info['voucher_id']);
$due=$this->jurnal_model->DueVoucher($info['voucher_id']);
$tgl=$this->jurnal_model->tgl_str($info['tgl']); 
$tempo=$this->jurnal_model->tgl_str($info['tempo']); 
$bln=$this->jurnal_model->ambilBln($info['tgl']); 
$thn=$this->jurnal_model->ambilThn($info['tgl']); 
$no = $info['id'];
$nomor = $info['no_voucher']; 
$keterangan = $info['keterangan']; 
$o1=($info['other_id']); 
$o2=($info['other_id']);
$k1=$this->customer_model->NamaCustomer($info['customer_id']);  
$k2=$this->customer_model->NPWPCustomer($info['customer_id']); 
$s1=$this->supplier_model->NamaSupplier($info['supplier_id']); 
$s2=$this->supplier_model->NPWPSupplier($info['supplier_id']);
?>
<?php if($info['customer_id']==''){ ?>
		<?php $journal1=$o1; $journal2='';?>
<?php }else{ ?>
	<?php if($info['voucher_id']=='7'){ ?>
		<?php $journal1=$s1; $journal2=$s2;?>
	<?php }else if($info['voucher_id']=='8'){ ?>
		<?php $journal1=$s1; $journal2=$s2;?>
	<?php }else if($info['voucher_id']=='9'){ ?>
		<?php $journal1=$k1; $journal2=$k2;?>
	<?php }else if($info['voucher_id']=='10'){ ?>
		<?php $journal1=$k1; $journal2=$k2;?>
	<?php }else if($info['voucher_id']=='11'){ ?>
		<?php $journal1=$s1; $journal2=$s2;?>
	<?php }else if($info['voucher_id']=='12'){ ?>
		<?php $journal1=$k1; $journal2=$k2;?>
	<?php } ?>
<?php } ?>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <a class="btn btn-warning" style="cursor: pointer;" onclick="location.href='<?php echo site_url('jurnal');?>'"> Kembali </a>
                        <a class="btn btn-primary" target="_blank" href="<?php echo site_url('jurnal/pdf/'.$this->uri->segment(3));?>"><i class="fa fa-print"></i> Print</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('home');?>'"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a style="cursor: pointer;" onclick="location.href='<?php echo site_url('jurnal');?>'"><?php echo $title;?></a></li>
                        <li class="active">View</li>
                    </ol>
                </section>
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-12">
						<?php
							if($this->session->userdata('SUCCESSMSG')) {
								echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>";
								$this->session->unset_userdata('SUCCESSMSG');
							}
						?>
                        </div><!-- /.col -->
					</div><!-- /.col -->
                </section>
                <!-- Main content -->
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-7">
							<div class="box-body">
								<h3><b><?php echo $this->setting_model->Nama();?></b></h3>
									<table width='70%'>
										<tr>
											<td><b><?php echo $payment;?></b></td>
											<td> : </td>
											<td> <?php echo $journal1;?></td>
										</tr>
										<tr>
											<td><?php if($info['customer_id']==''){ ?><?php }else{ ?><b>NPWP</b><?php } ?></td>
											<td> : </td>
											<td> <?php echo $journal2;?></td>
										</tr>
									</table>
							</div><!-- /.col -->
                        </div><!-- /.col -->
                        <div class="col-xs-5">
							<div class="box-body">
								<h3><i><?php echo $judul;?></i></h3>
									<table width='80%'>
										<tr>
											<td>Voucher No.</td>
											<td> : </td>
											<td><?php echo $nomor;?>/<?php echo $kode;?>/<?php echo $no;?>/<?php echo $cab;?>/<?php echo $singkatan;?>/<?php echo $bln;?>/<?php echo $thn;?></td>
										</tr>
										<tr>
											<td>Date</td>
											<td> : </td>
											<td><?php echo $this->jurnal_model->tgl_str($info['tgl']);?></td>
										</tr>
									<?php if($due=='1'){ ?>
										<tr>
											<td>Due Date</td>
											<td> : </td>
											<td><?php echo $tempo;?></td>
										</tr>
									<?php } ?>
									</table>
							</div><!-- /.col -->
                        </div><!-- /.col -->
                    </div><br>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6">
                            Pencatat
                            <address>
                                <strong><?php echo $this->user_model->NamaUser($info['login_id']);?></strong> - <?php echo $this->user_model->Level($this->user_model->LevelUser($info['login_id']));?> <?php echo $this->user_model->KetUser($info['login_id']);?><br>
							<table>
							<tr>
								<td>Phone</td>
								<td> : </td>
								<td><?php echo $this->user_model->PhoneUser($info['login_id']);?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td> : </td>
								<td><?php echo $this->user_model->EmailUser($info['login_id']);?></td>
							</tr>
							</table>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            Penerima
                            <address>
                                <strong><?php echo $this->user_model->NamaUser($info['user_id']);?></strong> - <?php echo $this->user_model->Level($this->user_model->LevelUser($info['user_id']));?> <?php echo $this->user_model->KetUser($info['user_id']);?><br>
							<table>
							<tr>
								<td>Phone</td>
								<td> : </td>
								<td><?php echo $this->user_model->PhoneUser($info['user_id']);?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td> : </td>
								<td><?php echo $this->user_model->EmailUser($info['user_id']);?></td>
							</tr>
							</table>
                            </address>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td><b>No</b></td>
                                        <td><b>Kode Perkiraan</b></td>
                                        <td><b>Nama Perkiraan</b></td>
                                        <td align="right"><b>Debit</b></td>
                                        <td align="right"><b>Credit</b></td>
                                    </tr>
                                </thead>
                                <tbody>
	<?php $detail_jurnal = $this->db->get_where('jurnal_detail',array('jurnal_id'=>$this->uri->segment(3))); $item = $detail_jurnal->result(); ?>
	<?php $no=0; foreach($item as $row ): $no++;?>
	<?php if($row->debit_kredit == 1) {$d=number_format(($row->nilai), 0, '', '.'); $k='';} else {$d=''; $k=number_format(($row->nilai), 0, '', '.');} ?>
                                    <tr>
                                        <td><?php echo $no;?></td>
										<td><?php echo $this->akun_model->KelompokAkun($row->akun_id);?> - <?php echo $this->akun_model->KodeAkun($row->akun_id);?></td>
										<td><?php echo $this->akun_model->NamaAkun($row->akun_id);?></td>
                                        <td align="right"><?php echo $d;?></td>
                                        <td align="right"><?php echo $k;?></td>
	<?php endforeach;?>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p><b>Keterangan:</br><?php echo $info['keterangan'];?></b></p>
                        </div><!-- /.col -->
                        <div class="col-xs-3">
                            <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>
                            <p><b>Penerima:</b></p>
    </br></br></br></br></br>
    <b><u><?php echo $this->user_model->NamaUser($info['user_id']);?></u></b><br /><?php echo $this->user_model->Level($this->user_model->LevelUser($info['user_id']));?>  <?php echo $this->user_model->KetUser($info['user_id']);?>
										</td>
                                    </tr>
                                </thead>
                            </table>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-3">
                            <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>
                            <p><b>Pencatat:</b></p>
    </br></br></br></br></br>
    <b><u><?php echo $this->user_model->NamaUser($info['login_id']);?></u></b><br /><?php echo $this->user_model->Level($this->user_model->LevelUser($info['login_id']));?>  <?php echo $this->user_model->KetUser($info['login_id']);?>
										</td>
                                    </tr>
                                </thead>
                            </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section><!-- /.content -->
        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->
