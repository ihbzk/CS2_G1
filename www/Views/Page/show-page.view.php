<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="text-center">
            <?php if ($pageData['id_user'] == $userData['id']) : ?>
                <small><i class="text-gray-300">Par @<?= $userData['pseudo'] ?></i></small>
            <?php endif; ?>
        </div>
        <?php
        function getElements($element)
        {
            $elements = [
                'Button' => '
                    <div class="w-full px-3 pt-6 mb-6 md:mb-0 flex w-full justify-center items-center">
                        <a href="' . ($element['link'] ?? '') . '" target="_blank" class="shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 mr-2 rounded-full cursor-grab" aria-label="Bouton">' . ($element['content'] ?? '') . '</a>
                    </div>',
                'Title H1' => '
                    <div class="text-center">
                        <h1 class="text-2xl font-bold">' . ($element['content'] ?? '') . '</h1>
                    </div>',
                'Title H2' => '<h2 class="text-xl font-semibold">' . ($element['content'] ?? '') . '</h2>',
                'Title H3' => '<h3 class="text-lg font-medium">' . ($element['content'] ?? '') . '</h3>',
                'Paragraph' => '<p class="text-justify">' . ($element['content'] ?? '') . '</p>',
                'Image' => '
                    <div class="flex justify-center items-center px-2 pb-2">
                        <div class="w-full flex justify-center items-center px-2 p-2">
                            <img src="' . ($element['link'] ?? '') . '" alt="' . ($element['alt'] ?? '') . '">
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
                La page ne contient aucun élément.
            </div>
        <?php endif; ?>
    </div>
</div>