<?php
    require_once 'connection.php';

    $sql_cart = "SELECT * FROM cart";
    $all_cart = $conn->query($sql_cart);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>header</title>
</head>
<body>
    <?php
        include_once 'Navbar.php';
    ?>
    <header>
        <div class="log">
            <img src="/img/logo.png" width="5%" height="10%">
        </div>        
        <div id="main">
            <a href="upload.php">upload</a>
            <a href="products.php">products</a>
            <a href="logout.php">LOGOUT</a>
        </div>
        <a href="cart.php">Cart<span><span id="badge"><?php echo mysqli_num_rows($all_cart); ?></span></a>
    </header>
    
</body>
</html>