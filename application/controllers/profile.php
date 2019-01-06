<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function Profile()
	{
		parent::__construct();
        $this->load->library(array('template','form_validation','pagination','upload'));
		$this->load->library('auth');
		$this->auth->check_user_authentification();
		$this->load->model('setting_model');
	}

	public function index()	{
		$data['title']="Profile";
        $id=$this->session->userdata('SESS_USER_ID');
            $data['info']=$this->user_model->cek($id)->row_array();
        if($this->uri->segment(3)=="delete_success")
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if($this->uri->segment(3)=="add_success")
            $data['message']="<div class='alert alert-success'>Data berhasil disimpan</div>";
        else
            $data['message']='';
		$data['main_content'] = 'profile/index';
		$this->load->view('lte/live', $data);
	}
	
    function edit(){
        $data['title']="Profile";
        $id=$this->session->userdata('SESS_USER_ID');
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
			$pwd 	= $this->input->post('password');
                            
            $info1=array(
                    'username'=>$this->input->post('username'),
                    'nama_depan'=>$this->input->post('nama_depan'),
                    'nama_belakang'=>$this->input->post('nama_belakang'),
                    'jk'=>$this->input->post('jk'),
                    'kota'=>$this->input->post('kota'),
                    'tgl'=>$this->input->post('tgl'),
                    'alamat'=>$this->input->post('alamat'),
                    'telp'=>$this->input->post('telp'),
                    'hp'=>$this->input->post('hp'),
                    'email'=>$this->input->post('email'),
                    'rekening'=>$this->input->post('rekening'),
                    'keterangan'=>$this->input->post('keterangan')
            );

            $info2=array(
					'password'=>md5($pwd),
                    'username'=>$this->input->post('username'),
                    'nama_depan'=>$this->input->post('nama_depan'),
                    'nama_belakang'=>$this->input->post('nama_belakang'),
                    'jk'=>$this->input->post('jk'),
                    'kota'=>$this->input->post('kota'),
                    'tgl'=>$this->input->post('tgl'),
                    'alamat'=>$this->input->post('alamat'),
                    'telp'=>$this->input->post('telp'),
                    'hp'=>$this->input->post('hp'),
                    'email'=>$this->input->post('email'),
                    'rekening'=>$this->input->post('rekening'),
                    'keterangan'=>$this->input->post('keterangan')
            );

			if(empty($pwd)){
				$this->user_model->update($kode,$info1);
			}else{
				$this->user_model->update($kode,$info2);
			}
            
            $data['info']=$this->user_model->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
			$data['main_content'] = 'profile/edit';
			$this->load->view('lte/live', $data);
        }else{
            $data['message']="";
            $data['info']=$this->user_model->cek($id)->row_array();
			$data['main_content'] = 'profile/edit';
			$this->load->view('lte/live', $data);
        }
    }
    
    function photo(){
        $data['title']="photo";
        $id=$this->session->userdata('SESS_USER_ID');
        $this->_set_rules();
        if($this->form_validation->run()==true){
            $kode=$this->input->post('kode');
                            
        //setting konfiguras upload image
        $config['upload_path'] = './images/photo/profile';
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
                    'photo'=>$gbr
            );

            $this->user_model->update($kode,$semua);
            
            $data['info']=$this->user_model->cek($id)->row_array();
            $data['message']="<div class='alert alert-success'>Data berhasil diupdate</div>";
			$data['main_content'] = 'profile/photo';
			$this->load->view('lte/live', $data);
        }else{
            $data['message']="";
            $data['info']=$this->user_model->cek($id)->row_array();
			$data['main_content'] = 'profile/photo';
			$this->load->view('lte/live', $data);
        }
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('kode','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}