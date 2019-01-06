<?php

class Laporan_trial extends CI_Controller {

	function Laporan_trial()
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
		$from = $this->uri->segment(3);
		$to = $this->uri->segment(4);
		$cabang = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_trial');}
		$data['title'] = "Laporan Trial Balance";
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		if($cabang !=''){ $this->akun_model->set_wp_id($cabang); }	
		$data['account_data'] = $this->akun_model->get_all_data();
		$data['main_content'] = 'laporan_trial/form';
		$this->load->view('lte/tabel_proyek', $data);
	}
	
	function report()
	{
		$from = $this->uri->segment(3);
		$to = $this->uri->segment(4);
		$cabang = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_trial');}
        if(!$from){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih Tanggal.'); redirect('laporan_trial');}
		$data['title'] = "Laporan Trial Balance";
		$this->load->helper('indodate');
		$id=$this->session->userdata('SESS_WP_ID');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data($id);	
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }
		if($cabang !=''){ $this->akun_model->set_wp_id($cabang); }	
 	
		$data['account_data'] = $this->akun_model->get_all_data();
			$this->load->view('laporan_trial/report', $data);
	}
		
	function excel()
	{
		$from = $this->uri->segment(3);
		$to = $this->uri->segment(4);
		$cabang = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('laporan_trial');}
        if(!$from){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih Tanggal.'); redirect('laporan_trial');}
		$data['title'] = "Laporan Trial Balance";
		$data['uri3'] = $from;
		$data['uri4'] = $to;
		$this->load->helper('indodate');
		$id=$this->session->userdata('SESS_WP_ID');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data($id);	
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		if($cabang !=''){ $this->akun_model->set_wp_id($cabang); }	
		$data['account_data'] = $this->akun_model->get_all_data();
			$this->load->view('laporan_trial/excel', $data);
	}
		
}
/* End of file laporan_trial.php */
/* Location: ./application/controllers/laporan_trial.php */
