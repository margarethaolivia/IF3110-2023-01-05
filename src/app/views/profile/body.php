<?php
include_once APP_PATH . '/utils/DateParser.php';
include_once APP_PATH . '/components/elements/popup.php';
function body($data) {
    $dataParser = new DateParser();
?>

    <div class="">
        <div class="user-profile flex flex-col items-center w-full bd">
            <div class="full-rounded profile-picture relative">
                <?php if (isset($_SESSION['profile_pic'])) : ?>
                    <img class="profile_pic" src="<?=$_SESSION['profile_pic']?>">
                <?php endif; ?>

                <?php if (!isset($_SESSION['profile_pic'])) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                <?php endif; ?>
            
                <label class="absolute change-pic-icon">
                    <input type="file" name="profile_pic" hidden accept="<?=implode(', ', ALLOWED_IMAGES)?>" onchange="changeProfilePicture(event)"></input>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                </label>
            </div>
            <div class="profile-info">
                <span id="full_name" class="full-name"><?=$data['user']->first_name . ' ' . $data['user']->last_name?></span>
                <div class="user-info flex flex-col text-gray">
                    <span><?= $data['user']->username ?></span>
                    <span>|</span>
                    <span><?= $_SESSION['is_admin'] ? 'Admin' : 'User' ?></span>
                </div>
            </div>
        </div>
        <div class="flex justify-between main-body">
            <div class="flex flex-row user-forms">
                <form onsubmit="updateProfile(event)" class="form">
                    <span class="form-label">Change Name</span>
                    <div class="flex flex-col form-inputs">
                        <input id="first_name_input" name="first_name" placeholder="First Name" class="text-gray h-full input" type="text" pattern="^[a-zA-Z]+$"></input>
                        <input id="last_name_input" name="last_name" placeholder="Last Name" class="h-full input" type="text" pattern="^[a-zA-Z]+$"></input>
                        <button type="submit" class="submit-button h-full">Save</button>
                    </div>
                </form>

                <form onsubmit="updateProfile(event)" class="form">
                    <span class="form-label">Change Password</span>
                    <div class="flex flex-col form-inputs text-gray h-full">
                        <input id="old_password_input" name="old_password" placeholder="Old Password" class="h-full input" type="password"></input>
                        <input id="new_password_input" name="new_password" placeholder="New Password" class="h-full input" type="password"></input>
                        <button type="submit" class="submit-button h-full">Save</button>
                    </div>
                </form>
            </div>

            <div class="flex flex-row stats">
                <span class="bd title">Stats</span>
                <span class="bd text-gray">Joined <?=$dataParser->dateTimeToString($data['user']->created_at)?></span>
                <span class="bd text-gray">Total 4 videos</span>
            </div>
        </div>

        <div class="upload-section flex flex-row items-center">
            <span class="upload-title">Upload a video to get started</span>
            <span class="upload-desc">Start sharing your story and connecting with viewers.</span>
            <a href="/videos/upload" class="blue-button upload-button flex flex-col justify-center items-center"><span>Upload Video</span></a>
        </div>

    </div>
<?php
}