<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class So extends CI_Controller {

	/**
	 * @author : M David
	 * @web : http://muhammaddavid.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    function __construct(){
        parent::__construct();
        $this->load->library(array('auth','template','form_validation','pagination','upload'));
		$this->auth->check_user_authentification();
		$this->load->helper('finance');
		$this->load->library('fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		if($this->session->userdata('ADMIN')=='3'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('home');} 
		if($this->session->userdata('ADMIN')=='4'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('home');} 
		if($this->session->userdata('ADMIN')=='5'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('home');} 
		if($this->session->userdata('ADMIN')=='6'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('home');} 
	}
    
	function index()	{
		$data['title']="Salas Order";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc');
		$so = $this->db->get_where('po',array('cek'=>'0','status'=>'2'));
		$data['info'] = $so->result();
		$data['main_content'] = 'so/index';
		$this->load->view('lte/live', $data);
	}
	
    function view($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('so');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('so');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$data['title']="Salas Order";
        $cek=$this->db->get_where('po',array('id'=>$id));
		$data['info']=$cek->row_array();
		$data['main_content'] = 'so/view';
		$this->load->view('lte/live', $data);
    }
                        
	function list_po()	{
		$data['title']="PO Masuk";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc');
		$so = $this->db->get_where('po',array('cek'=>'0','status'=>'0'));
		$data['info'] = $so->result();
		$data['main_content'] = 'so/list_po';
		$this->load->view('lte/live', $data);
	}
	
    function view_po($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('so/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('so/list_po');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
        $data['title']="PO Masuk";
        $cek=$this->db->get_where('po',array('id'=>$id));
		$data['info']=$cek->row_array();
		$data['main_content'] = 'so/view_po';
		$this->load->view('lte/live', $data);
    }
                        
    function pdf($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('so');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('so');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
        $data['title']="SALES ORDER";
        $cek=$this->db->get_where('po',array('id'=>$id));
		$data['info']=$cek->row_array();
			$this->load->view('so/pdf',$data);
    }
                        
    function pdf_po($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('so/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('so/list_po');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
        $data['title']="Salas Order";
        $cek=$this->db->get_where('po',array('id'=>$id));
		$data['info']=$cek->row_array();
			$this->load->view('so/pdf_po',$data);
    }
                        
    function hapus_po(){
        $kode=$this->uri->segment(3);
        if(!$kode){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu PO Masuk.'); redirect('so');}
		if($this->bbm_model->check_po($kode)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('so');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('so');}
		$data=array('cek'=>'1','login_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode);
		$this->db->update('po',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."so/list_po'>";			
    }
    
    function acc(){
        $kode=$this->uri->segment(3);
        if(!$kode){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu PO Masuk.'); redirect('so');}
		if($this->bbm_model->check_po($kode)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('so');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('so');}
		$data=array('status'=>'2','admin_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode);
		$this->db->update('po',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."so'>";			
    }
    
    function add($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu PO Masuk.'); redirect('so/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('so/list_po');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
        $data['title']="Sales Order";
        $data['tgl']=date('Y-m-d');
		$tgl=date('Ymd');
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID'));
        $data['no']=$this->db->count_all_results('po')+1;
		$data['message']=""; $cek=$this->db->get_where('po',array('id'=>$id)); $data['info']=$cek->row_array();
		$data['main_content'] = 'so/add';
		$this->load->view('lte/live', $data);
    }
    
    function simpan(){
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		if(!$this->pajak_model->Emailso($this->session->userdata('SESS_WP_ID'))==''){ $status='1'; $admin_id='0'; }else{ $status='2'; $admin_id=$this->session->userdata('SESS_USER_ID');}
		$tgl=date('Ymd');
		$id = $this->input->post('id');
		$jml = $this->input->post('jml');
		$h1 = $this->input->post('harga'); $h2 = $this->input->post('harga'); //h2 = Harga Include
		$discount = $this->input->post('discount'); $ndiscount = $this->input->post('ndiscount');
		$ohp = $this->input->post('ohp'); if($ohp=='0'){ $nohp = '0'; }else{ $nohp = $this->input->post('ppnohp'); } $ppnohp = $nohp;
		$ppn = $this->input->post('ppn'); $pbbkb = $this->input->post('pbbkb'); $npbbkb = $this->input->post('npbbkb'); $pph = $this->input->post('pph');
		$harga = $h1; $tot1 = $jml*$harga;  
		$tot3 = $tot1; $tot4 = $tot3/10*$ppn; $tot5 = $tot3*($npbbkb/100)*$pbbkb; $tot6 = $tot3*3/1000*$pph; $tot7 = $jml*$ohp;
		$tot8 = $tot7*$ppnohp/10; $tt78	= $tot7+$tot8; $tot9 = $tot3+$tot4+$tot5+$tot6+$tt78;
		$info=array( 
			'status'=>$status, 'admin_id'=>$admin_id, 'tglso'=>$tgl, 'b_harga'=>$this->input->post('b_harga'), 
			'b_ppn'=>$this->input->post('b_ppn'), 'b_pph'=>$this->input->post('b_pph'), 
			'b_npbbkb'=>$this->input->post('b_npbbkb'), 'b_pbbkb'=>$this->input->post('b_pbbkb'),
			'ib_ppn'=>$this->input->post('ib_ppn'), 'ib_pph'=>$this->input->post('ib_pph'), 
			'ib_npbbkb'=>$this->input->post('ib_npbbkb'), 'ib_pbbkb'=>$this->input->post('ib_pbbkb'),
			'oat_b1'=>$this->input->post('oat_b1'), 'oat_b2'=>$this->input->post('oat_b2'), 
			'oat_j1'=>$this->input->post('oat_j1'), 'oat_j2'=>$this->input->post('oat_j2'), 
			'top'=>$this->input->post('top'), 'fee'=>$this->input->post('fee'), 'oat'=>$this->input->post('oat'), 
			'cof'=>$this->input->post('cof'), 'migas'=>$this->input->post('migas'), 'pph21'=>$this->input->post('pph21'), 
			'hdp'=>$this->input->post('hdp'), 'discount'=>$this->input->post('discount'), 
			'savlb'=>$this->input->post('savlb'), 'margin'=>$this->input->post('margin'), 
			'tglkirim'=>$this->input->post('tglkirim'), 'kirim'=>$this->input->post('kirim'),
			'keterangan'=>$this->input->post('keterangan'), 'cso_id'=> $this->session->userdata('SESS_USER_ID') );
		$this->db->where('id',$id); $this->db->update('po',$info);
		redirect('so/view/'.$id);
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}