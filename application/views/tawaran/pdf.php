<?php
// Setting 
$logo=base_url().'images/'.$this->setting_model->Logo1();
$nama = $this->setting_model->Nama(); 
$inu = $this->setting_model->Inu(); 
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

// Customer 
$Customer = $info['customer_id'];
$NamaCustomer=$this->customer_model->NamaCustomer($Customer);
$CPCustomer = $this->customer_model->CPCustomer($Customer);
$HPCustomer = $this->customer_model->HPCustomer($Customer);
$AlamatCustomer = $this->customer_model->AlamatCustomer($Customer);
$KotaCustomer = $this->customer_model->KotaCustomer($Customer);
$ProvinsiCustomer = $this->customer_model->ProvinsiCustomer($Customer);
$TelpCustomer = $this->customer_model->TelpCustomer($Customer);
$FaxCustomer = $this->customer_model->FaxCustomer($Customer);
$EmailCustomer = $this->customer_model->EmailCustomer($Customer);

// Penawaran 
$doc = 'HSD';
$no = $info['id'];
$perihal = $info['perihal']; 
$lampiran = $info['lampiran']; 
$produk = $info['produk']; 
$tembusan = $info['tembusan']; 
$tembusan1 = $info['tembusan1']; 
$tembusan2 = $info['tembusan2']; 
// isi Penawaran
$oat = $info['oat']; 
$noat = number_format($info['oat'], 2, ',', '.');
$include = number_format($info['include'], 2, ',', '.');
$includeoat = number_format($info['include']-$oat, 2, ',', '.');
$harga = number_format($info['harga'], 2, ',', '.');
$ppn = number_format($info['harga']/10*($info['ppn']), 2, ',', '.');
$pph = number_format($info['harga']*3/1000*($info['pph']), 2, ',', '.');
$pbbkb = number_format($info['harga']*($info['npbbkb']/100)*($info['pbbkb']), 2, ',', '.');
$npbbkb=($info['npbbkb'])*($info['pbbkb']); 
$isi2 = $info['isi2']; 
$isi3 = $info['isi3']; 
$isi4 = $info['isi4']; 
$isi5 = $info['isi5']; 
$pembayaran = $info['pembayaran']; 
$bank = $info['bank']; 
$namarek = $info['namarek']; 
$rekening = $info['rekening']; 
$isi6 = $info['isi6']; 
$isi7 = $info['isi7']; 
$isi8 = $info['isi8']; 
	
// Jurnal 
$judul="Surat Penawaran";
$payment=$this->jurnal_model->PayVoucher('7');
$due=$this->jurnal_model->DueVoucher('7');
$tanggal=$this->jurnal_model->ambilTgl($info['tgl']); 
$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tgl'])); 
$thn=$this->jurnal_model->ambilThn($info['tgl']); 
$tgl=$this->jurnal_model->tgl_indo($info['tgl']); 


// PDF Setting 
$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($cabang);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(3,4,3,0.5);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(17,0.5,$kota.", ".$tgl,0,0,'L');

$this->fpdf->Ln(0.7);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"No. ",0,0,'L');
$this->fpdf->Cell(14,0.5,": ".$no.".".$tanggal."/".$kode."/".$doc."/".$bln."/".$thn,'0',0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"Perihal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $perihal",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"Lampiran ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $lampiran",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(10,0.5,"Kepada :",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(17,0.5,"$NamaCustomer",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(1,0.5,"Up : ",0,0,'L');
$this->fpdf->Cell(16,0.5,$CPCustomer." HP: ".$HPCustomer."Email : ".$EmailCustomer,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(10,0.5,substr($AlamatCustomer,0,70),0,0,'L');

if(strlen($AlamatCustomer) > 70){
$this->fpdf->Ln();
$this->fpdf->Cell(10,0.5,substr($AlamatCustomer,70,70),0,0,'L');
}
if(strlen($AlamatCustomer) > 140){
$this->fpdf->Ln();
$this->fpdf->Cell(10,0.5,substr($AlamatCustomer,140,70),0,0,'L');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,$KotaCustomer." - ".$ProvinsiCustomer,0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(17,0.5,"Dengan hormat,",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(17,0.5,"Kami ".$nama." pemegang Izin Niaga Umum BBM No. ".$inu,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(17,0.5,"dengan ini mengajukan penawaran harga untuk periode saat ini dengan rincian sebagai berikut :",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"1. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"Harga ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"Jenis BBM",'TBL',0,'C');
$this->fpdf->Cell(6,0.5,"Rincian Harga",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
if($ppn =='0'){ 
$this->fpdf->Cell(7,0.5,"$produk",'L',0,'C');
}else{
$this->fpdf->Cell(7,0.5,"",'L',0,'C');
}
$this->fpdf->Cell(3,0.5,"Harga Dasar",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Rp",'TBL',0,'R');
$this->fpdf->Cell(2,0.5,"$harga",'TBR',0,'R');

if($ppn =='0'){ }else{
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"$produk",'L',0,'C');
$this->fpdf->Cell(1.5,0.5,"PPn",'TBL',0,'L');
$this->fpdf->Cell(1.5,0.5,"10%",'TBLR',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'TBL',0,'R');
$this->fpdf->Cell(2,0.5,"$ppn",'TBR',0,'R');
}

if($pph =='0'){ }else{
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"",'L',0,'L');
$this->fpdf->Cell(1.5,0.5,"PPh",'TBL',0,'L');
$this->fpdf->Cell(1.5,0.5,"0.3%",'TBLR',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'TBL',0,'R');
$this->fpdf->Cell(2,0.5,"$pph",'TBR',0,'R');
}

if($pbbkb =='0'){ }else{
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"",'L',0,'L');
$this->fpdf->Cell(1.5,0.5,"Pbbkb",'TBL',0,'L');
$this->fpdf->Cell(1.5,0.5,$npbbkb."%",'TBLR',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'TBL',0,'R');
$this->fpdf->Cell(2,0.5,"$pbbkb",'TBR',0,'R');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"",'LB',0,'C');
$this->fpdf->Cell(3,0.5,"Harga BBM",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Rp",'TBL',0,'R');
$this->fpdf->Cell(2,0.5,"$includeoat",'TBR',0,'R');

if($oat =='0'){ }else{
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"",'LB',0,'C');
$this->fpdf->Cell(3,0.5,"Transport (OAT)",'TBLR',0,'C');
$this->fpdf->Cell(1,0.5,"Rp",'TBL',0,'R');
$this->fpdf->Cell(2,0.5,"$noat",'TBR',0,'R');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Total Harga",'TBLR',0,'C');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"Rp",'TBL',0,'R');
$this->fpdf->Cell(2,0.5,"$include",'TBR',0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"2. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"$isi2",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"3. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"$isi3",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"4. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"$isi4",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"5. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"$isi5",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"6. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"Pembayaran ".$pembayaran." , dan ditransfer melalui rekening :",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(2,0.5,"Bank",0,0,'L');
$this->fpdf->Cell(13,0.5,": $bank",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(2,0.5,"Nama",0,0,'L');
$this->fpdf->Cell(13,0.5,": $namarek",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(2,0.5,"No. Rek",0,0,'L');
$this->fpdf->Cell(13,0.5,": $rekening",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"7. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"$isi6",0,0,'L');

if($isi7 ==''){ }else{
$this->fpdf->Ln();
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"8. ",0,0,'L');
$this->fpdf->Cell(15,0.5,"$isi7",0,0,'L');
}

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(17,0.5,"Demikian surat penawaran harga yang dapat kami sampaikan, besar harapan kami dapat memenuhi",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(17,0.5,"kebutuhan BBM perusahaan Bapak/Ibu. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(5,0.5,"Hormat kami,",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(5,0.5,"$cabang",0,0,'L');

$this->fpdf->Ln(2);
$this->fpdf->SetFont('Arial','BU',10);
$this->fpdf->Cell(5,0.5,"$pemasaran",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(5,0.5,"Direktur Marketing",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->Cell(17,0.5,"Tembusan :",0,0,'L');

if($tembusan ==''){ }else{
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(17,0.5,"$tembusan",0,0,'L');
}

if($tembusan1 ==''){ }else{
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(17,0.5,"$tembusan1",0,0,'L');
}

if($tembusan2 ==''){ }else{
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(17,0.5,"$tembusan2",0,0,'L');
}


$this->fpdf->Output("Surat_Penawaran_$no.pdf","I");
?>
