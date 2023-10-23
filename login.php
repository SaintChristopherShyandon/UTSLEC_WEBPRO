<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $captcha = $_POST['captcha'];

    // Verify the CAPTCHA code
    if (empty($captcha) || $_SESSION['captcha_code'] !== strtoupper($captcha)) {
        $message[] = 'CAPTCHA code is incorrect!';
    } else {
        // Check the user's email and password
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        } else {
            $message[] = 'Incorrect username or password!';
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
    <title>login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <!-- header section starts  -->
    <?php include 'components/user_header.php'; ?>
    <!-- header section ends -->

    <section class="form-container mx-auto max-w-md p-6 bg-white rounded-lg shadow-lg">

        <form action="" method="post">
            <h3 class="text-2xl font-bold mb-4">Login Now</h3>
            <input type="email" name="email" required placeholder="Enter your email"
                class="w-full p-2 border border-gray-300 rounded mb-2" maxlength="50">
            <input type="password" name="pass" required placeholder="Enter your password"
                class="w-full p-2 border border-gray-300 rounded mb-2" maxlength="50">
            <img src="captcha.php" alt="CAPTCHA Image" class="mb-2">
            <input type="text" name="captcha" maxlength="6" required placeholder="Enter the CAPTCHA code"
                class="w-full p-2 border border-gray-300 rounded mb-2">

            <input type="submit" value="Login Now" name="submit"
                class="w-full bg-blue-500 text-white py-2 rounded cursor-pointer">
            <p class="mt-2 text-sm">Don't have an account? <a href="register.php" class="text-blue-500">Register Now</a>
            </p>
        </form>

    </section>

    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>