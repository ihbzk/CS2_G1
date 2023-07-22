<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$routes = yaml_parse_file(__DIR__ . '/../../routes.yml');
$metaData = null;

foreach ($routes as $route => $data) {
    if ($route === $currentUrl) {
        $metaData = $data;
        break;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($metaData['meta_title']) ? $metaData['meta_title'] : '' ?></title>
    <meta name="description" content="<?= isset($metaData['meta_description']) ? $metaData['meta_description'] : '' ?>">
    <meta name="keywords" content="<?= isset($metaData['meta_keywords']) ? $metaData['meta_keywords'] : '' ?>">
    <link rel="icon" href="<?= toRootPath('public/assets/img/icons/favicon.svg'); ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= toRootPath('public/assets/css/global.css'); ?>" type="text/css" />
    <script src="<?= toRootPath('public/assets/js/show-password.js'); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
    $currentUrl = $_SERVER['REQUEST_URI'];
    $routes = yaml_parse_file(__DIR__ . '/../../routes.yml');
    $metaData = null;

    foreach ($routes as $route => $data) {
        if ($route === $currentUrl) {
            $metaData = $data;
            break;
        }
    }

    return $metaData;
    ?>
</head>