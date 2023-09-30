<!DOCTYPE html>
<html lang="en">
<?php 
    $template_style_paths = ['template/pageheader.css', 'template/siderbar.css'];
    $template_script_paths = ['template/header.js', 'template/siderbar.js'];
    include(__DIR__ . '/head.php');
?>

<body>
    <?php include(__DIR__ . '/header.php') ?>
    <?php include(__DIR__ . '/sidebar.php') ?>
    <?php 
        include($template_body_path);
    ?>
</body>

</html>