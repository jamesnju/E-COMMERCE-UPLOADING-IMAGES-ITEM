<?php
    require_once 'connection.php';

    $sql_cart = "SELECT * FROM cart";
    $all_cart = $conn->query($sql_cart);
    $total_cost = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Cartpage</title>
</head>
<body>
    <?php
        include_once 'header.php';
    ?>
    <main>
        <h2><?php echo mysqli_num_rows($all_cart); ?>  Items</h2>
        <?php
            while($row_cart = mysqli_fetch_assoc($all_cart)){
                $sql = "SELECT * FROM products WHERE product_id=".$row_cart["product_id"];
                $all_product = $conn->query($sql);
                while($row = mysqli_fetch_assoc($all_product)){
                    $total_cost += $row["price"];
        ?>
        
        <div class="mai">
            <div class="image">
                <img src="<?php echo $row["product_image"]; ?>"alt="">
            </div>

            <div class="captions">
                <p class="rate">
                    <img src="">
                </p>
                <p class="product_name"><?php echo $row["product_name"]; ?></p>
                <p class="price"><br>Ksh <?php echo $row["price"]; ?></br></p>
                <p class="discount"><del>Ksh <?php echo $row["discount"]; ?></del></p>
                <button class="remove" data-id="<?php echo $row["product_id"]; ?>">Remove from cart</button>    
            </div><br>
           
        </div>
        <?php
            }
        }//displaying total cost
        echo "<h1>Total cost: ksh".$total_cost . "</h1>";
        
        ?>
        
    </main>
    <script>
        var remove = document.getElementsByClassName("remove");
        for(var i = 0; i<remove.length; i++){
            remove[i].addEventListener("click",function(event){
                var target = event.target;
                var cart_id = target.getAttribute("data-id");
                var xml = new XMLHttpRequest();
                xml.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        target.innerHTML = this.responseText;
                        target.style.opacity = .10;
                        
                    }

                }

                xml.open("GET","connection.php?cart_id="+cart_id,true);
                xml.send();
            })
        }
    </script>
</body>
</html>