<?php
include_once APP_PATH . '/utils/DateParser.php';

function commentCard($comment, $noUser=false, $settings=false, $deleteAction="", $editLink="", $cardId="") {
    $dataParser = new DateParser();
?>
    <div id="<?=$cardId?>" class="comment-box my-2">
        <h4 class="text-bold"><?=$comment->first_name . ' ' . $comment->last_name?></h4>
        <h5 class="text-grey"><?=$dataParser->dateTimeToString($comment->created_at)?></h5>
        <p class="pt-2"><?=$comment->comment_text?></p>
    </div>
<?php
}