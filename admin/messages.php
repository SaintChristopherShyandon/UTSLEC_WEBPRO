<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
    $delete_message->execute([$delete_id]);
    header('location:messages.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">
    <?php include '../components/admin_header.php' ?>

    <section class="messages pr-6 pl-6 ">
        <h1 class="text-blue-600 text-3xl mb-8">Messages</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            if ($select_messages->rowCount() > 0) {
                while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="bg-white border border-black rounded shadow p-4">
                <p class="mb-2">Name: <span><?= $fetch_messages['name']; ?></span></p>
                <p class="mb-2">Number: <span><?= $fetch_messages['number']; ?></span></p>
                <p class="mb-2">Email: <span><?= $fetch_messages['email']; ?></span></p>
                <p class="mb-2">Message: <span><?= $fetch_messages['message']; ?></span></p>
                <a href="messages.php?delete=<?= $fetch_messages['id']; ?>"
                    class="text-blue-100 bg-blue-600 hover:bg-blue-100 py-2 px-4 rounded inline-block"
                    onclick="return confirm('Delete this message?')">Delete</a>
            </div>
            <?php
                }
            } else {
                echo '<p class="text-red-600 text-2xl mt-8">You have no messages</p>';
            }
            ?>
        </div>
    </section>

</body>

</html>