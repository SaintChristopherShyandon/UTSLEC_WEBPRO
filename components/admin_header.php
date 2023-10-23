<header class="header">
    <section class="flex bg-blue-100 h-16 items-center pr-6 pl-6">
        <a href="dashboard.php" class="logo text-blue-600 text-2xl">Webpro<span
                class="text-blue-600 text-2xl pr-6">Resto</span></a>
        <nav class="navbar hidden md:flex md:space-x-4">
            <a href="dashboard.php" class="hover:underline p-2">Home</a>
            <a href="products.php" class="hover:underline p-2">Products</a>
            <a href="placed_orders.php" class="hover:underline p-2">Orders</a>
            <a href="admin_accounts.php" class="hover:underline p-2">Admins</a>
            <a href="users_accounts.php" class="hover:underline p-2">Users</a>
            <a href="messages.php" class="hover:underline p-2">Messages</a>
        </nav>
        <div class="profile hidden md:flex md:flex-row md:space-x-4 text-black ml-4">
            <a href="update_profile.php" class="btn bg-blue-100">Update Profile</a>
            <div class="flex-btn">
                <a href="admin_login.php" class="option-btn bg-blue-100">Login</a>
            </div>
            <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"
                class="delete-btn">Logout</a>
        </div>
        <div class="md:flex hidden md:ml-20">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <p>Selamat Datang, <?= $fetch_profile['name']; ?>!</p>
        </div>
    </section>
</header>