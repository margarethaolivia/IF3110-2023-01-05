<?php

function customInput($inputLabel, $inputType, $inputName, $required = false, $placeholder = "", $defaultValue = "", $inputClasses = "") {
    ?>

    <div class="custom-input flex flex-row">
        
        <span class="input-label"><?= $inputLabel?> <span class="required-mark <?= $required ? "required" : ""?>">*</span></span>

        <?php if ($inputType === "text") : ?>
            <input 
                type="<?= $inputType?>" 
                name="<?= $inputName?>" 
                placeholder="<?= $placeholder ?>"
                class="<?= $inputClasses?>"
                <?= $defaultValue !== "" ? 'value="' . htmlspecialchars($defaultValue) . '"' : '' ?>
            >
        <?php endif; ?>

        <?php if ($inputType === "textarea") : ?>
            <textarea 
                name="<?= $inputName?>" 
                placeholder="<?= $placeholder ?>"
                class="<?= $inputClasses?>"
            ><?= $defaultValue !== "" ? htmlspecialchars($defaultValue) : '' ?></textarea>
        <?php endif; ?>
    </div>
    
<?php
}