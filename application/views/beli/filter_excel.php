<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rekap_Penbelian_.xls");
header("Pragma: no-cache");
header("Expires: 0");
$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
if($uri5==''){	$cabang = 'Semua'; 	}else{	$cabang = $this->pajak_model->KotaCabang($uri5); 	}
$nama = $this->setting_model->Nama(); 
$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
$tgl1 = $this->jurnal_model->tgl_str($this->uri->segment(3));
$tgl2 = $this->jurnal_model->tgl_str($this->uri->segment(4));
$sekarang = date("d-m-Y");
?>
  <h3 class="box-title">Rekap Penbelian </h3> <?php if($uri3==''){ ?><?php }else{ ?><h4 class="pull-right">Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?></h4><?php } ?>
						<table id="group_table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>ID / Status</th>
									<th>Tgl</th>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>Cabang</th>
								<?php } ?>
									<th>Vendor</th>
									<th>Volume</th>
									<th>Sub Total</th>
									<th>Discount</th>
									<th>Nilai Discount</th>
									<th>Total Amount</th>
									<th>PPN</th>
									<th>PBBKB</th>
									<th>PPH</th>
									<th>Transport</th>
									<th>PPN Transport</th>
									<th>Grand Total</th>
								</tr>
							</thead>
	
<?php if($isi->num_rows()>0){
		$vol=0;
		$g_total=0;
		$g_total1=0;
		$g_total2=0;
		$g_total3=0;
		$g_total4=0;
		$g_total5=0;
		$g_total6=0;
		$g_total7=0;
		$no =1;
		foreach($isi->result_array() as $db){
		?>    
	<?php $item = '1'; $qty=$db['jml']; $jml=$db['jml']*$db['harga']; $d=$db['discount'];?>
	<tbody>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $db['jurnal_id'];?>/INV/<?php echo $this->pajak_model->KodeCabang($db['wp_id']);?>/<?php echo $db['id'];?> - <?php if($db['status'] =='2'){ ?>Success<?php } else if($db['status'] =='3'){ ?>Pay Prosses<?php } else if($db['status'] =='4'){ ?>Paid<?php } ?></td>
			<td><?php echo $this->app_model->tgl_str($db['tgl']);?></td>
		<?php if($this->session->userdata('ADMIN') =='1'){ ?>
			<td><?php echo $this->pajak_model->KotaCabang($db['wp_id']);?> - <?php echo $this->user_model->NamaUser($db['login_id']);?></td>
		<?php } ?>
			<td><?php echo $this->supplier_model->NamaSupplier($db['supplier_id']);?></td>
			<td><?php echo number_format ($qty, 0, ',', '.');?> Ltr</td>
			<td><?php echo number_format ($db['tot1'], 0, ',', '.');?></td>
			<td><?php if($d=='0'){ ?>no disc.<?php }else{ ?>- disc.<?php echo $d;?>%<?php } ?></td>
			<td><?php echo number_format ($db['tot2'], 0, ',', '.');?></td>
			<td><?php echo number_format ($db['tot3'], 0, ',', '.');?></td>
			<td><?php echo number_format ($db['tot4'], 0, ',', '.');?></td>
			<td><?php echo number_format ($db['tot5'], 0, ',', '.');?></td>
			<td><?php echo number_format ($db['tot6'], 0, ',', '.');?></td>
			<td><?php if($db['ohp']==''){ ?><?php echo number_format ($db['tot9'], 0, ',', '.');?><?php }else{ ?><?php echo number_format (($db['tot7']), 0, ',', '.');?></td>
			<td><?php echo number_format ($db['tot8'], 0, ',', '.');?></td>
			<td><?php echo number_format ($db['tot9'], 0, ',', '.');?><?php } ?></td>
		</tr>
	</tbody>
    <?php
		$no++;
		$vol = $vol+$qty;
		$g_total = $g_total+$db['tot1'];
		$g_total1 = $g_total1+$db['tot2'];
		$g_total2 = $g_total2+$db['tot3'];
		$g_total3 = $g_total3+$db['tot4'];
		$g_total4 = $g_total4+$db['tot5'];
		$g_total5 = $g_total5+$db['tot6'];
		$g_total6 = $g_total6+$db['tot7'];
		$g_total7 = $g_total7+$db['tot8'];
		$g_total8 = $g_total8+$db['tot9'];
		}
	}else{ $g_total =0;	?>
    <tfoot>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    </tfoot>
    <?php } ?>
<?php if($g_total=='0'){ ?><?php }else{ ?>
    <tfoot>
        <tr>
			<?php if($this->session->userdata('ADMIN')=='1'){ ?>
			<th colspan="5"><b class="pull-center">TOTAL</th>
			<?php }else{ ?>
			<th colspan="4"><b class="pull-center">TOTAL</th>
			<?php } ?>
			<th><?php echo number_format ($vol, 0, ',', '.');?> Ltr</th>
			<th><?php echo number_format ($g_total, 0, ',', '.');?></th>
			<th></th>
			<th><?php echo number_format ($g_total1, 0, ',', '.');?></th>
			<th><?php echo number_format ($g_total2, 0, ',', '.');?></th>
			<th><?php echo number_format ($g_total3, 0, ',', '.');?></th>
			<th><?php echo number_format ($g_total4, 0, ',', '.');?></th>
			<th><?php echo number_format ($g_total5, 0, ',', '.');?></th>
			<th><?php echo number_format ($g_total6, 0, ',', '.');?></th>
			<th><?php echo number_format ($g_total7, 0, ',', '.');?></th>
			<th><?php echo number_format ($g_total8, 0, ',', '.');?></th>
        </tr>
    </tfoot>
<?php } ?>
						</table>
