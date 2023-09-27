<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">

    <?php foreach ($this->data['style_paths'] as $path) : ?>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/<?= $path ?>">
    <?php endforeach; ?>

    <?php if (isset($template_style_paths) && is_array($template_style_paths))
        foreach ($template_style_paths as $path) : ?>
            <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/<?= $path ?>">
    <?php endforeach; ?>
    
    <!-- Page-specific CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/album/add-album.css"> -->
    <!-- JavaScript Constant and Variables -->
    <!-- <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script> -->
    <!-- JavaScript DOM and AJAX -->
    <?php foreach ($this->data['script_paths'] as $path) : ?>
        <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/<?= $path ?>" defer></script>
    <?php endforeach; ?>

    <?php if (isset($template_script_paths) && is_array($template_script_paths))
        foreach ($template_script_paths as $path) : ?>
            <script type="text/javascript" src="<?= BASE_URL ?>/javascripts/<?= $path ?>" defer></script>
    <?php endforeach; ?>

    <title><?= $this->data['title'] ?></title>
</head>