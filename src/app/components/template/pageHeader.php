<?php
include_once (__DIR__ . '/../elements/logo.php');
include_once (__DIR__ . '/../elements/signInButton.php');
function pageHeader() {
?>
    <nav class="navbar">
        <?php
            logo("panel-header");
        ?>
        <div class="search-div">
            <div class="search-bar">
                <input type="text" placeholder="Search">    
            </div>
            <button class="search-button">Search</button>
        </div>
        <div class="nav-links">
            <?php
                signInButton();
            ?>
            
        </div>
    </nav>
<?php
}