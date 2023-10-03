<?php
function popup($title, $message, $id, $actionName=null, $action="closePopUp(event)", $actionButtonClass="popup-close-button", $cancelButtonClass="cancel-action-button", $strict=true) {
?>
    <div id="popup-<?=$id?>" class="flex flex-row justify-center items-center w-full h-screen fixed popup-container">
        <div class="popup-layout absolute h-full w-full" onclick="<?=$strict ? '' : 'closePopUp(event)'?>">

        </div>
        <div class="popup flex flex-row justify-between">
            <div class="flex flex-row">
                <div class="popup-header w-full">
                    <span class="popup-title"><?=$title?></span>
                </div>
                <div class="popup-body w-full">
                    <p><?=$message?></p>
                </div>
            </div>

            <div class="popup-footer flex flex-col justify-end w-full">
                <?php if ($actionName) : ?>
                    <button class="cancel-button <?=$cancelButtonClass?>" onclick="closePopUp(event)">Cancel</button>
                <?php endif; ?>
                <button class="action-button <?=$actionButtonClass?>" onclick="<?=$action?>"><?=($actionName ?? "Close")?></button>
            </div>
        </div>
    </div>
<?php
}