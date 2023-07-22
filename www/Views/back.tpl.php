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
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titleContent; ?></title>
    <meta name="description" content="Page d'accueil du site HipShop">
    <link rel="icon" href="../public/assets/img/icons/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.umber.js"></script>
</head>

<body class="font-sans">
    <?php include "Core/Path.php"; ?>
    <?php include "config.php"; ?>
    <?php include "Main/navbar.admin.view.php"; ?>
    <?php include $this->view; ?>
    <?php include "Main/footer.view.php"; ?>
</body>

</html>