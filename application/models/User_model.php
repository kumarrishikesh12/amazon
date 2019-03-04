<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
 

Class User_model extends CI_Model {
	
Public function __construct() { 

         parent::__construct(); 
         $this->load->database();
         $this->load->library('form_validation');
         $this->userTbl = 'users';

     } 


public function email_check($email){
 
  $this->db->select('*');
  $this->db->from('users');
  $this->db->where('email',$email);
  $query=$this->db->get();
 
  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }
 
}


public function register_user($users){
 
$this->db->insert('users', $users);
 
}




public function login_user($email,$pass){

  $this->db->select('*');
  $this->db->from('users');
  $this->db->where('email',$email);
  $this->db->where('password',$pass);
  $this->db->limit(1);

  //$query = $this->db->get();

  if($query=$this->db->get()) {
	
	return $query->result_array();
	
	} else {
	
	return false;
 }


}






		
} 
?>