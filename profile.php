<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_SESSION['user_profile'])) {
        $fetch_profile = $_SESSION['user_profile'];
    } else {
        $fetch_profile = array(
            'name' => 'Nama Pengguna Default',
            'number' => 'Nomor Default',
            'email' => 'Email Default',
            'address' => 'Alamat Default'
        );
    }
} else {
    $user_id = '';
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css">
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <section class="user-details p-4 bg-white mt-4 mx-auto max-w-md rounded-lg shadow-lg mt-10 mb-10">
        <div class="user text-center">
            <img src="images/user-icon.png" alt="" class="mx-auto mb-4 w-32">
            <p><i class="fas fa-user"></i><span><?= $fetch_profile['name']; ?></span></p>
            <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
            <a href="update_profile.php" class="btn bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">Update
                Info</a>
            <p class="address"><i
                    class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'Please enter your address';}else{echo $fetch_profile['address'];} ?></span>
            </p>
            <a href="update_address.php" class="btn bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">Update
                Address</a>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
    <script src="js/script.js"></script>
</body>

</html>