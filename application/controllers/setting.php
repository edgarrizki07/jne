<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	function Setting()
	{
		parent::__construct();
        $this->load->library(array('auth','template','form_validation','pagination','upload'));
		$this->auth->check_user_authentification();
		if($this->session->userdata('ADMIN')>'1'){ $this->session->set_userdata('SUCCESSMSG', 'Maaf anda tidak memiliki akses.'); redirect('home'); }
		
	}

	function index()	{
		$data['title']="Setting Aplikasi";
		$this->db->where("id","1");
		$data['data']=$this->db->get("setting")->result_array();
		$data['message']='';
		$data['main_content'] = 'setting/index'; $this->load->view('lte/live', $data);
	}
	
	function signature()	{
		$data['title']="Setting Aplikasi";
		$this->load->view('setting/signature', $data);
	}
	
	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$this->db->where(array("id"=>$id));
		$this->db->update("setting",array($modul=>$value));
		echo "{}";
	}

	function upload(){
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");

        //setting konfiguras upload image
        $config['upload_path'] = './uploads/setting/';
		$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
		$config['max_size']	= '100000';
		$config['max_width']  = '20000';
		$config['max_height']  = '10240';
                
		$this->upload->initialize($config);
		if(!$this->upload->do_upload($value)){ $gambar=""; }else{ $gambar=$this->upload->file_name; }
					   
		$this->db->where(array("id"=>'1'));
		$this->db->update("setting",array($modul=>$gambar));
		echo "{}";
	}

    function logo(){
        $data['title']="Logo Usaha";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
                            
			//setting konfiguras upload image
			$config['upload_path'] = './uploads/setting/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
			$config['max_size']	= '100000';
			$config['max_width']  = '20000';
			$config['max_height']  = '10240';
                
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('gambar')){ $gambar=""; }else{ $gambar=$this->upload->file_name; }
						   
            $logo=array( 'logo_1'=>$gambar );

            $this->setting_model->update($kode,$logo);
            
            $data['info']=$this->setting_model->cek('1')->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
			$data['main_content'] = 'setting/logo';
			$this->load->view('lte/live', $data);
        }else{
            $data['message']="";
            $data['info']=$this->setting_model->cek('1')->row_array();
			$data['main_content'] = 'setting/logo';
			$this->load->view('lte/live', $data);
        }
    }
    
    function photo(){
        $data['title']="Photo Pemilik";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
                            
			//setting konfiguras upload image
			$config['upload_path'] = './uploads/setting/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
			$config['max_size']	= '100000';
			$config['max_width']  = '20000';
			$config['max_height']  = '10240';
					
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('gambar')){ $gambar=""; }else{ $gambar=$this->upload->file_name; }
								   
			$logo=array( 'logo_2'=>$gambar );
			$this->setting_model->update($kode,$logo);
            
            $data['info']=$this->setting_model->cek('1')->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
			$data['main_content'] = 'setting/photo';
			$this->load->view('lte/live', $data);
        }else{
            $data['message']="";
            $data['info']=$this->setting_model->cek('1')->row_array();
			$data['main_content'] = 'setting/photo';
			$this->load->view('lte/live', $data);
        }
    }
    
    function header(){
        $data['title']="Header Surat";
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
                            
			//setting konfiguras upload image
			$config['upload_path'] = './uploads/setting/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
			$config['max_size']	= '100000';
			$config['max_width']  = '20000';
			$config['max_height']  = '10240';
                
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('gambar')){ $gambar=""; }else{ $gambar=$this->upload->file_name; }
                               
            $logo=array( 'header'=>$gambar );

            $this->setting_model->update($kode,$logo);
            
            $data['info']=$this->setting_model->cek('1')->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
			$data['main_content'] = 'setting/header';
			$this->load->view('lte/live', $data);
        }else{
            $data['message']="";
            $data['info']=$this->setting_model->cek('1')->row_array();
			$data['main_content'] = 'setting/header';
			$this->load->view('lte/live', $data);
        }
    }
    
    
    function _set_rules(){
        $this->form_validation->set_rules('kode','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}