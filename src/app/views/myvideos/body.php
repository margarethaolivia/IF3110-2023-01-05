<?php

include_once (APP_PATH . '/components/template/pagination.php');
include_once APP_PATH . '/components/elements/videoCard.php';

function body($data) {
?>
    <main class="pb-2">
        <div class="flex items-center">
            <div class="w-big">
                <h2 class="text-bold">My Videos</h2>
            </div>
            <div class="w-small">
                <span class="black-button">Upload</span>
            </div>
        </div>
        
        <section id="video-list" class="mb-2">
            <?php  
                videoCard(noUser: true, settings: true);
                videoCard(noUser: true, settings: true);
                videoCard(noUser: true, settings: true);
                videoCard(noUser: true, settings: true);
                videoCard(noUser: true, settings: true);
            ?>      
        </section>
        <?php 
            pagination(10);
        ?>
    </main>
<?php
}