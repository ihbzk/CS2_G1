<nav class="flex items-center justify-between flex-wrap bg-red-700 p-6">

    <label class="block lg:hidden cursor-pointer flex items-center text-white hover:text-black hover:border-white" for="menu-toggle">
        <i class="fa-solid fa-bars"></i>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />

    <div class="hidden w-full block flex-grow lg:flex lg:items-center lg:w-auto" id="menu">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="<?= toRootPath('') ?>" aria-label="Accueil">
                <!-- <img src="<?= toRootPath('public/assets/img/icons/logo-white.svg') ?>" alt="Logo Hip-Shop"> -->
                <h2 class="logo-title"><?= $titleContent; ?></h2>
            </a>
        </div>
        <div class="text-sm lg:flex-grow">
            <?php if (!isset($_SESSION['role']) || ($_SESSION['role'] != 2)) : ?>
                <a href="<?= toRootPath('products') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4" aria-label="Produits">
                    <i class="fa-solid fa-music"></i>
                    Produits
                </a>
                <a href="<?= toRootPath('pages') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4" aria-label="Produits">
                    <i class="fa-solid fa-newspaper"></i>
                    Pages
                </a>
            <?php endif; ?>
            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 2)) : ?>
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
            <?php endif; ?>
        </div>
        <div class="block lg:flex-grow-0">
            <form action="<?= toRootPath('search') ?>" method="GET" class="block mt-4 lg:mt-0 text-black flex">
                <input type="text" name="result" placeholder="Rechercher un produit..." class="px-3 py-2" />
                <button type="submit" class="ml-0 m-0 px-3 py-2 bg-white text-black" aria-label="Rechercher">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="bloc lg:flex-grow flex justify-end">
            <?php if (isset($_SESSION['email'])) : ?>
                <a href="<?= toRootPath('profile') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-black mr-4" aria-label="Profil">
                    <i class="fa-solid fa-user"></i>
                    Profil
                </a>
            <?php endif; ?>
            <?php if (isset($_SESSION['email'])) : ?>
                <?php if (!isset($_SESSION['role']) || ($_SESSION['role'] != 2)) : ?>
                    <li class="font-sans block mt-4 lg:inline-block lg:mt-0 lg:ml-6 align-middle text-black hover:text-gray-700">
                        <a href="<?= toRootPath('cart') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-black mr-4">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span class="rounded-full bg-black w-4 h-4 p-1 m-0 text-white text-sm text-center"><?= count($_SESSION['cart']) ?></span>
                            Panier
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (!isset($_SESSION['email'])) : ?>
                <a href="<?= toRootPath('register') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-black mr-4" aria-label="Inscription">
                    <i class="fa-solid fa-user-plus"></i>
                    Inscription
                </a>
                <a href="<?= toRootPath('login') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-black mr-4" aria-label="Connexion">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Connexion
                </a>
            <?php endif; ?>
            <?php if (isset($_SESSION['email'])) : ?>
                <a href="<?= toRootPath('logout') ?>" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4" aria-label="Logout">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>
                    Logout
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>