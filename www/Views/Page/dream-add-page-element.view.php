<div class="grid grid-cols-2 gap-4">
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Éléments</h2>
        <div id="elementList" class="space-y-2">
            <!-- <div class="element bg-gray-200 p-2 rounded" data-element-id="1" draggable="true">Élément 1</div>
            <div class="element bg-gray-200 p-2 rounded" data-element-id="2" draggable="true">Élément 2</div>
            <div class="element bg-gray-200 p-2 rounded" data-element-id="3" draggable="true">Élément 3</div> -->
            <?php
            function getElementClasses($elementName)
            {
                $styleElements = [
                    'Button' => 'shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 mr-2 rounded-full cursor-grab',
                    'Title H1' => 'text-2xl font-bold hover:bg-gray-200 cursor-grab',
                    'Title H2' => 'text-xl font-bold hover:bg-gray-200 cursor-grab',
                    'Title H2' => 'text-lg font-medium hover:bg-gray-200 cursor-grab',
                    'Paragraph' => 'text-base hover:bg-gray-200 cursor-grab',
                    'Image' => 'cursor-grab" style="background-image: url(\'../../../public/assets/img/icons/thumbnail-640x360.png\'); background-size: 100% 100%; width: 100%; height: 360px',
                ];

                return $styleElements[$elementName] ?? '';
            }
            ?>
            <?php foreach ($elements as $position => $element) : ?>
                <div class="element mb-2 <?= getElementClasses($element['name']) ?>" data-element-id="<?= $element['id'] ?>" draggable="true"><?= $element['name'] ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Prévisualisation</h2>
        <div id="preview" class="bg-gray-100 p-4 rounded">
            <p id="placeholder" class="text-center text-gray-500">Faites glisser les éléments ici</p>
        </div>
    </div>

    <!-- Modal pour ajouter ou modifier les valeurs d'un élément -->
    <div id="elementModal" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="modal-content bg-white w-1/2 p-4 rounded">
            <h2 id="elementModalTitle" class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5"></h2>
            <form id="elementForm" action="" method="POST">
                <input type="hidden" id="currentElementId" name="currentElementId">
                <div class="form-group">
                    <label for="elementContent">Contenu :</label>
                    <input type="text" id="elementContent" name="elementContent" placeholder="Contenu de l'élément" value="">
                </div>
                <div class="form-group">
                    <label for="elementAlt">Texte alternatif :</label>
                    <input type="text" id="elementAlt" name="elementAlt" placeholder="Texte alternatif (si c'est une image)" value="">
                </div>
                <div class="form-group">
                    <label for="elementLink">Lien :</label>
                    <input type="text" id="elementLink" name="elementLink" placeholder="Lien" value="">
                </div>
                <div class="form-group">
                    <label for="elementPosition">Position :</label>
                    <input type="number" id="elementPosition" name="elementPosition" placeholder="Position" value="">
                </div>
                <div class="form-group">
                    <button type="submit" name="elementSubmit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enregistrer</button>
                    <button id="cancelElementBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Fermer</button>
                </div>
            </form>
        </div>
    </div>
    <form action="" method="POST" class="h-full">
        <div class="form-group">
            <input class="shadow bg-red-700 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded-full cursor-pointer" type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>

<script>
    const elements = document.querySelectorAll('.element');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    const elementModal = document.getElementById('elementModal');
    const elementForm = document.getElementById('elementForm');
    const elementIdInput = document.getElementById('currentElementId');
    const elementContentInput = document.getElementById('elementContent');
    const elementAltInput = document.getElementById('elementAlt');
    const elementLinkInput = document.getElementById('elementLink');
    const elementPositionInput = document.getElementById('elementPosition');
    const cancelElementBtn = document.getElementById('cancelElementBtn');
    let currentElement = null;

    elements.forEach(element => {
        element.addEventListener('dragstart', dragStart);
    });

    preview.addEventListener('dragover', dragOver);
    preview.addEventListener('drop', drop);

    elementForm.addEventListener('submit', saveElement);
    cancelElementBtn.addEventListener('click', cancelElement);

    function dragStart(event) {
        event.dataTransfer.setData('elementId', event.target.dataset.elementId);
        event.dataTransfer.setData('elementName', event.target.textContent);
    }

    function dragOver(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        const elementId = event.dataTransfer.getData('elementId');
        const elementName = event.dataTransfer.getData('elementName');
        const element = document.createElement('div');
        element.classList.add('element');
        element.dataset.elementId = elementId;
        element.textContent = elementName;

        preview.appendChild(element);
        element.addEventListener('click', showElementModal);
    }

    function showElementModal(event) {
        const elementId = event.target.dataset.elementId;
        const elementName = event.target.textContent;

        currentElement = {
            elementId: elementId,
            elementName: elementName,
            content: '', // Ajoutez la valeur par défaut ici
            alt: '', // Ajoutez la valeur par défaut ici
            link: '', // Ajoutez la valeur par défaut ici
            position: '', // Ajoutez la valeur par défaut ici
        };

        // Vérifier si l'élément a des valeurs existantes
        const previewElement = document.querySelector(`.element[data-element-id="${elementId}"]`);
        if (previewElement) {
            const contentInput = previewElement.querySelector('input[name="elementContent"]');
            const altInput = previewElement.querySelector('input[name="elementAlt"]');
            const linkInput = previewElement.querySelector('input[name="elementLink"]');
            const positionInput = previewElement.querySelector('input[name="elementPosition"]');

            if (contentInput) {
                currentElement.content = contentInput.value;
            }
            if (altInput) {
                currentElement.alt = altInput.value;
            }
            if (linkInput) {
                currentElement.link = linkInput.value;
            }
            if (positionInput) {
                currentElement.position = positionInput.value;
            }
        }

        // Remplir les champs avec les valeurs actuelles de l'élément
        elementIdInput.value = currentElement.elementId;
        elementContentInput.value = currentElement.content;
        elementAltInput.value = currentElement.alt;
        elementLinkInput.value = currentElement.link;
        elementPositionInput.value = currentElement.position;

        elementModalTitle.textContent = `Modifier l'élément "${currentElement.elementName}"`;
        elementModal.classList.remove('hidden');
    }

    function saveElement(event) {
        event.preventDefault();

        // Stockez les valeurs des inputs dans les variables correspondantes
        const elementId = elementIdInput.value;
        const content = elementContentInput.value.trim();
        const alt = elementAltInput.value.trim();
        const link = elementLinkInput.value.trim();
        const position = elementPositionInput.value.trim();

        // Afficher les valeurs de l'élément dans la console
        console.log('Element ID:', elementId);
        console.log('Contenu:', content);
        console.log('Texte alternatif:', alt);
        console.log('Lien:', link);
        console.log('Position:', position);

        // Afficher les valeurs de l'élément dans la modal de modification
        elementIdInput.value = currentElement.elementId;
        elementContentInput.value = content;
        elementAltInput.value = alt;
        elementLinkInput.value = link;
        elementPositionInput.value = position;

        elementModalTitle.textContent = `Ajouter/Modifier l'élément "${currentElement.elementName}"`;

        // Réinitialiser les champs du formulaire
        elementForm.reset();

        // Fermer la modal d'ajout/modification
        elementModal.classList.add('hidden');
    }

    function cancelElement(event) {
        event.preventDefault();

        // Réinitialiser les variables de stockage des valeurs des inputs
        currentElement = null;

        elementForm.reset();
        elementModal.classList.add('hidden');
    }

    const submitButton = document.getElementById('submitButton');
    submitButton.addEventListener('click', handleSubmit);

    function handleSubmit() {
        // Logique de soumission du formulaire
        console.log("Formulaire soumis !");
    }
</script>