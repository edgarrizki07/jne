<?php

class Customer extends CI_Controller {

	function Customer()
	{
		parent::__construct();	
		$this->load->library('auth');
		$this->auth->check_user_authentification();
		$this->load->model('customer_model');		
	}
	
	function index()
	{
		$data['title'] = "Customer";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$data['client_data'] = $this->db->get_where('customer',array('status'=>'0','cek'=>'0'))->result();
		$result = $this->db->get_where('customer',array('status'=>'0','cek'=>'0'))->result();
		$data['main_content'] = 'customer/display';
		$this->load->view('lte/live', $data);
	}

	function baru()
	{
		$data['title'] = "Customer";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$data['client_data'] = $this->db->get_where('customer',array('status'=>'1','cek'=>'0'))->result();
		$data['main_content'] = 'customer/display';
		$this->load->view('lte/live', $data);
	}

	function terhapus()
	{
		$data['title'] = "Customer";
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$data['client_data'] = $this->db->get_where('customer',array('cek'=>'1'))->result();
		$data['main_content'] = 'customer/display';
		$this->load->view('lte/live', $data);
	}

	function add()
	{
		$this->db->where('wp_id', $this->session->userdata('SESS_WP_ID'));  $no_customer=$this->db->count_all_results('customer')+1;
		if($no_customer<'100'){$customer='0'.$no_customer; }else{$customer=$no_customer; }
		$data['no_customer'] = $customer;
		$data['title'] = "Tambah Customer";
		$data['main_content'] = 'customer/form';
		$data['act'] = 'add';
		$data['form_act'] = 'insert';
		$data['client_data'] = FALSE;
		$this->load->view('lte/live', $data);
	}

	function view($id)
	{
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu customer.'); redirect('customer');}
		if($this->bbm_model->check_customer($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('customer');}
		if($this->session->userdata('ADMIN')>='2'){ $this->customer_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$data['no_customer'] = $id;
		$data['title'] = "Lihat Customer";
		$data['main_content'] = 'customer/form';
		$data['act'] = 'view';
		$data['form_act'] = '';
		$data['client_data'] = $this->customer_model->get_data_by_id($id);
		$this->load->view('lte/live', $data);
	}	

	function edit($id)
	{
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu customer.'); redirect('customer');}
		if($this->bbm_model->check_customer($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('customer');}
		if($this->session->userdata('ADMIN')>='2'){ $this->customer_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$data['title'] = "Edit Customer";
		$data['main_content'] = 'customer/form';
		$data['act'] = 'edit';
		$data['form_act'] = 'update/'.$id;
		$data['client_data'] = $this->customer_model->get_data_by_id($id);
		$this->load->view('lte/live', $data);
	}
	
	function insert()
	{
		$this->customer_model->fill_data();
		$this->customer_model->insert_data();
		$this->session->set_userdata('SUCCESSMSG', 'customer baru sukses ;)');
		redirect('customer/baru');
	}

	function update()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu customer.'); redirect('customer');}
		if($this->bbm_model->check_customer($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('customer');}
		if($this->session->userdata('ADMIN')>='2'){ $this->customer_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$this->customer_model->fill_data();
		$this->customer_model->update_data($id);
		$this->session->set_userdata('SUCCESSMSG', 'Update customer sukses ;)');
		redirect('customer/baru');
	}

	function delete()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu customer.'); redirect('customer');}
		if($this->bbm_model->check_customer($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('customer');}
		if($this->session->userdata('ADMIN')>='2'){ $this->customer_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$this->db->where('id',$id); $this->db->update('customer',array('cek'=>'1')); redirect('customer');
	}
	
    function kembali(){
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu customer.'); redirect('customer');}
		if($this->bbm_model->check_customer($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('customer');}
		if($this->session->userdata('ADMIN')>='2'){ $this->customer_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$this->db->where('id',$id); $this->db->update('customer',array('cek'=>'0')); redirect('customer/terhapus');
    }
    
	function _klien_validation()
	{	
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('npwp', 'NPWP', 'trim|numeric');		
		$this->form_validation->set_rules('npwp1', 'NPWP', 'trim|numeric');		
		$this->form_validation->set_rules('npwp2', 'NPWP', 'trim|numeric');		
		$this->form_validation->set_rules('npwp3', 'NPWP', 'trim|numeric');		
		$this->form_validation->set_rules('npwp4', 'NPWP', 'trim|numeric');		
		$this->form_validation->set_rules('npwp5', 'NPWP', 'trim|numeric');		
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules('telpon', 'Telpon', 'trim|required');
	
		return $this->form_validation->run();
	}

}
/* End of file customer.php */
/* Location: ./application/controllers/customer.php */
