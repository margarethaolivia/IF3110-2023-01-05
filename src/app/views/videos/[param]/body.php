<?php

include_once APP_PATH . '/components/elements/commentCard.php';
include_once APP_PATH . '/utils/DateParser.php';
include_once APP_PATH . '/components/elements/popup.php';

function body($data) {
    $dataParser = new DateParser();
    $comments = $data['comments'];
    $video = $data['video'];
    $user = $data['user'];
?>
    <div>
        <div class="flex">
            <div class="w-full">
                <video class="w-full" controls>
                    <source src="<?=$data['video']->video_file?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>   
        </div>
        
        <div class="flex flex-col justify-between items-center">
            <div class="flex flex-col items-center my-2">
                <div class="publisher-pic-container">
                    <?php if ($video->profile_pic) : ?>
                        <img src="<?=$video->profile_pic?>" class="publisher-pic user-pic">
                    <?php endif; ?>
                    <?php if (!$video->profile_pic) : ?>
                        <svg class="publisher-pic profile_svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="flex flex-row">
                    <h2 class="video-title"><?=$video->title?></h2>
                    <div class="flex flex-col items-center publisher-container">
                        <h3 class="flex align-center full-name"><?=$video->first_name . ' ' . $video->last_name?> </h3>
                        <?php if ($video->is_official) : ?>
                            <div class="official-logo">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($user && $user->is_admin) : ?>
                <button onclick="undoTakeDown(event, <?=$video->video_id?>)" class="takedown-button <?=!$video->is_taken_down ? 'hidden' : ''?>" id="undo-takedown-button">Undo Takedown</button>
                <button onclick="showTakeDown(event)" class="takedown-button <?=$video->is_taken_down || $video->is_official ? 'hidden' : ''?>" id="show-takedown-button">Take Down</button>
            <?php endif; ?>
        </div>

        <form id="takedown-form" class="hidden" onsubmit="submitTakeDown(event, <?=$video->video_id?>)">
            <textarea class="comment-input" onfocus="showCommentButtons(event)"  name="take_down_comment" placeholder="Type your takedown comment here"></textarea>
            <div class="flex flex-col justify-end action-button-container" id="takedown-button-container">
                <button onclick="closeTakeDownButtons(event)" id="cancel-comment-button" >Cancel</button>
                <button class="submit-action-button" id="submit-comment-button" type="submit">Take Down</button>
            </div>
        </form>

        <div class="video-desc">
            <?php if ($video->is_taken_down) : ?>
                <span class="my-1 flex align-center title-desc takedown-title">This video is taken down by WeTube</span>
                <div class="desc-container takedown-desc-container">
                    <p><?=$video->take_down_comment?></p>
                </div>
            <?php endif; ?>

            <?php if ($video->updated_at == $video->created_at) : ?>
                <span class="my-1 flex align-center title-desc">Uploaded <?=$dataParser->dateTimeToString($video->created_at)?></span>
            <?php endif; ?>

            <?php if ($video->updated_at != $video->created_at) : ?>
                <span class="my-1 flex align-center title-desc">Edited <?=$dataParser->dateTimeToString($data['video']->updated_at)?></span>
            <?php endif; ?>
            
            <div class="desc-container">
                <?php if ($video->video_desc) : ?>
                    <div id="desc-text-container" class="desc-text-container">
                        <p><?=$video->video_desc?></p>
                    </div>
                    <span class="span-button show-more" id="show-more">Show more</span>
                    <span class="span-button show-less" id="show-less">Show less</span>
                <?php endif; ?>

                <?php if (!$video->video_desc) : ?>
                    <p>No description</p>
                <?php endif; ?>
            </div>
        </div>
        
        <h3 class="mt-5 mb-2 comment-title"><?=count($comments)?> Comment(s)</h3>
        <div class="flex flex-row">
            <form onsubmit="createVideoComment(event, <?=$video->video_id?>)" class="flex flex-row items-end justify-between w-full">
                <div class="flex flex-col">
                    <div class="user-pic-container">
                        <?php if (isset($_SESSION['profile_pic'])) : ?>
                            <img src="<?=$_SESSION['profile_pic']?>" class="user-pic">
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['profile_pic'])) : ?>
                            <svg class="profile_svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        <?php endif; ?>
                    </div>    
                    <textarea <?=$user ? '' : 'disabled'?> class="comment-input <?=$user ? 'vertical-resize' : 'no-resize'?>" onfocus="showCommentButtons(event)" type="text" autocomplete="off" id="comment_text_input" name="comment_text_input" placeholder="<?=$user ? 'Type your comment here' : 'Comment disabled for non user'?> "></textarea>
                </div>
                <div class="flex flex-col justify-end action-button-container hidden" id="comment-button-container">
                    <button onclick="closeCommentButtons(event)" id="cancel-comment-button" >Cancel</button>
                    <button class="submit-comment-button" id="submit-comment-button" type="submit">Comment</button>
                </div>
            </form>
            <div id="comment-section">
                <?php 
                    foreach ($comments as $comment) {
                        commentCard(
                            $comment,
                            $video->video_id,
                            deleteAction: "deleteMyComment(event, " . $video->video_id . ", " . $comment->comment_id . ", 'popup-delete-comment')",
                            editAction: "submitEditAction(" . $video->video_id . ", " . $comment->comment_id . ")",
                            cardId: $comment->comment_id,
                        );
                    }
                ?>  
            </div>
        </div>
        <?php 
            popup("Delete Comment", "Are you sure you want to delete this comment?", "delete-comment", "Delete", actionButtonClass: 'red-action-button');
        ?>
    </div>
 <?php 
}