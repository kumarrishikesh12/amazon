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
  
    $("#CategoryForm").validate({
        rules: {
            category_name: "required",
            category_description: "required",
            categorie_icon: "required",

        },
        messages: {
            category_name: "Please Enter Category Name",
            category_description: "Please Enter Category Descriptions",
            categorie_icon: "Please Select Category icon",
        }
    });





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
                    <h4>Add New Category</h4>
                </div>
            </div>
            <!-- /.row -->



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

<form class="form-horizontal" id="CategoryForm" name="CategoryForm" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('index.php/home/store_add_category'); ?>" target="_self">
 
 <fieldset>
<!-- Form Name -->
<!-- <legend>Category Details</legend> -->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label">CATEGORY NAME:</label>  
  <div class="col-md-4">
  <input id="category_name" name="category_name" placeholder="CATEGORY NAME" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label">CATEGORY DESCRIPTION: </label>  
  <div class="col-md-4">
 
<textarea class="form-control" maxlength='120' rows="3" id="category_descriptions" name="category_description" placeholder="CATEGORY DESCRIPTION"></textarea>
   <span id="char_left"></span>
  </div>
</div>

<!-- Select Basic -->

 <div class="form-group">
  <label class="col-md-4 control-label">CATEGORY ICONS: </label>
  <div class="col-md-4">
    <input id="categorie_icon" name="categorie_icon" class="input-file" type="file">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <div class="col-md-4 center-block">
    <button id="add_category" type="submit" name="btn_add_category" class="btn btn-primary center-block">Add Category</button>
    </div>
  </div>

</fieldset>
</form>

</div>  <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
</div>
</div>


 <div class="push"></div>
</div>

<?php require 'dashboard_footer.php'; ?>



<script>

  $(document).ready(function() {
    
  var len = 0;
  var maxchar = 120;

  $('#category_descriptions').keyup(function(){
    len = this.value.length
    if(len > maxchar){
        return false;
    }
    else if (len > 0) {
        $( "#char_left" ).html( "Remaining characters: " +( maxchar - len ) );
    }
    else {
        $( "#char_left" ).html( "Remaining characters: " +( maxchar ) );
    }
  })


       /* Search Box*/

/*$("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


});*/

</script>

