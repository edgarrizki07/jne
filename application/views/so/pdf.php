<?php
// Setting 
$logo=base_url().'images/'.$this->setting_model->Logo1();
$nama = $this->setting_model->Nama(); 
$web = $this->setting_model->Web(); 
$singkatan=$this->setting_model->singkatan();
$now = $this->jurnal_model->getBulan($this->jurnal_model->ambilBln(date('Y-m-d'))).' '.$this->jurnal_model->ambilThn(date('Y-m-d')); 

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
$customer = $info['customer_id'];
$Namacustomer=$this->customer_model->Namacustomer($customer);
$NPWPcustomer=$this->customer_model->NPWPcustomer($customer);
$Kodecustomer=$this->customer_model->Kodecustomer($customer);
$CPcustomer = $this->customer_model->CPcustomer($customer);
$HPcustomer = $this->customer_model->HPcustomer($customer);
$Alamatcustomer = $this->customer_model->Alamatcustomer($customer);
$Kotacustomer = $this->customer_model->Kotacustomer($customer);
$Provinsicustomer = $this->customer_model->Provinsicustomer($customer);
$Telpcustomer = $this->customer_model->Telpcustomer($customer);
$Faxcustomer = $this->customer_model->Faxcustomer($customer);
$Emailcustomer = $this->customer_model->Emailcustomer($customer);
$kirimcustomer = $this->customer_model->kirimcustomer($customer);

	
// Jurnal 
$judul=$title; $doc = 'SO';

// Tanggal PO MASUK & SO------------------------------------------------------------------
$bln=($this->jurnal_model->ambilBln($info['tgl'])); $thn=$this->jurnal_model->ambilThn($info['tgl']); 
$tg=$this->jurnal_model->ambilTgl($info['tgl']);  $tgl=$this->jurnal_model->tgl_indo($info['tgl']); 
$tglso=$this->jurnal_model->tgl_indo($info['tglso']);  $tglkirim=$this->jurnal_model->tgl_indo($info['tglkirim']);  $tempo=$this->jurnal_model->tgl_indo($info['tempo']); 

// User 
$sales = $info['sales']; $cso_id = $this->user_model->NamaUser($info['cso_id']); $admin_id = $this->user_model->NamaUser($info['admin_id']);

// Text PO MASUK & SO------------------------------------------------------------------
$no = $info['id_po']; $nopo = $info['nopo']; $term = $info['term']; 
$kirim = $info['kirim'];  $terbilang = $info['terbilang'];  $keterangan = $info['keterangan']; 

// 0 / 1 ------------------------------------------------------------------
$ppn = $info['ppn']; $pph = $info['pph']; $pbbkb = $info['pbbkb']; $ppnohp = $info['ppnohp']; $b_ppn = $info['b_ppn']; 
$b_pph = $info['b_pph']; $b_pbbkb = $info['b_pbbkb']; $b_ppnohp = $info['b_ppnohp']; $oat = $info['oat']; $pph21 = $info['pph21'];

// Numerik ------------------------------------------------------------------
$jml = $info['jml']; $harga = $info['harga']; $ohp = $info['ohp']; $npbbkb = $info['npbbkb']; $b_harga = $info['b_harga']; $b_ohp = $info['b_ohp']; $b_npbbkb = $info['b_npbbkb'];
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
$n_plbber = ($n_lbber/$n_hppb)*100; $n_plbcof = ($n_lbcof/$n_hppb)*100; $n_plbcoftfm = ($n_lbcoftfm/$n_hppb)*100;
$lbber = number_format($n_lbber, 2, ',', '.'); $lbcof = number_format($n_lbcof, 2, ',', '.'); $lbcoftfm = number_format($n_lbcoftfm, 2, ',', '.');
$tlbber = number_format($n_tlbber, 0, ',', '.'); $tlbcof = number_format($n_tlbcof, 0, ',', '.'); $tlbcoftfm = number_format($n_tlbcoftfm, 0, ',', '.');
$plbber = number_format($n_plbber, 0, ',', '.'); $plbcof = number_format($n_plbcof, 0, ',', '.'); $plbcoftfm = number_format($n_plbcoftfm, 0, ',', '.');

//Info Pembelian & Penjualan -------------------------------------------------------------------
$n_hdp = $info['hdp']; $n_discount = $info['discount']; $n_savlb = $info['savlb']; 
$r_discount = ($n_discount*$n_hdp)/100; $n_hdad = $n_hdp-$r_discount; $r_savlb = $n_hdad+$n_savlb;
$margin = $info['margin']; $n_margin = ($margin*$n_hdad)/100; $t_margin = number_format($n_margin, 2, ',', '.'); 
$hdp = number_format($n_hdp, 2, ',', '.'); $discount = number_format($n_discount, 2, ',', '.'); $savlb = number_format($n_savlb, 2, ',', '.');
$t_discount = number_format($r_discount, 2, ',', '.'); $t_hdad = number_format($n_hdad, 2, ',', '.'); $t_savlb = number_format($r_savlb, 2, ',', '.');
$i_ppn = $n_hdad/10; $il_ppn = $r_savlb/10; $i_pph = $n_hdad*0.003; $il_pph = $r_savlb*0.003; $i_pbbkb = ($n_hdad*$npbbkb)/100; $il_pbbkb = ($r_savlb*$npbbkb)/100;  
$i_pajak1 = $n_hdad+$i_ppn; $il_pajak1 = $r_savlb+$il_ppn; $i_pajak2 = $n_hdad+$i_ppn+$i_pph; $il_pajak2 = $r_savlb+$il_ppn+$il_pph;
$i_pajak3 = $n_hdad+$i_ppn+$i_pbbkb; $il_pajak3 = $r_savlb+$il_ppn+$il_pbbkb; $i_pajak4 = $n_hdad+$i_ppn+$i_pph+$i_pbbkb; $il_pajak4 = $r_savlb+$il_ppn+$il_pph+$il_pbbkb;
$j_ppn = number_format($i_ppn, 2, ',', '.'); $jl_ppn = number_format($il_ppn, 2, ',', '.'); 
$j_pph = number_format($i_pph, 2, ',', '.'); $jl_pph = number_format($il_pph, 2, ',', '.'); 
$j_pbbkb = number_format($i_pbbkb, 2, ',', '.'); $jl_pbbkb = number_format($il_pbbkb, 2, ',', '.'); 
$j_pajak1 = number_format($i_pajak1, 2, ',', '.'); $jl_pajak1 = number_format($il_pajak1, 2, ',', '.'); 
$j_pajak2 = number_format($i_pajak2, 2, ',', '.'); $jl_pajak2 = number_format($il_pajak2, 2, ',', '.'); 
$j_pajak3 = number_format($i_pajak3, 2, ',', '.'); $jl_pajak3 = number_format($il_pajak3, 2, ',', '.'); 
$j_pajak4 = number_format($i_pajak4, 2, ',', '.'); $jl_pajak4 = number_format($il_pajak4, 2, ',', '.'); 

// PDF Setting 
$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($cabang);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(2.5,1.5,2.5);
$this->fpdf->SetAutoPageBreak(true,1);

//halaman 1-------------------------------------------------------------------
$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','BU',14);
$this->fpdf->Cell(16,0.5,$judul,'0',0,'C');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Nomor SO",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$no.".".$tg."".$bln."/".$kode."/".$doc."/".$thn,'0',0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Nama Pelanggan",0,0,'L');
$this->fpdf->Cell(4,0.5,": $Namacustomer",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Kode Pelanggan",0,0,'L');
$this->fpdf->Cell(4,0.5,": C-$customer".'/'.$Kodecustomer,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Nomor PO",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$nopo,'0',0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Tanggal Kirim",0,0,'L');
$this->fpdf->Cell(4,0.5,": $tglkirim",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Volume ",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$nvol." Liter",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Pembayaran ",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$top." Hari",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Sales ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $sales",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Keterangan ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $keterangan",0,0,'L');


$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(16,0.5,"PERIODE ".$now,'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(8,0.5,"Pembelian",'BLR',0,'C');
$this->fpdf->Cell(8,0.5,"Penjualan",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Harga Include Tax",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$hitb,'R',0,'R');
$this->fpdf->Cell(4,0.5,"Harga Include Tax",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$hitj,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Dasar",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$nb_harga,'R',0,'R');
$this->fpdf->Cell(4,0.5,"Dasar",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$nharga,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"PPn",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$ppnb,'R',0,'R');
$this->fpdf->Cell(4,0.5,"PPn",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$ppnj,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"PPh",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$pphb,'R',0,'R');
$this->fpdf->Cell(4,0.5,"PPh",'',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$pphj,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"PBBKb",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$pbbkbb,'R',0,'R');
$this->fpdf->Cell(4,0.5,"PBBKb",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$pbbkbj,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"CROSSCEK TAX",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$hitb,'R',0,'R');
$this->fpdf->Cell(4,0.5,"CROSSCEK TAX",'',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$hitj,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Maintenance",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$nmaint,'R',0,'R');
$this->fpdf->Cell(4,0.5,"Ongkos Angkut",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$toat,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"HPP Pembelian ",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$hppb,'R',0,'R');
$this->fpdf->Cell(4,0.5,"Harga Invoice ",'',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$hinv,'R',0,'R');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(8,0.5,"",'LR',0,'C');
$this->fpdf->Cell(8,0.5,"",'LR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"LABA KOTOR",'TL',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'T',0,'R');
$this->fpdf->Cell(3,0.5,$lbkot,'T',0,'R');
$this->fpdf->Cell(8,0.5,"",'TR',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"OAT Pembelian",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$noat_b1,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$toatb,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"OAT Penjualan",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$noat_j1,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$toatj,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Biaya Operasional",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$biop,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$nbopr,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Biaya Administrasi",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$biad,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$nbadm,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Cost Of Funder",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$cof,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tcof,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Selisih Ppn 10%",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$sppn,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tsppn,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Pungutan Pph 22",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$pphj,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tpph,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Pungutan Pbbkb",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$pbbkbj,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tpbbkb,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Pungutan BPH Migas",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$migas,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tmigas,0,0,'R');
$this->fpdf->Cell(4,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','U',10);
$this->fpdf->Cell(4,0.5,"Fee Marketing",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$nfee,'',0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tfee,0,0,'R');
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$sfee,'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"Total Pengeluaran",'LB',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'B',0,'R');
$this->fpdf->Cell(3,0.5,$tout,'B',0,'R');
$this->fpdf->Cell(1,0.5,"",'B',0,'R');
$this->fpdf->Cell(3,0.5,"",'B',0,'R');
$this->fpdf->Cell(1,0.5,"",'B',0,'R');
$this->fpdf->Cell(3,0.5,"",'BR',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"LABA BERSIH",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$lbber,'',0,'R');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tlbber,0,0,'R');
$this->fpdf->Cell(4,0.5,$plbber." %",'R',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"L.B + C.O.F",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$lbcof,'',0,'R');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tlbcof,0,0,'R');
$this->fpdf->Cell(4,0.5,$plbcof." %",'R',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"L.B + C.O.F + T.F.M",'LB',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'B',0,'R');
$this->fpdf->Cell(3,0.5,$lbcoftfm,'B',0,'R');
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"Rp",'B',0,'R');
$this->fpdf->Cell(3,0.5,$tlbcoftfm,'B',0,'R');
$this->fpdf->Cell(4,0.5,$plbcoftfm." %",'BR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(4,0.5,"TAX FEE MARKETING",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'',0,'R');
$this->fpdf->Cell(3,0.5,$tem,'',0,'R');
$this->fpdf->Cell(1,0.5,"",'',0,'R');
$this->fpdf->Cell(3,0.5,"",0,0,'R');
$this->fpdf->Cell(1,0.5,"",'',0,'R');
$this->fpdf->Cell(3,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Potongan PPN 10%",'L',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",0,0,'R');
$this->fpdf->Cell(3,0.5,$pot10,'',0,'R');
$this->fpdf->Cell(1,0.5,"",'',0,'R');
$this->fpdf->Cell(3,0.5,"",0,0,'R');
$this->fpdf->Cell(1,0.5,"",'',0,'R');
$this->fpdf->Cell(3,0.5,"",'R',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Potongan PPH 3%",'LB',0,'L');
$this->fpdf->Cell(1,0.5,": Rp",'B',0,'R');
$this->fpdf->Cell(3,0.5,$pot3,'B',0,'R');
$this->fpdf->Cell(8,0.5,"",'BR',0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(8,0.5,"",0,0,'C');
$this->fpdf->Cell(6,0.5,$kota.", ".$tglso,0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(8,0.5,"Disetujui oleh,",0,0,'C');
$this->fpdf->Cell(9,0.5,"Dibuat oleh,",0,0,'C');

$this->fpdf->Ln(3);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(8,0.5,$admin_id,0,0,'C');
$this->fpdf->Cell(9,0.5,$cso_id,0,0,'C');

//halaman 2-------------------------------------------------------------------
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(16,0.5,"Info Penjualan",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,1,"Nama Sales",'L',0,'C');
$this->fpdf->Cell(2,1,"Volume (S)",'L',0,'C');
$this->fpdf->Cell(2,0.5,"T.O.P",'BL',0,'C');
$this->fpdf->Cell(3,0.5,"Margin Min",'BL',0,'C');
$this->fpdf->Cell(6,0.5,"Bidang Usaha",'RL',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,0.5,"",'BL',0,'C');
$this->fpdf->Cell(2,0.5,"",'BL',0,'C');
$this->fpdf->Cell(2,0.5,$icof." %",'BL',0,'C');
$this->fpdf->Cell(3,0.5,$margin." %",'BL',0,'C');
$this->fpdf->Cell(6,0.5,"Customer",'BRL',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,0.5,$sales,'BL',0,'L');
$this->fpdf->Cell(2,0.5,$nvol,'BL',0,'C');
$this->fpdf->Cell(2,0.5,$top,'BL',0,'C');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(2,0.5,$t_margin,'B',0,'R');
$this->fpdf->Cell(1,0.5,"",'BL',0,'L');
$this->fpdf->Cell(5,0.5,"",'BR',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(3,0.5,"",'BL',0,'L');
$this->fpdf->Cell(2,0.5,"",'BL',0,'C');
$this->fpdf->Cell(2,0.5,"",'BL',0,'C');
$this->fpdf->Cell(1,0.5,"",'BL',0,'L');
$this->fpdf->Cell(2,0.5,"",'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(5,0.5,$t_hdad,'BR',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(16,0.5,"Lokasi Kirim",'BLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,$kirim,'BLR',0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(16,0.5,"Info Pembelian",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2.5,0.5,"HDP",'BL',0,'C');
$this->fpdf->Cell(2.5,0.5,"$hdp",'BL',0,'C');
$this->fpdf->Cell(2.5,0.5,"Harga Dasar",'L',0,'C');
$this->fpdf->Cell(1.5,0.5,"Ppn",'BL',0,'C');
$this->fpdf->Cell(1,0.5,"10",'BL',0,'C');
$this->fpdf->Cell(1.5,0.5,"Pph",'BL',0,'C');
$this->fpdf->Cell(1.5,0.5,"0.3",'BL',0,'C');
$this->fpdf->Cell(1.5,0.5,"Pbbkb",'BL',0,'C');
$this->fpdf->Cell(1.5,0.5,"$npbbkb",'BRL',0,'C');

$x_npbbkb=$npbbkb/100;
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2.5,0.5,"Diskon %",'BL',0,'C');
$this->fpdf->Cell(2.5,0.5,"Diskon (Rp)",'BL',0,'C');
$this->fpdf->Cell(2.5,0.5,"After Disc",'BL',0,'C');
$this->fpdf->Cell(2.5,0.5,"0.1",'BL',0,'C');
$this->fpdf->Cell(3,0.5,"0.003",'BL',0,'C');
$this->fpdf->Cell(3,0.5,"$x_npbbkb",'BRL',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2.5,0.5,$discount.' %','BL',0,'C');
$this->fpdf->Cell(2.5,0.5,$t_discount,'BL',0,'C');
$this->fpdf->Cell(2.5,0.5,$t_hdad,'BL',0,'C');
$this->fpdf->Cell(0.5,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(2,0.5,$j_ppn,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(2,0.5,$j_pph,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(2,0.5,$j_pbbkb,'BR',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2.5,0.5,"Saving Laba",'BL',0,'L');
$this->fpdf->Cell(2.5,0.5,$savlb,'BL',0,'C');
$this->fpdf->Cell(2.5,0.5,$t_savlb,'BL',0,'C');
$this->fpdf->Cell(0.5,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(2,0.5,$jl_ppn,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(2,0.5,$jl_pph,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(2,0.5,$jl_pbbkb,'BR',0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(16,0.5,"Pajak Pembelian",'TBLR',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"1",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"2",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"3",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"4",'BRL',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(4,0.5,"Ppn",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"Ppn + Pph",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"Ppn + Pbbkb",'BL',0,'C');
$this->fpdf->Cell(4,0.5,"Ppn + Pph + Pbbkb",'BRL',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$j_pajak1,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$j_pajak2,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$j_pajak3,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$j_pajak4,'BR',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$jl_pajak1,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$jl_pajak2,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$jl_pajak3,'B',0,'R');
$this->fpdf->Cell(1,0.5,"Rp ",'BL',0,'L');
$this->fpdf->Cell(3,0.5,$jl_pajak4,'BR',0,'R');



$this->fpdf->Output("SALES_ORDER_$no.pdf","I");
?>
