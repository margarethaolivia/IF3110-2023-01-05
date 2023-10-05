<?php
include_once (APP_PATH . '/components/elements/logo.php');
include_once (APP_PATH . '/components/elements/signInButton.php');
function pageHeader() {
    $isHome = !(isset($_SERVER['PATH_INFO']));
?>
    <div class="navbar flex flex-row items-center fixed w-full">
        <div class="flex flex-col justify-between items-center global-navbar w-full">
            <?php
                logo(classes: "header-panel-header", onMenuClick: "openSidebar(event)");
            ?>
            <div class="search-div">
                <div class="search-bar">
                    <input type="text" id="searchBar" placeholder="Search">    
                </div>
            </div>
            <div class="nav-links">
                <?php
                    if(isset($_SESSION['user_id']))
                    {
                    ?>
                    
                        <a class="profile-link" href="/profile">
                            <?php
                                if (isset($_SESSION['profile_pic']) && $_SESSION['profile_pic'])
                                {
                                    ?>
                                        <img class="profile_pic" src="<?=$_SESSION['profile_pic']?>"/>
                                    <?php
                                }

                                else
                                {
                                    ?>
                                        <svg class="profile_svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    <?php
                                }
                            ?>
                        </a>
                    <?php
                    }
                    else
                    {
                        signInButton();
                    }
                ?>
            </div>
        </div>

        <?php if ($isHome) : ?>
            <div class="flex flex-col items-center justify-between filters">
                <div class="scrollmenu no-scrollbar" id="horizontal-scroll-container">
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>


                    <button class="badge p-2 mtbr-2">Music</button>
                    <button class="badge p-2 mtbr-2">Music</button>
                    
                    
                </div>
                <button class="sort-button">Sort</button>
            </div>
        <?php endif; ?>
    </div>
<?php
}