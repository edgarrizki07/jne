<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memo extends CI_Controller {

	/**
	 * @author : M David
	 * @web : http://muhammaddavid.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
		$this->load->helper('finance');
		$this->load->library('fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
	}
    
	function index()	{
        $data['title']="Terimakasih Telah Mengunjungi Web Ini";
		$this->load->view('lihat/index', $data);	}
	
// Memo PO
    function beli($id){
		// if(!$this->user_model->check_login_IP()) { } else { redirect('login/index/beli/memo/'.$id); }
        $login=$this->uri->segment(4); if(!$login){ redirect('memo');}
		if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Pembelian.'); redirect('memo');}
		if($this->bbm_model->check_beli($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('memo');}
		$data['title']="Memo Pembelian BBM";
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');  $data['tgl']=date('Y-m-d'); 
        $this->_set_rules(); if($this->form_validation->run()==true){
		// Notifikasi ACC
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s'); 
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$IDBeli=$this->bbm_model->IDBeli($id);
			$edit= anchor(site_url()."beli/rounding/".$id, ' EDIT ', $btn); $subject= 'Memo Perbaikan untuk PO Nomor '.$IDBeli;
			$message= $this->setting_model->Header_mail()."Dari : ".$login."<br><div class='row invoice-info text-center'><br><br><b>Berikut ini memo perbaikan yang dibuat :<b><br>".$this->input->post('pesan')."<br><br><b>Untuk Perbaikan silahkan klik dibawah ini :</b><br>".$edit."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System
		if($this->pajak_model->Accpo($this->bbm_model->WPBeli($id))=='0'){ }else{ 
			$info=array('id'=>'id','tgl'=>$tgl,'kepada'=>$this->bbm_model->LoginBeli($id),'judul'=>$subject,'pesan'=>$message,'dari'=>$login);
			$this->m_pesan->simpan($info);
		}
		// Email
		if($this->pajak_model->Emailpo($this->bbm_model->WPBeli($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->app_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginBeli($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Memo untuk perbaikan PO telah dikirim'); redirect('memo');
        }else{
			$cek=$this->db->get_where('beli',array('id'=>$id)); $data['info']=$cek->row_array(); $data['main_content'] = 'beli/memo'; $this->load->view('lte/mail', $data);
        }
    }
    
// MEMO DO
    function memo_do($id){
		// if(!$this->user_model->check_login_IP()) { } else { redirect('login/index/jual/memo_do/'.$id); }
        $login=$this->uri->segment(4); if(!$login){ redirect('memo');}
		if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('memo');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('memo');}
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
		$Id_JualDO=$this->bbm_model->Id_JualDO($id); $NoDO=$this->bbm_model->NoDO($id);
        $data['title']="Memo DO Penjualan BBM"; $data['tgl']=date('Y-m-d');
        $this->_set_rules(); if($this->form_validation->run()==true){
		// Notifikasi Memo
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;'; 
			$edit= anchor(site_url()."jual/edit_do/".$id, ' EDIT ', $btn); 
			$subject= 'Memo Perbaikan untuk DO Nomor '.$Id_JualDO.'-'.$NoDO;
			$message= $this->setting_model->Header_mail()."Dari : ".$login."<br><div class='row invoice-info text-center'><br><br><b>Berikut ini memo perbaikan yang dibuat :<b><br>".$this->input->post('pesan')."<br><br><b>Untuk Perbaikan silahkan klik dibawah ini :</b><br>".$edit."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System
		if($this->pajak_model->Accdo($this->bbm_model->WPDO($id))=='0'){ }else{ 
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginDO($id), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$login );
			$this->m_pesan->simpan($info);
		}		
		// email
		if($this->pajak_model->Emaildo($this->bbm_model->WPDO($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->app_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginDO($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Memo untuk perbaikan LI DO dan BAST telah dikirim'); redirect('memo');
        }else{
			$cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array(); $data['main_content'] = 'jual/memo_do'; $this->load->view('lte/mail', $data);
        }
    }
    
// Memo Invoice
    function jual($id){
		// if(!$this->user_model->check_login_IP()) { } else { redirect('login/index/jual/memo/'.$id); }
        $login=$this->uri->segment(4); if(!$login){ redirect('memo');}
		if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('memo');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('memo');}
		date_default_timezone_set("Asia/Jakarta");
        $data['title']="Memo Penjualan BBM"; $data['tgl']=date('Y-m-d'); $tgl=date('Y-m-d H:i:s'); $IDJual=$this->bbm_model->IDJual($id);
        $this->_set_rules(); if($this->form_validation->run()==true){
		// Notifikasi Memo
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$edit= anchor(site_url()."jual/edit_jual/".$id, ' EDIT ', $btn); $subject= 'Memo Perbaikan untuk Invoice Nomor '.$IDJual;
			$message= $this->setting_model->Header_mail()."Dari : ".$login."<br><div class='row invoice-info text-center'><br><br><b>Berikut ini memo perbaikan yang dibuat :<b><br>".$this->input->post('pesan')."<br><br><b>Untuk Perbaikan silahkan klik dibawah ini :</b><br>".$edit."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System
		if($this->pajak_model->Accinv($this->bbm_model->WPJual($id))=='0'){ }else{ 
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginJual($id), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$login );
			$this->m_pesan->simpan($info);
		}
		// Email
		if($this->pajak_model->Emailinv($this->bbm_model->WPJual($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->app_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginJual($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Memo untuk perbaikan Invoice telah dikirim'); redirect('memo');
        }else{
			$cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array(); $data['main_content'] = 'jual/memo'; $this->load->view('lte/mail', $data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}