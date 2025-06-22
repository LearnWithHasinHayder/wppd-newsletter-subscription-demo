<?php
if (!defined('ABSPATH'))
    exit;

class WPDBDemo_DB {
    public static $table_name = '';

    public static function table_name() {
        global $wpdb;
        if (!self::$table_name) {
            self::$table_name = $wpdb->prefix . 'wpdbdemo_newsletter';
        }
        return self::$table_name;
    }

    public static function create_table() {
        global $wpdb;
        $table = self::table_name();
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY email (email)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function insert_subscriber($name, $email) {
        global $wpdb;
        return $wpdb->insert(
            self::table_name(),
            ['name' => $name, 'email' => $email],
            ['%s', '%s']
        );
    }

    public static function get_subscribers() {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM " . self::table_name() . " ORDER BY created_at DESC");
    }
}
// Ensure table is always up to date for all users
add_action('admin_init', ['WPDBDemo_DB', 'create_table']);
