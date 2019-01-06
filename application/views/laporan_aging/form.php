<script type="text/javascript" src="<?php echo base_url();?>asset/js/group_table.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-reset').click(function() {
			location.href = '<?php echo site_url();?>laporan_aging/'
		});
		$('#button-view').click(function() {
			var kategori = $('#kategori').val();
			var cabang = $('#cabang').val();
			var status = $('#status').val();
			var from = $('#datepicker-from').val();
			location.href = '<?php echo site_url();?>laporan_aging/index/'+kategori+'/'+cabang+'/'+status+'/'+from;
		});
		$('#button-print').click(function() {
			var kategori = $('#kategori').val();
			var cabang = $('#cabang').val();
			var status = $('#status').val();
			var from = $('#datepicker-from').val();
			window.open('<?php echo site_url();?>laporan_aging/pdf/'+kategori+'/'+cabang+'/'+status+'/'+from);
		});
		$('#button-xls').click(function() {
			var kategori = $('#kategori').val();
			var cabang = $('#cabang').val();
			var status = $('#status').val();
			var from = $('#datepicker-from').val();
			window.open('<?php echo site_url();?>laporan_aging/excel/'+kategori+'/'+cabang+'/'+status+'/'+from);
		});
		$('#button-supplier').click(function() {
			var supplier = $('#supplier').val();
			var status = $('#status').val();
			var from = $('#datepicker-from').val();
			window.open('<?php echo site_url();?>laporan_aging/filter_pdf/2/'+supplier+'/'+status+'/'+from);
		});
		$('#button-customer').click(function() {
			var customer = $('#customer').val();
			var status = $('#status').val();
			var from = $('#datepicker-from').val();
			window.open('<?php echo site_url();?>laporan_aging/filter_pdf/1/'+customer+'/'+status+'/'+from);
		});
	});
</script>
<?php
	$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5); $uri6 = $this->uri->segment(6);
	if($uri3=='1'){$judul='Debitur / Customer';  }else if($uri3=='2'){$judul='Creditur / Supplier';  }else if($uri3==''){$judul='Debitur/Creditur';  }
?> 

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $judul; ?> <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
				<?php if($this->session->userdata('SUCCESSMSG')) {echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>";
					$this->session->unset_userdata('SUCCESSMSG'); } ?>
	<div id="dialog-form"></div>
	<div class="clearer"></div>
<?php $data['class'] = 'input';	 echo form_open(); ?>
                <div class="box-header with-border">
                  <h3 class="box-title">Pencarian Aging</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table id="" class="table table-bordered table-striped">
					<?php if($this->session->userdata('ADMIN') =='1'){?>
						<tr>
							<th><?php echo form_label('Cabang','cabang'); ?></th>
							<td>
								<div class="form-group">
								<div class="input-group">
								<span class='input-group-addon'> : </span>
								<select name="cabang" id="cabang" class="form-control" >
								<?php if($uri4 == 0){ ?>
									<option value="0">- Semua Cabang -</option>
								<?php }else{ ?>
									<option value="<?php echo $uri4; ?>"><?php echo $this->pajak_model->KotaCabang($uri4); ?></option>
									<option value="0">- Semua Cabang -</option>
								<?php } ?>
								<?php $cab = $this->db->get_where('wp'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
									<option value="<?php echo $row->id;?>"><?php echo $row->id;?> - <?php echo $row->kota;?></option>
								<?php endforeach;?>
								</select>
								</div>
								</div>
							</td>
						</tr>
					<?php }else{?><input name="cabang" id="cabang" type="hidden" class="form-control" value="<?php echo $this->session->userdata('SESS_WP_ID');?>" />
					<?php } ?>
						<tr>
							<th><?php echo form_label('Aging','aging'); ?></th>
							<td>
								<div class="form-group">
								<div class="input-group">
								<span class='input-group-addon'> : </span>
								<select name="kategori" id="kategori" class="form-control" >
									<?php if($uri3 == ''){  ?>
									<option value="1">1. Debitur (Customer)</option>
									<option value="2">2. Creditur (Supplier)</option>
									<?php }else{  ?>
									<option value="<?php echo $uri3; ?>"><?php if($uri3 == '1'){  ?>Debitur (Customer)<?php }elseif($uri3 == '2'){  ?>Creditur (Supplier)<?php } ?></option>
									<option value="1">1. Debitur (Customer)</option>
									<option value="2">2. Creditur (Supplier)</option>
									<?php } ?>
								</select>
								<span class='input-group-addon'> <b>Status</b> </span>
								<select name="status" id="status" class="form-control" >
									<?php if($uri5 == ''){  ?>
									<option value="0">1. Semua</option>
									<option value="1">2. Belum Lunas</option>
									<?php }else{  ?>
									<option value="<?php echo $uri5; ?>"><?php if($uri5 == '0'){  ?>Semua<?php }elseif($uri5 == '1'){  ?>Belum Lunas<?php } ?></option>
									<option value="0">1. Semua</option>
									<option value="1">2. Belum Lunas</option>
									<?php } ?>
								</select>
								<?php 
									echo "<span class='input-group-addon'> <b>Tempo Mulai Tanggal</b> </span>";
									$tanggalfrom['name'] = 'from';
									$tanggalfrom['id'] = 'datepicker-from';
									$tanggalfrom['class']='form-control';
									$tanggalfrom['value']= $this->uri->segment(6);
									echo '<div class="input-group">';
									echo form_input($tanggalfrom);
									echo '</div>';
								?>					
								</div>
								</div>
							</td>	
						</tr>	
					</table>
                </div><!-- /.box-body -->

				<div class="box-footer">
					<div class="btn-group">
					<?php
						echo form_button('cari', 'Cari', "id = 'button-view', class = 'btn btn-info'" );
						echo form_button('cari', 'Cetak', "id = 'button-print', class = 'btn btn-primary'" );
						// echo form_button('cari', 'Excel', "id = 'button-xls', class = 'btn btn-warning'" );
						echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
					?>
					</div>
				</div>
	
                <div class="box-body">
					<table id="" class="table table-bordered table-striped col-md-12">
						<tr>
							<th><?php echo form_label('Creditur','supplier'); ?></th>
							<td>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-truck"></i></div>
									<select name="supplier" id="supplier" class="form-control select2" >
										<option>- Pilih Supplier -</option>
									<?php if($this->session->userdata('ADMIN') >='2'){$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); } ?>
									<?php $this->db->order_by($order_column='wp_id',$order_type='asc'); $this->db->order_by($order_column='nama',$order_type='asc'); $cab = $this->db->get_where('supplier'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama;?> (<?php echo $this->pajak_model->KotaCabang($row->wp_id);?>)</option>
									<?php endforeach;?>
									</select>
									<span class="input-group-btn">
									<?php echo form_button('cari', 'Cetak', "id = 'button-supplier', class = 'btn btn-primary btn-flat'" ); ?>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<th><?php echo form_label('Debitur','customer'); ?></th>
							<td>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-users"></i></div>
									<select name="customer" id="customer" class="form-control select2" >
										<option>- Pilih Customer -</option>
									<?php if($this->session->userdata('ADMIN') >='2'){$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); } ?>
									<?php $this->db->order_by($order_column='wp_id',$order_type='asc'); $this->db->order_by($order_column='nama',$order_type='asc'); $cab = $this->db->get_where('customer'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $this->customer_model->NamaCustomer($row->id);?> (<?php echo $this->pajak_model->KotaCabang($row->wp_id);?>)</option>
									<?php endforeach;?>
									</select>
									<span class="input-group-btn">
									<?php echo form_button('cari', 'Cetak', "id = 'button-customer', class = 'btn btn-primary btn-flat'" ); ?>
									</span>
								</div>
							</td>
						</tr>
					</table>
                </div><!-- /.box-body -->

<?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>

<?php if(!$uri3 == ''){  ?>
                <div class="box-body">
	<table id="" class="table table-bordered">
		<thead>
			<tr>
				<th><?php echo $judul; ?> </th>
			</tr>
		</thead>
		<tbody>
		<?php if($uri3 == '1'){  ?>
				<?php if($uri4 == '0'){}else{ $this->db->where('wp_id', $uri4);}?>
				<?php $this->db->order_by($order_column='wp_id',$order_type='asc'); $this->db->order_by($order_column='id',$order_type='asc'); ?>
				<?php $cab = $this->db->get_where('customer',array('cek'=>'0')); $info = $cab->result(); $no1=0; foreach($info as $row1 ): $no1++;?>
					<?php if(!$this->bbm_model->customer_jurnal($row1->id)) { ?>
						<tr>
							<td><?php echo $row1->nama;?>  Kode : C-<?php echo $row1->id_customer;?> / <?php echo $row1->kode;?>
							</td>
						</tr>
						<tr>
							<td>Kota : <?php echo $row1->kota;?> CP : <?php echo $row1->cp;?>
							<?php if($this->session->userdata('ADMIN') =='1'){?>ID : <?php echo $row1->id;?> Cabang : <?php echo $this->pajak_model->KotaCabang($row1->wp_id);?><?php } ?>
							</td>
						</tr>
						<tr>
							<td>
								<table id="example1" class="table table-bordered table-striped">
									<tr>
										<td><b>Tanggal/Nomor</b></td>
										<td><b>Tempo/Term</b></td>
										<td><b>Total</b></td>
										<td><b>Belum Tempo</td>
										<td><b>T <=30 D</b></td>
										<td><b>T <=60 D</b></td>
										<td><b>T <=90 D</b></td>
										<td><b>T <=120 D</b></td>
										<td><b>T >120 D</b></td>
										<td></td>
									</tr>
<?php			
$this->db->where('jurnal_detail.kategori_id', '3');
$this->db->where('jurnal.customer_id', $row1->id); $this->db->where('jurnal.voucher_id', '9'); 
if(!$uri4=='0'){ $this->db->where('jurnal.wp_id', $uri4);  } if(!$uri6==''){ $this->db->where('jurnal.tempo >=', $uri6); }
if($this->session->userdata('ADMIN')>='2'){$this->db->where('jurnal.wp_id', $this->session->userdata('SESS_WP_ID'));   }	

$this->db->order_by($order_column='tempo',$order_type='asc');
$this->db->select('*'); $this->db->from('jurnal');
$this->db->join('jurnal_detail', 'jurnal_detail.jurnal_id=jurnal.id');
$sat = $this->db->get(); $journal_aging = $sat->result();
if($journal_aging>0)
{
$i = 0; $TA=0; $TA1=0; $TA2=0; $TA3=0; $TA4=0; $TA5=0; $TA6=0; $Tpay =0;
foreach ($journal_aging as $rows)
{
$now = date("Y-m-d");
$tgl=$this->jurnal_model->tgl_str($rows->tgl); 
$due=$this->jurnal_model->tgl_str($rows->tempo); 
$nomor = $rows->no_voucher; 
$kode=$this->jurnal_model->KodeVoucher($rows->voucher_id); 
$no = $rows->jurnal_id;
$cab = $this->pajak_model->KodeCabang($rows->wp_id);
$bln=$this->jurnal_model->ambilBln($rows->tgl); 
$thn=$this->jurnal_model->ambilThn($rows->tgl); 
$n=$tgl."</br>".$nomor."/".$kode."/".$no; 

$idjual=$this->jurnal_model->IdJual($no); 
if($this->bbm_model->JmlSisaBayarJual($idjual) =='0'){ $pay='<b>LUNAS</b>';}else{
$pay='<b>Sisa : </b>'.number_format($this->bbm_model->JmlSisaBayarJual($idjual), 0, ',', '.');}

$nt = $rows->nilai;
$daytgl= strtotime('0 day',strtotime($rows->tgl));
$dayt= strtotime('0 day',strtotime($rows->tempo));
$dayn= strtotime('0 day',strtotime($now));
$dayx= $dayn-$dayt; 
$day= $dayx/86400;
$dayterm= $dayt-$daytgl; 
$term=number_format(($dayterm/86400), 0, '', '.'); 
if($now <= $rows->tempo){$days=''; }else{$days=number_format(($day), 0, '', '.').' Days'; }
if($day > 120){$ca='0'; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5=$nt; }else{
	if($day > 90){$ca=''; $b1='0'; $b2='0'; $b3='0'; $b4=$nt; $b5='0'; }else{
		if($day > 60){$ca='0'; $b1='0'; $b2='0'; $b3=$nt; $b4='0'; $b5='0'; }else{
			if($day > 30){$ca='0'; $b1='0'; $b2=$nt; $b3='0'; $b4='0'; $b5='0'; }else{
				if($day > 0){$ca='0'; $b1=$nt; $b2='0'; $b3='0'; $b4='0'; $b5='0'; }else{
				$ca=$nt; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5='0'; 
				}
			}
		}
	}
}
if(!$nt=='0'){$nilai = number_format(($nt), 0, '', '.'); }else{$nilai = '0';}
if(!$ca=='0'){$nca = number_format(($ca), 0, '', '.'); }else{$nca = '0';}
if(!$b1=='0'){$nb1 = number_format(($b1), 0, '', '.'); }else{$nb1 = '0';}
if(!$b2=='0'){$nb2 = number_format(($b2), 0, '', '.'); }else{$nb2 = '0';}
if(!$b3=='0'){$nb3 = number_format(($b3), 0, '', '.'); }else{$nb3 = '0';}
if(!$b4=='0'){$nb4 = number_format(($b4), 0, '', '.'); }else{$nb4 = '0';}
if(!$b5=='0'){$nb5 = number_format(($b5), 0, '', '.'); }else{$nb5 = '0';}
if($uri5=='0'){ 
echo '<tr>';
	echo '<td>'.anchor(site_url()."jurnal_proyek/view/".$rows->jurnal_id, $n).'</td>';
	echo '<td>'.$due."</br>".$term.' Days</td>';
	echo '<td class="text-right">'.$nilai.'</td>';	
	echo '<td class="text-right">'.$nca.'</td>';	
	echo '<td class="text-right">'.$nb1.'</td>';	
	echo '<td class="text-right">'.$nb2.'</td>';	
	echo '<td class="text-right">'.$nb3.'</td>';	
	echo '<td class="text-right">'.$nb4.'</td>';	
	echo '<td class="text-right">'.$nb5.'</td>';	
	echo '<td class="text-right">'.$days."</br>".anchor(site_url()."jual/view_pay/".$idjual, $pay).'</td>';	
echo '</tr>';
}else{
	if(!$this->bbm_model->JmlSisaBayarJual($idjual) =='0'){ 
	echo '<tr>';
		echo '<td>'.anchor(site_url()."jurnal_proyek/view/".$rows->jurnal_id, $n).'</td>';
		echo '<td>'.$due."</br>".$term.' Days</td>';
		echo '<td class="text-right">'.$nilai.'</td>';	
		echo '<td class="text-right">'.$nca.'</td>';	
		echo '<td class="text-right">'.$nb1.'</td>';	
		echo '<td class="text-right">'.$nb2.'</td>';	
		echo '<td class="text-right">'.$nb3.'</td>';	
		echo '<td class="text-right">'.$nb4.'</td>';	
		echo '<td class="text-right">'.$nb5.'</td>';	
		echo '<td class="text-right">'.$days."</br>".anchor(site_url()."jual/view_pay/".$idjual, $pay).'</td>';	
	echo '</tr>';
	}
}
	$i++; $TA = $TA+$nt; $TA1 = $TA1+$ca; $TA2 = $TA2+$b1; $TA3 = $TA3+$b2; $TA4 = $TA4+$b3; $TA5 = $TA5+$b4; $TA6 = $TA6+$b5; 
	$Tpay = $Tpay+$this->bbm_model->JmlSisaBayarJual($this->jurnal_model->IdJual($no));
}
}else{ $TA =0; $TA1 =0; $TA2 =0; $TA3 =0; $TA4 =0; $TA5 =0; $TA6 =0; $Tpay =0;
}
$nTA = number_format(($TA), 0, '', '.');
$nTA1 = number_format(($TA1), 0, '', '.');
$nTA2 = number_format(($TA2), 0, '', '.');
$nTA3 = number_format(($TA3), 0, '', '.');
$nTA4 = number_format(($TA4), 0, '', '.');
$nTA5 = number_format(($TA5), 0, '', '.');
$nTA6 = number_format(($TA6), 0, '', '.');
$nTpay = number_format(($Tpay), 0, '', '.');
echo '<tr>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td class="text-right">'.$nTA.'</td>';	
	echo '<td class="text-right">'.$nTA1.'</td>';	
	echo '<td class="text-right">'.$nTA2.'</td>';	
	echo '<td class="text-right">'.$nTA3.'</td>';	
	echo '<td class="text-right">'.$nTA4.'</td>';	
	echo '<td class="text-right">'.$nTA5.'</td>';	
	echo '<td class="text-right">'.$nTA6.'</td>';	
	echo '<th class="text-right">Sisa : '.$nTpay.'</th>';	
echo '</tr>';
?>		
								</table>
							</td>
						</tr>
					<?php } ?>
				<?php endforeach;?>
		<?php }else{  ?>
				<?php if($uri4 == '0'){}else{ $this->db->where('wp_id', $uri4);}?>
				<?php $this->db->order_by($order_column='wp_id',$order_type='asc'); $this->db->order_by($order_column='id',$order_type='asc'); ?>
				<?php $cab = $this->db->get_where('supplier',array('cek'=>'0')); $info = $cab->result(); $no2=0; foreach($info as $row2 ): $no2++;?>
					<?php if(!$this->bbm_model->supplier_jurnal($row2->id)) { ?>
						<tr>
							<td><?php echo $row2->nama;?>  Kode : S-<?php echo $row2->id_supplier;?> / <?php echo $row2->kode;?>
							</td>
						</tr>
						<tr>
							<td>Kota : <?php echo $row2->kota;?> CP : <?php echo $row2->cp;?>
							<?php if($this->session->userdata('ADMIN') =='1'){?>ID : <?php echo $row2->id;?> Cabang : <?php echo $this->pajak_model->KotaCabang($row2->wp_id);?><?php } ?>
							</td>
						</tr>
						<tr>
							<td>
								<table id="example1" class="table table-bordered table-striped">
									<tr>
										<td><b>Tanggal/Nomor</b></td>
										<td><b>Tempo/Term</b></td>
										<td><b>Total</b></td>
										<td><b>Belum Tempo</td>
										<td><b>T <=30 D</b></td>
										<td><b>T <=60 D</b></td>
										<td><b>T <=90 D</b></td>
										<td><b>T <=120 D</b></td>
										<td><b>T >120 D</b></td>
										<td></td>
									</tr>
<?php			
$this->db->where('jurnal_detail.kategori_id', '18');
$this->db->where('jurnal.supplier_id', $row2->id); $this->db->where('jurnal.voucher_id', '7'); // voucher - Piutang (AR)
if(!$uri4=='0'){ $this->db->where('jurnal.wp_id', $uri4);  } if(!$uri6==''){ $this->db->where('jurnal.tempo >=', $uri6); }
if($this->session->userdata('ADMIN')>='2'){$this->db->where('jurnal.wp_id', $this->session->userdata('SESS_WP_ID'));   }	

$this->db->order_by($order_column='tempo',$order_type='asc');
$this->db->select('*'); $this->db->from('jurnal');
$this->db->join('jurnal_detail', 'jurnal_detail.jurnal_id=jurnal.id');
$sat = $this->db->get(); $journal_aging = $sat->result();
if($journal_aging>0)
{
$i = 0; $TA=0; $TA1=0; $TA2=0; $TA3=0; $TA4=0; $TA5=0; $TA6=0; $Tpay =0;
foreach ($journal_aging as $rows)
{
$now = date("Y-m-d");
$tgl=$this->jurnal_model->tgl_str($rows->tgl); 
$due=$this->jurnal_model->tgl_str($rows->tempo); 
$nomor = $rows->no_voucher; 
$kode=$this->jurnal_model->KodeVoucher($rows->voucher_id); 
$no = $rows->jurnal_id;
$cab = $this->pajak_model->KodeCabang($rows->wp_id);
$bln=$this->jurnal_model->ambilBln($rows->tgl); 
$thn=$this->jurnal_model->ambilThn($rows->tgl); 
$n=$tgl."</br>".$nomor."/".$kode."/".$no; 

$idbeli=$this->jurnal_model->IdBeli($no); 
if($this->bbm_model->JmlSisaBayarBeli($idbeli) =='0'){ $pay='<b>LUNAS</b>';}else{
$pay='<b>Sisa : </b>'.number_format($this->bbm_model->JmlSisaBayarBeli($idbeli), 0, ',', '.');}

$nt = $rows->nilai;
$daytgl= strtotime('0 day',strtotime($rows->tgl));
$dayt= strtotime('0 day',strtotime($rows->tempo));
$dayn= strtotime('0 day',strtotime($now));
$dayx= $dayn-$dayt; 
$day= $dayx/86400;
$dayterm= $dayt-$daytgl; 
$term=number_format(($dayterm/86400), 0, '', '.'); 
if($now <= $rows->tempo){$days=''; }else{$days=number_format(($day), 0, '', '.').' Days'; }
if($day > 120){$ca='0'; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5=$nt; }else{
	if($day > 90){$ca=''; $b1='0'; $b2='0'; $b3='0'; $b4=$nt; $b5='0'; }else{
		if($day > 60){$ca='0'; $b1='0'; $b2='0'; $b3=$nt; $b4='0'; $b5='0'; }else{
			if($day > 30){$ca='0'; $b1='0'; $b2=$nt; $b3='0'; $b4='0'; $b5='0'; }else{
				if($day > 0){$ca='0'; $b1=$nt; $b2='0'; $b3='0'; $b4='0'; $b5='0'; }else{
				$ca=$nt; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5='0'; 
				}
			}
		}
	}
}

if(!$nt=='0'){$nilai = number_format(($nt), 0, '', '.'); }else{$nilai = '0';}
if(!$ca=='0'){$nca = number_format(($ca), 0, '', '.'); }else{$nca = '0';}
if(!$b1=='0'){$nb1 = number_format(($b1), 0, '', '.'); }else{$nb1 = '0';}
if(!$b2=='0'){$nb2 = number_format(($b2), 0, '', '.'); }else{$nb2 = '0';}
if(!$b3=='0'){$nb3 = number_format(($b3), 0, '', '.'); }else{$nb3 = '0';}
if(!$b4=='0'){$nb4 = number_format(($b4), 0, '', '.'); }else{$nb4 = '0';}
if(!$b5=='0'){$nb5 = number_format(($b5), 0, '', '.'); }else{$nb5 = '0';}
if($uri5=='0'){ 
echo '<tr>';
	echo '<td>'.anchor(site_url()."jurnal_proyek/view/".$rows->jurnal_id, $n).'</td>';
	echo '<td>'.$due."</br>".$term.' Days</td>';
	echo '<td class="text-right">'.$nilai.'</td>';	
	echo '<td class="text-right">'.$nca.'</td>';	
	echo '<td class="text-right">'.$nb1.'</td>';	
	echo '<td class="text-right">'.$nb2.'</td>';	
	echo '<td class="text-right">'.$nb3.'</td>';	
	echo '<td class="text-right">'.$nb4.'</td>';	
	echo '<td class="text-right">'.$nb5.'</td>';	
	echo '<td class="text-right">'.$days."</br>".anchor(site_url()."beli/view_pay/".$idbeli, $pay).'</td>';	
echo '</tr>';
}else{
	if(!$this->bbm_model->JmlSisaBayarBeli($idbeli) =='0'){ 
	echo '<tr>';
		echo '<td>'.anchor(site_url()."jurnal_proyek/view/".$rows->jurnal_id, $n).'</td>';
		echo '<td>'.$due."</br>".$term.' Days</td>';
		echo '<td class="text-right">'.$nilai.'</td>';	
		echo '<td class="text-right">'.$nca.'</td>';	
		echo '<td class="text-right">'.$nb1.'</td>';	
		echo '<td class="text-right">'.$nb2.'</td>';	
		echo '<td class="text-right">'.$nb3.'</td>';	
		echo '<td class="text-right">'.$nb4.'</td>';	
		echo '<td class="text-right">'.$nb5.'</td>';	
		echo '<td class="text-right">'.$days."</br>".anchor(site_url()."beli/view_pay/".$idbeli, $pay).'</td>';	
	echo '</tr>';
	}
}
	$i++; $TA = $TA+$nt; $TA1 = $TA1+$ca; $TA2 = $TA2+$b1; $TA3 = $TA3+$b2; $TA4 = $TA4+$b3; $TA5 = $TA5+$b4; $TA6 = $TA6+$b5; 
	$Tpay = $Tpay+$this->bbm_model->JmlSisaBayarBeli($this->jurnal_model->IdBeli($no));
}
}else{ $TA =0; $TA1 =0; $TA2 =0; $TA3 =0; $TA4 =0; $TA5 =0; $TA6 =0; $Tpay =0;
}
$nTA = number_format(($TA), 0, '', '.');
$nTA1 = number_format(($TA1), 0, '', '.');
$nTA2 = number_format(($TA2), 0, '', '.');
$nTA3 = number_format(($TA3), 0, '', '.');
$nTA4 = number_format(($TA4), 0, '', '.');
$nTA5 = number_format(($TA5), 0, '', '.');
$nTA6 = number_format(($TA6), 0, '', '.');
$nTpay = number_format(($Tpay), 0, '', '.');
echo '<tr>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td class="text-right">'.$nTA.'</td>';	
	echo '<td class="text-right">'.$nTA1.'</td>';	
	echo '<td class="text-right">'.$nTA2.'</td>';	
	echo '<td class="text-right">'.$nTA3.'</td>';	
	echo '<td class="text-right">'.$nTA4.'</td>';	
	echo '<td class="text-right">'.$nTA5.'</td>';	
	echo '<td class="text-right">'.$nTA6.'</td>';	
	echo '<th class="text-right">Sisa : '.$nTpay.'</th>';	
echo '</tr>';
?>											
								</table>
							</td>
						</tr>
					<?php } ?>
				<?php endforeach;?>
		<?php } ?>
			<?php			
			?>		
		</tbody>	
	</table>
                </div><!-- /.box-body -->
<?php } ?>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
