<?php

class Supplier_model extends CI_Model {
	
	var $data;
	
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	//Transportir
	public function KodeTransportir($id){
		$t = "SELECT * FROM transportir WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kode; } }else{ $hasil = ''; } return $hasil; }

	public function NamaTransportir($id){
		$t = "SELECT * FROM transportir WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama; } }else{ $hasil = ''; } return $hasil; }

	public function AlamatTransportir($id){
		$t = "SELECT * FROM transportir WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat; } }else{ $hasil = ''; } return $hasil; }

	//Supplier
	public function NamaSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama; } }else{ $hasil = ''; } return $hasil; }

	public function KodeSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kode; } }else{ $hasil = ''; } return $hasil; }

	public function ImportSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->import; } }else{ $hasil = ''; } return $hasil; }

	public function NPWPSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->npwp; } }else{ $hasil = ''; } return $hasil; }

	public function AlamatSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat; } }else{ $hasil = ''; } return $hasil; }

	public function KotaSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kota; } }else{ $hasil = ''; } return $hasil; }

	public function ProvinsiSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->provinsi; } }else{ $hasil = ''; } return $hasil; }

	public function TelpSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->telp; } }else{ $hasil = ''; } return $hasil; }

	public function FaxSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->fax; } }else{ $hasil = ''; } return $hasil; }

	public function EmailSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email; } }else{ $hasil = ''; } return $hasil; }

	public function DepoSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->depo; } }else{ $hasil = ''; } return $hasil; }

	public function RekeningSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->rekening; } }else{ $hasil = ''; } return $hasil; }

	public function KeteranganSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->keterangan; } }else{ $hasil = ''; } return $hasil; }

	public function CPSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->cp; } }else{ $hasil = ''; } return $hasil; }

	public function HPSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->hp; } }else{ $hasil = ''; } return $hasil; }

	public function WPSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id; } }else{ $hasil = ''; } return $hasil; }

	public function LoginSupplier($id){
		$t = "SELECT * FROM supplier WHERE id='$id'"; $d = $this->supplier_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id; } }else{ $hasil = ''; } return $hasil; }

	function set_wp_id($id)
	{ $this->db->where('wp_id', $id); }

	function set_login_id($id)
	{ $this->db->where('login_id', $id); }

	function get_all_data(){
		$query = $this->db->get('klien'); if ($query->num_rows() > 0)
		{ return $query->result(); } else { return FALSE; }
	}

}

/* End of file supplier_model.php */
/* Location: ./application/models/supplier_model.php */
