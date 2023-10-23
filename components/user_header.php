<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="bg-blue-600 p-4">
    <section class="container mx-auto flex items-center justify-between">
        <a href="home.php" class="text-2xl font-bold text-white">Webpro Resto</a>
        <nav class="text-center flex-grow">
            <a href="home.php" class="text-white hover:underline p-2">Home</a>
            <a href="about.php" class="text-white hover:underline p-2">About</a>
            <a href="menu.php" class="text-white hover:underline p-2">Menu</a>
            <a href="orders.php" class="text-white hover:underline p-2">Orders</a>
            <a href="contact.php" class="text-white hover:underline">Contact</a>
        </nav>
        <a href="search.php" class="text-white hover:text-gray-200 p-3"><i class="fas fa-search"></i></a>
        <a href="cart.php" class="text-white hover:text-gray-200 p-3"><i class="fa fa-shopping-basket"></i></a>

        <?php
        if (isset($user_id) && !empty($user_id)) {
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo '<p class="text-white">Hi! ' . $fetch_profile['name'] . '</p>';
            }
        }
        ?>

            <div id="userDropdown" class="relative right-1 left-4 hidden-flex flex-col space-y-2 space-x-4 bg-white text-black rounded shadow-md p-2">
                <a href="profile.php" class="hover:underline btn">Profile</a>
                <a href="components/user_logout.php button" onclick="return confirm('Logout from this website?');" class="hover:underline">Logout</a>
                <a href="login.php" class="hover:underline button">Login</a>
                <a href="register.php" class="hover:underline button">Register</a>
            </div>
        </div>
    </section>
</header>

<script>
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');
    let dropdownVisible = false;

    userIcon.addEventListener('click', function (event) {
        if (window.innerWidth <= 768) {
            if (dropdownVisible) {
                userDropdown.classList.add('hidden');
            } else {
                userDropdown.classList.remove('hidden');
            }
            dropdownVisible = !dropdownVisible;
        }
    });

    // Close the dropdown when clicking anywhere outside of it
    document.addEventListener('click', function (event) {
        if (!userDropdown.contains(event.target) && !userIcon.contains(event.target)) {
            if (window.innerWidth <= 768 && !dropdownVisible) {
                userDropdown.classList.add('hidden');
            }
        }
    });
</script>
