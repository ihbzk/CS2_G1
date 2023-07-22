<?php
$envFilePath =  __DIR__ . '/../../.env';
// Lire le contenu du fichier .env
$envContents = file_get_contents($envFilePath);
// Parser les variables d'environnement
$envLines = explode("\n", $envContents);
$envVariables = [];
foreach ($envLines as $line) {
    // Ignore les lignes vides
    if (!empty($line)) {
        list($key, $value) = explode('=', $line, 2);
        $envVariables[$key] = $value;
    }
}
//title dynamique
// Récupérer la valeur d'APP_NAME
$appName = isset($envVariables['APP_NAME']) ? trim($envVariables['APP_NAME']) : '';

// Si la valeur n'est pas vide, définir la balise <title> avec la valeur de APP_NAME
$titleContent = !empty($appName) ? htmlspecialchars($appName) : 'HipShop';

// Récupérer la valeur d'APP_NAME
$appName = isset($envVariables['APP_NAME']) ? trim($envVariables['APP_NAME']) : '';
?>

<div class="max-w-screen-md mx-auto p-5 border-4 border-red-700 m-5">
    <div class="text-center">
        <div class="flex pt-5 w-full justify-center items-center">
            <!-- <img src="<?= toRootPath('public/assets/img/icons/logo.svg'); ?>" class="object-center" alt="Logo Hip-Shop"> -->
            <h2 class="logo-title text-red-700"><?= $titleContent; ?></h2>
        </div>
        <h2 class="text-xl sm:text-2xl leading-normal font-bold tracking-tight text-black pt-2 pb-5">Connectez-vous</h2>
        <hr class="mb-3">
    </div>

    <?php print_r($errors ?? null); ?>

    <?php $this->modal("form", $form);
    ?>
    <div>
        <a href="/passwordForgot">Mot de passe oublié ?</a>
        <br>
        <?php
        if ($_SERVER['QUERY_STRING'] == "verifMailSended") {
            echo "Un mail de vérification vous a été envoyé";
        } elseif ($_SERVER['QUERY_STRING'] == "verifMailSendedLost") {
            echo "Le mail n'a pas été envoyé, veuillez contacter un administrateur ou vous réinscrire avec une autre adresse mail.";
        } elseif ($_SERVER['QUERY_STRING'] == "accountVerified") {
            echo "Votre compte a été vérifié.";
        } elseif ($_SERVER['QUERY_STRING'] == "passwordUpdated") {
            echo "Votre mot de passe a bien été modifié.";
        }
        ?>
    </div>
</div>