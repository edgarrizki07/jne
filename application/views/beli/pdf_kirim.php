<?php
// Buat File 
$NamaFile  = './files/po/PO No.'.$this->uri->segment(3).'.pdf';

// Setting 
$logo=base_url().'images/'.$this->setting_model->Logo1();
$nama = $this->setting_model->Nama(); 
$web = $this->setting_model->Web(); 
$singkatan=$this->setting_model->singkatan();

// Cabang 
$cabang = $this->pajak_model->NamaCabang($info['wp_id']);
$kode = $this->pajak_model->KodeCabang($info['wp_id']);
$NPWP = $this->pajak_model->NPWPCabang($info['wp_id']);
$alamat = $this->pajak_model->AlamatCabang($info['wp_id']);
$kelurahan = $this->pajak_model->KelurahanCabang($info['wp_id']);
$kecamatan = $this->pajak_model->KecamatanCabang($info['wp_id']);
$kota = $this->pajak_model->KotaCabang($info['wp_id']);
$provinsi = $this->pajak_model->ProvinsiCabang($info['wp_id']);
$telp = $this->pajak_model->TelpCabang($info['wp_id']);
$fax = $this->pajak_model->FaxCabang($info['wp_id']);
$email = $this->pajak_model->EmailCabang($info['wp_id']);
$email1 = $this->pajak_model->Email1Cabang($info['wp_id']);
$email2 = $this->pajak_model->Email2Cabang($info['wp_id']);
$pemilik = $this->pajak_model->PemilikCabang($info['wp_id']);
$kepala = $this->pajak_model->KepalaCabang($info['wp_id']);
$keuangan = $this->pajak_model->KeuanganCabang($info['wp_id']);
$pembelian = $this->pajak_model->PembelianCabang($info['wp_id']);
$penjualan = $this->pajak_model->PenjualanCabang($info['wp_id']);
$operasional = $this->pajak_model->OperasionalCabang($info['wp_id']);
$pemasaran = $this->pajak_model->PemasaranCabang($info['wp_id']);

// Supplier 
$Supplier = $info['supplier_id'];
$NamaSupplier=$this->supplier_model->NamaSupplier($Supplier);
$CPSupplier = $this->supplier_model->CPSupplier($Supplier);
$HPSupplier = $this->supplier_model->HPSupplier($Supplier);
$AlamatSupplier = $this->supplier_model->AlamatSupplier($Supplier);
$KotaSupplier = $this->supplier_model->KotaSupplier($Supplier);
$ProvinsiSupplier = $this->supplier_model->ProvinsiSupplier($Supplier);
$TelpSupplier = $this->supplier_model->TelpSupplier($Supplier);
$FaxSupplier = $this->supplier_model->FaxSupplier($Supplier);
$EmailSupplier = $this->supplier_model->EmailSupplier($Supplier);
$DepoSupplier = $this->supplier_model->DepoSupplier($Supplier);
$RekeningSupplier = $this->supplier_model->RekeningSupplier($Supplier);

// Penjualan 
$doc = 'PO';
$no = $info['id_beli'];
$term = $info['term']; 
$termbyr = $info['termbyr']; 
$rekening = $info['rekening']; 
$depo = $info['depo']; 
$termambil = $info['termambil']; 
$koordinator = $info['koordinator']; 
$terbilang = $info['terbilang']; 
$keterangan = $info['keterangan']; 
$nvol = number_format($info['jml']);
$nharga = number_format($info['harga'], 2, '.', ',');
$nsum = number_format(($info['harga']*$info['jml']), 2, '.', ',');
$include = number_format($info['tot9']/$info['jml']);
	
// Jurnal 
$judul="PURCHASE ORDER";
$payment=$this->jurnal_model->PayVoucher('7');
$due=$this->jurnal_model->DueVoucher('7');
$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tgl'])); 
$thn=$this->jurnal_model->ambilThn($info['tgl']); 
$tg=$this->jurnal_model->ambilTgl($info['tgl']); 
$tgl=$this->jurnal_model->tgl_indo($info['tgl']); 
$tglambil=$this->jurnal_model->tgl_indo($info['tglambil']); 
$tempo=$this->jurnal_model->tgl_indo($info['tempo']); 

$jml=$info['harga']*$info['jml']; 
$d=$info['discount']; 
$disc=$jml*$d/100; 
$disctotal=$jml-$disc; 
$ppn=$disctotal/10*($info['ppn']);
$inpbbkb=$info['npbbkb']; 
$pbbkb=$disctotal*($info['npbbkb']/100)*($info['pbbkb']); 
$pph=$disctotal*3/1000*($info['pph']); 
$t=($info['ohp']); 
$td=$t*$info['jml']; 
$tt=($td)+($info['ppnohp']*$td/10); 
$gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt);

$njml = number_format($info['tot1'], 2, '.', ',');
$nd = number_format($d, 2, '.', ',');
$ndisc = number_format($info['tot2'], 2, '.', ',');
$ndisctotal = number_format($info['tot3'], 2, '.', ',');
$nppn = number_format($info['tot4'], 2, '.', ',');
$npbbkb= number_format($info['tot5'], 2, '.', ',');
$npph = number_format($info['tot6'], 2, '.', ',');
$nt = number_format($t, 2, '.', ',');
$ntd = number_format($info['tot7'], 2, '.', ',');
$ntt= number_format($info['tot8'], 2, '.', ',');
$ngr_total = number_format($info['tot9'], 2, '.', ',');


// PDF Setting 
$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($cabang);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(2,3,2,0.5);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','B',12);
$this->fpdf->Cell(17,0.5,"PURCHASE ORDER",'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(9,0.5,"",0,0,'L'); 
$this->fpdf->Cell(2,0.5,"P.O. NO. ",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$no.".".$tg."/".$doc."/".$kode."/".$bln."/".$thn,'0',0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(9,0.5,"",0,0,'L'); 
$this->fpdf->Cell(2,0.5,"Tanggal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $tgl",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(9,0.5,"",0,0,'L'); 
$this->fpdf->Cell(2,0.5,"Metode ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $term",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(9,0.5,"",0,0,'L'); 
$this->fpdf->Cell(2,0.5,"Hauler ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $nama",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(10,0.5,"Kepada :",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(17,0.5,"$NamaSupplier",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(10,0.5,substr($AlamatSupplier,0,100),0,0,'L');

if(strlen($AlamatSupplier) > 100){
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(10,0.5,substr($AlamatSupplier,100,100),0,0,'L');
}
if(strlen($AlamatSupplier) > 200){
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(10,0.5,substr($AlamatSupplier,200,100),0,0,'L');
}

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(10,0.5,$KotaSupplier." - ".$ProvinsiSupplier,0,0,'L'); 

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(10,0.5,"Phone : ".$TelpSupplier." Fax : ".$FaxSupplier." Email : ".$EmailSupplier,0,0,'L'); 

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"Up : ",0,0,'L');
$this->fpdf->Cell(9,0.5,$CPSupplier." HP: ".$HPSupplier,0,0,'L');


$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(6,0.5,"",'TL',0,'L');
$this->fpdf->Cell(2,0.5,"",'TL',0,'L');
$this->fpdf->Cell(2,0.5,"",'TL',0,'L');
$this->fpdf->Cell(7,0.5,"Harga",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(6,0.5,"Uraian",'BL',0,'C');
$this->fpdf->Cell(2,0.5,"Satuan",'BL',0,'C');
$this->fpdf->Cell(2,0.5,"Jumlah",'BL',0,'C');
$this->fpdf->Cell(2,0.5,"Include",'BL',0,'L');
$this->fpdf->Cell(2,0.5,"Dasar",'BL',0,'L');
$this->fpdf->Cell(3,0.5,"Jumlah",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(6,0.5,"High Speed Diesel",'BL',0,'L');
$this->fpdf->Cell(2,0.5,"Liter",'B',0,'L');
$this->fpdf->Cell(2,0.5,$nvol,'B',0,'L');
$this->fpdf->Cell(2,0.5,$include,'BL',0,'L');
$this->fpdf->Cell(2,0.5,$nharga,'BL',0,'L');
$this->fpdf->Cell(3,0.5,$nsum,'BLR',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(8,0.5,"Terbilang :",0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Subtotal",'LB',0,'L');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,0.5,"$njml",'RB',0,'R');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','UI',10);
$this->fpdf->Cell(8,0.5,substr($terbilang,0,50),0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(3,0.5,"",'R',0,'R');

if(strlen($terbilang) > 50){
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(8,0.5,substr($terbilang,50,50),0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(3,0.5,"",'R',0,'R');
}
if(strlen($terbilang) > 100){
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(8,0.5,substr($terbilang,100,50),0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(3,0.5,"",'R',0,'R');
}

if($ppn =='0'){ }else{
$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(8,0.5,"",0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"PPn 10%",'L',0,'L');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,0.5,"$nppn",'R',0,'R');
}

if($pph =='0'){ }else{
$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(8,0.5,"",0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"PPH 0,3%",'L',0,'L');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,0.5,"$npph",'R',0,'R');
}

if($pbbkb =='0'){ }else{
$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(8,0.5,"",0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"PBBKB $inpbbkb %",'L',0,'L');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,0.5,"$npbbkb",'R',0,'R');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(8,0.5,"",0,0,'L');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Total",'TBL',0,'L');
$this->fpdf->Cell(3,0.5,"$ngr_total",'TBR',0,'R');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',9);
$this->fpdf->Cell(4,0.5,"Sistem Pembayaran",0,0,'L');
$this->fpdf->Cell(13,0.5,": $termbyr",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"",0,0,'L');
$this->fpdf->Cell(13,0.5,"  ".$rekening,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"Lokasi Pengambilan",0,0,'L');
$this->fpdf->Cell(13,0.5,": Depo $NamaSupplier",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"",0,0,'L');
$this->fpdf->Cell(13,0.5,"  ".$depo,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"Tanggal Pengambilan",0,0,'L');
$this->fpdf->Cell(13,0.5,": $tglambil",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"Koordinator",0,0,'L');
$this->fpdf->Cell(13,0.5,": $koordinator",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"Metode Pengambilan",0,0,'L');
$this->fpdf->Cell(13,0.5,": $termambil",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"Invoice ditujukan ke",0,0,'L');
$this->fpdf->Cell(13,0.5,": $nama",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"Faktur Pajak",0,0,'L');
$this->fpdf->Cell(13,0.5,": $nama",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"  NPWP",0,0,'L');
$this->fpdf->Cell(13,0.5,": $NPWP",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"  Alamat",0,0,'L');
$this->fpdf->Cell(13,0.5,": ".$alamat.", Kel. ".$kelurahan,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"",0,0,'L');
$this->fpdf->Cell(13,0.5,"  Kec. ".$kecamatan.", ".$kota." - ".$provinsi,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->Cell(4,0.5,"Keterangan Tambahan",0,0,'L');
$this->fpdf->Cell(13,0.5,": $keterangan",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(5.6,0.5,"Hormat kami",0,0,'C');
$this->fpdf->Cell(5.6,0.5,"Mengetahui",0,0,'C');
$this->fpdf->Cell(5.6,0.5,"Disetujui",0,0,'C');

$this->fpdf->Ln(2);
$this->fpdf->SetFont('Arial','BU',10);
$this->fpdf->Cell(5.6,0.5,$pembelian,0,0,'C');
$this->fpdf->Cell(5.6,0.5,$keuangan,0,0,'C');
$this->fpdf->Cell(5.6,0.5,$kepala,0,0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(5.6,0.5,"Supply Change",0,0,'C');
$this->fpdf->Cell(5.6,0.5,"Finance",0,0,'C');
$this->fpdf->Cell(5.6,0.5,"Director",0,0,'C');

// Garis 
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(17,0.1,"",'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(16,0.5,"Note :",0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"1. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"Mohon tanda tangan dan stempel PO ini kemudian kirim kembali ke email : ".$email1." atau Fax. ".$fax,0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"2. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"Alamat Pengiriman Surat :",0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(15,0.5,"PT. JAGAD NUSANTARA ENERGI",0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(15,0.5,"$alamat",0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(15,0.5,"Kel. ".$kelurahan.", Kec. ".$kecamatan.", ".$kota." - ".$provinsi,0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(15,0.5,"Telp. ".$telp." Fax. ".$fax,0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(15,0.5,"Email : ".$email,'0',0,'L');

// Garis 
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(17,0.1,"",'B',0,'C');

$this->fpdf->Output($NamaFile,"F");
redirect('beli/email_acc/'.$this->uri->segment(3));
?>
