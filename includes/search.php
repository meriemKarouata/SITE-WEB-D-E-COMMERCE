<?php
    if (isset($_POST['submit'])){
        $connection = new mysqli("localhost","root","","ecomerce_store");

        $q = $connection->real_escape_string($_POST['q']);
        //$column = $connection->real_escape_string($_POST['column']);

        //if($column == "" || ($column != "firstName" && $column != "lastNmae"))
         //   $column = "firstName";

        $sql = $connection->query("SELECT * FROM products WHERE product_title LIKE '%".$q."%'");
        if($sql->num_rows > 0){
           while($data = $sql->fetch_array())
               echo $data["product_title"] . "<br>";
        }else
            echo "Your search query doesnt't match any data!";

    }
    else
            echo "test fail!";

?>
