<?php
include_once (__DIR__ . '/head.php');
include_once (__DIR__ . '/pageHeader.php');
include_once (__DIR__ . '/sidebar.php');

function pageTemplate($data, $template_body_path) {
        $includeComponents = !isset($data->isPlainPage) || !$data->isPlainPage;
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <?php 
        $template_style_paths = [];
        $template_script_paths = [];

        if ($includeComponents) {
            $template_style_paths = ['template/pageheader.css', 'template/sidebar.css'];
            $template_script_paths = ['template/header.js', 'template/siderbar.js'];
        }

        head($data, $template_style_paths, $template_script_paths);
    ?>
    
    <!-- navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="" alt="Wetube Logo">
        </div>
        <div class="search-div">
            <div class="search-bar">
                <input type="text" placeholder="Search">    
            </div>
            <button class="search-button">Search</button>
        </div>
        <div class="nav-links">
            <a href="#">Login</a>
            <a href="#">Signup</a>
        </div>
    </nav>

    <body>
        <div class="page-template-body mt-5">
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
        ?>
    </body>
    </html>

<?php
}