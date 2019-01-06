<?php

class Pajak_model extends CI_Model {
	
	var $id;
	var $data;

	//Query manual
	function manualQuery($q) { return $this->db->query($q); }
	
	//Summary Jurnal
	public function NamaCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->nama; } }else{ $hasil = ''; } return $hasil; }

	public function KodeCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kode; } }else{ $hasil = ''; } return $hasil; }

	public function NPWPCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->npwp; } }else{ $hasil = ''; } return $hasil; }

	public function PbbkbCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->pbbkb; } }else{ $hasil = ''; } return $hasil; }

	public function AlamatCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat; } }else{ $hasil = ''; } return $hasil; }

	public function Alamat1Cabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->alamat1; } }else{ $hasil = ''; } return $hasil; }

	public function KelurahanCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kelurahan; } }else{ $hasil = ''; } return $hasil; }

	public function KecamatanCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kecamatan; } }else{ $hasil = ''; } return $hasil; }

	public function KotaCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kota; } }else{ $hasil = ''; } return $hasil; }

	public function ProvinsiCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->provinsi; } }else{ $hasil = ''; } return $hasil; }

	public function TelpCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->telp; } }else{ $hasil = ''; } return $hasil; }

	public function FaxCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->fax; } }else{ $hasil = ''; } return $hasil; }

	public function EmailCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email; } }else{ $hasil = ''; } return $hasil; }

	public function Email1Cabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email1; } }else{ $hasil = ''; } return $hasil; }

	public function Email2Cabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email2; } }else{ $hasil = ''; } return $hasil; }

	public function BankCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->bank; } }else{ $hasil = ''; } return $hasil; }

	public function NamaRekeningCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->namarek; } }else{ $hasil = ''; } return $hasil; }

	public function RekeningCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->rekening; } }else{ $hasil = ''; } return $hasil; }

	public function StatusCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->status; } }else{ $hasil = ''; } return $hasil; }

	public function WarnaCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->warna; } }else{ $hasil = ''; } return $hasil; }

	public function PemilikCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->pemilik; } }else{ $hasil = ''; } return $hasil; }

	public function KepalaCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->kepala; } }else{ $hasil = ''; } return $hasil; }

	public function KeuanganCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->keuangan; } }else{ $hasil = ''; } return $hasil; }

	public function PembelianCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->pembelian; } }else{ $hasil = ''; } return $hasil; }

	public function PenjualanCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->penjualan; } }else{ $hasil = ''; } return $hasil; }

	public function OperasionalCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->operasional; } }else{ $hasil = ''; } return $hasil; }

	public function PemasaranCabang($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->pemasaran; } }else{ $hasil = ''; } return $hasil; }

	public function so($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->so; } }else{ $hasil = ''; } return $hasil; }

	public function Accso($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->accso; } }else{ $hasil = ''; } return $hasil; }

	public function Accsos($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->accsos; } }else{ $hasil = ''; } return $hasil; }

	public function Accpo($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->accpo; } }else{ $hasil = ''; } return $hasil; }

	public function Accdo($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->accdo; } }else{ $hasil = ''; } return $hasil; }

	public function Accinv($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->accinv; } }else{ $hasil = ''; } return $hasil; }

	public function Accpay($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->accpay; } }else{ $hasil = ''; } return $hasil; }

	public function Emailso($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->emailso; } }else{ $hasil = ''; } return $hasil; }

	public function Emailpo($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->emailpo; } }else{ $hasil = ''; } return $hasil; }

	public function Emaildo($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->emaildo; } }else{ $hasil = ''; } return $hasil; }

	public function Emailinv($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->emailinv; } }else{ $hasil = ''; } return $hasil; }

	public function Emailpay($id){
		$t = "SELECT * FROM wp WHERE id='$id'"; $d = $this->pajak_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->emailpay; } }else{ $hasil = ''; } return $hasil; }

	function get_data($id)
	{ $query = $this->db->get_where('wp',array('id'=>$id)); if ($query->num_rows() > 0) { return $query->row_array(); } else { return FALSE; } }

	function get_cabang()
	{ $query = $this->db->get('wp'); if ($query->num_rows() > 0)
		{  foreach ($query->result() as $row)  {  $cabang[$row->id] = $row->kota;  }  return $cabang; } else {  return FALSE; } }

	function fill_data()
	{
		$this->data = array(
			'npwp' => $this->input->post('npwp').$this->input->post('npwp1').$this->input->post('npwp2').$this->input->post('npwp3').$this->input->post('npwp4').$this->input->post('npwp5'),
			'nama' => $this->input->post('nama_wp'),
			'alamat' => $this->input->post('alamat'),
			'kota' => $this->input->post('kota'),
			'provinsi' => $this->input->post('provinsi'),
			'telp' => $this->input->post('telp'),
			'fax' => $this->input->post('fax'),
			'email' => $this->input->post('email'),
			'email1' => $this->input->post('email1'),
			'email2' => $this->input->post('email2'),
			'status' => $this->input->post('jenis'),
			'warna' => $this->input->post('warna'),	
			'pemilik' => $this->input->post('nama_pemilik'),
			'npwp_pemilik' => $this->input->post('npwp_pemilik').$this->input->post('npwp_pemilik1').$this->input->post('npwp_pemilik2').$this->input->post('npwp_pemilik3').$this->input->post('npwp_pemilik4').$this->input->post('npwp_pemilik5'),
			'kepala' => $this->input->post('kepala'),
			'keuangan' => $this->input->post('keuangan'),
			'pembelian' => $this->input->post('pembelian'),
			'penjualan' => $this->input->post('penjualan'),
			'operasional' => $this->input->post('operasional'),
			'pemasaran' => $this->input->post('pemasaran'),
			'keterangan' => $this->input->post('keterangan')
		);
	}
		
	function check_data()
	{ $query = $this->db->get('wp');
		if ($query->num_rows() > 0)
		{ $row = $query->row(); $this->id = $row->id; return TRUE; }
		else
		{ return FALSE; }
	}	

	function insert_data()
	{
		$insert = $this->db->insert('wp', $this->data);
		return $insert;
	}
	
	function update_data()
	{
		$this->db->where('id', $this->id);
		$update = $this->db->update('wp', $this->data);
		return $update;
	}

}
/* End of file pajak_model.php */
/* Location: ./application/models/pajak_model.php */