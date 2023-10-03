<?php

include_once (APP_PATH . '/components/template/pagination.php');
include_once APP_PATH . '/components/elements/toast.php';
include_once APP_PATH . '/components/elements/videoCard.php';

function body($data) {
?>
    <main class="pb-2">
        <div class="flex items-center">
            <div class="w-big">
                <div class="scrollmenu">
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                </div>
            </div>
            <div class="w-small">
                <span class="sort-button">Sort</span>
            </div>
        </div>
        
        <section id="video-list" class="mb-2">
            <?php  
                videoCard();
                videoCard();
                videoCard();
                videoCard();
                videoCard();
                videoCard();
                videoCard();
                videoCard();
            ?>            
        </section>
        <?php 
            pagination(10);
        ?>
    </main>
<?php
}