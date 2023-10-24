<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message text-center text-blue-600">
            <span>' . $message . '</span>
            <i class="fas fa-times ml-3" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
<!-- Header Section -->
<header class="bg-blue-600 p-4">
    <section class="container mx-auto flex items-center justify-between">
        <a href="index.php" class="text-2xl font-bold text-white">IF330-B Kelompok 5 Resto </a>
        <div class="hidden md:flex md:items-center">
            <nav class="text-center md:text-left">
                <a href="index.php" class="text-white hover:underline p-2 text-sm md:text-base">Home</a>
                <a href="about.php" class="text-white hover:underline p-2 text-sm md:text-base">About</a>
                <a href="menu.php" class="text-white hover:underline p-2 text-sm md:text-base">Menu</a>
                <a href="orders.php" class="text-white hover:underline p-2 text-sm md:text-base">Orders</a>
            </nav>
            <a href="search.php" class="text-white hover:text-gray-200 p-3"><i class="fas fa-search"></i></a>
            <a href="cart.php" class="text-white hover:text-gray-200 p-3"><i class="fa fa-shopping-basket"></i></a>
        </div>
        <div class="flex sm:hidden items-center">
            <a href="search.php" class="text-white hover:text-gray-200 p-3"><i class="fas fa-search"></i></a>
            <a href="cart.php" class="text-white hover:text-gray-200 p-3"><i class="fa fa-shopping-basket"></i></a>
        </div>
        <?php
        if (isset($user_id) && !empty($user_id)) {
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo '<p class="text-white hidden sm:block">Hi! ' . $fetch_profile['name'] . '</p>';
            }
        }
        ?>
        <div id="userDropdown"
            class="relative right-1 left-4 hidden sm:flex md:flex sm:flex-col md:flex-row md:items-center sm:space-y-2 md:space-x-4 bg-blue-100 text-black rounded shadow-md p-2">
            <a href="profile.php" class="hover:underline md:pt-1.5"><i class="fas fa-user alt"></i></a>
            <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');"
                class="text-red hover:underline ">Logout</a>
            <a href="login.php" class="hover:underline">Login</a>
            <a href="register.php" class="hover:underline">Register</a>
        </div>
        <div id="userIcon" class="sm:hidden text-white p-3 cursor-pointer">☰</div>
    </section>
</header>


<script>
const userIcon = document.getElementById('userIcon');
const userDropdown = document.getElementById('userDropdown');
let dropdownVisible = false;

userIcon.addEventListener('click', function(event) {
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
document.addEventListener('click', function(event) {
    if (!userDropdown.contains(event.target) && !userIcon.contains(event.target)) {
        if (window.innerWidth <= 768 && !dropdownVisible) {
            userDropdown.classList.add('hidden');
        }
    }
});
</script>