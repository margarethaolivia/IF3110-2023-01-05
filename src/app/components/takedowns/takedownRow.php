<?php

function takedownRow($id, $thumbnail, $title, $fullname, $desc, $comment) {
?>
    <div class="flex takedown-row bd w-full">
        <div class="flex main-columns">
            <div class="flex flex-col video-column">
                <div class="video-thumbnail">

                </div>
                <div class="video-info flex flex-row h-full justify-between">
                    <div class="user-info flex flex-row">
                        <span class="title"><?= $title?></span>
                        <span class="fullname"><?= $fullname?></span>
                    </div>
                    <div class="desc-container">
                        <p class="desc"><?= $desc?></p>
                    </div>
                </div>
            </div>

            <div class="comment-column">
                <p class="comment"><?= $comment?></p>
            </div>
        </div>

        <button class="undo-button">Undo</button>
    </div>
<?php
}