<?php
/**
 * Plugin Name:			Briefcase Elementor Widgets
 * Plugin URI:			https://briefcasewp.com/briefcase-elementor-widgets
 * Description:			Add some new widgets to the popular free page builder Elementor.
 * Version:				1.8.1
 * Author:				BriefcaseWP
 * Author URI:			https://briefcasewp.com
 * Requires at least:	4.9.0
 * Tested up to:		5.4.2
 *
 * Text Domain: briefcase-elementor-widgets
 * Domain Path: /languages/
 *
 * @package briefcase_Elementor_Widgets
 * @category Core
 * @author BriefcaseWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Briefcase_Elementor_Widgets to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Briefcase_Elementor_Widgets
 */
function Briefcase_Elementor_Widgets() {
	return Briefcase_Elementor_Widgets::instance();
} // End Briefcase_Elementor_Widgets()

Briefcase_Elementor_Widgets();

/**
 * Main Briefcase_Elementor_Widgets Class
 *
 * @class Briefcase_Elementor_Widgets
 * @version	1.0.0
 * @since 1.0.0
 * @package	Briefcase_Elementor_Widgets
 */
final class Briefcase_Elementor_Widgets {
	/**
	 * Briefcase_Elementor_Widgets The single instance of Briefcase_Elementor_Widgets.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;
	
	// Theme Brand
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	 public $brand;	
	 

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token 			= 'briefcase-elementor-widgets';
		$this->plugin_url 		= plugin_dir_url( __FILE__ );
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.8.1';

		define( 'BEW_URL', $this->plugin_url );
		define( 'BEW_PATH', $this->plugin_path );
		define( 'BEW_VERSION', $this->version );
		define( 'BEW_ASSETS_URL', BEW_URL . 'assets/' );
				
		register_activation_hook( __FILE__, array( $this, 'install' ) );
				
		add_action( 'init', array( $this, 'bew_load_plugin_textdomain' ) );
		add_action( 'plugins_loaded', array( $this, 'bew_load_plugin' ) );
		
		add_action( 'init', array( $this, 'bew_setup' ) );
		add_action( 'init', array( $this, 'bew_updater' ), 1 );
		add_action( 'init', array( $this, 'woocommerce_custom_template' ) );
		
		
		// Setup all the things
		add_action( 'init', array( $this, 'metabox_setup' ) );

		// Add new category for Elementor
		add_action( 'elementor/init', array( $this, 'elementor_init' ), 1 );
		
		// Add the action here so that the widgets are always visible
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'bew_widgets_registered' ) );
		
		// On Editor - register Woocommerce frontend hooks - before the Editor init
		add_action( 'admin_action_elementor', [ $this, 'register_wc_hooks' ], 9 );
		
		// Add new icons for Elementor
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'editor_scripts' ), 99999 );
		
		// elementor editor scripts & styles
        add_action('elementor/editor/wp_head', [$this, 'editor_enqueue_scripts']);
		
		// woo scripts setup        
		add_action( 'after_setup_theme', [$this, 'editor_woo_scripts'] );
		
		// Include the jquery on the head
		add_filter('wp_enqueue_scripts', [$this, 'insert_jquery'],1);
		
		// Include the global.js on the head
		add_filter('wp_enqueue_scripts', [$this, 'insert_globaljs'],1);
		
		// Include libs	
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_libs',),1 );	
		
		// Categories Image full
		add_filter( 'subcategory_archive_thumbnail_size', function( $size ) {
			return 'full';
			} );
		// Woo Pagination next-prev style	
		add_filter( 'woocommerce_pagination_args', array( $this, 'pagination_args' ),100 );	
			
		// Edd templates			
		//add_filter('edd_templates_dir', [$this, 'bew_edd_template_dir'],1);
		
		// On Editor
		add_action( 'admin_action_elementor', [ $this, 'session_verify_templates' ], 9 );
		
		// Edit thumbnail size 
		add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
				return array(
						'width'  => 200,
						'height' => 200,
						'crop'   => 0,
				);
			} );			
					
		// Register custom providers on this hook		
		add_action( 'jet-smart-filters/providers/register', [$this, 'register_bew_provider'], 10, 1);
		
		// Deregister elementor swiper 		
		add_action( 'elementor/frontend/after_register_scripts', function() {
			wp_deregister_script( 'swiper' );	
		} );
						
		// Updater 
		include_once( $this->plugin_path .'includes/updater.php' );	
	}

	/**
	 * Initialize License Updater.
	 * Load Updater initialize.
	 * @return void
	 */
	public function bew_updater() {

		// Plugin Updater Code
		if( class_exists( 'BriefcaseWP_Plugin_Updater' ) ) {
			$license	= new BriefcaseWP_Plugin_Updater( __FILE__, 'Elementor Widgets', $this->version, 'BriefcaseWP' );
		}
	}

	/**
	 * Main Briefcase_Elementor_Widgets Instance
	 *
	 * Ensures only one instance of Briefcase_Elementor_Widgets is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Briefcase_Elementor_Widgets()
	 * @return Main Briefcase_Elementor_Widgets instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function bew_load_plugin_textdomain() {
		load_plugin_textdomain( 'briefcase-elementor-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}
	
	/**
	 * Load gettext translate for our text domain.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function bew_load_plugin() {		

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [$this, 'bew_fail_load'] );			
			return;
		}

		$elementor_version_required = '1.4.0';
		if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
			add_action( 'admin_notices', 'bew_fail_load_out_of_date' );
			return;
		}

		$elementor_version_recommendation = '1.4.1';
		if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_recommendation, '>=' ) ) {
			add_action( 'admin_notices', 'bew_admin_notice_upgrade_recommendation' );
		}
		
	}
	
	/**
	 * Show in WP Dashboard notice about the plugin is not activated.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function bew_fail_load() {
		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		$plugin = 'elementor/elementor.php';

		if ( $this->_is_elementor_installed() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

			$message = '<p>' . __( 'Briefcase Elementor Widgets is not working because you need to activate the Elementor plugin.', 'briefcase-elementor-widgets' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'briefcase-elementor-widgets' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

			$message = '<p>' . __( 'Briefcase Elementor Widgets is not working because you need to install the Elementor plugin', 'briefcase-elementor-widgets' ) . '</p>';
			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'briefcase-elementor-widgets' ) ) . '</p>';
		}

		echo '<div class="error"><p>' . $message . '</p></div>';
	}

	function bew_fail_load_out_of_date() {
		if ( ! current_user_can( 'update_plugins' ) ) {
			return;
		}

		$file_path = 'elementor/elementor.php';

		$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
		$message = '<p>' . __( 'Briefcase Elementor Widgets is not working because you are using an old version of Elementor.', 'briefcase-elementor-widgets' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'briefcase-elementor-widgets' ) ) . '</p>';

		echo '<div class="error">' . $message . '</div>';
	}

	function bew_admin_notice_upgrade_recommendation() {
		if ( ! current_user_can( 'update_plugins' ) ) {
			return;
		}

		$file_path = 'elementor/elementor.php';

		$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
		$message = '<p>' . __( 'A new version of Elementor is available. For better performance and compatibility of Briefcase Elementor Widgets, we recommend updating to the latest version.', 'briefcase-elementor-widgets' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'briefcase-elementor-widgets' ) ) . '</p>';

		echo '<div class="error">' . $message . '</div>';
	}
	
	function _is_elementor_installed() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
		
	/**
	 * Setup all the things.
	 * executes for all themes.
	 * @return void
	 */
	public function bew_setup() {
			
		require_once( $this->plugin_path .'/includes/helpers.php' );
		require_once( $this->plugin_path .'/includes/helper.php' );
		require_once( $this->plugin_path .'/includes/new-helper.php' );
		
		if( function_exists( 'EDD' )) { 
		require_once( $this->plugin_path .'/includes/edd/functions-download-details.php' );
		require_once( $this->plugin_path .'/includes/edd/functions-download-author.php' );	
		}
		
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'bew_scripts' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'bew_styles' ) );					
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ) );	
			
		// Todo :: load only one frontend
		require_once( $this->plugin_path .'/includes/frontend.php' );			
		require_once( $this->plugin_path .'/includes/woo-config.php' );	
		require_once( $this->plugin_path .'/includes/bew-template.php' );
		require_once( $this->plugin_path .'/includes/bew-add-to-cart-ajax.php' );
		require_once( $this->plugin_path .'/widgets/classes/products-renderer.php' );
		require_once( $this->plugin_path .'/includes/class-bew-shortcodes.php' );
		
		add_action( 'init', array( 'Bew_Shortcodes', 'init' ), 50 );
			
	}
	
	public function register_wc_hooks() {
		if( class_exists( 'WooCommerce' ) ) { 
			wc()->frontend_includes();
		}
	}
	
	public function woocommerce_custom_template() {
		// get path for templates used in loop
		add_filter( 'wc_get_template_part', function( $template, $slug, $name ) 
		{ 
		// look in plugin/woocommerce/slug-name.php or plugin/woocommerce/slug.php
		if ( $name ) {
			$path = plugin_dir_path( __FILE__ ) . WC()->template_path() . "{$slug}-{$name}.php";    
		} else {
			$path = plugin_dir_path( __FILE__ ) . WC()->template_path() . "{$slug}.php";    
		}
		return file_exists( $path ) ? $path : $template;
		}, 10, 3 );
		// get path for all other templates.
		add_filter( 'woocommerce_locate_template', function( $template, $template_name, $template_path ) 
		{ 
		$path = plugin_dir_path( __FILE__ ) . $template_path . $template_name;  
		return file_exists( $path ) ? $path : $template;
		}, 10, 3 );

	}
		
	function editor_woo_scripts(){
		
            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-lightbox' );
            add_theme_support( 'wc-product-gallery-slider' );        
    }
	
	/**
	* Tweaks pagination arguments.
	*
	* @since 1.0.0
	*/
	public static function pagination_args( $args ) {
		$args['prev_text'] = esc_html__( 'Prev', 'briefcase-elementor-widgets' );
		$args['next_text'] = esc_html__( 'Next', 'briefcase-elementor-widgets' );
		return $args;
	}
		
	/**
	 * Add new category for Elementor.
	 *
	 * @since 1.0.0
	 */
	public function elementor_init() {
		
		$elementor = \Elementor\Plugin::$instance;

		// Add element category in panel
		$elementor->elements_manager->add_category(
			'briefcasewp-elements',
			[
				'title' => 'Briefcasewp' . ' ' . __( 'Elements', 'briefcase-elementor-widgets' ),
				'icon' => 'font',
			],
			1
		);
	}	

	/**
	 * Setup metabox.
	 *
	 * @return void
	 */
	public function metabox_setup() {		
		require_once( BEW_PATH .'/includes/metabox/butterbean/butterbean.php' );
		require_once( BEW_PATH .'/includes/metabox/metabox.php' );				
	}
	
	/**
	 * Session verify.
	 *
	 * @return void
	 */
	public function session_verify_templates() {
		$woo_grid_cache = get_option('woo_grid_cache');	
		if($woo_grid_cache == 1){
			if(!isset($_SESSION)){ 
			session_start();
			}
			if(isset($_SESSION['verify_templates_shop_render'])){ 
			$verify_templates_shop_render = $_SESSION['verify_templates_shop_render'];
			}
			if(isset($_SESSION['verify_templates_cat_render'])){ 
			$verify_templates_cat_render = $_SESSION['verify_templates_cat_render'];
			}
			if(isset($_SESSION['verify_templates_shop'])){ 
			$verify_templates_shop_options = $_SESSION['verify_templates_shop'];
			}
			if(isset($_SESSION['verify_templates_cat'])){ 
			$verify_templates_cat_options = $_SESSION['verify_templates_cat'];
			}
			
			if (!empty($verify_templates_shop_render) || !empty($verify_templates_cat_render) || !empty($verify_templates_shop_options) || !empty($verify_templates_cat_options) ) {
			unset ($_SESSION['verify_templates_shop_render']);
			unset ($_SESSION['verify_templates_cat_render']);
			unset ($_SESSION['verify_templates_shop']);
			unset ($_SESSION['verify_templates_cat']);			
			}
		}
	}
	
	/**
	 * Register Bew provider.
	 *
	 * @param  string $provider_class Provider class name.
	 * @param  string $provider_file  Path to file with provider class.
	 * @return void
	 */
	public function register_bew_provider($bewprovider) {
				
		if (class_exists( 'Jet_Smart_Filters_Providers_Manager' ) ) {

			$provider_class = 'Jet_Smart_Filters_Provider_Bew_Grid';
			$provider_file = BEW_PATH . 'includes/bew-woo-grid.php'; 				
	
			$bewprovider->register_provider( $provider_class, $provider_file );	
		}
	}
	
	/**
	 * Enqueue jquery on the head.
	 *
	 * @since 1.0.0
	 */	 
	function insert_jquery(){
		wp_enqueue_script('jquery', false, array(), false, false);
	}
	
	function insert_globaljs(){
		// Bew General
		wp_enqueue_script( 'bew-general', plugins_url( '/assets/js/bew-general.js', __FILE__ ), [ 'jquery'], false, true );			
	}
		
	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0.0
	 */	 
	public function bew_scripts() {
		
		// Add Fullpage Scripts		
		wp_register_script( 'jquery-slimscroll', plugins_url( '/assets/fullpage/js/jquery.slimscroll.min.js', __FILE__ ), [ 'jquery'], false, false );
		wp_register_script( 'jquery-easings', plugins_url( '/assets/fullpage/js/jquery.easings.min.js', __FILE__ ), [ 'jquery'], false, false );
		wp_register_script( 'jquery-pseudo', plugins_url( '/assets/fullpage/js/jquery.pseudo.js', __FILE__ ), [ 'jquery'], false, false );
		wp_register_script( 'bew-fullpage', plugins_url( '/assets/js/bew-fullpage.js', __FILE__ ), [ 'jquery'], false, false );		
		
		if(	is_plugin_active( 'briefcasewp-extras/briefcasewp-extras.php' )){		
			wp_register_script( 'swiper', plugins_url( '/assets/libs/minified/third-party/js/swiper.min.js', __FILE__ ), array( 'jquery', 'bew-extras-scripts'), '5.4.1', false);
		}else{
			wp_register_script( 'swiper', plugins_url( '/assets/libs/minified/third-party/js/swiper.min.js', __FILE__ ), array( 'jquery'), '5.4.1', false);
		}
				
		if( get_option('fullpage_parallax') == 0 ) { 
		 wp_register_script( 'scrolloverflow', plugins_url( '/assets/fullpage/js/scrolloverflow.min.js', __FILE__ ), [ 'jquery'], false, false );
		 wp_register_script( 'jquery-fullpage', plugins_url( '/assets/fullpage/js/fullpage.js', __FILE__ ), [ 'jquery-slimscroll', 'jquery-easings', 'scrolloverflow'], false, false );
		}		
	
		wp_register_script( 'fullpage-menu', plugins_url( '/assets/js/fullpage-menu.js', __FILE__ ), [ 'jquery'], false, false );		
		
		// Load custom EDD js methods				
		if( function_exists( 'EDD' )) {
			
		wp_register_script( 'bew-edd-grid', plugins_url( '/assets/js/edd-grid.min.js', __FILE__ ), [ 'jquery'], false, true );
		
		}
		
		// Load custom Woocommerce js methods
		if( class_exists( 'WooCommerce' ) ) {
			
		// Woo General	
		wp_register_script( 'woo-general', plugins_url( '/assets/js/woo-general.js', __FILE__ ), array( 'jquery' ), false, true );			
				
		// Single product page		
		if( is_product() || is_singular( 'elementor_library' )) {
		wp_register_script( 'woo-single-product', plugins_url( '/assets/js/woo-single-product.js', __FILE__ ), [ 'jquery'], false, true );		
		}
		
		// Shop page
		wp_register_script( 'woo-shop', plugins_url( '/assets/js/woo-shop.js', __FILE__ ), array( 'jquery' ), false, true );
		
		// Libs
		if( is_shop() ||  is_product_category() || is_product_tag() || is_singular( 'elementor_library' )) {
		wp_register_script( 'isotope', plugins_url( '/assets/libs/isotope/isotope.min.js', __FILE__ ), [ 'jquery' ], false, true );	
		wp_register_script( 'animate-css-grid', plugins_url( '/assets/libs/animate-css-grid/main.js', __FILE__ ), array( 'jquery' ), false, true );
		}
		
		wp_register_script( 'slick-carousel', plugins_url( '/assets/libs/slick-carousel/js/slick.min.js', __FILE__ ), array( 'jquery' ), false, true );	
		
		}
	}	

	/**
	 * Enqueue styles.
	 *
	 * @since 1.0.0
	 */
	public function bew_styles() {
	
		// Load main Briefcase elementor widgets style	
			wp_enqueue_style( 'bew-style', plugins_url( '/assets/css/style.css', __FILE__ ), array());
			
		// Load font awesome style
			wp_enqueue_style( 'font-awesome', plugins_url( '/assets/css/third/font-awesome.min.css', __FILE__ ), array());
			
		// Register simple line icons style
			wp_enqueue_style( 'simple-line-icons', plugins_url( '/assets/css/third/simple-line-icons.min.css', __FILE__ ), array());	
			
		// Load EDD CSS
		if( function_exists( 'EDD' )) { 
		
			// Load main stylesheet
			if ( edd_get_option( 'disable_styles', false ) ) {
				wp_enqueue_style( 'edd-styles', plugins_url( '/assets/css/edd.min.css', __FILE__ ), array());	
			}
					
			$current_theme = wp_get_theme(get_template());
			
			switch ( $current_theme ) {
				case 'OceanWP':	
				// Load OceanWP CSS compatibility			
				wp_enqueue_style( 'bew-edd', plugins_url( '/assets/css/bew-edd.css', __FILE__ ), array( 'edd-styles', 'oceanwp-style'));			
				break;
				case 'Astra':	
				// Load Astra CSS compatibility
				wp_enqueue_style( 'bew-edd', plugins_url( '/assets/css/bew-edd.css', __FILE__ ), array( 'edd-styles', 'astra-theme-css'));						
				break;
				case 'Themedd':	
				// Load Themedd CSS compatibility				
				wp_enqueue_style( 'bew-edd', plugins_url( '/assets/css/bew-edd.css', __FILE__ ), array('themedd'));			
				break;
				default:
				wp_enqueue_style( 'bew-edd', plugins_url( '/assets/css/bew-edd.css', __FILE__ ), array( 'edd-styles'));				  
			}			
		} 
		
		// Load WooCommerce CSS
		if( class_exists( 'WooCommerce' ) ) { 
			
			$current_theme = wp_get_theme(get_template());
			
			switch ( $current_theme ) {
				case 'OceanWP':	
				// Load OceanWP CSS compatibility	
				wp_enqueue_style( 'bew-style-owp', plugins_url( '/assets/css/style-owp.css', __FILE__ ), array('oceanwp-style'));			
				wp_enqueue_style( 'bew-woocommerce', plugins_url( '/assets/css/bew-woocommerce.css', __FILE__ ), array('oceanwp-woocommerce', 'bew-style'));		
				
				break;
				case 'Astra':	
				// Load Astra CSS compatibility	
				wp_enqueue_style( 'bew-woocommerce-astra', plugins_url( '/assets/css/bew-woocommerce-astra.css', __FILE__ ), array('bew-style' , 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general'));
				wp_enqueue_style( 'bew-woocommerce', plugins_url( '/assets/css/bew-woocommerce.css', __FILE__ ), array('bew-style' , 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general'));		
				
				break;
				default:
				wp_enqueue_style( 'bew-woocommerce', plugins_url( '/assets/css/bew-woocommerce.css', __FILE__ ), array('bew-style'));
							  
				}
		}
		
		// If rtl
		if ( is_RTL() ) {
				wp_enqueue_style( 'bew-style-rtl', plugins_url( '/assets/css/rtl.css', __FILE__ ) );
		}

		// Add Fullpage Styles
		wp_enqueue_style( 'bew-fullpage', plugins_url( '/assets/css/bew-fullpage-total.css', __FILE__ ), array());
	}
	
	public function editor_scripts() {
		
		wp_enqueue_style( 'simple-line-icons', plugins_url( '/assets/css/third/simple-line-icons.min.css', __FILE__ ), array());
		wp_enqueue_style( 'editor-fix', plugins_url( '/assets/css/editor-fix.css', __FILE__ ), array());
		
	}
	
	function editor_enqueue_scripts(){
		
		wp_enqueue_script('woo-grid-editor',plugins_url( '/assets/js/woo-grid-editor.js', __FILE__ ),array('jquery') );
			
	}

	function admin_enqueue_styles(){
		
		wp_enqueue_style( 'bew-admin-style', plugins_url( '/assets/css/bew-admin.css', __FILE__ ), array());	
			
	}	
	
	public function enqueue_libs() {	
		
		if( class_exists( 'WooCommerce' ) ) {
						
			//  Enqueue Bew Icons: pe-icon-7-stroke, Ionicons, Themify-icons			
			wp_enqueue_style( 'bew-font-icons', plugins_url( '/assets/libs/minified/bew-font-icons/css/bew-font-icons.min.css', __FILE__ ), array());
			
			// Enqueue third-party CSS: perfect-scrollbar, select2, hint-css, jquery-nice-select,slick-css						
			wp_enqueue_style( 'bew-third-party-styles', plugins_url( '/assets/libs/minified/third-party/css/third-party.min.css', __FILE__ ), array());	
			
			// Enqueue jQuery plugins: devbridge-autocomplete, select2, perfect-scrollbar, ticky-kit, jquery-nice-select				
			wp_enqueue_script( 'bew-third-party-scripts', plugins_url( '/assets/libs/minified/third-party/js/third-party-scripts.min.js', __FILE__ ), array( 'jquery' ), null, true );							

			// Enqueue Ajax Grid Product						
			wp_enqueue_script( 'bew-shortcodes', plugins_url( '/assets/js/bew-shortcodes.js', __FILE__ ), array( 'jquery', 
			'wp-util' ), null, true );			
		}
	}
				
	/**
	 * Register the widgets
	 *
	 * @since 1.0.0
	 */
	public function bew_widgets_registered() {

		// We check if the Elementor plugin has been installed / activated.
		if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {

			// Define dir
			$dir = $this->plugin_path .'widgets/';			

			// Array of new widgets			
			if( function_exists( 'EDD' )) { 
			$build_widgets = apply_filters( 'bew_widgets', array(
				
				'bew_fullpage' 					=> $dir .'bew_fullpage.php',								
				'bew_menu' 						=> $dir .'bew_menu.php',				
				'edd_menu_cart' 				=> $dir .'edd_menu_cart.php',
				'edd_grid' 						=> $dir .'edd_grid.php',
				'edd_dynamic_field' 			=> $dir .'edd_dynamic_field.php',
				
			) );
			}
			
			if( class_exists( 'WooCommerce' ) ) { 
				$build_widgets = apply_filters( 'bew_widgets', array(					
					'bew_fullpage' 					=> $dir .'bew_fullpage.php',								
					'bew_menu' 						=> $dir .'bew_menu.php',										
					'woo_menu_cart' 				=> $dir .'woo_menu_cart.php',
					'woo_grid' 						=> $dir .'woo_grid.php',
					'woo_dynamic_field' 			=> $dir .'woo_dynamic_field.php',
					'woo_search' 					=> $dir .'woo_search.php',
					'woo_buy_now' 					=> $dir .'woo_buy_now.php',
					'woo_button' 					=> $dir .'woo_button.php',
				) );				
			}
			
			if( ! class_exists( 'WooCommerce') && ! function_exists( 'EDD' )) { 
				$build_widgets = apply_filters( 'bew_widgets', array(				
					'bew_fullpage' 					=> $dir .'bew_fullpage.php',								
					'bew_menu' 						=> $dir .'bew_menu.php',					
				) );
			}
			
			// Load files
			foreach ( $build_widgets as $widget_filename ) {
				include $widget_filename;
			}
		}
	}

} // End Class