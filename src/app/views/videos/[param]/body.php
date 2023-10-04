<?php

include_once APP_PATH . '/components/elements/commentCard.php';
include_once APP_PATH . '/utils/DateParser.php';

function body($data) {
    $dataParser = new DateParser();
    $comments = $data['comments'];
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
        
        <div class="my-2">
            <div class="flex justify-between">
                <div>
                    <h2 class="text-bold"><?=$data['video']->title?></h2>
                    <h3 class="my-1 text-bold text-grey flex align-center"><?=$data['video']->first_name . ' ' . $data['video']->last_name?> 
                        <?php if ($data['video']->is_admin) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                            <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                        </svg>
                        <?php endif; ?>
                        
                    </h3>
                    <h4 class="my-1 text-grey flex align-center">Uploaded <?=$dataParser->dateTimeToString($data['video']->created_at)?>

                    <?php if ($data['video']->updated_at != $data['video']->created_at) : ?>
                        | Updated <?=$dataParser->dateTimeToString($data['video']->updated_at)?>
                    <?php endif; ?>
                    </h4>
                </div>
                <div class="flex">
                    <button class="comment-edit-button">Edit</button>
                </div>
            </div>
        </div>

        <h3 class="text-bold mt-5 mb-2">Description</h3>
        <div class="video-desc">
            <p><?=$data['video']->video_desc?></p>
        </div>
        
        <h3 class="text-bold mt-5 mb-2">Comments</h3>

        <div class="">

            <form onsubmit="createVideoComment(event)">
                <div class="flex">
                    <div class="w-big">
                        <div class="form-group">
                            <input type="text" autocomplete="off" id="comment_text" name="comment_text" placeholder="Type your comment here">
                        </div>
                    </div>
                    <div class="w-small">
                        <input class="float-end"  type="submit" value="Submit">
                    </div>
                </div>
            </form>

            <?php 
                foreach ($comments as $comment) {
                    commentCard($comment);
                }
            ?>     
        </div>
    </div>
 <?php 
}