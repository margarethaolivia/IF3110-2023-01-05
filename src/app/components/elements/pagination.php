<?php
function prevButton($actionString="movePage") {
?>
    <button id="prev" class="page-button" onclick="<?=$actionString ? $actionString . '(\'prev\')' : '' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
    </button>
<?php
}

function nextButton($actionString="movePage") {
?>
    <button id="next" class="page-button" onclick="<?=$actionString ? $actionString . '(\'next\')' : '' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </button>
<?php
}

function pageButton($num = -1, $classes="", $actionString="movePage") {
?>
    <button id="<?=$num?>" onclick="<?=$actionString ? $actionString . '(' . $num .')' : '' ?>" class="page-button <?=$num === -1 ? 'no-click' : ''?> <?=$classes?>"><?= $num === -1 ? "..." : "$num" ?></button>
<?php
}

function pagination($maxNum, $currentPage=1, $actionString="movePage") {
    $maxButton = 7;
    $range = $maxNum - $currentPage + 1;
    $hideCondition = $range > $maxButton;
    $prevCondition = $currentPage > 2;
    $nextCondition = $maxNum - $currentPage > 4;
?>
    <div class="pagination flex flex-col w-full justify-center">
        <?php  
            if ($hideCondition)
            {
                $prevCondition = $currentPage > 1;
                $nextCondition = $maxNum - $currentPage > 4;

                $lowerLimit = $hideCondition ? max($currentPage, 3) : $maxNum;
                $upperLimit = $hideCondition ? $maxNum - 2 : $maxNum + 1;

                if($prevCondition) prevButton($actionString);

                for ($i = max($currentPage-2, 1); $i <= $lowerLimit; $i++) {
                    pageButton($i, ($i === $currentPage ? 'current-page-button' : ''), $actionString);
                }

                pageButton();

                for ($i = $upperLimit; $i <= $maxNum; $i++) {
                    pageButton($i, $actionString);
                }

                if ($nextCondition) nextButton($actionString);
            }

            else
            {
                $initialPage = $maxNum > $maxButton ? $maxNum - $maxButton + 1 : 1;
                if ($initialPage > 1)
                {
                    prevButton($actionString);
                }
                for ($i = $initialPage; $i <= $maxNum; $i++) {
                    pageButton($i, ($i === $currentPage ? 'current-page-button' : ''), $actionString);
                }
            }

        ?>
    </div>
<?php
}