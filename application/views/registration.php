<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php

if (isset($this->session->userdata['logged_in'])) {

    header("location: dashboard");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>User Registration</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">

<link href="<?php echo base_url(); ?>/assets/css/style.css" rel='stylesheet' type='text/css' />

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  

</head>

<style type="text/css">

.register_form{

  padding-top: 120px !important;
}

.statusMsg_error_msg {
    color: red;
    margin: 0 0 10px;
}

.statusMsg_success_msg{

  color: #1e6108;
  margin: 0 0 10px;

}

.userform p {
    width: 100%;
}
.userform label {
    width: 120px;
    color: #333;
    float: right;
}
input.error {
    border: 1px dotted red;
}
label.error{
    width: 100%;
    color: red;
    margin-left: 120px;
    margin-bottom: 5px;
}
.userform input.submit {
    margin-left: 120px;
}

</style>

<body>

<script>

$(document).ready(function() {
    $("#userForm").validate({

        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            first_name: "Please enter your first name",
            last_name: "Please enter your last name",
            email: "Please enter a valid email address",
            password: {
                required: "Please Enter a password",
                minlength: "Your password must be at least 6 characters long"
            }
        }
    });
});

</script>





  <div class="container register_form"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="row"><!-- row class is used for grid system in Bootstrap-->
          <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title text-center"> Registration Form</h3>
                  </div>
                  <div class="panel-body">


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




                      <form role="form" id="userForm" class="userform" method="post" action="<?php echo base_url('index.php/home/register_view'); ?>">
                          <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Please Enter First Name" id="first_name" name="first_name" type="text" autofocus">
                              </div>

                              <div class="form-group">
                                  <input class="form-control" placeholder="Please Enter Last Name" id="last_name" name="last_name" type="text" autofocus ">
                              </div>


                              <div class="form-group">
                                  <input class="form-control" placeholder="Please Enter E-mail" id="email" name="email" type="email" autofocus>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Enter Password" id="password" name="password" type="password" value="">
                              </div>

                              <input class="btn btn-lg btn-success btn-block" type="submit" id="regisSubmit" value="Register" name="regisSubmit" >

                          </fieldset>
                      </form>
                      <center><b>You have Already registered ?</b> <br></b><a href="<?php echo base_url('index.php/home/login'); ?>"> Please Login</a></center><!--for centered text-->
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>


