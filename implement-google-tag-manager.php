<?php
/**
 * Plugin Name: Implement Google Tag Manager
 * Plugin URI: https://github.com/hamidrezayazdani/implement-google-tag-manager
 * Description: Adds Google Tag Manager script to wp_head and noscript to wp_body_open.
 * Version: 1.0.0
 * Author: HamidReza Yazdani
 * Author URI: https://github.com/hamidrezayazdani/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: implement-google-tag-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Implement_Google_Tag_Manager
 *
 * Main class for adding Google Tag Manager to WordPress.
 */
class Implement_Google_Tag_Manager {

    /**
     * Google Tag Manager ID.
     *
     * @var string
     */
    private $gtm_id = 'GTM-XXXXXXX';

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'wp_head', array( $this, 'add_gtm_script' ) );
        add_action( 'wp_body_open', array( $this, 'add_gtm_noscript' ) );
    }

    /**
     * Adds Google Tag Manager script to wp_head.
     *
     * @return void
     */
    public function add_gtm_script() {
        ?>
        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){
                w[l]=w[l]||[];
                w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
                var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),
                    dl=l!='dataLayer'?'&l='+l:'';
                j.async=true;
                j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
                f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?php echo esc_js( $this->gtm_id ); ?>');
        </script>
        <!-- End Google Tag Manager -->
        <?php
    }

    /**
     * Adds Google Tag Manager noscript to wp_body_open.
     *
     * @return void
     */
    public function add_gtm_noscript() {
        ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $this->gtm_id ); ?>"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        <?php
    }
}

if ( ! function_exists( 'implement_google_tag_manager_init' ) ) {

    /**
     * Initialize the plugin.
     *
     * @return void
     */
    function implement_google_tag_manager_init() {
        new Implement_Google_Tag_Manager();
    }

    add_action( 'plugins_loaded', 'implement_google_tag_manager_init' );
}