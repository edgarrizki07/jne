<?php
class pesan extends CI_Controller{
    private $limit=10000;
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('auth','template','pagination','form_validation','upload','email'));
		$this->auth->check_user_authentification();
		$this->load->helper(array('form', 'url'));
        $this->load->model('m_pesan');
    }
    
    function index($offset=0,$order_column='id',$order_type='desc'){
		if($this->session->userdata('ADMIN')=='1'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['pesan']=$this->m_pesan->semua($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Pesan";
                
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else if($this->uri->segment(3)=="no_data")
            $data['message']="<div class='alert alert-success'>Data yang anda minta tidak ada</div>";
        else
            $data['message']='';
			$data['main_content'] = 'pesan/index';
			$this->load->view('lte/mail', $data);
		}else{
            redirect('pesan/masuk');
        }
    }
    

      public function email() { 
	
         $this->load->helper('form'); 
         $this->load->view('pesan/tes'); 
      } 
  
      public function send_mail() { 
         $from_email = "david@arungjagat.com"; 
         $to_email = $this->input->post('email'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'David'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test fom David'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
		 // show_error($this->email->print_debugger());
         else 
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
		 show_error($this->email->print_debugger());
         $this->load->view('pesan/tes'); 
      } 

	  function masuk($offset=0,$order_column='id',$order_type='desc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['pesan']=$this->m_pesan->masuk($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Pesan Masuk";
        
        $config['base_url']=site_url('pesan/index/');
        $config['total_rows']=$this->m_pesan->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Pesan Berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Pesan Berhasil dikirim</div>";
        else if($this->uri->segment(3)=="beck_success")
            $data['message']="<div class='alert alert-success'>Pesan Berhasil dikembalikan</div>";
        else if($this->uri->segment(3)=="no_data")
            $data['message']="<div class='alert alert-success'>Data yang anda minta tidak ada</div>";
        else
            $data['message']='';
			$data['main_content'] = 'pesan/masuk';
			$this->load->view('lte/mail', $data);
    }
    
    function keluar($offset=0,$order_column='id',$order_type='desc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['pesan']=$this->m_pesan->keluar($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Pesan Keluar";
        
        $config['base_url']=site_url('pesan/index/');
        $config['total_rows']=$this->m_pesan->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Pesan berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Pesan Berhasil dikirim</div>";
        else if($this->uri->segment(3)=="beck_success")
            $data['message']="<div class='alert alert-success'>Pesan Berhasil dikembalikan</div>";
        else if($this->uri->segment(3)=="no_data")
            $data['message']="<div class='alert alert-success'>Data yang anda minta tidak ada</div>";
        else
            $data['message']='';
			$data['main_content'] = 'pesan/keluar';
			$this->load->view('lte/mail', $data);
    }
    
    function sampah($offset=0,$order_column='id',$order_type='desc'){
        if(empty($offset)) $offset=0;
        if(empty($order_column)) $order_column='id';
        if(empty($order_type)) $order_type='asc';
        
        //load data
        $data['pesan']=$this->m_pesan->keluar($this->limit,$offset,$order_column,$order_type)->result();
        $data['title']="Pesan Sampah";
        
        $config['base_url']=site_url('pesan/index/');
        $config['total_rows']=$this->m_pesan->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Pesan berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Pesan Berhasil dikirim</div>";
        else if($this->uri->segment(3)=="no_data")
            $data['message']="<div class='alert alert-success'>Data yang anda minta tidak ada</div>";
        else
            $data['message']='';
			$data['main_content'] = 'pesan/sampah';
			$this->load->view('lte/mail', $data);
    }
    
	public function download()	{
		$kode = $this->uri->segment(3);
		$file = $this->m_pesan->Lampiran($kode);
		$data = file_get_contents("files/pesan/".$file); // Read the file's contents
		$name = $file;
		force_download($name, $data); 
	}
	    
    function tambah(){
		$this->load->helper('form');
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->library('email');

        $data['title']="Tulis Pesan";
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
        $data['noauto']=$this->m_pesan->nootomatis();
        $data['tgl']=date('Y-m-d H:i:s');
		$to=$this->user_model->EmailUser($this->input->post('kepada'));
		$subject=$this->input->post('judul');
		$message=$this->input->post('pesan');
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $id=$this->input->post('id');
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
                $data['message']="<div class='alert alert-warning'>Nomor Pesan sudah digunakan</div>";
				$data['main_content'] = 'pesan/tambah';
				$this->load->view('lte/mail', $data);
            }else{
                // $this->m_pesan->SendEmail($to,$subject,$message);
				//setting konfiguras upload image
                $config['upload_path'] = './files/pesan/';
				$config['allowed_types'] = 'exe|pdf|zip|rar|mp3|wav|avi|mpg|mpeg|mp4|doc|docx|xls|xlsx|ppt|pptx|bmp|gif|jpg|jpeg|png|jp2';
				$config['max_size']	= '100000';
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('lampiran')){
                    $lampiran="";
                }else{
                    $lampiran=$this->upload->file_name;
                }
                
                $info=array(
                    'id'=>$this->input->post('id'),
                    'tgl'=>$tgl,
                    'kepada'=>$this->input->post('kepada'),
                    'judul'=>$this->input->post('judul'),
                    'pesan'=>$this->input->post('pesan'),
                    'lampiran'=>$lampiran,
					'dari'=>$this->session->userdata('SESS_USER_ID')
                );
                $this->m_pesan->simpan($info);
				
                redirect('pesan/keluar/add_success');
            }
        }else{
            $data['message']="";
			$data['main_content'] = 'pesan/tambah';
			$this->load->view('lte/mail', $data);
        }
    }
    
    function tambah_email(){
        $data['title']="Tulis Pesan";
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
        $data['noauto']=$this->m_pesan->nootomatis();
        $data['tgl']=date('Y-m-d H:i:s');
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $id=$this->input->post('id');
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
                $data['message']="<div class='alert alert-warning'>Nomor Pesan sudah digunakan</div>";
				$data['main_content'] = 'pesan/tambah';
				$this->load->view('lte/mail', $data);
            }else{
		//konfigurasi email
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
		$config['protocol']= $this->m_pesan->Protocol();
		$config['mailtype']= "html";
		$config['smtp_host']= $this->m_pesan->Host();
		$config['smtp_port']= $this->m_pesan->Port();
		$config['smtp_timeout']= "15";
		$config['smtp_user']= $this->m_pesan->Email(); //isi dengan email kamu
		$config['smtp_pass']= $this->m_pesan->Password(); // isi dengan password kamu
		$config['crlf']="\r\n";
		$config['newline']="\r\n";
		
		$config['wordwrap'] = TRUE;
		//memanggil library email dan set konfigurasi untuk pengiriman email
		
		$this->email->initialize($config);
		//konfigurasi pengiriman
		$this->email->from($this->m_pesan->Email());
		$this->email->to($this->user_model->EmailUser($this->input->post('kepada')));
		$this->email->subject($this->input->post('judul'));
		$this->email->message($this->input->post('pesan'));

		//Configure upload.
		$this->upload->initialize(array(
		"upload_path"   => "./files/pesan/",
		"allowed_types" => "*"
		));
		
		//Perform upload.
		if($this->upload->do_multi_upload("lampiran")) {
            $lampiran=$this->upload->file_name;
			$lamp = $this->upload->get_multi_upload_data();
			foreach ($lamp as $key=>$value){
				$this->email->attach($value['full_path']); //mengambil path dari attachmen yang di upload
			}
		}else {
		}

		//Status Kirim
		if($this->email->send()){
			$this->session->set_userdata('SUCCESSMSG', 'Berhasil mengirim email.'); $status='1';
		}else{
			$this->session->set_userdata('SUCCESSMSG', 'Gagal mengirim email.'); $status='0';
		}
                //setting konfiguras upload image
                // $config['upload_path'] = './files/pesan/';
				// $config['allowed_types'] = 'exe|pdf|zip|rar|mp3|wav|avi|mpg|mpeg|mp4|doc|docx|xls|xlsx|ppt|pptx|bmp|gif|jpg|jpeg|png|jp2';
				// $config['max_size']	= '100000';
                
                // $this->upload->initialize($config);
                // if(!$this->upload->do_upload('lampiran')){
                    // $lampiran="";
                // }else{
                    // $lampiran=$this->upload->file_name;
                // }
                
                $info=array(
                    'id'=>$this->input->post('id'),
                    'tgl'=>$tgl,
                    'kepada'=>$this->input->post('kepada'),
                    'judul'=>$this->input->post('judul'),
                    'pesan'=>$this->input->post('pesan'),
                    'lampiran'=>$lampiran,
					'dari'=>$this->session->userdata('SESS_USER_ID')
                );
                $this->m_pesan->simpan($info);
                redirect('pesan/keluar/add_success');
            }
        }else{
            $data['message']="";
			$data['main_content'] = 'pesan/tambah';
			$this->load->view('lte/mail', $data);
        }
    }
    
    function baca($id){
        if(!$id){redirect('pesan');}
        $tes=$this->db->get_where('pesan',array('id'=>$id,'kepada'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/masuk'); }
        $data['title']="Lihat Pesan";
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
        $kode=$this->uri->segment(3);
        $this->m_pesan->baca($kode);
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $id=$this->input->post('id');
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
                $data['message']="<div class='alert alert-warning'>Nomor Pesan sudah digunakan</div>";
				$data['main_content'] = 'pesan/tambah';
				$this->load->view('lte/mail', $data);
            }else{
                //setting konfiguras upload image
                $config['upload_path'] = './files/pesan/';
				$config['allowed_types'] = 'exe|pdf|zip|rar|mp3|wav|avi|mpg|mpeg|mp4|doc|docx|xls|xlsx|ppt|pptx|bmp|gif|jpg|jpeg|png|jp2';
				$config['max_size']	= '100000';
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('lampiran')){
                    $lampiran="";
                }else{
                    $lampiran=$this->upload->file_name;
                }
                
                $info=array(
                    'id'=>$this->input->post('id'),
                    'tgl'=>$tgl,
                    'kepada'=>$this->input->post('kepada'),
                    'judul'=>$this->input->post('judul'),
                    'pesan'=>$this->input->post('pesan'),
                    'lampiran'=>$lampiran,
					'dari'=>$this->session->userdata('SESS_USER_ID')
                );
                $this->m_pesan->simpan($info);
                redirect('pesan/keluar/add_success');
            }

        }else{
            $data['message']="";
            $data['pesan']=$this->m_pesan->cek($id)->row_array();
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
				$data['main_content'] = 'pesan/lihat';
				$this->load->view('lte/mail', $data);
            }else{
                redirect('pesan/masuk/no_data');
            }
        }
    }
    
    function lihat($id){
        if(!$id){redirect('pesan');}
        $tes=$this->db->get_where('pesan',array('id'=>$id,'dari'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/keluar'); }
        $data['title']="Lihat Pesan";
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('Y-m-d H:i:s');
        $kode=$this->uri->segment(3);
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $id=$this->input->post('id');
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
                $data['message']="<div class='alert alert-warning'>Nomor Pesan sudah digunakan</div>";
				$data['main_content'] = 'pesan/tambah';
				$this->load->view('lte/mail', $data);
            }else{
                //setting konfiguras upload image
                $config['upload_path'] = './files/pesan/';
				$config['allowed_types'] = 'exe|pdf|zip|rar|mp3|wav|avi|mpg|mpeg|mp4|doc|docx|xls|xlsx|ppt|pptx|bmp|gif|jpg|jpeg|png|jp2';
				$config['max_size']	= '100000';
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('lampiran')){
                    $lampiran="";
                }else{
                    $lampiran=$this->upload->file_name;
                }
                
                $info=array(
                    'id'=>$this->input->post('id'),
                    'tgl'=>$tgl,
                    'kepada'=>$this->input->post('kepada'),
                    'judul'=>$this->input->post('judul'),
                    'pesan'=>$this->input->post('pesan'),
                    'lampiran'=>$lampiran,
					'dari'=>$this->session->userdata('SESS_USER_ID')
                );
                $this->m_pesan->simpan($info);
                redirect('pesan/keluar/add_success');
            }

        }else{
            $data['message']="";
            $data['pesan']=$this->m_pesan->cek($id)->row_array();
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
				$data['main_content'] = 'pesan/lihat';
				$this->load->view('lte/mail', $data);
            }else{
                redirect('pesan/masuk/no_data');
            }
        }
    }
    
    function cetak_in($id){
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Pesan.'); redirect('pesan/masuk');}
        $tes=$this->db->get_where('pesan',array('id'=>$id,'kepada'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/masuk'); }
		$data['title'] = "Cetak Pesan";
		$data['main_content'] = 'pesan/print';
		$data['pesan']=$this->m_pesan->cek($id)->row_array();
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
				$this->load->view('lte/cetak',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Pesan yang anda pilih tidak ada.');
                redirect('pesan');
            }
    }
    
    function cetak_out($id){
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Pesan.'); redirect('pesan/keluar');}
        $tes=$this->db->get_where('pesan',array('id'=>$id,'dari'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/keluar'); }
		$data['title'] = "Cetak Pesan";
		$data['main_content'] = 'pesan/print';
		$data['pesan']=$this->m_pesan->cek($id)->row_array();
            $cek=$this->m_pesan->cek($id);
            if($cek->num_rows()>0){
				$this->load->view('lte/cetak',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Pesan yang anda pilih tidak ada.');
                redirect('pesan');
            }
    }
    
    function hapus_inbox(){
        $kode=$this->uri->segment(3);
        $tes=$this->db->get_where('pesan',array('id'=>$kode,'kepada'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/masuk'); }
        $this->db->where('id',$kode);
		$data=array('cekdari'=>'1');
        $this->db->update('pesan',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pesan/masuk/delete_success'>";			
    }
    
    function kembali_inbox(){
        $kode=$this->uri->segment(3);
        $tes=$this->db->get_where('pesan',array('id'=>$kode,'kepada'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/masuk'); }
        $this->db->where('id',$kode);
		$data=array('cekdari'=>'0');
        $this->db->update('pesan',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pesan/masuk/beck_success'>";			
    }
    
    function hapus_outbox(){
        $kode=$this->uri->segment(3);
        $tes=$this->db->get_where('pesan',array('id'=>$kode,'dari'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/keluar'); }
        $this->db->where('id',$kode);
		$data=array('cekkepada'=>'1');
        $this->db->update('pesan',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pesan/keluar/delete_success'>";			
    }
    
    function kembali_outbox(){
        $kode=$this->uri->segment(3);
        $tes=$this->db->get_where('pesan',array('id'=>$kode,'dari'=>$this->session->userdata('SESS_USER_ID')));
		if($tes->num_rows()<1){ $this->session->set_userdata('SUCCESSMSG', 'Maaf bukan Pesan Milik Anda.'); redirect('pesan/keluar'); }
        $this->db->where('id',$kode);
		$data=array('cekkepada'=>'0');
        $this->db->update('pesan',$data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."pesan/keluar/beck_success'>";			
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id','id','required|max_length[10]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}