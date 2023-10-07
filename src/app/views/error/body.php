<?php


function body($data) {
?>
    <div class="flex flex-row w-full items-center h-screen justify-center">
        <img alt="error image" class="error-image" src="<?=$data['src']?>">
        <span class="error-page-desc"><?=$data['desc']?></span>
        <a href="<?=$data['link']?>" class="error-page-back">Go Back</a>
    </div>
<?php
}