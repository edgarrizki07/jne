<?php

class User extends CI_Controller {

	function User()
	{
		parent::__construct();
        $this->load->library(array('auth','template','form_validation','pagination','upload'));
		$this->auth->check_user_authentification();
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Maaf anda tidak memiliki akses.'); redirect('home'); }
	}
	
	function index()
	{
		if($this->session->userdata('ADMIN')>='2'){ $this->user_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$data['title'] = "User";
		$data['main_content'] = 'user/display';
		$data['user_data'] = $this->user_model->get_all_data();
		$this->load->view('lte/live', $data);
	}

	function add()
	{
		$data['title'] = "Tambah User";
		$data['main_content'] = 'user/form';
		$data['act'] = 'add';
		$data['form_act'] = 'insert';
		$data['user_data'] = FALSE;
		$data['user_groups'] = $this->user_model->get_user_administrator();
		$data['cabang_groups'] = $this->user_model->get_user_cabang();
		$data['wp_groups'] = $this->pajak_model->get_cabang();
		$this->load->view('lte/live', $data);
	}

	function view()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu User.'); redirect('user');}
		if($this->bbm_model->check_login($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('user');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$data['title'] = "Lihat Pengguna";
		$data['info']=$this->user_model->cek($id)->row_array();
		$data['main_content'] = 'user/view';
		$this->load->view('lte/live', $data);
	}

	function edit()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu User.'); redirect('user');}
		if($this->bbm_model->check_login($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('user');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$data['title'] = "Edit Pengguna";
		$data['main_content'] = 'user/form';
		$data['act'] = 'edit';
		$data['form_act'] = 'update/'.$id;
		$data['user_data'] = $this->user_model->get_data_by_id($id);
		$data['user_groups'] = $this->user_model->get_user_administrator();
		$data['wp_groups'] = $this->pajak_model->get_cabang();
		$this->load->view('lte/live', $data);
	}

	function insert()
	{
		if (!$this->_user_validation())
		{
			$this->session->set_userdata('ERRMSG_ARR', 'password harus sama');
			$this->add();
		}
		else
		{
			$this->user_model->fill_data();
			//Cek Login
			if(!$this->user_model->check_username())
			{
				$this->session->set_userdata('ERRMSG_ARR', 'Username telah digunakan, silahkan buat Username lain');
				$this->add();
			}
			//Insert Data
			elseif($this->user_model->insert_data()) 
			{
				$this->session->set_userdata('SUCCESSMSG', 'Register pengguna baru sukses ;)');
				redirect('user');
			}
		}
	}

	function update()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu User.'); redirect('user');}
		if($this->bbm_model->check_login($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('user');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		if (!$this->_user_validation(1))
		{
			$this->session->set_userdata('ERRMSG_ARR', 'password harus sama');
			$this->edit();
		}
		else
		{
			$this->user_model->fill_data();
			//Cek Login
			if(!$this->user_model->check_username($id))
			{
				$this->session->set_userdata('ERRMSG_ARR', 'Username telah digunakan');
				$this->edit();
			}
			//Update Data
			elseif($this->user_model->update_data($id))
			{
				$this->session->set_userdata('SUCCESSMSG', 'Update pengguna sukses');
				if(!$this->session->userdata('ADMIN'))
				{
					redirect('user/edit/'.$id);
				}
				else
				{
					redirect('user');
				}
			}
		}
	}

    function lock($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu ID.'); redirect('user');}
		if($this->bbm_model->check_login($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('user');}
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('user');}
        $data=array('aktif'=>'0'); $this->db->where('id',$id); $this->db->update('login',$data);
		$this->session->set_userdata('SUCCESSMSG', 'User telah di non aktif-kan.'); redirect('user');
    }
    
    function key($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu ID.'); redirect('user');}
		if($this->bbm_model->check_login($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('user');}
		if($this->session->userdata('ADMIN')>'2'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('user');}
        $data=array('aktif'=>'1'); $this->db->where('id',$id); $this->db->update('login',$data);
		$this->session->set_userdata('SUCCESSMSG', 'User telah di aktif-kan lagi.'); redirect('user');
    }
    
	function delete()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu User.'); redirect('user');}
		if($this->bbm_model->check_login($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('user');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		if($this->session->userdata('ADMIN')>='3'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('user');}
		$user_data = $this->user_model->get_data_by_id($id);
		if($this->user_model->delete_data($id))
		{
			$msg = 'SUKSES # User '.$user_data['nama_depan'].' '.$user_data['nama_belakang'].' telah dihapus.';
		}
		else
		{
			$msg .= 'ERROR # Terjadi kesalahan dalam menghapus data user '.$user_data['nama_depan'].' '.$user_data['nama_belakang'].'. Harap coba lagi.';
		}
		$this->session->set_userdata('SUCCESSMSG', ''.$msg);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."user'>";				
	}

	function _user_validation($edit=0)
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_underscores');
		if($edit)
		{
			$this->form_validation->set_rules('password', 'Password', 'trim|matches[cpassword]');
		}
		else
		{
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');
			$this->form_validation->set_rules('cpassword', 'Ulangi Password', 'trim|required');
		}

		return $this->form_validation->run();
	}

}
/* End of file user.php */
/* Location: ./application/controllers/user.php */
