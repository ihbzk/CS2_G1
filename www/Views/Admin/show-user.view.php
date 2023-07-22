<div class="container mx-auto px-4 sm:px-8">
    <div class="py-4">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto w-full lg:w-1/2">
            <div class="flex justify-center items-center flex-row">
                <img src="<?= $userData['thumbnail'] ?>" class="h-28 w-28 rounded-full" alt="Photo de profil de <?= $userData['firstname'] ?> <?= $userData['lastname'] ?>">
                <h1 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pl-3 pb-3">Profil de <?= $userData['firstname'] ?> <?= $userData['lastname'] ?> !</h1>
            </div>
            <div class="inline-block min-w-full overflow-hidden pt-6">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200">
                            <td>
                                <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                    Email
                                </label>
                            </td>
                            <td>
                                <p class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-default"><?= $userData['email'] ?></p>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td>
                                <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                    Prénom
                                </label>
                            </td>
                            <td>
                                <p class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-default"><?= $userData['firstname'] ?></p>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td>
                                <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                    Nom
                                </label>
                            </td>
                            <td>
                                <p class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-default"><?= $userData['lastname'] ?></p>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td>
                                <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                    Pseudo
                                </label>
                            </td>
                            <td>
                                <p class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-default"><?= $userData['pseudo'] ?></p>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td>
                                <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                    Date d'anniversaire
                                </label>
                            </td>
                            <td>
                                <p class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-default"><?= $userData['birth_date'] ?></p>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td>
                                <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                    Numéro de téléphone
                                </label>
                            </td>
                            <td>
                                <p class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-default"><?= $userData['phone'] ?></p>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td>
                                <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                    Adresse
                                </label>
                            </td>
                            <td>
                                <p class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-default"><?= $userData['address'] ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php //if ($userData['id_role'] == 3) : ?>
        <div class="py-8">
            <div class="text-center">
                <a href="<?= toRootPath('admin/products/user?id=' . $userData['id']) ?>" class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center" aria-label="Voir tous ses produits">Voir tous ses produits</a>
            </div>
        </div>
    <?php //endif;?>
</div>