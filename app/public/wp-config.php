<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eF3rZpw753Q0HMW4TxxIDf3fSQdOZnbDvu1rwbwFdQzBJ501+wf2CCaiccv8rn5SQ714T+BOgLpl1IiS/1WjiA==');
define('SECURE_AUTH_KEY',  'wdsQ/m/b0bUTh+Mxj0Y4wac8GXuC3A9uUJ+N1HkbZcUQLm89RtNjY2z+zBKQGeBPN88M9HkHXFL/A7INuf8UPw==');
define('LOGGED_IN_KEY',    'SQWXXWwpnsmaEsMu0KUT//YfWBhWmKDkd4KjVTlnPM8KF9vhQ5Cm+ECxENcBXZ4DFLrRMMsj3Sk23z4A+NjKVg==');
define('NONCE_KEY',        'rTniHLsrsdd+Vgdi89C5i6KGM6lIOXue8+jZGa+yJmz/QkftO36x3oHuucDDRvH3UFKLPT51RQ7xoTZEwhJ9GQ==');
define('AUTH_SALT',        '7Y22ylFHSQc+0zNUsc1NI5m3tsbHxF2i7X/ZqUP7tBvoOZShcl8D9uUpKuiBpAZewTNRTo+DDy+si8A7eaRO8A==');
define('SECURE_AUTH_SALT', 'QO6jxifwiD3fC7PWKoOlum7zTgz1bLX2sec6Zf6y1UI5d2FecSnUznL4m1OQMe1tg8uqbhjLP16VtwVVFXeJzw==');
define('LOGGED_IN_SALT',   'q/7vyZhDXj77LQgPXMZRNHuikjTMQPk3FNRge69nHkqq3j8otJhc/frHFz1rgagwZaqg9o3+fsPdfcy5jUNAjQ==');
define('NONCE_SALT',       'RWVQJF4XoqhuaYNHfb6nu0qlBdoc7NdpW6PF94RxTmwbiwn6nm4W6uJbqorp/OotIyW9RcfE9WCDSKAkLkvIeA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
