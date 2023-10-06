<?php
function getOption($label, $id, $actionString ="") {
    return [
        'label' => $label,
        'id' => $id,
        'action' => $actionString
    ];
}
?>


<?php
function option($title, $options=[], $multiple=false) {
?>
    <div class="dropdown<?=$multiple ? '-multiple' : ''?>">
        <div class="select<?=$multiple ? '-multiple' : ''?>">
            <span><?=$title?></span>
            <i class="fa fa-chevron-left"></i>
        </div>
        <?php if (!$multiple) : ?>
            <input type="hidden">
        <?php endif; ?>
        
        <ul class="dropdown-menu<?=$multiple ? '-multiple' : ''?>">
            <?php
                foreach ($options as $option) {
                    ?>
                        <li onclick="<?=$option['action']?>" id="<?=$option['id']?>"><?=$option['label']?></li>
                    <?php
                }
            ?>
        </ul>
    </div>
<?php
}
?>