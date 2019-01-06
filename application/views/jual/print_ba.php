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
$NPWPCustomer=$this->customer_model->NPWPCustomer($Customer);
$CPCustomer = $this->customer_model->CPCustomer($Customer);
$HPCustomer = $this->customer_model->HPCustomer($Customer);
$AlamatCustomer = $this->customer_model->AlamatCustomer($Customer);
$KotaCustomer = $this->customer_model->KotaCustomer($Customer);
$ProvinsiCustomer = $this->customer_model->ProvinsiCustomer($Customer);
$TelpCustomer = $this->customer_model->TelpCustomer($Customer);
$FaxCustomer = $this->customer_model->FaxCustomer($Customer);
$EmailCustomer = $this->customer_model->EmailCustomer($Customer);

// Delivery Order
$id_jual=$info['id_jual'];
$id_do=$info['id_do'];

$customer_id=$info['customer_id'];
$kirim=$info['kirim'];

$tglkirim=$info['tglkirim'];
$tgldo=$info['tgldo'];
$nodo=$info['nodo'];

$barang_id=$info['barang_id'];
$nopo=$info['nopo'];
$volume = number_format($info['volume']);

$seals=$info['seals'];
$density=$info['density'];
$temperature=$info['temperature'];
$remarks=$info['remarks'];

$armada=$info['armada'];
$angkutan=$info['angkutan'];
$carrier=$info['carrier'];
$vehicle_id=$info['vehicle_id'];

$driver=$info['driver'];

// Berita Acara
$judul="BERITA ACARA SERAH TERIMA";
$no = $info['id_jual']." - ".$info['id_do'];
$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tglkirim'])); 
$thn=$this->jurnal_model->ambilThn($info['tglkirim']); 
$tglkirim=$this->jurnal_model->tgl_indo($info['tglkirim']); 
$harikirim=$this->jurnal_model->hari($info['tglkirim']); 
$barang_id=$info['barang_id'];
$nodo=$info['nodo'];
$volume = number_format($info['volume']);
$angkutan=$info['angkutan'];
$vehicle_id=$info['vehicle_id'];
$seals=$info['seals'];


// PDF Setting 
$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($cabang);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(2.5,2,2.5,0.5);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','BU',12);
$this->fpdf->Cell(16,0.5,"BERITA ACARA SERAH TERIMA",'0',0,'C');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','B',11);
$this->fpdf->Cell(16,0.5,"No : ".$no."/BBM-SOLAR/".$kode."/".$bln."/".$thn,'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,"Pada hari, Tanggal : ".$harikirim.", ".$tglkirim,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,"Telah dilakukan proses penerimaan barang dari :",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"> ",0,0,'L');
$this->fpdf->Cell(4,0.5,"Nama Perusahaan",0,0,'L');
$this->fpdf->Cell(10,0.5,": ".$nama,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"> ",0,0,'L');
$this->fpdf->Cell(4,0.5,"Nama Barang",0,0,'L');
$this->fpdf->Cell(10,0.5,": HSD (High Speed Diesel) / Solar",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"> ",0,0,'L');
$this->fpdf->Cell(4,0.5,"No. DO",0,0,'L');
$this->fpdf->Cell(10,0.5,": ".$id_jual." / ".$id_do,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"> ",0,0,'L');
$this->fpdf->Cell(4,0.5,"Sebanyak",0,0,'L');
$this->fpdf->Cell(10,0.5,": ".$volume." Liter",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"> ",0,0,'L');
$this->fpdf->Cell(4,0.5,"No. Pol Kendaraan",0,0,'L');
$this->fpdf->Cell(10,0.5,": ".$vehicle_id,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"> ",0,0,'L');
$this->fpdf->Cell(4,0.5,"Nomor Segel",0,0,'L');
$this->fpdf->Cell(10,0.5,": ".$seals,0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,"Sebelum dilakukan pemindahan barang dari tangki transporter ke tangki penampung, terlebih dahulu",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,"Dilakukan pemeriksaan sebagai berikut :",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"1. ",0,0,'L');
$this->fpdf->Cell(14,0.5,"Kelengkapan dokumen pengiriman : Ya / Tidak",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(14,0.5,"Keterangan :_________________________________________________________",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"2. ",0,0,'L');
$this->fpdf->Cell(14,0.5,"Segel di tangki transporter dalam kondisi baik dan benar (tersegel) : Ya / Tidak",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(14,0.5,"Keterangan :_________________________________________________________",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"3. ",0,0,'L');
$this->fpdf->Cell(14,0.5,"Kualitas barang sesuai dengan pesanan : Ya / Tidak",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(14,0.5,"Keterangan :_________________________________________________________",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"4. ",0,0,'L');
$this->fpdf->Cell(14,0.5,"Volume barang yang diterima sesuai dengan pesanan : Ya / Tidak",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(14,0.5,"Keterangan :_________________________________________________________",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"5. ",0,0,'L');
$this->fpdf->Cell(14,0.5,"Setelah barang diterima, kondisi tangki transporter dalam keadaan kosong : Ya / Tidak",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(14,0.5,"Keterangan :_________________________________________________________",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,"Demikian berita acara serah terima ini dibuat dengan kondisi sebenar-benarnya dan dapat dipertanggung",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,"jawabkan di kemudian hari.",0,0,'L');

// Garis 
$this->fpdf->Ln(1);
$this->fpdf->Cell(16,0.01,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"PT. JAGAD",'TLR',0,'C');
$this->fpdf->Cell(4,0.5,"TRANSPORTIR",'TL',0,'C');
$this->fpdf->Cell(4,0.5,"DRIVER",'TL',0,'C');
$this->fpdf->Cell(4,0.5,"PENERIMA",'TLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"NUSANTARA ENERGI",'BLR',0,'C');
$this->fpdf->Cell(4,0.5,"",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"BARANG",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'L',0,'L');
$this->fpdf->Cell(4,0.5,"",'LR',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"",'BLR',0,'L');
$this->fpdf->Cell(4,0.5,"",'BL',0,'L');
$this->fpdf->Cell(4,0.5,"",'BL',0,'L');
$this->fpdf->Cell(4,0.5,"",'BLR',0,'L');

// Garis 
$this->fpdf->Ln();
$this->fpdf->Cell(16,0.01,"",'TLBR',0,'C',1);

// Garis 
$this->fpdf->Ln();
$this->fpdf->Cell(16,0.01,"",'TLBR',0,'C',1);

// Garis 
$this->fpdf->Ln(1);
$this->fpdf->Cell(16,0.01,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',10);
$this->fpdf->Cell(16,0.5,"Note Kritik dan Saran :",0,0,'L');

// Garis 
$this->fpdf->Ln(3);
$this->fpdf->Cell(16,0.01,"",'TLBR',0,'C',1);

$this->fpdf->Output("Berita_Acara_$no.pdf","I");
?>
