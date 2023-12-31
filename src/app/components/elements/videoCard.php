<?php

require_once APP_PATH . '/utils/DateParser.php';

function videoCard($video, $noUser=false, $settings=false, $deleteAction="", $editLink="", $cardId="", $showTakeDown=false) {
    $parser = new DateParser();
?> 
    <div id="<?=$cardId?>" class="video-card" onclick="<?='watchVideo(event, ' . $video->video_id . ')'?>">
        <div class="card-thumbnail-container">
            <img class="video-thumbnail" src="<?=$video->thumbnail?>" alt="Video Thumbnail" width="600" height="300">
        </div>
        <div class="flex">
            <?php if (!$noUser) : ?>
                <div class="w-small publisher-pic-container">
                    <?php if ($video->profile_pic) : ?>
                        <img class="publisher-pic" src="<?=$video->profile_pic?>" alt="Avatar">
                    <?php endif; ?>

                    <?php if (!$video->profile_pic) : ?>
                        <svg class="publisher-pic profile_svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="w-big ml-2">
                <h2><?=$video->title?></h2>
                <?php if (!$noUser) : ?>
                    <div class="flex flex-col items-center publisher-info">
                        <span class="publisher-name flex align-center"><?=$video->full_name?></span>
                        <?php if ($video->is_official) : ?>
                            <div class="official-logo">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <p class="upload-info">Uploaded <?=$parser->dateTimeToString($video->created_at)?></p>
                <?php if ($showTakeDown && isset($video->is_taken_down) && $video->is_taken_down) : ?>
                    <p class="takedown-info">Taken down by Wetube</p>
                <?php endif; ?>
            </div>
            <?php if ($settings) : ?>
                <div class="flex flex-row justify-center items-center videocard-button-container">
                    <a href="<?=$editLink?>" class="video-card-button video-edit-button" aria-label="edit page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z" />
                        </svg>
                    </a>
                    <button onclick="<?=$deleteAction?>" class="video-card-button video-delete-button" aria-label="Delete Video">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php
}