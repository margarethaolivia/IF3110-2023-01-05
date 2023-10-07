<?php
function emptyList($image_src, $desc) {
?>
    <div class="flex flex-row w-full items-center">
        <img alt="error image" class="empty-image" src="<?=$image_src?>">
        <span class="error-page-desc"><?=$desc?></span>
    </div>
<?php
}