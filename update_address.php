<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
}

if (isset($_POST['submit'])) {

    $address = $_POST['flat'] . ', ' . $_POST['building'] . ', ' . $_POST['area'] . ', ' . $_POST['town'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
    $update_address->execute([$address, $user_id]);

    $message[] = 'address saved!';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Address</title>

    <!-- Tailwind CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <?php include 'components/user_header.php' ?>

    <section class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-4 bg-white rounded shadow-lg">
            <form action="" method="post">
                <h3 class="text-2xl font-bold text-center">Alamat</h3>
                <input type="text" class="input" placeholder="Flat No." required maxlength="50" name="flat">
                <input type="text" class="input" placeholder="Building No." required maxlength="50" name="building">
                <input type="text" class="input" placeholder="Area" required maxlength="50" name="area">
                <input type="text" class="input" placeholder="Town Name" required maxlength="50" name="town">
                <input type="text" class="input" placeholder="Kota" required maxlength="50" name="city">
                <input type="text" class="input" placeholder="Jalan" required maxlength="50" name="state">
                <input type="text" class="input" placeholder="Negara" required maxlength="50" name="country">
                <input type="number" class="input" placeholder="Pin Code" required max="999999" min="0" maxlength="6" name="pin_code">
                <input type="submit" value="Save Address" name="submit" class="btn">
            </form>
        </div>
    </section>

    <?php include 'components/footer.php' ?>

    <!-- custom js file link -->
    <script src="js/script.js"></script>

</body>

</html>
