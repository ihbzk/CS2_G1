<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="text-center">
            <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Tous les utilisateurs</h2>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Photo de profil
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Rôle
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Prénom
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nom
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nom d'utilisateur
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Date d'anniversaire
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($userData)) : ?>
                            <?php foreach ($userData as $user) : ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <img src="<?= toRootPath($user['thumbnail']); ?>" class="w-12 h-12 object-cover rounded mr-4" alt="Photo de profil de <?= $user['firstname'] ?> <?= $user['lastname'] ?>">
                                        </div>
                                    </td>
                                    <?php foreach ($roleData as $role) : ?>
                                        <?php if ($user['id_role'] == $role['id']) : ?>
                                            <td class="px-5 py-5 border-b border-r capitalize border-gray-200 bg-white text-sm"><?= $role['name']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td class="px-5 py-5 border-b border-r lowercase border-gray-200 bg-white text-sm">
                                        <?= $user['email']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $user['firstname']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $user['lastname']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        @<?= $user['pseudo']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $user['birth_date']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <form action="" method="POST">
                                            <input type="hidden" name="deleteUsers" value="1">
                                            <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur et toutes ses données associées ?')" aria-label="Êtes-vous sûr de vouloir supprimer cet utilisateur et toutes ses données associées ?">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <button aria-label="Voir le profil">
                                            <a href="<?= toRootPath('admin/users/profile/?id='); ?><?= $user['id'] ?>" aria-label="Voir le profil">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10" class="px-5 py-5 border-gray-200 bg-white text-sm">Il n'y a pas d'utilisateur.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>