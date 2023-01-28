<h1 align="center"> changer le mot de passe</h1>

<form action="" method="post" ><!--  Form Begin  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>votre ancien mot de passe:</label>
    <input type="text" name="old_pass" class="form-control" required>
  </div><!--  form-group Finish  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>Votre nouveau mot de passe:</label>
    <input type="text" name="new_pass" class="form-control" required>
  </div><!--  form-group Finish  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>confirmer votre nouveau mot de passe:</label>
    <input type="text" name="new_pass_again" class="form-control" required>
  </div><!--  form-group Finish  -->

  <div class="text-center"><!--  text-center Begin  -->

    <button type="submit" name="submit" class="btn btn-primary"><!--  bnt bnt-primary Begin  -->

      <i class="fa fa-user-md"></i> mise à jour non

    </button><!--  bnt bnt-primary Finish  -->
  </div><!--  text-center Finish  -->

</form><!--  Form Finish  -->










<?php

if(isset($_POST['submit'])){

    $c_email = $_SESSION['customer_email'];

    $c_old_pass = $_POST['old_pass'];

    $c_new_pass = $_POST['new_pass'];

    $c_new_pass_again = $_POST['new_pass_again'];

    $sel_c_old_pass = "select * from customers where customer_pass='$c_old_pass'";

    $run_c_old_pass = mysqli_query($con,$sel_c_old_pass);

    $check_c_old_pass = mysqli_fetch_array($run_c_old_pass);

    if($check_c_old_pass==0){

        echo "<script>alert('Sorry, your current password did not valid. Please try again')</script>";

        exit();

    }

    if($c_new_pass!=$c_new_pass_again){

        echo "<script>alert('Sorry, your new password did not match')</script>";

        exit();

    }

    $update_c_pass = "update customers set customer_pass='$c_new_pass' where customer_email='$c_email'";

    $run_c_pass = mysqli_query($con,$update_c_pass);

    if($run_c_pass){

        echo "<script>alert('Your password has been updated')</script>";

        echo "<script>window.open('my_account.php?my_orders','_self')</script>";

    }

}

?>
