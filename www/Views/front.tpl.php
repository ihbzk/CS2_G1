<?php
$envFilePath =  __DIR__ . '/../.env';
'../.env';
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
<?php include "Core/Path.php"; ?>
<?php include "config.php"; ?>
<!DOCTYPE html>
<html lang="fr">

<?php include "Views/Main/head.view.php"; ?>

<body class="font-sans">
    <?php include "Main/navbar.view.php"; ?>
    <?php include $this->view; ?>
    <?php include "Main/footer.view.php"; ?>
</body>

</html>

</body>

</html>