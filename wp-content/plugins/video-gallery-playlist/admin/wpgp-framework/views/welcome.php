<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Setup Framework Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Welcome' ) ) {
  class WPGP_Welcome{

    private static $instance = null;

    public function __construct() {

      if( WPGP::$premium && ( ! WPGP::is_active_plugin( 'codestar-framework/codestar-framework.php' ) || apply_filters( 'wpgp_welcome_page', true ) === false ) ) { return; }

      add_action( 'admin_menu', array( &$this, 'add_about_menu' ), 0 );
      add_filter( 'plugin_action_links', array( &$this, 'add_plugin_action_links' ), 10, 5 );
      add_filter( 'plugin_row_meta', array( &$this, 'add_plugin_row_meta' ), 10, 2 );

      $this->set_demo_mode();

    }

    // instance
    public static function instance() {
      if ( is_null( self::$instance ) ) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function add_about_menu() {
      add_management_page( 'Codestar Framework', 'Codestar Framework', 'manage_options', 'wpgp-welcome', array( &$this, 'add_page_welcome' ) );
    }

    public function add_page_welcome() {

      $section = ( ! empty( $_GET['section'] ) ) ? $_GET['section'] : '';

      WPGP::include_plugin_file( 'views/header.php' );

      // safely include pages
      switch ( $section ) {

        case 'quickstart':
          WPGP::include_plugin_file( 'views/quickstart.php' );
        break;

        case 'documentation':
          WPGP::include_plugin_file( 'views/documentation.php' );
        break;

        case 'relnotes':
          WPGP::include_plugin_file( 'views/relnotes.php' );
        break;

        case 'support':
          WPGP::include_plugin_file( 'views/support.php' );
        break;

        case 'free-vs-premium':
          WPGP::include_plugin_file( 'views/free-vs-premium.php' );
        break;

        default:
          WPGP::include_plugin_file( 'views/about.php' );
        break;

      }

      WPGP::include_plugin_file( 'views/footer.php' );

    }

    public static function add_plugin_action_links( $links, $plugin_file ) {

      if( $plugin_file === 'codestar-framework/codestar-framework.php' && ! empty( $links ) ) {
        $links['wpgp--welcome'] = '<a href="'. admin_url( 'tools.php?page=wpgp-welcome' ) .'">Settings</a>';
        if( ! WPGP::$premium ) {
          $links['wpgp--upgrade'] = '<a href="http://codestarframework.com/">Upgrade</a>';
        }
      }

      return $links;

    }

    public static function add_plugin_row_meta( $links, $plugin_file ) {

      if( $plugin_file === 'codestar-framework/codestar-framework.php' && ! empty( $links ) ) {
        $links['wpgp--docs'] = '<a href="http://codestarframework.com/documentation/" target="_blank">Documentation</a>';
      }

      return $links;

    }

    public function set_demo_mode() {

      $demo_mode = get_option( 'wpgp_demo_mode', false );

      if( ! empty( $_GET['wpgp-demo'] ) ) {
        $demo_mode = ( $_GET['wpgp-demo'] === 'activate' ) ? true : false;
        update_option( 'wpgp_demo_mode', $demo_mode );
      }

      if( ! empty( $demo_mode ) ) {

        WPGP::include_plugin_file( 'samples/options.samples.php' );

        if( WPGP::$premium ) {

          WPGP::include_plugin_file( 'samples/customize-options.samples.php' );
          WPGP::include_plugin_file( 'samples/metabox.samples.php'           );
          WPGP::include_plugin_file( 'samples/profile-options.samples.php'   );
          WPGP::include_plugin_file( 'samples/shortcoder.samples.php'        );
          WPGP::include_plugin_file( 'samples/taxonomy-options.samples.php'  );
          WPGP::include_plugin_file( 'samples/widgets.samples.php'           );
          WPGP::include_plugin_file( 'samples/comment-metabox.samples.php'   );

        }

      }

    }

  }

  WPGP_Welcome::instance();
}
