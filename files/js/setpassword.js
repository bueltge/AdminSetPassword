jQuery(document).ready(function($) {
    // Allow admin to set password directly.
    // Include input for new password.
    var frm = $('form[action="manage_user_reset.php"]');
    $('<div class="adminsetpassword" style="position:absolute;margin:40px 0 0 0;width:100%;"><input type="password" id="new_passw" class="input-sm" /><input type="submit" value="Change password" class="btn btn-primary btn-white btn-round" id="submit_newpassw" /></div>').prependTo(frm);

    $('#submit_newpassw').on('click', function() {
        var sel = $('#new_passw');

        if (sel.val().length > 5) {
            $.post(
            'plugins/AdminSetPassword/pages/ajax.php',
            {user_id: $('input[name="user_id"]').val(),
                new_passw:sel.val(),
                manage_user_reset_token:$('input[name="manage_user_reset_token"]').val()
            }
        ).done(function(data) {
                sel.val('');
                alert('New password has been set successfully.');
                console.log('Data Loaded: ' + data);
            });
        } else {
            alert('Enter a password with at least 6 characters.');
        }

        return false;
    });
});