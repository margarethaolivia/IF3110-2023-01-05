<?php

include_once (APP_PATH . '/components/takedowns/takedownRow.php');

function body($data) {
?>
    <div class="w-full flex flex-row">
        <span class="page-title">Takedowns</span>
        <div class="table-header flex flex-col w-full">
            <div class="main-columns flex flex-col">
                <div class="video-column">
                    <span>Video</span>
                </div>
                <div class="comment-column">
                    <span>Comment</span>
                </div>
            </div>
        </div>
        <div class="table-content flex flex-row">
            <?php 
                takedownRow(1, "", "My Video", "Johanes Lee", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummyLorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy");
            ?>

            <?php 
                takedownRow(1, "", "My Video", "Johanes Lee", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy");
            ?>

            <?php 
                takedownRow(1, "", "My Video", "Johanes Lee", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy");
            ?>

            <?php 
                takedownRow(1, "", "My Video", "Johanes Lee", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy");
            ?>

            <?php 
                takedownRow(1, "", "My Video", "Johanes Lee", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy", "Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text of the printing and typesetting Lorem Ipsum is simply dummy");
            ?>
        </div>

        <?php 
        ?>
    </div>
<?php
}