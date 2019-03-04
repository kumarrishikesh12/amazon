<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


public function __construct(){
        
         parent::__construct();
        //load model
        $this->load->model('User_model');
        $this->load->model('Category_model');
        $this->load->model('Product_model');
        $this->load->model('Viewallproducts_model');
        $this->load->model('Viewallcategory_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->database();

}


public function index(){ 
  $this->load->view('registration'); //index page registration
} 


public function register(){	
 
   $this->load->view("registration");
 
 }



public function register_view(){
	

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    if(empty($first_name) || empty($last_name) || empty($password) || empty($email) ) {
      
      $this->session->set_flashdata('error_msg', 'Please fill all fields.');
      redirect('index.php/home/register');
    }else{



    $users=array(
      'first_name'=>$this->input->post('first_name'),
      'last_name'=>$this->input->post('last_name'),
      'email'=>$this->input->post('email'),
      'password'=>md5($this->input->post('password'))
    );


	$email = $users['email'];
	$email_check = $this->User_model->email_check($email);

	if($email_check){
  	
  	$this->User_model->register_user($users); //pass data to User_model

  	$this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
  	
  	 redirect('index.php/home/login');
 
}
else{
 
  $this->session->set_flashdata('error_msg', 'Email already Registered,Try Different.');
  redirect('index.php/home/register');
 
   }


}


}



public function login(){
 
  $this->load->view("login");
 
}


public function login_user(){

  $email = $_POST['email'];
  $password = $_POST['password']; 

  if(empty($email) || empty($password) ) {

      $this->session->set_flashdata('error_msg', 'Please fill all fields.');
      redirect('index.php/home/login');
    }else{


  $user_login = array(

  'email'=> $this->input->post('email'),
  'password'=> md5($this->input->post('password'))
 
   ); 

   $email = $user_login['email'];
   $pass = $user_login['password'];
  	

  $data['users']=$this->User_model->login_user($email,$pass); //pass data to User_model

  	 //print_r($data);
  	 //die();


  	 if(!empty($data['users'][0]['id'])){
  	 	
  	 	$session_data = array(

  	 	'id' => $data['users'][0]['id'],
		  'first_name' => $data['users'][0]['first_name'],
		  'last_name' => $data['users'][0]['last_name'],
		  'email' => $data['users'][0]['email']

	    ); 
		

  	    $this->session->set_userdata('logged_in', $session_data);
	  	redirect('index.php/home/dashboard', 'refresh');

  	 }else{
	 //user details not exist
	
	 $this->session->set_flashdata('error_msg', 'Invalid Email Address or Password');
 	 $this->load->view('login');

  }


}


}


public function dashboard(){

	$this->load->view('dashboard');

}






public function logout(){
 
  $this->session->sess_destroy();

  $sess_array = array(
  'id' => '',
	'first_name' => '',
	'last_name' => '',
	'email' => ''
  );	
   
 $this->session->unset_userdata('logged_in', $sess_array);
 $this->session->set_flashdata('success_msg', 'Successfully Logout');
 $this->load->view('login');
 //redirect('index.php/home/login', 'refresh');

}



			/* ---------------------  Category  Section   ---------------------- */



public function add_category(){


	//$data['temp'] = $this->Category_model->get_add_category(); 				 

	//if(!empty($data) && $data !== 'undefine'){
    //$this->session->set_flashdata('success_msg', 'Category has been added successfully.');        		 
    //$this->load->view('add_category',$data); }
  //  else{
		
  		$this->load->view('add_category');
  	//}


}  



public function managed_categorys(){

    $data['temp'] = $this->Category_model->get_add_category(); 

    if(!empty($data) && $data !== 'undefine'){

    $this->load->view('managed_category',$data); 
     }

    else{
        
        $this->load->view('managed_category');
    }


}





public function edit_category($category_id = NULL){

	if(!empty($category_id)){    //get_edit_category_id_request


		 $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id

		 $get_edit['data'] = $this->Category_model->get_edit_category($category_id,$login_user_id); 		

		 //print_r($get_edit);
	     //die();

		 $this->load->view('edit_category',$get_edit);
	}


 

}


public function update_category(){


      $category_id = $_POST['category_id'];
      $category_name = $_POST['category_name'];
      $category_description = $_POST['category_description'];


      if(empty($category_name) || empty($category_description) ) {

       $this->session->set_flashdata('error_msg', 'Please fill all fields.');
       redirect('index.php/home/edit_category/'.$category_id);
       
      }


	

	 if(!empty($_POST['category_name']) && !empty($_POST['category_description']) && !empty($_POST['category_id']) ){


		$category_id = $_POST['category_id'];      //category_id
		$category_name = $_POST['category_name']; //category_name
        $category_description = $_POST['category_description']; //category_description
        $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id	

        //if category icons selected to upload

         $get_file_name = $_FILES['categorie_icon']['name'];

         if(isset($get_file_name) && !empty($get_file_name) ){

             $remove_space_file_name = str_replace(" ", "", $get_file_name); //removed space

             $random_str = md5(rand(8,1000));

             $file_name = $random_str.'_'.$remove_space_file_name;


              $config['upload_path'] = 'uploads/images/';
              $config['allowed_types'] = 'jpg|jpeg|png';
              $config['file_name'] = $file_name;

               //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);


                if($this->upload->do_upload('categorie_icon')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{

                	$this->session->set_flashdata('error_msg', 'Only .jpg .jpeg .png File Allowed To Upload');
                	redirect('index.php/home/edit_category/'.$category_id, 'refresh');
                    
                }

              $update_category_image = $this->Category_model->update_category_image($category_id,$login_user_id,$file_name);

              if($update_category_image){

            	 $this->session->set_flashdata('success_msg', 'Category icon has been Updated Successfully.');

              }else{

                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
               
               }


         }//close_if_block For category icons selected to upload





      $updateCategoryData = $this->Category_model->update_category_data($category_id,$category_name,$category_description,$login_user_id);

      $this->session->set_flashdata('success_msg', 'Category Details has been Updated Successfully.');
      redirect('index.php/home/managed_categorys', 'refresh');
        


	}else{

		$this->session->set_flashdata('error_msg', 'Please Fill All the Fields are Required.');
      	redirect('index.php/home/edit_category/'.$category_id, 'refresh');

	}


}



 public function delete_category($category_id = NULL){

 		if(!empty($category_id)){    //get_delete_category_id_request

		 $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id	

		 $get_delete['data'] = $this->Category_model->get_delete_category($category_id,$login_user_id); 


		 $this->session->set_flashdata('success_msg', 'Category has been Deactivated Successfully.');

		 redirect('index.php/home/managed_categorys', 'refresh');
	

 		}

 }



public function active_category($category_id = NULL){
	# Active...
	if(!empty($category_id)){    //get_active_category_id_request
	
	 $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id

	 $get_active['data'] = $this->Category_model->get_active_category($category_id,$login_user_id); 

	 $this->session->set_flashdata('success_msg', 'Category has been Activated Successfully.');

	  redirect('index.php/home/managed_categorys', 'refresh');

	}


}





public function store_add_category(){

    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];
    $categorie_icon = $_FILES['categorie_icon']['name'];

    if(empty($category_name) || empty($category_description) || empty($_FILES['categorie_icon']['name'])) {
      
      $this->session->set_flashdata('error_msg', 'Please fill all fields.');
      redirect('index.php/home/add_category');

     }
    else{





	if(!empty($_POST['category_name']) && !empty($_POST['category_description']) && !empty($_FILES['categorie_icon']['name']) ){

			 //check file type if image or not

			//Check whether user upload picture, name and description exist or not
   

              $category_name = $_POST['category_name']; //category_name
              $category_description = $_POST['category_description']; //category_description
              $get_file_name = $_FILES['categorie_icon']['name']; //get_file_name
              $remove_space_file_name = str_replace(" ", "", $get_file_name); //removed space

              $random_str = md5(rand(8,1000));

              $file_name = $random_str.'_'.$remove_space_file_name;


              $config['upload_path'] = 'uploads/images/';
              $config['allowed_types'] = 'jpg|jpeg|png';
              $config['file_name'] = $file_name;

               //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);


                if($this->upload->do_upload('categorie_icon')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{

                	$this->session->set_flashdata('error_msg', 'Only .jpg .jpeg .png File Allowed To Upload');
                	redirect('index.php/home/add_category', 'refresh');
                    
                }


            //Prepare array of category data
            $categoryData = array(
                'cname' => $category_name,
                'cdetails' => $category_description,
                'cicon' => $file_name,
                'uid' => $this->session->userdata['logged_in']['id'],
            );


            	//Pass category data to model
              $insertCategoryData = $this->Category_model->insert_category_data($categoryData);

               //Storing insertion status message.
            if($insertCategoryData){

            	 $this->session->set_flashdata('success_msg', 'Category has been Added Successfully.');

            }else{

                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }


              redirect('index.php/home/add_category', 'refresh');
	  		 //$this->load->view('add_category');


		 }else{  $this->load->view('add_category'); }

    

}

}



			/* ---------------------  Products  Section   ---------------------- */




public function view_products(){
												
	   $CategoryData['clist'] = $this->Product_model->Get_Category_Row();
     //$CategoryData['clistdata'] = $this->Product_model->Get_Category_Row_From_Category();
     //$this->load->view('add_products',$CategoryData);
    //$CategoryData['temp'] = $this->Product_model->get_add_product(); 	

	if(isset($CategoryData['clist'])) {
       		 
	    $this->load->view('add_products',$CategoryData); 
     }
    else{
		
  		$this->load->view('add_products');
  	}

}



public function managed_products(){

    $CategoryData['clistdata'] = $this->Product_model->Get_Category_Row_From_Category();
    $CategoryData['temp'] = $this->Product_model->get_add_product();

    if(!empty($CategoryData['temp']) && $CategoryData['temp'] !== 'undefine') {
           
      $this->load->view('managed_products',$CategoryData); 
     }
    else{
      $this->load->view('managed_products');
    }

}






public function add_products(){


    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $category_name = $_POST['category_name'];

    //print_r($category_name);
    //die();  


	 if(empty($_FILES['product_icon']['name']) || $_FILES['product_icon']['name'] === 'undefine' ){

      $this->session->set_flashdata('error_msg', 'Please Select Product Image, In .jpg .jpeg .png File Format');

	  	redirect('index.php/home/view_products', 'refresh');

	 }


    if(empty($product_name) || empty($product_description) || empty($product_price) || empty($category_name) ){

      $this->session->set_flashdata('error_msg', 'Please Fill All the Fields are Required.');

      redirect('index.php/home/view_products', 'refresh');

    }

		
	
  if( !empty($_POST['product_name']) && !empty($_POST['product_description']) && !empty($_POST['product_price']) && !empty($_POST['category_name']) && !empty($_FILES['product_icon']['name']) ){   


  	$uid = $this->session->userdata['logged_in']['id'];
	$product_name = $_POST['product_name'];
	$product_description = $_POST['product_description'];
	$product_price = $_POST['product_price'];
	$category_names_array = $_POST['category_name'];

	//print_r($category_names); //array of category names
	$category_id = implode(",", $category_names_array); //seprate with commas

	$product_image = $_FILES['product_icon']['name']; 
	$product_icon = str_replace(" ", "", $product_image);


	//$product_icon_array = $_FILES['product_icon']['name'];
	//print_r($product_icon_array);  //array of products images name
	//$prod_names = implode(",", $product_icon_array);   //seprate with commas
	//$file_names_with_commas = str_replace(" ", "", $prod_names); //removed blank space
	//$myfilenameArray = explode(',', $file_names_with_commas); //get_file_names_in_array
	//$noofimages = count($product_icon_array);


			  $config['upload_path'] = 'uploads/images/';
              $config['allowed_types'] = 'jpg|jpeg|png';
              $config['file_name'] = $product_icon;

               //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);


                if($this->upload->do_upload('product_icon')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{

                	$this->session->set_flashdata('error_msg', 'Only .jpg .jpeg .png File Allowed To Upload');
                	redirect('index.php/home/view_products', 'refresh');
                    
                }



            //Prepare array of category data
            $ProductData = array(
                'pname' => $product_name,
                'product_category' => $category_id,
                'product_price' => $product_price,
                'product_description' => $product_description,
                'product_image' => $product_icon,
                'uid' => $this->session->userdata['logged_in']['id']
            );


              	//Pass Product data to model category table
             $insertProductData = $this->Product_model->insert_product_data($ProductData);


             //Storing insertion status message.
            if($insertProductData){

            	 $this->session->set_flashdata('success_msg', 'Product has been Added Successfully.');

            }else{

                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }


            redirect('index.php/home/view_products', 'refresh');
	 



      /*
         if(!empty($uploadData)){

         	 //$insert = $this->file->insert($uploadData);

         	 $data['produ_temp'] = $this->Product_model->insert_product_data($product_name,$product_description,$product_price,$category_names,$uid,$uploadData); 


            $this->session->set_flashdata('success_msg', 'Product has been Added Successfully.');
            redirect('index.php/home/add_products', 'refresh');

         }else{

            $this->session->set_flashdata('error_msg', 'Only .jpg .jpeg .png File Allowed To Upload');
                	
            redirect('index.php/home/add_products', 'refresh');
                   
            }  
        */


    }
    else{  

    	$this->load->view('view_products'); 
     }


	
 }











 public function delete_product($product_id = NULL){

 		if(!empty($product_id)){    //get_delete_product_id_request

		 $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id	

		 $get_delete['data'] = $this->Product_model->get_delete_product($product_id,$login_user_id); 


		 $this->session->set_flashdata('success_msg', 'Product has been Deactivated Successfully.');

		 redirect('index.php/home/managed_products', 'refresh');

 		}

 }




public function active_product($product_id = NULL){
	# Active...

	if(!empty($product_id)){    //get_active_product_id_request
	
	 $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id

	 $get_active['data'] = $this->Product_model->get_active_product($product_id,$login_user_id); 

	 $this->session->set_flashdata('success_msg', 'Product has been Activated Successfully.');

	  redirect('index.php/home/managed_products', 'refresh');

	}


}





public function edit_product($product_id = NULL){

	if(!empty($product_id)){    //get_edit_product_id_request


		 $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id
		 $get_edit['data'] = $this->Product_model->get_edit_product($product_id,$login_user_id); 

		 $get_edit['clist'] = $this->Product_model->Get_Category_Row();


		 $this->load->view('edit_product',$get_edit);
	}


}



public function update_product(){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $category_name = $_POST['category_name'];



     /* Check Form Data are empty or not, if empty show error */

    if(empty($product_name) || empty($product_description) || empty($product_price) || empty($category_name) ){

      $this->session->set_flashdata('error_msg', 'Please Fill All the Fields are Required.');

      redirect('index.php/home/edit_product/'.$product_id, 'refresh');

    }



    /* Check Other Product Image is More than 5 or not */
   
    $getotherfilesname = $_FILES['other_product_image']['name'];

    if(!empty($getotherfilesname)){

         $filesCount_getotherfilesname = count($_FILES['other_product_image']['name']);

        if($filesCount_getotherfilesname > 5){

        $this->session->set_flashdata('error_msg', 'You Can Only Select 5 Images for Products.');
      
        redirect('index.php/home/edit_product/'.$product_id, 'refresh');

        //die();

      }

    }




	 if(isset($_POST['product_name']) && isset($_POST['category_name']) && isset($_POST['product_description']) && isset($_POST['product_price']) ){


		$product_id = $_POST['product_id'];       //product_id
		$product_name = $_POST['product_name'];   //product_name
	 	$category_names_array = $_POST['category_name']; //category_name
		$category_name = implode(",", $category_names_array); //seprate with commas

    $product_description = $_POST['product_description']; //product_description
    $product_price = $_POST['product_price']; //product_price
    $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id	



         //if Primary Image selected to upload

         $get_file_name = $_FILES['product_icon']['name'];

         if(isset($get_file_name) && !empty($get_file_name) ){ 

             $remove_space_file_name = str_replace(" ", "", $get_file_name); //removed space

             $random_str = md5(rand(8,1000));

             $file_name = $random_str.'_'.$remove_space_file_name;


              $config['upload_path'] = 'uploads/images/';
              $config['allowed_types'] = 'jpg|jpeg|png';
              $config['file_name'] = $file_name;

               //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);


                if($this->upload->do_upload('product_icon')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{

                $this->session->set_flashdata('error_msg', 'Only .jpg .jpeg .png File Allowed To Upload');
                	redirect('index.php/home/edit_product/'.$product_id, 'refresh');
                    
                }

              $update_product_primary_image = $this->Product_model->update_product_primary_image($product_id,$login_user_id,$file_name);

              if($update_product_primary_image){

            	 $this->session->set_flashdata('success_msg', 'Product Primary Image has been Updated Successfully.');

              }else{

                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
               
               }

            }


         } //close_if_block For Product Primary Iamge selected to upload



          /*   Start --> if Other Product Image Selected to upload  	*/


        $get_other_files_name = array_filter($_FILES['other_product_image']['name']);
        
    if(!empty($get_other_files_name)){ //if for other products

        foreach($_FILES['other_product_image']['tmp_name'] as $key => $tmp_name ){

		 		   $other_file_name = $key.$_FILES['other_product_image']['name'][$key];
    	 		   $other_file_size = $_FILES['other_product_image']['size'][$key];
    	   		   $other_file_tmp = $_FILES['other_product_image']['tmp_name'][$key];
    	           $other_file_type = $_FILES['other_product_image']['type'][$key];


    	           $extensions = array("jpeg","jpg","png");
    	           $file_ext = explode('.',$_FILES['other_product_image']['name'][$key]);
    	           $file_ext = end($file_ext);  

    	           //$other_product_image_name = $_FILES['other_product_image']['name'][$key];
                 //$value = explode('.',$other_product_image_name);
                 //$extension = end($value);
				         //$file_ext = strtolower($extension);  

                }//foreach_close
					
				 if(in_array($file_ext,$extensions ) === false){
 				
 				       $this->session->set_flashdata('error_msg', 'Only .jpg .jpeg .png File Allowed To Upload');
                 redirect('index.php/home/edit_product/'.$product_id, 'refresh');
				 	
				 }else{	

				 	      $filesCount = count($_FILES['other_product_image']['name']);

				 	      	$temp = array();

               				for($i = 0; $i < $filesCount; $i++){
                			
                				$_FILES['file']['name']     = $_FILES['other_product_image']['name'][$i];
                				$_FILES['file']['type']     = $_FILES['other_product_image']['type'][$i];
                				$_FILES['file']['tmp_name'] = $_FILES['other_product_image']['tmp_name'][$i];
                				$_FILES['file']['error']    = $_FILES['other_product_image']['error'][$i];
                				$_FILES['file']['size']     = $_FILES['other_product_image']['size'][$i];
                
                				// File upload configuration
                				$config['upload_path'] = 'uploads/images/';
                				$config['allowed_types'] = 'jpg|jpeg|png';

                
                				// Load and initialize upload library
                				$this->load->library('upload', $config);
                				$this->upload->initialize($config);


                				// Upload file to server
                				if($this->upload->do_upload('file')){
                				    // Uploaded file data
                				  $fileData = $this->upload->data();
                				  $uploadData[$i]['file_name'] = $fileData['file_name'];
                				  //$uploadData[$i]['file_name'] = str_replace(" ", "",$fileData['file_name']);

                				  //$temp[$i] = str_replace(" ", "",$fileData['file_name']);

                          //echo "<pre>";
                          //print_r($upldelete_products_imageoadData[$i]); 
                          //die();

               					 }

               					
               				}

                       //echo "<pre>";
                      //echo $jsondata = json_encode($uploadData);
                       $file_names = array_column($uploadData, 'file_name');
                       //print_r($file_names);  //get filesname in single array from uploadData.
                       $file_names = implode(',', $file_names);  //get filesname with commas
                       //$file_names = str_replace(" ", "",$file_names);

                     //print_r($file_names); 
                     //die();
               			//$random_str = md5(rand(8,1000));
               			//$prefixed_array = preg_filter('/^/',$random_str.'_', $file_names);
               			//$other_product_files_with_commma = implode(",", $file_names);
               			//$file_names = str_replace(" ", "", $other_product_files_with_commma);
               		  //$other_product_files_with_commma = implode(",", $file_names[$i]['file_name']);
               		  //$file_names = implode(",", $file_names);
               		  //$file_names = implode(',', $temp);
               			 
                 	 $update_product_other_image = $this->Product_model->update_product_other_image($product_id,$login_user_id,$file_names);


                   //print_r($update_product_other_image);
                   //die();

                 	if(isset($update_product_other_image)){

            	     	$this->session->set_flashdata('success_msg', 'Product Other Images has been Updated Successfully.');

              		 }else{
					
					             $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
               
              		 }




				 }//else_close            
		 		

			} //Other Product Image Selected to upload





         	 /*   End --> if Other Product Image Selected to upload  	*/


      $updateProductData = $this->Product_model->update_product_data($product_id,$product_name,$category_name,$product_description,$product_price,$login_user_id);

      $this->session->set_flashdata('success_msg', 'Product Details has been Updated Successfully.');
      redirect('index.php/home/edit_product/'.$product_id, 'refresh');
        //edit_product/'.$product_id

 }




  /*--------------------------------  Start View All Category   ------------------------------------*/
    
public function view_all_category(){

    //$allcategorydata['allcategorydata'] = $this->Viewallcategory_model->Get_all_category_Row();  

    $config = array();
    $config['base_url'] = base_url('/index.php/home/view_all_category');
    $total_row = $this->Viewallcategory_model->record_count();
    $config['total_rows'] = $total_row;
    $config['per_page'] = 3;
    $config["uri_segment"] = 3;
    $config['use_page_numbers'] = TRUE;
    
    $choice = $config["total_rows"] / $config["per_page"];
    $config["num_links"] = round($choice);
    $config['full_tag_open'] = '<div class="container"><ul class="pagination">';
    $config['full_tag_close'] = '</ul></div>';
    $config['prev_link'] = 'Previous';

    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</div>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $config['next_link'] = 'Next';


    $this->pagination->initialize($config);

    if($this->uri->segment(3)){
      $page = ($this->uri->segment(3));
     }else{
       $page = 0;
    }

    $allcategorydata['allcategorydata'] = $this->Viewallcategory_model->Get_all_category_Row($config["per_page"], $page);

    //$data["results"] = $this->pagination_model->fetch_data($config["per_page"], $page);
    //$str_links = $this->pagination->create_links();
    //$allcategorydata["links"] = explode('&nbsp;',$str_links);

    $allcategorydata["links"] = $this->pagination->create_links();

    $this->load->view('view_all_category',$allcategorydata); 

}


public function view_categorys_product($id,$string,$page_no = ''){


    $config = array();
    $config['base_url'] = base_url('/index.php/home/view_categorys_product/'.$id.'/'.$string.'/');
    $total_row = $this->Viewallproducts_model->record_count($id);
    //print_r($id);
    //die();

    $config['total_rows'] = $total_row;
    $config['per_page'] = 6;
    $limit = $config['per_page'];

    $config["uri_segment"] = 0;
    $config['use_page_numbers'] = TRUE;

    $choice = $config["total_rows"] / $config["per_page"];
    $config["num_links"] = round($choice);
    $config['full_tag_open'] = '<div class="container"><ul class="pagination">';
    $config['full_tag_close'] = '</ul></div>';
    $config['prev_link'] = 'Previous';

    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</div>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $config['next_link'] = 'Next';

    $this->pagination->initialize($config);

    if(isset($page_no) && !empty($page_no)){

    $page = $page_no;
      
    }elseif($page_no == ''){

      $page = 0;
    }
    else{

       $page = 0;

    }

  


  $catdetails['catdetails'] = $this->Viewallcategory_model->get_categorydetails($id,$page,$limit);

  $catdetails["links"] = $this->pagination->create_links();

  $this->load->view('view_all_category_products',$catdetails); 

  
}

  /*--------------------------------  End View All Products   ------------------------------------*/






	/*--------------------------------  Start View All Products   ------------------------------------*/


//public function view_all_products(){

  //$allcategorydata['allcategorydata'] = $this->Viewallproducts_model->Get_all_category_Row();  
  //$this->load->view('view_all_products',$allcategorydata); 
  //$allproductdata['clistdata'] = $this->Product_model->Get_Category_Row_From_Category();
	//$allproductdata['allproductdata'] = $this->Viewallproducts_model->Get_all_products_Row();  
  //$this->load->view('view_all_products',$allproductdata); 

//}


/*--------------------------------  End View All Products   ------------------------------------*/



public function view_product($id){

$productdetails['productdetails'] = $this->Viewallproducts_model->get_productdetails($id);

   $this->load->view('view_product_details',$productdetails); 

}





public function delete_products_image($pid,$imagename){

  //echo $pid;
  //echo $imagename;
  //die();
  $login_user_id = $this->session->userdata['logged_in']['id']; //login user_id

  $deleteproductsimage['deleteproductimage'] = $this->Viewallproducts_model->delete_productimage($login_user_id,$pid,$imagename);

    if(isset($deleteproductsimage) && !empty($deleteproductsimage)){

    $this->session->set_flashdata('success_msg', 'Products Image has been Removed Successfully.');
    redirect('index.php/home/edit_product/'.$pid, 'refresh');
    
    }
    else{

      $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
      redirect('index.php/home/edit_product/'.$pid, 'refresh');

    }


}






}
?>