<?php

class Laporan_ledger extends CI_Controller {

	function Laporan_ledger()
	{
		parent::__construct();	
		$this->load->library('auth');
		$this->auth->check_user_authentification();
		$this->load->model('jurnal_model');	
		$this->load->model('akun_model');
		$this->load->model('customer_model');
		$this->load->model('pajak_model');
		$this->load->helper('indodate');
		$this->load->helper('finance');
		$this->load->library('fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		if($this->session->userdata('ADMIN')>'3'){$this->session->set_userdata('SUCCESSMSG', 'Maaf anda tidak memiliki akses.'); redirect('home'); }
	}
	
	function index()
	{
		$data['title'] = "Laporan General Ledger";
		$id = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_ledger');}
		$data['title'] = "General Ledger";
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }
		$data['account_data'] = $this->akun_model->get_data_by_id($id);
		  if($this->uri->segment(4)==''){
			$this->jurnal_model->set_account_id($id);
		  }else{
			$this->jurnal_model->set_account_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$data['main_content'] = 'laporan_ledger/form';
		$this->load->view('lte/tabel_proyek', $data);
	}
	
	function report()
	{
		$id = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_ledger');}
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih Akun.'); redirect('laporan_ledger');}
		$this->load->helper('indodate');
		$data['title'] = "General Ledger";
		$data['account_data'] = $this->akun_model->get_data_by_id($id);
		  if($this->uri->segment(4)==''){
			$this->jurnal_model->set_account_id($id);
		  }else{
			$this->jurnal_model->set_account_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$ida=$this->session->userdata('SESS_WP_ID');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data($ida);	
			$this->load->view('laporan_ledger/report', $data);
	}
		
	function excel()
	{
		$id = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_ledger');}
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih Akun.'); redirect('laporan_ledger');}
		$this->load->helper('indodate');
		$data['title'] = "General Ledger";
		$data['uri3'] = $id;
		$data['uri4'] = $from;
		$data['uri5'] = $to;
		$data['account_data'] = $this->akun_model->get_data_by_id($id);
		  if($this->uri->segment(4)==''){
			$this->jurnal_model->set_account_id($id);
		  }else{
			$this->jurnal_model->set_account_id($id);
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
		  }
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$ida=$this->session->userdata('SESS_WP_ID');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data($ida);	
			$this->load->view('laporan_ledger/excel', $data);
	}
		
}
/* End of file laporan_ledger.php */
/* Location: ./application/controllers/laporan_ledger.php */
