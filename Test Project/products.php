<?php
include 'config.php';

$query = "SELECT * FROM `product`";
$result = mysqli_query($conn, $query) or die('query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <div class="container">
        <h2>Products</h2>
        <div class="products">
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <div class="product">
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>$<?php echo $row['price']; ?></p>
            </div>
            <?php
                }
            }else{
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
