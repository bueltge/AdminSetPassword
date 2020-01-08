<?php
require_once dirname(dirname(dirname(__DIR__))).DIRECTORY_SEPARATOR.'core.php';
form_security_validate('manage_user_reset');
$f_user_id = gpc_get_int('user_id');
$f_user_passw = gpc_get_string('new_passw');

echo [
    's1' => plugin_lang_get('change_password'),
    's3' =>  plugin_lang_get('password_length'),
    's2' =>  plugin_lang_get('password_success'),
];
if ($f_user_passw) {
    user_set_password($f_user_id, $f_user_passw);
    echo 'New password set for user_id'.' '.$f_user_id;

    return;
}
echo 'Cannot set any password!';
