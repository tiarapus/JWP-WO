<?php function sideBar() {?>
    <div class="sidebar fixed w-1/5 h-screen bg-slate-100 shadow-md">
    <div class="body px-4 py-4 flex flex-col gap-y-12">
        <h1 class="text-3xl font-bold">
            JWP-WO
        </h1>
        <div class="side-menus flex flex-col gap-y-8">
            <div class="home flex flex-col gap-y-2">
                <h1 class="text-base font-bold">
                    Dashboard
                </h1>
                <div class="menus flex flex-col gap-y-2">
                <a href="../pages/report.php" class="w-full px-3 py-2 rounded-lg hover:font-semibold hover:bg-slate-200 text-md	">
                    Reports
                </a>
                <a href="../pages/adminDashboard.php" class="w-full px-3 py-2 rounded-lg hover:font-semibold hover:bg-slate-200 text-md	">
                    Products
                </a>
                <a href="../pages/categories.php" class="w-full px-3 py-2 rounded-lg hover:font-semibold hover:bg-slate-200 text-md	">
                    Categories
                </a>
                <a href="../pages/orders.php" class="w-full px-3 py-2 rounded-lg hover:font-semibold hover:bg-slate-200 text-md	">
                    Orders
                </a>
                </div>
            </div>
            <div class="home flex flex-col gap-y-2">
                <h1 class="text-base font-bold">
                    Web Configuration
                </h1>
                <div class="menus flex flex-col gap-y-2">
                <a href="../pages/addSettings.php" class="w-full px-3 py-2 rounded-lg hover:font-semibold hover:bg-slate-200 text-md	">
                    Settings
                </a>
                </div>
            </div>
            <div class="home flex flex-col gap-y-2">
                <h1 class="text-base font-bold">
                    Auth
                </h1>
                <div class="menus flex flex-col gap-y-2">
                <a href="../pages/logout.php" class="w-full px-3 py-2 rounded-lg hover:font-semibold hover:bg-slate-200 text-md	">
                    Log Out
                </a>
                </div>
            </div>
        </div>

    </div>
    
</div>
<?php }?>