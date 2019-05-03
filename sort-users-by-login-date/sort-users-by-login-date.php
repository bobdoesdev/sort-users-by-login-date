<?php

/* Plugin Name: Sort Users By Login Date
 * Description: Adds sortable column for last user login date
 * Version:     1.0.0
 * Author:      Bob O'Brien, Digital Eel, Inc.
 * Author URI:  http://digitaleel.com/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/login-date-column.php';

