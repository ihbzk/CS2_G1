<div class="grid grid-cols-2 gap-4">
    <div class="p-4">
        <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Éléments</h2>
        <div class="element-list">
            <?php
            function getElementClasses($elementName)
            {
                $styleElements = [
                    'Button' => 'shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 mr-2 rounded-full cursor-grab',
                    'Title H1' => 'text-2xl font-bold hover:bg-gray-200 cursor-grab',
                    'Title H2' => 'text-xl font-bold hover:bg-gray-200 cursor-grab',
                    'Title H2' => 'text-lg font-medium hover:bg-gray-200 cursor-grab',
                    'Paragraph' => 'text-base hover:bg-gray-200 cursor-grab',
                    'Image' => 'cursor-grab" style="background-image: url(\'../../../public/assets/img/640x360.png\'); background-size: 100% 100%; width: 100%; height: 360px',
                ];

                return $styleElements[$elementName] ?? '';
            }
            ?>
            <?php foreach ($elements as $element) : ?>
                <div class="element mb-2 <?= getElementClasses($element['name']) ?>" data-element-id="<?= $element['id'] ?>" draggable="true"><?= $element['name'] ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="p-4">
        <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Prévisualisation de la page <?= $pageData['meta_title'] ?></h2>
        <p>Slug : /<?= $pageData['slug']; ?></p>
        <p>Meta title : <?= $pageData['meta_title']; ?></p>
        <p>Meta description : <?= $pageData['meta_description']; ?></p>
        <p>Meta keywords : <?= $pageData['meta_keywords']; ?></p>
        <hr>
        <p class="text-gray-500">Faites glisser les éléments ci-dessous</p>
        <form action="" method="POST" class="h-full">
            <div id="selected-elements" class="selected-elements mt-2 px-4 py-2 border border-gray-300 rounded-lg h-full"></div>
            <div class="form-group">
                <input class="shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded-full cursor-pointer" type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

<script>
    const elements = document.querySelectorAll('.element');
    const selectedElements = document.getElementById('selected-elements');

    elements.forEach(element => {
        element.addEventListener('dragstart', dragStart);
    });

    selectedElements.addEventListener('dragover', dragOver);
    selectedElements.addEventListener('drop', drop);

    function dragStart(event) {
        event.dataTransfer.setData('elementId', event.target.dataset.elementId);
        event.dataTransfer.setData('elementClasses', event.target.classList.value);
    }

    function dragOver(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        const elementId = event.dataTransfer.getData('elementId');
        const elementClasses = event.dataTransfer.getData('elementClasses');
        const element = document.createElement('div');
        element.classList.add('element');
        element.classList.add(...elementClasses.split(' '));
        element.dataset.elementId = elementId;
        element.textContent = event.target.textContent;
        const input = document.createElement('input');
        input.type = 'text';
        input.name = `contents[${elementId}]`;
        input.placeholder = 'Contenu de l\'élément';
        input.required = true;
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'elements[]';
        hiddenInput.value = elementId;
        element.appendChild(hiddenInput);
        element.appendChild(input);
        selectedElements.appendChild(element);

        // Activation du déplacement des éléments dans la zone de prévisualisation
        interact(element)
            .draggable({
                inertia: true,
                modifiers: [
                    interact.modifiers.restrictRect({
                        restriction: '#selected-elements', // La zone de prévisualisation comme restriction
                        endOnly: true,
                    }),
                ],
                autoScroll: true,
                onstart: dragStartListener,
                onmove: dragMoveListener,
            })
            .styleCursor(false);
    }

    // Fonction de rappel pour le début du déplacement des éléments
    function dragStartListener(event) {
        const element = event.target;
        element.style.zIndex = 999;
    }

    // Fonction de rappel pour le déplacement des éléments
    function dragMoveListener(event) {
        const target = event.target;
        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

        target.style.transform = `translate(${x}px, ${y}px)`;
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
    }
</script>

<style>
    .selected-elements input[type="text"] {
        color: black;
    }
</style>