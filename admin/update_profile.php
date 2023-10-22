<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $select_name = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
      $select_name->execute([$name]);
      if($select_name->rowCount() > 0){
         $message[] = 'username already taken!';
      }else{
         $update_name = $conn->prepare("UPDATE `admin` SET name = ? WHERE id = ?");
         $update_name->execute([$name, $admin_id]);
      }
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_old_pass = $conn->prepare("SELECT password FROM `admin` WHERE id = ?");
   $select_old_pass->execute([$admin_id]);
   $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
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
            $update_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $admin_id]);
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
    <title>Profile Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-white">

    <?php include '../components/admin_header.php' ?>
    <section class="form-container flex items-center justify-center min-h-screen">
        <form action="" method="POST"
            class="bg-white border border-black rounded-md shadow-md p-8 text-center w-80 max-w-2xl">
            <h3 class="text-2.5xl text-blue-600 mb-4">Update Profile</h3>
            <input type="text" name="name" maxlength="20"
                class="w-full bg-light-bg px-4 py-3 text-black border border-black rounded-md mb-4"
                oninput="this.value = this.value.replace(/\s/g, '')" placeholder="<?= $fetch_profile['name']; ?>">
            <input type="password" name="old_pass" maxlength="20" placeholder="Enter your old password"
                class="w-full bg-light-bg px-4 py-3 text-black border border-black rounded-md mb-4"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="new_pass" maxlength="20" placeholder="Enter your new password"
                class="w-full bg-light-bg px-4 py-3 text-black border border-black rounded-md mb-4"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="confirm_pass" maxlength="20" placeholder="Confirm your new password"
                class="w-full bg-light-bg px-4 py-3 text-black border border-black rounded-md mb-4"
                oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Update Now" name="submit"
                class="btn bg-blue-600 hover:bg-blue-100 text-white hover:text-blue-600 transition-colors w-full py-3 rounded-md">
        </form>
    </section>
    <script src="../js/admin_script.js"></script>

</body>

</html>