<?php

class Login extends CI_Controller {

	function Login()
	{
		parent::__construct();	
	}
	
	function index()
	{
		$cont1=$this->uri->segment(3); 
		$cont2=$this->uri->segment(4); 
		$cont3=$this->uri->segment(5); 
		$this->load->view('login_form');
		// $this->load->view('login');
	}

	function login_exec()
	{
		if (!$this->_user_validation())
		{
			$this->session->set_userdata('ERRMSG_ARR', validation_errors());
			$this->index();
		}
		else
		{
			$this->load->model('user_model');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$query = $this->user_model->validate_login($username, $password);
			
			if($query->num_rows == 1)
			{
				$row = $query->row();
				$data = array(
					'SESS_USER_ID' => $row->id,
					'SESS_WP_ID' => $row->wp_id,
					'SESS_FIRST_NAME' => $row->nama_depan,
					'SESS_LAST_NAME' => $row->nama_belakang,
					'ADMIN' => $row->administrator
				);
				$this->session->set_userdata($data);
				$ip=$_SERVER['REMOTE_ADDR'];
				date_default_timezone_set("Asia/Jakarta");
				$this->db->insert('login_history',array('tgl'=>date('Y-m-d H:i:s'),'user_id'=>$this->session->userdata('SESS_USER_ID'),'wp_id'=>$this->session->userdata('SESS_WP_ID'),'ip_address'=>$ip,'nama'=>$this->session->userdata('SESS_FIRST_NAME'),'level'=>$this->session->userdata('ADMIN')));
				if($this->input->post('link')=='//'){ redirect('home'); }else{ redirect($this->input->post('link')); }
				// redirect('home');
			}
			else // incorrect username or password
			{
				$data = array(
					'SESS_LOGIN_STATEMENT' => 'Login Gagal ;)',
					'ERRMSG_ARR' => "Username dan/atau Password salah !"
				);
				$this->session->set_userdata($data);
				redirect('login');
			}
		}
	}

	function _user_validation()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		return $this->form_validation->run();
	}

	function logout()
	{
		$this->session->unset_userdata('SESS_USER_ID');
		$this->session->unset_userdata('SESS_FIRST_NAME');
		$this->session->unset_userdata('SESS_LAST_NAME');
		$this->session->unset_userdata('SESS_WP_ID');
		$this->session->unset_userdata('SESS_LAST_NAME');
		$this->session->unset_userdata('ADMIN');
		$this->session->set_userdata('SESS_LOGIN_STATEMENT', 'Anda Telah Logout ;)');
		redirect('login');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
