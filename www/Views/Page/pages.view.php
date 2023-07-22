<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="text-center pb-5">
            <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Toutes les pages</h2>
        </div>
        <hr>
        <div class="flex flex-wrap justify-center items-center min-h-screen pt-5">
            <?php if (!empty($pageData)) : ?>
                <?php foreach ($pageData as $page) : ?>
                    <div class="w-full md:w-1/2 p-2">
                            <a href="<?= toRootPath('pages/page?id=' . $page['id'] . ''); ?>" aria-label="Voir la page">
                            <div class="bg-white shadow-lg hover:shadow-xl rounded-lg">
                                <div class="bg-gray-400 h-64 rounded-t-lg p-4 bg-no-repeat bg-center bg-cover" style="background-image: url(<?= $page['cover_image']; ?>)">
                                </div>
                                <div class="flex justify-between items-start px-2 pt-5 pb-5">
                                    <div class="p-2 flex-grow text-center">
                                        <h2 class="font-medium text-xl font-poppins pb-5"><?= $page['cover_title']; ?></h2>
                                        <div class="block w-full bg-red-700 hover:bg-red-800 text-white border-2 border-red-700 hover:border-red-800 px-3 py-2 rounded uppercase font-poppins font-medium text-center">
                                            Voir la page 
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
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