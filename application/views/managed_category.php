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


.btncolor{

  color: #ffffff !important;
  text-decoration: none !important;

}


a{
    text-decoration: none !important;
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

$(document).ready(function(){

    $('#mytable').DataTable();
    $("[data-toggle=tooltip]").tooltip();

});

</script>



<div class="container">
  <div class="row">
     <div id="page-wrapper"> 
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h4>Managed Category</h4>
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
<legend>View/Edit/Delete Category</legend>


<!-- <input class="form-control" id="myInput" type="text" placeholder="Search.."> -->


 <div class="table-responsive">

                                  
              <table id="mytable" class="table table-bordred table-striped" cellspacing="0" width="100%">
                   
                   <thead>
                    <tr>
                    <th>Sr.No</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Status</th> 
                    <th>icon</th>
                    <th>Edit</th>
                    <th>Active/Deactive</th>
                    </tr>
                   </thead>

                  <tfoot>
                    <tr>
                    <th>Sr.No</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Status</th> 
                    <th>icon</th>
                    <th>Edit</th>
                    <th>Active/Deactive</th>
                     </tr>
                  </tfoot>
    <tbody>

    <?php

    if(!empty($temp)) {

     foreach($temp as $post) {

     ?>


    <tr>
    <td><p> <?php echo $post->cid; ?> </p> </td>
    
    <td><p><?php echo $post->cname; ?></p></td>
    
    <td><p><?php echo substr($post->cdetails, 0, 120); ?> </p></td>

    <td><p><?php echo $post->category_status; ?> </p></td>

    <td><a target="_blank" href="<?php echo base_url('uploads/images/'.$post->cicon); ?>"><img name="icons" class="icons" src="
      <?php echo base_url('uploads/images/'.$post->cicon); ?>" alt="Forest" style="width:150px"></a></td>

    <?php 

    if($post->uid === $this->session->userdata['logged_in']['id'] ){  ?>


    <td><p data-placement="top" data-toggle="tooltip" title="Edit"> <button type="button" class="btn btn-info"><a class="btncolor" href="<?php echo base_url('index.php/home/edit_category/'.$post->cid); ?>"> Edit </a></button></p></td>

    
    <?php if($post->category_status === 'Active'){  ?>

    <td><p data-placement="top" data-toggle="tooltip" title="Deactivate"><button type="button" class="btn btn-danger"><a class="btncolor" href="<?php echo base_url('index.php/home/delete_category/'.$post->cid); ?>"> Deactivate </a></button></p></td>

    <?php }else{ ?>

      <td><p data-placement="top" data-toggle="tooltip" title="Active"><button type="button" class="btn btn-success"><a  class="btncolor" href="<?php echo base_url('index.php/home/active_category/'.$post->cid); ?>"> Active </a></button></p></td>

 <?php
     }
  }
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
