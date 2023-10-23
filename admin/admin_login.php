<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
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

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css">

</head>

<body>
    <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message flex items-center justify-between text-black bg-blue-100 p-4 mb-4">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>

    <section class="form-container flex items-center justify-center min-h-screen">
        <form action="" method="POST" class="max-w-2xl bg-white border rounded-lg shadow-lg p-8 text-center">
            <h3 class="text-2xl text-blue-600 mb-4">Login Now</h3>
            <p class="text-blue-600">Default username = <span class="text-blue-600">bev</span> & password = <span
                    class="text-blue-600">bev</span></p>
            <input type="text" name="name" maxlength="20" required placeholder="Enter your username"
                class="w-full bg-blue-100 border rounded p-2 mb-4" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" maxlength="20" required placeholder="Enter your password"
                class="w-full bg-blue-100 border rounded p-2 mb-4" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Login Now" name="submit"
                class="w-full bg-blue-600 text-white rounded p-2 cursor-pointer">
        </form>
    </section>
    <script src="../js/admin_script.js"></script>
</body>

</html>