<?php
/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Design_Kit_Config' ) ) {

	/**
	 * Define Jet_Design_Kit_Config class
	 */
	class Jet_Design_Kit_Config {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Config holder
		 *
		 * @var array
		 */
		private $config = array();


		/**
		 * Constructor for the class
		 */
		public function __construct() {

			// register default config
			$this->config =  array(
				'dashboard_page_name' => esc_html__( 'Design Kit', 'jet-design-kit' ),
				'documentation' => 'https://documentation.zemez.io/wordpress/index.php?project=crocoblock&lang=en&section=crocoblock-jetthemecore',
				'editor' => array(
					'template_before' => '',
					'template_after'  => '',
				),
				'library_button' => esc_html__( 'Magic Button', 'jet-design-kit' ),
				'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzYiIGhlaWdodD0iMzQiIHZpZXdCb3g9IjAgMCAzNiAzNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyLjQxMDMgNi4yMDUyNUMxNC4xMjM5IDYuMjA1MjUgMTUuNTEyOSA0LjgxNjA2IDE1LjUxMjkgMy4xMDI2M0MxNS41MTI5IDEuMzg5MiAxNC4xMjM5IDEuNDY5NjhlLTA4IDEyLjQxMDMgMS40Njk2OGUtMDhDMTIuNDA3NSAxLjQ2OTY4ZS0wOCAxMi40MDQ4IDAuMDAwNDA1NTMxIDEyLjQwMiAwLjAwMDQwNTUzMUM1LjU1MTkyIDAuMDA0ODY2NTMgLTIuMDExMTRlLTA4IDUuNTU5MjIgLTIuMDExMTRlLTA4IDEyLjQxMDVDLTIuMDExMTRlLTA4IDE5LjI2NDYgNS41NTYzOCAyNC44MjA4IDEyLjQxMDMgMjQuODIwOEMxNC4xMjM5IDI0LjgyMDggMTUuNTEyOSAyMy40MzE2IDE1LjUxMjkgMjEuNzE4MkMxNS41MTI5IDIwLjAwNDggMTQuMTIzOSAxOC42MTU2IDEyLjQxMDMgMTguNjE1NkMxMi40MDkzIDE4LjYxNTYgMTIuNDA4NSAxOC42MTU4IDEyLjQwNzUgMTguNjE1OEM4Ljk4MTgyIDE4LjYxNDEgNi4yMDUwNSAxNS44MzY2IDYuMjA1MDUgMTIuNDEwNUM2LjIwNTA1IDguOTgzNDQgOC45ODMyNCA2LjIwNTI1IDEyLjQxMDMgNi4yMDUyNVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDkgNCkiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=',
				'library' => array(
					'version' => '1.0.0',
					'tabs'    => array(
						'jet_section' => '',
						'jet_page'    => '',
					),
					'keywords' => array(),
				),
				'tabs'  => array(
					'jet_home_pages'    => array(
						'title'    => __( 'Home Pages', 'jet-design-kit' ),
						'data'     => array(),
						'sources'  => array( 'jet-theme', 'jet-api' ),
						'settings' => array(
							'show_title'    => true,
							'show_keywords' => true,
						),
					),
					'jet_sub_pages'    => array(
						'title'    => __( 'Sub Pages', 'jet-design-kit' ),
						'data'     => array(),
						'sources'  => array( 'jet-theme', 'jet-api' ),
						'settings' => array(
							'show_title'    => true,
							'show_keywords' => true,
						),
					),
					'jet_section' => array(
						'title'    => __( 'Sections', 'jet-design-kit' ),
						'data'     => array(),
						'sources'  => array( 'jet-theme', 'jet-api' ),
						'settings' => array(
							'show_title'    => true,
							'show_keywords' => true,
						),
					),
				),
				'guide' => array(
					'enabled' => true,
					'title'   => __( 'Learn More About CrocoBlock', 'jet-design-kit' ),
					'content' => __( 'Here you can get all the necessary information, detailed instructions and latest news.', 'jet-design-kit' ),
					'links'   => array(
						'documentation' => array(
							'label'  => __( 'Check documentation', 'jet-design-kit' ),
							'type'   => 'primary',
							'target' => '_blank',
							'icon'   => 'dashicons-welcome-learn-more',
							'desc'   => __( 'Get more info from documentation', 'jet-design-kit' ),
							'url'    => 'http://documentation.zemez.io/wordpress/index.php?project=crocoblock',
						),
						'knowledge-base' => array(
							'label'  => __( 'Knowledge Base', 'jet-design-kit' ),
							'type'   => 'primary',
							'target' => '_blank',
							'icon'   => 'dashicons-sos',
							'desc'   => __( 'Access the vast knowledge base', 'jet-design-kit' ),
							'url'    => 'https://zemez.io/wordpress/support/knowledge-base/',
						),
						'community' => array(
							'label'  => __( 'Community', 'jet-design-kit' ),
							'type'   => 'primary',
							'target' => '_blank',
							'icon'   => 'dashicons-facebook',
							'desc'   => __( 'Join community to stay tuned to the latest news', 'jet-design-kit' ),
							'url'    => 'https://www.facebook.com/groups/CrocoblockCommunity/',
						),
						'video-tutorials' => array(
							'label' => __( 'View Video', 'jet-design-kit' ),
							'type'   => 'primary',
							'target' => '_blank',
							'icon'   => 'dashicons-format-video',
							'desc'   => __( 'View video tutorials', 'jet-design-kit' ),
							'url'    => 'https://www.youtube.com/watch?v=APz7aaGc2yE&list=PLdaVCVrkty72g_9pu4-tRJ0j_cc01PqUX',
						),
					),
				),
				'api' => array(
					'enabled'   => true,
					'base'      => 'https://jetdesignkit.zemez.io/',
					'path'      => 'wp-json/croco/v1',
					'endpoints' => array(
						'templates'  => '/templates/',
						'keywords'   => '/keywords/',
						'categories' => '/categories/',
						'info'       => '/info/',
						'template'   => '/template/',
						'plugins'    => '/plugins/',
						'plugin'     => '/plugin/',
					),
				),
				'skins' => array(
					'enabeld' => true,
					'synch'   => true,
				),
			);

			/**
			 * Register custom config on this hook
			 */
			do_action( 'jet-design-kit/register-config', $this );
		}

		/**
		 * Register custom config from theme or plugin
		 *
		 * @param  array $config Config to register
		 * @return void
		 */
		public function register_config( $config ) {

			foreach ( $config as $key => $data ) {

				if ( ! empty( $this->config[ $key ] ) ) {
					if ( is_array( $this->config[ $key ] ) ) {
						$this->config[ $key ] = array_merge( $this->config[ $key ], $data );
					} else {
						$this->config[ $key ] = $data;
					}
				} else {
					$this->config[ $key ] = $data;
				}

			}

		}

		/**
		 * Returns config value by key
		 *
		 * @param  string $key Key to get.
		 * @return mixed
		 */
		public function get( $key = '' ) {
			return isset( $this->config[ $key ] ) ? $this->config[ $key ] : false;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}
