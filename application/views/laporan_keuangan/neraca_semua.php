<?php

$logo=base_url().'images/'.$this->setting_model->Logo1();
$nama = $this->setting_model->Nama(); 
$cabang = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID'));
$telp = $this->pajak_model->TelpCabang($this->session->userdata('SESS_WP_ID'));
$fax = $this->pajak_model->FaxCabang($this->session->userdata('SESS_WP_ID'));
$email = $this->pajak_model->EmailCabang($this->session->userdata('SESS_WP_ID'));
$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID'));
	$nama_pemilik = $wajib_pajak_data['pemilik'];
	$kota = $wajib_pajak_data['kota'];
	$sekarang = date("j").' '.nama_bulan(date("m")).' '.date("Y");

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

$this->fpdf->FPDF("L","cm","A4");
$this->fpdf->SetMargins(2.5,1,2.5);
$this->fpdf->SetAutoPageBreak(true,1);
$this->fpdf->SetTitle($this->setting_model->Nama()." - ".$title);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();


$this->fpdf->Ln();
// $this->fpdf->Image($logo,2.5,1,2.75,0,'','');

$this->fpdf->SetFont('Times','B',16);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(20.6,0.5,$nama,'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',12);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(20.6,0.5,"Cabang ".$cabang,'0',0,'L');

$this->fpdf->Ln(0.7);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(20.6,0.5,substr($alamat,0,72),0,0,'L');

if(strlen($alamat) > 72){
$this->fpdf->Ln();
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(20.6,0.5,substr($alamat,72,100),0,0,'L');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(20.6,0.5,"Phone: ".$telp."  Fax : ".$fax."  Email : ".$email,'0',0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(24.6,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln(0.7);
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(24.6,0.5,$title,0,0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',12);
$periode = 'Periode ';
if($bulan) $periode .= "Bulan $bulan ";
if($tahun) $periode .= "Tahun $tahun";
if($periode != 'Periode ') $this->fpdf->Cell(24,0.5,$periode,0,0,'C');

$this->fpdf->Ln(1);
$this->fpdf->Cell(24.6,0.01,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(12.25,0.1,"",'B',0,'L');
$this->fpdf->Cell(0.1,0.1,"",0,0,'L');
$this->fpdf->Cell(12.25,0.1,"",'B',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(12.25,0.5,"AKTIVA",'TBR',0,'C');
$this->fpdf->Cell(0.1,0.5,"",'LR',0,'L');
$this->fpdf->Cell(12.25,0.5,"PASIVA",'TLB',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(12.25,0.5,"AKTIVA",'TR',0,'L');
$this->fpdf->Cell(0.1,0.5,"",'LR',0,'L');
$this->fpdf->Cell(12.25,0.5,"KEWAJIBAN",'TL',0,'L');

$i = 0;
$sum_aktiva = 0;
if(isset($neraca_data[1]))
{
	foreach ($neraca_data[1] as $key => $row)
	{
		if($row['saldo'] !='0'){
		$content[0][$i][0] = $row['nama'];
		$content[0][$i][1] = to_rupiah($row['saldo']);
		$content[0][$i][2] = '';
		$sum_aktiva += $row['saldo'];
		$i++;
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
		$content[1][$j][0] = $row['nama'];
		$content[1][$j][1] = to_rupiah(-$row['saldo']);
		$content[1][$j][2] = '';
		$sum_kewajiban += -$row['saldo'];
		$j++;
		}        
	}
}

$content[1][$j][0] = 'Total Kewajiban';
$content[1][$j][1] = '';
$content[1][$j][2] = to_rupiah($sum_kewajiban);
$j++;

$content[1][$j][0] = '';
$content[1][$j][1] = '';
$content[1][$j][2] = '';
$j++;

$content[1][$j][0] = 'MODAL';
$content[1][$j][1] = '';
$content[1][$j][2] = '';
$j++;

$sum_modal = 0;
if(isset($neraca_data[3]))
{
	foreach ($neraca_data[3] as $key => $row)
	{
		if($row['saldo'] !='0'){
		$content[1][$j][0] = $row['nama'];
		$content[1][$j][1] = to_rupiah(-$row['saldo']);
		$content[1][$j][2] = '';
		$sum_modal += -$row['saldo'];
		$j++;
		}        
	}
}

$content[1][$j][0] = 'Total Modal';
$content[1][$j][1] = '';
$content[1][$j][2] = to_rupiah($sum_modal);
$j++;

$content[1][$j][0] = '';
$content[1][$j][1] = '';
$content[1][$j][2] = '';
$j++;

for($k=0; $k<=max($i,$j); $k++)
{
	$this->fpdf->Ln();
	if(isset($content[0][$k][0]))
	{
		$this->fpdf->Cell(5.25,0.5,$content[0][$k][0],0,0,'L');
		$this->fpdf->Cell(3.5,0.5,$content[0][$k][1],0,0,'R');
		$this->fpdf->Cell(3.5,0.5,$content[0][$k][2],'R',0,'R');
	}
	else
	{
		$this->fpdf->Cell(12.25,0.5,'',0,0,'L');
	}

	$this->fpdf->Cell(0.1,0.5,"",'LR',0,'L');

	if(isset($content[1][$k][0]))
	{
		$this->fpdf->Cell(5.25,0.5,$content[1][$k][0],'L',0,'L');
		$this->fpdf->Cell(3.5,0.5,$content[1][$k][1],0,0,'R');
		$this->fpdf->Cell(3.5,0.5,$content[1][$k][2],0,0,'R');
	}
	else
	{
		$this->fpdf->Cell(12.25,0.5,'',0,0,'L');
	}
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',10);
$this->fpdf->Cell(5.25,0.5,"Total Aktiva",'B',0,'L');
$this->fpdf->Cell(3.5,0.5,"",'B',0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah($sum_aktiva),'BR',0,'R');
$this->fpdf->Cell(0.1,0.5,"",'LR',0,'L');
$this->fpdf->Cell(5.25,0.5,"Total Pasiva",'LB',0,'L');
$this->fpdf->Cell(3.5,0.5,"",'B',0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah($sum_kewajiban+$sum_modal),'B',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',10);
$this->fpdf->Cell(12.25,0.1,"",'B',0,'L');
$this->fpdf->Cell(0.1,0.1,"",0,0,'L');
$this->fpdf->Cell(12.25,0.1,"",'B',0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(24.6,0.01,"",'TLBR',0,'C',1);

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','',12);
$this->fpdf->Cell(24,0.5,$kota.", ".$sekarang,0,0,'C');

$this->fpdf->Ln(3);
$this->fpdf->SetFont('Times','B',12);
$y = $this->fpdf->GetX();
$this->fpdf->SetX($y+8.5);
$this->fpdf->Cell(7,0.5,$nama_pemilik,'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',12);
$y = $this->fpdf->GetX();
$this->fpdf->SetX($y+8.5);
$this->fpdf->Cell(7,0.5,"Finance",0,0,'C');

$this->fpdf->Output("Laporan_Neraca.pdf","I");

?>
