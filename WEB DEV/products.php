<?php
    require_once 'connection.php';

    $quary = "SELECT * FROM products";
    $all_product = $conn->query($quary);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>homepage</title>
</head>
<body>
    <?php
        include_once 'header.php';
    ?>
    <main>
        <?php
            while($row = mysqli_fetch_assoc($all_product)){
        ?>
        <div class="mai">
           <div class="image">
                <img src="<?php echo $row["product_image"]; ?>"alt="">
            </div>
            <div class="captions">
                <p class="rate">
                    <img src="">
                </p>
                <p class="product_name"><?php echo $row["product_name"];?></p>
                <p class="price">Ksh <?php echo $row["price"];?></p>
                <p class="discount"> <del>Ksh<?php $row["discount"];?> 30</del></p>
                
            </div><br>
            <button class="add" data-id="<?php echo $row["product_id"] ?>">Add to cart</button>    
        </div>
        <?php
            }
        ?>
    </main>
    <script>
        var product_id = document.getElementsByClassName("add");
        for(var i = 0; i<product_id.length; i++){
            product_id[i].addEventListener("click",function(event){
                var target = event.target;
                var id = target.getAttribute("data-id");
                var xml = new XMLHttpRequest();
                xml.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var data = JSON.parse(this.responseText);
                        target.innerHTML = data.in_cart;
                        document.getElementById("badge").innerHTML = data.num_cart + 1;
                    }

                }

                xml.open("GET","connection.php?id="+id,true);
                xml.send();
                //alert(id);

            })
        }
    </script>
    
</body>
</html>