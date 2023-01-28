
<?php
$active="cart";
 include("includes/header.php"); ?>


   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->

               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                      PANNIER
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->


           <div id="cart" class="col-md-9"><!-- col-md-9 Begin -->

               <div class="box"><!-- box Begin -->

                   <form action="cart.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                       <h1>Panier</h1>
                       <p class="text-muted"></p>


                       <!-- wir mussen ein php machen -->

                       <div class="table-responsive"><!-- table-responsive Begin -->

                           <table class="table"><!-- table Begin -->

                               <thead><!-- thead Begin -->

                                   <tr><!-- tr Begin -->

                                       <th colspan="2">Produit</th>
                                       <th>Quantité</th>
                                       <th>Prix ​​unitaire</th>
                                       <th>Taille</th>
                                       <th colspan="1">Effacer</th>
                                       <th colspan="2">Total</th>

                                   </tr><!-- tr Finish -->

                               </thead><!-- thead Finish -->

                               <tbody><!-- tbody Begin -->


                                 <?php

                                 $total = 0;
                                 $get_cart = "select * from cart";

                                 $run_cart = mysqli_query($db,$get_cart);
                                 while($row_cart = mysqli_fetch_array($run_cart)){

                                   $pro_id = $row_cart['p_id'];

                                      $pro_size = $row_cart['size'];

                                      $pro_qty = $row_cart['qty'];

                                      $pro_sale = $row_cart['p_price'];

                                        $get_products = "select * from products where product_id='$pro_id'";

                                        $run_products = mysqli_query($con,$get_products);

                                        while($row_products = mysqli_fetch_array($run_products)){

                                            $product_title = $row_products['product_title'];

                                            $product_img1 = $row_products['product_img1'];

                                            $only_price = $row_products['product_price'];

                                            $sub_total = $pro_sale*$pro_qty;

                                            $_SESSION['pro_qty'] = $pro_qty;

                                            $total += $sub_total;

                                 ?>

                                   <tr><!-- tr Begin -->

                                       <td>

                                           <img class="img-responsive" src="admin_area/product_images/<?php echo $product_img1?>" alt="Product 3a">

                                       </td>

                                       <td>

                                           <a href="details.php?pro_id=<?php echo $pro_id; ?>"><?php echo $product_title?></a>

                                       </td>

                                       <td>

                                         <input type="text" name="quantity" data-product_id="<?php echo $pro_id; ?>"
                    value="<?php echo $_SESSION['pro_qty']; ?>" class="quantity form-control">

                                       </td>

                                       <td>

                                           <?php echo  $pro_sale; ?>

                                       </td>

                                       <td>

                                           <?php echo  $pro_size; ?>

                                       </td>

                                       <td>

                                           <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">

                                       </td>

                                       <td>

                                           <?php echo $sub_total; ?>DH

                                       </td>

                                   </tr><!-- tr Finish -->
                                 <?php } }?>

                               </tbody><!-- tbody Finish -->




                               <tfoot><!-- tfoot Begin -->

                                   <tr><!-- tr Begin -->

                                       <th colspan="5">Le total</th>
                                       <th colspan="2"><?php echo $total; ?> DH</th>

                                   </tr><!-- tr Finish -->

                               </tfoot><!-- tfoot Finish -->

                           </table><!-- table Finish -->

                       </div><!-- table-responsive Finish -->

                       <div class="box-footer"><!-- box-footer Begin -->

                           <div class="pull-left"><!-- pull-left Begin -->

                               <a href="index.php" class="btn btn-default"><!-- btn btn-default Begin -->

                                   <i class="fa fa-chevron-left"></i> Continuer vos achats

                               </a><!-- btn btn-default Finish -->

                           </div><!-- pull-left Finish -->

                           <div class="pull-right"><!-- pull-right Begin -->

                               <button type="submit" name="update" value="Update Cart" class="btn btn-default"><!-- btn btn-default Begin -->

                                   <i class="fa fa-refresh"></i> Mise à jour panier

                               </button><!-- btn btn-default Finish -->

                               <a href="checkout.php" class="btn btn-primary">

                                   Procéder à la caisse <i class="fa fa-chevron-right"></i>

                               </a>

                           </div><!-- pull-right Finish -->

                       </div><!-- box-footer Finish -->

                   </form><!-- form Finish -->

               </div><!-- box Finish -->

               <?php

                function update_cart(){

                    global $con;

                    if(isset($_POST['update'])){

                        foreach($_POST['remove'] as $remove_id){

                            $delete_product = "delete from cart where p_id='$remove_id'";

                            $run_delete = mysqli_query($con,$delete_product);

                            if($run_delete){

                                echo "<script>window.open('cart.php','_self')</script>";

                            }

                        }

                    }

                }

               echo @$up_cart = update_cart();

               ?>

               <div id="row same-heigh-row"><!-- #row same-heigh-row Begin -->
                   <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Begin -->
                       <div class="box same-height headline"><!-- box same-height headline Begin -->
                           <h3 class="text-center">Produits que vous pourriez aimer</h3>
                       </div><!-- box same-height headline Finish -->
                   </div><!-- col-md-3 col-sm-6 Finish -->

                   <?php


                    $get_products = "select * from products order by rand() LIMIT 0,3";

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

                                    $product_sale_price = "/  $pro_sale_price DH";

                                }else{

                                    $product_price = "   $pro_price  DH";

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

                              <div class='col-md-3 col-sm-6 center-responsive'>

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

                   }
                  ?>



               </div><!-- #row same-heigh-row Finish -->

           </div><!-- col-md-9 Finish -->

           <div class="col-md-3"><!-- col-md-3 Begin -->

               <div id="order-summary" class="box"><!-- box Begin -->

                   <div class="box-header"><!-- box-header Begin -->

                       <h3>Récapitulatif de la commande</h3>

                   </div><!-- box-header Finish -->

                   <p class="text-muted"><!-- text-muted Begin -->

                      Les frais d'expédition et les frais supplémentaires sont calculés en fonction de la valeur que vous avez saisie

                   </p><!-- text-muted Finish -->

                   <div class="table-responsive"><!-- table-responsive Begin -->

                       <table class="table"><!-- table Begin -->

                           <tbody><!-- tbody Begin -->

                               <tr><!-- tr Begin -->

                                   <td> Sous-total de la commande </td>
                                   <th> <?php echo $total; ?> DH </th>

                               </tr><!-- tr Finish -->

                               <tr><!-- tr Begin -->

                                   <td> Frais de port et de manutention </td>
                                   <td> 0 DH</td>

                               </tr><!-- tr Finish -->

                               <tr><!-- tr Begin -->

                                   <td>Impôt </td>
                                   <th> 0 DH</th>

                               </tr><!-- tr Finish -->

                               <tr class="total"><!-- tr Begin -->

                                   <td> Le total </td>
                                   <th> <?php echo $total; ?>DH </th>

                               </tr><!-- tr Finish -->

                           </tbody><!-- tbody Finish -->

                       </table><!-- table Finish -->

                   </div><!-- table-responsive Finish -->

               </div><!-- box Finish -->

           </div><!-- col-md-3 Finish -->

         </div><!-- container Finish -->
     </div><!-- #content Finish -->




     <?php

         include("includes/footer.php");

         ?>




      <script src="js/jquery-331.min.js"></script>
      <script src="js/bootstrap-337.min.js"></script>

      <script>

     $(document).ready(function(data){

         $(document).on('keyup','.quantity',function(){

              var id = $ (this).data("product_id");
              var quantity = $(this).val();

              if(quantity !=''){

                  $.ajax({

                      url: "change.php",
                      method: "POST",
                      data:{id:id, quantity:quantity},

                      success:function(){
                          $("body").load("cart_body.php");
                      }

                  });

              }

         });

     });

  </script>


  </body>
  </html>
