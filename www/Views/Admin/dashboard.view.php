<?php
// include("PHPfusioncharts/fusioncharts/fusioncharts.php");
?>
<div class="container mx-auto px-4 sm:px-8">
    <div class="text-center">
        <h1 class="text-3xl sm:text-4xl leading-normal font-bold tracking-tight text-red-700 pt-12 pb-5">Tableau de bord</h1>
    </div>
    <div class="py-8 flex flex-wrap -mx-3 mb-6 justify-center">
        <div class="-mx-4 sm:-mx-8 mx-4 sm:mx-8 py-4 overflow-x-auto lg:w-2/5 md:w-full">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">
                    <a href="<?= toRootPath('admin/users') ?>" aria-label="Tous les utilisateurs">Tous les utilisateurs</a>
                </h2>
            </div>
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden w-full">
                <table class="min-w-full leading-normal w-full">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Prénom
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nom
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($userData)) : ?>
                            <?php foreach ($userData as $user) : ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-r border-l lowercase border-gray-200 bg-white text-sm lowercase">
                                        <?= $user['email']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-l border-gray-200 bg-white text-sm capitalize">
                                        <?= $user['firstname']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-l border-gray-200 bg-white text-sm uppercase">
                                        <?= $user['lastname']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="px-5 py-5 border-gray-200 bg-white text-sm">
                                    Il n'y a pas d'utilisateur.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 mx-4 sm:mx-8 py-4 overflow-x-auto lg:w-2/5 md:w-full">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Tous les rôles d'utilisateurs</h2>
            </div>
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden w-full">
                <table class="min-w-full leading-normal w-full">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nom
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($roleData)) : ?>
                            <?php foreach ($roleData as $role) : ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-r border-l lowercase border-gray-200 bg-white text-sm capitalize">
                                        <?= $role['name']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="1" class="px-5 py-5 border-gray-200 bg-white text-sm">
                                    Il n'y a pas de rôle d'utilisateur.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <center>
            <div id="chart-diag-container">Chart will render here!</div>
        </center>
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
                                        <?= date("d/m/Y h:i:s", strtotime($comment['date'])) ?>
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
        <center>
            <div id="chart-container-funnel">Chart will render here!</div>
        </center>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto lg:w-full">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Tous les produits</h2>
            </div>
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden w-full">
                <table class="min-w-full leading-normal w-full">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Vendeur
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nom
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Prix
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Stock
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productData)) : ?>
                            <?php foreach ($productData as $product) : ?>
                                <tr>
                                    <?php foreach ($userData as $user) : ?>
                                        <?php if ($product['id_seller'] == $user['id']) : ?>
                                            <td class="px-5 py-5 border-b border-r lowercase border-gray-200 bg-white text-sm"><?= $user['email']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $product['name']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $product['price']; ?> €
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $product['stock']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="px-5 py-5 border-gray-200 bg-white text-sm">
                                    Il n'y a pas de page.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <center>
            <div id="chart-container">Chart will render here!</div>
        </center>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto lg:w-full">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Toutes les pages</h2>
            </div>
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden w-full">
                <table class="min-w-full leading-normal w-full">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Créateur
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Titre
                            </th>
                            <th class="px-5 py-3 border-b-2 border-r-2 border-gray-200 bg-red-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                URL de la page
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pageData)) : ?>
                            <?php foreach ($pageData as $page) : ?>
                                <tr>
                                    <?php foreach ($userData as $user) : ?>
                                        <?php if ($page['id_user'] == $user['id']) : ?>
                                            <td class="px-5 py-5 border-b border-r lowercase border-gray-200 bg-white text-sm"><?= $user['email']; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $page['cover_title']; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-r border-gray-200 bg-white text-sm">
                                        <?= $page['slug']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="px-5 py-5 border-gray-200 bg-white text-sm">
                                    Il n'y a pas de page.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>