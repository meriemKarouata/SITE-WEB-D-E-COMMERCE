<div class="box"><!-- box begin -->
    <div class="box-header"><!-- box-header begin -->
        <center><h1>    Se connecter    </h1>
            <p class="lead">Vous avez déjà notre compte..?</p>
            <p class="text-muted"></p>
        </center>

        <form method="post" action="checkout.php">
            <div class="form-group">
                <label>Email : </label>
                <input name="c_email" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password : </label>
                <input name="c_pass" type="password" class="form-control" required>
            </div>

            <div class="text-center">
                <button name="login" value="Login" class="btn btn-primary">

                    <i class="fa fa-sign-in"></i> Se connecter

                </button>
            </div>

        </form>
        <center>
        <a href="customer_register.php">
            <h3>Vous n'avez pas de compte..? Inscrivez-vous ici</h3>
        </a>
        </center>
    </div><!-- box-header finish -->
</div><!-- box finish -->


<?php
if(isset($_POST['login'])){

    $customer_email = trim($_POST['c_email']);

    $customer_pass  = trim($_POST['c_pass']);

    $hash_password = MD5($customer_pass);

    $customer_pass = $customer_pass ;

     $select_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$hash_password'";

    $run_customer = mysqli_query($con,$select_customer);

    $get_ip = getRealIpUser();

    $check_customer = mysqli_num_rows($run_customer);

    $select_cart = "select * from cart where ip_add='$get_ip'";

      $run_cart  = mysqli_query($con,$select_cart);

      $check_cart = mysqli_num_rows($run_cart);



    if($check_customer == 0){
        echo "<script>alert('Le mot de passe ou l'adresse e-mail est incorrect, veuillez réessayer !')</script>";
        exit();

    }





    // $select_cart  ="select * from cart where id_add='$get_ip'";








    if($check_customer ==1  AND $check_cart == 0 ){
        $_SESSION['customer_email'] = $customer_email;

        echo "<script>alert('You are logged in')</script>";
        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

    }
    else{
        $_SESSION['customer_email'] = $customer_email;

        echo "<script>alert('You are logged in')</script>";
        echo "<script>windows.open('checkout.php','_self')</script>";

    }
}
?>
