<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');

      #toplist{
    background-color: black;
    list-style-type: none;
    padding: 20px;
}
body{
    background-color: white;
}

li a{
    color: orange;
    text-decoration: none;
    padding: 20px 20px;
}
li a:hover{
    color: black;
    background-color: white;
}
.left{
    display:inline;

}
.right{
    float: right;
}
h1{
    text-align: center;
}
#signupform{
    background-color: blanchedalmond;
    border-radius: 5px;
    padding: 20px;
    margin: 8px 15px;
}
input,select{
    width: 100%;
    padding: 12px 15px;
}
input,select,label{
    display: block;
    text-align: center;
    margin: auto;
}
#forrm{
    margin: auto;
    width: 1000px;
}
#form{
    margin:auto;
    width: 1000px;
}
/* General button style */
.btn {
    background-color:orange;
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
.btn:hover{
    color:antiquewhite;
    background-color: black;
}


   </style>
   

</head>
<body>
   
<div class="form">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>login now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
      <p>no account? <a href="register.php">Become a member</a></p>
   </form>

</div>

</body>
</html>