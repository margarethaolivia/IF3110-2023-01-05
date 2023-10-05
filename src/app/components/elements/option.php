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
            <li id="male">Male</li>
            <li id="female">Female</li>
        </ul>
    </div>
<?php
}
?>