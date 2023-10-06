<?php

include_once (APP_PATH . '/components/takedowns/takedownRow.php');
include_once APP_PATH . '/components/elements/emptyList.php';

function body($data) {
?>
    <div class="w-full flex flex-row">
        <span class="page-title">
            <?php
                emptyList(BASE_URL . "/images/webp/EmptyList.webp", "You haven't taken down any video");
            ?>
        </span>
        <div class="pb-2" id="video-list">
        </div>

        <div id="pagination-container"></div>
    </div>
<?php
}