<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
   }

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'email already taken!';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
      }
   }

   if(!empty($number)){
      $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
      $select_number->execute([$number]);
      if($select_number->rowCount() > 0){
         $message[] = 'number already taken!';
      }else{
         $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
         $update_number->execute([$number, $user_id]);
      }
   }
   
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
   $select_prev_pass->execute([$user_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
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
   <title>Update Profile</title>

   <!-- Link to Tailwind CSS (You need to add this link to your project) -->
   <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">

   <!-- Font Awesome CSS (You need to add this link to your project) -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container update-form">
   <form action="" method="post" class="mx-auto max-w-md mt-4 p-4 bg-white rounded shadow">
      <h3 class="text-2xl font-bold mb-4">Update Profile</h3>
      <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="w-full p-2 mb-2 rounded border" maxlength="50">
      <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="w-full p-2 mb-2 rounded border" maxlength="50">
      <input type="number" name="number" placeholder="<?= $fetch_profile['number']; ?>" class="w-full p-2 mb-2 rounded border" min="0" max="9999999999" maxlength="10">
      <input type="password" name="old_pass" placeholder="Enter your old password" class="w-full p-2 mb-2 rounded border" maxlength="50">
      <input type="password" name="new_pass" placeholder="Enter your new password" class="w-full p-2 mb-2 rounded border" maxlength="50">
      <input type="password" name="confirm_pass" placeholder="Confirm your new password" class="w-full p-2 mb-4 rounded border" maxlength="50">
      <input type="submit" value="Update Now" name="submit" class="w-full p-2 rounded bg-blue-600 text-white hover:bg-blue-700 cursor-pointer">
   </form>
</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>