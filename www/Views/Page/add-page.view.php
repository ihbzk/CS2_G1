<div class="max-w-screen-md mx-auto p-5 border-4 border-red-700 m-5">
    <div class="text-center">
        <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Création de la page <small>(étape 1/2)</small></h2>
    </div>
    <!-- Étape 1 : Ajouter les informations de la page -->

    <?php print_r($errors ?? null); ?>

    <?php $this->modal("form", $form); ?>
</div>