<?php

session_start();
include("includes/db.php");
include("functions/functions.php");
?>


<?php

if(isset($_GET['pro_id'])){

    $product_id = $_GET['pro_id'];

    $get_product = "select * from products where product_id='$product_id'";

    $run_product = mysqli_query($con,$get_product);

    $row_product = mysqli_fetch_array($run_product);

    $p_cat_id = $row_product['p_cat_id'];

    $pro_title = $row_product['product_title'];

    $pro_price = $row_product['product_price'];

    $pro_desc = $row_product['product_desc'];

    $pro_img1 = $row_product['product_img1'];

    $pro_img2 = $row_product['product_img2'];

    $pro_img3 = $row_product['product_img3'];

    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";

    $run_p_cat = mysqli_query($con,$get_p_cat);

    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_title = $row_p_cat['p_cat_title'];

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

    

    <link rel="stylesheet" href="styles/styles.css">
    
    




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
                       <a href="customer_register.php">Register</a>
                   </li>
                   <li>
                     <a href="customer/my_account.php">Mon compte</a>
                       <!-- <a href="ckeckout.php">Mon compte</a> -->
                   </li>
                   <li>
                       <a href="cart.php"> Panier</a>
                   </li>
                   <li>
                       <a href="checkout.php">
                         <?php

                             if(!isset($_SESSION['customer_email'])){

                                  echo "<a href='checkout.php'> Se connecter </a>";

                                 }else{

                                  echo " <a href='logout.php'> Déconnecter </a> ";

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

               <a href="index.php" class="navbar-brand home"><!-- navbar-brand home Begin -->

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

                       <li class="<?php if($active=='Home') echo "active" ;?>">
                           <a href="index.php">Home</a>
                       </li>
                       <li class="<?php if($active=='shop') echo "active" ;?>">
                           <a href="shop.php">Tous les Produits</a>
                       </li>
                       <li class="<?php if($active=='myaccount') echo "active" ;?>">
                         <?php

                         if(!isset($_SESSION['customer_email'])){

                             echo"<a href='checkout.php'>Mon Compte</a>";

                         }else{

                            echo"<a href='customer/my_account.php?my_orders'>Mon Compte</a>";

                         }

                         ?>
                       </li>
                       <li class="<?php if($active=='cart') echo "active" ;?>">
                           <a href="cart.php">Pannier</a>
                       </li>
                       <li class="<?php if($active=='contact') echo "active" ;?>">
                           <a href="contact.php">contacter Nous </a>
                       </li>

                   </ul><!-- nav navbar-nav left Finish -->

               </div><!-- padding-nav Finish -->




               <a href="cart.php" class="btn navbar-btn btn-primary right"><!-- btn navbar-btn btn-primary Begin -->

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

                   <form method="post" action="" class="navbar-form"><!-- navbar-form Begin -->

                       <div class="input-group"><!-- input-group Begin -->

                           <input type="text" id="search" name="q" class="form-control" placeholder="Search"  required>

                           <span class="input-group-btn"><!-- input-group-btn Begin -->

                           <button type="submit" name="submit" value="login" class="btn btn-primary"><!-- btn btn-primary Begin -->

                               <i class="fa fa-search"></i>

                           </button><!-- btn btn-primary Finish -->

                           </span><!-- input-group-btn Finish -->

                       </div><!-- input-group Finish -->

                     </form><!-- navbar-form Finish -->

            </div><!-- collapse clearfix Finish -->

        </div><!-- navbar-collapse collapse Finish -->

    </div><!-- container Finish -->

</div><!-- navbar navbar-default Finish -->



<div id="content" class="container"><!-- container Begin -->

      <div class="row"><!-- row Begin -->
<?php
    if (isset($_POST['submit']))
    {
         $connection = new mysqli("localhost","root","","ecomerce_store");
         $q = $connection->real_escape_string($_POST['q']);
    //     $sql = "SELECT * FROM products WHERE product_title LIKE '%".$q."%'";
    //     $run_pro = mysqli_query($connection,$sql);
    //     if($run_pro->num_rows > 0){
    //
    //       while($row_pro=mysqli_fetch_array($run_pro)){
    //           $pro_title = $row_pro['product_title'];
    //           $pro_img2 = $row_pro['product_img2'];
    //           echo $pro_title;
    //           echo "<img src=";
    //           echo 'admin_area\\product_images\\'. $pro_img2 . ' width=60 height=60 id="sded"';
    //
    //
    //
    //         }
    //     }else{
    //         echo "Your search query doesnt't match any data!";
    // }

    $get_products = "select * from products WHERE product_title LIKE '%".$q."%'";

    $run_products = mysqli_query($con,$get_products);

    while($row_products=mysqli_fetch_array($run_products)){

      $pro_id = $row_products['product_id'];

      $pro_title = $row_products['product_title'];

      $pro_price = $row_products['product_price'];

      $pro_sale_price = $row_products['product_sale'];


      $pro_img1 = $row_products['product_img1'];

      $pro_label = $row_products['product_label'];

      if($pro_label == "sale"){

            $product_price = " <del>  $pro_price DH </del> ";

            $product_sale_price = "/ $pro_sale_price DH ";

        }else{

            $product_price = "   $pro_price DH ";

            $product_sale_price = "";

        }

      if($pro_label == ""){

      }else{
        $product_label = "

        <a href='#' class='label $pro_label'>
            <div class='theLabel'>  $pro_label</div>
            <div class='labelBackround'></div>


        </a>
        ";
      }


      echo "

      

      <div class='col-md-4 col-sm-6 single'>

          <div class='product'>

              <a href='details.php?pro_id=$pro_id'>

                  <img class='img-responsive' src='admin_area/product_images/$pro_img1'>

              </a>

              <div class='text'>

                  <h3>

                      <a href='details.php?pro_id=$pro_id'>

                          $pro_title

                      </a>

                  </h3>

                  <p class='price'>

                      $product_price &nbsp; $product_sale_price

                  </p>

                  <p class='button'>

                      <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                          Détails

                      </a>

                      <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                          <i class='fa fa-shopping-cart'></i> Ajouter au panier

                      </a>

                  </p>

              </div>



          </div>

      </div>

      ";

  }}

  ?>
</div>

</div>