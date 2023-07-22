<div class="container mx-auto px-4 sm:px-8">
    <div class="py-4">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto w-full">
            <div class="flex justify-center items-center flex-row">
                <h1 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pl-3 pb-3">Bienvenue sur votre panier !</h1>
            </div>
            <div class="inline-block min-w-full overflow-hidden pt-6">
                <h2 class="text-l sm:text-xl leading-normal font-regular tracking-tight text-black pl-3 pb-3">Récapitulatif de votre panier</h2>
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold uppercase tracking-wider">Produit</th>
                            <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold uppercase tracking-wider">Description</th>
                            <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold uppercase tracking-wider">Prix (HT)</th>
                            <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold uppercase tracking-wider">Quantité</th>
                            <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold uppercase tracking-wider">Total (prix TTC)</th>
                            <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;

                        if (!empty($productData)) :
                            foreach ($productData as $product) :
                                $subtotal = $product['price'];
                                $total += number_format($subtotal * 1.20, 2, '.', '');
                                $totalTTC = number_format($subtotal * 1.20, 2, '.', '');
                        ?>
                                <tr class="border-b border-gray-200">
                                    <td class="px-5 py-5">
                                        <div class="flex items-center">
                                            <img src="<?= $product['thumbnail'] ?>" alt="<?= $product['name'] ?>" class="w-12 h-12 object-cover rounded mr-4">
                                            <span><?= $product['name'] ?></span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5"><?= $product['description'] ?></td>
                                    <td class="px-5 py-5"><?= $product['price'] ?> €</td>
                                    <td class="px-5 py-5">
                                        <input type="number" min="1" max="<?= $product['max_quantity'] ?>" class="w-20 py-1 px-3 border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" value="1">
                                    </td>
                                    <td class="px-5 py-5"><?= $totalTTC ?> €</td>
                                    <td class="px-5 py-5">
                                        <form action="/remove-from-cart" method="POST">
                                            <input type="hidden" name="id" value="<?= $product['id']; ?>">
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'article du panier ? Cette action sera irréversible !')" aria-label="Êtes-vous sûr de vouloir supprimer l'article du panier ? Cette action sera irréversible !">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">Le panier est vide.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right pr-5 py-3 font-semibold uppercase">Prix final (TTC) :</td>
                            <td class="px-5 py-3 font-semibold"><?= $total ?> €</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="w-1/2 p-2">
                    <a href="<?= toRootPath('cart/pay') ?>" class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center" aria-label="Payer">
                        <i class="fa-solid fa-credit-card"></i>
                        Payer
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>