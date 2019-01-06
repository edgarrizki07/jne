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

$this->fpdf->FPDF("L","cm","A4");
$this->fpdf->SetTitle("REKAP PEMBELIAN Mulai : ".$bln." Sampai : ".$thn);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(1,1,1);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(28,0.5,"$nama",'0',0,'L');


$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',10);
$this->fpdf->Cell(21,0.5,"REKAP PEMBELIAN",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(3,0.5,"Cabang ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": $cabang ",0,0,'L');
$this->fpdf->Cell(14,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Halaman ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(3,0.5,"Mulai ",'0',0,'L');
$this->fpdf->Cell(18,0.5,": ".$bln." Sampai : ".$thn,0,0,'L');
$this->fpdf->Cell(3,0.5,"Tanggal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $sekarang",0,0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(28,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(28,0.1,"",'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',8);
$this->fpdf->Cell(1,0.5,"No",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"DATE",0,0,'L');
$this->fpdf->Cell(3,0.5,"BILL NUMBER",0,0,'L');
$this->fpdf->Cell(8,0.5,"SUPLIER",0,0,'L');
$this->fpdf->Cell(1.4,0.5,"QTY",0,0,'C');
$this->fpdf->Cell(1.1,0.5,"PRICE",0,0,'C');
$this->fpdf->Cell(2.5,0.5,"T.AMOUNT",0,0,'R');
$this->fpdf->Cell(2,0.5,"PPN",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"PBBKB",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"PPH",0,0,'C');
$this->fpdf->Cell(2,0.5,"TRANSPORT",0,0,'C');
$this->fpdf->Cell(2.5,0.5,"GRAND TOTAL",0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(28,0.1,"",'B',0,'C');

 if($isi->num_rows()>0){
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
		    
		$date 	= $this->app_model->tgl_str($db['tgl']);
		$qty 	= number_format ($db['jml'], 0, ',', '.'); 
		$qt 	= $db['jml']; 
		$price 	= number_format ($db['harga'], 0, ',', '.'); 
		$d		= $db['discount'];
		$cab 	= $this->pajak_model->KodeCabang($db['wp_id']);
		$bill	= $db['jurnal_id']."/BILL/".$cab."/KPS";
		$supplier = $this->supplier_model->NamaSupplier($db['supplier_id']); 
		$pro 	= $this->supplier_model->CPSupplier($db['supplier_id']);
		$tot1 	= number_format ($db['tot1'], 0, ',', '.'); 
		// if($d=='0'){ $disc='no disc.' }else{ $disc='disc.'.$d.'%'}; 
		$amount = number_format ($db['tot3'], 0, ',', '.');
		$ppn  	= number_format ($db['tot4'], 0, ',', '.');
		$pbbkb	= number_format ($db['tot5'], 0, ',', '.');
		$pph   	= number_format ($db['tot6'], 0, ',', '.');
		if($db['ohp']==''){ $transport = number_format ($db['tot7'], 0, ',', '.'); }else{ $transport = number_format (($db['tot7']), 0, ',', '.');
		$total = number_format ($db['tot9'], 0, ',', '.'); } 
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Times','',8);
			$this->fpdf->Cell(1,0.5,"$no",0,0,'L');
			$this->fpdf->Cell(1.5,0.5,"$date",0,0,'L');
			$this->fpdf->Cell(3,0.5,"$bill",0,0,'L');
			$this->fpdf->Cell(8,0.5,$supplier,0,0,'L');
			$this->fpdf->Cell(1.4,0.5,$qty." Ltr",0,0,'R');
			$this->fpdf->Cell(1.1,0.5,"$price",0,0,'R');
			$this->fpdf->Cell(2.5,0.5,"$amount",0,0,'R');
			$this->fpdf->Cell(2,0.5,"$ppn",0,0,'R');
			$this->fpdf->Cell(1.5,0.5,"$pbbkb",0,0,'R');
			$this->fpdf->Cell(1.5,0.5,"$pph",0,0,'R');
			$this->fpdf->Cell(2,0.5,"$transport",0,0,'R');
			$this->fpdf->Cell(2.5,0.5,"$total",0,0,'R');
    
		$no++;
		$vol = $vol+$qt;
		$g_total = $g_total+$db['tot1'];
		$g_total1 = $g_total1+$db['tot2'];
		$g_total2 = $g_total2+$db['tot3'];
		$g_total3 = $g_total3+$db['tot4'];
		$g_total4 = $g_total4+$db['tot5'];
		$g_total5 = $g_total5+$db['tot6'];
		$g_total6 = $g_total6+$db['tot7'];
		$g_total7 = $g_total7+$db['tot9'];
		}
	}else{ 
	$g_total =0;	
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Times','',9);
			$this->fpdf->Cell(28,0.5,'Tidak Ada Data',0,0,'C');
	} 
 if($g_total=='0'){  }else{ 
		$tqty 		= number_format ($vol, 0, ',', '.'); 
		$ttot1 		= number_format ($g_total, 0, ',', '.');
		$tamount 	= number_format ($g_total2, 0, ',', '.');
		$tppn 		= number_format ($g_total3, 0, ',', '.');
		$tpbbkb 	= number_format ($g_total4, 0, ',', '.');
		$tpph 		= number_format ($g_total5, 0, ',', '.');
		$ttransport = number_format (($g_total6), 0, ',', '.');
		$ttotal 	= number_format ($g_total7, 0, ',', '.');
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Times','B',8);
			$this->fpdf->Cell(1,0.5,"",0,0,'L');
			$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
			$this->fpdf->Cell(3,0.5,"TOTAL",0,0,'L');
			$this->fpdf->Cell(8,0.5,"",0,0,'L');
			$this->fpdf->Cell(1.4,0.5,$tqty." Ltr",0,0,'R');
			$this->fpdf->Cell(1.1,0.5,"",0,0,'R');
			$this->fpdf->Cell(2.5,0.5,"$tamount",0,0,'R');
			$this->fpdf->Cell(2,0.5,"$tppn",0,0,'R');
			$this->fpdf->Cell(1.5,0.5,"$tpbbkb",0,0,'R');
			$this->fpdf->Cell(1.5,0.5,"$tpph",0,0,'R');
			$this->fpdf->Cell(2,0.5,"$ttransport",0,0,'R');
			$this->fpdf->Cell(2.5,0.5,"$ttotal",0,0,'R');
 } 



$this->fpdf->Output("Rekap_Penbelian_$kota.pdf","I");
?> 
