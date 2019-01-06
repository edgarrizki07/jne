<script type="text/javascript">
$(document).ready(function(){

$("#produk").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#angkutan").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });

});	
</script>
<!-- Page Right Column -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
	<?php if($info['cek'] =='0'){ ?>
			<a target="_blank" href="<?php echo site_url('so/pdf/'.$info['id']);?>" class="btn btn-success" ><i class='fa fa-print'></i> Print</a>
			<a href="<?php echo site_url('so/add/'.$info['id']);?>" class="btn btn-success" ><i class='fa fa-edit'></i> Edit</a>
			<a href="<?php echo site_url('so');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
		<?php if($this->session->userdata('ADMIN')<='2'){ ?>
			<?php if($info['status'] =='1'){ ?>
				<a href="<?php echo site_url('so/acc/'.$info['id']);?>" class="btn btn-info" ><i class='fa fa-check-square-o'></i> Selesai/ACC</a>
			<?php } ?>
		<?php } ?>
		| Stok : <?php $stok = $this->bbm_model->JmlInventory($this->session->userdata('SESS_WP_ID')) ; echo  number_format ($stok, 0, ',', '.');?> Liter
	<?php }else{ ?>
			<a href="<?php echo site_url('so/cancel');?>" class="btn btn-warning" ><i class='fa fa-reply'></i>  Kembali</a>
	<?php } ?>
			<h4 class="text-center text-bold">SALES ORDER NO <?php echo $info['id_po'];?> <?php if($info['cek'] !='0'){ ?>INI TELAH DIHAPUS oleh : <?php echo $this->user_model->NamaUser($info['login_id']); ?> <?php echo $this->user_model->NamaBUser($info['login_id']); ?><?php } ?></h4>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
	$this->session->unset_userdata('SUCCESSMSG'); } ?>
	<section class="content invoice">
		<!-- info row -->
		<div class="row">
			<div class="col-xs-6">
				<table class="table table-bordered">
				<tr>
					<td><strong><?php echo $title;?> for :</strong></td>
				</tr>
				<tr>
					<td>
				<?php $Customer = $info['customer_id'];?><strong><?php echo $this->customer_model->NamaCustomer($Customer);?></strong><br>
				<?php $npwp=$this->customer_model->NPWPCustomer($Customer);?>
				<strong>NPWP :  <?php echo substr($npwp,0,2);?>.<?php echo substr($npwp,2,3);?>.<?php echo substr($npwp,5,3);?>.<?php echo substr($npwp,8,1);?>-<?php echo substr($npwp,9,3);?>.<?php echo substr($npwp,12,3);?></strong><br>
				<strong>Alamat :</strong><br>
				<?php echo $this->customer_model->AlamatCustomer($Customer);?><br>
				Phone : <?php echo $this->customer_model->TelpCustomer($Customer);?> 
				Fax : <?php echo $this->customer_model->FaxCustomer($Customer);?> 
				Email : <?php echo $this->customer_model->EmailCustomer($Customer);?>
					</td>
				</tr>
				</table>
			</div><!-- /.col -->
			<div class="col-xs-6">
				<table class="table" width='100%'>
				<h5 class="text-center text-bold">Detail</h5>
				<tr>
					<td>No SO</br><b class="text-red">Tgl SO</b></br>No PO</br>Tgl PO</br>Customer ID</td>
					<td> : </br> : </br> : </br> : </br> : </td>
					<td><?php echo $info['id_po'];?></br><b class="text-red"><?php echo $this->jurnal_model->tgl_singkatan($info['tglso']);?></b></br><?php echo $info['nopo'];?></br><?php echo $this->jurnal_model->tgl_singkatan($info['tglpo']);?></br>C-<?php echo $info['customer_id'];?>/<?php echo $this->customer_model->KodeCustomer($info['customer_id']);?></td>
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
							<td colspan="4" ><b class="text-red">Alamat Kirim : <?php echo $this->bbm_model->AlamatKirim($info['kirim']);?></b></td>
						</tr>
						<tr class="text-bold">
							<td>Volume</td>
							<td>Sales Person</td>
							<td>Payment Terms</td>
							<td>Due Date</td>
							<td><b class="text-red">Delivery Date</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $info['jml'];?></td>
							<td><?php echo $info['sales'];?></td>
							<td><?php echo $info['term'];?></td>
							<td><?php echo $this->jurnal_model->tgl_singkatan($info['tempo']);?></td>
							<td><b class="text-red"><?php echo $this->jurnal_model->tgl_singkatan($info['tglkirim']);?></b></td>
						</tr>
						<tr class="text-bold">
							<td colspan="4" ><b class="text-red">Keterangan : <?php echo $info['keterangan'];?></b></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row invoice-info">
			<!-- accepted payments column -->
			<div class="col-xs-12">
				<div class="table">
					<table class="table table-bordered table-striped">
					<tbody>
						<tr class="text-bold">
							<td colspan="6" align="center">PERIODE</td>
						</tr>
						<tr class="text-bold">
							<td colspan="3" align="center">PEMBELIAN</td>
							<td colspan="3" align="center">PENJUALAN</td>
						</tr>
						<tr>
<?php 
// User 
$sales = $info['sales']; $cso_id = $this->user_model->NamaUser($info['cso_id']); $admin_id = $this->user_model->NamaUser($info['admin_id']);

// Text PO MASUK & SO------------------------------------------------------------------
$no = $info['id_po']; $nopo = $info['nopo']; $term = $info['term']; 
$kirim = $info['kirim'];  $terbilang = $info['terbilang'];  $keterangan = $info['keterangan']; 

// 0 / 1 ------------------------------------------------------------------
$ppn = $info['ppn']; $pph = $info['pph']; $pbbkb = $info['pbbkb']; $ppnohp = $info['ppnohp']; 
$b_ppn = $info['b_ppn']; $b_pph = $info['b_pph']; $b_pbbkb = $info['b_pbbkb']; $b_ppnohp = $info['b_ppnohp']; 
$ib_ppn = $info['ib_ppn']; $ib_pph = $info['ib_pph']; $ib_pbbkb = $info['ib_pbbkb']; 
$oat = $info['oat']; $pph21 = $info['pph21'];

// Numerik ------------------------------------------------------------------
$jml = $info['jml']; $harga = $info['harga']; $ohp = $info['ohp']; $npbbkb = $info['npbbkb']; $b_harga = $info['b_harga']; $b_ohp = $info['b_ohp']; $b_npbbkb = $info['b_npbbkb']; $ib_npbbkb = $info['ib_npbbkb'];
$oat_b1 = $info['oat_b1']; $oat_j1 = $info['oat_j1']; $bopr = $info['oat_b2']; $badm = $info['oat_j2']; $fee = $info['fee']; $icof = $info['cof']; $cof = $info['cof'];
$top = $info['top']; $migas = $info['migas']; 

//Number Format -------------------------------------------------------------------
$nvol = number_format($jml); $nharga = number_format($harga, 2, ',', '.'); $nohp = number_format($ohp, 2, ',', '.'); $nb_harga = number_format($b_harga, 2, ',', '.');
$nmaint = number_format($b_ohp, 2, ',', '.'); $noat_b1 = number_format($oat_b1, 2, ',', '.'); $noat_j1 = number_format($oat_j1, 2, ',', '.');
$nbopr = number_format($bopr, 0, ',', '.'); $nbadm = number_format($badm, 0, ',', '.'); $nfee = number_format($fee, 2, ',', '.');

//Perhitungan SO -------------------------------------------------------------------
$n_ppnj = $harga*$ppn/10; $n_pphj = $harga*$pph*3/1000; $n_pbbkbj = $harga*($npbbkb/100)*$pbbkb; $n_hitj = $harga+$n_ppnj+$n_pphj+$n_pbbkbj;
$n_toat = $ohp+($ohp*$ppnohp/10); $n_hinv = $n_hitj+$n_toat; $n_ppnb = $b_harga*$b_ppn/10; $n_pphb = $b_harga*$b_pph*3/1000;
$n_pbbkbb = $b_harga*($b_npbbkb/100)*$b_pbbkb;  $n_hitb = $b_harga+$n_ppnb+$n_pphb+$n_pbbkbb; $n_maint = $b_ohp; $n_hppb = $n_hitb+$n_maint;
$ppnj = number_format($n_ppnj, 2, ',', '.'); $pphj = number_format($n_pphj, 2, ',', '.'); $pbbkbj = number_format($n_pbbkbj, 2, ',', '.');
$hitj = number_format($n_hitj, 2, ',', '.'); $toat = number_format($n_toat, 2, ',', '.'); $hinv = number_format($n_hinv, 2, ',', '.');
$ppnb = number_format($n_ppnb, 2, ',', '.'); $pphb = number_format($n_pphb, 2, ',', '.'); $pbbkbb = number_format($n_pbbkbb, 2, ',', '.');
$hitb = number_format($n_hitb, 2, ',', '.'); $maint = number_format($n_maint, 2, ',', '.'); $hppb = number_format($n_hppb, 2, ',', '.');

//Perhitungan TAX FEE MARKETING -------------------------------------------------------------------
$pot10 = number_format(($fee*$oat)/10, 2, ',', '.'); $pot3 = number_format(($fee*$pph21)*(3/100), 2, ',', '.'); $tem = number_format($pot10+$pot3, 2, ',', '.');

//Perhitungan Laba Kotor -------------------------------------------------------------------
$n_lbkot = $n_hinv-$n_hppb; $n_biop = $bopr/$jml; $n_biad = $badm/$jml; $n_cof = $n_hitb/100*$cof*$top; $n_sppn = $n_ppnj-$n_ppnb;
$n_migas = $n_hitj*$migas/100; $n_tout = $oat_b1+$oat_j1+$n_biop+$n_biad+$n_cof+$n_sppn+$n_pphj+$n_pbbkbj+$n_migas+$fee;
$lbkot = number_format($n_lbkot, 2, ',', '.'); $biop = number_format($n_biop, 2, ',', '.'); $biad = number_format($n_biad, 2, ',', '.'); $cof = number_format($n_cof, 2, ',', '.');
$sppn = number_format($n_sppn, 2, ',', '.'); $migas = number_format($n_migas, 2, ',', '.'); $tout = number_format($n_tout, 2, ',', '.');
$n_toatb = $oat_b1*$jml; $n_toatj = $oat_j1*$jml; $n_tcof = $n_cof*$jml; $n_tsppn = $n_sppn*$jml; $n_tpph = $n_pphj*$jml; $n_tpbbkb = $n_pbbkbj*$jml;
$n_tmigas = $n_migas*$jml; $n_sfee = $fee-$tem; $n_tfee = $n_sfee*$jml;
$toatb = number_format($n_toatb, 0, ',', '.'); $toatj = number_format($n_toatj, 0, ',', '.'); $tcof = number_format($n_tcof, 0, ',', '.');
$tsppn = number_format($n_tsppn, 0, ',', '.'); $tpph = number_format($n_tpph, 0, ',', '.'); $tpbbkb = number_format($n_tpbbkb, 0, ',', '.');
$tmigas = number_format($n_tmigas, 0, ',', '.'); $tfee = number_format($n_tfee, 0, ',', '.'); $sfee = number_format($n_sfee, 2, ',', '.');

//Perhitungan Laba Bersih -------------------------------------------------------------------
$n_lbber = $n_lbkot-$n_tout; $n_lbcof = $n_lbber+$n_cof; $n_lbcoftfm = $n_lbcof+$tem;
$n_tlbber = $n_lbber*$jml; $n_tlbcof = $n_lbcof*$jml; $n_tlbcoftfm = $n_lbcoftfm*$jml;
if($info['b_harga'] =='0'){ $n_plbber = 0; $n_plbcof = 0; $n_plbcoftfm = 0;
}else{ $n_plbber = ($n_lbber/$n_hppb)*100; $n_plbcof = ($n_lbcof/$n_hppb)*100; $n_plbcoftfm = ($n_lbcoftfm/$n_hppb)*100; }
$lbber = number_format($n_lbber, 2, ',', '.'); $lbcof = number_format($n_lbcof, 2, ',', '.'); $lbcoftfm = number_format($n_lbcoftfm, 2, ',', '.');
$tlbber = number_format($n_tlbber, 0, ',', '.'); $tlbcof = number_format($n_tlbcof, 0, ',', '.'); $tlbcoftfm = number_format($n_tlbcoftfm, 0, ',', '.');
$plbber = number_format($n_plbber, 0, ',', '.'); $plbcof = number_format($n_plbcof, 0, ',', '.'); $plbcoftfm = number_format($n_plbcoftfm, 0, ',', '.');

//Info Pembelian & Penjualan -------------------------------------------------------------------
$n_hdp = $info['hdp']; $n_discount = $info['discount']; $n_savlb = $info['savlb']; 
$r_discount = ($n_discount*$n_hdp)/100; $n_hdad = $n_hdp-$r_discount; $r_savlb = $n_hdad+$n_savlb;
$margin = $info['margin']; $n_margin = ($margin*$n_hdad)/100; $t_margin = number_format($n_margin, 2, ',', '.'); 
$hdp = number_format($n_hdp, 2, ',', '.'); $discount = number_format($n_discount, 6, ',', '.'); $savlb = number_format($n_savlb, 2, ',', '.');
$t_discount = number_format($r_discount, 2, ',', '.'); $t_hdad = number_format($n_hdad, 2, ',', '.'); $t_savlb = number_format($r_savlb, 2, ',', '.');
$i_ppn = $n_hdad*$ib_ppn/10; $il_ppn = $r_savlb*$ib_ppn/10; $i_pph = $n_hdad*$ib_pph*0.003; $il_pph = $r_savlb*$ib_pph*0.003; $i_pbbkb = $ib_pbbkb*($n_hdad*$ib_npbbkb)/100; $il_pbbkb = $ib_pbbkb*($r_savlb*$ib_npbbkb)/100;  
$i_pajak1 = $n_hdad+$i_ppn; $il_pajak1 = $r_savlb+$il_ppn; $i_pajak2 = $n_hdad+$i_ppn+$i_pph; $il_pajak2 = $r_savlb+$il_ppn+$il_pph;
$i_pajak3 = $n_hdad+$i_ppn+$i_pbbkb; $il_pajak3 = $r_savlb+$il_ppn+$il_pbbkb; $i_pajak4 = $n_hdad+$i_ppn+$i_pph+$i_pbbkb; $il_pajak4 = $r_savlb+$il_ppn+$il_pph+$il_pbbkb;
$j_ppn = number_format($i_ppn, 2, ',', '.'); $jl_ppn = number_format($il_ppn, 2, ',', '.'); 
$j_pph = number_format($i_pph, 2, ',', '.'); $jl_pph = number_format($il_pph, 2, ',', '.'); 
$j_pbbkb = number_format($i_pbbkb, 2, ',', '.'); $jl_pbbkb = number_format($il_pbbkb, 2, ',', '.'); 
$j_pajak1 = number_format($i_pajak1, 2, ',', '.'); $jl_pajak1 = number_format($il_pajak1, 2, ',', '.'); 
$j_pajak2 = number_format($i_pajak2, 2, ',', '.'); $jl_pajak2 = number_format($il_pajak2, 2, ',', '.'); 
$j_pajak3 = number_format($i_pajak3, 2, ',', '.'); $jl_pajak3 = number_format($il_pajak3, 2, ',', '.'); 
$j_pajak4 = number_format($i_pajak4, 2, ',', '.'); $jl_pajak4 = number_format($il_pajak4, 2, ',', '.'); 
?>
							<th>Harga Include Tax<br><b class="text-red">Harga Dasar<br>PPn 10%<br>PPh 0,3%<br>PBBKB <?php echo $info['b_npbbkb'];?>%</b>
								<br>Crosscek Tax<br><b class="text-red">Maintenance</b><br>HPP Pembelian</th>
							<td>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp</td>
							<td align="right"><?php echo $hitb;?><b class="text-red"><br><?php echo $nb_harga;?><br><?php echo $ppnb;?><br><?php echo $pphb;?><br><?php echo $pbbkbb;?></b><br><?php echo $hitb;?><br><b class="text-red"><?php echo $nmaint;?></b><br><?php echo $hppb;?>
							</td>
							<th>Harga Include Tax<br>Harga Dasar<br>PPn 10%<br>PPh 0,3%<br>PBBKB <?php echo $info['npbbkb'];?>%
								<br>Crosscek Tax<br>Ongkos Angkut<br>Harga Invoice</th>
							<td>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp</td>
							<td align="right"><?php echo $hitj;?><br><?php echo $nharga;?><br><?php echo $ppnj;?><br><?php echo $pphj;?><br><?php echo $pbbkbj;?><br><?php echo $hitj;?><br><?php echo $toat;?><br><?php echo $hinv;?>
							</td>
						</tr>
						<tr class="text-bold">
							<td>Laba Kotor</td>
							<td>Rp</td>
							<td align="right"><?php echo $lbkot;?></td>
							<td colspan="3" align="center"></td>
						</tr>
						<tr>
							<th><b class="text-red">OAT Pembelian<br>OAT Penjualan<br>Biaya Operasional<br>Biaya Administrasi<br>Cost Of Funder<br></b>Selisih PPn 10%<br>Pungutan PPh 22<br>Pungutan PBBKB <?php echo $info['npbbkb'];?>%<br><b class="text-red">Pungutan BPH Migas <?php echo $info['migas'];?>%<br>Fee Marketing</b><br><b>Total Pengeluaran</b></th>
							<td>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br><b>Rp</b></td>
							<td align="right"><b class="text-red"><?php echo $noat_b1;?><br><?php echo $noat_j1;?></b><br><?php echo $biop;?><br><?php echo $biad;?><br><?php echo $cof;?><br><?php echo $sppn;?><br><?php echo $pphj;?><br><?php echo $pbbkbj;?><br><?php echo $migas;?><br><b class="text-red"><u><?php echo $nfee;?></u></b><br><b><?php echo $tout;?></b>
							</td>
							<td align="right"><?php echo $toatb;?><br><?php echo $toatj;?><br><b class="text-red"><?php echo $nbopr;?><br><?php echo $nbadm;?></b><br><?php echo $tcof;?><br><?php echo $tsppn;?><br><?php echo $tpph;?><br><?php echo $tpbbkb;?><br><?php echo $tmigas;?><br><u><?php echo $tfee;?></u>
							</td>
							<td><br><br><br><br><br><br><br><br><br><u>Rp</u></td>
							<td align="right"><br><br><br><br><br><br><br><br><br><u><?php echo $sfee;?></u></td>
						</tr>
						<tr>
							<th>Laba Bersih<br>L.B + C.O.F<br>L.B + C.O.F + T.F.M</th>
							<td>Rp<br>Rp<br>Rp</td>
							<td align="right"><b><?php echo $lbber;?><br><?php echo $lbcof;?><br><?php echo $lbcoftfm;?></b></td>
							<td align="right"><?php echo $tlbber;?><br><?php echo $tlbcof;?><br><?php echo $tlbcoftfm;?></td>
							<td align="center"></td>
							<td align="center"><?php echo $plbber;?> %<br><?php echo $plbcof;?> %<br><?php echo $plbcoftfm;?> %</td>
						</tr>
						<tr>
							<th>TAX FEE MARKETING<br>Potongan PPN 10%<br>Potongan PPN 3%</th>
							<td>Rp<br>Rp<br>Rp</td>
							<td align="right"><b><?php echo $tem;?><br><?php echo $pot10;?><br><?php echo $pot3;?></b></td>
							<td align="center"></td>
							<td align="center"></td>
							<td align="center"></td>
						</tr>
					</tbody>
					</table>
				</div>
			</div><!-- /.col -->
			<div class="col-xs-12">
				<div class="table">
					<table class="table table-bordered table-striped">
					<tbody>
						<tr class="text-bold">
							<td colspan="6" align="center">Info Penjualan</td>
						</tr>
						<tr>
							<td><b class="text-red">Nama Sales<br>Volume (S)<br>C.O.F<br>T.O.P<br>Margin Min</b><br><br>Bidang Usaha</td>
							<td>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp</td>
							<td align="right"><b class="text-red"><?php echo $sales;?></b>
								<br><b class="text-red"><?php echo $nvol;?></b>
								<br><b class="text-red"><?php echo $icof;?> %</b>
								<br><b class="text-red"><?php echo $top;?> hari</b>
								<br><b class="text-red"><?php echo $margin;?> %</b>
								<br><?php echo $t_margin;?>
								<br><?php echo $t_hdad;?>
								<br>
							</td>
						</tr>
						<tr class="text-bold">
							<td colspan="6" align="center">Info Pembelian</td>
						</tr>
						<tr>
							<td><br><b class="text-red">HDP<br>Discount<br>Saving Laba</b><br>Harga Dasar After Diskon<br>PPN<br>PPH<br>PBBKB<br>1. PPN<br>2. PPN+PPH<br>3. PN+PBBKB<br>4. PPN+PPH+PBBKB</td>
							<td><br>Rp<br><br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp</td>
							<td align="right">
								<br><b class="text-red"><?php echo $hdp;?></b>
								<br><b class="text-red"><?php echo $discount;?> %</b>
								<br><b class="text-red"><?php echo $savlb;?></b>
								<br><?php echo $t_hdad;?>
								<br><?php echo $j_ppn;?>
								<br><?php echo $j_pph;?>
								<br><?php echo $j_pbbkb;?>
								<br><?php echo $j_pajak1;?>
								<br><?php echo $j_pajak2;?>
								<br><?php echo $j_pajak3;?>
								<br><?php echo $j_pajak4;?>
								<br>
							</td>
							<td><br><br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp<br>Rp</td>
							<td align="right">
								<b>Save Laba</b>
								<br>
								<br><?php echo $t_discount;?>
								<br><b class="text-red"><?php echo $savlb;?></b>
								<br><?php echo $t_savlb;?>
								<br><?php echo $jl_ppn;?>
								<br><?php echo $jl_pph;?>
								<br><?php echo $jl_pbbkb;?>
								<br><?php echo $jl_pajak1;?>
								<br><?php echo $jl_pajak2;?>
								<br><?php echo $jl_pajak3;?>
								<br><?php echo $jl_pajak4;?>
								<br>
							</td>
						</tr>
					</tbody>
					</table>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<!-- Table row -->
	</section><!-- /.content -->
<div class="clearfix"></div>
</div><!-- /.content-wrapper -->	<!-- end Page Right Column -->