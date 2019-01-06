<?php

class Jurnal_model extends CI_Model {

	var $data;
	var $details;
	
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	//Dashboard
	public function JmlNotif(){
		$t = "SELECT id FROM history WHERE cek='0'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	//Grafik 1
	function GrafikJmlBeli($m){
		$y = date('Y');
		$t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND MONTH(tgl) ='$m' AND YEAR(tgl) ='$y' ";
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ if($h->jml>0){$hasil = $h->jml;}else{$hasil = 0;} } }else{ $hasil = 10; }  return $hasil; } 
		
	function GrafikJmlJual($m){
		$y = date('Y');
		$t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' AND MONTH(tgl) ='$m' AND YEAR(tgl) ='$y' ";
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ if($h->jml>0){$hasil = $h->jml;}else{$hasil = 0;} } }else{ $hasil = 10; }  return $hasil; } 

	function GrafikJmlDO($m){
		$y = date('Y');
		$t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND MONTH(tgldo) ='$m' AND YEAR(tgldo) ='$y' ";
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ if($h->jml>0){$hasil = $h->jml;}else{$hasil = 0;} } }else{ $hasil = 10; }  return $hasil; } 

	//Grafik 2
	function GrafikTotBeli($tgl){
		$y = date('Y');
		$t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl <='$tgl' ";
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ if($h->jml>0){$hasil = $h->jml;}else{$hasil = 0;} } }else{ $hasil = 10; }  return $hasil; } 
		
	function GrafikTotJual($tgl){
		$y = date('Y');
		$t = "SELECT sum(jml) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl <='$tgl' ";
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ if($h->jml>0){$hasil = $h->jml;}else{$hasil = 0;} } }else{ $hasil = 10; }  return $hasil; } 

	function GrafikTotDO($tgl){
		$y = date('Y');
		$t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tgldo <='$tgl' ";
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ if($h->jml>0){$hasil = $h->jml;}else{$hasil = 0;} } }else{ $hasil = 10; }  return $hasil; } 

	//Grafik 2
	function GrafikAvgBeli($tgl){
		$start= $this->setting_model->Start(); 
		$d1=strtotime('-1 day',strtotime($tgl)); $tgl1= date('Y-m-d', $d1);
		$t = "SELECT * FROM beli WHERE cek='0' AND status >'1' AND tgl<'$tgl'"; $d=$this->bbm_model->manualQuery($t);$r=$d->num_rows();
		if($r>0){foreach($d->result()as$h){$tglbeli=$h->tgl;}}else{$tglbeli='';} 	
		
		$t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl='$tgl' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $avgexbelitgl = $h->jml; } }else{ $avgexbelitgl = 0; }
		$t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl='$tglbeli' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $avgexbelitgl1 = $h->jml; } }else{ $avgexbelitgl1 = 0; }

		$t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl='$tgl'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $jmlbeli = $h->jml; } }else{ $jmlbeli = 0; }
		
		$t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl BETWEEN '$start' AND '$tgl1'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $realtotbeli1 = $h->jml; } }else{ $realtotbeli1 = 0; }
		$t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status ='0' AND tglkirim BETWEEN '$start' AND '$tgl1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); if($r>0){ foreach($d->result() as $h){ $realtotdo1 = $h->jml; } }else{ $realtotdo1 = 0; }
		$realstok1 = ($realtotbeli1-$realtotdo1);
		
		if($avgexbelitgl==0 || $avgexbelitgl1==0){ $ratgl = 0; }else{ $ratgl = (($avgexbelitgl*$jmlbeli)+($avgexbelitgl1*$realstok1))/($jmlbeli+$realstok1); }
		
		return number_format ($ratgl, 0, ',', ''); } 
		
	function GrafikAvgBeliCabang($tgl,$cabang){
		$start= $this->setting_model->Start(); 
		$d1=strtotime('-1 day',strtotime($tgl)); $tgl1= date('Y-m-d', $d1);
		$t = "SELECT * FROM beli WHERE wp_id='$cabang' AND cek='0' AND status >'1' AND tgl<'$tgl'"; $d=$this->bbm_model->manualQuery($t);$r=$d->num_rows();
		if($r>0){foreach($d->result()as$h){$tglbeli=$h->tgl;}}else{$tglbeli='';} 	
		
		$t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM beli WHERE wp_id='$cabang' AND cek='0' AND status >'1' AND tgl='$tgl' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $avgexbelitgl = $h->jml; } }else{ $avgexbelitgl = 0; }
		$t = "SELECT (sum(jml*harga)/sum(jml)) as jml FROM beli WHERE wp_id='$cabang' AND cek='0' AND status >'1' AND tgl='$tglbeli' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $avgexbelitgl1 = $h->jml; } }else{ $avgexbelitgl1 = 0; }

		$t = "SELECT sum(jml) as jml FROM beli WHERE wp_id='$cabang' AND cek='0' AND status >'1' AND tgl='$tgl'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $jmlbeli = $h->jml; } }else{ $jmlbeli = 0; }
		
		$t = "SELECT sum(jml) as jml FROM beli WHERE wp_id='$cabang' AND cek='0' AND status >'1' AND tgl BETWEEN '$start' AND '$tgl1'  "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $realtotbeli1 = $h->jml; } }else{ $realtotbeli1 = 0; }
		$t = "SELECT sum(volume) as jml FROM do WHERE wp_id='$cabang' AND cek='0' AND status ='0' AND tglkirim BETWEEN '$start' AND '$tgl1' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows(); if($r>0){ foreach($d->result() as $h){ $realtotdo1 = $h->jml; } }else{ $realtotdo1 = 0; }	
		if($realtotbeli1==0){ $realstok1 = 0; }else{ $realstok1 = ($realtotbeli1-$realtotdo1); }
		if($realstok1==0){ $ratgl = $avgexbelitgl; }else{ $ratgl = (($avgexbelitgl*$jmlbeli)+($avgexbelitgl1*$realstok1))/($jmlbeli+$realstok1); }
		return number_format ($ratgl, 0, ',', ''); } 
		
	function GrafikAvgInBeli($tgl){
		$dim=days_in_month($this->jurnal_model->ambilBln($tgl), $this->jurnal_model->ambilThn($tgl));
		$ftg=$tgl; $tgl1=$tgl; $thnbln=$this->jurnal_model->ambilThn($tgl).'-'.$this->jurnal_model->ambilBln($tgl); 
		if($this->jurnal_model->ambilTgl($ftg)>15){ $tg=$thnbln.'-'.$dim;  }else{ $tg= $thnbln.'-1'; }
		$t = "SELECT avg(tot9/jml) as jml FROM beli WHERE cek='0' AND status >'1' AND tgl BETWEEN '$ftg' AND '$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $avginbelitgl = $h->jml; } }else{ $avginbelitgl = 0; }
		return $avginbelitgl; } 
		
	function GrafikAvgExJual($tgl){
		$dim=days_in_month($this->jurnal_model->ambilBln($tgl), $this->jurnal_model->ambilThn($tgl));
		$ftg=$tgl; $tgl1=$tgl; $thnbln=$this->jurnal_model->ambilThn($tgl).'-'.$this->jurnal_model->ambilBln($tgl); 
		if($this->jurnal_model->ambilTgl($ftg)>15){ $tg=$thnbln.'-'.$dim;  }else{ $tg= $thnbln.'-1'; }
		$t = "SELECT avg(harga) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl BETWEEN '$ftg' AND '$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $avgexjualtgl = $h->jml; } }else{ $avgexjualtgl = 0; }
		return $avgexjualtgl; } 

	function GrafikAvgInJual($tgl){
		$dim=days_in_month($this->jurnal_model->ambilBln($tgl), $this->jurnal_model->ambilThn($tgl));
		$ftg=$tgl; $tgl1=$tgl; $thnbln=$this->jurnal_model->ambilThn($tgl).'-'.$this->jurnal_model->ambilBln($tgl); 
		if($this->jurnal_model->ambilTgl($ftg)>15){ $tg=$thnbln.'-'.$dim;  }else{ $tg= $thnbln.'-1'; }
		$t = "SELECT avg(tot9/jml) as jml FROM jual WHERE cek='0' AND status >'1' AND tgl BETWEEN '$ftg' AND '$tg' "; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $avginjualtgl = $h->jml; } }else{ $avginjualtgl = 0; }
		return $avginjualtgl; } 

	//Summary Aging
	public function OtherAgingAll($id,$dk){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND jurnal.other_id='$id' "; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function OtherAgingFrom($id,$dk,$tgl){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND jurnal.other_id='$id' AND jurnal.tgl>='$tgl'";
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function OtherAgingFromTo($id,$dk,$tgl1,$tgl2){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND jurnal.other_id='$id' AND jurnal.tempo BETWEEN '$tgl1' AND '$tgl2'"; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SupplierAgingAll($id,$dk){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND jurnal.supplier_id='$id' "; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
		
	public function SupplierAgingFrom($id,$dk,$tgl){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND jurnal.supplier_id='$id' AND jurnal.tgl>='$tgl'"; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
		
	public function SupplierAgingFromTo($id,$dk,$tgl1,$tgl2){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND jurnal.supplier_id='$id' AND jurnal.tempo BETWEEN '$tgl1' AND '$tgl2'"; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
		
	public function CustomerAgingAll($id,$dk){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND customer.id='$id' "; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			JOIN customer as customer
			ON jurnal.customer_id=customer.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function CustomerAgingFrom($id,$dk,$tgl){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND customer.id='$id' AND jurnal.tgl>='$tgl'"; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			JOIN customer as customer
			ON jurnal.customer_id=customer.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function CustomerAgingFromTo($id,$dk,$tgl1,$tgl2){
		$wer = "voucher.due='1' AND akun_jenis.aging='1' AND jurnal_detail.debit_kredit='$dk' AND customer.id='$id' AND jurnal.tempo BETWEEN '$tgl1' AND '$tgl2'"; 
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail 
			ON jurnal_detail.jurnal_id=jurnal.id 
			JOIN voucher as voucher 
			ON jurnal.voucher_id=voucher.id 
			JOIN akun_jenis as akun_jenis
			ON jurnal_detail.kategori_id=akun_jenis.id
			JOIN customer as customer
			ON jurnal.customer_id=customer.id
			WHERE $wer"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	//Summary Jurnal
	public function SumDebit($id){
		$t = "SELECT sum(nilai) as jml FROM jurnal_detail WHERE debit_kredit='1' AND akun_id='$id'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumKredit($id){
		$t = "SELECT sum(nilai) as jml FROM jurnal_detail WHERE debit_kredit='0' AND akun_id='$id'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
		
	public function SumDebitAll($id,$tgl1,$tgl2){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='1' AND jurnal_detail.akun_id='$id' AND jurnal.tgl BETWEEN '$tgl1' AND '$tgl2'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumKreditAll($id,$tgl1,$tgl2){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='0' AND jurnal_detail.akun_id='$id' AND jurnal.tgl BETWEEN '$tgl1' AND '$tgl2'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
		
	public function KatDebitAll($id,$tgl1,$tgl2){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='1' AND jurnal_detail.kategori_id='$id' AND jurnal.tgl BETWEEN '$tgl1' AND '$tgl2'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function KatKreditAll($id,$tgl1,$tgl2){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='0' AND jurnal_detail.kategori_id='$id' AND jurnal.tgl BETWEEN '$tgl1' AND '$tgl2'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumDebitTgl($id,$tgl){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal JOIN jurnal_detail as jurnal_detail ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='1' AND jurnal_detail.akun_id='$id' AND jurnal.tgl<='$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumKreditTgl($id,$tgl){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal JOIN jurnal_detail as jurnal_detail ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='0' AND jurnal_detail.akun_id='$id' AND jurnal.tgl<='$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumDebitBlnThn($id,$bln,$thn){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal JOIN jurnal_detail as jurnal_detail ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='1' AND jurnal_detail.akun_id='$id' AND month(jurnal.tgl)='$bln' AND YEAR(jurnal.tgl)='$thn'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumKreditBlnThn($id,$bln,$thn){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal JOIN jurnal_detail as jurnal_detail ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='0' AND jurnal_detail.akun_id='$id' AND month(jurnal.tgl)='$bln' AND YEAR(jurnal.tgl)='$thn'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function KatDebit($id){
		$t = "SELECT sum(nilai) as jml FROM jurnal_detail WHERE debit_kredit='1' AND kategori_id='$id'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function KatKredit($id){
		$t = "SELECT sum(nilai) as jml FROM jurnal_detail WHERE debit_kredit='0' AND kategori_id='$id'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function KatDebitTgl($id,$tgl){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='1' AND jurnal_detail.kategori_id='$id' AND jurnal.tgl<='$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function KatKreditTgl($id,$tgl){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='0' AND jurnal_detail.kategori_id='$id' AND jurnal.tgl<='$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function TotalDebitTgl($tgl){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='1' AND jurnal.tgl<'$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function TotalKreditTgl($tgl){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='0' AND jurnal.tgl<'$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function CabTotalDebitTgl($tgl,$cab){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='1' AND jurnal.wp_id=$cab AND jurnal.tgl<'$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function CabTotalKreditTgl($tgl,$cab){
		$t = "SELECT sum(jurnal_detail.nilai) as jml 
			FROM jurnal as jurnal
			JOIN jurnal_detail as jurnal_detail
			ON jurnal_detail.jurnal_id=jurnal.id 
			WHERE jurnal_detail.debit_kredit='0' AND jurnal.wp_id=$cab AND jurnal.tgl<'$tgl'"; 
		$d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	//Tabel Jual & Beli
	public function IdJual($id){
		$t = "SELECT * FROM jual WHERE jurnal_id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id; } }else{ $hasil = ''; } return $hasil; }

	public function IdBeli($id){
		$t = "SELECT * FROM beli WHERE jurnal_id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id; } }else{ $hasil = ''; } return $hasil; }

	//Tabel F
	public function FJurnal($id){
		$t = "SELECT * FROM f WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama; } }else{ $hasil = ''; } return $hasil; }

	//Tabel Jurnal
	public function VoucherId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->voucher_id; } }else{ $hasil = ''; } return $hasil; }

	public function NoVoucher($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->no_voucher; } }else{ $hasil = ''; } return $hasil; }

	public function FId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->f_id; } }else{ $hasil = ''; } return $hasil; }

	public function TanggalJurnal($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tgl; } }else{ $hasil = ''; } return $hasil; }

	public function TempoJurnal($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tempo; } }else{ $hasil = ''; } return $hasil; }

	public function KeteranganJurnal($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->keterangan; } }else{ $hasil = ''; } return $hasil; }

	public function SupplierId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->supplier_id; } }else{ $hasil = ''; } return $hasil; }

	public function CustomerId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->customer_id; } }else{ $hasil = ''; } return $hasil; }

	public function UserId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->user_id; } }else{ $hasil = ''; } return $hasil; }

	public function OtherId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->other_id; } }else{ $hasil = ''; } return $hasil; }

	public function WPId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id; } }else{ $hasil = ''; } return $hasil; }

	public function LoginId($id){
		$t = "SELECT * FROM jurnal WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id; } }else{ $hasil = ''; } return $hasil; }

	//Tabel Voucher
	public function KodeVoucher($id){
		$t = "SELECT * FROM voucher WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kode; } }else{ $hasil = ''; } return $hasil; }

	public function NamaVoucher($id){
		$t = "SELECT * FROM voucher WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama; } }else{ $hasil = ''; } return $hasil; }

	public function PayVoucher($id){
		$t = "SELECT * FROM voucher WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->pay; } }else{ $hasil = ''; } return $hasil; }

	public function JenisVoucher($id){
		$t = "SELECT * FROM voucher WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jenis; } }else{ $hasil = ''; } return $hasil; }

	public function ProyekVoucher($id){
		$t = "SELECT * FROM voucher WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->proyek; } }else{ $hasil = ''; } return $hasil; }

	public function DueVoucher($id){
		$t = "SELECT * FROM voucher WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->due; } }else{ $hasil = ''; } return $hasil; }

	public function JenisAkun($id){
		$t = "SELECT * FROM akun WHERE id='$id'"; $d = $this->jurnal_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jenis_akun_id; } }else{ $hasil = ''; } return $hasil; }

    function cek_jurnal($id){ $this->db->where('id',$id); $query=$this->db->get('jurnal');return $query; }

	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1].'-'.$exp[0]; } return $date;	}
		
	public function tgl_str($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1].'-'.$exp[0]; } return $date;	}
	
	public function tgl_string($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'/'.$exp[1].'/'.$exp[0]; } return $date;	}
	
	public function ambilDate($tgl){
		$exp = explode(' ',$tgl); $date = $exp[0]; return $date;	}
	
	public function ambilTime($tgl){
		$exp = explode(' ',$tgl); $time = $exp[1]; return $time;	}
	
	public function ambilJamMenit($jm){
		$exp = explode(':',$jm); if(count($exp) == 3) { $jm = $exp[0].':'.$exp[1]; } return $jm;	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl); $bln = $exp[2]; return $bln;	}
	
	public function ambilBulan($tgl){ 
		$exp = explode('-',$tgl); $bln = $exp[1]; return $bln; }
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl); $bln = $exp[1]; return $bln;	}
	
	public function ambilThn($tgl){
		$exp = explode('-',$tgl); $thn = $exp[0]; return $thn;	}
	
	public function ambilBlnThn($date){
		$exp = explode('-',$date); if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1]; } return $date;	}
	
	public function thn_bln($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = substr($tgl,5,2);
			$bln = $this->jurnal_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tahun.'-'.$bulan.' / '.$bln.' '.$tahun;		 
	}	

	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->jurnal_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function tgl_singkatan($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->jurnal_model->getBln(substr($tgl,5,2));
			$tahun = substr($tgl,2,2);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function bln_singkatan($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->jurnal_model->getBln(substr($tgl,5,2));
			$tahun = substr($tgl,2,2);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function tgl_inggris($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->jurnal_model->getMount(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $bulan.' '.$tanggal.', '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1:	return "Januari"; break;
			case 2: return "Februari"; break;
			case 3:	return "Maret"; break;
			case 4:	return "April";	break;
			case 5:	return "Mei"; break;
			case 6:	return "Juni"; break;
			case 7:	return "Juli"; break;
			case 8:	return "Agustus"; break;
			case 9:	return "September"; break;
			case 10: return "Oktober"; break;
			case 11: return "November"; break;
			case 12: return "Desember"; break;
		}
	} 
	
	public function getRomawi($bln){
		switch ($bln){
			case 1:	return "I"; break;
			case 2: return "II"; break;
			case 3:	return "III"; break;
			case 4:	return "IV";	break;
			case 5:	return "V"; break;
			case 6:	return "VI"; break;
			case 7:	return "VII"; break;
			case 8:	return "VIII"; break;
			case 9:	return "IX"; break;
			case 10: return "X"; break;
			case 11: return "XI"; break;
			case 12: return "XII"; break;
		}
	} 
	
	public function getBln($bln){
		switch ($bln){
			case 1:	return "Jan"; break;
			case 2: return "Feb"; break;
			case 3:	return "Mar"; break;
			case 4:	return "Apr";	break;
			case 5:	return "Mei"; break;
			case 6:	return "Jun"; break;
			case 7:	return "Jul"; break;
			case 8:	return "Aug"; break;
			case 9:	return "Sep"; break;
			case 10: return "Okt"; break;
			case 11: return "Nov"; break;
			case 12: return "Des"; break;
		}
	} 
	
	public function getMount($bln){
		switch ($bln){
			case 1:	return "January"; break;
			case 2: return "February"; break;
			case 3:	return "Maret"; break;
			case 4:	return "April";	break;
			case 5:	return "Mei"; break;
			case 6:	return "Juni"; break;
			case 7:	return "Juli"; break;
			case 8:	return "August"; break;
			case 9:	return "September"; break;
			case 10: return "Oktober"; break;
			case 11: return "November"; break;
			case 12: return "Desember"; break;
		}
	} 
	
	public function hari($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$day = date('D', strtotime($hari));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}
	
	function set_id($id)
	{		$this->db->where('jurnal.id', $id);	}

	function set_month_year($month, $year, $sign = '=')
	{		$unit = '';		$val = '';
		if($year !== '0')		{			$unit = 'YEAR';			$val = $year;		} 
		if($month !== '0')		{			$unit = ($unit) ? $unit.'_MONTH' : 'MONTH';			$val .= $month; 		}
 		if($unit) $this->db->where("EXTRACT($unit FROM tgl) $sign", $val);	}

	function set_sebelum_tgl($tgl)
	{ $this->db->where('jurnal.tgl <=', $tgl); }

	function set_setelah_tgl($tgl)
	{ $this->db->where('jurnal.tgl >=', $tgl); }

	function set_tempo($tgl)
	{ $this->db->where('jurnal.tempo >=', $tgl); }

	function set_voucher_id($voucher_id)
	{ $this->db->where('jurnal.voucher_id', $voucher_id); }

	function set_customer_id($customer_id)
	{ $this->db->where('jurnal.customer_id', $customer_id); }

	function set_supplier_id($supplier_id)
	{ $this->db->where('jurnal.supplier_id', $supplier_id); }

	function set_other_id($other_id)
	{ $this->db->where('jurnal.other_id', $other_id); }

	function set_wp_id($wp_id)
	{ $this->db->where('jurnal.wp_id', $wp_id); }

	function set_login_id($login_id)
	{ $this->db->where('jurnal.login_id', $login_id); }

	function set_account_id($akun_id)
	{ $this->db->where('jurnal_detail.akun_id', $akun_id); }

	function set_kategori_id($kategori_id)
	{ $this->db->where('jurnal_detail.kategori_id', $kategori_id); }

	function set_aging($aging)
	{ $this->db->where('akun_jenis.aging', $aging); }

	function set_due($due)
	{ $this->db->where('voucher.due', $due); }

	function set_aging_id($aging_id)
	{ $this->db->where('akun_jenis.aging_id', $aging_id); }

	function set_account_group_id($id)
	{ $this->db->where_in('akun.kelompok_akun_id', $id); }
 
	function set_other_group_id()
	{ $this->db->group_by("jurnal.other_id"); }
 
	function set_customer_group_id()
	{ $this->db->group_by("jurnal.customer_id"); }
 
	function set_supplier_group_id()
	{ $this->db->group_by("jurnal.supplier_id"); }
 
	function set_login_group_id()
	{ $this->db->group_by("jurnal.login_id"); }
 
	function set_f($f)
	{ $this->db->where_in('jurnal.f_id', $f); }

	function set_project($kelompok_akun_id = 0, $customer_id = '')
	{ if($kelompok_akun_id) $this->db->where('akun.kelompok_akun_id', $kelompok_akun_id);
	if($customer_id) { $this->db->where('jurnal.customer_id', $customer_id); } else { $this->db->where('jurnal.customer_id != ', 'NULL'); }	}

	function get_data()
	{
		$this->db->select('jurnal.id, jurnal.tgl, jurnal.tempo, jurnal.no, jurnal.voucher_id, jurnal.login_id, jurnal.wp_id, jurnal.user_id, jurnal.other_id, jurnal.supplier_id, jurnal.no_voucher, jurnal.keterangan, jurnal.f_id AS f_id, f.nama AS f_name, voucher.due, jurnal.customer_id, customer.nama as project_name, jurnal_detail.item, jurnal_detail.akun_id, akun.nama as account_name, akun.kelompok_akun_id, akun.kode, akun_jenis.aging, akun_jenis.aging_id, jurnal_detail.debit_kredit, jurnal_detail.nilai');
		$this->db->from('jurnal');
		$this->db->join('f', 'jurnal.f_id=f.id', 'INNER');
		$this->db->join('jurnal_detail', 'jurnal_detail.jurnal_id=jurnal.id', 'INNER');
		$this->db->join('akun', 'jurnal_detail.akun_id=akun.id', 'INNER');
		$this->db->join('customer', 'jurnal.customer_id=customer.id', 'LEFT');
		$this->db->join('voucher', 'jurnal.voucher_id=voucher.id', 'LEFT');
		$this->db->join('akun_jenis', 'jurnal_detail.kategori_id=akun_jenis.id', 'LEFT');
		$this->db->order_by('jurnal.tgl', 'asc'); $query = $this->db->get();
		if ($query->num_rows() > 0) { return $query->result(); } else { return FALSE; }	}


	function get_laba_rugi_data()
	{
		$this->db->select('MONTH(jurnal.tgl) AS month, YEAR(jurnal.tgl) AS year, akun_kelompok.id AS akun_kelompok, jurnal_detail.debit_kredit, SUM(jurnal_detail.nilai) AS nilai');
		$this->db->from('jurnal');
		$this->db->join('jurnal_detail', 'jurnal_detail.jurnal_id=jurnal.id AND jurnal.f_id != 3', 'INNER');
		$this->db->join('akun', 'jurnal_detail.akun_id=akun.id', 'INNER');
		$this->db->join('akun_kelompok', 'akun.kelompok_akun_id = akun_kelompok.id', 'INNER');
		$this->db->where_in('akun_kelompok.id', array( 4, 5 ) );
		$this->db->where('extract(year_month from jurnal.tgl) > extract(year_month from (date_sub(curdate(), interval 1 year)))');		
		$this->db->group_by(array('MONTH(jurnal.tgl)', 'YEAR(jurnal.tgl)', 'akun_kelompok.id', 'jurnal_detail.debit_kredit'));
		$query = $this->db->get(); if ($query->num_rows() > 0)
		{ foreach ($query->result() as $row) { 	$result[$row->month][$row->year][$row->akun_kelompok][$row->debit_kredit] = $row->nilai; } return $result; } else { return FALSE; }	}

	function fill_data()
	{
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); 
		$this->db->where('voucher_id', $this->input->post('voucher_id')); 
		$nomor_voucher=$this->db->count_all_results('jurnal')+1;
		$this->data = array(
			'no' => $this->db->count_all('jurnal')+1,
			'voucher_id' => $this->input->post('voucher_id'),
			'no_voucher' => $nomor_voucher,
			'tgl' => $this->input->post('tanggal'),
			'tempo' => $this->input->post('tempo'),
			'f_id' => $this->input->post('f_id'),
			'keterangan' => $this->input->post('deskripsi'),
			'login_id' => $this->session->userdata('SESS_USER_ID'),
			'user_id' => $this->input->post('penerima'),
			'other_id' => $this->input->post('other'),
			'supplier_id' => $this->input->post('supplier'),
			'wp_id'=> $this->session->userdata('SESS_WP_ID'),
			'waktu_post' => date("Y-m-d H:i:s")
		);
		if($this->input->post('proyekID')) $this->data['customer_id'] = $this->input->post('proyekID');
		$akun = $this->input->post('akun');
		for ($i = 1; $i <= count($akun); $i++)
		{
			$debit = $this->input->post('debit'.$i); $kredit =$this->input->post('kredit'.$i);
			if(($debit != '') || ($kredit != ''))
			{
				if($debit != '') { 	$dk = 1; 	$value = $debit; }
				else { 	$dk = 0; 	$value = $kredit; }
				$this->details[$i] = array(
					'item' => $i,
					'akun_id' => $akun[$i-1],
					'kategori_id' => $this->jurnal_model->JenisAkun($akun[$i-1]),
					'debit_kredit' => $dk,
					'nilai' => $value
					);
			}
		}
	}
	
	//Check for duplicate no
	function check_no()
	{ $this->db->where('no', $this->data['no']); $query = $this->db->get('jurnal'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}	

	function insert_data()
	{
		$this->db->trans_start();
		$this->db->insert('jurnal', $this->data);
		$jurnal_id = $this->db->insert_id();
		for ($i = 1; $i <= count($this->details); $i++)
		{
			$this->details[$i]['jurnal_id'] = $jurnal_id;
			$this->db->insert('jurnal_detail', $this->details[$i]);
			$op = ($this->details[$i]['debit_kredit']) ? '+' : '-';
			$this->db->query('UPDATE akun SET saldo = saldo'.$op.$this->details[$i]['nilai'].' WHERE id = '.$this->details[$i]['akun_id']);
		}
		$this->db->trans_complete();	
		return $this->db->trans_status();
	}

}
/* End of file jurnal_model.php */
/* Location: ./application/models/jurnal_model.php */
