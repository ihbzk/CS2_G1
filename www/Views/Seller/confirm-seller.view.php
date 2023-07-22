<div class="max-w-screen-md mx-auto p-5 border-4 border-red-700 m-5">
    <div class="text-center">
        <div class="flex pt-5 w-full justify-center items-center">
            <img src="<?= toRootPath('public/assets/img/icons/logo.svg'); ?>" class="object-center" alt="Logo Hip-Shop">
        </div>
        <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Vérification du compte</h2>
        <hr class="mb-3">
    </div>

    <?php print_r($errors ?? null); ?>

    <?php $this->modal("form", $form); ?>
    <div>
        <?php
            if(!empty($_SESSION['verifCodeError'])){
                echo $_SESSION['verifCodeError'];
            }
        ?>
    </div>
</div>