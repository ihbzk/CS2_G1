<footer class="bottom-0 flex justify-center w-full">
    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            <div class="px-5 py-2">
                <a href="<?= toRootPath(''); ?>" class="text-base leading-6 text-gray-500 hover:text-gray-900" aria-label="About">
                    Accueil
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="<?= toRootPath('private-policy'); ?>" class="text-base leading-6 text-gray-500 hover:text-gray-900" aria-label="Terms">
                    Politique de confidentialité
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="<?= toRootPath('terms-and-conditions'); ?>" class="text-base leading-6 text-gray-500 hover:text-gray-900" aria-label="Team">
                    Mentions légales
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="<?= toRootPath('sitemap'); ?>" class="text-base leading-6 text-gray-500 hover:text-gray-900" aria-label="Blog">
                    Plan du site
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900" aria-label="Contact">
                    Contact
                </a>
            </div>
        </nav>
        <?php
            $date = date('Y');
        ?>
        <p class="mt-8 text-base leading-6 text-center text-black">
            © <?= $date ?> <a href="https://www.<?= $company_website ?>" target="_blank"><?= $company_name ?></a>. Ce site est fictif.
        </p>
    </div>
</footer>