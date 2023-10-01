<?php

function menuButton($svg, $menuTitle) {
?>
    <button class="flex flex-col menu-gap menu items-center">
        <?=$svg?>
        <span><?=$menuTitle?></span>
    </button>
<?php
}