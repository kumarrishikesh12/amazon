<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model{

    function __construct() {
        $this->tableName = 'category';
        $this->primaryKey = 'cid';
    }
    

    public function insert_category_data($data = array()){
        if(!array_key_exists("created",$data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified",$data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        $insert = $this->db->insert($this->tableName,$data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;    
        }
    }



    public function get_add_category(){

         //data is retrive from this query  
         $this->db->select("cid,cname,cdetails,cicon,uid,category_status"); 
         $this->db->from('category');

         $query = $this->db->get();
         
         return $query->result();
        
    }


    public function get_edit_category($category_id,$login_user_id){

        $this->db->select("cid,cname,cdetails,cicon,uid,category_status");
        $this->db->from('category');
        $this->db->where('cid ='.$category_id);
        $this->db->where('uid ='.$login_user_id);

        $query = $this->db->get();

         return $query->result();
        
    }



 public function update_category_image($category_id,$login_user_id,$file_name){
    # code update category image...

    $this->db->select("cid,uid,cicon");
    $this->db->from('category');
    $this->db->where('cid ='.$category_id);
    $this->db->where('uid ='.$login_user_id);

     $query = $this->db->get();
     $result = $query->result();

     if(!empty($result)){

         $data = array( 
          'cicon' => $file_name
          );

         $this->db->where('cid', $category_id);
         $this->db->update('category', $data);

         return $data;

      }

 }




  public function update_category_data($category_id,$category_name,$category_description,$login_user_id){
      
    $this->db->select("cid,uid,cname,cdetails");
    $this->db->from('category');
    $this->db->where('cid ='.$category_id);
    $this->db->where('uid ='.$login_user_id);
 

     $query = $this->db->get();
     $result = $query->result();

      if(!empty($result)){

         $data = array( 
          'cname' => $category_name,
          'cdetails' => $category_description
          
          );


         $this->db->where('cid', $category_id);
         $this->db->update('category', $data);

         return $data;

      }
 
  }


  public function get_delete_category($category_id,$login_user_id){
    
    $this->db->select("cid,uid,category_status");
    $this->db->from('category');
    $this->db->where('cid ='.$category_id);
    $this->db->where('uid ='.$login_user_id);

    $query = $this->db->get();
    $result = $query->result();


    if(!empty($result)){


    $data = array( 
    'category_status' => 'Deactivate'
     );

    $this->db->where('cid', $category_id);
    $this->db->update('category', $data);

     return $data;

     }

    
}



public function get_active_category($category_id,$login_user_id){
    # Active...

    $this->db->select("cid,uid,category_status");
    $this->db->from('category');
    $this->db->where('cid ='.$category_id);
    $this->db->where('uid ='.$login_user_id);

    $query = $this->db->get();
    $result = $query->result();


    if(!empty($result)){


    $data = array( 
    'category_status' => 'Active'
     );

    $this->db->where('cid', $category_id);
    $this->db->update('category', $data);

     return $data;

     }


}





/*

public function GetCategoryRow(){
    # code...

    $this->db->select("cname");
    $this->db->from('category');
    $this->db->where('category_status ='.'Active');
   
    $query = $this->db->get();
    $result = $query->result();

      if(!empty($result)){

        return $result;

      }


} */




}