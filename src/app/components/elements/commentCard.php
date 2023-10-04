<?php
include_once APP_PATH . '/utils/DateParser.php';

function commentCard($comment, $noUser=false, $settings=false, $deleteAction="", $editLink="", $cardId="") {
    $dataParser = new DateParser();
?>
    <div id="<?=$cardId?>" class="comment-box my-2">
        <div class="flex justify-between">
        <div>
            <h4 class="text-bold"><?=$comment->first_name . ' ' . $comment->last_name?></h4>
            <h5 class="text-grey"><?=$dataParser->dateTimeToString($comment->created_at)?>

            <?php if ($comment->updated_at != $comment->created_at) : ?>
                | updated <?=$dataParser->dateTimeToString($comment->updated_at)?>
            <?php endif; ?>
        
            </h5>
        </div>

        <?php if ($_SESSION['user_id'] === $comment->user_id) : ?>
            <button class="comment-edit-button">edit</button>
        <?php endif; ?>
        </div>
    
        <p class="pt-2"><?=$comment->comment_text?></p>
    </div>
<?php
}