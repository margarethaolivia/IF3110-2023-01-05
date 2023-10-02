<?php
include_once (__DIR__ . '/../../components/elements/logo.php');
include_once (__DIR__ . '/../../components/elements/customInput.php');

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
                    placeholder: '',
                    inputClasses: 'input-box',
                    inputLabel: 'Username'
                );

                customInput(
                    'password',
                    'password',
                    required: true,
                    placeholder: '',
                    inputClasses: 'input-box',
                    inputLabel: 'Password'
                );

                customInput(
                    'password',
                    'confirm_password',
                    required: true,
                    placeholder: '',
                    inputClasses: 'input-box',
                    inputLabel: 'Confirm Password'
                );

                customInput(
                    'text',
                    'first_name',
                    required: true,
                    placeholder: '',
                    inputClasses: 'input-box',
                    inputLabel: 'Fist Name'
                );

                customInput(
                    'text',
                    'last_name',
                    placeholder: '',
                    inputClasses: 'input-box',
                    inputLabel: 'Last Name'
                );
            ?>
            <button class="blue-button">Create Account</button>
            <span class="create-account-text">Already have account? <a href="<?=BASE_URL . "/login"?>" class="create-account-link">Log In</a></span>
        </div>
    </form>
<?php
}