<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Laba_Rugi.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php

	$npwp = $wajib_pajak_data['npwp'];
	$nama = $wajib_pajak_data['nama'];
	$nama_pemilik = $wajib_pajak_data['pemilik'];
	$alamat = $wajib_pajak_data['alamat'];
	$kota = $wajib_pajak_data['kota'];
	$sekarang = date("j").' '.nama_bulan(date("m")).' '.date("Y");
	$periode = 'Periode ';
	if($bulan) $periode .= "Bulan $bulan ";
	if($tahun) $periode .= "Tahun $tahun";

$sum_pendapatan_proyek = 0;
if(isset($laba_rugi_data[1][4])){	foreach ($laba_rugi_data[1][4] as $key => $row)	{		$sum_pendapatan_proyek += -$row['saldo'];	}}
$sum_biaya_proyek = 0;
if(isset($laba_rugi_data[1][5])){	foreach ($laba_rugi_data[1][5] as $key => $row)	{		$sum_biaya_proyek += $row['saldo'];	}}
$laba_kotor = $sum_pendapatan_proyek - $sum_biaya_proyek;
$sum_pendapatan = 0;
if(isset($laba_rugi_data[0][4])){	foreach ($laba_rugi_data[0][4] as $key => $row)	{		$sum_pendapatan += -$row['saldo'];	}}
$sum_biaya = 0;
if(isset($laba_rugi_data[0][5]))
{	foreach ($laba_rugi_data[0][5] as $key => $row)	{		$sum_biaya += $row['saldo'];	}}
$sum = $laba_kotor + $sum_pendapatan - $sum_biaya;
$laba_rugi = ($sum < 0) ? 'Rugi' : 'Laba' ;

?> 
	<table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th colspan="6"><h3 class="box-title"><?php echo $nama; ?></h3></th>
			</tr>
			<tr>
				<th colspan="6"><h3><?php echo $alamat; ?></h3></th>
			</tr>
			<tr>
				<th colspan="6">NPWP : <?php echo $npwp; ?></th>
			</tr>
			<tr>
				<th colspan="6"><?php echo $title; ?></th>
			</tr>
			<tr>
				<th colspan="6"><?php if($periode != 'Periode ') echo $periode; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th colspan="3">AKTIVA</th>
				<th colspan="3">PASIVA</th>
			</tr>
			<tr>
				<td>AKTIVA</td>
				<td></td>
				<td></td>
				<td>KEWAJIBAN</td>
				<td></td>
				<td></td>
			</tr>
<?php 
$i = 0;
$sum_aktiva = 0;
if(isset($neraca_data[1]))
{
	foreach ($neraca_data[1] as $key => $row)
	{
		if($row['saldo'] !='0'){
		echo '<tr>';
		echo '<td>'.$row['nama'].'</td>';
		echo '<td>Rp '.$row['saldo'].'</td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		$sum_aktiva += $row['saldo'];
		$i++;
		echo '</tr>';
		}        
	}
}

$j = 0;
$sum_kewajiban = 0;
if(isset($neraca_data[2]))
{
	foreach ($neraca_data[2] as $key => $row)
	{
		if($row['saldo'] !='0'){
		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>'.$row['nama'].'</td>';
		echo '<td>Rp '.-$row['saldo'].'</td>';
		echo '<td></td>';
		$sum_kewajiban += -$row['saldo'];
		$j++;
		echo '</tr>';
		}        
	}
}

		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>Total Kewajiban</td>';
		echo '<td></td>';
		echo '<td>Rp '.$sum_kewajiban.'</td>';
		$j++;
		echo '</tr>';

		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		$j++;
		echo '</tr>';

		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>MODAL</td>';
		echo '<td></td>';
		echo '<td></td>';
		$j++;
		echo '</tr>';

$sum_modal = 0;
if(isset($neraca_data[3]))
{
	foreach ($neraca_data[3] as $key => $row)
	{
		if($row['saldo'] !='0'){
		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>'.$row['nama'].'</td>';
		echo '<td>Rp '.-$row['saldo'].'</td>';
		echo '<td></td>';
		$sum_modal += -$row['saldo'];
		$j++;
		echo '</tr>';
		}        
	}
}
		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>Laba</td>';
		echo '<td></td>';
		echo '<td>Rp '.$sum.'</td>';
		$j++;
		if($row['saldo'] !='0'){
		echo '</tr>';

		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>Total Modal</td>';
		echo '<td></td>';
		echo '<td>Rp '.$sum_modal+$sum.'</td>';
		$j++;
		echo '</tr>';
		}        

for($k=0; $k<=max($i,$j); $k++)
{
	$this->fpdf->Ln();
	if(isset($content[0][$k][0]))
	{
		echo '<tr>';
		echo '<td>'.$content[0][$k][0].'</td>';
		echo '<td>'.$content[0][$k][1].'</td>';
		echo '<td>'.$content[0][$k][2].'</td>';
		echo '</tr>';
	}
	else
	{
		echo '<td></td>';
	}

	$this->fpdf->Cell(0.1,0.5,"",'LR',0,'L');

	if(isset($content[1][$k][0]))
	{
		echo '<td>'.$content[1][$k][0].'</td>';
		echo '<td>'.$content[1][$k][1].'</td>';
		echo '<td>'.$content[1][$k][2].'</td>';
		echo '</tr>';
	}
	else
	{
		echo '<td></td>';
	}
}

?>
			<tr>
				<td><b>Total Aktiva</b></td>
				<td></td>
				<td><b>Rp <?php echo $sum_aktiva; ?></b></td>
				<td><b>Total Pasiva</b></td>
				<td></td>
				<td><b>Rp <?php echo $sum_kewajiban+$sum_modal+$sum; ?></b></td>
			</tr>
		</tbody>	
		<tfoot>
<?php $sekarang = date("d-m-Y"); ?>
			<tr>
				<th></th>
			</tr>	
			<tr>
				<th colspan="6"><?php echo $kota; ?>, <?php echo $sekarang; ?></th>
			</tr>	
			<tr>
				<th></th>
			</tr>	
			<tr>
				<th></th>
			</tr>	
			<tr>
				<th colspan="6"><?php echo $nama_pemilik; ?></th>
			</tr>	
			<tr>
				<th colspan="6">Direktur</th>
			</tr>	
		</tfoot>
	</table>
