<?php
include_once APP_PATH . '/utils/DateParser.php';

function commentCard($comment, $deleteAction="") {
    $dataParser = new DateParser();
    $isAdmin = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : false;
?>
    <div id="card-<?=$comment->comment_id?>" class="comment-box my-1">
        <div class="flex justify-between">
        <div class="comment-info">
            <div class="flex flex-col comment-account-info items-center">
                <span class="commenter"><?=$comment->first_name . ' ' . $comment->last_name?></span>
                <?php if ($comment->is_admin) : ?>
                    <div class="official-logo">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($comment->updated_at === $comment->created_at) : ?>
                <span class="text-grey">Posted <?=$dataParser->dateTimeToString($comment->created_at)?></span>
            <?php endif; ?>
            <?php if ($comment->updated_at !== $comment->created_at) : ?>
                <span class="text-grey">Edited <?=$dataParser->dateTimeToString($comment->updated_at)?></span>
            <?php endif; ?>
        </div>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $comment->user_id) : ?>
            <div id="edit-delete-button-container" class="flex justify-center items-center">
                    <a onclick="openEditInput(event, 'paragraph-<?=$comment->comment_id?>')" class="video-card-button video-edit-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="2 2 20 20" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z" />
                        </svg>
                    </a>
                    <button onclick="<?=$deleteAction?>" class="video-card-button video-delete-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="2 2 20 20" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
        <?php endif; ?>
        <?php if ($isAdmin && isset($comment->is_admin) && !$comment->is_admin) : ?>
            <div id="admin-delete-button-container" class="flex justify-center items-center">
                    <button onclick="<?=$deleteAction?>" class="video-card-button video-delete-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="2 2 20 20" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
        <?php endif; ?>
        </div>
    
        <div id="comment-content">
            <p class="pt-2" id="paragraph-<?=$comment->comment_id?>"><?=$comment->comment_text?></p>
            <div class="pt-2 hidden edit-form-container">
                <form onsubmit="submitEditAction(event, '<?=$comment->video_id?>', '<?=$comment->comment_id?>')">
                    <textarea type="text" autocomplete="off" id="comment_text" name="comment_text" placeholder="Type your comment here" autofocus></textarea>
                    <div class="flex flex-col justify-end action-button-container" id="edit-button-container-${comment_id}">
                        <button type="reset" onclick="closeEditCommentButtons({e: event, cancel: true})" id="cancel-comment-button" >Cancel</button>
                        <button class="submit-comment-button" id="submit-comment-button" type="submit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}