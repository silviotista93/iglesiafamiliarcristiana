<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.grandplugin.com
 * @since      1.0.0
 *
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    WPGP_YouTube_Gallery
 * @subpackage WPGP_YouTube_Gallery/public
 * @author     GrandPlugin <help@grandplugin.com>
 */
class WPGP_YouTube_Gallery_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPGP_YouTube_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPGP_YouTube_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( $this->plugin_name . 'darkscroll', plugin_dir_url( __FILE__ ) . 'css/darkscroll.css', array(), $this->version, 'all' );
		wp_register_style( $this->plugin_name . 'minimal', plugin_dir_url( __FILE__ ) . 'css/minimal.css', array(), $this->version, 'all' );
		wp_register_style( $this->plugin_name . 'swiper', plugin_dir_url( __FILE__ ) . 'css/swiper.css', array(), $this->version, 'all' );
		wp_register_style( $this->plugin_name . 'venobox', plugin_dir_url( __FILE__ ) . 'css/venobox.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpgp-youtube-gallery-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WPGP_YouTube_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WPGP_YouTube_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpgp-youtube-gallery-public.js', array( 'jquery' ), $this->version, false );
		wp_register_script( $this->plugin_name . 'spidochetube', plugin_dir_url( __FILE__ ) . 'js/jquery.spidochetube.js', array(), $this->version, false );
		wp_register_script( $this->plugin_name . 'nicescroll', plugin_dir_url( __FILE__ ) . 'js/jquery.nicescroll.min.js', array(), $this->version, false );
		wp_register_script( $this->plugin_name . 'swiper', plugin_dir_url( __FILE__ ) . 'js/swiper.js', array(), $this->version, false );
		wp_register_script( $this->plugin_name . 'venobox', plugin_dir_url( __FILE__ ) . 'js/venobox.min.js', array(), $this->version, false );

	}

}
