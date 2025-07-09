<?php
// Register Theme Settings Page
add_action('admin_menu', function () {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'theme-settings',
        'theme_settings_page',
        'dashicons-admin-generic',
        61
    );
});

// Enqueue Scripts for Media and Repeater Fields
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_media();
    wp_enqueue_script('theme-options-js', get_template_directory_uri() . '/js/theme-options.js', ['jquery'], null, true);
    wp_enqueue_style('theme-options-css', get_template_directory_uri() . '/css/theme-options.css');
});

// Save Settings + Render Page
function theme_settings_page()
{
    if (isset($_POST['submit'])) {
        update_option('theme_logo', sanitize_text_field(wp_unslash($_POST['theme_logo'])));
        update_option('theme_phone', sanitize_text_field(wp_unslash($_POST['theme_phone'])));
        update_option('theme_address', sanitize_textarea_field(wp_unslash($_POST['theme_address'])));
        update_option('theme_fax', sanitize_text_field(wp_unslash($_POST['theme_fax'])));
        update_option('footer_contact_title', sanitize_text_field(wp_unslash($_POST['footer_contact_title'])));
        update_option('footer_reach_title', sanitize_text_field(wp_unslash($_POST['footer_reach_title'])));
        update_option('footer_contact_form_shortcode', wp_kses_post(wp_unslash($_POST['footer_contact_form_shortcode']))); // ✅ fixed

        // Repeater field
        if (isset($_POST['social_links']) && is_array($_POST['social_links'])) {
            $social_links = array_map(function ($item) {
                return [
                    'icon' => sanitize_text_field(wp_unslash($item['icon'])),
                    'url'  => esc_url_raw(wp_unslash($item['url'])),
                ];
            }, wp_unslash($_POST['social_links']));
            update_option('theme_social_links', $social_links);
        }

        echo '<div class="updated"><p>Settings saved!</p></div>';
    }


    // Load saved values
    $logo     = get_option('theme_logo');
    $phone    = get_option('theme_phone');
    $address  = get_option('theme_address');
    $fax      = get_option('theme_fax');
    $socials  = get_option('theme_social_links', []);
    $footer_form = get_option('footer_contact_form_shortcode');
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
                    <td><textarea name="theme_address"><?php echo esc_textarea($address); ?>"></textarea></td>
                </tr>
                <tr>
                    <th><label for="theme_fax">Fax</label></th>
                    <td><input type="text" name="theme_fax" value="<?php echo esc_attr($fax); ?>"></td>
                </tr>
                <tr>
                    <th><label for="footer_contact_title">Footer Contact Section Title</label></th>
                    <td><input type="text" name="footer_contact_title" value="<?php echo esc_attr(get_option('footer_contact_title', 'Contact Us')); ?>" style="width: 300px;"></td>
                </tr>
                <tr>
                    <th><label for="footer_contact_form_shortcode">Footer Contact Form Shortcode</label></th>
                    <td>
                        <input type="text" name="footer_contact_form_shortcode" value="<?php echo esc_attr($footer_form); ?>" style="width:60%;">
                        <p class="description">e.g. <code>[contact-form-7 id="123" title="Footer Contact"]</code></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="footer_reach_title">Footer Reach Section Title</label></th>
                    <td><input type="text" name="footer_reach_title" value="<?php echo esc_attr(get_option('footer_reach_title', 'Reach Us')); ?>" style="width: 300px;"></td>
                </tr>
                <tr>
                    <th>Social Media Links</th>
                    <td>
                        <div id="social-links-wrapper">
                            <?php if (!empty($socials)) : ?>
                                <?php foreach ($socials as $index => $social) : ?>
                                    <div class="social-link-group">
                                        <input type="text" name="social_links[<?php echo $index; ?>][icon]" value="<?php echo esc_attr($social['icon']); ?>" placeholder="FontAwesome Icon (e.g. fab fa-facebook-f)" style="width:45%">
                                        <input type="url" name="social_links[<?php echo $index; ?>][url]" value="<?php echo esc_attr($social['url']); ?>" placeholder="https://example.com" style="width:45%">
                                        <button type="button" class="remove-social button">Remove</button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <button type="button" id="add-social" class="button">Add Social Link</button>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}