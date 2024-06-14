<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');

:root {
    --primary-color: black;
    --secondary-color: grey;
    --light-bg: #f8f9fa;
    --dark-bg: #333;
    --text-color: #333;
    --border-color: #ddd;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: white;
    color: var(--text-color);
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 0 20px;
}

.form-container {
    background-color: var(--secondary-color);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.form-container::before {
    content: '';
    position: absolute;
    top: -20px;
    left: -20px;
    width: calc(100% + 40px);
    height: 40px;
    background-color: var(--primary-color);
    transform: skewY(-4deg);
    z-index: -1;
}

.form-container h3 {
    margin-bottom: 20px;
    font-size: 24px;
    color: var(--primary-color);
    text-align: center;
}

.form-container .box {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    margin-bottom: 10px;
    background-color: var(--light-bg);
    color: var(--text-color);
    transition: background-color 0.3s ease;
}

.form-container .box:hover {
    background-color: #f0f0f0;
}

.btn {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

.btn:hover {
    background-color: #0056b3;
}

.message {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 4px;
    text-align: center;
    background-color: #f2dede;
    color: #a94442;
}

p {
    text-align: center;
    margin-top: 15px;
}

p a {
    color: var(--primary-color);
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}

.delete-btn {
    display: block;
    text-align: center;
    margin-top: 10px;
    color: white; 
    background-color: black;
    text-decoration: none;
    padding: 10px;
    border-radius: 4px;
}

.delete-btn:hover {
    text-decoration: underline;
}

   </style>

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
      <a href="update_profile.php" class="btn">update profile</a>
      <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      <a href="login.php">login</a> or <a href="register.php">register</a></p>
   </div>

</div>

</body>
</html>