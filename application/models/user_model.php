<?php

class User_model extends CI_Model {

	var $data;

	function validate_login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->where('aktif', 1);
		$query = $this->db->get('login');
		
		return $query;
	}
	
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	public function NamaUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama_depan; } }else{ $hasil = ''; } return $hasil; }

	public function NamaBUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama_belakang; } }else{ $hasil = ''; } return $hasil; }

	public function Level($id){
		$t = "SELECT * FROM level WHERE id_level='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->level; } }else{ $hasil = ''; } return $hasil; }

	public function LevelUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->administrator; } }else{ $hasil = ''; } return $hasil; }

	public function JKUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jk; } }else{ $hasil = ''; } return $hasil; }

	public function KotaUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kota; } }else{ $hasil = ''; } return $hasil; }

	public function TglUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->tgl; } }else{ $hasil = ''; } return $hasil; }

	public function AlamatUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat; } }else{ $hasil = ''; } return $hasil; }

	public function Alamat1User($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat1; } }else{ $hasil = ''; } return $hasil; }

	public function PhoneUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->telp; } }else{ $hasil = ''; } return $hasil; }

	public function HPUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->hp; } }else{ $hasil = ''; } return $hasil; }

	public function EmailUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email; } }else{ $hasil = ''; } return $hasil; }
		
	public function Email($id){
		$t = "SELECT * FROM login WHERE email='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->id; } }else{ $hasil = ''; } return $hasil; }
		
	function check_email($id)
	{ $this->db->where('email', $id); $query = $this->db->get('login'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	public function RekeningUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->rekening; } }else{ $hasil = ''; } return $hasil; }
		
	public function KetUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->keterangan; } }else{ $hasil = ''; } return $hasil; }

	public function PhotoUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->photo; } }else{ $hasil = ''; } return $hasil; }

	public function ExternalUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->external; } }else{ $hasil = ''; } return $hasil; }

	public function WPUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->wp_id; } }else{ $hasil = ''; } return $hasil; }

	public function LoginUser($id){
		$t = "SELECT * FROM login WHERE id='$id'"; $d = $this->user_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->login_id; } }else{ $hasil = ''; } return $hasil; }

	//CRED
    function cek($kode)
	{ $this->db->where('id',$kode); $query=$this->db->get('login'); return $query; }

    function update($kode,$jenis)
	{ $this->db->where('id',$kode); $this->db->update('login',$jenis); return $this->db->insert_id(); }

	function set_wp_id($id)
	{ $this->db->where('wp_id', $id); }

	function set_login_id($id)
	{ $this->db->where('login_id', $id); }

	function get_all_data()
	{ $this->db->order_by('aktif', 'desc'); $this->db->order_by('wp_id', 'asc'); $this->db->order_by('administrator', 'asc'); $query = $this->db->get('login'); if ($query->num_rows() > 0) {  return $query->result(); } else {  return FALSE; } }

	function get_data_by_id($id)
	{ $this->db->where('id', $id); $query = $this->db->get('login'); if ($query->num_rows() > 0) {  return $query->row_array(); } else {  return FALSE; } }

	function get_user_administrator()
	{ $query = $this->db->get('level'); if ($query->num_rows() > 0) {  foreach ($query->result() as $row)  {  $level[$row->id_level] = $row->level;  }  return $level; } else {  return FALSE; } }

	function get_user_cabang()
	{ $query = $this->db->get_where('level',array('id_level >'=>'2')); if ($query->num_rows() > 0) {  foreach ($query->result() as $row)  {  $level[$row->id_level] = $row->level;  }  return $level; } else {  return FALSE; } }

	function fill_data()
	{
		$this->data = array(
			'nama_depan' => $this->input->post('fname'),
			'nama_belakang' => $this->input->post('lname'),
			'username' => $this->input->post('username'),
			'jk' => 'Laki-laki',
			'administrator' => $this->input->post('administrator'),
			'aktif' => 1,
			'wp_id'=> $this->input->post('wp_id'),
			'login_id'=> $this->session->userdata('SESS_USER_ID')
		);
		if($this->input->post('password')) $this->data['password'] = md5($this->input->post('password'));
	}
	
	//Check for IP login ID
	function check_login_IP($id = '')
	{ $this->db->where('ip_address', $_SERVER['REMOTE_ADDR']); if($id != '') $this->db->where('id !=', $id);
	$query = $this->db->get('login_history'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	//Check for duplicate login ID
	function check_username($id = '')
	{ $this->db->where('username', $this->data['username']); $this->db->where('aktif', 1); if($id != '') $this->db->where('id !=', $id);
	$query = $this->db->get('login'); if ($query->num_rows() > 0) { return FALSE; } else { return TRUE; }	}

	function insert_data()
	{ $insert = $this->db->insert('login', $this->data); return $insert; }

	function update_data($id)
	{ $this->db->where('id', $id); $update = $this->db->update('login', $this->data); return $update; }

	function delete_data($id)
	{ $this->db->where('id', $id); $delete = $this->db->update('login', array('aktif' => 0)); return $delete; }

}
/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
