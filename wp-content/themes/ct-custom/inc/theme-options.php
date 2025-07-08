<?php
// Theme Options Panel

// Register Theme Settings Page in Admin Menu
add_action('admin_menu', function () {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'theme-settings',
        'theme_settings_page'
    );
});

// Enqueue Media Uploader Script
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_media();
    wp_enqueue_script('theme-options-js', get_template_directory_uri() . '/assets/js/theme-options.js', ['jquery'], null, true);
});

// Render Settings Page
function theme_settings_page()
{
    if (isset($_POST['submit'])) {
        update_option('theme_logo', $_POST['theme_logo']);
        update_option('theme_phone', sanitize_text_field($_POST['theme_phone']));
        update_option('theme_address', sanitize_textarea_field($_POST['theme_address']));
        update_option('theme_fax', sanitize_text_field($_POST['theme_fax']));
        update_option('theme_facebook', esc_url($_POST['theme_facebook']));
        update_option('theme_twitter', esc_url($_POST['theme_twitter']));
        echo '<div class="updated"><p>Settings saved!</p></div>';
    }

    // Load saved values
    $logo = get_option('theme_logo');
    $phone = get_option('theme_phone');
    $address = get_option('theme_address');
    $fax = get_option('theme_fax');
    $facebook = get_option('theme_facebook');
    $twitter = get_option('theme_twitter');
    ?>

    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th><label for="theme_logo">Logo URL</label></th>
                    <td>
                        <input type="text" id="theme_logo" name="theme_logo" value="<?php echo esc_attr($logo); ?>" style="width:300px;">
                        <button class="upload_logo button">Upload</button>
                    </td>
                </tr>
                <tr>
                    <th><label for="theme_phone">Phone</label></th>
                    <td><input type="text" name="theme_phone" value="<?php echo esc_attr($phone); ?>"></td>
                </tr>
                <tr>
                    <th><label for="theme_address">Address</label></th>
                    <td><textarea name="theme_address"><?php echo esc_textarea($address); ?></textarea></td>
                </tr>
                <tr>
                    <th><label for="theme_fax">Fax</label></th>
                    <td><input type="text" name="theme_fax" value="<?php echo esc_attr($fax); ?>"></td>
                </tr>
                <tr>
                    <th><label for="theme_facebook">Facebook</label></th>
                    <td><input type="url" name="theme_facebook" value="<?php echo esc_attr($facebook); ?>"></td>
                </tr>
                <tr>
                    <th><label for="theme_twitter">Twitter</label></th>
                    <td><input type="url" name="theme_twitter" value="<?php echo esc_attr($twitter); ?>"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}