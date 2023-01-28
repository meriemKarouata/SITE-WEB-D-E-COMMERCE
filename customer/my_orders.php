<center><!--  center Begin  -->

    <h1> Mes commandes </h1>

    <p class="lead"> Vos commandes en un seul endroit </p>

    <p class="text-muted">

        Si vous avez des questions, n'hésitez pas à <a href="../contact.php">contacter Nous</a>. Notre travail de service client <strong>24/7</strong>

    </p>

</center><!--  center Finish  -->


<hr>


<div class="table-responsive"><!--  table-responsive Begin  -->

    <table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->

        <thead><!--  thead Begin  -->

            <tr><!--  tr Begin  -->

                <th>AU: </th>
                <th>Montant dû: </th>
                <th>Facture Non: </th>
                <th>Qté: </th>
                <th>Taille: </th>
                <th>Date de commande:</th>
                <th>Payé / Non payé: </th>
                <th>Statut: </th>

            </tr><!--  tr Finish  -->

        </thead><!--  thead Finish  -->

        <tbody><!--  tbody Begin  -->

          <?php

           $customer_session = $_SESSION['customer_email'];

           $get_customer = "select * from customers where customer_email='$customer_session'";

           $run_customer = mysqli_query($con,$get_customer);

           $row_customer = mysqli_fetch_array($run_customer);

           $customer_id = $row_customer['customer_id'];

           $get_orders = "select * from customer_orders where customer_id='$customer_id'";

           $run_orders = mysqli_query($con,$get_orders);

           $i = 0;

           while($row_orders = mysqli_fetch_array($run_orders)){

               $order_id = $row_orders['order_id'];

               $due_amount = $row_orders['due_amount'];

               $invoice_no = $row_orders['invoice_no'];

               $qty = $row_orders['qty'];

               $size = $row_orders['size'];

               $order_date = substr($row_orders['order_date'],0,11);

               $order_status = $row_orders['order_status'];

               $i++;

               if($order_status=='pending'){

                   $order_status = ' Non payé';

               }else{

                   $order_status = ' Payé';

               }

           ?>



            <tr><!--  tr Begin  -->

              <th> <?php echo $i; ?> </th>
              <td> <?php echo $due_amount; ?>DH </td>
              <td> <?php echo $invoice_no; ?> </td>
              <td> <?php echo $qty; ?> </td>
              <td> <?php echo $size; ?> </td>
              <td> <?php echo $order_date; ?> </td>
              <td> <?php echo $order_status; ?> </td>

                <td>

                    <a href="confirm.php?order_id=<?php echo $order_id; ?>" target="_blank" class="btn btn-primary btn-sm">  Confirmer le paiement </a>

                </td>

            </tr><!--  tr Finish  -->

             <?php } ?>


        </tbody><!--  tbody Finish  -->

    </table><!--  table table-bordered table-hover Finish  -->

</div><!--  table-responsive Finish  -->
