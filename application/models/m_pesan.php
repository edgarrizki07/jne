<?php
class M_pesan extends CI_Model{
    private $table="pesan";
    private $primary="id";
    
	//Query manual
	function manualQuery($q) { return $this->db->query($q); }

    function nootomatis(){
        $kode='Upload';
        return $kode;
    }
    
    function semua($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->table,$limit,$offset);
    }
    
    function user($limit=10,$offset=0,$order_column='id',$order_type='desc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
			$this->db->where('id <',$this->uri->segment(3));
			$this->db->like("kepada",$this->session->userdata('SESS_USER_ID')) and $this->db->like("dari",$this->m_pesan->CariPengirim($this->uri->segment(3)));
			$this->db->or_like("dari",$this->session->userdata('SESS_USER_ID')) and $this->db->like("kepada",$this->m_pesan->CariPengirim($this->uri->segment(3)));
        return
			$this->db->get_where($this->table,array('cekdari'=>'0','cekkepada'=>'0'),$limit,$offset);
    }
    
    function cari($cari){
        $this->db->like($this->primary,$cari);
        $this->db->or_like("pesan",$cari);
        return $this->db->get($this->table);
    }

    function baru($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get_where($this->table,array('bdari'=>'0','kepada'=>$this->session->userdata('SESS_USER_ID')),$limit,$offset);
    }
    
    function masuk($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get_where($this->table,array('cekdari'=>'0','kepada'=>$this->session->userdata('SESS_USER_ID')),$limit,$offset);
    }
    
    function keluar($limit=10,$offset=0,$order_column='',$order_type='asc'){
        if(empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get_where($this->table,array('cekkepada'=>'0','dari'=>$this->session->userdata('SESS_USER_ID')),$limit,$offset);
    }
    
    function jumlah(){
        return $this->db->count_all($this->table);
    }
    
    function cek($kode){
        $this->db->where($this->primary,$kode);
        $query=$this->db->get($this->table);
        
        return $query;
    }
    
    function simpan($jenis){
        $this->db->insert($this->table,$jenis);
        return $this->db->insert_id();
    }
    
    function update($kode,$jenis){
        $this->db->where($this->primary,$kode);
        $this->db->update($this->table,$jenis);
    }
    
    function hapus($kode){
        $this->db->where($this->primary,$kode);
		$data=array('cekdari'=>'1');
        $this->db->update($this->table,$data);
    }
    
    function hapuskeluar($kode){
        $this->db->where($this->primary,$kode);
		$data=array('cekkepada'=>'1');
        $this->db->update($this->table,$data);
    }
    
    function baca($kode){
		date_default_timezone_set("Asia/Jakarta");
        $this->db->where($this->primary,$kode);
		$data=array('bdari'=>'1','btgl'=>date('Y-m-d H:i:s'));
        $this->db->update($this->table,$data);
    }

	public function JmlInbox($id){
		$t = "SELECT kepada FROM pesan WHERE kepada='$id' AND cekdari='0'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil;
	}
	
	public function JmlOutbox($id){
		$t = "SELECT dari FROM pesan WHERE dari='$id' AND cekkepada='0'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil;
	}
	
	public function JmlBInbox($id){
		$t = "SELECT kepada FROM pesan WHERE kepada='$id' AND bdari='0'";$d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil;
	}
	
	public function JmlBOutbox($id){
		$t = "SELECT dari FROM pesan WHERE dari='$id' AND bdari='0'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil;
	}
	
	public function JmlTInbox($id){
		$t = "SELECT kepada FROM pesan WHERE kepada='$id' AND cekdari='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil;
	}
	
	public function JmlTOutbox($id){
		$t = "SELECT dari FROM pesan WHERE dari='$id' AND cekkepada='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ $hasil = $r; }else{ $hasil = 0; } return $hasil;
	}
		
	public function Lampiran($id){
		$t = "SELECT * FROM pesan WHERE id='$id'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->lampiran; } }else{ $hasil = ''; }
		return $hasil;
	}
	
	//Pencarian Setting Aplikasi
	public function Email() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->email;} }else{ $hasil = ''; } return $hasil; }

	public function Password() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->password;} }else{ $hasil = ''; } return $hasil; }

	public function Protocol() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->protocol;} }else{ $hasil = ''; } return $hasil; }

	public function Host() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->host;} }else{ $hasil = ''; } return $hasil; }

	public function Port() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->port;} }else{ $hasil = ''; } return $hasil; }

	public function HeaderMail() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->header_mail;} }else{ $hasil = ''; } return $hasil; }

	public function FooterMail() {
		$t = "SELECT * FROM setting WHERE id='1'"; $d = $this->m_pesan->manualQuery($t); $r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){ $hasil = $h->footer_mail;} }else{ $hasil = ''; } return $hasil; }

	//Kirim Email
	public function SendEmail($to,$subject,$message) {
		$judul = "Pesan ini diteruskan dari sistem ".$this->setting_model->Nama();
		$isipesan = $this->m_pesan->HeaderMail()."</br></br></br><b>".$this->user_model->NamaUser($this->session->userdata('SESS_USER_ID'))."</b></br>".$subject."-".$message."</br></br></br>".$this->m_pesan->FooterMail();
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
		$config['protocol']= $this->m_pesan->Protocol();
		$config['mailtype']= "html";
		$config['smtp_host']= $this->m_pesan->Host();
		$config['smtp_port']= $this->m_pesan->Port();
		$config['smtp_timeout']= "15";
		$config['smtp_user']= $this->m_pesan->Email(); //isi dengan email kamu
		$config['smtp_pass']= $this->m_pesan->Password(); // isi dengan password kamu
		$config['crlf']="\r\n";
		$config['newline']="\r\n";
		
		$config['wordwrap'] = TRUE;
		//memanggil library email dan set konfigurasi untuk pengiriman email
		
		$this->email->initialize($config);
		//konfigurasi pengiriman
		$this->email->from($this->m_pesan->Email());
		$this->email->to($to);
		$this->email->subject($judul);
		$this->email->message($isipesan);

		//Status Kirim
		if($this->email->send()){
			$this->session->set_userdata('SUCCESSMSG', 'Berhasil mengirim email.'); $status='1';
		}else{
			$this->session->set_userdata('SUCCESSMSG', 'Gagal mengirim email.'); $status='0';
		}
	}

    
}