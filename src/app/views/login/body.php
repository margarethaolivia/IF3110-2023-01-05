<?php
include_once (APP_PATH . '/components/elements/logo.php');
include_once (APP_PATH . '/components/elements/customInput.php');

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
                    pattern: '^[a-zA-Z0-9]+$',
                    title: 'Username can only consist of alphabets and numbers'
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
            <span class="create-account-text">or 
                <a href=<?=BASE_URL . "/signup" . (isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : '') ?> class="create-account-link">Create Account</a>
            </span>
        </div>
    </form>
<?php
}