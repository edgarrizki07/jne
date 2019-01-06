<?php

$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
if($uri3=='0'){	$cabang = 'Semua'; 	}else{	$cabang = $this->pajak_model->KotaCabang($uri3); 	}
$nama = $this->setting_model->Nama(); 
$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
$bln = $this->uri->segment(4);
$thn = $this->uri->segment(5);
$blnthn = $bln."_".$thn;
$sekarang = date("j").' '.nama_bulan(date("m")).' '.date("Y");

$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle("REKAP Penawaran Mulai : ".$bln." Sampai : ".$thn);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(1,1,1);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(19,0.5,"$nama",'0',0,'L');


$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',10);
$this->fpdf->Cell(21,0.5,"REKAP PENAWARAN",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(3,0.5,"Cabang ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": $cabang ",0,0,'L');
$this->fpdf->Cell(5,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Halaman ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(3,0.5,"Mulai ",'0',0,'L');
$this->fpdf->Cell(9,0.5,": ".$bln." Sampai : ".$thn,0,0,'L');
$this->fpdf->Cell(3,0.5,"Tanggal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $sekarang",0,0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(19,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',8);
$this->fpdf->Cell(1,0.5,"No",0,0,'L');
$this->fpdf->Cell(3,0.5,"ID",0,0,'L');
$this->fpdf->Cell(2,0.5,"DATE",0,0,'L');
$this->fpdf->Cell(4,0.5,"CUSTOMER",0,0,'L');
$this->fpdf->Cell(2.5,0.5,"HARGA DASAR",0,0,'R');
$this->fpdf->Cell(1.5,0.5,"PPN",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"PPH",0,0,'C');
$this->fpdf->Cell(1,0.5,"PBBKB",0,0,'C');
$this->fpdf->Cell(2.5,0.5,"INCLUDE",0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

 if($isi->num_rows()>0){
		$vol=0;
		$no =1;
		foreach($isi->result_array() as $db){
		    
		$date 	= $this->app_model->tgl_str($db['tgl']);
		$price 	= number_format ($db['harga'], 0, ',', '.'); 
		$include 	= number_format ($db['include'], 0, ',', '.'); 
		$cab 	= $this->pajak_model->KodeCabang($db['wp_id']);
		$bill	= $db['id_tawaran']."/".$cab."/HSD";
		$supplier = $this->customer_model->NamaCustomer($db['customer_id']); 
		$pro 	= $this->customer_model->CPCustomer($db['customer_id']);
		$disctotal=$db['harga']; 
		$nppn=$disctotal/10*($db['ppn']);
		$npbbkb=$disctotal*($db['npbbkb']/100)*($db['pbbkb']); 
		$npph=$disctotal*3/1000*($db['pph']); 
		$pph  	= number_format ($npph, 0, ',', '.');
		$ppn  	= number_format ($nppn, 0, ',', '.');
		$pbbkb	= number_format ($npbbkb, 0, ',', '.');
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Times','',8);
			$this->fpdf->Cell(1,0.5,"$no",0,0,'L');
			$this->fpdf->Cell(3,0.5,"$bill",0,0,'L');
			$this->fpdf->Cell(2,0.5,"$date",0,0,'L');
			$this->fpdf->Cell(4,0.5,$supplier,0,0,'L');
			$this->fpdf->Cell(2.5,0.5,"$price",0,0,'R');
			$this->fpdf->Cell(1.5,0.5,"$ppn",0,0,'R');
			$this->fpdf->Cell(1.5,0.5,"$pph",0,0,'R');
			$this->fpdf->Cell(1,0.5,"$pbbkb",0,0,'R');
			$this->fpdf->Cell(2.5,0.5,"$include",0,0,'R');
    
		$no++;		}
	}else{ 
	$g_total =0;	
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Times','',9);
			$this->fpdf->Cell(28,0.5,'Tidak Ada Data',0,0,'C');
	} 



$this->fpdf->Output("Rekap_Penbelian_$kota.pdf","I");
?> 
