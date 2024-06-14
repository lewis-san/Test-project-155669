<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $dateOfBirth = mysqli_real_escape_string($conn, $_POST['dateOfBirth']);
   $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, dateOfBirth, phoneNumber, image) VALUES('$name', '$email', '$pass', '$dateOfBirth','$phoneNumber', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
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
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');

:root {
    --primary-color: black;
    --secondary-color: blanchedalmond;
    --light-bg: #F4DF8D;
    --dark-bg: black;
    --text-color: black;
    --border-color: #ddd;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: white;
    color: var(--text-color);
    margin: 0;
    padding: 0;
}

#toplist {
    background-color: var(--dark-bg);
    list-style-type: none;
    padding: 20px;
}

li a {
    color: var(--primary-color);
    text-decoration: none;
    padding: 20px 20px;
}

li a:hover {
    color: var(--dark-bg);
    background-color: white;
}

.left {
    display: inline;
}

.right {
    float: right;
}

h1 {
    text-align: center;
}

#signupform {
    background-color: var(--secondary-color);
    border-radius: 5px;
    padding: 20px;
    margin: 8px 15px;
}

input, select {
    width: 100%;
    padding: 12px 15px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid var(--border-color);
    border-radius: 4px;
}

input, select, label {
    display: block;
    margin: auto;
    text-align: center;
}

#forrm, #form {
    margin: auto;
    width: 1000px;
}

.form {
    background-color: var(--secondary-color);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 50px auto;
}

.form h3 {
    text-align: center;
    color: var(--primary-color);
    margin-bottom: 20px;
}

.form .box {
    padding: 10px;
    font-size: 16px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    margin-bottom: 10px;
    background-color: white;
    color: var(--text-color);
}

.message {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 4px;
    text-align: center;
    background-color: #f2dede;
    color: #a94442;
}

/* General button style */
.btn {
    background-color: orange;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn:hover {
    color: antiquewhite;
    background-color: var(--dark-bg);
}

p {
    text-align: center;
}

p a {
    color: var(--primary-color);
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}


   </style>
   

</head>
<body>
   
<div class="form">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Car Rental Client Sign-up</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <label for="phoneNumber">Enter username:</label><br>
      <input type="text" name="name" placeholder="your username" class="box" required>
      <label for="phoneNumber">Enter email:</label><br>
      <input type="email" name="email" placeholder="your email" class="box" required>
      <label for="phoneNumber">Enter password:</label><br>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <label for="phoneNumber">Confirm password:</label><br>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
      <label for="dateOfBirth">Enter your date of birth:</label><br>
      <input type="date" name="dateOfBirth" id="dateOfBirth" class="box" required><br>
      <label for="phoneNumber">Enter phonenumber:</label><br>
      <input type="tel" name="phoneNumber" id="phoneNumber" placeholder="Enter phone number" class="box" required><br>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="submit" class="btn">
      <p>already a member? <a href="login.php">login </a></p>
   </form>

</div>

</body>
</html>