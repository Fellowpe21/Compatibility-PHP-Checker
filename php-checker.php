<?php
/*
Plugin Name: Compatibility PHP-Checker
Description: Check PHP compatibility by selecting PHP version.
Author: Felipe V
Author URI: https://felipeviveros.co
Plugin URI: https://github.com/Fellowpe21/Compatibility-PHP-Checker
Version: 2.0
*/

// Add menu item to the dashboard
add_action('admin_menu', 'php_compat_checker_menu');

function php_compat_checker_menu() {
    add_menu_page('PHP Compatibility Checker', 'PHP Compatibility Checker', 'manage_options', 'php-compat-checker', 'php_compat_checker_page', 'dashicons-yes');
}

// Page content
function php_compat_checker_page() {
    ?>
    <div class="wrap">
        <h2>PHP Compatibility Checker</h2>
        <form method="post" action="">
            <label for="php_version">Select PHP Version:</label>
            <select name="php_version" id="php_version">
                <option value="7.4">PHP 7.4</option>
                <option value="8.0">PHP 8.0</option>
                <option value="8.1">PHP 8.1</option>
                <option value="8.2">PHP 8.2</option>
                <option value="8.3">PHP 8.3</option>
            </select>
            <input type="submit" name="check_compat" value="Check Compatibility">
            <?php wp_nonce_field( 'php-compat-check' ); ?>
        </form>
        <?php
        if(isset($_POST['check_compat'])) {
            if ( !isset( $_POST['_wpnonce'] ) || !wp_verify_nonce( $_POST['_wpnonce'], 'php-compat-check' ) ) {
                echo 'Sorry, your nonce did not verify.';
                exit;
            }

            $php_version = $_POST['php_version'];
            // Validate PHP version
            $allowed_versions = array("7.4", "8.0", "8.1", "8.2", "8.3");
            if (!in_array($php_version, $allowed_versions)) {
                echo "Invalid PHP version selected.";
                exit;
            }

            // Execute WP CLI command to check compatibility
            $command = escapeshellcmd("wp php-compat --php_version=$php_version --fields=name,compat");
            $output = shell_exec($command);
            if ($output === null) {
                echo "Error executing command.";
                exit;
            }

            $compatibility = json_decode($output, true);

            // Display compatibility results
            echo "<h3>Compatibility Results:</h3>";
            foreach ($compatibility as $plugin) {
                echo "<strong>" . esc_html($plugin['name']) . "</strong>: " . esc_html($plugin['compat']) . "<br>";
            }

            // Analyze compatibility
            $all_success = true;
            $some_failed = false;
            foreach ($compatibility as $plugin) {
                if ($plugin['compat'] !== 'Success') {
                    $all_success = false;
                    $some_failed = true;
                    break;
                }
            }

            // Display analysis message
            if ($all_success) {
                echo "<p>It is safe to use this PHP version in your current configuration.</p>";
            } elseif ($some_failed) {
                echo "<p>It may NOT be safe to use this PHP version in your current configuration. Please ask the developer of the plugin/theme that didn't pass the test.</p>";
            }

            // Output summary
            echo "<h3>Summary:</h3>";
            echo "<pre>" . esc_html($output) . "</pre>";
        }
        ?>
    </div>
    <?php
}
