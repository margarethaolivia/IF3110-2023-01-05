<?php

function officialCategories() {
?>
    <button class='badge p-2 mtbr-2 selected' onclick="setFilter(event, '', 'official_category')">All</button>
    <button class='badge p-2 mtbr-2' onclick="setFilter(event, 'true', 'official_category')">Official</button>
    <button class='badge p-2 mtbr-2' onclick="setFilter(event, 'false', 'official_category')">Non Official</button>
<?php
}
