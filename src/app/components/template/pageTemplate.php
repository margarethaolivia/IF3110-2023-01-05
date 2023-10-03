<?php
include_once (__DIR__ . '/head.php');
include_once (__DIR__ . '/pageHeader.php');
include_once (__DIR__ . '/sidebar.php');
include_once (APP_PATH . '/components/elements/toast.php');

function pageTemplate($data, $template_body_path) {
        $includeComponents = !isset($data['isPlainPage']) || !$data['isPlainPage'];
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <?php 
        $template_style_paths = [];
        $template_script_paths = [];

        if ($includeComponents) {
            $template_style_paths = ['template/pageheader.css', 'template/sidebar.css'];
            $template_script_paths = ['template/header.js', 'template/sidebar.js'];
        }

        head($data, $template_style_paths, $template_script_paths);
    ?>

    <body>
        <div class="page-template-body <?= $includeComponents ? "page-top-margin" : ""?>">
            <?php 
                include($template_body_path);
                body($data);
            ?>        
        </div>
        <?php
            if ($includeComponents)
            {
                pageHeader();
                sidebar();
            }
            toast();
        ?>
    </body>
    </html>

<?php
}