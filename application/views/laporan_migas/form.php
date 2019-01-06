<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-reset').click(function() {
			location.href = '<?php echo site_url();?>laporan_migas/'
		});
		$('#button-view').click(function() {
			var thn1 = $('#tahun1').val();
			var thn2 = $('#tahun2').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			location.href = '<?php echo site_url();?>laporan_migas/index/'+thn1+'/'+thn2+'/'+from+'/'+to;
		});
		$('#button-print').click(function() {
			var thn1 = $('#tahun1').val();
			var thn2 = $('#tahun2').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>laporan_migas/pdf/'+thn1+'/'+thn2+'/'+from+'/'+to);
		});
		$('#button-xls').click(function() {
			var thn1 = $('#tahun1').val();
			var thn2 = $('#tahun2').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>laporan_migas/excel/'+thn1+'/'+thn2+'/'+from+'/'+to);
		});
	});
</script>
<?php
	$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5); $uri6 = $this->uri->segment(6);
	$judul='Debitur / Customer';
?> 

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
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
                  <h3 class="box-title">RENCANA & REALISASI</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table id="" class="table table-bordered table-striped">
						<tr>
							<th class="col-xs-6">
								<?php echo form_label('INVESTASI DALAM TAHUN ','tahun1'); ?>
							<td>
								<?php 
									echo '<div class="input-group">';
									$data['id'] = 'tahun1';
									$data['class'] = 'form-control';
									$selected = date("Y") ;
									echo form_dropdown('tahun1', $years1, $selected, $data);
									echo '<span class="input-group-addon"> s/d </span>';
									$data['id'] = 'tahun2';
									$data['class'] = 'form-control';
									$selected = date("Y")+2 ;
									echo form_dropdown('tahun2', $years2, $selected, $data);
									echo '</div>';
								?>					
							</td>
						</tr>								
						<tr>
							<th><?php echo form_label('DAFTAR FASILITAS NIAGA, PENYEDIAAN DAN PENJUALAN BBM PERIODE ','from_to'); ?></th>
							<td>
								<?php 
									if($this->uri->segment(3) ==''){$tanggal1=date('Y-m-1');}else{ $tanggal1=$this->uri->segment(3);}
									if($this->uri->segment(4) ==''){$tanggal2=date('Y-m-d');}else{ $tanggal2=$this->uri->segment(4);}
									$tanggalfrom['name'] = 'from';
									$tanggalfrom['id'] = 'datepicker-from';
									$tanggalfrom['class']='form-control';
									$tanggalfrom['value']= $tanggal1;
									echo '<div class="input-group">';
									echo form_input($tanggalfrom);
									echo '<span class="input-group-addon"> s/d </span>';
									$tanggalto['name'] = 'to';
									$tanggalto['id'] = 'datepicker-to';										
									$tanggalto['class']='form-control';
									$tanggalto['value'] = $tanggal2 ;										
									echo form_input($tanggalto);
									echo '</div>';
								?>					
							</td>	
						</tr>	
					</table>
                </div><!-- /.box-body -->

				<div class="box-footer">
					<div class="btn-group">
					<?php
						// echo form_button('cari', 'Cari', "id = 'button-view', class = 'btn btn-info'" );
						echo form_button('cari', 'Cetak', "id = 'button-print', class = 'btn btn-primary'" );
						echo form_button('cari', 'Excel', "id = 'button-xls', class = 'btn btn-warning'" );
						echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
					?>
					</div>
				</div>
	
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
