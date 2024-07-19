<?php
/*
* Plugin Name: Restapicurd
* Description: Restapicurd to explain the crud functionality.
* Version: 1.0
* Author: Feroz
*/
function loadMyBlockFiles() {
    wp_enqueue_script('my-super-unique-handle', plugin_dir_url(__FILE__) . 'my-block.js',
      array('wp-blocks', 'wp-i18n', 'wp-editor'), true);
  }
  add_action( 'enqueue_block_editor_assets', 'loadMyBlockFiles');
?>