<?php
if (!defined('ABSPATH'))
    exit;

class WPDBDemo_Admin {
    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_menu']);
    }

    public static function add_menu() {
        add_menu_page(
            'Newsletter Subscribers',
            'Newsletter',
            'manage_options',
            'wpdbdemo-newsletter',
            [__CLASS__, 'render_page'],
            'dashicons-email-alt2',
            26
        );
    }

    public static function render_page() {
        $subscribers = WPDBDemo_DB::get_subscribers();
        ?>
        <div class="wrap">
            <h1>Newsletter Subscribers</h1>
            <table class="widefat fixed">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subscribed At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($subscribers):
                        foreach ($subscribers as $s): ?>
                            <tr>
                                <td><?php echo esc_html($s->name); ?></td>
                                <td><?php echo esc_html($s->email); ?></td>
                                <td><?php echo esc_html($s->created_at); ?></td>
                            </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="3">No subscribers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
WPDBDemo_Admin::init();
