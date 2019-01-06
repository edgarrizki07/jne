<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {

	function Kategori()
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
        $data['title']="Kategori";
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'id'=>$this->input->post('id'),
				'kode'=>$this->input->post('kode'),
				'nama'=>$this->input->post('nama'),
				'kategori_id'=>$this->input->post('kategori_id'),
				'aging'=>$this->input->post('aging'),
				'aging_id'=>$this->input->post('aging_id')
			);
			$this->db->insert('akun_jenis',$info);
			redirect('kategori');
        }else{
			$data['main_content'] = 'kategori/index';
			$this->load->view('lte/live', $data);
        }
    }
    
    public function edit(){
        $data['title']="Kategori";
		$id=$this->uri->segment(3);
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'nama'=>$this->input->post('nama'),
				'kode'=>$this->input->post('kode'),
				'kategori_id'=>$this->input->post('kategori_id'),
				'aging'=>$this->input->post('aging'),
				'aging_id'=>$this->input->post('aging_id')
			);
			$this->db->where('id',$id);
			$this->db->update('akun_jenis',$info);
			$this->session->set_userdata('SUCCESSMSG', 'Edit Success.');
			redirect('kategori');
        }else{
			$data['main_content'] = 'kategori/index';
			$this->load->view('lte/live', $data);
        }
    }
        
	public function subkategori()	{
        $data['title']="Kategori";
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'id'=>$this->input->post('id'),
				'nama'=>$this->input->post('nama'),
				'kode'=>$this->input->post('kode'),
				'kelompok_akun_id'=>$this->input->post('kelompok_akun_id')
			);
			$this->db->insert('akun_standar',$info);
			redirect('kategori/kategori');
        }else{
			$data['main_content'] = 'kategori/kategori';
			$this->load->view('lte/live', $data);
        }
    }
    
	public function editsubkategori()	{
        $data['title']="Kategori";
		$id=$this->uri->segment(3);
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'nama'=>$this->input->post('nama'),
				'kode'=>$this->input->post('kode'),
				'kelompok_akun_id'=>$this->input->post('kelompok_akun_id')
			);
			$this->db->where('id',$id);
			$this->db->update('akun_standar',$info);
			$this->session->set_userdata('SUCCESSMSG', 'Edit Success.');
			redirect('kategori/kategori');
        }else{
			$data['main_content'] = 'kategori/kategori';
			$this->load->view('lte/live', $data);
        }
    }
    
	public function standart()	{
		if($this->session->userdata('ADMIN')>'1'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('kategori');}  	
        $data['title']="Akun Standart";
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'id'=>$this->input->post('id'),
				'nama'=>$this->input->post('nama'),
				'kode'=>$this->input->post('kode'),
				'jenis_akun_id'=>$this->input->post('jenis_akun_id')
			);
			$this->db->insert('akun_standar',$info);
			redirect('kategori/standart');
        }else{
			$data['main_content'] = 'kategori/standart';
			$this->load->view('lte/live', $data);
        }
    }
    
	public function editstandart()	{
		if($this->session->userdata('ADMIN')>'1'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('kategori');} 	
        $data['title']="Akun Standart";
		$id=$this->uri->segment(3);
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'nama'=>$this->input->post('nama'),
				'kode'=>$this->input->post('kode'),
				'jenis_akun_id'=>$this->input->post('jenis_akun_id')
			);
			$this->db->where('id',$id);
			$this->db->update('akun_standar',$info);
			$this->session->set_userdata('SUCCESSMSG', 'Edit Success.');
			redirect('kategori/standart');
        }else{
			$data['main_content'] = 'kategori/standart';
			$this->load->view('lte/live', $data);
        }
    }
    
    function hapusstandart(){
		if($this->session->userdata('ADMIN')>'1'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('kategori');} 	
        $kode=$this->uri->segment(3);
		$data=array('cek'=>'1','login_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode);
		$this->db->update('akun_standar',$data);
		echo "<meta http-equiv='refresh' content='0; url=".site_url('kategori/standart')."'>";			
    }
    
	public function lihat($id)	{
        if(!$id){redirect('kategori');}
		$data['title']="Detail Kategori";
			$this->db->where('id',$id);
			$cek=$this->db->get('akun_jenis');
		$data['info']=$cek->row_array();
            if($cek->num_rows()>0){
				$data['main_content'] = 'kategori/detail';
				$this->load->view('lte/live', $data);
            }else{
                redirect('kategori');
            }
	}

	function akun()
	{
		$this->load->helper('indodate');
		$id = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('kategori/akun/'.$id);}
		$data['title'] = "Kategori Akun";
		  if($this->uri->segment(4)==''){
			$this->jurnal_model->set_kategori_id($id);
			$month = date("m");
			$year = date("Y");
			$this->jurnal_model->set_month_year($month, $year);
		  }else{
			$this->jurnal_model->set_kategori_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($this->session->userdata('ADMIN')=='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$data['main_content'] = 'kategori/display';
		$this->load->view('lte/tabel_proyek', $data);
	}

	function akun_pdf()
	{
		$this->load->helper('indodate');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data();
		$id = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('kategori/akun/'.$id);}
		$data['title'] = "kategori Jurnal";
		  if($this->uri->segment(4)==''){
			$this->jurnal_model->set_kategori_id($id);
			$month = date("m");
			$year = date("Y");
			$this->jurnal_model->set_month_year($month, $year);
		  }else{
			$this->jurnal_model->set_kategori_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($this->session->userdata('ADMIN')=='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
			$this->load->view('kategori/report', $data);
	}
		
	function akun_excel()
	{
		$this->load->helper('indodate');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data();
		$id = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('kategori/akun/'.$id);}
		$data['title'] = "kategori Jurnal";
		$data['uri3'] = $id;
		$data['uri4'] = $from;
		$data['uri5'] = $to;
		  if($this->uri->segment(4)==''){
			$this->jurnal_model->set_kategori_id($id);
			$month = date("m");
			$year = date("Y");
			$this->jurnal_model->set_month_year($month, $year);
		  }else{
			$this->jurnal_model->set_kategori_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($this->session->userdata('ADMIN')=='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
			$this->load->view('kategori/excel', $data);
	}
		
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}