<?php
if (!defined('ABSPATH'))
    exit;

class WPDBDemo_Ajax {
    public static function init() {
        add_action('wp_ajax_wpdbdemo_subscribe', [__CLASS__, 'handle_subscribe']);
        add_action('wp_ajax_nopriv_wpdbdemo_subscribe', [__CLASS__, 'handle_subscribe']);
    }

    public static function handle_subscribe() {
        check_ajax_referer('wpdbdemo_subscribe', 'nonce');
        $name = sanitize_text_field($_POST['name'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        if (!$name || !$email || !is_email($email)) {
            wp_send_json_error(['message' => 'Invalid input.']);
        }
        $result = WPDBDemo_DB::insert_subscriber($name, $email);
        if ($result) {
            wp_send_json_success(['message' => 'Subscribed successfully!']);
        } else {
            wp_send_json_error(['message' => 'Email already subscribed or DB error.']);
        }
    }
}
WPDBDemo_Ajax::init();
