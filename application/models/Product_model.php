<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{

    function __construct() {
        $this->tableName = 'products';
        $this->primaryKey = 'pid';
    }
    



public function Get_Category_Row(){

	$status = 'Active';

    $query = $this->db->query("SELECT cid,cname from category WHERE category_status = 'Active' ");
    //return $query->result();
    //echo $query = $this->db->get();

     $result = $query->result();

      if(!empty($result)){

        return $result;

      }else{

      	return false;
      }


}


public function Get_Category_Row_From_Category(){


    //SELECT pid,pname,product_category, GROUP_CONCAT(c.cname) FROM products p, category c WHERE FIND_IN_SET(c.cid, p.product_category) GROUP BY p.pname


    $query = $this->db->query("SELECT p.pid,GROUP_CONCAT(c.cname) as mysummary FROM products p, category c WHERE FIND_IN_SET(c.cid, p.product_category) GROUP BY p.pname ORDER BY p.pid");

     //$result = $query->result();

     $result = $query->result();

     /*
     foreach ($result as $value){ 
        
        $result[] = $value->mysummary; 

     } */
    

     //print_r($result);
     //die();

      if(!empty($result)){

        return $result;

      }else{

        return false;
      }


}




 public function insert_product_data($data = array()){

 	 	$insert = $this->db->insert($this->tableName,$data);

        if($insert){
            return $this->db->insert_id();
        }else{
            return false;    
        }


 }




 public function get_add_product(){

         //data is retrive from this query  

    $this->db->select("pid,pname,product_category,product_price,product_description,product_image,uid,product_status"); 
         $this->db->from('products');

         $query = $this->db->get();
         
         return $query->result();
        
 }




public function get_delete_product($product_id,$login_user_id){
    
    $this->db->select("pid,uid,product_status");
    $this->db->from('products');
    $this->db->where('pid ='.$product_id);
    $this->db->where('uid ='.$login_user_id);

    $query = $this->db->get();
    $result = $query->result();

    if(!empty($result)){


    $data = array( 
    'product_status' => 'Deactivate'
     );

    $this->db->where('pid', $product_id);
    $this->db->update('products', $data);

     return $data;

     }

    
}





public function get_active_product($product_id,$login_user_id){
    # Active...

    $this->db->select("pid,uid,product_status");
    $this->db->from('products');
    $this->db->where('pid ='.$product_id);
    $this->db->where('uid ='.$login_user_id);

    $query = $this->db->get();
    $result = $query->result();


    if(!empty($result)){


    $data = array( 
    'product_status' => 'Active'
     );

    $this->db->where('pid', $product_id);
    $this->db->update('products', $data);

     return $data;

     }


}


 

public function get_edit_product($product_id,$login_user_id){

        $this->db->select("pid,pname,product_category,product_price,product_description,product_image,other_product_image,uid,product_status");
        $this->db->from('products');
        $this->db->where('pid ='.$product_id);
        $this->db->where('uid ='.$login_user_id);

        $query = $this->db->get();

         return $query->result();
        
}



 public function update_product_primary_image($product_id,$login_user_id,$file_name){
     # code... for update product primary image


    $this->db->select("pid,uid,product_image");
    $this->db->from('products');
    $this->db->where('pid ='.$product_id);
    $this->db->where('uid ='.$login_user_id);

     $query = $this->db->get();
     $result = $query->result();

     if(!empty($result)){

         $data = array( 
          'product_image' => $file_name
          );

         $this->db->where('pid', $product_id);
         $this->db->update('products', $data);

         return $data;

      }



 }




 public function update_product_other_image($product_id,$login_user_id,$file_names){
     # code... for updated/Added product other image

    //print_r($file_names);
    //die();

    $this->db->select("pid,uid,other_product_image");
    $this->db->from('products');
    $this->db->where('pid ='.$product_id);
    $this->db->where('uid ='.$login_user_id);

     $query = $this->db->get();
     $result = $query->result();


      if(!empty($result)){

         $data = array('other_product_image' => $file_names);

            $this->db->where('pid', $product_id);
           $this->db->update('products', $data);

         //return $data;

      }


       $this->db->select("pid,uid,other_product_image");
       $this->db->from('products');
       $query = $this->db->get();
       $result = $query->result();
       //print_r($result);
       //die(); 

       return $result;

 }




public function update_product_data($product_id,$product_name,$category_name,$product_description,$product_price,$login_user_id){
      
    $this->db->select("pid,uid,pname,product_description,product_category,product_price");
    $this->db->from('products');
    $this->db->where('pid ='.$product_id);
    $this->db->where('uid ='.$login_user_id);
 

     $query = $this->db->get();

     $result = $query->result();

      if(!empty($result)){

         $data = array( 
          'pname' => $product_name,
          'product_description' => $product_description,
          'product_category' => $category_name,
          'product_price' => $product_price
          
          );


         $this->db->where('pid', $product_id);
         $this->db->update('products', $data);

         return $data;

      }
 
  }










}
?>    