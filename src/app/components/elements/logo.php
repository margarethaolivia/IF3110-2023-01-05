<?php

function logo($classes) {
?>
    <div class="menu-gap flex flex-col items-center <?=$classes?>">
        <button class="menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <button class="logo flex flex-col items-center">
            <img src="<?= BASE_URL ?>/images/icon/wetube.png" alt="WeTube Logo" class="logo-img"> 
            <span class="logo-text">WeTube</span>
        </button>
    </div>
<?php
}