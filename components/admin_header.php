<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message bg-blue-100">
            <span>' . $message . '</span>
            <i class="fas fa-times text-blue-600 cursor-pointer" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header bg-white">
    <section class="flex bg-blue-100 h-16 items-center pr-6 pl-6">
        <a href="dashboard.php" class="logo text-blue-600 text-2xl">Admin<span
                class="text-blue-600 text-2xl pr-6">Panel</span></a>
        <nav class="navbar hidden md:flex md:space-x-4">
            <a href="dashboard.php">home</a>
            <a href="products.php">products</a>
            <a href="placed_orders.php">orders</a>
            <a href="admin_accounts.php">admins</a>
            <a href="users_accounts.php">users</a>
            <a href="messages.php">messages</a>
        </nav>
        <div class="profile hidden md:flex md:space-x-4 text-black ml-4">
            <a href="update_profile.php" class="btn bg-blue-100">update profile</a>
            <div class="flex-btn">
                <a href="admin_login.php" class="option-btn bg-blue-100">login</a>
            </div>
            <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"
                class="delete-btn">logout</a>
        </div>
        <div class="md:flex hidden ml-40 pl-40">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>Selamat Datang, <?= $fetch_profile['name']; ?>!</p>
        </div>
    </section>
</header>