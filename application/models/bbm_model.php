<?php

class Bbm_model extends CI_Model {

	var $data;
	
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	//Tabel Alamat Kirim
	public function AlamatKirim($id) {
		$t = "SELECT * FROM alamat_kirim WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat;} }else{ $hasil = ''; } return $hasil; }

	//Tabel Beli
	public function IDBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id_beli;} }else{ $hasil = ''; } return $hasil; }

	public function LoginBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id;} }else{ $hasil = ''; } return $hasil; }

	public function StatusBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->status;} }else{ $hasil = ''; } return $hasil; }

	public function JurnalBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jurnal_id;} }else{ $hasil = ''; } return $hasil; }

	public function SupplierBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->supplier_id;} }else{ $hasil = ''; } return $hasil; }

	public function TglBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tgl;} }else{ $hasil = ''; } return $hasil; }

	public function TempoBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tempo;} }else{ $hasil = ''; } return $hasil; }

	public function JmlBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml;} }else{ $hasil = ''; } return $hasil; }

	public function HargaBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->harga;} }else{ $hasil = ''; } return $hasil; }

	public function Total1Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot1;} }else{ $hasil = ''; } return $hasil; }

	public function Total2Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot2;} }else{ $hasil = ''; } return $hasil; }

	public function Total3Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot3;} }else{ $hasil = ''; } return $hasil; }

	public function Total4Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot4;} }else{ $hasil = ''; } return $hasil; }

	public function Total5Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot5;} }else{ $hasil = ''; } return $hasil; }

	public function Total6Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot6;} }else{ $hasil = ''; } return $hasil; }

	public function Total7Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot7;} }else{ $hasil = ''; } return $hasil; }

	public function Total8Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot8;} }else{ $hasil = ''; } return $hasil; }

	public function Total9Beli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot9;} }else{ $hasil = ''; } return $hasil; }

	public function BayarBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bayar;} }else{ $hasil = ''; } return $hasil; }

	public function AkunBayarBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->akunbyr;} }else{ $hasil = ''; } return $hasil; }

	public function TglBayarBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tglbyr;} }else{ $hasil = ''; } return $hasil; }

	public function WPBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id;} }else{ $hasil = ''; } return $hasil; }

	public function CekBeli($id) {
		$t = "SELECT * FROM beli WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->cek;} }else{ $hasil = ''; } return $hasil; }

	//Tabel Jual
	public function IDJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id_jual;} }else{ $hasil = ''; } return $hasil; }

	public function NopoJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nopo;} }else{ $hasil = ''; } return $hasil; }

	public function TglpoJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tglpo;} }else{ $hasil = ''; } return $hasil; }

	public function FilepoJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->filepo;} }else{ $hasil = ''; } return $hasil; }

	public function LoginJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id;} }else{ $hasil = ''; } return $hasil; }

	public function StatusJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->status;} }else{ $hasil = ''; } return $hasil; }

	public function JurnalJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jurnal_id;} }else{ $hasil = ''; } return $hasil; }

	public function CustomerJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->customer_id;} }else{ $hasil = ''; } return $hasil; }

	public function CustomerPO($id) {
		$t = "SELECT * FROM po WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->customer_id;} }else{ $hasil = ''; } return $hasil; }

	public function TglJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tgl;} }else{ $hasil = ''; } return $hasil; }

	public function KirimJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tglkirim;} }else{ $hasil = ''; } return $hasil; }

	public function JmlJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml;} }else{ $hasil = ''; } return $hasil; }

	//Invoice
	public function SalesJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->sales;} }else{ $hasil = ''; } return $hasil; }

	public function AngkutanJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->angkutan;} }else{ $hasil = ''; } return $hasil; }

	public function TempoJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tempo;} }else{ $hasil = ''; } return $hasil; }

	public function HargaJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->harga;} }else{ $hasil = ''; } return $hasil; }

	public function Total1Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot1;} }else{ $hasil = ''; } return $hasil; }

	public function Total2Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot2;} }else{ $hasil = ''; } return $hasil; }

	public function Total3Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot3;} }else{ $hasil = ''; } return $hasil; }

	public function Total4Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot4;} }else{ $hasil = ''; } return $hasil; }

	public function Total5Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot5;} }else{ $hasil = ''; } return $hasil; }

	public function Total6Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot6;} }else{ $hasil = ''; } return $hasil; }

	public function Total7Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot7;} }else{ $hasil = ''; } return $hasil; }

	public function Total8Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot8;} }else{ $hasil = ''; } return $hasil; }

	public function Total9Jual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tot9;} }else{ $hasil = ''; } return $hasil; }

	public function WPJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id;} }else{ $hasil = ''; } return $hasil; }

	public function CekJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->cek;} }else{ $hasil = ''; } return $hasil; }

	//Tabel Bayar
	public function JurnalBayar($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bunker_id;} }else{ $hasil = ''; } return $hasil; }

	public function LoginBayar($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_byr;} }else{ $hasil = ''; } return $hasil; }

	public function ACCBayar($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->acc_byr;} }else{ $hasil = ''; } return $hasil; }

	public function KeteranganBayar($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bayar;} }else{ $hasil = ''; } return $hasil; }

	public function BuktiBayarJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bukti;} }else{ $hasil = ''; } return $hasil; }

	public function AkunBayarJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->akunbyr;} }else{ $hasil = ''; } return $hasil; }

	public function TglBayarJual($id) {
		$t = "SELECT * FROM jual WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tglbyr;} }else{ $hasil = ''; } return $hasil; }

	//Tabel beli_bayar
	public function IdPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id_jual;} }else{ $hasil = ''; } return $hasil; }

	public function BuktiBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bukti;} }else{ $hasil = ''; } return $hasil; }

	public function JurnalBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bunker_id;} }else{ $hasil = ''; } return $hasil; }

	public function JmlBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jmlbyr;} }else{ $hasil = ''; } return $hasil; }

	public function KetBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->keterangan;} }else{ $hasil = ''; } return $hasil; }

	public function AkunBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->akunbyr;} }else{ $hasil = ''; } return $hasil; }

	public function TglBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tglbyr;} }else{ $hasil = ''; } return $hasil; }

	public function WPBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id;} }else{ $hasil = ''; } return $hasil; }

	public function LoginBayarPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id;} }else{ $hasil = ''; } return $hasil; }

	public function CekPembelian($id) {
		$t = "SELECT * FROM beli_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->cek;} }else{ $hasil = ''; } return $hasil; }

	//Tabel jual_bayar
	public function IdPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id_jual;} }else{ $hasil = ''; } return $hasil; }

	public function BuktiBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bukti;} }else{ $hasil = ''; } return $hasil; }

	public function JurnalBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bunker_id;} }else{ $hasil = ''; } return $hasil; }

	public function JmlBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jmlbyr;} }else{ $hasil = ''; } return $hasil; }

	public function KetBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->keterangan;} }else{ $hasil = ''; } return $hasil; }

	public function AkunBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->akunbyr;} }else{ $hasil = ''; } return $hasil; }

	public function TglBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tglbyr;} }else{ $hasil = ''; } return $hasil; }

	public function WPBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id;} }else{ $hasil = ''; } return $hasil; }

	public function LoginBayarPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id;} }else{ $hasil = ''; } return $hasil; }

	public function CekPenjualan($id) {
		$t = "SELECT * FROM jual_bayar WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->cek;} }else{ $hasil = ''; } return $hasil; }

	//Tabel DO
	public function Id_JualDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id_jual;} }else{ $hasil = ''; } return $hasil; }

	public function StatusDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->status;} }else{ $hasil = ''; } return $hasil; }

	public function IDDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id_do;} }else{ $hasil = ''; } return $hasil; }

	public function NoDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nodo;} }else{ $hasil = ''; } return $hasil; }

	public function JurnalDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jurnal_id;} }else{ $hasil = ''; } return $hasil; }

	public function LoginDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id;} }else{ $hasil = ''; } return $hasil; }

	public function WPDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id;} }else{ $hasil = ''; } return $hasil; }

	public function CustomerDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->customer_id;} }else{ $hasil = ''; } return $hasil; }

	public function VolumeDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->volume;} }else{ $hasil = ''; } return $hasil; }

	public function TglDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tgldo;} }else{ $hasil = ''; } return $hasil; }

	public function TglKirim($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tglkirim;} }else{ $hasil = ''; } return $hasil; }

	public function CekDO($id) {
		$t = "SELECT * FROM do WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->cek;} }else{ $hasil = ''; } return $hasil; }

	//Jumlah DO
	public function ItemDO($id){
		$t = "SELECT id FROM do WHERE cek='0' AND id_jual='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function CreatedDO($id){
		$t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status='1' AND id_jual='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){$hasil = $h->jml;} }else{ $hasil = 0; } return $hasil; }
	
	public function DeliveredDO($id){
		$t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND status='0' AND id_jual='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){$hasil = $h->jml;} }else{ $hasil = 0; } return $hasil; }
	
	//Jumlah PO
	public function StatusPO($id) {
		$t = "SELECT * FROM po WHERE id='$id'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->status;} }else{ $hasil = ''; } return $hasil; }

	//Jumlah Transaksi
	public function JmlBeliWaiting(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM beli WHERE wp_id ='$wp' AND status ='0' AND cek='0'";  }else{$t = "SELECT id FROM beli WHERE status ='0' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlBeliProsses(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM beli WHERE wp_id ='$wp' AND status ='1' AND cek='0'";  }else{$t = "SELECT id FROM beli WHERE status ='1' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlBeliSuccess(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM beli WHERE wp_id ='$wp' AND status ='2' AND cek='0'";  }else{$t = "SELECT id FROM beli WHERE status ='2' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlBeliPay(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM beli WHERE wp_id ='$wp' AND status ='3' AND cek='0'";  }else{$t = "SELECT id FROM beli WHERE status ='3' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlBeliPaid(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM beli WHERE wp_id ='$wp' AND status ='4' AND cek='0'";  }else{$t = "SELECT id FROM beli WHERE status ='4' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlBeliCancel(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM beli WHERE wp_id ='$wp' AND cek='1'";  }else{$t = "SELECT id FROM beli WHERE cek='1'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualWaiting(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM jual WHERE wp_id ='$wp' AND status ='0' AND cek='0'";  }else{$t = "SELECT id FROM jual WHERE status ='0' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualProsses(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM jual WHERE wp_id ='$wp' AND status ='1' AND cek='0'";  }else{$t = "SELECT id FROM jual WHERE status ='1' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualSuccess(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM jual WHERE wp_id ='$wp' AND status ='2' AND cek='0'";  }else{$t = "SELECT id FROM jual WHERE status ='2' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualPay(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM jual WHERE wp_id ='$wp' AND status ='3' AND cek='0'";  }else{$t = "SELECT id FROM jual WHERE status ='3' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualPaid(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM jual WHERE wp_id ='$wp' AND status ='4' AND cek='0'";  }else{$t = "SELECT id FROM jual WHERE status ='4' AND cek='0'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualCancel(){
		$wp=$this->session->userdata('SESS_WP_ID');
		if($this->session->userdata('ADMIN')>'1'){$t = "SELECT id FROM jual WHERE wp_id ='$wp' AND cek='1'";  }else{$t = "SELECT id FROM jual WHERE cek='1'"; } $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	//Jumlah Tgl
	public function SumBeliTgl($tgl1,$tgl2){
		$t = "SELECT sum(tot1) as jml FROM beli WHERE tgl BETWEEN '$tgl1' AND '$tgl2' AND status >'1' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumJualTgl($tgl1,$tgl2){
		$t = "SELECT sum(tot1) as jml FROM jual WHERE tgl BETWEEN '$tgl1' AND '$tgl2' AND status >'1' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
		
	public function SumJualTglSektor($tgl1,$tgl2,$sektor){
		$t = "SELECT sum(tot1) as jml FROM jual WHERE tgl BETWEEN '$tgl1' AND '$tgl2' AND status >'1' AND sektor='$sektor' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function SumJualTglSektorCabang($tgl1,$tgl2,$sektor,$cabang){
		$t = "SELECT sum(tot1) as jml FROM jual WHERE tgl BETWEEN '$tgl1' AND '$tgl2' AND status >'1' AND sektor='$sektor' AND wp_id='$cabang' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function JmlBeliTgl($tgl){
		$t = "SELECT id FROM beli WHERE tgl='$tgl' AND status >'1' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualTgl($tgl){
		$t = "SELECT id FROM jual WHERE tgl='$tgl' AND status >'1' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlDOTgl($tgl){
		$t = "SELECT id FROM do WHERE tglkirim='$tgl' AND status='0' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlBeliTglCab($tgl,$cab){
		$t = "SELECT id FROM beli WHERE wp_id='$cab' AND tgl='$tgl' AND status >'1' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlJualTglCab($tgl,$cab){
		$t = "SELECT id FROM jual WHERE wp_id='$cab' AND tgl='$tgl' AND status >'1' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function JmlDOTglCab($tgl,$cab){
		$t = "SELECT id FROM do WHERE wp_id='$cab' AND tglkirim='$tgl' AND status='0' AND cek='0'"; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	//Jumlah Bayar Beli
	public function JmlPaidBeli($id){
		$t = "SELECT sum(jmlbyr) as jml FROM beli_bayar WHERE cek='0' AND id_beli='$id' AND bunker_id!='' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function JmlPayBeli($id){
		$t = "SELECT sum(jmlbyr) as jml FROM beli_bayar WHERE cek='0' AND id_beli='$id' AND bunker_id='' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function JmlSisaBayarBeli($id){
		$hasil = $this->bbm_model->Total9Beli($id)-$this->bbm_model->JmlPaidBeli($id); return $hasil; }
	
	public function JmlBayarBeli($id){
		$hasil = $this->bbm_model->Total9Beli($id)-$this->bbm_model->JmlPaidBeli($id)-$this->bbm_model->JmlPayBeli($id); return $hasil; }
	
	//Jumlah Bayar Jual
	public function JmlPaidJual($id){
		$t = "SELECT sum(jmlbyr) as jml FROM jual_bayar WHERE cek='0' AND id_jual='$id' AND bunker_id!='' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function JmlPayJual($id){
		$t = "SELECT sum(jmlbyr) as jml FROM jual_bayar WHERE cek='0' AND id_jual='$id' AND bunker_id='' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }
	
	public function JmlSisaBayarJual($id){
		$hasil = $this->bbm_model->Total9Jual($id)-$this->bbm_model->JmlPaidJual($id); return $hasil; }
	
	public function JmlBayarJual($id){
		$hasil = $this->bbm_model->Total9Jual($id)-$this->bbm_model->JmlPaidJual($id)-$this->bbm_model->JmlPayJual($id); return $hasil; }
	
	//Jumlah Inventori
	public function JmlInventory($cab){
		$t = "SELECT sum(jml) as jml FROM beli WHERE cek='0' AND wp_id='$cab' AND status >'1' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $cabbeli = $h->jml; } }else{ $cabbeli = 0; } 
		$t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND wp_id='$cab' AND status ='0' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $cabdo = $h->jml; } }else{ $cabdo = 0; } 
		$cabstok = $cabbeli-$cabdo; return $cabstok; }
	
	public function JmlSisaJual($id){
		$t = "SELECT sum(jml) as jml FROM jual WHERE id='$id' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $jmljual = $h->jml; } }else{ $jmljual = 0; } 
		$t = "SELECT sum(volume) as jml FROM do WHERE cek='0' AND id_jual='$id' "; $d = $this->bbm_model->manualQuery($t); $r = $d->num_rows(); 
		if($r>0){ foreach($d->result() as $h){ $dojual = $h->jml; } }else{ $dojual = 0; } 
		$sisa = $jmljual-$dojual; return $sisa; }
	
	//Check for ID
	function check_transportir($id)
	{ $this->db->where('id', $id); $query = $this->db->get('transportir'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_alamat_kirim($id)
	{ $this->db->where('id', $id); $query = $this->db->get('alamat_kirim'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_beli($id)
	{ $this->db->where('id', $id); $query = $this->db->get('beli'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_beli_bayar($id)
	{ $this->db->where('id', $id); $query = $this->db->get('beli_bayar'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_jual($id)
	{ $this->db->where('id', $id); $query = $this->db->get('jual'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_jual_bayar($id)
	{ $this->db->where('id', $id); $query = $this->db->get('jual_bayar'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_do($id)
	{ $this->db->where('id', $id); $query = $this->db->get('do'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_po($id)
	{ $this->db->where('id', $id); $query = $this->db->get('po'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_tawaran($id)
	{ $this->db->where('id', $id); $query = $this->db->get('tawaran'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_customer($id)
	{ $this->db->where('id', $id); $query = $this->db->get('customer'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_supplier($id)
	{ $this->db->where('id', $id); $query = $this->db->get('supplier'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_wp($id)
	{ $this->db->where('id', $id); $query = $this->db->get('wp'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_login($id)
	{ $this->db->where('id', $id); $query = $this->db->get('login'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_akun($id)
	{ $this->db->where('id', $id); $query = $this->db->get('akun'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_jurnal($id)
	{ $this->db->where('id', $id); $query = $this->db->get('jurnal'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function check_jurnal_detail($id)
	{ $this->db->where('id', $id); $query = $this->db->get('jurnal_detail'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function supplier_jurnal($id)
	{ $this->db->where('supplier_id', $id); $query = $this->db->get('jurnal'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function customer_jurnal($id)
	{ $this->db->where('customer_id', $id); $query = $this->db->get('jurnal'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function cari($table, $where)
    {
        $s_t = $table;
        $this->db->select($s_t . '.*');
        $this->db->from($s_t);
        $this->db->or_like($where);
        return $this->db->get();
    }
}
/* End of file akun_model.php */
/* Location: ./application/models/akun_model.php */
