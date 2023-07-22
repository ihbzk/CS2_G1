<div class="container mx-auto px-4 sm:px-8">
    <div class="py-4">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto w-full lg:w-1/2">
            <div class="flex justify-center items-center flex-row">
                <img src="<?= $userData['thumbnail'] ?>" class="h-28 w-28 rounded-full" alt="Photo de profil de <?= $userData['firstname'] ?> <?= $userData['lastname'] ?>">
                <h1 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pl-3 pb-3">Bienvenue sur votre profil <?= $userData['firstname'] ?> <?= $userData['lastname'] ?> !</h1>
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
                        <form method="POST" action="/update-thumbnail">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td>
                                    <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                        Photo de profil
                                    </label>
                                </td>
                                <td>
                                    <input type="text" class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-pointer w-full w-full hover:bg-gray-100" name="thumbnail" value="<?= $userData['thumbnail'] ?>" required>
                                </td>
                                <td>
                                    <button type="submit" class="text-gray-400 hover:text-black text-xs" aria-label="Modifier">
                                        <i class="fa-solid fa-check"></i>
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                        </form>
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
                        <form method="POST" action="/update-firstname">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td>
                                    <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                        Prénom
                                    </label>
                                </td>
                                <td>
                                    <input type="text" class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-pointer w-full hover:bg-gray-100" name="firstname" value="<?= $userData['firstname'] ?>" required>
                                </td>
                                <td>
                                    <button type="submit" class="text-gray-400 hover:text-black text-xs" aria-label="Modifier">
                                        <i class="fa-solid fa-check"></i>
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                        </form>
                        <form method="POST" action="/update-lastname">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td>
                                    <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                        Nom
                                    </label>
                                </td>
                                <td>
                                    <input type="text" class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-pointer w-full hover:bg-gray-100" name="lastname" value="<?= $userData['lastname'] ?>" required>
                                </td>
                                <td>
                                    <button type="submit" class="text-gray-400 hover:text-black text-xs" aria-label="Modifier">
                                        <i class="fa-solid fa-check"></i>
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                        </form>
                        <form method="POST" action="/update-pseudo">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td>
                                    <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                        Pseudo
                                    </label>
                                </td>
                                <td>
                                    <input type="text" class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-pointer w-full hover:bg-gray-100" name="pseudo" value="<?= $userData['pseudo'] ?>" required>
                                </td>
                                <td>
                                    <button type="submit" class="text-gray-400 hover:text-black text-xs" aria-label="Modifier">
                                        <i class="fa-solid fa-check"></i>
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                        </form>
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
                        <form method="POST" action="/update-phone">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td>
                                    <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                        Numéro de téléphone
                                    </label>
                                </td>
                                <td>
                                    <input type="text" class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-pointer w-full hover:bg-gray-100" name="phone" value="<?= $userData['phone'] ?>" required>
                                </td>
                                <td>
                                    <button type="submit" class="text-gray-400 hover:text-black text-xs" aria-label="Modifier">
                                        <i class="fa-solid fa-check"></i>
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                        </form>
                        <form method="POST" action="/update-address">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td>
                                    <label class="text-left text-xs text-red-700 font-bold uppercase tracking-wider">
                                        Adresse
                                    </label>
                                </td>
                                <td>
                                    <input type="text" class="px-5 py-3 text-left text-xs font-semibold tracking-wider cursor-pointer w-full hover:bg-gray-100" name="address" value="<?= $userData['address'] ?>" required>
                                </td>
                                <td>
                                    <button type="submit" class="text-gray-400 hover:text-black text-xs" aria-label="Modifier">
                                        <i class="fa-solid fa-check"></i>
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
                <div class="pt-10">
                    <form action="" method="POST">
                        <input type="hidden" name="deleteUser" value="1">
                        <input type="hidden" name="id" value="<?= $userData['id']; ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action sera irréversible !')" aria-label="Supprimer mon compte définitivement">
                            <i class="fa-solid fa-trash"></i>
                            Supprimer mon compte définitivement
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if ($userData['id_role'] == 3) : ?>
        <div class="py-8">
            <div class="text-center">
                <a href="<?= toRootPath('products/all') ?>" class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center" aria-label="Voir tous mes produits">Voir tous mes produits</a>
            </div>
        </div>
    <?php endif;?>
</div>