=== Compatibility PHP-Checker ===
Contributors: felipev
Tags: php, compatibility, wp-cli
Requires at least: 5.0
Tested up to: 5.9
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Check PHP compatibility and select PHP version alternatives using WP-CLI.

== Description ==

This plugin allows you to check the compatibility of your WordPress plugins, themes, and core with different PHP versions using WP-CLI. It provides a simple interface in the WordPress dashboard where you can select a PHP version and see the compatibility results.

== Installation ==

1. Upload the `php-compat-checker` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to 'PHP Compatibility Checker' in the WordPress dashboard to use the plugin

== Frequently Asked Questions ==

= How do I use this plugin? =

After activating the plugin, go to 'PHP Compatibility Checker' in the WordPress dashboard. Select a PHP version from the dropdown menu and click 'Check Compatibility'. The plugin will display the compatibility results for your plugins, themes, and core.

== Changelog ==

= 2.0 =
* Added support for PHP versions 7.4 and 8.0
* Improved security measures for shell command execution
* Escaped output to prevent XSS vulnerabilities

= 1.0 =
* Initial release

== Upgrade Notice ==

= 2.0 =
This version adds support for PHP versions 7.4 and 8.0 and includes security improvements. It is recommended to upgrade to this version for enhanced compatibility checking.
