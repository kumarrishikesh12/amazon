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

#errmsg
{
color: red;
}


.mypreview {
  border: 1px solid #ddd; /* Gray border */
  border-radius: 4px;  /* Rounded border */
  padding: 5px; /* Some padding */
  width: 150px; /* Set a small width */
}

/* Add a hover effect (blue shadow) */
.mypreview:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}



input.error {
    border: 1px dotted red;
}

label.error{
    width: 100%;
    color: red;
   
}
.ProductForm input.submit {
    margin-left: 120px;
}

.closeDiv {
  width: 20px;
  height: 21px;
  background-color: rgb(35, 179, 119);
  float: left;
  cursor: pointer;
  color: white;
  box-shadow: 2px 2px 7px rgb(74, 72, 72);
  text-align: center;
  margin: 5px;
}

.pDiv {
    float:left;
    width:100%;
    display: inline-flex;
}


img {
  border: 0 none;
  display: inline-block;
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}

#closeimg{

    color: #ffffff !important; 
    text-decoration: none !important;

}

</style>



<script>

$(document).ready(function() {
  
    $("#ProductForm").validate({
        rules: {
            product_name: "required",
            product_description: "required",
            category_name: "required",
            product_price: "required",
            "category_name[]": "required",
            
      
        },
        messages: {
            product_name: "Please Enter Product Name",
            product_description: "Please Enter Product Descriptions",
            category_name: "Please Select Category",
            product_price: { 

                           required: "Please Enter Product Price",
                           number: "Please Enter Only Numeric Value or Decimal Value"
                    }, 
            "category_name[]": "Please Select Product Category",
         
        }
    });




/* Show alert if File Selecter more than 5 */

$("#other_product_image").change(function(){

     if($("#other_product_image")[0].files.length > 5) {             
              alert("You can Upload only 5 images");
              $('#other_product_image').val(null);

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
                    <h4>Edit Product</h4>
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




<form class="form-horizontal" id="ProductForm" name="ProductForm" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('index.php/home/update_product'); ?>" target="_self">
 
 <fieldset>
<!-- Form Name -->
<legend>Update Product Details</legend>


<?php 

foreach($data as $post) {

 ?>



 <input type="hidden" name="product_id" id="product_id" value="<?php echo $post->pid; ?>">

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">PRODCUT NAME:</label>  
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" type="text" value="<?php echo $post->pname; ?>">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="">CATEGORY NAME: </label>  
  <div class="col-md-4">
 
<select multiple name="category_name[]" id="category_name">
 <?php if(!empty($clist)) { 

     foreach($clist as $cat_list) {
  ?>
    
  <option value="<?php echo $cat_list->cid; ?>"><?php echo $cat_list->cname; ?></option>

<?php 
  }
 }
?>

</select>
    
  </div>  
</div> 







<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">PRODUCT DESCRIPTION: </label>  
  <div class="col-md-4">
 
<textarea class="form-control" id="product_description" name="product_description" placeholder="PRODUCT DESCRIPTION"><?php echo $post->product_description; ?></textarea><span id="char_left"></span>
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">PRODUCT PRICE (₹):</label>  
  <div class="col-md-4">
  <input id="product_price" name="product_price" placeholder="PRODUCT PRICE" class="form-control input-md" type="text" value="<?php echo $post->product_price; ?>" ondrop="return false;">&nbsp;<span id="errmsg"></span>
    
  </div>
</div>



<div class="form-group">
   <label class="col-md-4 control-label" for=""> CHANGE PRIMARY PRODUCTS IMAGE: </label>
    <div class="col-md-4">
        <input type="file" class="input-file" id="product_icon" name="product_icon"/>
    </div>
</div>




<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4">


<?php if(!empty($post->product_image)){ 

    $mypics = $post->product_image;

 ?> 

 <a target="_blank" href="<?php echo base_url('uploads/images/'.$mypics); ?>">
  <img name="product_icons[]" class="icons" src="<?php echo base_url('uploads/images/'.$mypics); ?>" alt="no image found" style="width:150px"> 
</a>

<?php } ?>

  </div>
</div>





<div class="form-group">
   <label class="col-md-4 control-label" for=""> OTHER PRODUCTS IMAGE: </label>
    <div class="col-md-4">
       <input type="file" class="input-file" id="other_product_image" multiple="multiple" name="other_product_image[]"/>
    </div>
</div>






<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4 img-responsive inline-block">


<?php  if(!empty($post->other_product_image)){ 

    $myString = $post->other_product_image;
    $myArray = explode(',', $myString);
    $no_of_images = count($myArray);
    //die();
  
  for($i=0; $i<$no_of_images; ++$i){
  
 ?> 
<div class="pDiv">
 <a target="_blank" href="<?php echo base_url('uploads/images/'.$myArray[$i]); ?>">

  <img name="removed_other_product_image[]" class="icons" src="<?php echo base_url('uploads/images/'.$myArray[$i]); ?>" alt="no image found" style="width:150px">

   <div class="closeDiv"><a id="closeimg" href="<?php echo base_url('index.php/home/delete_products_image/'.$post->pid.'/'.$myArray[$i]) ?> "> X </a></div>

</a>
</div>


 <?php
   }
  } 
 ?>

  </div>
</div>




<!-- Button -->
<div class="container center-block">
  
  <button id="update_product" type="submit" name="btn_update_product" class="btn btn-primary ">Update Product</button>
  <button class="btn btn-default" onclick="window.history.go(-1); return false;" type="button"> Back to Product </button>

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

});


</script>



<script>

  $(document).ready(function() {
    
            /* Price Text Box */

  //called when key is pressed in textbox
  $("#product_price").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
   if (e.which != 8 && e.which != 0 && (e.which <= 45 || e.which > 57)  ) {
        //display error message
        $("#errmsg").html("Product Price Accept Numberic Only").show().fadeOut("slow");
               return false;
    }
   });

      /* Disabled Cut Copy Paste */

     $('#product_price').bind("cut copy paste",function(e) {
          e.preventDefault();
      });


           /*  Disabled / Symbol */  
     $("#product_price").keypress(function (evt) {
      var keycode = evt.charCode || evt.keyCode;
      if (keycode  == 47) { //Enter key's keycode  /
       $("#errmsg").html("Product Price Accept Numberic or Decimal Value Only").show().fadeOut("slow");
       return false;
      }
      
      });


     /* Allow Only 2 Poin Decimal */
    $('#product_price').keypress(function(event) {
    var $this = $(this);
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $(this).val();
    if ((event.which == 46) && (text.indexOf('.') == -1)) {
        setTimeout(function() {
            if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
            }
        }, 1);
    }

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
    }      
});

$('#product_price').bind("paste", function(e) {
var text = e.originalEvent.clipboardData.getData('Text');
if ($.isNumeric(text)) {
    if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
        e.preventDefault();
        $(this).val(text.substring(0, text.indexOf('.') + 3));
   }
}
else {
        e.preventDefault();
     }
});



});

</script>