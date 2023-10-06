<?php

include_once APP_PATH . '/components/elements/emptyList.php';

function body($data) {
?>
    <div class="w-full flex flex-row">
        <span class="page-title">Takedowns</span>

        <div id="empty-message" class="hidden">
            <?php
                emptyList(BASE_URL . "/images/webp/EmptyList.webp", "There is currently no video");
            ?>
        </div>
        <div class="pb-2" id="video-list">
        </div>

        <div id="pagination-container"></div>
    </div>
<?php
}