<?php
namespace BriefcasewpExtras\Modules\BewSticky;

use Elementor;
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use BriefcasewpExtras\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function __construct() {
		parent::__construct();

		$this->add_actions();
	}

	public function get_name() {
		return 'bew-sticky';
	}

	public function get_script_depends() {
		return [ 'woo-single-product', 'sticky-kit' ];
	}
	
	public function register_controls( Controls_Stack $element ) {
		$element->start_controls_section(
			'section_bew_sticky',
			[
				'label' => __( 'Bew Sticky', 'briefcase-elementor-widgets' ),
				'tab' => Controls_Manager::TAB_ADVANCED,				
			]
		);

		$element->add_control(
			'bew_sticky',
			[
				'label' => __( 'Enable', 'briefcase-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'briefcase-elementor-widgets' ),
				'label_off' => __( 'Off', 'briefcase-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
				'prefix_class'  => 'bew-sticky-'
			]
		);

		$element->end_controls_section();
	}

	private function add_actions() {
				
		add_action( 'elementor/element/column/section_custom_css/before_section_start', [ $this, 'register_controls' ] );	
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'register_controls' ] );		
		add_action( 'elementor/frontend/column/after_render', [ $this, 'after_render_bew_sticky'], 10, 1 );
		add_action( 'elementor/frontend/section/after_render', [ $this, 'after_render_bew_sticky_section'], 10, 1 );
		
	}
	
	public function after_render_bew_sticky($element) {
		$settings 		= $element->get_settings();
		if (isset($settings['bew_sticky'])){
		$bew_sticky     = $settings['bew_sticky'];
		
		if ($bew_sticky) {
		$id = $element->get_id();
		$selector = '".elementor-element-' . $id . '"';		 
		?>
		<script type="text/javascript">
			jQuery(function($) {				
			$(<?php echo $selector; ?>).addClass('bew-sticky'); 
				
			});		
		</script>	
		<?php
		}
		}
	}
	
	public function after_render_bew_sticky_section($element) {
		$settings 		= $element->get_settings();
		if (isset($settings['bew_sticky'])){
		$bew_sticky     = $settings['bew_sticky'];
		
		if ($bew_sticky) {
		$id = $element->get_id();
		$selector = '".elementor-element-' . $id . '"';		 
		?>
		<script type="text/javascript">
			jQuery(function($) {				
			$(<?php echo $selector; ?>).addClass('bew-sticky-section'); 
				
			});		
		</script>	
		<?php
		}
		}
					
	}
		
	public function enqueue_styles() {		
		
	}
		
	public function enqueue_scripts() {

	}
	
	
}
