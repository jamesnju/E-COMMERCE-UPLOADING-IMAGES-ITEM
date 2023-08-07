<?php
require_once 'connection.php';

if(isset($_POST["submit"])){
    $productname = $_POST["productname"];
    $price = $_POST["price"];
    $discount = $_POST["discount"];
    $phone = $_POST["phone"];
    //upload photos
    
    $upload_dir = "uploads/";//stores the uploaded pics
    $product_image = $upload_dir.$_FILES["imageupload"]["name"];
    $upload_dir.$_FILES["imageupload"]["name"];
    $upload_file = $upload_dir.basename($_FILES["imageupload"]["name"]);
    $imageType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));//used to detect the image format
    $check = $_FILES["imageupload"]["size"];// detects the size of the image
    $upload_ok = 0;

    if(file_exists($upload_file)){
        echo "<script>('submitted succesfull')</script>";
        $upload_ok = 0;
    }
    else{
        $upload_ok = 1;
        if($check !== false){
            $upload_ok = 1;
            if($imageType == 'jpg' || $imageType == 'png' || $imageType == 'gif'){
                $upload_ok = 1;
            }
            else{
                echo "<script>alert('please change the format of the image')</script>";

            }
            
        }
        else{
            echo '<script>alert("no photo selected")</scrpt>';
            $upload_ok = 0;
        }
    }
    
    if($upload_ok == 0){
        echo '<script>alert("sorry the file Already exist. please try again")</script>';
    }
    else{
        if($productname !== "" && $price!=""){
            move_uploaded_file($_FILES["imageupload"]["tmp_name"],$upload_file);
            $sql ="INSERT INTO products(product_name,price,discount,product_image)
            VALUES('$productname', '$price', '$discount', '$product_image') ";

            if($conn->query($sql) === TRUE){
                echo "<script>alert('your product uploaded successfully')</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="upload.css">
    <title>upload</title>
</head>
<body>
    <?php
    include_once 'header.php';

    ?>
    <section id="upload">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="text" name="productname" id="productname" placeholder="priduct name" required>
            <input type="number" name="price" id="price" placeholder="price" min="150" required>
            <input type="number" name="discount" id="discount" placeholder="discount"  min="100">
            <input type="tel" name="phone" id="phone" placeholder="enter phone number">
            <input type="file" name="imageupload" id="imageupload" required hidden>
            <button id="choose" onclick="upload();">Select File</button>
            <input type="submit" value="upload" name="submit">
        </form>
    </section>
    <script>
        var productname = document.getElementById("productname");
        var price = document.getElementById("price");
        var discount = document.getElementById("discount");
        var choose = document.getElementById("choose");
        var uploadImage = document.getElementById("imageupload");

        function upload(){
            uploadImage.click();
        }

        uploadImage.addEventListener("change",function(){
            var file = this.files[0];
            if(productname.value == ""){
                productname.value = file.name;
            }
            choose.innerHTML = "you can change ("+file.name+")picture";
        })

//18
    </script>
</body>
</html>


