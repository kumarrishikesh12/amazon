<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php require 'dashboard_header.php'; ?>

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

    /*color: #ffffff !important; */
    text-decoration: none !important;
}


.styled-select select {
   background: transparent;
  
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 268px;
}

.btn {
    display: inline-block !important;
  }



input[type="file"] {
  display: block;
}

.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}

.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}

.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}

.remove:hover {
  background: white;
  color: black;
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
  
    $("#CategoryForm").validate({
        rules: {
            category_name: "required",
            category_description: "required",
        },
        messages: {
            category_name: "Please Enter Category Name",
            category_description: "Please Enter Category Descriptions",
        }
    });
});


</script>



<div class="container">
  <div class="row">
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h4>Edit Category</h4>
                </div>
            </div>
            <!-- /.row -->



              <?php

                  $success_msg = $this->session->flashdata('success_msg');  

                  $error_msg = $this->session->flashdata('error_msg');
    
                   if(!empty($success_msg)){
                        echo '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$success_msg.'</div>';

                    }elseif(!empty($error_msg)){

                       echo '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$error_msg.'</div>';

                    }
               ?>

<form class="form-horizontal" id="CategoryForm" class="CategoryForm" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('index.php/home/update_category'); ?>" target="_self">
 
 <fieldset>
<!-- Form Name -->
<legend>Update Category Details</legend>

<?php 

foreach($data as $post) {

 ?>



 <input id="category_id" type="hidden" name="category_id" id="category_id" value="<?php echo $post->cid; ?>">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">CATEGORY NAME:</label>  
  <div class="col-md-4">
  <input id="category_name" name="category_name" placeholder="CATEGORY NAME" class="form-control input-md" type="text" value="<?php echo $post->cname; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">CATEGORY DESCRIPTION: </label>  
  <div class="col-md-4">
 
<textarea class="form-control" id="category_description" name="category_description" placeholder="CATEGORY DESCRIPTION"><?php echo $post->cdetails; ?></textarea>
    
  </div>
</div>





<div class="form-group">
   <label class="col-md-4 control-label" for=""> CHANGE CATEGORY ICONS: </label>
    <div class="col-md-4">
        <input type="file" class="input-file" id="categorie_icon" name="categorie_icon"/>
    </div>
</div>




<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">


<?php  if(!empty($post->cicon)){ 

    $mycicon = $post->cicon;

 ?> 

 <a target="_blank" href="<?php echo base_url('uploads/images/'.$mycicon); ?>">
  <img name="categorie_icons[]" class="icons" src="<?php echo base_url('uploads/images/'.$mycicon); ?>" alt="no image found" style="width:150px">
</a>
<?php } ?>

  </div>
</div>


 






<div class="container">

    <button id="update_category" type="submit" name="btn_update_category" class="btn btn-primary center-block">Update Category</button>

   <button class="btn btn-default" onclick="window.history.go(-1); return false;" type="button">  Back to Category </button>

</div>



</fieldset>
</form>


 <?php 
   } 
  ?>

</div>  <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
</div>
</div>


<div class="push"></div>
</div>

<?php require 'dashboard_footer.php'; ?>