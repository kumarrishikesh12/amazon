<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php

if (isset($this->session->userdata['logged_in'])) {


$user_id = ($this->session->userdata['logged_in']['id']);

$first_name = ($this->session->userdata['logged_in']['first_name']);

$last_name = ($this->session->userdata['logged_in']['last_name']);

$email = ($this->session->userdata['logged_in']['email']);

} else {

header("location: login");

}

?>
  
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--   <script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script> -->

<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.dataTables.min.js'); ?>"></script>

<!-- <script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>-->

<script type="text/javascript" src="<?php echo base_url('/assets/js/dataTables.bootstrap.js'); ?>"></script>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="<?php echo base_url('/assets/css/bootstrap.min.css'); ?>">

<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">

<!-- <link rel="stylesheet" href="<?php echo base_url('/assets/css/dataTables.bootstrap.css'); ?>"> -->





<!------ Include the above in your HEAD tag ---------->
<head>


<style>

@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
@media(min-width:768px) {
    body {
        margin-top: 50px;
    }
    /*html, body, #wrapper, #page-wrapper {height: 100%; overflow: hidden;}*/
}


.wrapper {
  min-height: 100%;
  margin-bottom: -50px;
}

.footer,
.push {
    
  height: 100px;
}

#wrapper {
    padding-left: 0;    
}

#page-wrapper {
    width: 100%;        
    padding: 0;
    background-color: #fff;
}

@media(min-width:768px) {
    #wrapper {
        padding-left: 225px;
    }

    #page-wrapper {
        padding: 22px 10px;
    }
}

/* Top Navigation */

.top-nav {
    padding: 0 15px;
}

.top-nav>li {
    display: inline-block;
    float: left;
}

.top-nav>li>a {
    padding-top: 20px;
    padding-bottom: 20px;
    line-height: 20px;
    color: #fff;
}

.top-nav>li>a:hover,
.top-nav>li>a:focus,
.top-nav>.open>a,
.top-nav>.open>a:hover,
.top-nav>.open>a:focus {
    color: #fff;
    background-color: #1a242f;
}

.top-nav>.open>.dropdown-menu {
    float: left;
    position: absolute;
    margin-top: 0;
    /*border: 1px solid rgba(0,0,0,.15);*/
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    background-color: #fff;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}

.top-nav>.open>.dropdown-menu>li>a {
    white-space: normal;
}

/* Side Navigation */

@media(min-width:768px) {
    .side-nav {
        position: fixed;
        top: 60px;
        left: 225px;
        width: 225px;
        margin-left: -225px;
        border: none;
        border-radius: 0;
        border-top: 1px rgba(0,0,0,.5) solid;
        overflow-y: auto;
        background-color: #222;
        /*background-color: #5A6B7D;*/
        bottom: 0;
        overflow-x: hidden;
        padding-bottom: 40px;
    }

    .side-nav>li>a {
        width: 225px;
        border-bottom: 1px rgba(0,0,0,.3) solid;
    }

    .side-nav li a:hover,
    .side-nav li a:focus {
        outline: none;
        background-color: #1a242f !important;
    }
}

.side-nav>li>ul {
    padding: 0;
    border-bottom: 1px rgba(0,0,0,.3) solid;
}

.side-nav>li>ul>li>a {
    display: block;
    padding: 10px 15px 10px 38px;
    text-decoration: none;
    /*color: #999;*/
    color: #fff;    
}

.side-nav>li>ul>li>a:hover {
    color: #fff;
}

.navbar .nav > li > a > .label {
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  position: absolute;
  top: 14px;
  right: 6px;
  font-size: 10px;
  font-weight: normal;
  min-width: 15px;
  min-height: 15px;
  line-height: 1.0em;
  text-align: center;
  padding: 2px;
}

.navbar .nav > li > a:hover > .label {
  top: 10px;
}

.navbar-brand {
    padding: 5px 15px;
}


a.active{
 background:#1a242f;
 color: #000;
 }


</style>

</head>






<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper" class="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard">
                <img src="http://images6.fanpop.com/image/photos/40600000/Elsner-Inc-elsnerinc-40639061-571-226.png" class="img-responsive" width="130px" alt="LOGO"">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">          
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $first_name.' '.$last_name  ?> <!-- <b class="fa fa-angle-down"></b> --></a>
                <ul class="dropdown-menu">
                   <!--  <li><a href="#"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li> -->
                   
                    <li><a href="<?php echo base_url('index.php/home/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">

             <li><a id="dashboard" href="<?php echo base_url('index.php/home/dashboard'); ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>

              <li>
               <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i> CATEGORY 
                <i class="fa fa-fw fa-angle-down pull-right"></i></a>
               <ul id="submenu-1" class="collapse">
                
                <li><a href="<?php echo base_url('index.php/home/add_category'); ?>"><i class="fa fa-fw fa-plus"></i> Add New Category</a></li>

                <li><a href="<?php echo base_url('index.php/home/managed_categorys'); ?>"><i class="fa fa-fw fa-eye"></i> Managed Category </a></li>
               

               </ul>
             </li>


              <li>
               <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-search"></i> PRODUCT 
                <i class="fa fa-fw fa-angle-down pull-right"></i></a>
               <ul id="submenu-2" class="collapse">

                <li><a href="<?php echo base_url('index.php/home/view_products'); ?>"><i class="fa fa-fw fa-plus"></i> Add New Products </a></li>
                <li><a href="<?php echo base_url('index.php/home/managed_products'); ?>"><i class="fa fa-fw fa-eye"></i> Managed Products </a></li>
             

               </ul>
             </li>

                

                <li><a href="<?php echo base_url('index.php/home/view_all_category'); ?>"><i class="fa fa-fw fa-eye"></i> View Category</a></li>


                <!-- <li><a href="<?php// echo base_url('index.php/home/view_all_products'); ?>"><i class="fa fa-fw fa-eye"></i> View All Products</a></li> -->

                <li><a href="<?php echo base_url('index.php/home/logout'); ?>"><i class="fa fa-fw fa fa-sign-out"></i> Logout </a></li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
