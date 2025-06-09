
<?php function navbar($logged_in=true, $firstName='', $lastName='', $cart) {?>
    
    <nav class="z-10 top-0 fixed bg-white w-screen shadow-sm px-24 py-3 flex flex-row justify-between items-center">
        <div class="kiri">
            <h1 class="font-playwrite logo text-xl font-extrabold">
                Jewepe
            </h1>
        </div>
        <div class="tengah flex flex-row gap-x-4">
            <a href="../pages/home.php" class="hover:font-semibold">Home</a>
            <a href="../pages/catalogue.php"class="hover:font-semibold">Catalogue</a>
            <a href="#contact"class="hover:font-semibold">Contact Us</a>
        </div>
        <div class="kanan flex flex-row gap-x-3 items-center">
        <?php if ($logged_in): ?>
            <a href="../pages/cart.php"class="hover:font-semibold">Cart (<?= $cart ?>)</a>

            <div class="relative inline-block text-left">
                <button onclick="dropdown()" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md" id="menu-button" aria-expanded="false" aria-haspopup="true">
                    <?= $firstName ?> <?= $lastName ?>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown-menu" class="absolute right-0 z-10 mt-4 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <a href="../pages/userProfile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Profile</a>
                        <a href="../pages/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Log Out</a>
                    </div>
                </div>
            </div>

    <script>
        function dropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const menuButton = document.getElementById('menu-button');
            
            // Toggle the visibility of the dropdown menu
            dropdownMenu.classList.toggle('hidden');
            // Update aria-expanded attribute
            menuButton.setAttribute('aria-expanded', !dropdownMenu.classList.contains('hidden'));
        }

        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const menuButton = document.getElementById('menu-button');

            // Close dropdown if clicked outside
            if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                menuButton.setAttribute('aria-expanded', 'false');
            }
        });
    </script>

        <?php else: ?>
            <a href="../pages/cart.php" class="hover:font-semibold">Cart</a>
            <a href="../pages/register.php" class="py-1 px-3 rounded-sm border-1 border-black hover:bg-black hover:text-white">Get started</a>
            <a href="" class="py-1 px-3 rounded-sm bg-black text-white">Login</a>
        <?php endif; ?>       
        </div>
    </nav>

<?php }?>