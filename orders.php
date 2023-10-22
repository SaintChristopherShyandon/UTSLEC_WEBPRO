<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

<!-- Header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- Header section ends -->

<div class="bg-gray-200 p-4">
   <h3 class="text-2xl text-center">Orders</h3>
   <p class="mt-2 text-center">
      <a href="home.php">Home</a>
      <span class="mx-2">/</span>
      <span>Orders</span>
   </p>
</div>

<section class="orders bg-white text-gray-800 py-12">
   <div class="container mx-auto">
      <h1 class="text-3xl font-bold text-center">Your Orders</h1>
      <div class="box-container mt-8">
      <?php
         if($user_id == ''){
            echo '<p class="empty text-center">Please login to see your orders</p>';
         }else{
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if($select_orders->rowCount() > 0){
               while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
               <div class="box p-4 bg-white shadow-md rounded-lg text-gray-800 mb-4">
                  <p><span class="font-semibold">Placed On:</span> <?= $fetch_orders['placed_on']; ?></p>
                  <p><span class="font-semibold">Name:</span> <?= $fetch_orders['name']; ?></p>
                  <p><span class="font-semibold">Email:</span> <?= $fetch_orders['email']; ?></p>
                  <p><span class="font-semibold">Number:</span> <?= $fetch_orders['number']; ?></p>
                  <p><span class="font-semibold">Address:</span> <?= $fetch_orders['address']; ?></p>
                  <p><span class="font-semibold">Payment Method:</span> <?= $fetch_orders['method']; ?></p>
                  <p><span class="font-semibold">Your Orders:</span> <?= $fetch_orders['total_products']; ?></p>
                  <p><span class="font-semibold">Total Price:</span> $<?= $fetch_orders['total_price']; ?>/-</p>
                  <p><span class="font-semibold">Payment Status:</span> <span class="<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'text-red-600'; }else{ echo 'text-green-600'; }; ?>"><?= $fetch_orders['payment_status']; ?></span></p>
               </div>
      <?php
               }
            }else{
               echo '<p class="empty text-center">No orders placed yet!</p>';
            }
         }
      ?>
      </div>
   </div>
</section>

<!-- Footer section starts -->
<?php include 'components/footer.php'; ?>
<!-- Footer section ends -->

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>
