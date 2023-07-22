<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-2 text-gray-400 text-sm">
            <a href="<?= toRootPath('admin/pages') ?>" class="hover:underline hover:text-gray-600" aria-label="Retour">
                <i class="fa-solid fa-arrow-left"></i>
                Retour
            </a>
        </div>
        <h1 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2">
            Informations de la page 
            <small><i class="text-gray-300 font-normal">(/<?= $pageData['slug'] ?>)</i></small>
        </h1>
        <form method="POST" action="<?= toRootPath('admin/pages/restore-version'); ?>">
            <label for="version" class="mt-5 ml-4 block uppercase tracking-wide text-gray-700 text-xs font-bold" for="grid-first-name">
                Historique de version
            </label>
            <div class="w-full mb-6 md:mb-0 flex">
                <input type="hidden" name="pageId" value="<?= $pageData['id'] ?>">
                <select name="versionId" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-full focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 mb-3">
                    <option value="" disabled selected hidden>--- Choisissez une version ---</option>
                    <?php $versionNumber = 1; ?>
                    <?php foreach ($pageHistoryData as $version) : ?>
                        <option value="<?= $version['id'] ?>" class="bg-white-700 hover:bg-white-500 focus:shadow-outline focus:outline-none text-red-500 font-bold py-2 px-6 rounded">Version <?= $versionNumber ?></option>
                        <?php $versionNumber++; ?>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded-full cursor-pointer ml-3">
                    Restaurer la version
                </button>
            </div>
        </form>
    </div>
    <div>
        <ul>
            <?php if (isset($_SESSION['update_errors'])) : ?>
                <?php foreach ($_SESSION['update_errors'] as $error) : ?>
                    <li>
                        <?php if (is_string($error)) : ?>
                            <?php echo $error; ?>
                        <?php else : ?>
                            <?php var_dump($error); ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="px-4">
                <?php $this->modal("form", $form); ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="mx-4 sm:mx-6 lg:mx-8 mt-6">
        <div class="py-8 grid place-items-center">
            <div class="text-center">
                <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Prévisualisation de la page</h2>
            </div>
        </div>
        <div class="mx-4 sm:px-6 lg:mx-8 border-2 border-solid border-black h-screen flex flex-col justify-center items-center bg-gray-200">
            <?php
            function getElements($element)
            {
                $elements = [
                    'Button' => '
                    <div class="w-full px-3 pt-6 mb-6 md:mb-0 flex w-full justify-center items-center">
                        <a href="' . $element['content'] . '" target="_blank" class="shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 mr-2 rounded-full cursor-grab" aria-label="Bouton">' . $element['content'] . '</a>
                    </div>',
                    'Title H1' => '
                    <div class="text-center">
                        <h1 class="text-2xl font-bold">' . $element['content'] . '</h1>
                    </div>',
                    'Title H2' => '<h2 class="text-xl font-semibold">' . $element['content'] . '</h2>',
                    'Title H3' => '<h3 class="text-lg font-medium">' . $element['content'] . '</h3>',
                    'Paragraph' => '<p class="text-justify">' . $element['content'] . '</p>',
                    'Image' => '
                    <div class="flex justify-center items-center px-2 pb-2">
                        <div class="w-full flex justify-center items-center px-2 p-2">
                            <img src="' . $element['content'] . '" alt="' . $element['content'] . '">
                        </div>
                    </div>',
                ];

                return $elements[$element['name']] ?? '';
            }
            ?>
            <?php if (!empty($matchedElements)) : ?>
                <?php foreach ($matchedElements as $element) : ?>
                    <div class="my-4">
                        <?= getElements($element) ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="my-4">
                    Aucun élément n'a été ajouté.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>