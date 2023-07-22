<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-2 text-gray-400 text-sm">
            <a href="<?= toRootPath('products') ?>" class="hover:underline hover:text-gray-600" aria-label="Produits">Produits</a>
            <p> > </p>
            <span><?= $productData['name'] ?></span>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4">
                <div>
                    <div class="h-64 md:h-80 rounded-lg mb-4">
                        <div style="background-image: url('<?= $productData['thumbnail'] ?>')" class="bg-cover h-64 md:h-80 rounded-lg mb-4 flex items-center justify-center"></div>
                    </div>
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <h2 class="mb-2 leading-tight tracking-tight font-bold text-black text-2xl md:text-3xl"><?= $productData['name'] ?></h2>
                <p class="text-black text-sm">Vendeur : <?= $productData['id_seller'] ?></p>
                <div class="flex items-center space-x-4 my-4">
                    <div>
                        <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                            <span class="font-bold text-red-700 text-3xl"><?= $productData['price'] ?></span>
                            <span class="text-red-500 mr-1 mt-1">€</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-500"><?= $productData['description'] ?></p>
                <div class="flex py-4 space-x-4">
                    <div class="relative">
                        <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">QT</div>
                        <select name="quantity" class="cursor-pointer appearance-none rounded-xl border border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1">
                            <?php for ($i = 1; $i <= $productData['max_quantity']; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <?php if (isset($_SESSION['role'])) : ?>
                        <?php if (!in_array($productData['id'], $_SESSION['cart'])) : ?>
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $productData['id']; ?>">
                                <button type="submit" onclick="return confirm('Ajouter l\'article au panier')" aria-label="Ajouter l'article au panier">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    Ajouter au panier
                                </button>
                            </form>
                        <?php else : ?>
                            <div class="italic text-gray-300">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Produit déjà dans le panier
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="py-8">
            <?php if (isset($_SESSION['role'])) : ?>
                <div class="text-center">
                    <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Mettre un commentaire</h2>
                </div>
                <?php print_r($errors ?? null); ?>

                <?php $this->modal("form", $form); ?>
            <?php endif; ?>
            
            <hr>

            <h2 class="text-lg font-bold mt-8">Tous les commentaires :</h2>
            <?php foreach ($comments as $comment) : ?>
                <div class="border border-gray-300 rounded-lg p-4 mt-4">
                    <p class="text-gray-500">
                        <i class="fa-solid fa-comment"></i>
                        <?= $comment['content'] ?>
                    </p>
                    <p class="text-gray-300 italic">
                        <i class="fa-solid fa-user"></i>
                        @<?= $comment['id_user'] ?> le <?= $comment['date'] ?>.
                    </p>
                    <?php // if (!$comment['is_reported']) : 
                    ?>
                    <a href="/report-comment?id=<?= $comment['id'] ?>" aria-label="Signaler">
                        Signaler
                    </a>
                    <?php // endif; 
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>