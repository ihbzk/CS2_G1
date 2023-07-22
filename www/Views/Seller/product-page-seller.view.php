<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-2 text-gray-400 text-sm">
            <a href="<?= toRootPath('products/all') ?>" class="hover:underline hover:text-gray-600" aria-label="Produits">Produits</a>
            <p> > </p>
            <span><?= $productData['name'] ?></span>
        </div>
    </div>
    <div>
        <ul>
            <?php if (isset($_SESSION['update_errors'])) : ?>
                <?php foreach ($_SESSION['update_errors'] as $error) : ?>
                    <li>
                        <?php if (is_string($error)) : ?>
                            <?php echo $error; ?>
                        <?php else : ?>
                            <?php var_dump($error); ?>
                        <?php endif;?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="px-4">
                <?php $this->modal("form", $form); ?>
            </div>
        </div>
    </div>
</div>