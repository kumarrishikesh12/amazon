<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php require 'dashboard_header.php'; ?>



<style type="text/css">

/*****************globals*************/
.action{

	 margin-bottom: 140px;
}

img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: #fff;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  margin-top: 80px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }


.wrapper {
    min-height: 100%;
    margin-bottom: 0px !important;
}


</style>


<div class="container">
     <div id="page-wrapper">
     
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h4> Product Details</h4>
                </div>
            </div>
            <!-- /.row -->

					<div class="col-md-6">
						
						  <?php if(!empty($productdetails)) {  

						     foreach($productdetails as $product_details) {
							?>
						  


						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="<?php echo base_url('uploads/images/'.$product_details->product_image); ?>" /></div>


                <?php 
                
                 $products_images = $product_details->other_product_image;  

                if (!empty($products_images)) {
                  # code...

                 $str_arr = explode (",", $products_images); 
                 $no_of_images = count($str_arr);
                  
                ?>

              <?php $pic = 1; ?> <?php for ($i=0; $i<$no_of_images; $i++) {   $pic++; ?>

              <div class="tab-pane" id="pic-<?php echo($pic); ?>"><img src="<?php echo base_url('uploads/images/'.$str_arr[$i]); ?>" /></div>

              <?php 
                  } 
                }
               ?>

              <!--             
              <div class="tab-pane" id="pic-2"><img src="<?php //echo base_url('uploads/images/'.$product_details->product_image); ?>" /></div>
						  <div class="tab-pane" id="pic-3"><img src="<?php //echo base_url('uploads/images/'.$product_details->product_image); ?>" /></div>
						  <div class="tab-pane" id="pic-4"><img src="<?php //echo base_url('uploads/images/'.$product_details->product_image); ?>" /></div> 
               -->

	  					</div>


						<ul class="preview-thumbnail nav nav-tabs">

						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="<?php echo base_url('uploads/images/'.$product_details->product_image); ?>" /></a></li>
              <?php 

               if (!empty($products_images)) {
                
               $pic = 1;
              
               for ($i=0; $i<$no_of_images; $i++) {   $pic++; ?>

               <li><a data-target="#pic-<?php echo($pic);  ?>" data-toggle="tab">
                <img src="<?php echo base_url('uploads/images/'.$str_arr[$i]); ?>" />
               </a></li>

               <?php } } ?>


              <!-- 
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="<?php //echo base_url('uploads/images/'.$product_details->product_image); ?>" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="<?php //echo base_url('uploads/images/'.$product_details->product_image); ?>" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="<?php //echo base_url('uploads/images/'.$product_details->product_image); ?>" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="<?php //echo base_url('uploads/images/'.$product_details->product_image); ?>" /></a></li>  -->



   						</ul>
						  <?php 
							}
                
						  ?> 

					</div>


					<div class="details col-md-6">

						<h3 class="product-title"><?php echo $product_details->pname; ?></h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description"><?php echo $product_details->product_description; ?></p>
						<h4 class="price">current price: <span><?php echo '₹'.$product_details->product_price; ?></span></h4>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>

						<h5 class="colors">colors:
							<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
							<span class="color green not-available"></span>
							<span class="color blue not-available"></span>
						</h5>
						<div class="action">
							<button class="add-to-cart btn btn-default" type="button">add to cart</button>
							<button class="add-to-cart btn btn-default" onclick="window.history.go(-1); return false;" type="button">  Back to Product </button>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>


						<?php 
 						   }
 						 
 						?>
					</div>


      </div>   





    </div>
</div>


<div class="push"></div>
</div>

<?php require 'dashboard_footer.php'; ?>
	