<?php

    $active='Account';
    include("includes/header.php");

?>

   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->

               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Register
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->



           <div class="col-md-12"><!-- col-md-12 Begin -->

               <div class="box"><!-- box Begin -->

                   <div class="box-header"><!-- box-header Begin -->

                       <center><!-- center Begin -->

                           <h2> Enregistrer un nouveau compte </h2>

                       </center><!-- center Finish -->

                       <form action="customer_register.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Nom</label>

                               <input type="text" class="form-control" name="c_name" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label> Email</label>

                               <input type="text" class="form-control" name="c_email" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label> Password</label>

                               <input type="password" class="form-control" name="c_pass" id="password_confirm1"  required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Confirmer Password</label>

                               <input type="password" class="form-control" id="password_confirm2" name="confirm_password" required>
                               <p id="status_for_confirm_password"></p>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Pays</label>

                               <input type="text" class="form-control" name="c_country" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Ville</label>

                               <input type="text" class="form-control" name="c_city" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Contacter</label>

                               <input type="text" class="form-control" name="c_contact" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Adresse</label>

                               <input type="text" class="form-control" name="c_address" required>

                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <label>Photo de profil</label>

                               <input type="file" class="form-control form-height-custom" name="c_image" required>

                           </div><!-- form-group Finish -->

                           <div class="text-center"><!-- text-center Begin -->

                               <button type="submit" name="register" class="btn btn-primary">

                               <i class="fa fa-user-md"></i> S'inscrire

                               </button>

                           </div><!-- text-center Finish -->

                       </form><!-- form Finish -->

                   </div><!-- box-header Finish -->

               </div><!-- box Finish -->

           </div><!-- col-md-12 Finish -->

       </div><!-- container Finish -->
   </div><!-- #content Finish -->

   <?php

    include("includes/footer.php");

    ?>

    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>


</body>
</html>


<?php

if(isset($_POST['register'])){

    $c_name = $_POST['c_name'];

    $c_email = trim($_POST['c_email']);

    $c_pass = trim($_POST['c_pass']);

    $hash_password = MD5($c_pass);

    $c_country = $_POST['c_country'];

    $c_city = $_POST['c_city'];

    $c_contact = $_POST['c_contact'];

    $c_address = $_POST['c_address'];

    $c_image = $_FILES['c_image']['name'];

    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    $c_ip = getRealIpUser();

    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

    $select_customer = "select * from customers where customer_email='$c_email'";

   $run_customer = mysqli_query($con,$select_customer);

   $check_customer = mysqli_num_rows($run_customer);
   if($check_customer != 0){
     echo "<script>alert('this user already exists');</script>";
   }
   else{
     $insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) values ('$c_name','$c_email','$hash_password','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";

     $run_customer = mysqli_query($con,$insert_customer);

     $sel_cart = "select * from cart where ip_add='$c_ip'";

     $run_cart = mysqli_query($con,$sel_cart);

     $check_cart = mysqli_num_rows($run_cart);

     if($check_cart>0){

         /// If register have items in cart ///

         $_SESSION['customer_email']=$c_email;

         echo "<script>alert('Vous avez été enregistré avec succès')</script>";

         echo "<script>window.open('checkout.php','_self')</script>";

     }else{

         /// If register without items in cart ///

         $_SESSION['customer_email']=$c_email;

         echo "<script>alert('Vous avez été enregistré avec succès');</script>";

         echo "<script>window.open('index.php','_self')</script>";

     }

   }

}

?>
<script>

$(document).ready(function(){
    $("#password_confirm2").on('keyup',function(){

        var password_confirm1 = $("#password_confirm1").val();
        var password_confirm2 = $("#password_confirm2").val();

       // alert('password_confirm2');

if(password_confirm1 == password_confirm2){ $("#status_for_confirm_password").html('<strong style="color:green">Le mot de passe est correct</strong>');
           }else{
$("#status_for_confirm_password").html('<strong style="color:red">Le mot de passe est incorrect</strong>');
           }


    });
});

</script>
