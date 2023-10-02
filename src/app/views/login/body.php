<?php
include_once (__DIR__ . '/../../components/elements/logo.php');
include_once (__DIR__ . '/../../components/elements/customInput.php');

function body($data) {
?>
    <form onsubmit="login(event)" class="auth-form h-screen w-full flex flex-row justify-center items-center">
        <?php 
            logo('login-logo', false, true);
        ?>

        <div class="flex flex-row items-center fields">
            <?php
                customInput(
                    'text',
                    'username',
                    required: true,
                    placeholder: 'Username',
                    disableLabel: true,
                    inputClasses: 'input-box',
                );

                customInput(
                    'password',
                    'password',
                    required: true,
                    placeholder: 'Password',
                    disableLabel: true,
                    inputClasses: 'input-box',
                );
            ?>
            <button class="blue-button">Log In</button>
            <span class="create-account-text">or <a href="<?=BASE_URL . "/signup"?>" class="create-account-link">Create Account</a></span>
        </div>
    </form>
<?php
}