<?php


function prevButton() {
?>
    <button class="page-button"><</button>
<?php
}

function nextButton() {
?>
    <button class="page-button">></button>
<?php
}

function pageButton($num = -1) {
?>
    <button class="page-button"><?= $num == -1 ? "..." : "$num" ?></button>
<?php
}

function pagination($maxNum) {
    $maxButton = 5;

    $lowerLimit = $maxNum > $maxButton ? 2 : $maxNum;
    $upperLimit = $maxNum > $maxButton ? $maxNum - 1 : $maxNum + 1;
?>
    <div class="pagination flex flex-col w-full justify-center">
        <?php prevButton() ?>
        <?php  
            for ($i = 1; $i <= $lowerLimit; $i++) {
                pageButton($i);
            }
        ?>
        <?php if ($maxNum > $maxButton) pageButton() ?>
        <?php  
            for ($i = $upperLimit; $i <= $maxNum; $i++) {
                pageButton($i);
            }
        ?>
        <?php nextButton() ?>
    </div>
<?php
}