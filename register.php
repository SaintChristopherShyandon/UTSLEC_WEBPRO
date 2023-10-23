<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $number, $cpass]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
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

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Tailwind CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css">

</head>

<body class="bg-gray-100">
    <?php include 'components/user_header.php'; ?>
    <section class="flex justify-center items-center min-h-screen">
        <form action="" method="post" class="bg-white p-6 rounded-lg shadow-md max-w-sm w-full">
            <h3 class="text-2xl font-bold mb-4">Register Now</h3>
            <input type="text" name="name" required placeholder="Name"
                class="w-full p-2 mb-2 border border-gray-300 rounded">
            <input type="email" name="email" required placeholder="Email"
                class="w-full p-2 mb-2 border border-gray-300 rounded" maxlength="50">
            <input type="number" name="number" required placeholder="Phone number"
                class="w-full p-2 mb-2 border border-gray-300 rounded">
            <input type="password" name="pass" required placeholder="Password"
                class="w-full p-2 mb-2 border border-gray-300 rounded" maxlength="50">
            <input type="password" name="cpass" required placeholder="Confirm your password"
                class="w-full p-2 mb-2 border border-gray-300 rounded" maxlength="50">
            <input type="submit" value="Register Now" name="submit"
                class="w-full bg-blue-500 text-white py-2 rounded cursor-pointer">
            <p class="mt-2 text-sm">Already have an account? <a href="login.php" class="text-blue-500">Login Now</a>
            </p>
        </form>
    </section>

    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>