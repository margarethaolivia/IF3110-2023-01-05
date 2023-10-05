<?php
function head($data, $template_style_paths = [], $template_script_paths = []) {
?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="32x22" href="<?= BASE_URL ?>/images/icon/favicon-32x22.png">
        <link rel="icon" type="image/png" sizes="16x11" href="<?= BASE_URL ?>/images/icon/favicon-16x11.png">
        <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

        <!-- Global CSS -->
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/global.css">

        <?php if (isset($data['style_paths'])) foreach ($data['style_paths'] as $path) : ?>
            <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/<?= $path ?>">
        <?php endforeach; ?>

        <?php foreach ($template_style_paths as $path) : ?>
            <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/<?= $path ?>">
        <?php endforeach; ?>
        
    
        <!-- JavaScript Constant and Variables -->
        <!-- <script type="text/javascript" defer>
            const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        </script> -->
        <!-- JavaScript DOM and AJAX -->

        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/template/global.js" defer></script>

        <?php if (isset($data['script_paths'])) foreach ($data['script_paths'] as $path) : ?>
            <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/<?= $path ?>" defer></script>
        <?php endforeach; ?>

        <?php foreach ($template_script_paths as $path) : ?>
            <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/<?= $path ?>" defer></script>
        <?php endforeach; ?>

        <title><?= $data['title'] ?></title>
    </head>
<?php
}