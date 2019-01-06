<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {

	/**
	 * @author : M David
	 * @web : http://muhammaddavid.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
    function __construct(){
        parent::__construct();
        $this->load->library(array('auth','template','pagination','form_validation','upload','email'));
		$this->auth->check_user_authentification();
	}
    
	public function index()	{
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$data['info'] =  $this->db->get_where('supplier',array('cek'=>'0'))->result();
		$data['title']="Supplier";
		$data['main_content'] = 'supplier/index';
		$this->load->view('lte/live', $data);
	}
	
	function reload()
	{
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		$this->db->order_by($order_column='id',$order_type='desc');
		$result = $this->db->get_where('supplier',array('cek'=>'0'))->result();
		if($result) {
			foreach ($result as $row)
			{
				$data = '[';
				$data .= "'".$row->nama."',";
				$data .= "'".$row->kota."',";
				$data .= "'".$row->provinsi."',";
				$data .= "'".$row->cp."',";
				$data .= "'".$row->hp."',";
				$data .= "'".$row->email."',";
				$data .= "'".$row->wp_id."',";
				$data .= ']';
				$info[] = $data;
			}
		}
		echo '['.implode(',',$info).']';
	}

	function all_datas() { $this->db->order_by("id","desc"); $query=$this->db->get("supplier"); return $query->result(); }
	function read(){		
		$people=$this->all_datas();
		echo "
			<table id='table-data' class='table table-striped table-bordered table-view'>
				<thead title='load time: {elapsed_time}' >
					<tr>
						<th>No</th>
						<th>Nama Perusahaan</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Hapus</th>
					</tr>
				</thead>
				<tbody id='table-body'>
			";$no=1; 
		foreach ($people as $supplier) {
			echo "
				<tr data-id='$supplier->id'>
					<td>
						$no
					</td>
					<td>
						<span class='span-nama form-supplier' data-id='$supplier->id'>$supplier->nama</span>
					</td>
					<td>
						<span class='span-email caption' data-id='$supplier->id'>$supplier->email</span>
						<input type='text' style='display: none;'  class='field-email form-control editor' value='$supplier->email' data-id='$supplier->id' />
					</td>
					<td>
						<span class='span-phone caption' data-id='$supplier->id' data-modul='phone'>$supplier->phone</span>
						<input type='text' style='display: none;' class='field-phone form-control editor' value='$supplier->phone' data-id='$supplier->id' />
					</td>
					<td>
						<button class='btn btn-xs btn-danger hapus-supplier' data-id='$supplier->id'><i class='glyphicon glyphicon-remove'></i> Hapus</button>
					</td>
				</tr>";
				$no++;
		} 
		echo "
			</tbody></table>
				<script>$(function () { $('#table-data').DataTable({ 'scrollX': true }); });</script>
		";

	}

	
    function tambah(){
        $data['title']="Supplier";
        $this->_set_rules();
        if($this->form_validation->run()==true){//jika validasi dijalankan dan benar
			$info=array(
				'id'=>$this->input->post('id'),
				'nama'=>$this->input->post('nama'),
				'kode'=>$this->input->post('kode'),
				'npwp'=>$this->input->post('npwp'),
				'status'=>$this->input->post('status'),
				'alamat'=>$this->input->post('alamat'),
				'kota'=>$this->input->post('kota'),
				'provinsi'=>$this->input->post('provinsi'),
				'depo'=>$this->input->post('depo'),
				'rekening'=>$this->input->post('rekening'),
				'keterangan'=>$this->input->post('keterangan'),
				'telp'=>$this->input->post('telp'),
				'fax'=>$this->input->post('fax'),
				'cp'=>$this->input->post('cp'),
				'hp'=>$this->input->post('hp'),
				'email'=>$this->input->post('email'),
				'wp_id'=>$this->session->userdata('SESS_WP_ID'),
				'login_id'=>$this->session->userdata('SESS_USER_ID'),
				'waktu_post' => date("Y-m-d H:i:s")
			);
			$this->db->insert('supplier',$info);
			redirect('supplier');
        }else{
            $data['message']="";
			$data['main_content'] = 'supplier/tambah';
			$this->load->view('lte/live', $data);
        }
    }
    
    function hapus(){
        $id=$this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Penjualan.'); redirect('supplier');}
		if($this->bbm_model->check_supplier($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('supplier');}
		if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
		if($this->session->userdata('ADMIN')>='3'){$this->session->set_userdata('SUCCESSMSG', 'Anda tidak memiliki akses.'); redirect('supplier');}
        $this->m_hapus->supplier($id); redirect('supplier');			
    }
    
    function _set_rules(){
        $this->form_validation->set_rules('id','ID','required|max_length[15]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
}