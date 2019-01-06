<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lihat extends CI_Controller {

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
		if(!$this->user_model->check_login_IP()) { $data['title']="Terimakasih Telah Mengunjungi Lagi Web Ini";
		} else { $data['title']="Terimakasih Telah Mengunjungi Web Ini"; }
		$this->load->view('lihat/index', $data);
	}
	                       
    function beli($id){
		// if(!$this->user_model->check_login_IP()) { } else { redirect('login/index/lihat/beli/'.$id); }
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu ID.'); redirect('lihat');}
		if($this->bbm_model->check_beli($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('lihat');}
        $data['title']="Pembelian BBM";
        $cek=$this->db->get_where('beli',array('id'=>$id));
		$data['info']=$cek->row_array();
		$this->load->view('lihat/beli', $data);
    }
                            
    function jual($id){
		// if(!$this->user_model->check_login_IP()) { } else { redirect('login/index/lihat/jual/'.$id); }
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu ID.'); redirect('lihat');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('lihat');}
        $data['title']="Penjualan BBM";
        $cek=$this->db->get_where('jual',array('id'=>$id));
		$data['info']=$cek->row_array();
		$this->load->view('lihat/jual', $data);
    }
                            
    function bayar($id){
		// if(!$this->user_model->check_login_IP()) { } else { redirect('login/index/lihat/bayar/'.$id); }
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu ID.'); redirect('lihat');}
		if($this->bbm_model->check_jual_bayar($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('lihat');}
        $data['title']="Penjualan BBM";
        $cek=$this->db->get_where('jual',array('id'=>$id));
		$data['info']=$cek->row_array();
		$this->load->view('lihat/bayar', $data);
    }
                            
    function lidobast($id){
		// if(!$this->user_model->check_login_IP()) { } else { redirect('login/index/lihat/lidobast/'.$id); }
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu ID.'); redirect('lihat');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('lihat');}
        $data['title']="li do bast";
        $cek=$this->db->get_where('do',array('id'=>$id));
		$data['info']=$cek->row_array();
		$this->load->view('lihat/lidobast', $data);
    }
                            
}