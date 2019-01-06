<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Email extends CI_Controller {
 
	function __construct() {
	parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
		$this->load->model('m_email');}
	 
	public function index() {
		$data['title']="Email Keluar";
        if($this->uri->segment(3)=="berhasil")
            $data['message']="<div class='alert alert-success'>Berhasil mengirim email</div>";
        else if($this->uri->segment(3)=="gagal")
            $data['message']="<div class='alert alert-success'>Gagal mengirim email</div>";
        else
            $data['message']='';
			$data['main_content'] = 'email/index';
			$this->load->view('lte/mail', $data);
	}
	
	
	public function tulis() {
		$this->load->helper('form');
		$data['title']="Tulis Email";
        $data['message']='';
			$data['main_content'] = 'email/tulis';
			$this->load->view('lte/mail', $data);
	}
	
	public function kirim() {
		$this->load->helper('form');
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
		$data['title']="Email";
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->library('email');
		
		//konfigurasi email
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
		$config['protocol']= $this->app_model->Protocol();
		$config['mailtype']= "html";
		$config['smtp_host']= $this->app_model->Host();
		$config['smtp_port']= $this->app_model->Port();
		$config['smtp_timeout']= "15";
		$config['smtp_user']= $this->app_model->Email(); //isi dengan email kamu
		$config['smtp_pass']= $this->app_model->Password(); // isi dengan password kamu
		$config['crlf']="\r\n";
		$config['newline']="\r\n";
		
		$config['wordwrap'] = TRUE;
		//memanggil library email dan set konfigurasi untuk pengiriman email
		
		$this->email->initialize($config);
		//konfigurasi pengiriman
		$this->email->from($this->app_model->Email());
		$this->email->to($this->input->post('to'));
		$this->email->subject($this->input->post('subject'));
		$this->email->message($this->input->post('isi'));

		//Configure upload.
		$this->upload->initialize(array(
		"upload_path"   => "./uploads/",
		"allowed_types" => "*"
		));
		
		//Perform upload.
		if($this->upload->do_multi_upload("lampiran")) {
            $lampiran=$this->upload->file_name;
			$lamp = $this->upload->get_multi_upload_data();
			foreach ($lamp as $key=>$value){
				$this->email->attach($value['full_path']); //mengambil path dari attachmen yang di upload
			}
		}else {
		}

		//Status Kirim
		if($this->email->send()){
            $data['message']="<div class='alert alert-success'>Berhasil mengirim email</div>";
			$status='1';
		}else{
			$data['message']="<div class='alert alert-success'>Gagal mengirim email</div>";
			$status='0';
		}
			$info=array(
				'tgl'=>$tgl,
				'dari'=>$this->app_model->Email(),
				'kepada'=>$this->input->post('to'),
				'judul'=>$this->input->post('subject'),
				'pesan'=>$this->input->post('isi'),
				'lampiran'=>$lampiran,
				'cek'=>$status
			);
			$info1=array(
				'tgl'=>$tgl,
				'dari'=>$this->app_model->Email(),
				'kepada'=>$this->input->post('to'),
				'judul'=>$this->input->post('subject'),
				'pesan'=>$this->input->post('isi'),
				'cek'=>$status
			);
		if($this->upload->do_multi_upload("lampiran")) {
			$this->db->insert('email',$info);
		}else {
			$this->db->insert('email',$info1);
		}
			$data['main_content'] = 'email/kirim';
			$this->load->view('lte/mail', $data);
        return $this->db->insert_id();
	}
	
	//Auto Email
	public function daftar() {
		$data['title']="Daftar Email Auto";
        $data['message']='';
			$data['main_content'] = 'email/daftar';
			$this->load->view('lte/mail', $data);
	}
	
	public function belum() {
		$data['title']="Belum Diproses";
        $data['message']='';
			$data['main_content'] = 'email/belum';
			$this->load->view('lte/mail', $data);
	}
	
	public function sudah() {
		$data['title']="Sudah Diproses";
        $data['message']='';
			$data['main_content'] = 'email/sudah';
			$this->load->view('lte/mail', $data);
	}
	
	public function auto() {
		$this->load->helper('form');
		$data['title']="Kirim Email Auto";
        $data['no']=$this->app_model->AutoEmail()+1;
        $data['message']='';
			$data['main_content'] = 'email/auto';
			$this->load->view('lte/mail', $data);
	}
	
	public function monitor() {
		$this->load->helper('form');
		$data['title']="Monitor Email Auto";
        $data['no']=$this->app_model->AutoEmail()+1;
        $data['message']='';
		$this->template->forms('email/monitor',$data);
	}
	
	public function kirimauto() {
		$this->load->helper('form');
        $data['no']=$this->app_model->AutoEmail()+1;
        $no=$this->app_model->AutoEmail()+1;
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
		$data['title']="Email";
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->library('email');
		
		$this->db->where('email',$this->app_model->EmailKirim($no));
		$this->db->where('status','1');
		$cek=$this->db->get('emailauto');

		if($cek->num_rows()>1){
			$email=array(
				'status'=>'2',
				'cek'=>'1'
			);
			$this->db->where('id',$no);
			$this->db->update('emailauto',$email);
			$this->load->view('email/mulaix',$data);
		}else{

		//konfigurasi email
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
		$config['protocol']= $this->app_model->Protocol();
		$config['mailtype']= "html";
		$config['smtp_host']= $this->app_model->Host();
		$config['smtp_port']= $this->app_model->Port();
		$config['smtp_timeout']= "15";
		$config['smtp_user']= $this->app_model->Email(); //isi dengan email kamu
		$config['smtp_pass']= $this->app_model->Password(); // isi dengan password kamu
		$config['crlf']="\r\n";
		$config['newline']="\r\n";
		
		$config['wordwrap'] = TRUE;
		//memanggil library email dan set konfigurasi untuk pengiriman email
		
		$this->email->initialize($config);
		//konfigurasi pengiriman
		$this->email->from($this->app_model->Email());
		$this->email->to($this->input->post('to'));
		$this->email->subject($this->input->post('subject'));
		$this->email->message($this->input->post('isi'));

		//Status Kirim
		if($this->email->send()){
            $data['message']="<div class='alert alert-success'>Berhasil mengirim email</div>";
			$status='1';
		}else{
			$data['message']="<div class='alert alert-success'>Gagal mengirim email</div>";
			$status='0';
		}
			$info=array(
				'tgl'=>$tgl,
				'dari'=>$this->app_model->Email(),
				'kepada'=>$this->input->post('to'),
				'judul'=>$this->input->post('subject'),
				'pesan'=>$this->input->post('isi'),
				'cek'=>$status
			);
			$email=array(
				'status'=>$status,
				'cek'=>'1'
			);
        $this->db->where('id',$no);
        $this->db->update('emailauto',$email);
		$this->db->insert('email',$info);
			$data['main_content'] = 'email/mulai';
			$this->load->view('lte/mail', $data);
        return $this->db->insert_id();
		}
	}
	
	public function mulai() {
		$this->load->helper('form');
        $data['no']=$this->app_model->AutoEmail()+1;
        $data['noid']=$this->app_model->IdEmail();
        $no=$this->app_model->AutoEmail()+1;
        $noid=$this->app_model->IdEmail();
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
		$data['title']="Kirim Email Auto";
        if($no-1==$this->app_model->IdEmailAuto()){ redirect('email/auto'); }

		$this->db->where('email',$this->app_model->EmailKirim($no));
		$this->db->where('status','1');
		$cek=$this->db->get('emailauto');

		if($cek->num_rows()>1){
			$email=array(
				'status'=>'2',
				'cek'=>'1'
			);
			$this->db->where('id',$no);
			$this->db->update('emailauto',$email);
			$this->load->view('email/mulaix',$data);
		}else{

		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->library('email');
		
		//konfigurasi email
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
		$config['protocol']= $this->app_model->Protocol();
		$config['mailtype']= "html";
		$config['smtp_host']= $this->app_model->Host();
		$config['smtp_port']= $this->app_model->Port();
		$config['smtp_timeout']= "15";
		$config['smtp_user']= $this->app_model->Email(); //isi dengan email kamu
		$config['smtp_pass']= $this->app_model->Password(); // isi dengan password kamu
		$config['crlf']="\r\n";
		$config['newline']="\r\n";
		
		$config['wordwrap'] = TRUE;
		//memanggil library email dan set konfigurasi untuk pengiriman email
		
		$this->email->initialize($config);
		//konfigurasi pengiriman
		$this->email->from($this->app_model->Email());
		$this->email->to($this->app_model->EmailKirim($no));
		$this->email->subject($this->app_model->JudulEmail($noid));
		$this->email->message($this->app_model->PesanEmail($noid));

		 //Status Kirim
		if($this->email->send()){
            $data['message']="<b>Berhasil mengirim email</b>";
			$status='1';
			$this->load->view('email/mulai',$data);
		}else{
			$data['message']="<b>Gagal mengirim email</b>";
			$status='0';
			$this->load->view('email/mulaix',$data);
		}
			$info=array(
				'tgl'=>$tgl,
				'dari'=>$this->app_model->Email(),
				'kepada'=>$this->app_model->EmailKirim($no),
				'judul'=>$this->app_model->JudulEmail($noid),
				'pesan'=>$this->app_model->PesanEmail($noid),
				'cek'=>$status
			);
			$email=array(
				'status'=>$status,
				'cek'=>'1'
			);
        $this->db->where('id',$no);
        $this->db->update('emailauto',$email);
		$this->db->insert('email',$info);
        return $this->db->insert_id();
		}
	}

	public function ulang() {
		$this->load->helper('form');
        $data['no']=$this->app_model->UlangEmail()+1;
        $data['noid']=$this->app_model->IdEmail();
        $no=$this->app_model->UlangEmail()+1;
        $noid=$this->app_model->IdEmail();
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
		$data['title']="Ulang Email Auto";
        if($no-1==$this->app_model->IdEmailAuto()){ redirect('email/auto'); }
		if($this->app_model->StatusAuto($no)=='1'){
			$email=array(
				'ulang'=>'1'
			);
			$this->db->where('id',$no);
			$this->db->update('emailauto',$email);
			$this->load->view('email/ulangs',$data);
		}else{
			
			$this->db->where('email',$this->app_model->EmailKirim($no));
			$this->db->where('status','1');
			$cek=$this->db->get('emailauto');

			if($cek->num_rows()>0){
				$email=array(
					'status'=>'2',
					'ulang'=>'1'
				);
				$this->db->where('id',$no);
				$this->db->update('emailauto',$email);
				$this->load->view('email/ulangs',$data);
			}else{
			$this->load->helper(array('form', 'url'));
			$this->load->library('upload');
			$this->load->library('email');
			
		//konfigurasi email
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
		$config['protocol']= $this->app_model->Protocol();
		$config['mailtype']= "html";
		$config['smtp_host']= $this->app_model->Host();
		$config['smtp_port']= $this->app_model->Port();
		$config['smtp_timeout']= "15";
		$config['smtp_user']= $this->app_model->Email(); //isi dengan email kamu
		$config['smtp_pass']= $this->app_model->Password(); // isi dengan password kamu
		$config['crlf']="\r\n";
		$config['newline']="\r\n";
			
			$config['wordwrap'] = TRUE;
			//memanggil library email dan set konfigurasi untuk pengiriman email
			
			$this->email->initialize($config);
			//konfigurasi pengiriman
			$this->email->from($this->app_model->Email());
			$this->email->to($this->app_model->EmailKirim($no));
			$this->email->subject($this->app_model->JudulEmail($noid));
			$this->email->message($this->app_model->PesanEmail($noid));

			 //Status Kirim
			if($this->email->send()){
				$data['message']="<b>Berhasil mengirim email</b>";
				$status='1';
				$this->load->view('email/ulang',$data);
			}else{
				$data['message']="<b>Gagal mengirim email</b>";
				$status='0';
				$this->load->view('email/ulangx',$data);
			}
				$info=array(
					'tgl'=>$tgl,
					'dari'=>$this->app_model->Email(),
					'kepada'=>$this->app_model->EmailKirim($no),
					'judul'=>$this->app_model->JudulEmail($noid),
					'pesan'=>$this->app_model->PesanEmail($noid),
					'cek'=>$status
				);
				$email=array(
					'status'=>$status,
					'ulang'=>'1'
				);
			$this->db->where('id',$no);
			$this->db->update('emailauto',$email);
			$this->db->insert('email',$info);
			return $this->db->insert_id();
			}
		}
	}
	
}