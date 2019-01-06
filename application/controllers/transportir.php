<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transportir extends CI_Controller {

	/**
	 * @author : M David
	 * @web : http://muhammaddavid.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    function __construct(){
        parent::__construct();
        $this->load->library(array('auth','template','pagination','form_validation','upload','email'));
		$this->auth->check_user_authentification();
	}
    
	public function index()	{
		$data['title']="Transportir";
		$data['main_content'] = 'transportir/index';
		$this->load->view('lte/live', $data);
	}
	
	function all_datas() { 
		if($this->session->userdata("ADMIN")>="2"){ $this->db->where("wp_id", $this->session->userdata("SESS_WP_ID")); }
		$this->db->order_by("id","desc"); 
		$query=$this->db->get_where('transportir',array('cek'=>'0')); 
		return $query->result(); 
	}
	
    function tambah(){
        $data['title']="Transportir";
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'id'=>$this->input->post('id'),
				'kode'=>$this->input->post('kode'),
				'nama'=>$this->input->post('nama'),
				'alamat'=>$this->input->post('alamat'),
				'wp_id'=>$this->session->userdata('SESS_WP_ID'),
				'login_id'=>$this->session->userdata('SESS_USER_ID')
			);
			$this->db->insert('transportir',$info);
			redirect('transportir');
        }else{
            $data['message']="";
			$data['main_content'] = 'transportir/tambah';
			$this->load->view('lte/live', $data);
        }
    }
    
    function hapus(){
        $id=$this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('transportir');}
		if($this->bbm_model->check_transportir($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('transportir');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		if($this->session->userdata('ADMIN')>='3'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('transportir');}
		$info=array( 'cek'=>'1' ); $this->db->where('id',$id); $this->db->update('transportir',$info); redirect('transportir');
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}