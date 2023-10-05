<?php

include_once APP_PATH . '/components/elements/videoCard.php';
include_once APP_PATH . '/components/elements/popup.php';

function body($data) {
    $videos = $data['videos'] ?? [];
?>
    <main class="pb-2">
        <div class="flex items-center">
            <div class="w-big">
                <h2 class="text-bold">My Videos</h2>
            </div>
            <div class="w-small">
                <a href='videos/upload' class="upload-button">Upload</a>
            </div>
        </div>
        <?php if (count($videos) === 0) : ?>
            <span class="empty-message" id="empty-message">Empty List</span>
        <?php endif; ?>
        <section id="video-list" class="mb-2">    
        </section>
        <div id="pagination-container"></div>
        <?php 
            popup("Delete Video", "Are you sure you want to delete this video?", "delete-video", "Delete", actionButtonClass: 'red-action-button');
        ?>
    </main>
<?php
}