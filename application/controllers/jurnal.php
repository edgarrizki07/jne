<?php

class Jurnal extends CI_Controller {

	function Jurnal()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->load->library('fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$this->auth->check_user_authentification();
		$this->load->model('jurnal_model');
		$this->load->model('akun_model');
		$this->load->model('user_model');
		$this->load->model('pajak_model');
		$this->load->model('customer_model');
		$this->load->model('supplier_model');
		$this->load->helper('indodate');
		$this->load->helper('finance');
		if($this->session->userdata('ADMIN')>'3'){$this->session->set_userdata('SUCCESSMSG', 'Maaf anda tidak memiliki akses.'); redirect('home'); }
	}

	function index()
	{
		$data['title'] = "Jurnal";
		$data['main_content'] = 'jurnal/display';
		$this->load->helper('indodate');
		$data['months'] = bulan_list(1);
		$data['years'] = tahun_list(1);
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->_search_jurnal();
		$this->load->view('lte/live', $data);
	}

	function filter()
	{
		$data['title'] = "Jurnal";
		$data['main_content'] = 'jurnal/filter';
		$this->load->helper('indodate');
		$data['months'] = bulan_list(1);
		$data['years'] = tahun_list(1);
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$this->load->view('lte/live', $data);
	}

	function report()
	{
		$data['title'] = "Jurnal";
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
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$this->jurnal_model->set_month_year($month, $year);
		return $this->jurnal_model->get_data();
	}

	function _search_jurnals()
	{
		// $bulan = $this->uri->segment(3);
		// $month = ($bulan) ? nama_bulan($bulan) : FALSE;
		// $year = $this->uri->segment(4);
		$month = '07';
		$year = '2010';
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$this->jurnal_model->set_month_year($month, $year);
		return $this->jurnal_model->get_data();
	}

    function view($id){
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal.'); redirect('jurnal');}
		$data['title'] = "Jurnal Proyek";
		$data['main_content'] = 'jurnal/view';
        $data['info']=$this->jurnal_model->cek_jurnal($id)->row_array();
            $cek=$this->jurnal_model->cek_jurnal($id);
            if($cek->num_rows()>0){
				$this->load->view('lte/live',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Jurnal yang anda pilih tidak ada.');
                redirect('jurnal');
            }
    }

    function cetak($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal.'); redirect('jurnal');}
		if($this->bbm_model->check_jurnal($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jurnal');}
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['title'] = "Jurnal Proyek";
		$data['main_content'] = 'jurnal/print';
        $data['info']=$this->jurnal_model->cek_jurnal($id)->row_array();
            $cek=$this->jurnal_model->cek_jurnal($id);
            if($cek->num_rows()>0){
				$this->load->view('lte/cetak',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Jurnal yang anda pilih tidak ada.');
                redirect('jurnal');
            }
    }

    function pdf($id){
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal.'); redirect('jurnal');}
		if($this->bbm_model->check_jurnal($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jurnal');}
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['title'] = "Jurnal Proyek";
        $data['info']=$this->jurnal_model->cek_jurnal($id)->row_array();
            $cek=$this->jurnal_model->cek_jurnal($id);
            if($cek->num_rows()>0){
				$this->load->view('jurnal/pdf',$data);
            }else{
				$this->session->set_userdata('SUCCESSMSG', 'Jurnal yang anda pilih tidak ada.');
                redirect('jurnal');
            }
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
				$cabang = $this->pajak_model->KotaCabang($row->wp_id); 
				$cab = $this->pajak_model->KodeCabang($row->wp_id);
				$singkatan=$this->setting_model->singkatan();
				$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tgl']));
				$thn=$this->jurnal_model->ambilThn($row->tgl); 
				$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
				$j = $this->jurnal_model->FJurnal($row->f_id);
				$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
				$data = '[';
				$data .= "'<b>".$blnthn."</b>',";
				$data .= "'".$row->id."-".$row->item."',";
				if($row->customer_id == 0){ 
				$data .= "'".anchor(site_url()."jurnal/view/".$row->id, $row->tgl)."',";
				}else{ 
				$data .= "'".anchor(site_url()."jurnal_proyek/view/".$row->id, $row->tgl)."',";
				}
				$data .= "'".$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn."',";
				if($this->session->userdata('ADMIN') =='1'){
				$data .= "'".$cabang."',";
				}
				$data .= "'".$j." ".$p."',";
				$data .= "'".$v."',";
				$data .= "'".$row->kelompok_akun_id."-".$row->kode." ".$row->account_name."',";
				$data .= "'".$d."',";
				$data .= "'".$k."',";
				$data .= "'".anchor(site_url()."jurnal/hapus/".$this->jurnal_model->VoucherId($row->id)."/".$row->id, 'Hapus')."'";
				$data .= ']';
				$journal_data[] = $data;
			}
		}
		echo '['.implode(',',$journal_data).']';
	}

	function search()
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
				$kode=$this->jurnal_model->KodeVoucher($row->no_voucher); 
				$no = $row->id;
				$singkatan=$this->setting_model->singkatan();
				$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($info['tgl']));
				$thn=$this->jurnal_model->ambilThn($row->tgl); 
				$j = $this->jurnal_model->FJurnal($row->f_id);
				$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
				$data = '[';
				$data .= "'".$row->tgl."',";
				$data .= "'".$nomor."/".$kode."/".$no."/".$bln."/".$thn."',";
				$data .= "'".$row->item."',";
				$data .= "'".$row->account_name."',";
				$data .= "'".$d."',";
				$data .= "'".$k."',";
				$data .= "'".$j." ".$p."',";
				$data .= "'".$v."',";
				$data .= "'<button>".anchor(site_url()."jurnal/view/".$row->id, 'Detail').'</button><button>'.anchor(site_url()."jurnal/hapus/".$this->jurnal_model->VoucherId($row->id)."/".$row->id, 'Hapus')."</button>'";
				$data .= ']';
				$journal_data[] = $data;
			}
		}
		echo '['.implode(',',$journal_data).']';
	}

	function jurnal_umum()
	{
		$id = $this->uri->segment(3);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal.'); redirect('jurnal');}
		$data['title'] = "Jurnal Umum";
		$data['main_content'] = 'jurnal/form';
		$data['f_id'] = 1;
		// edited by Adhe on 19.05.2010
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$accounts = $this->akun_model->get_data_for_dropdown();
		$data['accounts'] = ($accounts) ? $accounts : array('-- Belum ada Akun --');
		// end
		$this->load->view('lte/live', $data);
	}

	function jurnal_penyesuaian()
	{
		$data['title'] = "Jurnal Penyesuaian";
		$data['main_content'] = 'jurnal/form';
		$data['f_id'] = 2;
		// edited by Adhe on 19.05.2010
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$accounts = $this->akun_model->get_data_for_dropdown();
		$data['accounts'] = ($accounts) ? $accounts : array('-- Belum ada Akun --');
		// end
		$this->load->view('lte/live', $data);
	}

	function jurnal_penutup()
	{
		$data['title'] = "Jurnal Penutup";
		$data['main_content'] = 'jurnal/penutup';
		$this->load->view('lte/live', $data);
	}

	function jurnal_koreksi($id)
		{
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal yang akan dikoreksi.'); redirect('jurnal');}
		$data['title'] = "Jurnal Koreksi";
		$data['main_content'] = 'jurnal/koreksi';
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$this->jurnal_model->set_id($id);
		$data['journal_data'] = $this->jurnal_model->get_data();
		$data['accounts'] = $this->akun_model->get_data_for_dropdown();
		$this->load->view('lte/live', $data);
	}

	public function hapus()
	{
		date_default_timezone_set("Asia/Jakarta");
		$vou = $this->uri->segment(3);
		$id = $this->uri->segment(4);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Jurnal yang akan dihapus.'); redirect('jurnal');}
		$cek = $this->db->where('id',$id); $this->db->where('wp_id',$this->session->userdata('SESS_WP_ID')); $query=$this->db->get('jurnal');
		if(!empty($cek)){			
			$data=array('keterangan'=>'Jurnal ini telah dihapus oleh '.$this->user_model->NamaUser($this->session->userdata('SESS_USER_ID')).' pada tanggal '.date('d-m-Y').' Jam '.date('H:i'));
			$this->db->where('id',$id);
			$this->db->update('jurnal',$data);
			$this->db->where('jurnal_id', $id);
			$this->db->delete('jurnal_detail');
			$this->session->set_userdata('SUCCESSMSG', 'Jurnal Telah dihapus.'); redirect('voucher/jurnal/'.$vou);
		}else{
			$this->session->set_userdata('SUCCESSMSG', 'Jurnal tidak dihapus, karena bukan jurnal di Cabang Anda.'); redirect('voucher/jurnal/'.$vou);
		}
	}

	function buku_besar()
	{
		$id = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu Akun.'); redirect('akun/detail_akun');}
		$data['title'] = "Buku Besar";
		$data['main_content'] = 'jurnal/buku_besar';
		if($this->session->userdata('ADMIN')>='2'){ $this->akun_model->set_wp_id($this->session->userdata('SESS_WP_ID')); }	
		$data['account_data'] = $this->akun_model->get_data_by_id($id);
		  if($this->uri->segment(4)==''){
			$this->jurnal_model->set_account_id($id);
		  }else{
			$this->jurnal_model->set_setelah_tgl($from);
			$this->jurnal_model->set_sebelum_tgl($to);
			$this->jurnal_model->set_account_id($id);
		  }
		if($this->session->userdata('ADMIN')>='2'){ $this->jurnal_model->set_wp_id($this->session->userdata('SESS_WP_ID'));   }	
		$data['journal_data'] = $this->jurnal_model->get_data();
		$this->load->view('lte/live', $data);
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
					redirect('jurnal/view/'.$sum);
				}
			}
		}
	}

	function get_details()
	{
		$laba_rugi = $this->akun_model->get_id_by_name('Ikhtisar Laba Rugi');
		$modal = $this->akun_model->get_id_by_name('Modal');
		if(!$laba_rugi)
		{
			echo 'error_laba_rugi';
		}
		elseif(!$modal)
		{
			echo 'error_modal';
		}
		else
		{
			//Menutup akun pendapatan dengan memindahkan saldo setiap akun pendapatan ke akun ikhtisar laba rugi
			$this->akun_model->set_account_group_id(4);
			$pendapatan = $this->akun_model->get_all_data();
			$i = 1;
			if($pendapatan)
			{
				$sum_pendapatan = 0;
				foreach ($pendapatan as $row)
				{
					if($row->saldo != 0)
					{
						$debit = ($row->saldo < 0) ? abs($row->saldo) : '';
						$kredit = ($row->saldo > 0) ? $row->saldo : '';
						$sum_pendapatan += $row->saldo;
						$this->_create_table_detail($i,$row->id,$debit,$kredit);
						$i++;
					}
				}
				if($sum_pendapatan != 0)
				{
					$debit = ($sum_pendapatan > 0) ? $sum_pendapatan : '';
					$kredit = ($sum_pendapatan < 0) ? abs($sum_pendapatan) : '';
					$this->_create_table_detail($i,$laba_rugi,$debit,$kredit);
					$i++;
				}
			}

			//Menutup akun biaya dengan memindahkan saldo setiap akun biaya ke akun ikhtisar laba rugi
			$this->akun_model->set_account_group_id(5);
			$biaya = $this->akun_model->get_all_data();
			if($biaya)
			{
				$sum_biaya = 0;
				foreach ($biaya as $row)
				{
					if($row->saldo != 0)
					{
						$debit = ($row->saldo < 0) ? abs($row->saldo) : '';
						$kredit = ($row->saldo > 0) ? $row->saldo : '';
						$sum_biaya += $row->saldo;
						$this->_create_table_detail($i,$row->id,$debit,$kredit);
						$i++;
					}
				}
				if($sum_biaya != 0)
				{
					$debit = ($sum_biaya > 0) ? $sum_biaya : '';
					$kredit = ($sum_biaya < 0) ? abs($sum_biaya) : '';
					$this->_create_table_detail($i,$laba_rugi,$debit,$kredit);
					$i++;
				}
			}

			//Menutup akun ikhtisar laba rugi dengan memindahkan saldo akun tersebut ke akun modal
			$sum = $sum_pendapatan + $sum_biaya;
			if($sum != 0)
			{
				$debit = ($sum < 0) ? abs($sum) : '';
				$kredit = ($sum > 0) ? $sum : '';
				$this->_create_table_detail($i,$laba_rugi,$debit,$kredit);
				$i++;
				$this->_create_table_detail($i,$modal,$kredit,$debit);
				$i++;
			}

			//Menutup akun prive (jika ada) dengan memindahkan saldo akun tersebut ke akun modal
			$prive = $this->akun_model->get_id_by_name('Prive');
			if($prive)
			{
				$this->akun_model->get_data_by_id($prive);
				if($prive['saldo'] != 0)
				{
					$debit = ($prive['saldo'] < 0) ? abs($prive['saldo']) : '';
					$kredit = ($prive['saldo'] > 0) ? $prive['saldo'] : '';
					$this->_create_table_detail($i,$prive['id'],$debit,$kredit);
					$i++;
					$this->_create_table_detail($i,$modal,$kredit,$debit);
				}
			}
		}
	}

	function _create_table_detail($i, $akun_id, $debit, $kredit)
	{
		$accounts = $this->akun_model->get_data_for_dropdown();
		$detail['disabled'] = TRUE;
		$detail['class'] = 'field';
		echo '<tr>';
		echo '<td>';
		$akun['id'] = 'akun'.$i;
		$akun['class'] = 'combo';
		$akun['disabled'] = TRUE;
		$selected = $akun_id;
		echo form_dropdown('akun[]', $accounts, $selected ,$akun);
		echo '</td>';
		echo '<td>';
		$detail['id'] = $detail['name'] = 'debit'.$i;
		$detail['value'] = $debit;
		echo form_input($detail);
		echo '</td>';
		echo '<td>';
		$detail['id'] = $detail['name'] = 'kredit'.$i;
		$detail['value'] = $kredit;
		echo form_input($detail);
		echo '</td>';
		echo '</tr>';
	}

	function rekategori($id)
	{
        if(!$id){$this->session->set_userdata('SUCCESSMSG', 'Anda Harus pilih salah satu customer.'); redirect('jurnal');}
		if($this->bbm_model->check_jurnal_detail($id)) { $this->session->set_userdata('SUCCESSMSG', 'ID yang Anda pilih tidak ada.'); redirect('jurnal');}
		if($this->session->userdata('ADMIN')>='2'){ $this->session->set_userdata('SUCCESSMSG', 'Bahaya untuk Anda'); redirect('jurnal');}
		$data=array('kategori_id'=>$this->akun_model->JenisAkun($id)); $this->db->where('akun_id',$id);
		$this->db->update('jurnal_detail',$data); $idm=($id+1);
		 // $this->session->set_userdata('SUCCESSMSG', 'rekategori Sukses.'); redirect('jurnal');}
		redirect('jurnal/view/'.$idm);
	}
	
	function _jurnal_validation()
	{
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
/* End of file jurnal.php */
/* Location: ./application/controllers/jurnal.php */
