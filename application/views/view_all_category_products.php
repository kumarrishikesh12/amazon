<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php require 'dashboard_header.php'; ?>


<style type="text/css">


body .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
}
.card-product .img-wrap img {
    max-height: 100%;
    max-width: 100%;
    object-fit: cover;
}
.card-product .info-wrap {
    overflow: hidden;
    padding: 15px;
    border-top: 1px solid #eee;
}
.card-product .bottom-wrap {
    padding: 15px;
    border-top: 1px solid #cec9c9;
}


.label-rating { margin-right:10px;
    color: #333;
    display: inline-block;
    vertical-align: middle;
}

.card-product .price-old {
    color: #999;
}


.card-product .info-wrap {
    overflow: hidden;
    padding: 15px;
    border-top: 1px solid #b3b3b3;
}


</style>



<div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h4>View Categorys Products</h4>
                </div>

            <button class="add-to-cart btn btn-default" onclick="window.history.go(-1); return false;" type="button">  Back to Category </button>

            </div>
            <!-- /.row -->


<div class="row">



<?php if(!empty($catdetails)) { 

     foreach($catdetails as $product_list) {
?>



<div class="col-md-4">
  <figure class="card card-product">
    <div class="img-wrap"><img src="<?php echo base_url('uploads/images/'.$product_list->product_image); ?>"></div>
    <figcaption class="info-wrap">
        <h4 class="title text-center"><?php echo $product_list->pname; ?></h4>
        <p class="desc text-center"><?php echo $product_list->product_description; ?></p>
        <div class="rating-wrap">
<!--       <div class="label-rating">132 reviews</div>
          <div class="label-rating">154 orders </div> -->
         <!-- <p class="tag label label-info text-center"><?php //echo $product_list->mysummary; ?></p> -->
        </div> <!-- rating-wrap.// -->
    </figcaption>
    <center>
    <div class="bottom-wrap"> 

         <?php  

             $product_name = preg_replace("![^a-z0-9]+!i", "-", $product_list->pname);

         ?>

      <a href="<?php echo base_url('index.php/home/view_product/'.$product_list->pid.'/'.$product_name); ?>" class="btn btn-sm btn-primary float-right">Order Now</a> 
      <div class="price-wrap h5">
       <!--  <span class="price-new"><?php //echo '₹'.$product_list->product_price; ?></span> <del class="price-old">₹1200</del> -->
      </div> <!-- price-wrap.// -->
    </div> <!-- bottom-wrap.// -->
  </center>
  </figure>
</div> <!-- col // -->


<?php 
 
 }
}else{

 echo "<h2> Sorry !! No Active Products Found :( </h2>";

}

?>


</div> <!-- row.// -->
</div>
</div>



<?php if(!empty($links)){

 echo $links;

  }
?>



<div class="push"></div>
</div>

<?php require 'dashboard_footer.php'; ?>


