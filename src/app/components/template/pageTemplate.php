<?php
include_once (__DIR__ . '/head.php');
include_once (__DIR__ . '/pageHeader.php');
include_once (__DIR__ . '/sidebar.php');

function pageTemplate($data, $template_body_path) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <?php 
        $template_style_paths = ['template/pageheader.css', 'template/sidebar.css'];
        $template_script_paths = ['template/header.js', 'template/siderbar.js'];
        head($data, $template_style_paths, $template_script_paths);
    ?>

    <body>
        <div class="page-template-body">
            <?php 
                include($template_body_path);
                body($data);
            ?>        
        </div>
        <?php 
        pageHeader();
        sidebar();
        ?>
    </body>
    </html>

<?php
}