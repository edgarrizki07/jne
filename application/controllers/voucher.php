<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher extends CI_Controller {

	function Voucher()
	{
		parent::__construct();
        $this->load->library(array('auth','template','form_validation','pagination','upload'));
		$this->auth->check_user_authentification();
		$this->load->helper('indodate');
		$this->load->helper('finance');
		$this->load->library('fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $this->load->library(array('template','form_validation','pagination','upload'));
		if($this->session->userdata('ADMIN')>'3'){$this->session->set_userdata('SUCCESSMSG', 'Maaf anda tidak memiliki akses.'); redirect('home'); }
		
	}
    
	public function index()	{
        $data['title']="Voucher";
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$this->session->set_userdata('SUCCESSMSG', 'untuk tambah voucher ini hubungi programer aja ya.');
			redirect('voucher');
        }else{
			$data['main_content'] = 'voucher/index';
			$this->load->view('lte/live', $data);
        }
    }
    
	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$this->db->where(array("id"=>$id));
		$this->db->update("voucher",array($modul=>$value));
		echo "{}";
	}

    public function edit(){
        $data['title']="Voucher";
		$id=$this->uri->segment(3);
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'proyek'=>$this->input->post('proyek'),
				'kode'=>$this->input->post('kode'),
				'jenis'=>$this->input->post('jenis'),
				'nama'=>$this->input->post('nama'),
				'pay'=>$this->input->post('pay'),
				'due'=>$this->input->post('due')
			);
			$this->db->where('id',$id);
			$this->db->update('voucher',$info);
			$this->session->set_userdata('SUCCESSMSG', 'Edit Success.');
			redirect('voucher');
        }else{
			$data['main_content'] = 'voucher/index';
			$this->load->view('lte/live', $data);
        }
    }
        
	public function lihat($id)	{
        if(!$id){redirect('voucher');}
		$data['title']="Detail Voucher";
			$this->db->where('id',$id);
			$cek=$this->db->get('voucher');
		$data['info']=$cek->row_array();
            if($cek->num_rows()>0){
				$data['main_content'] = 'voucher/detail';
				$this->load->view('lte/live', $data);
            }else{
                redirect('voucher');
            }
	}

	function jurnal()
	{
		$this->load->helper('indodate');
		$id = $this->uri->segment(3);
		$cab = $this->uri->segment(4);
		$from = $this->uri->segment(5);
		$to = $this->uri->segment(6);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('voucher/jurnal/'.$id);}
		$data['title'] = "Voucher Jurnal";
		  if($this->uri->segment(5)==''){
			$this->jurnal_model->set_voucher_id($id);
			$month = date("m");
			$year = date("Y");
			$this->jurnal_model->set_month_year($month, $year);
		  }else{
			$this->jurnal_model->set_voucher_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($cab=='0'){  }else{ $this->jurnal_model->set_wp_id($cab); }	
		if($this->session->userdata('ADMIN')=='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$data['main_content'] = 'voucher/display';
		$this->load->view('lte/tabel_proyek', $data);
	}

	function jurnal_pdf()
	{
		$this->load->helper('indodate');
		// $data['wajib_pajak_data'] = $this->pajak_model->get_data();
		$id = $this->uri->segment(3);
		$cab = $this->uri->segment(4);
		$from = $this->uri->segment(5);
		$to = $this->uri->segment(6);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('voucher/jurnal/'.$id);}
		$data['title'] = "Voucher Jurnal";
		  if($this->uri->segment(5)==''){
			$this->jurnal_model->set_voucher_id($id);
			$month = date("m");
			$year = date("Y");
			$this->jurnal_model->set_month_year($month, $year);
		  }else{
			$this->jurnal_model->set_voucher_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($cab=='0'){  }else{ $this->jurnal_model->set_wp_id($cab); }	
		if($this->session->userdata('ADMIN')=='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
			$this->load->view('voucher/report', $data);
	}
		
	function jurnal_excel()
	{
		$this->load->helper('indodate');
		// $data['wajib_pajak_data'] = $this->pajak_model->get_data();
		$id = $this->uri->segment(3);
		$cab = $this->uri->segment(4);
		$from = $this->uri->segment(5);
		$to = $this->uri->segment(6);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('voucher/jurnal/'.$id);}
		$data['title'] = "Voucher Jurnal";
		$data['uri3'] = $id;
		$data['uri5'] = $from;
		$data['uri6'] = $to;
		  if($this->uri->segment(5)==''){
			$this->jurnal_model->set_voucher_id($id);
			$month = date("m");
			$year = date("Y");
			$this->jurnal_model->set_month_year($month, $year);
		  }else{
			$this->jurnal_model->set_voucher_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($cab=='0'){  }else{ $this->jurnal_model->set_wp_id($cab); }	
		if($this->session->userdata('ADMIN')=='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
			$this->load->view('voucher/excel', $data);
	}
		
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}