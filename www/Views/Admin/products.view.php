<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="text-center">
            <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Tous les produits</h2>
        </div>
        <div class="flex flex-wrap justify-center items-center min-h-screen">
            <?php if (!empty($productData)) : ?>
                <?php foreach ($productData as $product) : ?>
                    <div class="w-full md:w-1/2 p-2">
                        <div class="bg-white shadow-lg hover:shadow-xl rounded-lg ">
                            <div class="bg-gray-400 h-64 rounded-t-lg p-4 bg-no-repeat bg-center bg-cover" style="background-image: url(<?= $product['thumbnail']; ?>)">
                            </div>
                            <div class="flex justify-between items-start px-2 pt-2">
                                <div class="p-2 flex-grow">
                                    <h1 class="font-medium text-xl font-poppins"><?= $product['name']; ?></h1>
                                    <p class="text-gray-500 font-nunito"><?= $product['description']; ?></p>
                                </div>
                                <div class="p-2 text-right">
                                    <div class="text-red-700 font-semibold text-lg font-poppins"><?= $product['price']; ?> €</div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center px-2 pb-2">
                                <div class="w-1/2 p-2">
                                    <form action="" method="POST">
                                        <input type="hidden" name="deleteProducts" value="1">
                                        <input type="hidden" name="id" value="<?= $product['id']; ?>">
                                        <button type="submit" class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit et toutes ses données associées ?')" aria-label="Êtes-vous sûr de vouloir supprimer ce produit et toutes ses données associées ?">
                                            <i class="fa-solid fa-trash"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="10" class="px-5 py-5 border-gray-200 bg-white text-sm">Il n'y a pas de produit.</td>
                </tr>
            <?php endif; ?>
        </div>
    </div>
</div>