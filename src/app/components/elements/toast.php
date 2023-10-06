<?php

function toastChild($id) {
?>
    <div class="flex flex-col items-center justify-between toast" id="toast-<?=$id?>">
        <div class="toast-value-container">
            <p id="toast-value-<?=$id?>"></p>
        </div>
        <button id="toast-close-button-<?=$id?>">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
        </button>
    </div>
<?php
}

function toast() {
?>
    <div class="flex flex-row items-center fixed toast-container">
        <?php
        ?>
    </div>
<?php
}
