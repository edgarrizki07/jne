<?php

class Customer_model extends CI_Model {
	
	var $data;

	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	public function NamaCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama; } }else{ $hasil = ''; } return $hasil; }

	public function NPWPCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->npwp; } }else{ $hasil = ''; } return $hasil; }

	public function KodeCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kode; } }else{ $hasil = ''; } return $hasil; }

	public function ExportCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->export; } }else{ $hasil = ''; } return $hasil; }

	public function SektorCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->sektor; } }else{ $hasil = ''; } return $hasil; }

	public function AlamatCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat; } }else{ $hasil = ''; } return $hasil; }

	public function Alamat1Customer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat1; } }else{ $hasil = ''; } return $hasil; }

	public function KotaCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kota; } }else{ $hasil = ''; } return $hasil; }

	public function ProvinsiCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->provinsi; } }else{ $hasil = ''; } return $hasil; }

	public function KirimCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat_kirim; } }else{ $hasil = ''; } return $hasil; }

	public function TelpCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->telpon_1; } }else{ $hasil = ''; } return $hasil; }

	public function FaxCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->fax; } }else{ $hasil = ''; } return $hasil; }

	public function EmailCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email; } }else{ $hasil = ''; } return $hasil; }

	public function CPCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->cp; } }else{ $hasil = ''; } return $hasil; }

	public function HPCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->hp; } }else{ $hasil = ''; } return $hasil; }

	public function WPCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id; } }else{ $hasil = ''; } return $hasil; }

	public function LoginCustomer($id){
		$t = "SELECT * FROM customer WHERE id='$id'"; $d = $this->customer_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id; } }else{ $hasil = ''; } return $hasil; }

	function set_wp_id($id)
	{ $this->db->where('wp_id', $id); }

	function set_login_id($id)
	{ $this->db->where('login_id', $id); }

	function get_all_data()
	{ $query = $this->db->get('customer'); if ($query->num_rows() > 0) {  return $query->result(); } else {  return FALSE; } }

	function get_data_by_id($id)
	{ $this->db->where('id', $id); $query = $this->db->get('customer'); if ($query->num_rows() > 0) {  return $query->row_array(); } else {  return FALSE; } }

	function fill_data()
	{
		$exp = explode(' ',$this->input->post('nama')); 
		$kode1 = substr($exp[0],0,1);
		$kode2 = substr($exp[1],0,1);
		$kode3 = substr($exp[2],0,1);		
		// $dig2 = $exp[1]; if ($dig2= '') { $digit2==substr($dig2,0,1);} else { $digit2=='';  }
		// $dig3 = $exp[2]; if ($dig3= '') { $digit3==substr($dig3,0,1);} else { $digit3=='';  }
		// if ($exp[1]= '') { $kode2 = substr($exp[1],0,0) ;} else { $kode2 = $digit2;}
		// if ($exp[2]= '') { $kode3 = substr($exp[1],0,0) ;} else { $kode3 = $digit3;}
		// if ($exp[1]= '') { $kode2 = substr($exp[1],0,2);} else { $kode2 = substr($exp[1],0,1);}
		// if ($exp[2]= '') { $kode3 = substr($exp[2],0,2);} else { $kode3 = substr($exp[2],0,1);}
		// $kode = $digit1.''.substr($exp[1],0,1).''.substr($exp[2],0,1);
		$this->data = array(
			'kode' => $kode1.''.$kode2.''.$kode3.'.'.$this->input->post('bu'),
			'status' => "1",
			'bu' => $this->input->post('bu'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),			
			'alamat1' => $this->input->post('alamat1'),			
			'kota' => $this->input->post('kota'),			
			'provinsi' => $this->input->post('provinsi'),			
			'kodepos' => $this->input->post('kodepos'),			
			'telpon_1' => $this->input->post('telpon'),
			'fax' => $this->input->post('fax'),
			'status_usaha' => $this->input->post('status_usaha'),
			'email' => $this->input->post('email'),
			'npwp' => $this->input->post('npwp').$this->input->post('npwp1').$this->input->post('npwp2').$this->input->post('npwp3').$this->input->post('npwp4').$this->input->post('npwp5'),
			'tdp' => $this->input->post('tdp'),
			'bidang_usaha' => $this->input->post('bidang_usaha'),
			'kebutuhan_hsd' => $this->input->post('kebutuhan_hsd'),
			'kebutuhan_per' => $this->input->post('kebutuhan_per'),
			'nama_dirut' => $this->input->post('nama_dirut'),
			'ktp_dirut' => $this->input->post('ktp_dirut'),
			'alamat_dirut' => $this->input->post('alamat_dirut'),
			'alamat1_dirut' => $this->input->post('alamat1_dirut'),
			'jabatan_dirut' => $this->input->post('jabatan_dirut'),
			'telp_dirut' => $this->input->post('telp_dirut'),
			'hp_dirut' => $this->input->post('hp_dirut'),
			'email_dirut' => $this->input->post('email_dirut'),
			'nama_keuangan' => $this->input->post('nama_keuangan'),
			'jabatan_keuangan' => $this->input->post('jabatan_keuangan'),
			'telp_keuangan' => $this->input->post('telp_keuangan'),
			'hp_keuangan' => $this->input->post('hp_keuangan'),
			'email_keuangan' => $this->input->post('email_keuangan'),
			'nama_pembelian' => $this->input->post('nama_pembelian'),
			'jabatan_pembelian' => $this->input->post('jabatan_pembelian'),
			'telp_pembelian' => $this->input->post('telp_pembelian'),
			'hp_pembelian' => $this->input->post('hp_pembelian'),
			'email_pembelian' => $this->input->post('email_pembelian'),
			'wp_id'=> $this->session->userdata('SESS_WP_ID'),
			'login_id'=> $this->session->userdata('SESS_USER_ID')
		);
	}
	
	//Check for duplicate login ID
	function check_name($id = '')
	{ $this->db->where('nama', $this->data['nama']); if($id != '') $this->db->where('id !=', $id); $query = $this->db->get('customer');
		if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}	

	function insert_data()
	{ $insert = $this->db->insert('customer', $this->data); return $insert;	}

	function update_data($id)
	{ $this->db->where('id', $id); $update = $this->db->update('customer', $this->data); return $update;	}

	function delete_data($id)
	{ $this->db->where('id', $id); $delete = $this->db->delete('customer'); return $delete; }

}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */
