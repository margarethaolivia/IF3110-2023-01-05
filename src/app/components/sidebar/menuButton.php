<?php

function menuButton($svg, $menuTitle, $href=null, $onClick="") {
?>
    <?php if ($href) : ?>
        <a href="<?=$href?>" class="flex flex-col menu-gap menu items-center">
            <?=$svg?>
            <span><?=$menuTitle?></span>
        </a>
    <?php endif; ?>

    <?php if (!$href) : ?>
        <button onclick="<?=$onClick?>" class="flex flex-col menu-gap menu items-center">
            <?=$svg?>
            <span><?=$menuTitle?></span>
        </button>
    <?php endif; ?>
<?php
}