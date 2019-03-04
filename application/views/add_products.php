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
  
    $("#ProductForm").validate({
        rules: {
            product_name: "required",
            product_description: "required",
            category_name: "required",
            product_icon:  "required",
            product_price: "required",


        },
        messages: {
            product_name: "Please Enter Product Name",
            product_description: "Please Enter Product Descriptions",
            category_name: "Please Select Product Category",
            product_icon:  "Please Select Product Primary Image",
            product_price: { 

                           required: "Please Enter Product Price",
                           number: "Please Enter Only Numeric Value or Decimal Value"
                    }


        }
    });


    $('#mytable').DataTable();
    $("[data-toggle=tooltip]").tooltip();



});


</script>







<div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h4>Add New Products</h4>
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


<form class="form-horizontal"  id="ProductForm" name="ProductForm" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('index.php/home/add_products'); ?>" target="_self">
 
 <fieldset>
<!-- Form Name -->
<legend>Products Details</legend>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">PRODUCT NAME:</label>  
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="PRODUCT NAME" class="form-control input-md" type="text">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="">PRODUCT DESCRIPTION: </label>  
  <div class="col-md-4">
<textarea class="form-control" maxlength='120'  id="product_description" name="product_description" placeholder="CATEGORY DESCRIPTION"></textarea><span id="char_left"></span>
  </div>
</div>




<div class="form-group">
  <label class="col-md-4 control-label" for="">CATEGORY NAME: </label>  
  <div class="col-md-4">
 
<select multiple name="category_name[]" id="category_name" required="required">
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






<!-- Select Basic -->
 <div class="form-group">
  <label class="col-md-4 control-label" for="">PRODUCTS IMAGE: </label>
  <div class="col-md-4">
    <input id="product_icon" name="product_icon" class="input-file" type="file" accept="image/x-png,image/gif,image/jpeg" />
  </div>
</div>


<!-- Select Basic -->
 <div class="form-group">
  <label class="col-md-4 control-label" for="">PRODUCTS PRICE (₹):</label>
  <div class="col-md-4">
    <input id="product_price" name="product_price" placeholder="PRODUCT PRICE" class="form-control input-md" type="text" ondrop="return false;" >&nbsp;<span id="errmsg"></span>
  </div>
</div>




<!-- Button -->
<div class="form-group">
  <div class="col-md-4 center-block">
    <button id="add_product" type="submit" name="btn_add_product" class="btn btn-primary center-block">Add Product</button>
    </div>
  </div>

</fieldset>
</form>

</div>  <!-- /#page-wrapper -->
</div><!-- /#wrapper -->




<div class="push"></div>
</div>

<?php require 'dashboard_footer.php'; ?>



<script>

  $(document).ready(function() {

            /* Price Text Box */

  //called when key is pressed in textbox
  $("#product_price").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which <= 45 || e.which > 57)  ) {
        //display error message
        $("#errmsg").html("Product Price Accept Numberic or Decimal Value Only").show().fadeOut("slow");
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
