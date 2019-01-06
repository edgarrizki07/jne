<?php

	$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
	$nama = $this->setting_model->Nama(); 
	$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
	$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID'));
	$cabang = $this->pajak_model->KotaCabang($uri3);	
	$akun = $this->akun_model->NamaAkun($uri3);
	$tgl1 = $this->jurnal_model->tgl_str($uri4);
	$tgl2 = $this->jurnal_model->tgl_str($uri5);
	$sekarang = date("d-m-Y");
	
	$saldo_awal = number_format($this->akun_model->SaldoAwalAkun($uri3), 0, '', '.');
	$SumDebit = number_format($this->jurnal_model->SumDebit($uri3), 0, '', '.'); 
	$SumKredit = number_format($this->jurnal_model->SumKredit($uri3), 0, '', '.'); 
	$SumAll = number_format($this->jurnal_model->SumDebit($uri3)-$this->jurnal_model->SumKredit($uri3)+$this->akun_model->SaldoAwalAkun($uri3), 0, '', '.');
	$SumDebitTgl1 = number_format($this->jurnal_model->SumDebitTgl($uri3,$uri4), 0, '', '.');
	$SumKreditTgl1 = number_format($this->jurnal_model->SumKreditTgl($uri3,$uri4), 0, '', '.');
	$SumDebitTgl2 = number_format($this->jurnal_model->SumDebitTgl($uri3,$uri5), 0, '', '.');
	$SumKreditTgl2 = number_format($this->jurnal_model->SumKreditTgl($uri3,$uri5), 0, '', '.');
	$SumDebitTgl = number_format($this->jurnal_model->SumDebitAll($uri3,$uri4,$uri5), 0, '', '.');
	$SumKreditTgl = number_format($this->jurnal_model->SumKreditAll($uri3,$uri4,$uri5), 0, '', '.');
	$NSaldoAwal = $this->jurnal_model->SumDebitTgl($uri3,$uri4)-$this->jurnal_model->SumKreditTgl($uri3,$uri4)+$this->akun_model->SaldoAwalAkun($uri3);
	$SaldoAwal = number_format($this->jurnal_model->SumDebitTgl($uri3,$uri4)-$this->jurnal_model->SumKreditTgl($uri3,$uri4)+$this->akun_model->SaldoAwalAkun($uri3), 0, '', '.');
	$SaldoAkhir = number_format($NSaldoAwal+$this->jurnal_model->SumDebitAll($uri3,$uri4,$uri5)-$this->jurnal_model->SumKreditAll($uri3,$uri4,$uri5), 0, '', '.');

$this->fpdf->FPDF("P","cm","A4");
if($tgl1==''){
$this->fpdf->SetTitle("Laporan General Ledger ALL DATE ");
}else{
$this->fpdf->SetTitle("Laporan General Ledger FROM DATE : ".$tgl1." TO : ".$tgl2);
}
$this->fpdf->SetSubject($nama);
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
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(12,0.5,"Laporan General Ledger",0,0,'L');
$this->fpdf->Cell(3,0.5,"Cabang ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": $cabang ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(12,0.5,"Akun : ".$akun,0,0,'L');
$this->fpdf->Cell(3,0.5,"Halaman ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',9);
if($tgl1==''){
$this->fpdf->Cell(12,0.5,"ALL DATE",0,0,'L');
}else{
$this->fpdf->Cell(12,0.5,"FROM DATE : ".$tgl1." TO : ".$tgl2,0,0,'L');
}
$this->fpdf->Cell(3,0.5,"Tanggal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $sekarang",0,0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(19,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',10);
$this->fpdf->Cell(2,0.5,"Tanggal",0,0,'L');
$this->fpdf->Cell(2,0.5,"No Bukti",0,0,'L');
$this->fpdf->Cell(8,0.5,"Keterangan",0,0,'L');
$this->fpdf->Cell(2,0.5,"Debit",0,0,'R');
$this->fpdf->Cell(2,0.5,"Credit",0,0,'R');
$this->fpdf->Cell(1,0.5,"D/K",0,0,'R');
$this->fpdf->Cell(2,0.5,"Saldo",0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

				// Saldo Awal
				$sum = 0;
				if ($account_data['saldo_awal'] != 0)
				{
				  if($uri3==''){
					$sum = $account_data['saldo_awal'];
				  }else{
					$sum = $NSaldoAwal;
				  }
					if ($sum < 0)
					{
						$d = '';
						$k = number_format(-$sum, 0, '', '.');
						$dk = 'K';
					}
					else
					{
						$d = number_format($sum, 0, '', '.');
						$k = '';
						$dk = 'D';
					}
					$absum = number_format(abs($sum), 0, '', '.');
						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','',8);
						$this->fpdf->Cell(2,0.5,"",0,0,'L');
						$this->fpdf->Cell(2,0.5,"",0,0,'L');
						$this->fpdf->Cell(8,0.5,"Saldo Awal",0,0,'L');
						$this->fpdf->Cell(2,0.5,$d,0,0,'R');
						$this->fpdf->Cell(2,0.5,$k,0,0,'R');
						$this->fpdf->Cell(1,0.5,$dk,0,0,'R');
						$this->fpdf->Cell(2,0.5,$absum,0,0,'R');
				}
				
				if($journal_data)
				{
					foreach ($journal_data as $row) 
					{ 
						if($row->debit_kredit == 1)
						{
							$sum += $row->nilai;
							$d = number_format($row->nilai, 0, '', '.');
							$k = '';
						}
						else
						{
							$sum -= $row->nilai;
							$d = '';
							$k = number_format($row->nilai, 0, '', '.');
						}
						$dk = ($sum>=0) ? 'D' : 'K';
						$tgl = $this->jurnal_model->tgl_str($row->tgl);
						$absum = number_format(abs($sum), 0, '', '.');
						$customer = $row->customer_id;
						$keterangan = substr($row->keterangan.' '.$this->supplier_model->NamaSupplier($row->supplier_id).' '.$this->customer_model->NamaCustomer($customer),0,50);
						$nomor = $row->no_voucher; 
						$cabang = $this->pajak_model->KotaCabang($row->wp_id); 
						$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
						$no = $row->id;
						$cab = $this->pajak_model->KodeCabang($row->wp_id);
						$singkatan=$this->setting_model->singkatan();
						$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl)); 
						$thn=$this->jurnal_model->ambilThn($row->tgl); 
						$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
							$this->fpdf->Ln();
							$this->fpdf->SetFont('Times','',8);
							$this->fpdf->Cell(2,0.5,$tgl,0,0,'L');
							$this->fpdf->Cell(2,0.5,$nomor."/".$kode."/".$no,0,0,'L');
							$this->fpdf->Cell(8,0.5,$keterangan,0,0,'L');
							$this->fpdf->Cell(2,0.5,$d,0,0,'R');
							$this->fpdf->Cell(2,0.5,$k,0,0,'R');
							$this->fpdf->Cell(1,0.5,$dk,0,0,'R');
							$this->fpdf->Cell(2,0.5,$absum,0,0,'R');
					}
				}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

if($uri4==''){
	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(2,0.5,"",0,0,'L');
	$this->fpdf->Cell(2.25,0.5,"",0,0,'L');
	$this->fpdf->Cell(7.75,0.5,"TOTAL",0,0,'L');
	$this->fpdf->Cell(2,0.5,$SumDebit,0,0,'R');
	$this->fpdf->Cell(2,0.5,$SumKredit,0,0,'R');
	$this->fpdf->Cell(1,0.5,"",0,0,'R');
	$this->fpdf->Cell(2,0.5,$SumAll,0,0,'R');
}else{
	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(2,0.5,"",0,0,'L');
	$this->fpdf->Cell(2.25,0.5,"",0,0,'L');
	$this->fpdf->Cell(7.75,0.5,"TOTAL",0,0,'L');
	$this->fpdf->Cell(2,0.5,$SumDebitTgl,0,0,'R');
	$this->fpdf->Cell(2,0.5,$SumKreditTgl,0,0,'R');
	$this->fpdf->Cell(1,0.5,"",0,0,'R');
	$this->fpdf->Cell(2,0.5,$SaldoAkhir,0,0,'R');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0,"",'B',0,'C');

$this->fpdf->Output("Laporan_General_Ledger_$tgl1.sd.$tgl2","I");
?> 
