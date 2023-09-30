<!DOCTYPE html>
<html lang="en">
<?php 
    $template_style_paths = ['template/pageheader.css', 'template/sidebar.css'];
    $template_script_paths = ['template/header.js', 'template/siderbar.js'];
    include(__DIR__ . '/head.php');
?>

<body>
    <?php include(__DIR__ . '/header.php') ?>
    <?php include(__DIR__ . '/sidebar.php') ?>
    <div class="page-template-body">
        <?php 
            include($template_body_path);
        ?>        
    </div>
</body>

</html>