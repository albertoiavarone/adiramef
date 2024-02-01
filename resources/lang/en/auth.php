<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    //password
    'confirm_password' => 'Please confirm your password before continuing',
    'digit_password' => 'Please digit your password before continuing',
    'set_new_password' => 'Setup New Password',
    'already_reset' => 'Already have reset your password ?',
    'continue' => 'Continue',
    'change_password' => 'Change Password',
    'current_password' => 'Current Password',
    //login
    'new_here' => 'New Here?',
    'login' => 'Login',
    'log_with' => 'Continue with',
    'forgot_password' => 'Forgot Your password?',
    'or' => 'OR',
    'email_placeholder' => 'es. jon.doe@email.com',
    'logout' => 'Logout',
    'logout_info' => 'End Session',
    'placeholder_name' => 'es. John Doe',
    'placeholder_email' => 'es. j.doe@example.com',
    'last_login_at' => 'Last login at',
    //register
    'register' => 'Register',
    'create_account' => 'Create an Account',
    'already_member' => 'I already have a membership',
    'sign_in' => 'Sign in here',
    'name' => 'Name',
    'confirm' => 'Confirm',
    'password_rules' => 'Use 8 or more characters with a mix of letters, numbers &amp; symbols.',
    'agreeTerms' => 'By registering, I confirm that I accept the Terms and Conditions, that I have read the Privacy Policy and that I am at least 18 years old.',
    'terms' => 'Terms and Condintions',

    //forgot-password
    'enter_email' => 'Enter your email to reset your password.',
    'send_link_reset' => 'Send Password Reset Link',

    //two factor auth
    'mf_auth' => 'Two Factor Authentication',
    'mf_auth_info' => 'Add a second level of security',
    'mf_enabled' => 'Two factor Authentication has been enabled.',
    'mf_disabled' => 'Two factor Authentication has been disabled.',
    'mf_enable' => 'Enable',
    'mf_disable' => 'Disable',
    'mf_enabled' => 'Two-factor authentication is on; below the QR code to configure the App (eg Google Authenticator) or the recovery codes if you no longer have the App.',
    'mf_not_enabled' => 'Two Factor Authentication not enabled...',
    'mf_codes' => 'Recovery Codes:',
    'mf_verification' => 'Two Step Verification',
    'mf_enter_code' => 'Please enter your authentication code to login',
    'mf_type_code' => 'Type your 6 digit security code',
    'mf_no_code' => 'Didn’t get the code ?',
    'mf_type_recovery_code' => 'Digit Recovery code',
    'mf_enter_recovery_code' => 'Please enter your recovery code to login',
    'mf_question' => 'What is two-factor authentication and why is it used?',
    'mf_answer' => 'Two-factor authentication (2FA), sometimes referred to as two-step verification or dual-factor authentication, is a security process in which users provide two different authentication factors to verify themselves.
                        <br />2FA is implemented to better protect both a user\'s credentials and the resources the user can access. Two-factor authentication provides a higher level of security than authentication methods that depend on single-factor authentication (SFA),
                        in which the user provides only one factor -- typically, a password or passcode. Two-factor authentication methods rely on a user providing a password as the first factor and a second, different factor -- usually either a security token or a biometric factor,
                        such as a fingerprint or facial scan.<br />Two-factor authentication adds an additional layer of security to the authentication process by making it harder for attackers to gain access to a person\'s devices or online accounts because,
                        even if the victim\'s password is hacked, a password alone is not enough to pass the authentication check.',
    'mf_instructions' => '<p>The best way to secure your accounts is two-factor authentication, or 2FA. This a process that gives web services secondary access to the account owner (you) in order to verify a login attempt. This is how it works: when you log in to a service, you use your mobile phone to verify your identity by either clicking on a texted / emailed link or typing in a number sent by an authenticator app.
                            </p><h4>What are authenticator apps?</h4>
                            <p>Authenticator apps are considered more secure than texting. They also offer flexibility when you’re traveling to a place without cellular service. Popular options include Authy, Google Authenticator, Microsoft Authenticator, and Hennge OTP (iOS only). These apps mostly follow the same procedure when you’re adding a new account: you scan a QR code associated with your account, and it is saved in the app. The next time you log in to your service or app, it will ask for a numerical code; just open up the authenticator app to find the randomly generated code required to get past security.</p>',
    'mf_codes_instructions' => 'If you lose access to your two-factor authentication credentials, you can use this recovery codes to regain access to your account.',
    //verify email
    'verify_email' => 'Verify Your Email Address',
    'verify_email_msg' => 'A fresh verification link has been sent to your email address.',
    'chek_email' => 'We have sent you an email to verify the email address you entered and activate your account.<br />The link in the email is valid for 24 hours.',
    'not_received' => 'If you did not receive the email',
    'verify_resend' => 'click here to request another',

    //provider
    'update_password_oauth' => 'You logged in via ##provider## without typing your password; to set the password for the first time you have to exit the app click on forgotten password',
];
