<?php

	$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5); $uri6 = $this->uri->segment(6);
	$nama = $this->setting_model->Nama(); 
	$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
	$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
	$pemilik = $this->pajak_model->PemilikCabang($this->session->userdata('SESS_WP_ID')); 
	$judul='Laporan Migas';
	$thn1 = $uri3; $thn2 = $uri4;
	$tgl1 = $this->jurnal_model->tgl_indo($uri5); $tgl2 = $this->jurnal_model->tgl_indo($uri6);
	$thntgl1 = $this->jurnal_model->ambilThn($uri5); $thntgl2 = $this->jurnal_model->ambilThn($uri6);
	
	$now = date("Y-m-d");
	$sekarang = $this->jurnal_model->tgl_indo($now);

//halaman 1-------------------------------------------------------------------
$this->fpdf->FPDF("L","cm","F4");
$this->fpdf->SetTitle($title." FROM DATE : ".$tgl1." TO DATE : ".$tgl2);
$this->fpdf->SetSubject($nama);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(3.5,2,1.5);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"LAPORAN KEGIATAN USAHA NIAGA UMUM BBM",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',9);
$this->fpdf->Cell(27,0.5,"(DAFTAR FASILITAS NIAGA UMUM BBM PERIODE ".$tgl1." - ".$tgl2.")",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(9.6,0.5,"FASILITAS PENYIMPANAN",'TBLR',0,'C');
$this->fpdf->Cell(9.6,0.5,"FASILITAS PENGANGKUTAN",'TBLR',0,'C');
$this->fpdf->Cell(7.3,0.5,"SPBU",'TBLR',0,'C');
$this->fpdf->SetFillColor(0,0,0);

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"No",'LR',0,'C');
$this->fpdf->Cell(9.6,0.5,"TANGKI DARAT (Depot) / FLOATING STORAGE",'TBLR',0,'C');
$this->fpdf->Cell(9.6,0.5,"TRUK TANGKI / TANKER",'TBLR',0,'C');
$this->fpdf->Cell(7.3,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'LR',0,'C');
$this->fpdf->Cell(1.8,0.5,"Kapasitas (KL)",'TLR',0,'C');
$this->fpdf->Cell(1,0.5,"Jumlah",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Lokasi",'TLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"Kepemilikan",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"Keterangan (Bila Sewa)",'TBLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"Kapasitas (KL)",'TLR',0,'C');
$this->fpdf->Cell(1,0.5,"Jumlah",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Lokasi",'TLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"Kepemilikan",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"Keterangan (Bila Sewa)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Jumlah",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Lokasi",'TLR',0,'C');
$this->fpdf->Cell(3,0.5,"Kapasitas",'TBLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"Kepemilikan",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"Unit",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"(Milik/Sewa)",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nama Pemilik",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Lama Sewa",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"Unit",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"(Milik/Sewa)",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nama Pemilik",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Lama Sewa",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"Unit",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.3,0.5,"Jml Dispnsr",'BLR',0,'C');
$this->fpdf->Cell(1.7,0.5,"Tot Kapsts (KL)",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"CoCo/CoDo/DoDo",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.7,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(9.6,0.5,"I. TANGKI DARAT",'TBLR',0,'C');
$this->fpdf->Cell(9.6,0.5,"I. TRUK TANGKI",'TBLR',0,'C');
$this->fpdf->Cell(7.3,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.7,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.7,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(9.6,0.5,"II. FLOATING STORAGE",'TBLR',0,'C');
$this->fpdf->Cell(9.6,0.5,"II. TANKER / SPOB",'TBLR',0,'C');
$this->fpdf->Cell(7.3,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.7,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.7,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.8,0.5,"",'BLR',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','I',5);
$this->fpdf->SetTextColor(200,0,0);
$this->fpdf->Cell(27,0.5,"Fasilitas Niaga Umum yang digunakan disesuaikan untuk setiap Badan Usaha (Tangki Darat, Floating Storage, Truk Tangki, Tanker, Tongkang, SPBU)",0,0,'L');
$this->fpdf->SetTextColor(0,0,0);

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(21,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,$kota.", ".$sekarang,0,0,'L');

$this->fpdf->Ln(3);
$this->fpdf->SetFont('Arial','BU',8);
$this->fpdf->Cell(21,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"$pemilik",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(21,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"Direktur Utama",0,0,'L');



//halaman 2-------------------------------------------------------------------
$this->fpdf->SetMargins(3.5,1,1.5);
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"LAPORAN KEGIATAN USAHA NIAGA UMUM BBM",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(27,0.5,"(Rencana dan Realisasi Investasi dalam Tahun ".$thn1." - ".$thn2.")",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',9);
$this->fpdf->Cell(27,0.5,"I. REALISASI",'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(4,0.5,"SARANA & FASILITAS NIAGA",'TLR',0,'C');
$this->fpdf->Cell(3,0.5,"KEPEMILIKAN",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"REALISASI 2017",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"REALISASI 2018",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"REALISASI 2019",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Jumlah (Unit)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Lokasi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Jumlah (Unit)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Lokasi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Jumlah (Unit)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Lokasi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nilai (US $)",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(7,0.5,"I. PENYIMPANAN",'BLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(7,0.5,"II. PENGANGKUTAN",'BLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(7,0.5,"III. LAIN-LAIN",'BLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',9);
$this->fpdf->Cell(27,0.5,"II. RENCANA",'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(4,0.5,"SARANA & FASILITAS NIAGA",'TLR',0,'C');
$this->fpdf->Cell(3,0.5,"KEPEMILIKAN",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"RENCANA 2017",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"RENCANA 2018",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"RENCANA 2019",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Jumlah (Unit)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Lokasi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Jumlah (Unit)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Lokasi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Jumlah (Unit)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Lokasi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Nilai (US $)",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(7,0.5,"I. PENYIMPANAN",'BLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(7,0.5,"II. PENGANGKUTAN",'BLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(7,0.5,"III. LAIN-LAIN",'BLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',7);
$this->fpdf->Cell(27,0.5,"Rencana investasi untuk 1 - 3 tahun ke depan",0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(21,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,$kota.", ".$sekarang,0,0,'L');

$this->fpdf->Ln(2);
$this->fpdf->SetFont('Arial','BU',8);
$this->fpdf->Cell(21,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"$pemilik",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(21,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"Direktur Utama",0,0,'L');



//halaman 3-------------------------------------------------------------------
$this->fpdf->SetMargins(3.5,1,1.5);
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"LAPORAN KEGIATAN USAHA NIAGA UMUM BBM",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(27,0.5,"Tahun ".$thntgl1,'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(27,0.5,"(Rencana dan Realisasi Penjualan ".$tgl1." - ".$tgl2.")",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(4,0.5,"JENIS BBM",'TLR',0,'C');
$this->fpdf->Cell(3,0.5,"SEKTOR PENGGUNA",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(6,0.5,"TOTAL VOLUME",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"Provinsi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Provinsi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Provinsi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Provinsi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Provinsi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Provinsi",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',6);
$this->fpdf->Cell(4,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(27,0.5,"* Badan Usaha Lain adalah penjualan kepada sesama Badan Usaha Pemegang Izin Usaha Niaga BBM",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(27,0.5,"** Jenis BBM disesuaikan pada realisasi penjualan masing-masing Badan Usaha",0,0,'L');

//halaman 4-------------------------------------------------------------------
$this->fpdf->SetMargins(1.5,3.5,1.5);
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(17,0.5,"REKAP PENJUALAN BBM TAHUN ".$thntgl1,'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(17,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(17,0.5,"(Periode".$tgl1." - ".$tgl2.")",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(2,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(2,0.5,"SEKTOR",'TLR',0,'C');
$this->fpdf->Cell(3,0.5,"M. Bensin",'TLR',0,'C');
$this->fpdf->Cell(3,0.5,"M. Solar",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(2,0.5,"TOTAL",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(1.5,0.5,"RON 95",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"RON 92",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"51",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"49",'TLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"M. Bakar",'LR',0,'C');
$this->fpdf->Cell(1.5,0.5,"M. Diesel",'LR',0,'C');
$this->fpdf->Cell(1.5,0.5,"M. Tanah",'LR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Avtur/Avgas",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"Transportasi",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"- Darat",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"- Laut",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"- Udara",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"-",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"Industri",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"Listrik",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'LR',0,'C');
$this->fpdf->Cell(2,0.5,"Own Use",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"TOTAL",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(12.5,0.5,"KETAHANAN STOK BBM BULAN ..... (KL)",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"Jenis BBM",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Stok Awal",'TBLR',0,'C');
$this->fpdf->Cell(3,0.5,"Penyediaan",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Penjualan",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Penjualan",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Own Use",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Stok Akhir",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Import",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Dalam Negeri",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"M. Bensin",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"M. Solar",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"M. Bakar",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"M. Tanah",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"Avtur/Avgas",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(2,0.5,"",'',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'L');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(11,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,$kota.", ".$sekarang,0,0,'L');

$this->fpdf->Ln(2);
$this->fpdf->SetFont('Arial','BU',8);
$this->fpdf->Cell(11,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"$pemilik",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(11,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"Direktur Utama",0,0,'L');

//halaman 5-------------------------------------------------------------------
$this->fpdf->SetMargins(3.5,1,1.5);
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"LAPORAN KEGIATAN USAHA NIAGA UMUM BBM",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(27,0.5,"Tahun ".$thntgl1,'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(27,0.5,"(Rencana dan Realisasi Penyediaan BBM - Periode ".$tgl1." - ".$tgl2.")",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',9);
$this->fpdf->Cell(27,0.5,"I. DARI IMPORT",'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"NO",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"JENIS BBM",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"NEGARA ",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"PELABUHAN",'TLR',0,'C');
$this->fpdf->Cell(5,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(5,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(7,0.5,"TOTAL",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"KETERANGAN",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"TUJUAN",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"BONGKAR",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',9);
$this->fpdf->Cell(27,0.5,"I. DARI DALAM NEGERI",'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"NO",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"JENIS BBM",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"NEGARA ",'TLR',0,'C');
$this->fpdf->Cell(5,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(5,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(7,0.5,"TOTAL",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"KETERANGAN",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"TUJUAN",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');



//halaman 6-------------------------------------------------------------------
$this->fpdf->SetMargins(3.5,1,1.5);
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(15,0.5,"REKAP PENYEDIAAN BBM",'0',0,'C');
$this->fpdf->Cell(15,0.5,"REKAP PENYEDIAAN BBM",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(15,0.5,"$nama",'0',0,'C');
$this->fpdf->Cell(15,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(15,0.5,"(Periode ".$tgl1." - ".$tgl2.")",'0',0,'C');
$this->fpdf->Cell(15,0.5,"(Periode ".$tgl1." - ".$tgl2.")",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',9);
$this->fpdf->Cell(17,0.5,"I. DARI IMPORT",'0',0,'L');
$this->fpdf->Cell(15,0.5,"II. DALAM NEGERI",'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"NO",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"JENIS BBM",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"NEGARA ASAL",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"NEGARA ASAL",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(1,0.5,"",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"NO",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"JENIS BBM",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"BADAN USAHA",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"REALISASI",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

//halaman 7-------------------------------------------------------------------
$this->fpdf->SetMargins(3.5,1,1.5);
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"LAPORAN KEGIATAN USAHA NIAGA UMUM BBM",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(27,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(27,0.5,"Tahun ".$thntgl1,'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(27,0.5,"(Rencana dan Realisasi Penyediaan BBM - Periode ".$tgl1." - ".$tgl2.")",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',9);
$this->fpdf->Cell(27,0.5,"I. EKSPOR",'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"NO",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"JENIS BBM",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"NEGARA TUJUAN",'TLR',0,'C');
$this->fpdf->Cell(5,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(5,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(5,0.5,"BULAN",'TLR',0,'C');
$this->fpdf->Cell(7,0.5,"TOTAL",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"REALISASI",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"REALISASI",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Volume",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Total Nilai (US $)",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(0.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(1.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');

//halaman 8-------------------------------------------------------------------
// $this->fpdf->FPDF("P","cm","F4");
$this->fpdf->SetMargins(2,3.5,2);
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(17,0.5,"REKAP EKSPOR BBM",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(17,0.5,"$nama",'0',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',9);
$this->fpdf->Cell(17,0.5,"(Periode".$tgl1." - ".$tgl2.")",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(1,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'TLR',0,'C');
$this->fpdf->Cell(9,0.5,"TOTAL",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(1,0.5,"NO",'LR',0,'C');
$this->fpdf->Cell(3.5,0.5,"JENIS BBM",'LR',0,'C');
$this->fpdf->Cell(3.5,0.5,"NEGARA TUJUAN",'LR',0,'C');
$this->fpdf->Cell(4.5,0.5,"RENCANA",'TLR',0,'C');
$this->fpdf->Cell(4.5,0.5,"REALISASI",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Total Nilai (US $)",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"Volume (KL)",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"Total Nilai (US $)",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',6);
$this->fpdf->Cell(1,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(3.5,0.5,"",'BLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2,0.5,"",'TBLR',0,'C');
$this->fpdf->Cell(2.5,0.5,"",'TBLR',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(11,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,$kota.", ".$sekarang,0,0,'L');

$this->fpdf->Ln(2);
$this->fpdf->SetFont('Arial','BU',8);
$this->fpdf->Cell(11,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"$pemilik",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(11,0.5,"",0,0,'R');
$this->fpdf->Cell(4,0.5,"Direktur Utama",0,0,'L');

$this->fpdf->Output("$title._from.$tgl1.to.$tgl2.pdf","I");
?> 
