<?php

class Jurnal_proyek extends CI_Controller {

	function Jurnal_proyek()
	{
		parent::__construct();	
		$this->load->library('auth');
		$this->auth->check_user_authentification();
		$this->load->model('jurnal_model');
		$this->load->model('akun_model');
		$this->load->model('user_model');
		$this->load->model('pajak_model');
		$this->load->model('customer_model');
		$this->load->model('supplier_model');
		$this->load->helper('indodate');
		$this->load->helper('finance');
		$this->load->library('fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		if($this->session->userdata('ADMIN')>'3'){$this->session->set_userdata('SUCCESSMSG', 'Maaf anda tidak memiliki akses.'); redirect('home'); }
	}
	
	function index()
	{
		$data['title'] = "Transaksi BBM";
		$data['main_content'] = 'jurnal_proyek/display';
		$this->jurnal_model->set_project();
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$this->load->view('lte/live', $data);
	}

	function jurnal()
	{
		$data['title'] = "Jurnal Transaksi";
		$data['main_content'] = 'jurnal_proyek/umum';
		$this->load->helper('indodate');
		$data['months'] = bulan_list(1);
		$data['years'] = tahun_list(1);
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->_search_jurnal();
		$this->load->view('lte/live', $data);
	}

	function report()
	{
		$data['title'] = "Jurnal Transaksi";
		$this->load->helper('indodate');
		$data['wajib_pajak_data'] = $this->pajak_model->get_data();
		$month = $this->uri->segment(3);
		$year = $this->uri->segment(4);
		$cab = $this->uri->segment(5);
		if(!$cab=='0'){ $this->jurnal_model->set_wp_id($cab); }
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$this->jurnal_model->set_month_year($month, $year);
		$data['journal_data'] = $this->jurnal_model->get_data();
			$this->load->view('jurnal/report', $data);
	}
		
	function _search_jurnal()
	{
		$month = ($this->input->post('bulan') !== FALSE) ? $this->input->post('bulan') : date("m");
		$year = ($this->input->post('tahun') !== FALSE) ? $this->input->post('tahun') : date("Y");
		$this->jurnal_model->set_month_year($month, $year);
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		return $this->jurnal_model->get_data();
	}

    function view($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal.'); redirect('jurnal_proyek');}
		if($this->bbm_model->check_jurnal($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jurnal');}
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['title'] = "Transaksi BBM";
		$data['main_content'] = 'jurnal_proyek/view';
        $data['info']=$this->jurnal_model->cek_jurnal($id)->row_array();
            $cek=$this->jurnal_model->cek_jurnal($id);
            if($cek->num_rows()>0){
				$this->load->view('lte/live',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Jurnal yang anda pilih tidak ada.');
                redirect('jurnal_proyek');
            }
    }

    function cetak($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal.'); redirect('jurnal_proyek');}
		if($this->bbm_model->check_jurnal($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jurnal');}
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['title'] = "Transaksi BBM";
		$data['main_content'] = 'jurnal_proyek/print';
        $data['info']=$this->jurnal_model->cek_jurnal($id)->row_array();
            $cek=$this->jurnal_model->cek_jurnal($id);
            if($cek->num_rows()>0){
				$this->load->view('lte/cetak',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Jurnal yang anda pilih tidak ada.');
                redirect('jurnal_proyek');
            }
    }

    function pdf($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal.'); redirect('jurnal_proyek');}
		if($this->bbm_model->check_jurnal($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jurnal');}
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['title'] = "Transaksi BBM";
        $data['info']=$this->jurnal_model->cek_jurnal($id)->row_array();
            $cek=$this->jurnal_model->cek_jurnal($id);
            if($cek->num_rows()>0){
				$this->load->view('jurnal_proyek/pdf',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Jurnal yang anda pilih tidak ada.');
                redirect('jurnal_proyek');
            }
    }

	function add()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Voucher Jurnal.'); redirect('jurnal_proyek');}
		$data['title'] = "Tambah Jurnal BBM";
		$data['main_content'] = 'jurnal_proyek/form';
		// edited by Adhe on 19.05.2010
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$accounts = $this->akun_model->get_data_for_dropdown();
		$data['accounts'] = ($accounts) ? $accounts : array('-- Belum ada Akun --');
		// end
		$this->load->view('lte/live', $data);
	}

	function search()
	{
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$this->jurnal_model->set_project($this->input->post('jenis'),$this->input->post('id'));
		$result = $this->jurnal_model->get_data();
		if($result) {
			foreach ($result as $row)
			{
				if($row->debit_kredit == 1)
				{
					$d = number_format(($row->nilai), 0, '', '.');
					$k = '';
				}
				else
				{
					$d = '';
					$k = number_format(($row->nilai), 0, '', '.');
				}
				$customer = $this->customer_model->NamaCustomer($row->customer_id); 
				$nomor = $row->no_voucher; 
				$cabang = $this->pajak_model->KotaCabang($row->wp_id); 
				$kode=$this->jurnal_model->KodeVoucher($row->no_voucher); 
				$no = $row->id;
				$singkatan=$this->setting_model->singkatan();
				$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl));
				$thn=$this->jurnal_model->ambilThn($row->tgl); 
				$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
				$data = '[';
				$data .= "'".$customer." - ".$row->project_name."',";
				$data .= "'".$row->tgl."',";
				$data .= "'".$nomor."/".$kode."/".$no."/".$bln."/".$thn."',";
				if($this->session->userdata('ADMIN') =='1'){ $data .= "'".$cabang."',";}
				$data .= "'".$row->item."',";
				$data .= "'".$row->account_name."',";
				$data .= "'".$d."',";
				$data .= "'".$k."',";
				$data .= "'".$v."',";
				$data .= "'<button>".anchor(site_url()."jurnal_proyek/view/".$row->id, 'Detail')."</button>',";
				$data .= ']';
				$journal_data[] = $data;
			}
		}
		echo '['.implode(',',$journal_data).']';
	}

	function search_jurnalumum()
	{
		$result = $this->_search_jurnal();
		if($result) {
			foreach ($result as $row)
			{
				if($row->debit_kredit == 1)
				{
					$d = number_format(($row->nilai), 0, '', '.');
					$k = '';
				}
				else
				{
					$d = '';
					$k = number_format(($row->nilai), 0, '', '.');
				}
				if($row->customer_id == 0){ $p=''; }else{ $p='B'; }
				$nomor = $row->no_voucher; 
				$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
				$no = $row->id;
				$singkatan=$this->setting_model->singkatan();
				$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl));
				$thn=$this->jurnal_model->ambilThn($row->tgl); 
				$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
				$j = $this->jurnal_model->FJurnal($row->f_id);
				$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
				$data = '[';
				$data .= "'<b>".$blnthn."</b>',";
				$data .= "'".$row->tgl."',";
				$data .= "'".$v."',";
				$data .= "'".$row->project_name."',";
				$data .= "'".$nomor."/".$kode."/".$no."/".$bln."/".$thn."',";
				$data .= "'".$row->item."',";
				$data .= "'".$row->account_name."',";
				$data .= "'".$d."',";
				$data .= "'".$k."',";
				$data .= "'".$j." ".$p."',";
				$data .= "'<button>".anchor(site_url()."jurnal_proyek/view/".$row->id, 'Detail')."</button>',";
				$data .= ']';
				$journal_data[] = $data;
			}
		}
		echo '['.implode(',',$journal_data).']';
	}

	function laporan_laba_rugi()
	{
		$data['wajib_pajak_data'] = $this->pajak_model->get_data();
		$bulan = $this->uri->segment(3);
		$data['bulan'] = ($bulan) ? nama_bulan($bulan) : FALSE;
		$data['tahun'] = $this->uri->segment(4);
		$data['laba_rugi_data'] = $this->_get_laba_rugi_data($bulan,$data['tahun']);
		$this->load->view('laporan_keuangan/laba_rugi', $data);
	}

	function insert()
	{
		$goto = $this->input->post('goto');
		if(!$this->_jurnal_validation())
		{
			$this->session->set_userdata('ERRMSG_ARR', validation_errors());
			redirect($goto);
		}
		else
		{
			$error_message = $this->_detail_validation();
			if($error_message != '')
			{
				$this->session->set_userdata('ERRMSG_ARR', $error_message);
				redirect($goto);
			}
			else
			{
				$this->jurnal_model->fill_data();
				//Check for duplicate no
				if(!$this->jurnal_model->check_no())
				{
					$this->session->set_userdata('ERRMSG_ARR', 'Nomor Jurnal telah digunakan');
					redirect($goto);
				}
				//Insert Data
				elseif($this->jurnal_model->insert_data())
				{
					$this->session->set_userdata('SUCCESSMSG', 'Jurnal baru sukses ;)');
					$sum=$this->db->count_all('jurnal');
					redirect('jurnal_proyek/view/'.$sum);
				}
			}
		}
	}
	
	function _jurnal_validation()
	{
		$this->form_validation->set_rules('penerima', 'Penerima', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required|dateISO');

		$akun = $this->input->post('akun');
		for ($i = 1; $i <= count($akun); $i++)
		{
			$this->form_validation->set_rules('debit'.$i, 'Debit', 'trim|is_natural');
			$this->form_validation->set_rules('kredit'.$i, 'Kredit', 'trim|is_natural');
		}

		return $this->form_validation->run();
	}

	function _detail_validation()
	{
		$error_message = '';
		if($this->input->post('f_id') != 3)
		{
			if (($this->input->post('debit1') == '' && $this->input->post('kredit1') == '') || ($this->input->post('debit2') == '' && $this->input->post('kredit2') == ''))
			{
				$error_message = "Minimal dua data pada detail harus dimasukkan.";
			}
			else
			{
				$akun_exist = array();
				$debit_sum = 0;
				$kredit_sum = 0;
				$akun = $this->input->post('akun');
				for ($i = 1; $i <= count($akun); $i++)
				{
					$debit = $this->input->post('debit'.$i);
					$kredit =$this->input->post('kredit'.$i);
					// akun tidak boleh ada yang sama
					if(in_array($akun[$i-1],$akun_exist))
					{
						$error_message = "Data akun pada table detail tidak boleh sama.";
					}
					else
					{
						$akun_exist[count($akun_exist)] = $akun[$i-1];
					}
					// hitung jumlah debit
					if ($debit != '') $debit_sum += $debit;
					// hitung jumlah kredit
					if ($kredit != '') $kredit_sum += $kredit;
				}
				if($debit_sum == 0 || $kredit_sum == 0)
				{
					if($error_message) $error_message .= '<br/>';
					$error_message .= "Jumlah data debit maupun kredit tidak boleh 0.";
				}
				if($debit_sum != $kredit_sum)
				{
					if($error_message) $error_message .= '<br/>';
					$error_message .= "Jumlah debit harus sama dengan jumlah kredit.";
				}
			}
		}
		return $error_message;
	}
	
}
/* End of file jurnal_proyek.php */
/* Location: ./application/controllers/jurnal_proyek.php */
