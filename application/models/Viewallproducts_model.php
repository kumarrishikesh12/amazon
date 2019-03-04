<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewallproducts_model extends CI_Model{

    function __construct() {
        $this->tableName = 'category';
        $this->primaryKey = 'cid';
    }


public function Get_all_category_Row(){

	//$status = 'Active';

    $query = $this->db->query("SELECT cname,cdetails,cicon from category");

     $result = $query->result();

      if(!empty($result)){

        return $result;

      }else{

      	return false;
      }


}



public function record_count($id) {
    
    $query = $this->db->query("SELECT * from products where product_status = 'Active' and product_category  LIKE '%$id%'");

     $result = $query->result();
     return $total_data = count($result);
     
     //return $this->db->count_all("products"); //return no of the rows in products table

} 



public function Get_all_products_Row(){

    //$status = 'Active';
    
    $query = $this->db->query("SELECT pid,pname,product_category,product_price,product_description,product_image from products where product_status = 'Active' ");

     $result = $query->result();

      if(!empty($result)){

        return $result;

      }else{

        return false;
      }


}


public function get_productdetails($id){

  $query = $this->db->query("SELECT pid,pname,product_category,product_price,product_description,product_image,other_product_image from products where product_status = 'Active' and pid = '$id' ");

   $result = $query->result();

   //print_r($result);
   //die();

   if(!empty($result)){

        return $result;

      }else{

        return false;
      }

}




public function delete_productimage($login_user_id,$pid,$imagename){

    $query = $this->db->query("SELECT pid,uid,other_product_image from products where pid = '$pid' and uid = '$login_user_id' and other_product_image Like '%$imagename%' ");

      $result = $query->result();

       if(!empty($result)){

        $filesname = $result[0]->other_product_image;
        //echo $filesname =  str_replace($imagename,"",$filesname);
        $array1 = Array($imagename);
        $array2 = explode(',', $filesname);
        $array3 = array_diff($array2, $array1);
        $output = implode(',', $array3);


        $data = array( 
        'other_product_image' => $output
        );

        $this->db->where('pid', $pid);
        $this->db->where('uid', $login_user_id);
        $this->db->update('products', $data);
        

         //$this->checkempty_or_not($login_user_id,$pid,$imagename); 
         //called funtion if empty other_product_image then SET Null.


         return $data; 
        //echo "data found !!";

      }else{

         return false;
        //echo "data not found !!";
      }

}



public function checkempty_or_not($login_user_id,$pid,$imagename){

  $query = $this->db->query("SELECT pid,uid,other_product_image from products where pid = '$pid' and uid = '$login_user_id' ");

   $result = $query->result();

   if($result['other_product_image'] == ''){

      $data = array( 
        'other_product_image' => NULL
       );

        $this->db->where('pid', $pid);
        $this->db->where('uid', $login_user_id);
        $this->db->update('products', $data);

        return true; 
    
     }
     else{
       
       return false;

     }


}










}

?>    
    