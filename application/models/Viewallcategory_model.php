<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewallcategory_model extends CI_Model{

    function __construct() {

        $this->load->library('pagination');
        $this->tableName = 'category';
        $this->primaryKey = 'cid';
    }



public function record_count() {
    
    return $this->db->count_all("category"); //return no of the rows in category table
    
}

public function Get_all_category_Row($limit,$start){

      //$query = $this->db->query("SELECT cid,cname,cdetails,cicon from category LIMIT ".$limit);
     //$query = $this->db->query("SELECT cid,cname,cdetails,cicon from category");

      $this->db->limit($limit, $start);
      $query = $this->db->get("category");
        
    if ($query->num_rows() > 0) {
       
       foreach ($query->result() as $row) {

            $allcategorydata[] = $row;
        }
        
            return $allcategorydata;
        
        }
        
        return false;

}



public function get_categorydetails($id,$page,$limit){

    //print_r($page); //6_limit
    //die();
    //$query = $this->db->query("SELECT pid,pname,product_category,product_price,product_description,product_image from products where product_status = 'Active' and  product_category  LIKE '%$id%' ");
    //$this->db->limit($limit,$start);

    $this->db->select('pid,pname,product_category,product_price,product_description,product_image');
    $this->db->where('product_status','Active');
    $this->db->like('product_category',$id);
    $this->db->limit($limit,$page);
    $query = $this->db->get('products');

      //$result = $query->result();
      //print_r($result);
      //die();

      if ($query->num_rows() > 0) {
       
       foreach ($query->result() as $row) {

            $catdetails[] = $row;
        }
        
            return $catdetails;

       }
        
        return false;

    /*
    $result = $query->result();

      if(!empty($result)){

        return $result;

      }else{

        return false;
      }

      */


}




}