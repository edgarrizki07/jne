<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jual extends CI_Controller {

	/**
	 * @author : M David
	 * @web : http://muhammaddavid.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    function __construct(){
        parent::__construct();
        $this->load->library(array('auth','template','form_validation','pagination','upload','email','fpdf'));
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$this->load->helper(array('form', 'url','indodate','finance'));
		$this->auth->check_user_authentification();
		if($this->session->userdata('ADMIN')=='6'){redirect('home');}
	}
    
	function index()	{
		$data['title']="Daftar Penjualan BBM";
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index'; $this->load->view('lte/live', $data); }
	
	function wait()	{
		$data['title']="Draft Penjualan BBM";
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','status'=>'0'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index_view'; $this->load->view('lte/live', $data); }
	
	function prosses()	{
		$data['title']="Penjualan BBM dalam Proses ACC";
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','status'=>'1'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index_view'; $this->load->view('lte/live', $data); }
	
	function cancel()	{
		$data['title']="Penjualan BBM Telah di-Hapus";
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'1'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index_view'; $this->load->view('lte/live', $data); }
	
	function success()	{
		$data['title']="Penjualan BBM Telah di-ACC";
		if($this->uri->segment(3)==''){ }else{$this->db->where('tgl', $this->uri->segment(3)); }
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','status >'=>'1'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index_view'; $this->load->view('lte/live', $data); }
	
	function prepaid()	{
		$data['title']="Penjualan BBM Telah di-ACC Belum di-Bayar Customer";
		if($this->uri->segment(3)==''){ }else{$this->db->where('tgl', $this->uri->segment(3)); }
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','status'=>'2'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index_bayar'; $this->load->view('lte/live', $data); }
	
	function pay()	{
		$data['title']="Penjualan BBM dalam Proses Bayar";
		if($this->session->userdata('ADMIN')>'3'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','status'=>'3'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index_bayar'; $this->load->view('lte/live', $data); }
	
	function paid()	{
		$data['title']="Penjualan BBM Telah di-Bayar";
		if($this->session->userdata('ADMIN')>'3'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','status'=>'4'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/index_bayar'; $this->load->view('lte/live', $data); }
	
	function download_po($id)	{
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		$kode = $this->uri->segment(3); $file = $this->bbm_model->FilepoJual($kode);
		$data = file_get_contents("files/so/".$file); $name = $file; force_download($name, $data); redirect('jual'); }
	
	function rekap()	{
		$data['title']="Rekap Penjualan BBM";
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','status >='=>'2'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/rekap'; $this->load->view('lte/tabel_proyek', $data); }
	
	function filter()	{
		$data['title']="Rekap Penjualan BBM";
		$cabang = $this->uri->segment(3); $from = $this->uri->segment(4); $to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('jual/rekap/');}
		  if($this->uri->segment(4)==''){ $this->db->where('tgl >=', '2000-01-01'); $this->db->where('tgl <=', '2100-01-01');
		  }else{ $this->db->where('tgl >=', $from); $this->db->where('tgl <=', $to); }
		if($this->uri->segment(3)=='0'){ }else{ $this->db->where('wp_id', $cabang); }
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='tgl',$order_type='asc'); $data['info'] = $this->db->get_where('jual',array('cek'=>'0','status >='=>'2'));
		$data['main_content'] = 'jual/filter'; $this->load->view('lte/tabel_proyek', $data); }
	
	function filter_pdf()	{
		$data['title']="Rekap Penjualan BBM";
		$cabang = $this->uri->segment(3); $from = $this->uri->segment(4); $to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('jual/rekap/');}
		  if($this->uri->segment(4)==''){ $this->db->where('tgl >=', '2000-01-01'); $this->db->where('tgl <=', '2100-01-01');
		  }else{ $this->db->where('tgl >=', $from); $this->db->where('tgl <=', $to); }
		if($this->uri->segment(3)=='0'){ }else{ $this->db->where('wp_id', $cabang); }
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='tgl',$order_type='asc'); $data['isi'] = $this->db->get_where('jual',array('cek'=>'0','status >='=>'2'));
        $cek=$this->db->get_where('jual',array('cek'=>'0','status >='=>'2')); $data['info']=$cek->row_array(); $this->load->view('jual/filter_pdf', $data); }
	
	function filter_excel()	{
		$data['title']="Rekap Penjualan BBM";
		$cabang = $this->uri->segment(3); $from = $this->uri->segment(4); $to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('jual/rekap/');}
		  if($this->uri->segment(4)==''){ $this->db->where('tgl >=', '2000-01-01'); $this->db->where('tgl <=', '2100-01-01');
		  }else{ $this->db->where('tgl >=', $from); $this->db->where('tgl <=', $to); }
		if($this->uri->segment(3)=='0'){ }else{ $this->db->where('wp_id', $cabang); }
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='tgl',$order_type='asc'); $data['isi'] = $this->db->get_where('jual',array('cek'=>'0','status >='=>'2'));
        $cek=$this->db->get_where('jual',array('cek'=>'0','status >='=>'2')); $data['info']=$cek->row_array(); $this->load->view('jual/filter_excel', $data); }
	
    function add_invoice(){
        $data['title']="Tambah Invoice dari Daftar Penjualan";
		if($this->session->userdata('ADMIN')>'1'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }
		$this->db->order_by($order_column='id',$order_type='desc'); $jual = $this->db->get_where('jual',array('cek'=>'0','harga'=>'0'));
		$data['info'] = $jual->result(); $data['main_content'] = 'jual/add_invoice'; $this->load->view('lte/live', $data); }

    function view($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Penjualan BBM"; $data['message']=""; $cek=$this->db->get_where('jual',array('id'=>$id));
		$data['info']=$cek->row_array(); $data['main_content'] = 'jual/view'; $this->load->view('lte/live', $data); }
    
    function view_bayar($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Penjualan BBM"; $data['message']=""; $cek=$this->db->get_where('jual',array('id'=>$id));
		$data['info']=$cek->row_array(); $data['main_content'] = 'jual/view_bayar'; $this->load->view('lte/live', $data); }
    
    function pdf($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Penjualan BBM"; $data['message']=""; $cek=$this->db->get_where('jual',array('id'=>$id)); 
		$data['info']=$cek->row_array(); $this->load->view('jual/pdf',$data); }
    
// Delivery Order
    function delivery_order($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Delivery Order"; $data['message']=""; $data['main_content'] = 'jual/delivery_order'; $this->load->view('lte/live', $data); }
    
    function do_list(){
        $data['title']="List of Delivery Order"; $data['message']=""; $data['main_content'] = 'jual/do_list'; $this->load->view('lte/live', $data); }
    
    function do_cancel(){
        $data['title']="List of Delivery Order"; $data['message']=""; $data['main_content'] = 'jual/do_cancel'; $this->load->view('lte/live', $data); }
        
    function view_do($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Delivery Order"; $data['message']=""; $cek=$this->db->get_where('do',array('id'=>$id));
		$data['info']=$cek->row_array(); $data['main_content'] = 'jual/view_do'; $this->load->view('lte/live', $data); }
    
    function print_lidoba($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Delivery Order"; $data['message']=""; $cek=$this->db->get_where('do',array('id'=>$id,'cek'=>'0'));
		$data['info']=$cek->row_array(); $this->load->view('jual/print_lidoba', $data); }
    
    function print_do($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Delivery Order"; $data['message']=""; $cek=$this->db->get_where('do',array('id'=>$id,'cek'=>'0'));
		$data['info']=$cek->row_array(); $this->load->view('jual/print_do', $data); }
    
    function print_li($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Loading Instruction"; $data['message']=""; $cek=$this->db->get_where('do',array('id'=>$id,'cek'=>'0'));
		$data['info']=$cek->row_array(); $this->load->view('jual/print_li', $data); }
    
    function print_ba($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Berita Acara Serah Terima"; $data['message']=""; $cek=$this->db->get_where('do',array('id'=>$id,'cek'=>'0'));
		$data['info']=$cek->row_array(); $this->load->view('jual/print_ba', $data); }
    
    function tgldo(){
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('jual');} 
        $kode=$this->uri->segment(3); $tgl=$this->bbm_model->TglDO($kode); $data=array('tglkirim'=>$tgl);
		$this->db->where('id',$kode); $this->db->update('do',$data);
		echo "<meta http-equiv='refresh' content='0; url=".site_url('jual/tambah/')."'>"; }
    
	function list_po()	{
		$data['title']="PO Masuk Telah Di ACC";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$so = $this->db->get_where('po',array('cek'=>'0','status'=>'2'));
		$data['info'] = $so->result();
		$data['main_content'] = 'jual/list_po';
		$this->load->view('lte/live', $data);
	}
	
    function view_po($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('jual/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual/list_po');}
        $data['title']="PO Masuk Telah Di ACC";
        $cek=$this->db->get_where('po',array('id'=>$id));
		$data['info']=$cek->row_array();
		$data['main_content'] = 'jual/view_po';
		$this->load->view('lte/live', $data);
    }
                        
    function add_frompo($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('jual/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual/list_po');}
        $data['title']="Buat Penjualan dari PO Masuk Telah Di ACC"; $tgl=date('Ymd');
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID'));  $no_jual=$this->db->count_all_results('jual')+1;
        $cek=$this->db->get_where('po',array('id'=>$id));
        $datapo=$cek->result();
        foreach($datapo as $row){
            $info=array(
				'id'=>'id', 'id_jual'=>$no_jual,
				'tgl'=>$tgl, 'tgl_invoice'=>$tgl, 'nopo'=>$row->nopo, 'tglpo'=>$row->tglpo, 'filepo'=>$row->filepo,
				'customer_id'=>$row->customer_id, 'term'=>$row->term, 'carrier'=>$row->carrier, 'tempo'=>$row->tempo, 'tglkirim'=>$row->tglkirim,
				'jml'=>$row->jml, 'harga'=>$row->harga, 'discount'=>$row->discount, 
				'ohp'=>$row->ohp, 'ppnohp'=>$row->ppnohp, 'ppn'=>$row->ppn, 'npbbkb'=>$row->npbbkb, 'pbbkb'=>$row->pbbkb, 'pph'=>$row->pph,
				'tot1'=>$row->tot1, 'tot2'=>$row->tot2, 'tot3'=>$row->tot3, 'tot4'=>$row->tot4, 'tot5'=>$row->tot5, 'tot6'=>$row->tot6, 'tot7'=>$row->tot7, 
				'tot8'=>$row->tot8, 'tot9'=>$row->tot9, 'terbilang'=>$row->terbilang, 'wp_id'=>$row->wp_id,
				'sales'=>$row->sales, 'angkutan'=>'TRUCK TANK', 'barang_id'=>'1', 'produk'=>$this->setting_model->Produk(), 
				'login_id'=> $this->session->userdata('SESS_USER_ID')
            );
			$this->db->insert("jual",$info);
			$this->db->where('id',$id); $this->db->update('po',array('status'=>'3'));
			$this->db->where('id',$row->customer_id); $this->db->update('customer',array('status'=>'0'));
        }
			$this->session->set_userdata('SUCCESSMSG', 'tambah Success.'); redirect('jual/rounding/'.$this->db->count_all_results('jual'));
    }
                        
// Tambah Jual
    function add(){
		if($this->pajak_model->Accso($this->session->userdata('SESS_WP_ID'))=='1'){ redirect('jual/list_po'); } 
        $data['title']="Penjualan"; $data['tgl']=date('Y-m-d'); $tgl=date('Ymd');
		
		$thn=date('Y'); $this->db->where('year(tgl)', $thn); 
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID'));  
		$data['no']=$this->db->count_all_results('jual')+1;
        
		$data['noinvo']=$this->db->count_all_results('jual')+1; $data['nodor']=$this->db->count_all_results('jual')+1;
		$this->_set_rules(); if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			if($this->bbm_model->JmlInventory($this->session->userdata('SESS_WP_ID'))< $this->input->post('jml')){ 
			$this->session->set_userdata('SUCCESSMSG', 'Maaf Stok Tidak Mencukupi.'); redirect('jual/add');}
			
			$config['upload_path'] = '.files/so/'; $config['allowed_types'] = '*'; $config['max_size']	= '100000';
			$this->upload->initialize($config); if(!$this->upload->do_upload('filepo')){ $filepo=""; }else{ $filepo=$this->upload->file_name; }
			$info=array(
				'id'=>$this->input->post('id'), 'id_jual'=>$this->input->post('id_jual'),
				'tgl'=>$tgl, 'tgl_invoice'=>$tgl, 'customer_id'=>$this->input->post('customer_id'), 'export'=>$this->customer_model->ExportCustomer($this->input->post('customer_id')),
				'barang_id'=>'1', 'produk'=>$this->input->post('produk'), 'jml'=>$this->input->post('jml'),
				'nopo'=>$this->input->post('nopo'), 'tglpo'=>$this->input->post('tglpo'), 'filepo'=>$filepo,
				'sales'=>$this->input->post('sales'), 'angkutan'=>$this->input->post('angkutan'), 'sektor'=>$this->customer_model->SektorCustomer($this->input->post('customer_id')),
				'wp_id'=> $this->session->userdata('SESS_WP_ID'), 'login_id'=> $this->session->userdata('SESS_USER_ID')
			);
			$this->db->insert('jual',$info);
			$this->db->where('id',$this->input->post('customer_id')); $this->db->update('customer',array('status'=>'0'));
			$this->session->set_userdata('SUCCESSMSG', 'tambah Success.'); redirect('jual/add_do/'.$this->db->count_all_results('jual'));
        }else{
            $data['message']=""; $data['main_content'] = 'jual/add'; $this->load->view('lte/live', $data);
        }
    }
    
    function add_in($id){
		$data['title']="Invoice - In Tax"; $data['tgl']=date('Y-m-d'); $tgl=date('Ymd');
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('jual/add_invoice');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['no']=$this->bbm_model->IDJual($id);
        $this->_set_rules(); if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			// harga    
			$cek_harga	= $this->input->post('cek_harga'); $jml = $this->input->post('jml'); $h1 = $this->input->post('harga');
			//Pajak
			$discount = $this->input->post('discount'); $ndiscount = $this->input->post('ndiscount');
			$ohp = $this->input->post('ohp'); 
			if($ohp=='0'){ $nohp = '0'; $totohp = '0';}else{ $nohp = $this->input->post('ppnohp'); if($nohp=='0'){ $totohp = $ohp; }else{ $totohp = $ohp+($ohp/($nohp*10));} } 
			$ppnohp = $nohp;  
			$ppn = $this->input->post('ppn'); $pbbkb = $this->input->post('pbbkb'); $npbbkb = $this->input->post('npbbkb'); $pph = $this->input->post('pph');
			if($cek_harga=='0'){ $harga = $h1; }else{ $harga = (($h1/(100+($ppn*10)+($pbbkb*$npbbkb)+($pph*0.3)))*100); } //include
			//Total
			$tot1 = $jml*$harga; if($ndiscount==''){ $tot2 = $tot1*$discount/100; }else{ $tot2 = $ndiscount; }
			$tot3 = $tot1-$tot2; $tot4 = $tot3/10*$ppn; $tot5 = $tot3*($npbbkb/100)*$pbbkb; $tot6 = $tot3*3/1000*$pph; $tot7 = $jml*$ohp;
			$tot8 = $tot7*$ppnohp/10; $tt78	= $tot7+$tot8; $tot9 = $tot3+$tot4+$tot5+$tot6+$tt78;
			$info=array( 'harga'=>$harga, 'discount'=>$discount, 'ohp'=>$ohp, 'ppnohp'=>$ppnohp, 'ppn'=>$ppn, 'npbbkb'=>$npbbkb, 'pbbkb'=>$pbbkb, 'pph'=>$pph,
				'tot1'=>$tot1, 'tot2'=>$tot2, 'tot3'=>$tot3, 'tot4'=>$tot4, 'tot5'=>$tot5, 'tot6'=>$tot6, 'tot7'=>$tot7, 'tot8'=>$tot8, 'tot9'=>$tot9,
				'login_id'=> $this->session->userdata('SESS_USER_ID') );
			$this->db->where('id',$id); $this->db->update('jual',$info);		
			redirect('jual/rounding/'.$id);
        }else{
            $data['message']=""; $data['main_content'] = 'jual/add_in'; $this->load->view('lte/live', $data);
        }
    }
    
    function edit_in($id){
        $data['title']="Edit Invoice - In Tax"; $data['no']=$this->bbm_model->IDJual($id); $data['tgl']=date('Y-m-d'); $tgl=date('Ymd');
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Transaksi Penjualan.'); redirect('jual/add_invoice');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $this->_set_rules(); if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			// harga    
			$cek_harga	= $this->input->post('cek_harga'); $jml = $this->input->post('jml'); $h1 = $this->input->post('harga');
			//Pajak
			$discount = $this->input->post('discount'); $ndiscount = $this->input->post('ndiscount');
			$ohp = $this->input->post('ohp'); 
			if($ohp=='0'){ $nohp = '0'; $totohp = '0';}else{ $nohp = $this->input->post('ppnohp'); if($nohp=='0'){ $totohp = $ohp; }else{ $totohp = $ohp+($ohp/($nohp*10));} } 
			$ppnohp = $nohp;  
			$ppn = $this->input->post('ppn'); $pbbkb = $this->input->post('pbbkb'); $npbbkb = $this->input->post('npbbkb'); $pph = $this->input->post('pph');
			if($cek_harga=='0'){ $harga = $h1; }else{ $harga = (($h1/(100+($ppn*10)+($pbbkb*$npbbkb)+($pph*0.3)))*100); } //include
			//Total
			$tot1 = $jml*$harga; if($ndiscount==''){ $tot2 = $tot1*$discount/100; }else{ $tot2 = $ndiscount; }
			$tot3 = $tot1-$tot2; $tot4 = $tot3/10*$ppn; $tot5 = $tot3*($npbbkb/100)*$pbbkb; $tot6 = $tot3*3/1000*$pph; $tot7 = $jml*$ohp;
			$tot8 = $tot7*$ppnohp/10; $tt78	= $tot7+$tot8; $tot9 = $tot3+$tot4+$tot5+$tot6+$tt78;
			$info=array( 'harga'=>$harga, 'discount'=>$discount, 'ohp'=>$ohp, 'ppnohp'=>$ppnohp, 'ppn'=>$ppn, 'npbbkb'=>$npbbkb, 'pbbkb'=>$pbbkb, 'pph'=>$pph,
				'tot1'=>$tot1, 'tot2'=>$tot2, 'tot3'=>$tot3, 'tot4'=>$tot4, 'tot5'=>$tot5, 'tot6'=>$tot6, 'tot7'=>$tot7, 'tot8'=>$tot8, 'tot9'=>$tot9,
				'login_id'=> $this->session->userdata('SESS_USER_ID') );
			$this->db->where('id',$id); $this->db->update('jual',$info);
			redirect('jual/rounding/'.$id);
        }else{
            $data['message']=""; $cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array();
			$data['main_content'] = 'jual/edit_in'; $this->load->view('lte/live', $data);
        }
    }
    
// Create Invoice
    function rounding($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Informasi Tambahan INVOICE"; $IDJual=$this->bbm_model->IDJual($id); $kode=$this->uri->segment(3);
		date_default_timezone_set("Asia/Jakarta"); $data['tgl']=date('Y-m-d'); $tgl=date('Y-m-d H:i:s');
        $this->_set_rules(); if($this->form_validation->run()==true){
        if($id=){}else{}
			$info=array( 
				'status'=>'1', 'rounding'=>$this->input->post('rounding'), 'terbilang'=>$this->input->post('terbilang'), 
				'export'=>$this->input->post('export'), 'tgl_invoice'=>$this->input->post('tgl_invoice'), 
				'tempo'=>$this->input->post('tempo'), 'tglkirim'=>$this->input->post('tglkirim'),
				'sales'=>$this->input->post('sales'), 'angkutan'=>$this->input->post('angkutan'), 'term'=>$this->input->post('term'), 
				'carrier'=>$this->input->post('carrier'), 'sektor'=>$this->input->post('sektor'),
				'bank'=>$this->input->post('bank'), 'namarek'=>$this->input->post('namarek'), 'rekening'=>$this->input->post('rekening'),
				'keterangan'=>$this->input->post('keterangan'), 'tot9' => $this->input->post('tot9')+$this->input->post('rounding') );
		$this->db->where('id',$kode); $this->db->update('jual',$info);
		// Simpan History
		$this->db->insert('history',array('tgl'=>date('Y-m-d H:i:s'),'login_id'=>$this->session->userdata('SESS_USER_ID'),
			'wp_id'=>$this->session->userdata('SESS_WP_ID'),'kode'=>'2','action'=>'tambah Penjualan ','link_id'=>$this->db->count_all_results('jual')));
		// Pesan System
		if($this->pajak_model->Accpo($this->bbm_model->WPJual($id))=='0'){if($this->pajak_model->Emailpo($this->bbm_model->WPJual($id))==''){ redirect('jual/jurnal/'.$id);}else{} }else{
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$create= $this->user_model->NamaUser($this->bbm_model->LoginJual($id)); $print= site_url()."lihat/jual/".$id;
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$acc= anchor(site_url()."jual/jurnal/".$id, ' ACC ', $btn); $memo= anchor(site_url()."jual/memo/".$id, ' MEMO ', $btn);
			$subject= $this->setting_model->Subject_invoice().' Nomor '.$IDJual;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini Invoice baru telah dibuat oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->pajak_model->accinv($this->session->userdata('SESS_WP_ID')),
				'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}
		// email
		if($this->pajak_model->Emailpo($this->bbm_model->WPJual($id))==''){ }else{ redirect('jual/pdf_kirim/'.$id); }
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Invoice yang anda buat menunggu diperiksa'); redirect('jual/view/'.$id);
        }else{
			$cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array();
			$data['main_content'] = 'jual/rounding'; $this->load->view('lte/live', $data);
        }
    }
    
// Edit Invoice
    function edit_jual($id){
		date_default_timezone_set("Asia/Jakarta"); 
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Edit Informasi Tambahan INVOICE"; $data['tgl']=date('Y-m-d'); $tgl=date('Y-m-d H:i:s'); $IDJual=$this->bbm_model->IDJual($id); $kode=$this->uri->segment(3);
        $this->_set_rules(); if($this->form_validation->run()==true){
		$info=array( 
			'customer_id'=>$this->input->post('customer_id'), 'produk'=>$this->input->post('produk'),
			'nopo'=>$this->input->post('nopo'), 'tglpo'=>$this->input->post('tglpo'),
			'rounding'=>$this->input->post('rounding'), 'terbilang'=>$this->input->post('terbilang'), 'status'=>'1',
			'tgl_invoice'=>$this->input->post('tgl_invoice'), 'tempo'=>$this->input->post('tempo'), 'tglkirim'=>$this->input->post('tglkirim'),
			'sales'=>$this->input->post('sales'), 'angkutan'=>$this->input->post('angkutan'), 'term'=>$this->input->post('term'),
			'bank'=>$this->input->post('bank'), 'namarek'=>$this->input->post('namarek'), 'rekening'=>$this->input->post('rekening'),
			'keterangan'=>$this->input->post('keterangan'), 'tot9' => $this->input->post('tot9')+$this->input->post('rounding') );
		$this->db->where('id',$kode); $this->db->update('jual',$info);
		// Simpan History
		$this->db->insert('history',array('tgl'=>date('Y-m-d H:i:s'),'login_id'=>$this->session->userdata('SESS_USER_ID'),
			'wp_id'=>$this->session->userdata('SESS_WP_ID'),'kode'=>'2','action'=>'tambah Penjualan ','link_id'=>$this->db->count_all_results('jual')));
		// Pesan System
		if($this->pajak_model->Accpo($this->bbm_model->WPJual($id))=='0'){if($this->pajak_model->Emailpo($this->bbm_model->WPJual($id))==''){ redirect('jual/jurnal/'.$id);}else{} }else{
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$create= $this->user_model->NamaUser($this->bbm_model->LoginJual($id)); $print= site_url()."lihat/jual/".$id;
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$acc= anchor(site_url()."jual/jurnal/".$id, ' ACC ', $btn); $memo= anchor(site_url()."jual/memo/".$id, ' MEMO ', $btn);
			$subject= $this->setting_model->Subject_invoice().' Nomor '.$IDJual;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini Invoice yang telah diperbaiki oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->pajak_model->accinv($this->session->userdata('SESS_WP_ID')),
				'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}
		// email
		if($this->pajak_model->Emailpo($this->bbm_model->WPJual($id))==''){ }else{ redirect('jual/pdf_kirim/'.$id); }
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Invoice yang anda buat menunggu diperiksa'); redirect('jual/view/'.$id);
        }else{
			$cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array();
			$data['main_content'] = 'jual/edit_jual'; $this->load->view('lte/live', $data);
        }
    }
    
    function pdf_kirim($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Penjualan BBM"; $cek=$this->db->get_where('jual',array('id'=>$id));
		$data['info']=$cek->row_array(); $this->load->view('jual/pdf_kirim',$data); }
        
    function email_acc($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Kirim Email Penjualan BBM"; $IDJual=$this->bbm_model->IDJual($id);
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');  $data['tgl']=date('Y-m-d');
		// Notif
			$key = md5('jagad', true);
			$encrypted_id= encrypt($id, $key);
			$create = $this->user_model->NamaUser($this->bbm_model->LoginJual($id));
			$print = site_url()."lihat/jual/".$id;
			$email = anchor(site_url()."jual/email_acc/".$id, ' KLIK DISINI '); 
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';			
			$acc = anchor(site_url()."acc/acc_jual/".$encrypted_id, ' ACC ', $btn); 
			$memo = anchor(site_url()."memo/jual/".$encrypted_id, ' MEMO ', $btn);
			$subject = $this->setting_model->Subject_po().' Nomor '.$IDJual;
			$message = $this->load->view('mail')."".$this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini PO yang telah dibuat oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
		// Email  
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->pajak_model->Emailinv($this->session->userdata('SESS_WP_ID'))); 
			$this->email->subject($subject); $this->email->message($message);
			$this->email->attach('files/invoice/Invoice No.'.$id.'.pdf');// Lampiran
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim, <br>Terimakasih, Invoice yang anda buat menunggu diperiksa');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim, silahkan '.$email.' untuk mengirim ulang email <br>Terimakasih, Invoice yang anda buat menunggu diperiksa');}
			redirect('jual/view/'.$id);
    }

// Jurnal Jual & ACC
    function jurnal($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak diizinkan untuk meng ACC Invoice ini.'); redirect('jual');}

		//jika doble acc lompat
		if(!$this->bbm_model->JurnalJual($id)==''){$this->session->set_userdata('SUCCESSMSG', 'Invoice ini telah di ACC dan di Jurnal.'); redirect('jurnal_proyek/view/'.$this->bbm_model->JurnalJual($id));}

		//Save Jurnal
		$no_jurnal=$this->db->count_all('jurnal')+1;
		$data=array('status'=>'2','admin_id'=>$this->session->userdata('SESS_USER_ID'),'jurnal_id'=>$no_jurnal);
		$this->db->where('id',$id); $this->db->update('jual',$data);
		$this->db->where('wp_id', $this->bbm_model->WPJual($id)); $this->db->where('voucher_id', '9'); $nomor_voucher=$this->db->count_all_results('jurnal')+1;
			$jurnal=array(
				'id' => $no_jurnal, 'no' => $no_jurnal, 'voucher_id' => '9', 'no_voucher' => $nomor_voucher, 'customer_id' => $this->bbm_model->CustomerJual($id), 
				'tgl' => $this->bbm_model->TglJual($id), 'tempo' => $this->bbm_model->TempoJual($id), 'f_id' => '1',
				'login_id' => $this->session->userdata('SESS_USER_ID'), 'user_id' => $this->session->userdata('SESS_USER_ID'), 'wp_id'=> $this->bbm_model->WPJual($id),
				'keterangan' => 'Piutang Penjualan BBM / Invoice ('.$this->bbm_model->JmlJual($id).' L) Kirim '.$this->jurnal_model->tgl_singkatan($this->bbm_model->KirimJual($id)), 'waktu_post' => date("Y-m-d H:i:s") );
			$this->db->insert('jurnal',$jurnal);
			
		//Save Jurnal Detail
			//AR - Piutang Penjualan
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail3=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => '1',
				'akun_id' => $this->akun_model->AkunJualTotal($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualTotal($this->bbm_model->WPJual($id))),
				'debit_kredit' => '1', 'nilai' => $this->bbm_model->Total9Jual($id)
			);
			$this->db->insert('jurnal_detail',$jurnal_detail3);
				
			//Subtotal Pendapatan Penjualan
			$this->db->where('jurnal_id', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail1=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => $noitem,
				'akun_id' => $this->akun_model->AkunJualSubtotal($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualSubtotal($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0', 'nilai' => $this->bbm_model->Total1Jual($id) );
			$this->db->insert('jurnal_detail',$jurnal_detail1);
			
			//discount
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail2=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => $noitem,
				'akun_id' => $this->akun_model->AkunJualDiscount($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualDiscount($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0', 'nilai' => $this->bbm_model->Total2Jual($id)
			);
			if($this->bbm_model->Total2Jual($id)=='0'){ }else{ $this->db->insert('jurnal_detail',$jurnal_detail2); }

			//ppn
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail4=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => $noitem,
				'akun_id' => $this->akun_model->AkunJualPPN($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualPPN($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0', 'nilai' => $this->bbm_model->Total4Jual($id)
			);
			if($this->bbm_model->Total4Jual($id)=='0'){ }else{ $this->db->insert('jurnal_detail',$jurnal_detail4); }

			//pbbkb
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail5=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => $noitem,
				'akun_id' => $this->akun_model->AkunJualPajak($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualPajak($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0', 'nilai' => $this->bbm_model->Total5Jual($id)
			);
			if($this->bbm_model->Total5Jual($id)=='0'){ }else{ $this->db->insert('jurnal_detail',$jurnal_detail5); }
		
			//pph
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail6=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => $noitem,
				'akun_id' => $this->akun_model->AkunJualPajak($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualPajak($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0', 'nilai' => $this->bbm_model->Total6Jual($id)
			);
			if($this->bbm_model->Total6Jual($id)=='0'){ }else{ $this->db->insert('jurnal_detail',$jurnal_detail6); }
			
			//Transport Jual
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail7=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => $noitem,
				'akun_id' => $this->akun_model->AkunJualTransport($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualTransport($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0', 'nilai' => $this->bbm_model->Total7Jual($id)
			);
			if($this->bbm_model->Total7Jual($id)=='0'){ }else{ $this->db->insert('jurnal_detail',$jurnal_detail7); }

			//ppn Transport Jual
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal')); $noitem=$this->db->count_all('jurnal_detail')+1;
			$jurnal_detail8=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => $noitem,
				'akun_id' => $this->akun_model->AkunJualPPNTransport($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualPPNTransport($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0', 'nilai' => $this->bbm_model->Total8Jual($id)
			);
			if($this->bbm_model->Total8Jual($id)=='0'){ }else{ $this->db->insert('jurnal_detail',$jurnal_detail8); }
					
		// Notifikasi ACC
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';	
			$IDJual=$this->bbm_model->IDJual($id);
			$cetak= anchor(site_url()."jual/pdf/".$id, ' CETAK ', $btn); $subject= 'PO Nomor '.$IDJual.' Telah Di Setujui (ACC)';
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>PO Telah Di Setujui (ACC):<b><br><b>Untuk Mencetak PO silahkan klik dibawah ini :</b><br>".$cetak."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System
		if($this->pajak_model->Accinv($this->bbm_model->WPJual($id))=='0'){ }else{ 
			$info=array( 
				'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginJual($id), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}
		// Email
		if($this->pajak_model->Emailinv($this->bbm_model->WPJual($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginJual($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
		$this->session->set_userdata('SUCCESSMSG', 'Terimakasih telah menyetujui penjualan ini.'); redirect('jual/view/'.$id);
    }
                        
// Memo Invoice
    function memo($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
		date_default_timezone_set("Asia/Jakarta");
        $data['title']="Memo Penjualan BBM"; $data['tgl']=date('Y-m-d'); $tgl=date('Y-m-d H:i:s'); $IDJual=$this->bbm_model->IDJual($id);
        $this->_set_rules(); if($this->form_validation->run()==true){
		// Notifikasi Memo
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$edit= anchor(site_url()."jual/edit_jual/".$id, ' EDIT ', $btn); $subject= 'Memo Perbaikan untuk Invoice Nomor '.$IDJual;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini memo perbaikan yang dibuat :<b><br>".$this->input->post('pesan')."<br><b>Untuk Perbaikan silahkan klik dibawah ini :</b><br>".$edit."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System
		if($this->pajak_model->Accinv($this->bbm_model->WPJual($id))=='0'){ }else{ 
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginJual($id), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}
		// Email
		if($this->pajak_model->Emailinv($this->bbm_model->WPJual($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginJual($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Memo untuk perbaikan Invoice telah dikirim'); redirect('jual/view/'.$id);
        }else{
			$cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array();
			$data['main_content'] = 'jual/memo'; $this->load->view('lte/mail', $data);
        }
    }
    
// Hapus Invoice
    function hapus($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
        $kode=$this->uri->segment(3); $data=array('cek'=>'1','login_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode); $this->db->update('jual',$data); $this->db->where('id_jual',$kode); $this->db->update('do',$data);
		date_default_timezone_set("Asia/Jakarta");
		$data_jurnal=array('keterangan'=>'Jurnal ini telah dihapus oleh '.$this->user_model->NamaUser($this->session->userdata('SESS_USER_ID'))
		.' pada tanggal '.date('d-m-Y').' Jam '.date('H:i'));
        $jurnal_id=$this->bbm_model->JurnalJual($kode); $this->db->where('id',$jurnal_id); $this->db->update('jurnal',$data_jurnal);
		$this->db->where('jurnal_id', $jurnal_id); $this->db->delete('jurnal_detail');
		$this->session->set_userdata('SUCCESSMSG', 'Data Penjualan dan Jurnal Telah dihapus.'); echo "<meta http-equiv='refresh' content='0; url=".site_url('jual')."'>";			
    }
    
// CREATE DO
    function add_do($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
        $data['title']="Delivery Order"; $data['tgl']=date('Y-m-d'); $data['no']=$this->uri->segment(3);
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); $data['nodor']=$this->db->count_all_results('do')+1; //Jumlah DO per cabang
		$this->db->where('id_jual', $id);  $data['iddor']=$this->db->count_all_results('do')+1; //Nomor Urut DO per jual
        $this->_set_rules(); if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			if($this->bbm_model->JmlSisaJual($id)< $this->input->post('volume')){ 
			$this->session->set_userdata('SUCCESSMSG', 'Maaf Sisa Tidak Mencukupi.'); redirect('jual/add_do/'.$id);}
			$info=array(
				'id'=>$this->input->post('id'),
				'id_jual'=>$id,//Nomor DO = Nomor Invoice
				'id_do'=>$this->input->post('id_do'),//Nomor Urut DO per jual
				'nodo'=>$this->input->post('nodo'),//Jumlah DO per cabang
				'tgldo'=>date("Y-m-d H:i:s"),
				'status'=>'1',
				'customer_id'=>$this->input->post('customer_id'),
				'tglkirim'=>$this->input->post('tglkirim'),
				'delivery'=>$this->input->post('delivery'),
				'kirim'=>$this->input->post('kirim'),
				'kirim1'=>$this->input->post('kirim1'),
				'armada'=>$this->input->post('armada'),
				'angkutan'=>$this->input->post('angkutan'),
				'carrier_li'=>$this->input->post('carrier_li'),
				'carrier'=>$this->input->post('carrier'),
				'vehicle_transport'=>$this->input->post('vehicle_transport'),
				'vehicle_id'=>$this->input->post('vehicle_id'),
				'storage'=>$this->input->post('storage'),
				'barang_id'=>'1',
				'produk'=>$this->input->post('produk'),
				'nopo'=>$this->input->post('nopo'),
				'capacity'=>$this->input->post('capacity'),
				'volume'=>$this->input->post('volume'),
				'driver'=>$this->input->post('driver'),
				'seals'=>$this->input->post('seals'),
				'density'=>$this->input->post('density'),
				'temperature'=>$this->input->post('temperature'),
				'remarks'=>$this->input->post('remarks'),
				'terminal_loading'=>$this->input->post('terminal_loading'),
				'alamat_loading'=>$this->input->post('alamat_loading'),
				'wilayah_loading'=>$this->input->post('wilayah_loading'),
				'date_loading'=>$this->input->post('date_loading'),
				'time1_loading'=>$this->input->post('time1_loading'),
				'time2_loading'=>$this->input->post('time2_loading'),
				'reff_li'=>$this->input->post('reff_li'),
				'reff_lo'=>$this->input->post('reff_lo'),
				'reff_po'=>$this->input->post('reff_po'),
				'reff_do'=>$this->input->post('reff_do'),
				'wp_id'=> $this->session->userdata('SESS_WP_ID'),
				'login_id'=> $this->session->userdata('SESS_USER_ID')
			);
			$this->db->insert('do',$info);
		// Pesan System
		if($this->pajak_model->Accdo($this->bbm_model->WPJual($id))=='0'){if($this->pajak_model->Emaildo($this->bbm_model->WPJual($id))==''){ redirect('jual/acc_do/'.$this->db->count_all_results('do'));} }else{
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$Id_JualDO=$id; $NoDO=$this->input->post('nodo'); 
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$create= $this->user_model->NamaUser($this->session->userdata('SESS_USER_ID'));
			$print= site_url()."lihat/lidobast/".$this->db->count_all_results('do');
			$acc= anchor(site_url()."jual/acc_do/".$this->db->count_all_results('do'), ' ACC ', $btn);
			$memo= anchor(site_url()."jual/memo_do/".$this->db->count_all_results('do'), ' MEMO ', $btn);
			$subject= $this->setting_model->Subject_do().' Nomor '.$Id_JualDO.'-'.$NoDO;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini LI DO dan BAST baru telah dibuat oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
			$info=array(
				'id'=>'id', 'tgl'=>$tgl,
				'kepada'=>$this->pajak_model->accdo($this->session->userdata('SESS_WP_ID')),
				'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID')
			);
			$this->m_pesan->simpan($info);
		}
		// email
		if($this->pajak_model->Emaildo($this->bbm_model->WPJual($id))==''){ }else{ redirect('jual/do_kirim/'.$this->db->count_all_results('do')); }
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, DO yang anda buat menunggu diperiksa'); redirect('jual/view_do/'.$this->db->count_all_results('do'));

        }else{
            $data['message']=""; $data['main_content'] = 'jual/add_do'; $this->load->view('lte/live', $data);
        }
    }
    
// EDIT DO
    function edit_do($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu DO.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
        $data['title']="Delivery Order"; $data['tgl']=date('Y-m-d'); $data['no']=$this->bbm_model->Id_JualDO($id)."-".$this->bbm_model->NoDO($id);
        $this->_set_rules(); if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			if($this->bbm_model->JmlSisaJual($this->bbm_model->Id_JualDO($id))< $this->input->post('volume')){ 
			$this->session->set_userdata('SUCCESSMSG', 'Maaf Sisa Tidak Mencukupi.'); redirect('jual/edit_do/'.$id);}
			$info=array(
				'status'=>'1',
				'tglkirim'=>$this->input->post('tglkirim'),
				'delivery'=>$this->input->post('delivery'),
				'kirim'=>$this->input->post('kirim'),
				'kirim1'=>$this->input->post('kirim1'),
				'armada'=>$this->input->post('armada'),
				'angkutan'=>$this->input->post('angkutan'),
				'carrier_li'=>$this->input->post('carrier_li'),
				'carrier'=>$this->input->post('carrier'),
				'vehicle_id'=>$this->input->post('vehicle_id'),
				'storage'=>$this->input->post('storage'),
				'produk'=>$this->input->post('produk'),
				'nopo'=>$this->input->post('nopo'),
				'capacity'=>$this->input->post('capacity'),
				'volume'=>$this->input->post('volume'),
				'driver'=>$this->input->post('driver'),
				'seals'=>$this->input->post('seals'),
				'density'=>$this->input->post('density'),
				'temperature'=>$this->input->post('temperature'),
				'remarks'=>$this->input->post('remarks'),
				'terminal_loading'=>$this->input->post('terminal_loading'),
				'alamat_loading'=>$this->input->post('alamat_loading'),
				'wilayah_loading'=>$this->input->post('wilayah_loading'),
				'date_loading'=>$this->input->post('date_loading'),
				'time1_loading'=>$this->input->post('time1_loading'),
				'time2_loading'=>$this->input->post('time2_loading'),
				'reff_li'=>$this->input->post('reff_li'),
				'reff_lo'=>$this->input->post('reff_lo'),
				'reff_po'=>$this->input->post('reff_po'),
				'reff_do'=>$this->input->post('reff_do'),
				'login_id'=> $this->session->userdata('SESS_USER_ID')
			);
			$this->db->where('id',$id); $this->db->update('do',$info);
		// Pesan System
		if($this->pajak_model->Accdo($this->bbm_model->WPDO($id))=='0'){if($this->pajak_model->Emaildo($this->bbm_model->WPDO($id))==''){ redirect('jual/acc_do/'.$id);} }else{
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$Id_JualDO=$this->bbm_model->Id_JualDO($id); $IDDO=$this->bbm_model->IDDO($id);
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;'; 
			$create= $this->user_model->NamaUser($this->bbm_model->LoginJual($id));
			$print= site_url()."lihat/lidobast/".$id; $acc= anchor(site_url()."jual/acc_do/".$id, ' ACC ', $btn); $memo= anchor(site_url()."jual/memo_do/".$id, ' MEMO ', $btn);
			$subject= $this->setting_model->Subject_do().' Nomor '.$Id_JualDO.'-'.$NoDO;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini LI DO dan BAST telah diperbaiki oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan ulang silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
			$info=array(
				'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->pajak_model->accdo($this->session->userdata('SESS_WP_ID')),
				'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID')
			);
			$this->m_pesan->simpan($info);
		}
		// email
		if($this->pajak_model->Emaildo($this->bbm_model->WPDO($id))==''){ }else{  redirect('jual/do_kirim/'.$id); }
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, DO yang anda buat menunggu diperiksa'); redirect('jual/view_do/'.$id);
        }else{
            $data['message']=""; $cek=$this->db->get_where('do',array('id'=>$id)); 
			$data['info']=$cek->row_array(); $data['main_content'] = 'jual/edit_do'; $this->load->view('lte/live', $data);
        }
    }
    
    function do_kirim($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="DO Penjualan BBM"; $cek=$this->db->get_where('do',array('id'=>$id));
		$data['info']=$cek->row_array(); $this->load->view('jual/do_kirim',$data); }
        
    function email_accdo($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Kirim Email Penjualan BBM"; $IDJual=$this->bbm_model->IDJual($id);
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');  $data['tgl']=date('Y-m-d');
		// Notif
			$key = md5('jagad', true); $encrypted_id= encrypt($id, $key);
			$create = $this->user_model->NamaUser($this->bbm_model->Loginjual($id));
			$print = site_url()."lihat/jual/".$id;
			$email = anchor(site_url()."jual/email_accdo/".$id, ' KLIK DISINI '); 
			$p = "'";
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';			
			$acc = anchor(site_url()."acc/acc_do/".$encrypted_id, ' ACC ', $btn); 
			$memo = anchor(site_url()."memo/memo_do/".$encrypted_id, ' MEMO ', $btn);
			$subject = $this->setting_model->Subject_po().' Nomor '.$IDJual;
			$message = $this->load->view('mail')."".$this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini PO yang telah dibuat oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
		// Email  
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->pajak_model->Emailpo($this->session->userdata('SESS_WP_ID'))); 
			$this->email->subject($subject); $this->email->message($message);
			$this->email->attach('files/do/DO No.'.$id.'.pdf');// Lampiran
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim, <br>Terimakasih, PO yang anda buat menunggu diperiksa');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim, silahkan '.$email.' untuk mengirim ulang email <br>Terimakasih,PO yang anda buat menunggu diperiksa');}
			redirect('jual/view_do/'.$id);
    }

// ACC DO
    function acc_do($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('jual/do_list');}
		//jika doble acc lompat
		if(!$this->bbm_model->JurnalDO($id)==''){$this->session->set_userdata('SUCCESSMSG', 'DO ini telah di ACC dan di Jurnal.'); redirect('jurnal_proyek/view/'.$this->bbm_model->JurnalDO($id));}
		// Jurnal 
		$no_jurnal=$this->db->count_all('jurnal')+1; 
		$data=array('status'=>'0','jurnal_id'=>$no_jurnal,'admin_id'=>$this->session->userdata('SESS_USER_ID')); $this->db->where('id',$id);$this->db->update('do',$data);
		$this->db->where('wp_id', $this->bbm_model->WPDO($id));  $this->db->where('voucher_id', '11');  $nomor_voucher=$this->db->count_all_results('jurnal')+1;
			$jurnal=array(
				'id' => no_jurnal, 'no' => $no_jurnal, 'voucher_id' => '11', 'no_voucher' => $nomor_voucher, 'customer_id' => $this->bbm_model->CustomerDO($id), 
				'tgl' => $this->bbm_model->TglDO($id), 'tempo' => $this->bbm_model->TglDO($id), 'f_id' => '1',
				'login_id' => $this->session->userdata('SESS_USER_ID'), 'user_id' => $this->session->userdata('SESS_USER_ID'), 'wp_id'=> $this->bbm_model->WPDO($id),
				'keterangan' => 'Pengiriman HSD ('.$this->bbm_model->VolumeDO($id).' L) kirim '.$this->jurnal_model->tgl_singkatan($this->bbm_model->TglKirim($id)).' HPP '.$this->jurnal_model->GrafikAvgBeliCabang($this->bbm_model->TglKirim($id),$this->bbm_model->WPDO($id)), 'waktu_post' => date("Y-m-d H:i:s") );
			$this->db->insert('jurnal',$jurnal);

			//Debet
			$jurnal_detail1=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => '1',
				'akun_id' => $this->akun_model->AkunDeliveryDebet($this->bbm_model->WPDO($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunDeliveryDebet($this->bbm_model->WPDO($id))),
				'debit_kredit' => '1', 'nilai' => ($this->jurnal_model->GrafikAvgBeliCabang($this->bbm_model->TglKirim($id),$this->bbm_model->WPDO($id))*$this->bbm_model->VolumeDO($id)) );
			$this->db->insert('jurnal_detail',$jurnal_detail1);
			//Kredit
			$jurnal_detail9=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => '2',
				'akun_id' => $this->akun_model->AkunDeliveryKredit($this->bbm_model->WPDO($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunDeliveryKredit($this->bbm_model->WPDO($id))),
				'debit_kredit' => '0', 'nilai' => ($this->jurnal_model->GrafikAvgBeliCabang($this->bbm_model->TglKirim($id),$this->bbm_model->WPDO($id))*$this->bbm_model->VolumeDO($id)) );
			$this->db->insert('jurnal_detail',$jurnal_detail9);
							
		// Notifikasi System 
		$IDJual=$this->bbm_model->IDJual($id);
		$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;'; 
		$cetak= anchor(site_url()."jual/view_do/".$id, ' CETAK ', $btn); 
		$subject= 'DO Nomor '.$IDJual.' Telah Di Setujui (ACC)';
		$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>DO Telah Di Setujui (ACC):<b><br><b>Untuk Mencetak DO silahkan klik dibawah ini :</b><br>".$cetak."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System 
		if($this->pajak_model->Accdo($this->bbm_model->WPDO($id))=='0'){ }else{ 
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$info=array(
				'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginDO($id), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID')
			);
			$this->m_pesan->simpan($info);
		}
		// email
		if($this->pajak_model->Emaildo($this->bbm_model->WPDO($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginDO($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
		redirect('jual/delivery_order/'.$this->bbm_model->Id_JualDO($id));
    }
    
// MEMO DO
    function memo_do($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
		$Id_JualDO=$this->bbm_model->Id_JualDO($id); $NoDO=$this->bbm_model->NoDO($id);
        $data['title']="Memo DO Penjualan BBM"; $data['tgl']=date('Y-m-d');
        $this->_set_rules(); if($this->form_validation->run()==true){
		// Notifikasi Memo
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;'; 
			$edit= anchor(site_url()."jual/edit_do/".$id, ' EDIT ', $btn); 
			$subject= 'Memo Perbaikan untuk DO Nomor '.$Id_JualDO.'-'.$NoDO;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini memo perbaikan yang dibuat :<b><br>".$this->input->post('pesan')."<br><b>Untuk Perbaikan silahkan klik dibawah ini :</b><br>".$edit."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System
		if($this->pajak_model->Accdo($this->bbm_model->WPDO($id))=='0'){ }else{ 
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginDO($id), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}		
		// email
		if($this->pajak_model->Emaildo($this->bbm_model->WPDO($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginDO($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Memo untuk perbaikan LI DO dan BAST telah dikirim'); redirect('jual/delivery_order/'.$id);
        }else{
			$cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array(); $data['main_content'] = 'jual/memo_do'; $this->load->view('lte/mail', $data);
        }
    }
    
// Hapus DO
    function hapusdo($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_do($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('jual/do_list');} 
        $kode=$this->uri->segment(3); $data=array('cek'=>'1','login_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode); $this->db->update('do',$data);
		date_default_timezone_set("Asia/Jakarta");
		$data_jurnal=array('keterangan'=>'Jurnal ini telah dihapus oleh '.$this->user_model->NamaUser($this->session->userdata('SESS_USER_ID'))
		.' pada tanggal '.date('d-m-Y').' Jam '.date('H:i'));
        $jurnal_id=$this->bbm_model->JurnalDO($kode); $this->db->where('id',$jurnal_id); $this->db->update('jurnal',$data_jurnal);
		$this->db->where('jurnal_id', $jurnal_id); $this->db->delete('jurnal_detail');
		$this->session->set_userdata('SUCCESSMSG', 'Data Penjualan dan Jurnal Telah dihapus.'); redirect('jual/delivery_order/'.$kode);}
    
	
// Create Pay
    function add_pay($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'3'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
        $data['title']="Terima Pembayaran";
        $kode=$this->uri->segment(4); $this->db->where('id',$kode); $this->db->update('history',array('cek'=>'1'));
        $this->_set_rules(); if($this->form_validation->run()==true){
			if($this->bbm_model->JmlBayarJual($id) < $this->input->post('jmlbyr')){
			$this->session->set_userdata('SUCCESSMSG', 'Maaf Pembayaran yang anda '.number_format($this->input->post('jmlbyr'), 0, ',', '.').' melebihi batas.'); redirect('jual/add_pay/'.$id);}
			
            // $id=$this->input->post('id');
			$config['upload_path'] = './files/pembayaran/'; $config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
			$config['max_size']	= '100000'; $config['max_width']  = '20000'; $config['max_height']  = '10240';
			$this->upload->initialize($config); if(!$this->upload->do_upload('gbr')){ $gbr=""; }else{ $gbr=$this->upload->file_name; }
            $semua=array( 'status'=>'3' ); $this->db->where('id',$id); $this->db->update('jual',$semua);
            $info=array( 
				'id_jual'=>$this->input->post('id_jual'), 'akunbyr'=>$this->input->post('akunbyr'), 
				'jmlbyr'=>$this->input->post('jmlbyr'), 'tglbyr'=>$this->input->post('tglbyr'), 'keterangan'=>$this->input->post('keterangan'), 
				'wp_id'=> $this->session->userdata('SESS_WP_ID'), 'login_id'=> $this->session->userdata('SESS_USER_ID'), 'bukti'=>$gbr );
			$this->db->insert('jual_bayar',$info);
		// Simpan History
			date_default_timezone_set("Asia/Jakarta");
			$this->db->insert('history',array('tgl'=>date('Y-m-d H:i:s'),'login_id'=>$this->session->userdata('SESS_USER_ID'),
			'wp_id'=>$this->session->userdata('SESS_WP_ID'),'kode'=>'4','action'=>'Menerima Pembayaran INVOICE','link_id'=>$id));
		// Pesan System
		if($this->pajak_model->Accpay($this->bbm_model->WPJual($id))=='0'){if($this->pajak_model->Emailpay($this->bbm_model->WPJual($id))==''){ redirect('jual/acc_pay/'.$id);}else{} }else{
			$IDJual=$this->bbm_model->IDJual($id);
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$create= $this->user_model->NamaUser($this->bbm_model->LoginBayar($id)); $print= site_url()."lihat/bayar/".$id;
			$acc= anchor(site_url()."jual/acc_pay/".$id, ' ACC ', $btn); $memo= anchor(site_url()."jual/memo_pay/".$id, ' MEMO ', $btn);
			$subject= $this->setting_model->Subject_pay().' Nomor '.$IDJual;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini Pembayaran Invoice yang telah dibuat oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->pajak_model->accinv($this->session->userdata('SESS_WP_ID')),
				'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}
		// email
		if($this->pajak_model->Emailpay($this->bbm_model->WPJual($id))==''){ }else{ redirect('jual/pay_kirim/'.$id.'/'.$this->db->count_all_results('jual_bayar')); }
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Pembayaran yang anda buat menunggu diperiksa'); 
			$cek=$this->db->get_where('jual',array('id'=>$id,'cek'=>'0')); $data['info']=$cek->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>"; $data['main_content'] = 'jual/add_pay'; $this->load->view('lte/live', $data);
        }else{
            $data['message']=""; $cek=$this->db->get_where('jual',array('id'=>$id,'cek'=>'0')); $data['info']=$cek->row_array();
			$data['main_content'] = 'jual/add_pay'; $this->load->view('lte/live', $data);
        }
    }
    
// Bayar
    function view_pay($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $data['title']="Penjualan BBM"; $data['message']=""; $cek=$this->db->get_where('jual',array('id'=>$id));
		$data['info']=$cek->row_array(); $data['main_content'] = 'jual/view_pay'; $this->load->view('lte/live', $data); }

    function pdf_pay($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $kode=$this->uri->segment(4); $data['bukti']= $this->bbm_model->BuktiBayarPenjualan($kode);
        $data['title']="Penjualan BBM"; $data['message']=""; $cek=$this->db->get_where('jual',array('id'=>$id)); 
		$data['info']=$cek->row_array(); $this->load->view('jual/pdf_pay',$data); }
		
    function pay_kirim($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
        $kode=$this->uri->segment(4); $data['bukti']= $this->bbm_model->BuktiBayarPenjualan($kode);
        $data['title']="Pembayaran Penjualan BBM"; $cek=$this->db->get_where('jual',array('id'=>$id));
		$data['info']=$cek->row_array(); $this->load->view('jual/pay_kirim',$data); }
        
    function email_accpay($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('jual');}
		$kode=$this->uri->segment(4); 
        $data['title']="Kirim Email Pembayaran Penjualan BBM"; $IDJual=$this->bbm_model->IDJual($id);
		date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');  $data['tgl']=date('Y-m-d');
		// Notif
			$key = md5('jagad', true); $encrypted_id= encrypt($id, $key);
			$key2 = md5('jagad', true); $encrypted_kode= encrypt($kode, $key2);
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';			
			$create = $this->user_model->NamaUser($this->bbm_model->LoginBayar($id));
			$print = site_url()."lihat/bayar/".$id;
			$email = anchor(site_url()."jual/email_accpay/".$id."/".$kode, ' KLIK DISINI '); 
			$p = "'";
			$acc_link = site_url()."acc/acc_jualpay/".$encrypted_id."/".$encrypted_kode;
			$memo_link = site_url()."memo/pay_jual/".$encrypted_id."/".$encrypted_kode;
			$acc = '<button style="cursor: pointer;" class="btn btn-success" onclick="location.href='.$p.''.$acc_link.''.$p.'"> ACC </button>'; 
			$memo = '<button style="cursor: pointer;" class="btn btn-warning" onclick="location.href='.$p.''.$memo_link.''.$p.'"> MEMO </button>'; 
			$subject = $this->setting_model->Subject_pay().' Nomor '.$IDJual;
			$message = $this->load->view('mail')."".$this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini Pembayaran Invoice yang telah dibuat oleh ".$create." :<b><br><iframe src='".$print."' frameborder='0' height='250' width='100%'></iframe><br><b>Untuk ACC silahkan klik dibawah ini :</b><br>".$acc."<br><b>Untuk Memo Perbaikan silahkan klik dibawah ini :</b><br>".$memo."<br></div>".$this->setting_model->Footer_mail();
		// Email  
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->pajak_model->Emailinv($this->session->userdata('SESS_WP_ID'))); 
			$this->email->subject($subject); $this->email->message($message);
			$this->email->attach('files/pay_jual/Pay No.'.$id.'.pdf');// Lampiran
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim, <br>Terimakasih, Invoice yang anda buat menunggu diperiksa');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim, silahkan '.$email.' untuk mengirim ulang email <br>Terimakasih, Invoice yang anda buat menunggu diperiksa');}
			redirect('jual/view_pay/'.$id);
    }

// Acc Pay / Jurnal Bayar Jual
    function acc_pay($id){
        $id=$this->uri->segment(3); $kode=$this->uri->segment(4); $no_jurnal=$this->db->count_all('jurnal')+1; 
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual/pay');}
        if(!$kode){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Pembayaran.'); redirect('jual/pay');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('jual');}

		$data=array('status'=>'4','admin_id'=>$this->session->userdata('SESS_USER_ID')); $this->db->where('id',$id); $this->db->update('jual',$data);
		$info=array('bunker_id'=>$no_jurnal,'admin_id'=>$this->session->userdata('SESS_USER_ID')); $this->db->where('id',$kode); $this->db->update('jual_bayar',$info);
		
		date_default_timezone_set("Asia/Jakarta");
		$this->db->where('wp_id', $this->bbm_model->WPJual($id));  $this->db->where('voucher_id', '10');  $nomor_voucher=$this->db->count_all_results('jurnal')+1;
			$jurnal=array(
				'id' => no_jurnal, 'no' => $no_jurnal, 'voucher_id' => '10', 'no_voucher' => $nomor_voucher, 'customer_id' => $this->bbm_model->CustomerJual($id), 
				'tgl' => $this->bbm_model->TglBayarPenjualan($kode), 'tempo' => $this->bbm_model->TempoJual($id), 'f_id' => '1',
				'login_id' => $this->session->userdata('SESS_USER_ID'), 'user_id' => $this->session->userdata('SESS_USER_ID'), 'wp_id'=> $this->bbm_model->WPJual($id),
				'keterangan' => $this->bbm_model->KetBayarPenjualan($kode), 'waktu_post' => date("Y-m-d H:i:s") );
			$this->db->insert('jurnal',$jurnal);
			
		//Save Jurnal Detail
			//Total Jual / Bank
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal'));
			$jurnal_detail9=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => '1',
				'akun_id' => $this->bbm_model->AkunBayarPenjualan($kode),
				'kategori_id' => $this->akun_model->JenisAkun($this->bbm_model->AkunBayarPenjualan($kode)),
				'debit_kredit' => '1',
				'nilai' => $this->bbm_model->JmlBayarPenjualan($kode)
			);
			$this->db->insert('jurnal_detail',$jurnal_detail9);

			//AR - Piutang Penjualan
			$this->db->where('jurnal_detail', $this->db->count_all('jurnal'));
			$jurnal_detail9=array(
				'jurnal_id' => $this->db->count_all('jurnal'), 'item' => '2',
				'akun_id' => $this->akun_model->AkunJualBayar($this->bbm_model->WPJual($id)),
				'kategori_id' => $this->akun_model->JenisAkun($this->akun_model->AkunJualBayar($this->bbm_model->WPJual($id))),
				'debit_kredit' => '0',
				'nilai' => $this->bbm_model->JmlBayarPenjualan($kode)
			);
			$this->db->insert('jurnal_detail',$jurnal_detail9);

		// Notifikasi ACC
			$IDJual=$this->bbm_model->IDJual($id);
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$cetak= anchor(site_url()."jual/view_pay/".$id, ' CETAK ', $btn); $subject= 'Pembayaran Nomor '.$IDJual.' Telah Di Setujui (ACC)';
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>PO Telah Di Setujui (ACC):<b><br><b>Untuk Mencetak PO silahkan klik dibawah ini :</b><br>".$cetak."<br></div>".$this->setting_model->Footer_mail();
		// Pesan System
		if($this->pajak_model->Accpay($this->bbm_model->WPJual($id))=='0'){ }else{ 
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginBayarPenjualan($kode), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}
		// Email
		if($this->pajak_model->Emailpay($this->bbm_model->WPJual($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginBayarPenjualan($kode))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
		$this->session->set_userdata('SUCCESSMSG', 'Pembayaran Invoice Success. jurnal telah dibuat'); redirect('jual/view_pay/'.$id);
    }
	
// Memo Pay
    function memo_pay($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual/pay');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
		date_default_timezone_set("Asia/Jakarta");
        $data['title']="Memo Penerimaan Penjualan BBM"; $data['tgl']=date('Y-m-d'); $tgl=date('Y-m-d H:i:s'); $IDJual=$this->bbm_model->IDJual($id);
        $this->_set_rules(); if($this->form_validation->run()==true){
		// Notifikasi Memo
			$btn['class']='btn btn-success btn-flat'; $btn['style']='cursor: pointer;';
			$edit= anchor(site_url()."jual/edit_pay/".$id, ' EDIT ', $btn); $subject= 'Memo Perbaikan untuk Invoice Nomor '.$IDJual;
			$message= $this->setting_model->Header_mail()."<div class='row invoice-info text-center'><br><b>Berikut ini memo perbaikan yang dibuat :<b><br>".$this->input->post('pesan')."<br><b>Untuk Perbaikan silahkan klik dibawah ini :</b><br>".$edit."<br></div>".$this->setting_model->Footer_mail();
		if($this->pajak_model->Accpay($this->bbm_model->WPJual($id))=='0'){ }else{ 
			date_default_timezone_set("Asia/Jakarta"); $tgl=date('Y-m-d H:i:s');
			$info=array( 'id'=>'id', 'tgl'=>$tgl, 'kepada'=>$this->bbm_model->LoginBayar($id), 'judul'=>$subject, 'pesan'=>$message, 'dari'=>$this->session->userdata('SESS_USER_ID') );
			$this->m_pesan->simpan($info);
		}
		// email
		if($this->pajak_model->Emailpay($this->bbm_model->WPJual($id))==''){ }else{ 
			$config = array(); $config['charset'] = 'utf-8'; $config['useragent'] = 'Codeigniter';
			$config['protocol']= $this->setting_model->Protocol(); $config['mailtype']= "html";
			$config['smtp_host']= $this->setting_model->Host(); $config['smtp_port']= $this->setting_model->Port();
			$config['smtp_timeout']= "30"; $config['smtp_user']= $this->setting_model->Email(); $config['smtp_pass']= $this->setting_model->Password();
			$config['crlf']="\r\n"; $config['newline']="\r\n"; $config['wordwrap'] = TRUE;
			$this->email->initialize($config); $this->email->from($this->setting_model->Email());
			$this->email->to($this->user_model->EmailUser($this->bbm_model->LoginBayar($id))); 
			$this->email->subject($subject); $this->email->message($message);	
			if($this->email->send()){$this->session->set_userdata('SUCCESSMSG', 'Email Terkirim');}else{$this->session->set_userdata('SUCCESSMSG', 'Email Tidak Terkirim');}
		}
			$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Memo untuk perbaikan Penerimaan Penjualan BBM telah dikirim'); redirect('jual/view/'.$id);
        }else{
			$cek=$this->db->get_where('jual',array('id'=>$id)); $data['info']=$cek->row_array();
			$data['main_content'] = 'jual/memo_pay'; $this->load->view('lte/mail', $data);
        }
    }
    
// Hapus Pay
    function hapus_pay($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('jual/pay');}
		if($this->bbm_model->check_jual($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jual');}
		if($this->session->userdata('ADMIN')>'2'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf Anda tidak punya akses.'); redirect('jual');}
        $kode=$this->uri->segment(3); $data=array('cek'=>'1','login_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode); $this->db->update('jual_bayar',$data);
		date_default_timezone_set("Asia/Jakarta");
		$data_jurnal=array('keterangan'=>'Jurnal ini telah dihapus oleh '.$this->user_model->NamaUser($this->session->userdata('SESS_USER_ID'))
		.' pada tanggal '.date('d-m-Y').' Jam '.date('H:i'));
        $jurnal_id=$this->bbm_model->JurnalBayarPenjualan($kode);
		$this->db->where('id',$jurnal_id); $this->db->update('jurnal',$data_jurnal); $this->db->where('jurnal_id', $jurnal_id); $this->db->delete('jurnal_detail');
		$this->session->set_userdata('SUCCESSMSG', 'Data Penjualan dan Jurnal Telah dihapus.'); redirect('jual/view_pay/'.$this->bbm_model->IdPenjualan($kode));
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
	 
	 function ajaxCustomer(){
		  $search_term = $this->input->post('term');
        $search_result = $this->bbm_model->cari('customer', array('nama' => $search_term['term']));
        $suggestion_array = array();
        $suggestion_result = array();
        foreach ($search_result->result() as $result) {
            $suggestion_array['id'] = $result->id;
            $suggestion_array['text'] = $result->nama;
				array_push($suggestion_result, $suggestion_array);
		  }
		  echo json_encode($suggestion_result);
	 }
}