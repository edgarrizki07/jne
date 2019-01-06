<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_email extends CI_Model {
	function cek() {
	$this->db->where('status_mail','wait');
	$query = $this->db->get('t_email');
	return $query->result_array();
	}

	function update($data){
	$this->db->where('status_mail', 'wait');
	$this->db->update('t_email',$data);
	}
}
