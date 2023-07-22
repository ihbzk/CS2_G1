<div class="container mx-auto px-4 sm:px-8">
    <div class="text-center">
        <h1 class="text-3xl sm:text-4xl leading-normal font-bold tracking-tight text-red-700 pt-12 pb-5">Tableau de bord</h1>
    </div>
    <div class="py-8 flex flex-wrap -mx-3 mb-6 justify-center">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto lg:w-full">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Tous les commentaires reportés</h2>
            </div>
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden w-full">
                <table class="min-w-full leading-normal w-full">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Utilisateur
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Contenu
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Reporter
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($commentReportedData)) : ?>
                            <?php foreach ($commentReportedData as $commentReported) : ?>
                                <tr>
                                    <?php foreach ($userData as $user) : ?>
                                        <?php if ($commentReported['id_user'] == $user['id']) : ?>
                                            <td class="px-5 py-5 border-b border-r lowercase border-gray-200 bg-white text-sm"><?= $user['email']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $commentReported['content']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $commentReported['date']; ?>
                                    </td>
                                    <?php foreach ($userData as $user) : ?>
                                        <?php if ($commentReported['id_reporter'] == $user['id']) : ?>
                                            <td class="px-5 py-5 border-b border-r lowercase border-gray-200 bg-white text-sm"><?= $user['email']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <form action="" method="POST">
                                            <!-- Champ caché pour soumettre la requête de suppression -->
                                            <input type="hidden" name="deleteComments" value="1">
                                            <input type="hidden" name="id" value="<?= $commentReported['id']; ?>">
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')" aria-label="Êtes-vous sûr de vouloir supprimer cet utilisateur ?">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <?php // $this->modal("form", $form); 
                                        ?>
                                        <?php if ($commentReported['is_reported']) : ?>
                                            <a href="/unreport-comment?id=<?= $commentReported['id'] ?>" aria-label="Signaler un commentaire">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="px-5 py-5 border-gray-200 bg-white text-sm">
                                    Il n'y a pas de commentaire reporté.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto lg:w-full">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Tous les commentaires</h2>
            </div>
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden w-full">
                <table class="min-w-full leading-normal w-full">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Utilisateur
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Contenu
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($commentData)) : ?>
                            <?php foreach ($commentData as $comment) : ?>
                                <tr>
                                    <?php foreach ($userData as $user) : ?>
                                        <?php if ($comment['id_user'] == $user['id']) : ?>
                                            <td class="px-5 py-5 border-b border-r lowercase border-gray-200 bg-white text-sm"><?= $user['email']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $comment['content']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $comment['date']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <form action="" method="POST">
                                            <!-- Champ caché pour soumettre la requête de suppression -->
                                            <input type="hidden" name="deleteComments" value="1">
                                            <input type="hidden" name="id" value="<?= $comment['id']; ?>">
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')" aria-label="Êtes-vous sûr de vouloir supprimer cet utilisateur ?">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="px-5 py-5 border-gray-200 bg-white text-sm">
                                    Il n'y a pas de commentaire.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>