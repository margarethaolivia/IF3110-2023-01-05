<?php
function popup($title, $actionName=null, $action="closePopUp(event)", $actionButtonClass="popup-close-button", $cancelButtonClass="cancel-action-button", $strict=false) {
?>
    <div class="flex flex-row justify-center items-center w-full h-screen fixed popup-container">
        <div class="popup-layout absolute h-full w-full" onclick="<?=$strict ? '' : 'closePopUp(event)'?>">

        </div>
        <div class="popup flex flex-row justify-between">
            <div class="flex flex-row">
                <div class="popup-header w-full">
                    <span class="popup-title"><?=$title?></span>
                </div>
                <div class="popup-body w-full">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem</p>
                </div>
            </div>

            <div class="popup-footer flex flex-col justify-end w-full">
                <?php if ($actionName) : ?>
                    <button class="<?=$cancelButtonClass?>" $onclick="closePopUp(event)">Cancel</button>
                <?php endif; ?>
                <button class="action-button <?=$actionButtonClass?>" onclick="<?=$action?>"><?=($actionName ?? "Close")?></button>
            </div>
        </div>
    </div>
<?php
}