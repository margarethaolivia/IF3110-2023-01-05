<?php

include_once APP_PATH . '/components/elements/toast.php';
include_once APP_PATH . '/components/elements/videoCard.php';

function body($data) {

?>
    <div class="pb-2 main-page">

        <span class="empty-message" id="empty-message">Empty List</span>
        
        <section id="video-list" class="mb-2">    
        </section>
        <div id="pagination-container"></div>
    </div>
<?php
}