<?php

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$customer_name = $row_customer['customer_name'];

$customer_email = $row_customer['customer_email'];

$customer_country = $row_customer['customer_country'];

$customer_city = $row_customer['customer_city'];

$customer_contact = $row_customer['customer_contact'];

$customer_address = $row_customer['customer_address'];

$customer_image = $row_customer['customer_image'];

?>




<h1 align="center"> Modifier le Compte</h1>

<form action="" method="post" enctype="multipart/form-data"><!--  Form Begin  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>Nom du client:</label>
    <input type="text" name="c_name" class="form-control" value="<?php echo $customer_name; ?>" required>
  </div><!--  form-group Finish  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>Email client:</label>
    <input type="text" name="c_email" class="form-control"  value="<?php echo $customer_email; ?>" required>
  </div><!--  form-group Finish  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>Pays du client:</label>
    <input type="text" name="c_country" class="form-control"  value="<?php echo $customer_country; ?>" required>
  </div><!--  form-group Finish  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>Ville du client :</label>
    <input type="text" name="c_city" class="form-control"  value="<?php echo $customer_city; ?>" required>
  </div><!--  form-group Finish  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>Contact client:</label>
    <input type="text" name="c_contact" class="form-control"  value="<?php echo $customer_contact; ?>" required>
  </div><!--  form-group Finish  -->

  <div class="form-group"><!--  form-group Begin  -->
    <label>Adresse client:</label>
    <input type="text" name="c_address" class="form-control"  value="<?php echo $customer_address; ?>" required>
  </div><!--  form-group Finish  -->

  <div class="form-group form-height-custom"><!--  form-group Begin  -->
    <label>Image client:</label>
    <input type="file" name="c_image" class="form-control form-height-custom" >
    <img class="img-responsive" src="customer_images/<?php echo $customer_image; ?>" alt="Image client">
  </div><!--  form-group Finish  -->

  <div class="text-center"><!--  text-center Begin  -->

    <button name="update" class="btn btn-primary"><!--  bnt bnt-primary Begin  -->

      <i class="fa fa-user-md"></i> mise à jour non

    </button><!--  bnt bnt-primary Finish  -->
  </div><!--  text-center Finish  -->

</form><!--  Form Finish  -->



<?php

if(isset($_POST['update'])){

    $update_id = $customer_id;

    $c_name = $_POST['c_name'];

    $c_email = $_POST['c_email'];

    $c_country = $_POST['c_country'];

    $c_city = $_POST['c_city'];

    $c_address = $_POST['c_address'];

    $c_contact = $_POST['c_contact'];

    $c_image = $_FILES['c_image']['name'];

    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    move_uploaded_file ($c_image_tmp,"customer_images/$c_image");

    $update_customer = "update customers set customer_name='$c_name',customer_email='$c_email',customer_country='$c_country',customer_city='$c_city',customer_address='$c_address',customer_contact='$c_contact',customer_image='$c_image' where customer_id='$update_id' ";

    $run_customer = mysqli_query($con,$update_customer);

    if($run_customer){

        echo "<script>alert('Your account has been edited, to complete the process, please Relogin')</script>";

        echo "<script>window.open('logout.php','_self')</script>";

    }

}

?>
