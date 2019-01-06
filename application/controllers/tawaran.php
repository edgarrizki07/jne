<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tawaran extends CI_Controller {

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
	}
    
	function index()	{
		$data['title']="Penawaran";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$tawaran = $this->db->get_where('tawaran',array('cek'=>'0'));
		$data['info'] = $tawaran->result();
		$data['main_content'] = 'tawaran/index';
		$this->load->view('lte/live', $data);
	}
	
	function rekap()	{
		$data['title']="Rekap Penawaran";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$tawaran = $this->db->get_where('tawaran',array('cek'=>'0'));
		$data['info'] = $tawaran->result();
		$data['main_content'] = 'tawaran/rekap';
		$this->load->view('lte/live_proyek', $data);
	}
	
	function filter()	{
		$data['title']="Rekap Penawaran";
		$this->load->helper('indodate');
		$cabang = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('tawaran/rekap/');}
		  if($this->uri->segment(4)==''){
			$this->db->where('tgl >=', '2000-01-01');;
			$this->db->where('tgl <=', '2100-01-01');;
		  }else{
			$this->db->where('tgl >=', $from);;
			$this->db->where('tgl <=', $to);;
		  }
		if($this->uri->segment(3)=='0'){ }else{ $this->db->where('wp_id', $cabang); }	
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='tgl',$order_type='asc');
		$data['info'] = $this->db->get_where('tawaran',array('cek'=>'0'));
		$data['main_content'] = 'tawaran/filter';
		$this->load->view('lte/live_proyek', $data);
	}
	
	function filter_pdf()	{
		$data['title']="Rekap Penawaran";
		$this->load->helper('indodate');
		$cabang = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('tawaran/rekap/');}
		  if($this->uri->segment(4)==''){
			$this->db->where('tgl >=', '2000-01-01');;
			$this->db->where('tgl <=', '2100-01-01');;
		  }else{
			$this->db->where('tgl >=', $from);;
			$this->db->where('tgl <=', $to);;
		  }
		if($this->uri->segment(3)=='0'){ }else{ $this->db->where('wp_id', $cabang); }	
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='tgl',$order_type='asc');
		$data['isi'] = $this->db->get_where('tawaran',array('cek'=>'0'));
        $cek=$this->db->get_where('tawaran',array('cek'=>'0'));
		$data['info']=$cek->row_array();
		$this->load->view('tawaran/filter_pdf', $data);
	}
	
	function filter_excel()	{
		$data['title']="Rekap Penawaran";
		$this->load->helper('indodate');
		$cabang = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if($from > $to){$this->session->set_userdata('SUCCESSMSG', 'Tanggal yang anda pilih salah.'); redirect('tawaran/rekap/');}
		  if($this->uri->segment(4)==''){
			$this->db->where('tgl >=', '2000-01-01');;
			$this->db->where('tgl <=', '2100-01-01');;
		  }else{
			$this->db->where('tgl >=', $from);;
			$this->db->where('tgl <=', $to);;
		  }
		if($this->uri->segment(3)=='0'){ }else{ $this->db->where('wp_id', $cabang); }	
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='tgl',$order_type='asc');
		$data['isi'] = $this->db->get_where('tawaran',array('cek'=>'0'));
        $cek=$this->db->get_where('tawaran',array('cek'=>'0'));
		$data['info']=$cek->row_array();
		$this->load->view('tawaran/filter_excel', $data);
	}
	
	function cancel()	{
		$data['title']="Cancel Penawaran";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id_tawaran',$order_type='desc');
		$tawaran = $this->db->get_where('tawaran',array('cek'=>'1'));
		$data['info'] = $tawaran->result();
		$data['main_content'] = 'tawaran/index';
		$this->load->view('lte/live', $data);
	}
	
    function add(){
        $data['title']="Penawaran";
        $data['tgl']=date('Y-m-d'); $tgl=date('Ymd');
		$thn=date('Y'); $this->db->where('year(tgl)', $thn); 
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID'));  $data['no']=$this->db->count_all_results('tawaran')+1;
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
                		
			$h1	= $this->input->post('harga');//10000
			$cek_harga	= $this->input->post('cek_harga');
			$ppn 	= $this->input->post('ppn');//1
			$pbbkb 	= $this->input->post('pbbkb');//0
			$npbbkb = $this->input->post('npbbkb');//0
			$pph 	= $this->input->post('pph');//0
			$oat 	= $this->input->post('oat');//0
			if($cek_harga=='0'){ $harga = $h1; $include = ($h1+$oat($h1*(($ppn*10)/100))+($h1*(($pbbkb*$npbbkb)/100))+($h1*(($pph*0.3)/100)));
			}else{ $harga = ((($h1-$oat)/(100+($ppn*10)+($pph*0.3)+($pbbkb*$npbbkb)))*100); $include = $h1; } //include
			// $include		11000 		= (10000+(10000*((1*10)/100))+(10000*((0*0)/100))+(10000*((0*0.3)/100)));
			// $harga		9090,909091 = ((10000/(100+(1*10)+(0*0)+(0*0.3)))*100);

                $info=array(
                    'id'=>$this->input->post('id'),
                    'id_tawaran'=>$this->input->post('id_tawaran'),
                    'customer_id'=>$this->input->post('customer_id'),
                    'tgl'=>$this->input->post('tgl'),
                    'perihal'=>$this->input->post('perihal'),
                    'lampiran'=>$this->input->post('lampiran'),
                    'produk'=>$this->input->post('produk'),
                    'include'=>$include,
                    'harga'=>$harga,
                    'ppn'=>$ppn,
                    'npbbkb'=>$npbbkb,
                    'pbbkb'=>$pbbkb,
                    'pph'=>$pph,
                    'oat'=>$oat,
                    'isi2'=>$this->input->post('isi2'),
                    'isi3'=>$this->input->post('isi3'),
                    'isi4'=>$this->input->post('isi4'),
                    'isi5'=>$this->input->post('isi5'),
                    'pembayaran'=>$this->input->post('pembayaran'),
                    'bank'=>$this->input->post('bank'),
                    'namarek'=>$this->input->post('namarek'),
                    'rekening'=>$this->input->post('rekening'),
                    'isi6'=>$this->input->post('isi6'),
                    'isi7'=>$this->input->post('isi7'),
                    'isi8'=>$this->input->post('isi8'),
                    'tembusan'=>$this->input->post('tembusan'),
                    'tembusan1'=>$this->input->post('tembusan1'),
                    'tembusan2'=>$this->input->post('tembusan2'),
					'wp_id'=> $this->session->userdata('SESS_WP_ID'),
					'login_id'=> $this->session->userdata('SESS_USER_ID')
                );
				$this->db->insert('tawaran',$info);
												
				$this->session->set_userdata('SUCCESSMSG', 'Terimakasih, Surat Penawaran yang anda buat telah diterbitkan');
                redirect('tawaran/view/'.$this->db->count_all_results('tawaran'));

        }else{
            $data['message']="";
			$data['main_content'] = 'tawaran/add';
			$this->load->view('lte/live', $data);
        }
    }
    
    function view($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('tawaran');}
		if($this->bbm_model->check_tawaran($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('tawaran');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
        $data['title']="Penawaran BBM";
        $cek=$this->db->get_where('tawaran',array('id'=>$id));
		$data['info']=$cek->row_array();
		$data['main_content'] = 'tawaran/view';
		$this->load->view('lte/live', $data);
    }
                        
    function pdf($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('tawaran');}
		if($this->bbm_model->check_tawaran($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('tawaran');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
        $data['title']="Penawaran BBM";
        $cek=$this->db->get_where('tawaran',array('id'=>$id));
		$data['info']=$cek->row_array();
			$this->load->view('tawaran/pdf',$data);
    }
                        
    function hapus(){
        $kode=$this->uri->segment(3);
        if(!$kode){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('tawaran');}
		if($this->bbm_model->check_tawaran($kode)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('tawaran');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		if($this->session->userdata('ADMIN')>='3'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('tawaran');}
		$data=array('cek'=>'1','login_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode);
		$this->db->update('tawaran',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tawaran'>";			
    }
    
	function list_po()	{
		$data['title']="Daftar PO Masuk";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$tawaran = $this->db->get_where('po',array('cek'=>'0'));
		$data['info'] = $tawaran->result();
		$data['main_content'] = 'tawaran/list_po';
		$this->load->view('lte/live', $data);
	}
	
    function view_po($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('tawaran/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('tawaran/list_po');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
        $data['title']="PO Masuk";
        $cek=$this->db->get_where('po',array('id'=>$id));
		$data['info']=$cek->row_array();
		$data['main_content'] = 'tawaran/view_po';
		$this->load->view('lte/live', $data);
    }
                        
    function pdf_po($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('tawaran/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('tawaran/list_po');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
        $data['title']="PO Masuk";
        $cek=$this->db->get_where('po',array('id'=>$id));
		$data['info']=$cek->row_array();
			$this->load->view('tawaran/pdf_po',$data);
    }
                        
    function hapus_po(){
        $kode=$this->uri->segment(3);
        if(!$kode){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('tawaran/list_po');}
		if($this->bbm_model->check_po($kode)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('tawaran/list_po');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		if($this->session->userdata('ADMIN')>='3'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('tawaran');}
		$data=array('cek'=>'1','login_id'=>$this->session->userdata('SESS_USER_ID'));
		$this->db->where('id',$kode);
		$this->db->update('po',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."tawaran/list_po'>";			
    }
    
    function add_po(){
        $data['title']="PO Masuk";
        $data['tgl']=date('Y-m-d');
		$tgl=date('Ymd');
		$thn=date('Y'); $this->db->where('year(tgl)', $thn); 
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); 
        $data['no']=$this->db->count_all_results('po')+1;
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			
			//setting konfiguras upload File PO
        $config['upload_path'] = './files/so/';
		$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
		$config['max_size']	= '100000';
		$config['max_width']  = '20000';
		$config['max_height']  = '10240';
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('filepo')){
                    $filepo="";
                }else{
                    $filepo=$this->upload->file_name;
                }
                               
            
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

			$info=array( 
				'id'=>$this->input->post('id'), 'id_po'=>$this->input->post('id_po'), 'tgl'=>$tgl, 
				'nopo'=>$this->input->post('nopo'), 'tglpo'=>$this->input->post('tglpo'), 'filepo'=>$filepo, 'sales'=>$this->input->post('sales'),
				'term'=>$this->input->post('term'), 'carrier'=>$this->input->post('carrier'), 'tempo'=>$this->input->post('tempo'), 'customer_id'=>$this->input->post('customer_id'), 'jml'=>$this->input->post('jml'),
				'tglkirim'=>$tgl, 'migas'=>'0.3', 'pph21'=>'3', 
				'harga'=>$harga, 'discount'=>$discount, 'ohp'=>$ohp, 'ppnohp'=>$ppnohp, 'ppn'=>$ppn, 'npbbkb'=>$npbbkb, 'pbbkb'=>$pbbkb, 'pph'=>$pph,
				'tot1'=>$tot1, 'tot2'=>$tot2, 'tot3'=>$tot3, 'tot4'=>$tot4, 'tot5'=>$tot5, 'tot6'=>$tot6, 'tot7'=>$tot7, 'tot8'=>$tot8, 'tot9'=>$tot9,				
				'terbilang'=>$this->input->post('terbilang'), 'wp_id'=> $this->session->userdata('SESS_WP_ID'), 'login_id'=> $this->session->userdata('SESS_USER_ID') );
			$this->db->insert('po',$info);
		
			$this->session->set_userdata('SUCCESSMSG', 'tambah Success.');
			redirect('tawaran/view_po/'.$this->db->count_all_results('po'));

        }else{
            $data['message']="";
			$data['main_content'] = 'tawaran/add_po';
			$this->load->view('lte/live', $data);
        }
    }
    
    function edit_po($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu  Transaksi Penjualan.'); redirect('tawaran/list_po');}
		if($this->bbm_model->check_po($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('tawaran/list_po');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
        $data['title']="PO Masuk";
        $data['tgl']=date('Y-m-d');
		$tgl=date('Ymd');
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); 
        $data['no']=$this->db->count_all_results('po')+1;
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			               
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
			$info=array( 
				'nopo'=>$this->input->post('nopo'), 'tglpo'=>$this->input->post('tglpo'), 'sales'=>$this->input->post('sales'),
				'term'=>$this->input->post('term'), 'carrier'=>$this->input->post('carrier'), 'tempo'=>$this->input->post('tempo'), 'customer_id'=>$this->input->post('customer_id'), 'jml'=>$this->input->post('jml'),
				'harga'=>$harga, 'discount'=>$discount, 'ohp'=>$ohp, 'ppnohp'=>$ppnohp, 'ppn'=>$ppn, 'npbbkb'=>$npbbkb, 'pbbkb'=>$pbbkb, 'pph'=>$pph,
				'tot1'=>$tot1, 'tot2'=>$tot2, 'tot3'=>$tot3, 'tot4'=>$tot4, 'tot5'=>$tot5, 'tot6'=>$tot6, 'tot7'=>$tot7, 'tot8'=>$tot8, 'tot9'=>$tot9,				
				'terbilang'=>$this->input->post('terbilang'), 'wp_id'=> $this->session->userdata('SESS_WP_ID'), 'login_id'=> $this->session->userdata('SESS_USER_ID') );
			$this->db->where('id',$id); $this->db->update('po',$info);
		
			$this->session->set_userdata('SUCCESSMSG', 'edit Success.');
			redirect('tawaran/view_po/'.$id);

        }else{
            $data['message']=""; $cek=$this->db->get_where('po',array('id'=>$id)); $data['info']=$cek->row_array();
			$data['main_content'] = 'tawaran/edit_po';
			$this->load->view('lte/live', $data);
        }
    }
    
    function edit_filepo($id){
        $data['title']="File PO";
        $this->_set_rules(); if($this->form_validation->run()==true){
            $id=$this->input->post('id');
			//setting konfigurasi upload File PO
        $config['upload_path'] = './files/so/';
		$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
		$config['max_size']	= '100000';
		$config['max_width']  = '20000';
		$config['max_height']  = '10240';
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('gbr')){
                    $gbr="";
                }else{
                    $gbr=$this->upload->file_name;
                }
                               
            $semua=array(
                    'filepo'=>$gbr
            );

			$this->db->where('id',$id); $this->db->update('po',$semua);
            
			$this->session->set_userdata('SUCCESSMSG', 'edit Success.');
			redirect('tawaran/view_po/'.$id);
        }else{
            $data['message']=""; $cek=$this->db->get_where('po',array('id'=>$id)); $data['info']=$cek->row_array();
			$data['main_content'] = 'tawaran/edit_filepo';
			$this->load->view('lte/live', $data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}