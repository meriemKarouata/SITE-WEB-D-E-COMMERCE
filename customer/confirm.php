<?php

session_start();

if(!isset($_SESSION['customer_email'])){

    echo "<script>window.open('../checkout.php','_self')</script>";

}else{

include("includes/db.php");
include("functions/functions.php");

if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon projet</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/A.css">
    <link rel="stylesheet" href="styles/b.css">
    <link rel="stylesheet" href="styles/styles.css">


    <link rel="stylesheet" href="styles/alles.css">
</head>
<body>
  <div id="top"><!-- Top Begin -->

       <div class="container"><!-- container Begin -->

           <div class="col-md-6 offer"><!-- col-md-6 offer Begin -->

               <a href="#" class="btn btn-success btn-sm">

                   <?php
                       if(!isset($_SESSION['customer_email'])){
                         echo "Bienvenue: visiteur";
                       }else{
                         echo "Bienvenue: " . $_SESSION['customer_email'] . "";
                       }
                   ?>
               </a>
               <a href="checkout.php"></a>

           </div><!-- col-md-6 offer Finish -->

           <div class="col-md-6"><!-- col-md-6 Begin -->

               <ul class="menu"><!-- cmenu Begin -->

                   <li>
                       <a href="../customer_register.php">Register</a>
                   </li>
                   <li>
                     <a href="my_account.php">Mon compte</a>
                       <!-- <a href="ckeckout.php">Mon compte</a> -->
                   </li>
                   <li>
                       <a href="../cart.php"> Panier</a>
                   </li>
                   <li>
                       <a href="../checkout.php">
                         <?php

                           if(!isset($_SESSION['customer_email'])){

                                echo "<a href='../checkout.php'> Se connecter </a>";

                               }else{

                                echo " <a href='../logout.php'> Déconnecter </a> ";

                               }
                           ?>
                           </a>
                   </li>

               </ul><!-- menu Finish -->

           </div><!-- col-md-6 Finish -->

       </div><!-- container Finish -->

   </div><!-- Top Finish -->
   <div id="navbar" class="navbar navbar-default"><!-- navbar navbar-default Begin -->

       <div class="container"><!-- container Begin -->

           <div class="navbar-header"><!-- navbar-header Begin -->

               <a href="../index.php" class="navbar-brand home"><!-- navbar-brand home Begin -->

                   <img src="images/logo.jpeg" alt=" Logo" height="60px" width="250px">


               </a><!-- navbar-brand home Finish -->

               <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">

                   <span class="sr-only">Toggle Navigation</span>

                   <i class="fa fa-align-justify"></i>

               </button>

               <button class="navbar-toggle" data-toggle="collapse" data-target="#search">

                   <span class="sr-only">Toggle Search</span>

                   <i class="fa fa-search"></i>

               </button>

           </div><!-- navbar-header Finish -->

           <div class="navbar-collapse collapse" id="navigation"><!-- navbar-collapse collapse Begin -->

               <div class="padding-nav"><!-- padding-nav Begin -->

                   <ul class="nav navbar-nav left"><!-- nav navbar-nav left Begin -->

                       <li>
                           <a href="../index.php">Home</a>
                       </li>
                       <li>
                           <a href="../shop.php">Tous les Produits</a>
                       </li>
                       <li class="active">
                           <a href="my_account.php">Mon compte</a>
                       </li>
                       <li>
                           <a href="../cart.php"> Pannier</a>
                       </li>
                       <li>
                           <a href="../contact.php"> Contacter Nous</a>
                       </li>

                   </ul><!-- nav navbar-nav left Finish -->

               </div><!-- padding-nav Finish -->




               <a href="../cart.php" class="btn navbar-btn btn-primary right"><!-- btn navbar-btn btn-primary Begin -->

                   <i class="fa fa-shopping-cart"></i>

                   <span><?php items(); ?> Panier</span>

               </a><!-- btn navbar-btn btn-primary Finish -->

               <div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right Begin -->

                   <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse" data-target="#search"><!-- btn btn-primary navbar-btn Begin -->

                       <span class="sr-only">Toggle Search</span>

                       <i class="fa fa-search"></i>

                   </button><!-- btn btn-primary navbar-btn Finish -->

               </div><!-- navbar-collapse collapse right Finish -->
               <div class="collapse clearfix" id="search"><!-- collapse clearfix Begin -->

                   <form method="get" action="results.php" class="navbar-form"><!-- navbar-form Begin -->

                       <div class="input-group"><!-- input-group Begin -->

                           <input type="text" class="form-control" placeholder="Search" name="user_query" required>

                           <span class="input-group-btn"><!-- input-group-btn Begin -->

                           <button type="submit" name="search" value="Search" class="btn btn-primary"><!-- btn btn-primary Begin -->

                               <i class="fa fa-search"></i>

                           </button><!-- btn btn-primary Finish -->

                           </span><!-- input-group-btn Finish -->

                       </div><!-- input-group Finish -->

                     </form><!-- navbar-form Finish -->

            </div><!-- collapse clearfix Finish -->

        </div><!-- navbar-collapse collapse Finish -->

    </div><!-- container Finish -->

</div><!-- navbar navbar-default Finish -->





   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->

               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                      Mon compte
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->

           <div class="col-md-3"><!-- col-md-3 Begin -->

   <?php

    include("includes/sidebar.php");

    ?>
  </div><!-- col-md-3 fenich -->


           <div class="col-md-9"><!-- col-md-9 Begin -->

               <div class="box"><!-- box Begin -->

                   <h1 align="center"> Veuillez confirmer votre paiement</h1>

                   <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data"><!-- form Begin -->

                       <div class="form-group"><!-- form-group Begin -->

                         <label> Numero de la Facture: </label>


                         <?php


$max_invoice_no ="SELECT invoice_no FROM customer_orders WHERE order_id = $order_id";
$run_p_cats = mysqli_query($con,$max_invoice_no);
$row=$run_p_cats->fetch_assoc();

$invoice_no= intval($row['invoice_no']);

    echo '

    <input type="" class="form-control" name="invoice_no"  value ='.$invoice_no.' readonly>


    ';


?>


                              
                         <!-- <input type="text" class="form-control" name="invoice_no" required> -->

                       </div><!-- form-group Finish -->

                       <div class="form-group"><!-- form-group Begin -->

                         <label> Montant envoyé: </label>
                        <?php
                         $max_invoice_no ="SELECT due_amount FROM customer_orders WHERE order_id = $order_id";
$run_p_cats = mysqli_query($con,$max_invoice_no);
$row=$run_p_cats->fetch_assoc();

$due_amount= intval($row['due_amount']);

    echo '
    <input type="text" class="form-control" name="amount_sent" value= '.$due_amount.' readonly>
    ';


?>

                         
                       </div><!-- form-group Finish -->

                       <div class="form-group"><!-- form-group Begin -->

                         <label> Sélectionnez le mode de paiement: </label>

                          <select name="payment_mode" class="form-control"><!-- form-control Begin -->

                              <option> Sélectionnez le mode de paiement </option>
                              <option> Back Code </option>
                              <option> Payall </option>
                              <option> Payoneer </option>
                              <option> Western Union </option>

                          </select><!-- form-control Finish -->

                       </div><!-- form-group Finish -->

                       <div class="form-group"><!-- form-group Begin -->

                         <label>Identifiant de transaction/référence: </label>

                          <input type="text" class="form-control" name="ref_no" required>

                       </div><!-- form-group Finish -->

                       <div class="form-group"><!-- form-group Begin -->

                         <label> Paypall / Payoneer / Western Union Code: </label>

                          <input type="text" class="form-control" name="code" required>

                       </div><!-- form-group Finish -->

                       <div class="form-group"><!-- form-group Begin -->

                         <label> Date de paiement: </label>
                         <?php
                         $max_invoice_no ="SELECT order_date FROM customer_orders WHERE order_id = $order_id";
                            $run_p_cats = mysqli_query($con,$max_invoice_no);
                            $row = $run_p_cats->fetch_assoc();

                            $order_date = $row['order_date'];
                    echo '
                    <input type="text" class="form-control" name="date" value= '.$order_date.' readonly>
                    ';


?>

                       </div><!-- form-group Finish -->

                       <div class="text-center"><!-- text-center Begin -->

                           <button class="btn btn-primary btn-lg" name="confirm_payment"><!-- tn btn-primary btn-lg Begin -->

                               <i class="fa fa-user-md"></i> Confirmer le paiement

                           </button><!-- tn btn-primary btn-lg Finish -->

                       </div><!-- text-center Finish -->

                   </form><!-- form Finish -->


                   <?php

                    if(isset($_POST['confirm_payment'])){
                        

                        $update_id = $_GET['update_id'];

                        $amount = $_POST['amount_sent'];

                        $payment_mode = $_POST['payment_mode'];

                        $ref_no = $_POST['ref_no'];

                        $code = $_POST['code'];

                        $payment_date = $_POST['date'];

                        $complete = "Complete";

                        $insert_payment = "insert into payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) values ('$invoice_no','$amount','$payment_mode','$ref_no','$code','$payment_date')";

                        $run_payment = mysqli_query($con,$insert_payment);

                        $update_customer_order = "update customer_orders set order_status='$complete' where order_id='$update_id'";

                        $run_customer_order = mysqli_query($con,$update_customer_order);

                        $update_pending_order = "update pending_orders set order_status='$complete' where order_id='$update_id'";

                        $run_pending_order = mysqli_query($con,$update_pending_order);

                        if($run_pending_order){

                            echo "<script>alert('Thank You for purchasing, your orders will be completed within 24 hours work')</script>";

                            echo "<script>window.open('my_account.php?my_orders','_self')</script>";

                        }

                    }

                   ?>

               </div><!-- box Finish -->

           </div><!-- col-md-9 Finish -->

</div><!-- container Finish -->
</div><!-- #content Finish -->




<?php

include("includes/footer.php");

?>




<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>


</body>
</html>
<?php } ?>
