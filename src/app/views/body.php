<?php

include_once APP_PATH . '/components/elements/toast.php';
include_once APP_PATH . '/components/elements/videoCard.php';
include_once APP_PATH . '/components/elements/emptyList.php';

function body($data) {

?>
    <div class="pb-2 main-page">

        <span id="empty-message">
            <?php
                emptyList(BASE_URL . "/images/webp/EmptyList.webp", "There is currently no video");
            ?>
        </span>
        
        <section id="video-list" class="mb-2">    
        </section>
        <div id="pagination-container"></div>
    </div>
<?php
}