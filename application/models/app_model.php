<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	/**
	 * @author : M David
	 * @web : http://sampitos.com
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
	
	public function getAllData($table) { return $this->db->get($table); }
	public function getAllDataLimited($table,$limit,$offset) { return $this->db->get($table, $limit, $offset); }
	public function getSelectedDataLimited($table,$data,$limit,$offset) { return $this->db->get_where($table, $data, $limit, $offset); }
		
	//select table
	public function getSelectedData($table,$data) { return $this->db->get_where($table, $data); }
	
	//update table
	function updateData($table,$data,$field_key) { $this->db->update($table,$data,$field_key); }
	function deleteData($table,$data) { $this->db->delete($table,$data); }
	function insertData($table,$data) { $this->db->insert($table,$data); }
	
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

	//Pencarian Setting Aplikasi
	public function Email() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email;} }else{ $hasil = ''; } return $hasil; }

	public function Password() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->password;} }else{ $hasil = ''; } return $hasil; }

	public function Protocol() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->protocol;} }else{ $hasil = ''; } return $hasil; }

	public function Host() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->host;} }else{ $hasil = ''; } return $hasil; }

	public function Port() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->port;} }else{ $hasil = ''; } return $hasil; }

	public function Terkirim() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->terkirim;} }else{ $hasil = ''; } return $hasil; }

	public function Gagal() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->gagal;} }else{ $hasil = ''; } return $hasil; }

	//Pencarian Data Email
	public function AutoEmail(){
		$t = "SELECT id FROM emailauto WHERE cek='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function UlangEmail(){
		$t = "SELECT id FROM emailauto WHERE ulang='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil; }
	
	public function StatusAuto($id){
		$t = "SELECT * FROM emailauto WHERE id='$id'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->status; } }else{ $hasil = ''; } return $hasil; }
	
	public function EmailKirim($id){
		$t = "SELECT * FROM emailauto WHERE id='$id'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email; } }else{ $hasil = ''; } return $hasil; }
	
	public function IdEmailAuto(){
		$text = "SELECT max(id) as no FROM emailauto"; $data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){ foreach($data->result() as $t){ $no = $t->no; $hasil = $no; } }else{ $hasil = '1'; } return $hasil; }
	
	public function IdEmail(){
		$text = "SELECT max(id) as no FROM email"; $data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){ foreach($data->result() as $t){ $no = $t->no; $hasil = $no; } }else{ $hasil = '1'; } return $hasil; }
	
	public function JudulEmail($id){
		$t = "SELECT * FROM email WHERE id='$id'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->judul; } }else{ $hasil = ''; } return $hasil; }
	
	public function PesanEmail($id){
		$t = "SELECT * FROM email WHERE id='$id'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->pesan; } }else{ $hasil = ''; } return $hasil; }
	
	public function JmlAutoEmail(){
		$t = "SELECT id as jml FROM emailauto"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }

	public function JmlEmailSudah(){
		$t = "SELECT id as jml FROM emailauto WHERE cek='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }

	public function JmlEmailGanda(){
		$t = "SELECT sum(status) as jml FROM emailauto WHERE status='2'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml/2; } }else{ $hasil = 0; } return $hasil; }

	public function JmlKirimEmail(){
		$t = "SELECT sum(status) as jml FROM emailauto WHERE status='1'"; $d = $this->app_model->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->jml; } }else{ $hasil = 0; } return $hasil; }

	//Pencarian Data Penjualan
	public function id_jual($id){
		$t = "SELECT * FROM do WHERE nodo='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->id_jual;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	public function tgljual($id){
		$t = "SELECT * FROM jual WHERE id_jual='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->tgl;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	public function buyerjual($id){
		$t = "SELECT * FROM jual WHERE id_jual='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kode_buyer;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	public function penjual($id){
		$t = "SELECT * FROM jual WHERE kodebeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->username;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	//Pencarian Data Pembelian
	public function tglbeli($id){
		$t = "SELECT * FROM beli WHERE kodebeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->tglbeli;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	public function pembeli($id){
		$t = "SELECT * FROM beli WHERE kodebeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->username;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	//Pencarian Data Pesan
	public function CariPengirim($id){
		$t = "SELECT * FROM pesan WHERE nis='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->username;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	//Pencarian Data Homepage
	public function CariJudulHome($id){
		$t = "SELECT * FROM home WHERE idhome='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->judul;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariIsiHome($id){
		$t = "SELECT * FROM home WHERE idhome='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->keterangan;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariImageHome($id){
		$t = "SELECT * FROM home WHERE idhome='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->image;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	//Cari data Supplier 
	public function NamaSupplier($id){
		$t = "SELECT * FROM supplier WHERE kode_supplier='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_supplier;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function UsahaSupplier($id){
		$t = "SELECT * FROM supplier WHERE kode_supplier='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_usaha;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function AlamatSupplier($id){
		$t = "SELECT * FROM supplier WHERE kode_supplier='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->alamat;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function PhoneSupplier($id){
		$t = "SELECT * FROM supplier WHERE kode_supplier='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_telp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function EmailSupplier($id){
		$t = "SELECT * FROM supplier WHERE kode_supplier='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->email;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	//Pencarian Data Admins
	public function Carilevel($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->level;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariNama($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_lengkap;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariKota($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_kota;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariFoto($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->foto;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CarilevelAdmins($id){
		$t = "SELECT * FROM level WHERE id_level='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->level;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	//Pencarian Data Pengguna
	public function CariNamaPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_lengkap;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	
	public function CariKodePengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kode_agen;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariUsahaPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_usaha;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariKotaPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_kota;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariFotoPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->foto;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariAlamatPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->alamat;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariPajakPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->pajak;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariSppkpPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->sppkp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariTelponPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_telp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariFaxPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_fax;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function CariEmailPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->email;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	//Cari data Cabang 
	public function JamLogin($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->logintime;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function Panggilan($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->panggilan;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function KodeCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kode_agen;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function NamaCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_lengkap;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function UsahaCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_usaha;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function PajakCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->pajak;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function SppkpCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->sppkp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function AlamatCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->alamat;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function KotaCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_kota;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function ProvinsiCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->provinsi;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function PhoneCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_telp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function FaxCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_fax;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function EmailCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->email;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function FotoCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->foto;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function LogoCabang($id){
		$t = "SELECT * FROM admins WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->logo;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	//Cari data Buyer 
	public function NamaBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_buyer;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function HPBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_hp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function AlamatBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->alamat;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function KotaBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kota;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function UsahaBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_usaha;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function NpwpBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->npwp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function PhoneBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_telp;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function FaxBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->no_fax;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function EmailBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->email;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function KontrakBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nokontrak;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function KuotaBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->kuota;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function JangkaBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jangka;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function DiscBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->discount;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function LogoBuyer($id){
		$t = "SELECT * FROM buyer WHERE kode_buyer='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->logo;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	//Cari data Barang 
	public function NamaBrg($id){
		$t = "SELECT * FROM barang WHERE kode_barang='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_barang;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}

	public function SatuanBrg($id){
		$t = "SELECT * FROM barang WHERE kode_barang='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->satuan;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}



	//Perhitungan dalam Web
	public function JmlBerita($id){
		$t = "SELECT idhome FROM komentar WHERE tabel='berita' AND idhome='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlKegiatan($id){
		$t = "SELECT idhome FROM komentar WHERE tabel='kegiatan' AND idhome='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function ItemTempat($id){
		$t = "SELECT tempat FROM page WHERE tempat='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	//Perhitungan dalam Aplikasi
// perhitungan cetak
	public function ItemDO($id){
		$t = "SELECT nodo FROM do WHERE cek='0' AND id_jual='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function ItemBeli($id){
		$t = "SELECT kodebeli FROM beli WHERE cek='0' AND kodebeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlBeli($id){
		$t = "SELECT sum(jmlbeli * hargabeli) as jml FROM beli WHERE cek='0' AND kodebeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function QtyBeli($id){
		$t = "SELECT sum(jmlbeli) as jml FROM beli WHERE cek='0' AND kodebeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function QtyJual($id){
		$t = "SELECT sum(jmljual) as jml FROM d_jual WHERE cek='0' AND id_jual='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	public function QtyBeliTgl($id){
		$t = "SELECT sum(a.jmlbeli) as jml 
			FROM beli as a
			JOIN beli as b
			ON a.kodebeli=a.kodebeli 
			WHERE b.tglbeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlBeliTgl($id){
		$t = "SELECT sum(a.jmlbeli * a.hargabeli) as jml 
			FROM beli as a
			JOIN beli as b
			ON a.kodebeli=a.kodebeli 
			WHERE b.tglbeli='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	
	public function ItemJual($id){
		$t = "SELECT id_jual FROM d_jual WHERE cek='0' AND id_jual='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlJual($id){
		$t = "SELECT sum(jmljual * hargajual) as jml FROM d_jual WHERE cek='0' AND id_jual='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

// Sidebar
	public function JmlBrg(){
		$t = "SELECT kode_barang FROM barang WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlCabang(){
		$t = "SELECT username FROM admins WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlSupplier(){
		$t = "SELECT kode_supplier FROM supplier WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlBuyer(){
		$t = "SELECT kode_buyer FROM buyer WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlBuyerUser($id){
		$t = "SELECT kode_buyer FROM buyer WHERE username='$id' AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlPembelian(){
		$t = "SELECT kodebeli FROM beli WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlPenjualan(){
		$t = "SELECT id_jual FROM jual WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlBInbox($id){
		$t = "SELECT kepada FROM pesan WHERE kepada='$id' AND bdari='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlBOutbox($id){
		$t = "SELECT username FROM pesan WHERE username='$id' AND bkepada='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlInbox($id){
		$t = "SELECT kepada FROM pesan WHERE kepada='$id' AND cekdari='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlOutbox($id){
		$t = "SELECT username FROM pesan WHERE username='$id' AND cekkepada='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlFile(){
		$t = "SELECT file FROM download WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlFileku($id){
		$t = "SELECT file FROM download WHERE username='$id' AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlNotif(){
		$t = "SELECT id FROM history WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
// Dashboard
	public function AllJmlBeli(){
		$t = "SELECT sum(jmlbeli) as jml FROM beli WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function AllJmlJual(){
		$t = "SELECT sum(jmljual) as jml FROM d_jual WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function AllJmlLogin(){
		$t = "SELECT id as jml FROM login";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function AllJmlUpload(){
		$t = "SELECT nis as jml FROM download WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function AllNilaiBeli(){
		$t = "SELECT sum(jmlbeli * hargabeli) as jml FROM beli WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function AllNilaiJual(){
		$t = "SELECT sum(jmljual * hargajual) as jml FROM d_jual WHERE cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function HariBeli($tgl){
		$t = "SELECT sum(a.jmlbeli) as jml FROM beli as a JOIN beli as b ON a.kodebeli=b.kodebeli WHERE b.tglbeli=$tgl AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function MingguBeli($tgl1,$tgl){
		$t = "SELECT sum(a.jmlbeli) as jml FROM beli as a JOIN beli as b ON a.kodebeli=b.kodebeli WHERE b.tglbeli BETWEEN '$tgl1' AND '$tgl' AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function BulanBeli($bln){
		$t = "SELECT sum(a.jmlbeli) as jml FROM beli as a JOIN beli as b ON a.kodebeli=b.kodebeli WHERE month(b.tglbeli)=$bln AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function TahunBeli($thn){
		$t = "SELECT sum(a.jmlbeli) as jml FROM beli as a JOIN beli as b ON a.kodebeli=b.kodebeli WHERE year(b.tglbeli)=$thn AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function HariJual($tgl){
		$t = "SELECT sum(a.jmljual) as jml FROM d_jual as a JOIN jual as b ON a.id_jual=b.id_jual WHERE b.tgljual=$tgl AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function MingguJual($tgl1,$tgl){
		$t = "SELECT sum(a.jmljual) as jml FROM d_jual as a JOIN jual as b ON a.id_jual=b.id_jual WHERE b.tgljual BETWEEN '$tgl1' AND '$tgl' AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function BulanJual($bln){
		$t = "SELECT sum(a.jmljual) as jml FROM d_jual as a JOIN jual as b ON a.id_jual=b.id_jual WHERE month(b.tgljual)=$bln AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function TahunJual($thn){
		$t = "SELECT sum(a.jmljual) as jml FROM d_jual as a JOIN jual as b ON a.id_jual=b.id_jual WHERE year(b.tgljual)=$thn AND a.cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function HariLogin($tgl){
		$t = "SELECT id as jml FROM login WHERE tgl=$tgl AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function MingguLogin($tgl1,$tgl){
		$t = "SELECT id as jml FROM login WHERE tgl BETWEEN '$tgl1' AND '$tgl' AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function BulanLogin($bln){
		$t = "SELECT id as jml FROM login WHERE month(tgl)=$bln AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function TahunLogin($thn){
		$t = "SELECT id as jml FROM login WHERE year(tgl)=$thn AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function HariUpload($tgl){
		$t = "SELECT nis as jml FROM download WHERE tgl=$tgl AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function MingguUpload($tgl1,$tgl){
		$t = "SELECT nis as jml FROM download WHERE tgl BETWEEN '$tgl1' AND '$tgl' AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function BulanUpload($bln){
		$t = "SELECT nis as jml FROM download WHERE month(tgl)=$bln AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function TahunUpload($thn){
		$t = "SELECT nis as jml FROM download WHERE year(tgl)=$thn AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

// status cabang
	public function CancelPembelian(){
		$t = "SELECT kodebeli FROM beli WHERE cek='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlPembelianUser($id){
		$t = "SELECT kodebeli FROM beli WHERE username='$id' AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlPembelianCancel($id){
		$t = "SELECT kodebeli FROM beli WHERE username='$id' AND cek='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function CancelPenjualan(){
		$t = "SELECT id_jual FROM jual WHERE cek='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlPenjualanUser($id){
		$t = "SELECT id_jual FROM jual WHERE username='$id' AND cek='0'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlPenjualanCancel($id){
		$t = "SELECT id_jual FROM jual WHERE username='$id' AND cek='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function TotalBeli($tgl1,$tgl2){
		$t = "SELECT sum(a.jmlbeli * a.hargabeli) as jml 
			FROM beli as a
			JOIN beli as b
			ON a.kodebeli=b.kodebeli 
			WHERE b.tglbeli BETWEEN '$tgl1' AND '$tgl2'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function TotalJual($tgl1,$tgl2){
		$t = "SELECT sum(a.jmljual * a.hargajual) as jml 
				FROM d_jual as a
				JOIN jual as b
				ON a.id_jual=b.id_jual 
				WHERE b.tgljual BETWEEN '$tgl1' AND '$tgl2'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	//Pencarian Perhitungan
	public function CariStokAkhirAG($kode){
		$beli = $this->app_model->CariJmlBlag($kode);
		$jual = $this->app_model->CariJmlJlag($kode);
		$hasil = $beli-$jual;
		return $hasil;
	}
	
	public function CariJmlBlag($kode){
		$username = $this->session->userdata('username');
		$t = "SELECT a.kode_barang,b.kodebeli,b.username,c.username,sum(jmlbeli) as jml 
			FROM beli as a JOIN beli as b JOIN admins as c
			ON a.kodebeli=b.kodebeli AND b.username=c.username AND a.cek='0'
			WHERE c.username='$username' AND kode_barang='$kode' GROUP BY kode_barang";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function CariJmlJlag($kode){
		$username = $this->session->userdata('username');
		$t = "SELECT a.kode_barang,b.id_jual,b.username,c.username,sum(jmljual) as jml 
			FROM d_jual as a JOIN jual as b JOIN admins as c
			ON a.id_jual=b.id_jual AND b.username=c.username AND a.cek='0' 
			WHERE c.username='$username' AND kode_barang='$kode' GROUP BY kode_barang";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function CariStokAwal($kode){
		$t = "SELECT kode_barang,stok_awal FROM barang WHERE kode_barang='$kode'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->stok_awal;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function CariStokAkhirCB($kode){
		$beli = $this->app_model->CariJmlBlcb($kode);
		$jual = $this->app_model->CariJmlJlcb($kode);
		$hasil = $beli-$jual;
		return $hasil;
	}
	
	public function CariJmlBlcb($kode){
		$username = $this->session->userdata('username');
		$t = "SELECT kode_barang,sum(jmlbeli) as jml FROM beli WHERE kode_barang='$kode' AND cek='0' GROUP BY kode_barang";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function CariJmlJlcb($kode){
		$username = $this->session->userdata('username');
		$t = "SELECT kode_barang,sum(jmljual) as jml FROM d_jual WHERE kode_barang='$kode' AND cek='0' GROUP BY kode_barang";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function CariStokAkhir($kode){
		$awal = $this->app_model->CariStokAwal($kode);
		$beli = $this->app_model->CariJmlBeli($kode);
		$jual = $this->app_model->CariJmlJual($kode);
		$hasil = ($awal+$beli)-$jual;
		return $hasil;
	}
	
	public function CariJmlBeli($kode){
		$t = "SELECT kode_barang,sum(jmlbeli) as jml FROM beli WHERE kode_barang='$kode' AND cek='0' GROUP BY kode_barang";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function CariJmlJual($kode){
		$t = "SELECT kode_barang,sum(jmljual) as jml FROM d_jual WHERE kode_barang='$kode' AND cek='0' GROUP BY kode_barang";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function JmlBeliCab($kode){
		$t = "SELECT sum(b.jmlbeli) as jml FROM beli as a JOIN beli as b
		ON a.kodebeli=b.kodebeli AND b.cek='0' WHERE a.username='$kode'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function JmlJualCab($kode){
		$t = "SELECT sum(b.jmljual) as jml FROM jual as a JOIN d_jual as b
		ON a.id_jual=b.id_jual AND b.cek='0' WHERE a.username='$kode'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function NilaiBeliCab($kode){
		$t = "SELECT sum(b.jmlbeli * b.hargabeli) as jml FROM beli as a JOIN beli as b
		ON a.kodebeli=b.kodebeli AND b.cek='0' WHERE a.username='$kode'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function NilaiJualCab($kode){
		$t = "SELECT sum(b.jmljual * b.hargajual) as jml FROM jual as a JOIN d_jual as b
		ON a.id_jual=b.id_jual AND b.cek='0' WHERE a.username='$kode'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	//Grafik
	public function GrafikBeli($bln,$thn){
		$t = "SELECT month(a.tglbeli) as bln, year(a.tglbeli) as th, count(*) as jml 
			FROM beli as a
			JOIN beli as b
			ON a.kodebeli=b.kodebeli 
			WHERE month(a.tgljual)='$bln' AND year(a.tgljual)='$thn'
			GROUP BY month(a.tgljual),year(a.tgljual)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function GrafikJual($bln,$thn){
		$t = "SELECT month(a.tgljual) as bln, year(a.tgljual) as th, count(*) as jml 
			FROM jual as a
			JOIN d_jual as b
			ON a.id_jual=b.id_jual 
			WHERE month(a.tgljual)='$bln' AND year(a.tgljual)='$thn'
			GROUP BY month(a.tgljual),year(a.tgljual)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	//MaxKode untuk menurutkan kode jika ditambah datanya
	public function MaxKodeSupplier(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(kode_supplier) as no FROM supplier";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,3))+1;
				$hasil = 'SP'.sprintf("%03s", $tmp);
			}
		}else{
			$hasil = 'SP'.'001';
		}
		return $hasil;
	}
	
	public function MaxKodeBuyer(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(kode_buyer) as no FROM buyer";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,2,3))+1;
				$hasil = 'B-'.sprintf("%03s", $tmp);
			}
		}else{
			$hasil = 'B-'.'001';
		}
		return $hasil;
	}
	
	public function MaxKodeBeli(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(kodebeli) as no FROM beli";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,3,5))+1;
				$hasil = 'FB-'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'FB-'.'00001';
		}
		return $hasil;
	}
	
	public function Maxid_jual(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(id_jual) as no FROM jual";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,4,5))+1;
				$hasil = 'INV-'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'INV-'.'00001';
		}
		return $hasil;
	}

	public function MaxKodePPN(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(id_jual) as no FROM h_ppn";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,8,8))+1;
				$hasil = '030.001.'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = '030.001.'.'00000001';
		}
		return $hasil;
	}


	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1].'-'.$exp[0]; }
		return $date;
	}

	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function jam_str($time){
		$exp = explode(':',$time);
		if(count($exp) == 3) {
			$time = $exp[0].':'.$exp[1];
		}
		return $time;
	}

	public function ambilDate($tgl){
		$exp = explode(' ',$tgl);
		$tgl = $exp[0];
		return $tgl;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function ambilBulan($tgl){
		$exp = explode('-',$tgl);
		$bln = $exp[1];
		return $bln;
	}
	
	public function ambilThn($tgl){
		$exp = explode('-',$tgl);
		$thn = $exp[0];
		return $thn;
	}
	
	public function ambilTime($tgl){
		$exp = explode(' ',$tgl);
		$tgl = $exp[1];
		return $tgl;
	}
	
	public function ambilJam($tgl){
		$exp = explode(':',$tgl);
		$tgl = $exp[0];
		return $tgl;
	}
	
	public function ambilKar($kar){
		$exp = substr($kar,0,150);
		return $exp;
	}
	
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$username = mysql_real_escape_string($usr);
		$password = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('admins', array('user' => $username, 'password' => $password));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'aingLoginYeuh';
						$sess_data['username'] = $qad->username;
						$sess_data['level'] = $qad->level;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'index.php/home');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'web');
		}
	}
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */