<?php

/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );

/**
 * Functions
 *
 * @package      DavidMadow
 * @author       PressedSolutions/Andrew Minion <andrew@andrewrminion.com>
 * @copyright    Copyright (c) 2014, Pressed Solutions
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions
 * to the correct actions and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {
