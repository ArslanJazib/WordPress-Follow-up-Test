<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>

        </main><!-- #content -->

        <footer id="colophon" class="site-footer py-5">
            <div class="container">
                <div class="row">

                    <!-- Contact Form Column -->
                    <div class="col-md-6 mb-4">
                        <h4 class="section-heading text-orange border-bottom border-3 border-dark pb-2 mb-4"><?php echo get_option('footer_contact_title') ?></h4>
                        <?php
                        $footer_form_shortcode = get_option('footer_contact_form_shortcode');
                        if (!empty($footer_form_shortcode)) {
                            echo do_shortcode($footer_form_shortcode);
                        } else {
                            echo '<p><em>No contact form configured in Theme Settings.</em></p>';
                        }
                        ?>
                    </div>

                    <!-- Reach Us Column -->
                    <div class="col-md-6 mb-4">
                        <h4 class="section-heading text-orange border-bottom border-3 border-dark pb-2 mb-4"><?php echo get_option('footer_reach_title') ?></h4>
                        <p class="fw-bold mb-1"><?php bloginfo('name'); ?></p>

                        <?php if ($address = get_option('theme_address')) : ?>
                            <p class="mb-1"><?php echo nl2br(esc_html($address)); ?></p>
                        <?php endif; ?>

                        <?php if ($phone = get_option('theme_phone')) : ?>
                            <p class="mb-1">Phone: <?php echo esc_html($phone); ?></p>
                        <?php endif; ?>

                        <?php if ($fax = get_option('theme_fax')) : ?>
                            <p>Fax: <?php echo esc_html($fax); ?></p>
                        <?php endif; ?>

                        <!-- Social Icons (from repeater) -->
                        <?php
                        $social_links = get_option('theme_social_links', []);
                        if (!empty($social_links)) :
                        ?>
                            <div class="social-icons mt-3">
                                <?php foreach ($social_links as $social) :
                                    if (!empty($social['url']) && !empty($social['icon'])) :
                                        ?>
                                        <a target="_blank" href="<?php echo esc_url($social['url']); ?>" class="me-2 text-dark" target="_blank">
                                            <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                                        </a>
                                    <?php endif;
                                endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div><!-- .row -->

                <!-- Copyright -->
                <div class="text-center pt-3 border-top mt-4 small text-muted">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.
                </div>
            </div><!-- .container -->
        </footer><!-- #colophon -->

    </div><!-- #page -->

    <?php wp_footer(); ?>

</body>
</html>
