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
                    <h4>View All Category</h4>
                </div>

                


            </div>
            <!-- /.row -->


<div class="row">

<?php if(!empty($allcategorydata)) { 

     foreach($allcategorydata as $category_list) {
?>





<div class="col-md-4">
  <figure class="card card-product">
    <div class="img-wrap"><img src="<?php echo base_url('uploads/images/'.$category_list->cicon); ?>"></div>
    <figcaption class="info-wrap">
        <h4 class="title text-center"><?php echo $category_list->cname; ?></h4>
        <p class="desc text-center"> <?php echo $category_list->cdetails; ?> </p>
        <center>
        <div>

        <?php  

             $category_name = preg_replace("![^a-z0-9]+!i", "-", $category_list->cname);

         ?>


            <a href="<?php echo base_url('index.php/home/view_categorys_product/'.$category_list->cid.'/'.$category_name); ?>" class="btn btn-sm btn-primary float-right">View Products</a> 
        </div> <!-- rating-wrap.// --></center>
    </figcaption>
  </figure>
</div> <!-- col // -->


<?php 
 
 }
}

else{

 echo "<h2> Sorry !! No Active Category Found :( </h2>";

}

?>


<!-- 
<div id="pagination">
<ul class="tsc_pagination">
Show pagination links
<?php

//echo "<li>".$links."</li>";

?>
</ul>
</div> -->




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