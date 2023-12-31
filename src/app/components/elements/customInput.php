<?php

function customInput($inputType, $inputName, $inputLabel="", $required = false, $placeholder = "", $defaultValue = "", $inputClasses = "", $disableLabel = false, $pattern=null, $title="") {
?>

    <div class="custom-input flex flex-row">

        <?php if (!$disableLabel) : ?>
            <span class="input-label"><?= $inputLabel?> <span class="required-mark <?= $required ? "required" : ""?>">*</span></span>
        <?php endif; ?>

        <?php if (in_array($inputType, ['text', 'password'])) : ?>
            <input 
                type="<?= $inputType?>" 
                name="<?= $inputName?>" 
                placeholder="<?= $placeholder ?>"
                class="<?= $inputClasses?>"
                <?= $required ? 'required' : '' ?>
                <?= $defaultValue !== "" ? 'value="' . htmlspecialchars($defaultValue) . '"' : '' ?>
                <?= $pattern ? 'pattern="' . htmlspecialchars($pattern) . '"' : '' ?>
                <?= $title ? 'title="' . htmlspecialchars($title) . '"' : '' ?>
            >
        <?php endif; ?>

        <?php if ($inputType === "textarea") : ?>
            <textarea 
                name="<?= $inputName?>" 
                placeholder="<?= $placeholder ?>"
                class="<?= $inputClasses?>"
                <?= $required ? 'required' : '' ?>
                <?= $title ? 'title="' . htmlspecialchars($title) . '"' : '' ?>
            ><?= $defaultValue !== "" ? htmlspecialchars($defaultValue) : '' ?></textarea>
        <?php endif; ?>
    </div>
    
<?php
}