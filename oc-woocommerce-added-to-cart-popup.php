<?php
/**
* Plugin Name: Cart Popup WooCommerce   
* Description: This plugin allow you to display popup after add to cart action without refreshing page.
* Version: 1.0
* Tested up to: 5.2.2
* Author: Ajay Radadiya
* License: A "GNUGPLv3" license name 
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
  die('-1');
}

if (!defined('OCWATCP_PLUGIN_NAME')) {
  define('OCWATCP_PLUGIN_NAME', 'WooCommerce Added to Cart Popup');
}
if (!defined('OCWATCP_PLUGIN_VERSION')) {
  define('OCWATCP_PLUGIN_VERSION', '1.0');
}
if (!defined('OCWATCP_PLUGIN_FILE')) {
  define('OCWATCP_PLUGIN_FILE', __FILE__);
}
if (!defined('OCWATCP_PLUGIN_DIR')) {
  define('OCWATCP_PLUGIN_DIR',plugins_url('', __FILE__));
}

if (!defined('OCWATCP_DOMAIN')) {
  define('OCWATCP_DOMAIN', 'ocwatcp');
}

//Main class
//Load required js,css and other files

if (!class_exists('OCWATCP')) {

  class OCWATCP {

    protected static $OCWATCP_instance;

      function __construct() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        //check plugin activted or not
        add_action('admin_init', array($this, 'OCWATCP_check_plugin_state'));
      }

    //Add JS and CSS on Backend
    function OCWATCP_load_admin_script_style() {
      wp_enqueue_style( 'ocwatcp_admin_css', OCWATCP_PLUGIN_DIR . '/assets/css/ocwatcp-admin.css', false, '1.0.0' );
      wp_enqueue_script( 'ocwatcp_admin_js', OCWATCP_PLUGIN_DIR . '/assets/js/ocwatcp-admin_js.js', false, '1.0.0' );
    }

    //Add JS and CSS on Frontend
    function OCWATCP_load_front_script_style() {

      wp_enqueue_script( 'ocwatcp_front_js', OCWATCP_PLUGIN_DIR . '/assets/js/ocwatcp-front_js.js', false, '1.0.0' );
      wp_enqueue_style( 'ocwatcp_front_css', OCWATCP_PLUGIN_DIR . '/assets/css/ocwatcp-front.css', false, '1.0.0' );
      wp_localize_script('ocwatcp_front_js','ocwatcp_cp_localize',array(
        'adminurl'        => admin_url( 'admin-ajax.php' ),
        'homeurl'       => get_bloginfo('url'),
        'wc_ajax_url'     => WC_AJAX::get_endpoint( "%%endpoint%%" ),
        'template_url' => OCWATCP_PLUGIN_DIR,
      ));

    }

    function OCWATCP_show_notice() {

        if ( get_transient( get_current_user_id() . 'ocwatcperror' ) ) {

          deactivate_plugins( plugin_basename( __FILE__ ) );

          delete_transient( get_current_user_id() . 'ocwatcperror' );

          echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';

        }

    }

    function OCWATCP_check_plugin_state(){
      if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
        set_transient( get_current_user_id() . 'ocwatcperror', 'message' );
      }
    }

    function init() {
      add_action( 'admin_notices', array($this, 'OCWATCP_show_notice'));
      add_action('admin_enqueue_scripts', array($this, 'OCWATCP_load_admin_script_style'));
      add_action('wp_enqueue_scripts', array($this, 'OCWATCP_load_front_script_style'));
    }

    //Load all includes files
    function includes() {

      //admin settings
      include_once('includes/ocwatcp-adminsettings.php');

      //functionality
      include_once('includes/ocwatcp-functionality.php');

    }

    //Plugin Rating
    public static function OCWATCP_do_activation() {
      set_transient('ocwatcp-first-rating', true, MONTH_IN_SECONDS);
    }

    public static function OCWATCP_instance() {
      if (!isset(self::$OCWATCP_instance)) {
        self::$OCWATCP_instance = new self();
        self::$OCWATCP_instance->init();
        self::$OCWATCP_instance->includes();

      }
      return self::$OCWATCP_instance;
    }

  }

  add_action('plugins_loaded', array('OCWATCP', 'OCWATCP_instance'));

  register_activation_hook(OCWATCP_PLUGIN_FILE, array('OCWATCP', 'OCWATCP_do_activation'));
}
