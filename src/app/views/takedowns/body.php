<?php

include_once (APP_PATH . '/components/takedowns/takedownRow.php');

function body($data) {
?>
    <div class="w-full flex flex-row">
        <span class="page-title">Takedowns</span>

        <span class="empty-message" id="empty-message">Empty List</span>
        <div class="table-content flex flex-row" id="video-list">
        </div>

        <div id="pagination-container"></div>
    </div>
<?php
}