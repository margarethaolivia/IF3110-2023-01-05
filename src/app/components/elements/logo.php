<?php

function logo($classes="", $includeMenuButton=true, $disableLink=false) {
?>
    <div class="menu-gap flex flex-col items-center panel-header <?=$classes?>">
        <?php if ($includeMenuButton) : ?>
            <button class="menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        <?php endif; ?>
        
        <?php if (!$disableLink) : ?>
            <a href="<?=BASE_URL?>" class="logo flex flex-col items-center">
                <img src="<?= BASE_URL ?>/images/icon/wetube.png" alt="WeTube Logo" class="logo-img"> 
                <span class="logo-text">WeTube</span>
            </a>
        <?php endif; ?>

        <?php if ($disableLink) : ?>
            <div class="logo flex flex-col items-center">
                <img src="<?= BASE_URL ?>/images/icon/wetube.png" alt="WeTube Logo" class="logo-img"> 
                <span class="logo-text">WeTube</span>
            </div>
        <?php endif; ?>

    </div>
<?php
}