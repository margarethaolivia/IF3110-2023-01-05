<?php

function takedownInfo($comment) {
?>
    <span class="my-1 flex align-center title-desc takedown-title">This video is taken down by WeTube</span>
    <div class="desc-container takedown-desc-container">
        <p><?=$comment?></p>
    </div>
<?php
}