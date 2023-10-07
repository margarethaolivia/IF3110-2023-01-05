<?php
include_once (APP_PATH . '/components/elements/logo.php');
include_once (APP_PATH . '/components/elements/customInput.php');

function body($data) {
?>
    <form onsubmit="signup(event)" class="auth-form h-screen w-full flex flex-row justify-center items-center">
        <?php 
            logo('login-logo', false, true);
        ?>

        <div class="flex flex-row items-center fields">
            <?php
                customInput(
                    'text',
                    'username',
                    required: true,
                    placeholder: 'username',
                    inputClasses: 'input-box',
                    inputLabel: 'Username',
                    pattern: '^[a-zA-Z0-9]+$',
                    title: 'Username can only consist of alphabets and numbers'
                );

                customInput(
                    'password',
                    'password',
                    required: true,
                    placeholder: 'password',
                    inputClasses: 'input-box',
                    inputLabel: 'Password'
                );

                customInput(
                    'password',
                    'confirm_password',
                    required: true,
                    placeholder: 'password',
                    inputClasses: 'input-box',
                    inputLabel: 'Confirm Password'
                );

                customInput(
                    'text',
                    'first_name',
                    required: true,
                    placeholder: 'first name',
                    inputClasses: 'input-box',
                    inputLabel: 'Fist Name',
                    pattern: '^[a-zA-Z]+$',
                    title: 'Name can only consist of alphabets'
                );

                customInput(
                    'text',
                    'last_name',
                    placeholder: 'Lee',
                    inputClasses: 'input-box',
                    inputLabel: 'last name',
                    pattern: '^[a-zA-Z]+$',
                    title: 'Name can only consist of alphabets'
                );
            ?>
            <button class="blue-button">Create Account</button>
            <span class="create-account-text">Already have account? <a href="<?=BASE_URL . "/login" . (isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : '') ?>" class="create-account-link">Log In</a></span>
        </div>
    </form>
<?php
}