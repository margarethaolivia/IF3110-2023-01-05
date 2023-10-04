<?php

include_once (APP_PATH . '/components/template/pagination.php');
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
        <section id="video-list" class="mb-2">
            <?php  
                foreach ($videos as $video) {
                    videoCard(
                        $video, 
                        noUser: true, 
                        settings: true, 
                        editLink: "/myvideos/edit/" . $video->video_id,
                        deleteAction: "deleteMyVideo(event, " . $video->video_id . ", 'popup-delete-video')",
                        cardId: 'card-' . $video->video_id, 
                    );
                }
            ?>      
        </section>
        <?php 
            popup("Delete Video", "Are you sure you want delete this video?", "delete-video", "Delete", actionButtonClass: 'red-action-button');
            pagination(10);
        ?>
    </main>
<?php
}