<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php require 'dashboard_header.php'; 

 error_reporting(E_ALL ^ E_NOTICE);

 ?>
  

  <style type="text/css">

.center-block {
    display: block;
    margin-right: auto;
    margin-left: 25% !important;
}

.icons {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 50px !important;
}

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}

a{

    text-decoration: none !important;
}

.btncolor{

  color: #ffffff !important;
  text-decoration: none !important;

}


.styled-select select {
   background: transparent;
  
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 268px;
}

#errmsg
{
color: red;
}



.table-responsive {
    min-height: .01%;
    overflow-x: auto;
    margin-top: 15px !important;
}


input.error {
    border: 1px dotted red;
}

label.error{
    width: 100%;
    color: red;
   
}
.userform input.submit {
    margin-left: 120px;
}


</style>



<script>

$(document).ready(function() {

  
    $('#mytable').DataTable();
    $("[data-toggle=tooltip]").tooltip();



});


</script>




<div class="container">
    <div class="row">
      <div id="page-wrapper">
         <div class="container-fluid">

         	 <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h4>Managed Products</h4>
                </div>
            </div>


                       <?php

                       if ($this->session->flashdata('success_msg')) { ?>
                      
                       <div id="success_msg" class="alert alert-success alert-dismissible">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?= $this->session->flashdata('success_msg') ?> 
                       </div>
                      
                       <?php } ?>


                       <?php if ($this->session->flashdata('error_msg')) { ?>
                       
                       <div id="error_msg" class="alert alert-danger alert-dismissible"> 
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?= $this->session->flashdata('error_msg') ?> 
                       </div>
                       
                       <?php } 

                        ?>




<fieldset>
<legend>View/Edit/Delete Products</legend>

<!--  <input class="form-control" id="myInput" type="text" placeholder="Search.."> -->


 <div class="table-responsive">

                
    <table id="mytable" class="table table-bordred table-striped" cellspacing="0" width="100%">
                   
                   <thead>
                    <tr>
                    <th>Sr.No</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th> 
                    <th>icon</th>
                    <th>Edit</th>
                    <th>Active/Deactive</th>
               		</tr>
                   </thead>

                   <tfoot>
                   	<tr>
                    <th>Sr.No</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th> 
                    <th>icon</th>
                    <th>Edit</th>
                    <th>Active/Deactive</th>
               		</tr>
                   </tfoot>



    <tbody>

    <?php
    if(!empty($temp)) { 
        
      
      for ($index = 0; $index < count($temp); $index++) {
        

        $temp[$index]->mysummary = $clistdata[$index]->mysummary;

        //$temp[$index]->mysummary = $clistdata[$index]->mysummary;
      
      }  

        //echo "<pre>"; 	
    	//print_r($result);
    	//die();

      
       foreach($temp as $post) {
     ?>
        <tr>

        <td><p> <?php echo $post->pid; ?> </p> </td>
        <td><p> <?php echo $post->pname; ?> </p> </td>
        <td><p> <?php echo $post->mysummary; ?> </p> </td>
        <td><p> <?php echo substr($post->product_description, 0, 120); ?> </p> </td>
        <td><p> <?php echo $post->product_price; ?> </p> </td>
        <td><p> <?php echo $post->product_status; ?> </p> </td>




        <td><a target="_blank" href="<?php echo base_url('uploads/images/'.$post->product_image); ?>"><img name="icons" class="icons" src="<?php echo base_url('uploads/images/'.$post->product_image); ?>" alt="Forest" style="width:150px"> </a></td>

    <?php if($post->uid === $this->session->userdata['logged_in']['id'] ){  ?>


        <td><p data-placement="top" data-toggle="tooltip" title="Edit"> <button type="button" class="btn btn-info"><a  class="btncolor" href="<?php echo base_url('index.php/home/edit_product/'.$post->pid); ?>"> Edit </a></button></p></td>


        <?php if($post->product_status === 'Active'){  ?>

    <td><p data-placement="top" data-toggle="tooltip" title="Deactivate"><button type="button" class="btn btn-danger"><a  class="btncolor" href="<?php echo base_url('index.php/home/delete_product/'.$post->pid); ?>"> Deactivate </a></button></p></td>

    <?php }else{ ?>

    <td><p data-placement="top" data-toggle="tooltip" title="Active"><button type="button" class="btn btn-success"><a  class="btncolor" href="<?php echo base_url('index.php/home/active_product/'.$post->pid); ?>"> Active </a></button></p></td>

      <?php
        }
       } //session value = upload user id
      ?>


    </tr>

   <?php 
    
   } //foreach 
  } //if
?>


</tbody>
</table>
</div>
</fieldset>
</div>
  </div>
    </div>
      </div>



<div class="push"></div>
</div>

<?php require 'dashboard_footer.php'; ?>