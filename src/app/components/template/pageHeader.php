<?php
include_once (APP_PATH . '/components/elements/logo.php');
include_once (APP_PATH . '/components/elements/signInButton.php');
include_once (APP_PATH . '/components/elements/option.php');
include_once (APP_PATH . '/components/header/officialCategories.php');

function pageHeader($data) {
    $isHome = !(isset($_SERVER['PATH_INFO']));
    
    $tags = [];

    if ($isHome)
    {
        $tags = $data['tags'];
    }
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
                    
                        <a class="profile-link" href="/profile" aria-label="profile page">
                            <?php
                                if (isset($_SESSION['profile_pic']) && $_SESSION['profile_pic'])
                                {
                                    ?>
                                        <img class="profile_pic" src="<?=$_SESSION['profile_pic']?>" alt="profile picture"/>
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
            <div class="flex items-center filters">
                <div class="scrollmenu no-scrollbar horizontal-scroll-container hidden" id="tags-container">
                    <button onclick="setFilter(event, '', 'tag')" class='badge selected p-2 mtbr-2'>All</button>
                    <?php foreach ($tags as $tag) : ?>
                        <button onclick="setFilter(event, '<?=$tag?>', 'tag')" class='badge p-2 mtbr-2'><?=$tag?></button>
                    <?php endforeach; ?>
                </div>
                <div class="scrollmenu no-scrollbar horizontal-scroll-container hidden" id="official-categories-container">
                    <?php officialCategories() ?>
                </div>
                <div class="options-container flex flex-col justify-between">
                    <?php
                        option(
                            'Filters', 
                            [
                                getOption('Tags', 'tag', 'showTags(event)'), 
                                getOption('Official Status', 'official_category', 'showOfficialCategories(event)'), 
                            ],
                        );
                        option(
                            'Searchs', 
                            [
                                getOption('Title', 'title', "setCategory(event, 'title', 'search_categories', searchCategoryCallback)"), 
                                getOption('Publisher', 'full_name', "setCategory(event, 'full_name', 'search_categories', searchCategoryCallback)"), 
                            ], 
                            true
                        );
                        option(
                            'Sorts', 
                            [
                                getOption('Publish Date', 'created_at', "setCategory(event, 'created_at', 'sort_categories', sortCategoryCallback)"), 
                                getOption('Edit Date', 'updated_at', "setCategory(event, 'updated_at', 'sort_categories', sortCategoryCallback)"), 
                                getOption('Title', 'title', "setCategory(event, 'title', 'sort_categories', sortCategoryCallback)")
                            ], 
                            true
                        );
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php
}