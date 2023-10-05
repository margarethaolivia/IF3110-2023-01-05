<?php

function takedownRow($video) {
?>
    <div class="flex takedown-row bd w-full">
        <div class="flex main-columns">
            <div class="flex flex-col video-column">
                <div class="video-thumbnail">
                    <img onclick="window.location.href = '/videos/<?=$video->video_id?>'" src="<?=$video->thumbnail?>" alt="video thumbnail">
                </div>
                <div class="video-info flex flex-row h-full justify-between">
                    <div class="user-info flex flex-row">
                        <span class="title"><?= $video->title?></span>
                        <span class="fullname"><?= $video->full_name?></span>
                    </div>
                    <div class="desc-container">
                        <p class="desc no-scrollbar"><?= $video->video_desc && strlen($video->video_desc) > 0 ? $video->video_desc : 'No description'?></p>
                    </div>
                </div>
            </div>

            <div class="comment-column">
                <span class="comment-title">Takedown Comment</span>
                <p class="comment no-scrollbar"><?= $video->take_down_comment?></p>
            </div>
        </div>
    </div>
<?php
}