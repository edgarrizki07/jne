<?php

class Setting_model extends CI_Model {

	var $data;
	
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	//Pencarian Setting Aplikasi
	public function Nama() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama;} }else{ $hasil = ''; } return $hasil; }

	public function Inu() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->inu;} }else{ $hasil = ''; } return $hasil; }

	public function Singkatan() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->singkatan;} }else{ $hasil = ''; } return $hasil; }

	public function Logo1() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->logo_1;} }else{ $hasil = ''; } return $hasil; }

	public function Logo2() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->logo_2;} }else{ $hasil = ''; } return $hasil; }

	public function Header() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->header;} }else{ $hasil = 'header.png'; } return $hasil; }

	public function Alamat() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat;} }else{ $hasil = ''; } return $hasil; }

	public function Telp() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->telp;} }else{ $hasil = ''; } return $hasil; }

	public function Fax() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->fax;} }else{ $hasil = ''; } return $hasil; }

	public function Produk() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->produk;} }else{ $hasil = ''; } return $hasil; }

	public function Web() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->web;} }else{ $hasil = ''; } return $hasil; }

	public function Keterangan() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->keterangan;} }else{ $hasil = ''; } return $hasil; }

	public function Start() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->start_date;} }else{ $hasil = ''; } return $hasil; }

	//Pencarian Setting Email
	public function Email() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email;} }else{ $hasil = ''; } return $hasil; }

	public function Password() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->password;} }else{ $hasil = ''; } return $hasil; }

	public function Protocol() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->protocol;} }else{ $hasil = ''; } return $hasil; }

	public function Host() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->host;} }else{ $hasil = ''; } return $hasil; }

	public function Port() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->port;} }else{ $hasil = ''; } return $hasil; }

	public function Header_mail() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->header_mail;} }else{ $hasil = ''; } return $hasil; }

	public function Footer_mail() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->footer_mail;} }else{ $hasil = ''; } return $hasil; }

	public function Subject_po() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->subject_po;} }else{ $hasil = ''; } return $hasil; }

	public function Subject_do() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->subject_do;} }else{ $hasil = ''; } return $hasil; }

	public function Subject_invoice() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->subject_invoice;} }else{ $hasil = ''; } return $hasil; }

	public function Subject_pay() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->setting_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->subject_pay;} }else{ $hasil = ''; } return $hasil; }

	public function getWarna($wrn){
		switch ($wrn){
			case 1: return "red"; break;
			case 2: return "yellow"; break;
			case 3: return "blue"; break;
			case 4: return "green";	break;
			case 5: return "orange"; break;
			case 6: return "purple"; break;
			case 7: return "fuchsia"; break;
			case 8: return "navy"; break;
			case 9: return "aqua"; break;
			case 10: return "lime"; break;
			case 11: return "red"; break;
			case 12: return "yellow"; break;
			case 13: return "blue"; break;
			case 14: return "green";	break;
			case 15: return "orange"; break;
			case 16: return "purple"; break;
			case 17: return "fuchsia"; break;
			case 18: return "navy"; break;
			case 19: return "aqua"; break;
			case 20: return "lime"; break;
			case 21: return "red"; break;
			case 22: return "yellow"; break;
			case 23: return "blue"; break;
			case 24: return "green";	break;
			case 25: return "orange"; break;
			case 26: return "purple"; break;
			case 27: return "fuchsia"; break;
			case 28: return "navy"; break;
			case 29: return "aqua"; break;
			case 30: return "lime"; break;
		}
	} 
	
	//CRED
    function cek($kode){
        $this->db->where('id',$kode);
        $query=$this->db->get('setting');
        return $query;
    }

    function update($kode,$jenis){
        $this->db->where('id',$kode);
        $this->db->update('setting',$jenis);
        return $this->db->insert_id();
    }


}
/* End of file akun_model.php */
/* Location: ./application/models/akun_model.php */
