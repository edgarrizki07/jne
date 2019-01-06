<?php

class Laporan_bphmigas extends CI_Controller {

	function Laporan_bphmigas()
	{
		parent::__construct();	
		$this->load->helper('indodate');
		$this->load->helper('finance');
		$this->load->library('auth');
		$this->auth->check_user_authentification();
		$this->load->library('fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		if($this->session->userdata('ADMIN')>'3'){$this->session->set_userdata('SUCCESSMSG', 'Maaf anda tidak memiliki akses.'); redirect('home'); }
	}
	
	function index()
	{
		$this->load->helper('indodate');
		$id = $this->uri->segment(3);
		$cab = $this->uri->segment(4);
		$from = $this->uri->segment(5);
		$now = $now = date("Y-m-d");
        if($from > $now){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_bphmigas');}
		$data['title'] = "Aging Report";
		$this->jurnal_model->set_aging('1');
		$this->jurnal_model->set_due('1');
		$this->jurnal_model->set_other_group_id();
		$this->jurnal_model->set_supplier_group_id();
		$this->jurnal_model->set_customer_group_id();
		  if($this->uri->segment(3)==''){
		  }else{
			$this->jurnal_model->set_aging_id($id);
			$this->jurnal_model->set_tempo($from);
		  }
		if($cab=='0'){}else{$this->jurnal_model->set_wp_id($cab);   }	
		if($this->session->userdata('ADMIN')>='2'){$this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$data['main_content'] = 'laporan_bphmigas/form';
		$this->load->view('lte/tabel_proyek', $data);
	}
	
	function pdf_migas()
	{
		$this->load->helper('indodate');
		$id = $this->uri->segment(3);
		$cab = $this->uri->segment(4);
		$from = $this->uri->segment(5);
		$now = $now = date("Y-m-d");
        if($from > $now){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_bphmigas');}
		$data['title'] = "Laporan Migas";
		$ida=$this->session->userdata('SESS_WP_ID');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data($ida);	
		$this->jurnal_model->set_aging('1');
		// $this->jurnal_model->set_due('1');
		// $this->jurnal_model->set_other_group_id();
		$this->jurnal_model->set_supplier_group_id();
		$this->jurnal_model->set_customer_group_id();
		  if($this->uri->segment(3)==''){
		  }else{
			$this->jurnal_model->set_aging_id($id);
			$this->jurnal_model->set_tempo($from);
		  }
		if($cab=='0'){}else{$this->jurnal_model->set_wp_id($cab);   }	
		if($this->session->userdata('ADMIN')>='2'){$this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
			$this->load->view('laporan_bphmigas/pdf_migas', $data);
	}
		
	function filter_pdf()
	{
		$this->load->helper('indodate');
		$id = $this->uri->segment(3);
		$cab = $this->uri->segment(4);
		$from = $this->uri->segment(5);
		$now = $now = date("Y-m-d");
        if($from > $now){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_bphmigas');}
		$data['title'] = "Aging Report";
		$ida=$this->session->userdata('SESS_WP_ID');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data($ida);	
		// $this->jurnal_model->set_aging('1');
		// $this->jurnal_model->set_due('1');
		// $this->jurnal_model->set_other_group_id();
		// $this->jurnal_model->set_supplier_group_id();
		// $this->jurnal_model->set_customer_group_id();
		  // if($this->uri->segment(3)==''){
		  // }else{
			// $this->jurnal_model->set_aging_id($id);
			// $this->jurnal_model->set_tempo($from);
		  // }
		// if($id=='1'){$this->jurnal_model->set_customer_id($cab); }else{$this->jurnal_model->set_supplier_id($cab);   }	
		// if($this->session->userdata('ADMIN')>='2'){$this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		// $data['journal_data'] = $this->jurnal_model->get_data();
			$this->load->view('laporan_bphmigas/filter_pdf', $data);
	}
		
	function excel()
	{
		$this->load->helper('indodate');
		$id = $this->uri->segment(3);
		$cab = $this->uri->segment(4);
		$from = $this->uri->segment(5);
		$now = $now = date("Y-m-d");
        if($from > $now){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_bphmigas');}
		$data['title'] = "Aging Report";
		$data['uri3'] = $id;
		$data['uri5'] = $from;
		$this->jurnal_model->set_aging('1');
		$this->jurnal_model->set_due('1');
		$this->jurnal_model->set_other_group_id();
		$this->jurnal_model->set_supplier_group_id();
		$this->jurnal_model->set_customer_group_id();
		  if($this->uri->segment(3)==''){
		  }else{
			$this->jurnal_model->set_aging_id($id);
			$this->jurnal_model->set_tempo($from);
		  }
		if($cab=='0'){}else{$this->jurnal_model->set_wp_id($cab);   }	
		if($this->session->userdata('ADMIN')>='2'){$this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$data['main_content'] = 'laporan_bphmigas/form';
			$this->load->view('laporan_bphmigas/excel', $data);
	}
		
}
/* End of file laporan_bphmigas.php */
/* Location: ./application/controllers/laporan_bphmigas.php */
