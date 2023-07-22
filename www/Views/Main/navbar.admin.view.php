<nav class="flex items-center justify-between flex-wrap bg-red-700 p-6">
    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 2)) : ?>
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="<?= toRootPath('admin/dashboard') ?>" aria-label="Dribbble">
                <!-- <img src="<?= toRootPath('public/assets/img/icons/logo-white.svg') ?>" alt="Logo Hip-Shop"> -->
                <h2 class="logo-title"><?php echo $titleContent; ?></h2>
            </a>
        </div>
        <label class="block lg:hidden cursor-pointer flex items-center text-white hover:text-black hover:border-white" for="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />
        <div class="hidden w-full block flex-grow lg:flex lg:items-center lg:w-auto" id="menu">
            <div class="text-sm lg:flex-grow">
                <a href="<?= toRootPath('admin/dashboard') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-black mr-4" aria-label="Tableau de bord">
                    <i class="fa-solid fa-chart-simple"></i>
                    Tableau de bord
                </a>
                <a href="<?= toRootPath('admin/users') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-black mr-4" aria-label="Utilisateurs">
                    <i class="fa-solid fa-users"></i>
                    Utilisateurs
                </a>
                <a href="<?= toRootPath('admin/products') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4" aria-label="Produits">
                    <i class="fa-solid fa-music"></i>
                    Produits
                </a>
                <a href="<?= toRootPath('admin/comments') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4" aria-label="Commentaires">
                    <i class="fa-solid fa-comments"></i>
                    Commentaires
                </a>
                <a href="<?= toRootPath('admin/pages') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4" aria-label="Pages">
                    <i class="fa-solid fa-comments"></i>
                    Pages
                </a>
            </div>
        <?php endif; ?>
        <div class="block">
            <?php if (isset($_SESSION['email'])) : ?>
                <a href="<?= toRootPath('profile') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-black mr-4" aria-label="Profil">
                    <i class="fa-solid fa-user"></i>
                    Profil
                </a>
                <a href="<?= toRootPath('logout') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4" aria-label="Logout">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                    Logout
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>