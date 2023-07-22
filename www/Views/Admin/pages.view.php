<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="text-center pb-5">
            <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Toutes les pages</h2>
            <a href="<?= toRootPath('admin/pages/add/step-1') ?>" class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center" aria-label="Ajouter une nouvelle page">Ajouter une nouvelle page</a>
        </div>
        <hr>
        <div class="flex flex-wrap justify-center items-center min-h-screen pt-5">
            <?php if (!empty($pageData)) : ?>
                <?php foreach ($pageData as $page) : ?>
                    <div class="w-full md:w-1/2 p-2">
                        <div class="bg-white shadow-lg hover:shadow-xl rounded-lg">
                            <div class="bg-gray-400 h-64 rounded-t-lg p-4 bg-no-repeat bg-center bg-cover" style="background-image: url(<?= $page['cover_image']; ?>)">
                            </div>
                            <div class="flex justify-between items-start px-2 pt-2">
                                <div class="p-2 flex-grow">
                                    <h2 class="font-medium text-xl font-poppins"><?= $page['cover_title']; ?></h2>
                                </div>
                                <div class="p-2 text-right">
                                    <div class="text-red-700 font-semibold text-lg font-poppins">/<?= $page['slug']; ?></div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center px-2 pb-2">
                                <div class="w-1/2 p-2">
                                    <a href="<?= toRootPath('admin/pages/edit?id=' . $page['id']); ?>" class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center" aria-label="Modifier la page">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Modifier la page
                                    </a>
                                </div>
                                <div class="w-1/2 p-2">
                                    <form action="" method="POST">
                                        <input type="hidden" name="deletePages" value="1">
                                        <input type="hidden" name="id" value="<?= $page['id']; ?>">
                                        <button type="submit" class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette page et toutes ses données associées ?')" aria-label="Êtes-vous sûr de vouloir supprimer cette page et toutes ses données associées ?">
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
                    <td colspan="10" class="px-5 py-5 border-gray-200 bg-white text-sm">Il n'y a pas de page.</td>
                </tr>
            <?php endif; ?>
        </div>
    </div>
</div>