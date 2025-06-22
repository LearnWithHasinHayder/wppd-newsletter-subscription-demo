<?php
if (!defined('ABSPATH'))
    exit;

class WPDBDemo_Shortcode {
    public static function init() {
        add_shortcode('newsletter_form', [__CLASS__, 'render_form']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
    }

    public static function enqueue_assets() {
        wp_enqueue_style('wpdbdemo-public', WPDBDEMO_URL . 'public/newsletter.css', [], '1.0');
        wp_enqueue_script('wpdbdemo-public', WPDBDEMO_URL . 'public/newsletter.js', ['jquery'], '1.0', true);
        wp_localize_script('wpdbdemo-public', 'wpdbdemo_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('wpdbdemo_subscribe')
        ]);
    }

    public static function render_form() {
        ob_start(); ?>
        <div class="wpdbdemo-newsletter">
            <form id="wpdbdemo-newsletter-form">
                <h3>Subscribe to our Newsletter</h3>
                <input type="text" name="name" placeholder="Your Name" required />
                <input type="email" name="email" placeholder="Your Email" required />
                <button type="submit">Subscribe</button>
                <div class="wpdbdemo-message"></div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}
WPDBDemo_Shortcode::init();
