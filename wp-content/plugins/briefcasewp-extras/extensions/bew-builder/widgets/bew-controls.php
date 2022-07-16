<?php
namespace BriefcasewpExtras\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bew_Controls {


	/**
	 * Add a list of controls to the section
	 */
	public static function add( $controls, $widget, $id ) {
		foreach ( $controls as $name => $arg ) {
			$method = 'add_'. $name;
			self::$method( $widget, $id, $arg );
		}
	}


	/**
	 * Open a section to add controls
	 */
	public static function start_section( $widget, $name, $id, $arg=[] ) {
		$title = str_replace( '_', ' ', $name );
		$title = ucfirst( $title );
		if ( isset( $arg['section_title'] ) ) {
			$title = $arg['section_title'];
		}


		$condition['type'] = 'type-'. $id;
		if ( isset( $arg['section_condition'] ) ) {
			$condition = array_merge( $condition, $arg['section_condition'] );
		}

		$widget->start_controls_section(
			'section_type_'. $id .'_'. $name,
			[
				'label' => $title,
				'tab' => Controls_Manager::TAB_SETTINGS,
				'condition' => $condition,
			]
		);
	}


	/**
	 * Close the opened section
	 */
	public static function end_section( $widget ) {
		$widget->end_controls_section();
	}


	/**
	 * Section ID
	 */
	public static function add_section_id( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Section ID', 'briefcasewp-extras' ), $arg, [
				'label_block' => false,
				'description' => '<a href="http://briefcasewp.com" target="_blank">How can I scroll to this section?</a>',
			] )
		);
	}


	/**
	 * Small text
	 */
	public static function add_small_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Small text', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Header text
	 */
	public static function add_header_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Header text', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Lead text
	 */
	public static function add_lead_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_textarea( esc_html__( 'Lead text', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Fade text
	 */
	public static function add_fade_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Fade text', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Text
	 */
	public static function add_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_textarea( esc_html__( 'Text', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Info text
	 */
	public static function add_info_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Text', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Button text
	 */
	public static function add_btn_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Text', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Button 2 text
	 */
	public static function add_btn2_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Text', 'briefcasewp-extras' ), $arg)
		);
	}



	/**
	 * Stars text
	 */
	public static function add_stars_text( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Text', 'briefcasewp-extras' ), $arg)
		);
	}




	/**
	 * Flash down target
	 */
	public static function add_flash_down_target( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Flash down target', 'briefcasewp-extras' ), $arg, [
				'placeholder' => esc_html__( 'Section ID', 'briefcasewp-extras' ),
				'label_block' => false,
			])
		);
	}


	/**
	 * Info link
	 */
	public static function add_info_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_url( esc_html__( 'Link', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Button link
	 */
	public static function add_btn_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_url( esc_html__( 'Link', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Button 2 link
	 */
	public static function add_btn2_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_url( esc_html__( 'Link', 'briefcasewp-extras' ), $arg)
		);
	}


	/**
	 * Apple store link
	 */
	public static function add_apple_store_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_url( esc_html__( 'Apple store link', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * Google play link
	 */
	public static function add_google_play_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_url( esc_html__( 'Google Play Link', 'briefcasewp-extras' ), $arg )
		);
	}

	/**
	 * Video link
	 */
	public static function add_video_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( empty($arg['description']) ) {
			$arg['description'] = esc_html__( 'Supports YouTube and Vimeo', 'briefcasewp-extras' );
		}

		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Video URL', 'briefcasewp-extras' ), $arg )
		);
	}



	/**
	 * Form action link
	 */
	public static function add_form_action_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'Form Action URL', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * MailChimp form link
	 */
	public static function add_mailchimp_form_link( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_text( esc_html__( 'MailChimp Form URL', 'briefcasewp-extras' ), $arg, [
				'description'   => '<a href="https://briefcasewp.com/docs/mailchimp-integration/" target="_blank">'. esc_html__( 'What is this?', 'briefcasewp-extras' ) .'</a>',
			])
		);
	}



	/**
	 * Background gray
	 */
	public static function add_bg_gray( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'bg-gray';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Background gray', 'briefcasewp-extras' ), $arg, [
				'return' => 'bg-gray',
			] )
		);
	}


	/**
	 * Border bottom
	 */
	public static function add_border_bottom( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'bb-1';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Border bottom', 'briefcasewp-extras' ), $arg, [
				'return' => 'bb-1',
			] )
		);
	}


	/**
	 * Section inverse
	 */
	public static function add_section_inverse( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'section-inverse';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Light text colors', 'briefcasewp-extras' ), $arg, [
				'return' => 'section-inverse',
			] )
		);
	}


	/**
	 * Header inverse
	 */
	public static function add_header_inverse( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'header-inverse';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Light text colors', 'briefcasewp-extras' ), $arg, [
				'return' => 'header-inverse',
			] )
		);
	}


	/**
	 * Wide container
	 */
	public static function add_wide_container( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = '-wide';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Wide container', 'briefcasewp-extras' ), $arg, [
				'return' => '-wide',
			] )
		);
	}


	/**
	 * Switch sides
	 */
	public static function add_switch_sides( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'yes';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Switch sides', 'briefcasewp-extras' ), $arg, [
				'return' => 'yes',
			] )
		);
	}


	/**
	 * Display flash down
	 */
	public static function add_flash_down( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'yes';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Display Flash Down', 'briefcasewp-extras' ), $arg, [
				'return' => 'yes',
			] )
		);
	}


	/**
	 * Inverse flash down
	 */
	public static function add_flash_down_inverse( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'scroll-down-inverse';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Flash down inverse', 'briefcasewp-extras' ), $arg, [
				'return' => 'scroll-down-inverse',
			] )
		);
	}


	/**
	 * Flash down top padding
	 */
	public static function add_flash_down_padding_top( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'scroll-down-inverse';
		}

    $widget->add_control(
      $name,
      [
        'label' => esc_html__( 'Padding top', 'briefcasewp-extras' ),
        'type' => Controls_Manager::SLIDER,
        'default' => [
          'size' => isset( $arg['default'] ) ? $arg['default'] : 0,
          'unit' => 'px',
        ],
        'size_units' => [ 'px' ],
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 500,
            'step' => 5,
          ],
        ],
      ]
    );

	}
	
	/**
	 * Flash down style
	 */
	public static function add_flash_down_style( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

    $widget->add_control(
      $name,
      [
		'label' => esc_html__( 'Style', 'briefcasewp-extras' ),
		'type' => Controls_Manager::SELECT,
		'default' => isset( $arg['style'] ) ? $arg['style'] : 'scroll-down-1',
		'options' => [
			'scroll-down-1'   => esc_html__( 'Default', 'briefcasewp-extras' ),
			'scroll-down-2'   => esc_html__( 'Arrow 2', 'briefcasewp-extras' ),
			'scroll-down-3'   => esc_html__( 'Arrow 3', 'briefcasewp-extras' ),
			'scroll-down-4'   => esc_html__( 'Mouse', 'briefcasewp-extras' ),
			'scroll-down-5'   => esc_html__( 'Mouse Animated', 'briefcasewp-extras' ),
		],
	  ]
    );

	}


	/**
	 * Shadowed image
	 */
	public static function add_image_shadow( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'shadow-3';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Image shadow', 'briefcasewp-extras' ), $arg, [
				'return' => 'shadow-3',
			] )
		);
	}


	/**
	 * Button round
	 */
	public static function add_btn_round( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'btn-round';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Round style', 'briefcasewp-extras' ), $arg, [
				'return' => 'btn-round',
			] )
		);
	}


	/**
	 * Button 2 round
	 */
	public static function add_btn2_round( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'btn-round';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Round style', 'briefcasewp-extras' ), $arg, [
				'return' => 'btn-round',
			] )
		);
	}


	/**
	 * Button outline
	 */
	public static function add_btn_outline( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'btn-outline';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Outline style', 'briefcasewp-extras' ), $arg, [
				'return' => 'btn-outline',
			] )
		);
	}


	/**
	 * Button 2 outline
	 */
	public static function add_btn2_outline( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'btn-outline';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Outline style', 'briefcasewp-extras' ), $arg, [
				'return' => 'btn-outline',
			] )
		);
	}


	/**
	 * Button outline
	 */
	public static function add_btn_block( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'btn-block';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Full width', 'briefcasewp-extras' ), $arg, [
				'return' => 'btn-block',
			] )
		);
	}


	/**
	 * Button 2 outline
	 */
	public static function add_btn2_block( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		if ( isset( $arg['default'] ) ) {
			$arg['default'] = 'btn-block';
		}

		$widget->add_control(
			$name,
			self::option_switch( esc_html__( 'Full width', 'briefcasewp-extras' ), $arg, [
				'return' => 'btn-block',
			] )
		);
	}


	/**
	 * Button color
	 */
	public static function add_btn_color( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$label = esc_html__( 'Color', 'briefcasewp-extras' );

		if ( ! empty($arg['label']) ) {
			$label = $arg['label'];
		}

		$widget->add_control(
			$name,
			self::option_select( $label, $arg, [
				'options' => [
					'btn-primary'   => esc_html__( 'Primary', 'briefcasewp-extras' ),
					'btn-secondary' => esc_html__( 'Secondary', 'briefcasewp-extras' ),
					'btn-info'      => esc_html__( 'Info', 'briefcasewp-extras' ),
					'btn-success'   => esc_html__( 'Success', 'briefcasewp-extras' ),
					'btn-warning'   => esc_html__( 'Warning', 'briefcasewp-extras' ),
					'btn-danger'    => esc_html__( 'Danger', 'briefcasewp-extras' ),
					'btn-white'     => esc_html__( 'White', 'briefcasewp-extras' ),
					'btn-dark'      => esc_html__( 'Dark', 'briefcasewp-extras' ),
					'btn-custom'    => esc_html__( 'Custom', 'briefcasewp-extras' ),
				],
			] )
		);
	}


	/**
	 * Button 2 color
	 */
	public static function add_btn2_color( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_select( esc_html__( 'Color', 'briefcasewp-extras' ), $arg, [
				'options' => [
					'btn-primary'   => esc_html__( 'Primary', 'briefcasewp-extras' ),
					'btn-secondary' => esc_html__( 'Secondary', 'briefcasewp-extras' ),
					'btn-info'      => esc_html__( 'Info', 'briefcasewp-extras' ),
					'btn-success'   => esc_html__( 'Success', 'briefcasewp-extras' ),
					'btn-warning'   => esc_html__( 'Warning', 'briefcasewp-extras' ),
					'btn-danger'    => esc_html__( 'Danger', 'briefcasewp-extras' ),
					'btn-white'     => esc_html__( 'White', 'briefcasewp-extras' ),
					'btn-dark'      => esc_html__( 'Dark', 'briefcasewp-extras' ),
					'btn-custom'    => esc_html__( 'Custom', 'briefcasewp-extras' ),
				],
			] )
		);
	}
	
	/**
	 * Button background color
	 */
	public static function add_btn_custom_color( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		
		$widget->start_controls_tabs( $name .'_tabs_style' );
		
		$widget->start_controls_tab(
			$name .'_tab_normal',
			[
				'label' => __( 'Normal', 'briefcasewp-extras' ),
				'condition' => [
					't'. $id .'_btn_color' => 'btn-custom',
				],
			]
		);
		
		$widget->add_control(
			$name .'_color_normal',
			self::option_color_btn( esc_html__( 'Text Color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom ' => 'color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->add_control(
			$name .'_bg_normal',
			self::option_color_btn( esc_html__( 'Background color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom ' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			$name .'_tab_hover',
			[
				'label' => __( 'Hover', 'briefcasewp-extras' ),
				'condition' => [
					't'. $id .'_btn_color' => 'btn-custom',
				],
			]
		);
		
		$widget->add_control(
			$name .'_color_hover',
			self::option_color_btn( esc_html__( 'Text Color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom:hover ' => 'color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->add_control(
			$name .'_bg_hover',
			self::option_color_btn( esc_html__( 'Background color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom:hover ' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->end_controls_tab();
		$widget->end_controls_tabs();
	}
	
	/**
	 * Button background color
	 */
	public static function add_btn2_custom_color( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		
		$widget->start_controls_tabs( $name .'_tabs_style' );
		
		$widget->start_controls_tab(
			$name .'_tab_normal',
			[
				'label' => __( 'Normal', 'briefcasewp-extras' ),
				'condition' => [
					't'. $id .'_btn2_color' => 'btn-custom',
				],
			]
		);
		
		$widget->add_control(
			$name .'_color_normal',
			self::option_color_btn( esc_html__( 'Text Color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom ' => 'color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn2_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->add_control(
			$name .'_bg_normal',
			self::option_color_btn( esc_html__( 'Background color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom ' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn2_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->end_controls_tab();

		$widget->start_controls_tab(
			$name .'_tab_hover',
			[
				'label' => __( 'Hover', 'briefcasewp-extras' ),
				'condition' => [
					't'. $id .'_btn2_color' => 'btn-custom',
				],
			]
		);
		
		$widget->add_control(
			$name .'_color_hover',
			self::option_color_btn( esc_html__( 'Text Color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom:hover ' => 'color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn2_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->add_control(
			$name .'_bg_hover',
			self::option_color_btn( esc_html__( 'Background color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .btn-custom:hover ' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',					
				],
				'condition' => [
					't'. $id .'_btn2_color' => 'btn-custom',
				],
			] )
		);
		
		$widget->end_controls_tab();
		$widget->end_controls_tabs();
	}
	
	/**
	 * Button size
	 */
	public static function add_btn_size( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_select( esc_html__( 'Size', 'briefcasewp-extras' ), $arg, [
				'options' => [
					'btn-xs'   => esc_html__( 'Extra Small', 'briefcasewp-extras' ),
					'btn-sm'   => esc_html__( 'Small', 'briefcasewp-extras' ),
					''   => esc_html__( 'Medium', 'briefcasewp-extras' ),
					'btn-lg'   => esc_html__( 'Large', 'briefcasewp-extras' ),
					'btn-xl'   => esc_html__( 'Extra Large', 'briefcasewp-extras' ),
				],
			] )
		);
	}


	/**
	 * Button 2 size
	 */
	public static function add_btn2_size( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_select( esc_html__( 'Size', 'briefcasewp-extras' ), $arg, [
				'options' => [
					'btn-xs'   => esc_html__( 'Extra Small', 'briefcasewp-extras' ),
					'btn-sm'   => esc_html__( 'Small', 'briefcasewp-extras' ),
					''   => esc_html__( 'Medium', 'briefcasewp-extras' ),
					'btn-lg'   => esc_html__( 'Large', 'briefcasewp-extras' ),
					'btn-xl'   => esc_html__( 'Extra Large', 'briefcasewp-extras' ),
				],
			] )
		);
	}


	/**
	 * Background color
	 */
	public static function add_bg_color( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_color( esc_html__( 'Background color', 'briefcasewp-extras' ), $arg )
		);
	}
	
	/**
	 * Background content color
	 */
	public static function add_content_bg_color( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
				
		$widget->add_control(
			$name,
			self::option_color_bg_content( esc_html__( 'Background color', 'briefcasewp-extras' ), $arg, [
				'selectors' => [
					'{{WRAPPER}} .bg-custom ' => 'background-color: {{VALUE}};',					
				],
			] )
		);
	}
	
	


	/**
	 * Gradient color - start
	 */
	public static function add_gradient_start( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_color( esc_html__( 'Gradient start', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * Gradient color - end
	 */
	public static function add_gradient_end( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_color( esc_html__( 'Gradient end', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * Image
	 */
	public static function add_image( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_media( esc_html__( 'Image', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * Background image
	 */
	public static function add_bg_image( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_media( esc_html__( 'Background image', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * Gallery
	 */
	public static function add_gallery( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_gallery( esc_html__( 'Images', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * Button width
	 */
	public static function add_btn_width( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_slider( esc_html__( 'Minimum width', 'briefcasewp-extras' ), $arg, [
				'min'  => 0,
				'max'  => 400,
				'step' => 5,
				'default' => isset( $arg['default'] )  ? $arg['default'] : 0,
			] )
		);
	}


	/**
	 * Button 2 width
	 */
	public static function add_btn2_width( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_slider( esc_html__( 'Minimum width', 'briefcasewp-extras' ), $arg, [
				'min'  => 0,
				'max'  => 400,
				'step' => 5,
				'default' => isset( $arg['default'] )  ? $arg['default'] : 0,
			] )
		);
	}


	/**
	 * Overlay
	 */
	public static function add_overlay( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_slider( esc_html__( 'Overlay', 'briefcasewp-extras' ), $arg )
		);
	}


	/**
	 * Stars
	 */
	public static function add_stars( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_slider( esc_html__( 'Filled stars', 'briefcasewp-extras' ), $arg, [
				'min' => 0,
				'max' => 5,
			] )
		);
	}


	/**
	 * Heading size
	 */
	public static function add_heading_size( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$selectors =	isset( $arg['selectors'] )  ? $arg['selectors'] : 'h1';
		$widget->add_responsive_control(
			$name,
			self::option_slider_font( esc_html__( 'Heading font size', 'briefcasewp-extras' ), $arg, [
				'min'  => 10,
				'max'  => 150,
				'default' => isset( $arg['default'] )  ? $arg['default'] : 80,
				'default_unit' => isset( $arg['default_unit'] )  ? $arg['default_unit'] : '%',
				'selectors' => [
					'{{WRAPPER}} ' .$selectors => 'font-size: {{SIZE}}{{UNIT}};',					
				],
			] )
		);
	}
	
	/**
	 * Heading typografy
	 */
	public static function add_heading_typo( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$selectors =	isset( $arg['selectors'] )  ? $arg['selectors'] : 'h1';
		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'titles_typo',
				'label' => __( 'Header Typography', 'briefcasewp-extras' ),
				'selector' 		=> '{{WRAPPER}} ' . $selectors,				
			]
		);
	}
	
	
	/**
	 * Font size
	 */
	public static function add_font_size( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$selectors =	isset( $arg['selectors'] )  ? $arg['selectors'] : 'h1';
		$widget->add_responsive_control(
			$name,
			self::option_slider_font( esc_html__( 'Font size', 'briefcasewp-extras' ), $arg, [
				'min'  => 10,
				'max'  => 150,
				'default' => isset( $arg['default'] )  ? $arg['default'] : 80,
				'default_unit' => isset( $arg['default_unit'] )  ? $arg['default_unit'] : '%',
				'selectors' => [
					'{{WRAPPER}} ' .$selectors => 'font-size: {{SIZE}}{{UNIT}};',					
				],
			] )
		);
	}
	
	/**
	 * Header Width
	 */
	public static function add_header_width( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$selectors =	isset( $arg['selectors'] )  ? $arg['selectors'] : '.widget-container';
		$widget->add_responsive_control(
			$name,
			self::option_slider_font( esc_html__( 'Max Width', 'briefcasewp-extras' ), $arg, [
				'min'  => 500,
				'max'  => 2000,
				'default' => isset( $arg['default'] )  ? $arg['default'] : 80,
				'default_unit' => isset( $arg['default_unit'] )  ? $arg['default_unit'] : 'px',
				'selectors' => [
					'{{WRAPPER}} ' .$selectors => 'max-width: {{SIZE}}{{UNIT}};',					
				],
			] )
		);
	}
	
	/**
	 * Categories height
	 */
	public static function add_categories_height( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$selectors =	isset( $arg['selectors'] )  ? $arg['selectors'] : '.cat-block-2-columns';
		$widget->add_responsive_control(
			$name,
			self::option_slider_font( esc_html__( 'Height', 'briefcasewp-extras' ), $arg, [
				'min'  => 200,
				'max'  => 1400,
				'default' => isset( $arg['default'] )  ? $arg['default'] : 880,
				'tablet_default' => isset( $arg['tablet_default'] )  ? $arg['mobile_default'] : 880,
				'mobile_default' => isset( $arg['mobile_default'] )  ? $arg['mobile_default'] : 320,
				'default_unit' => isset( $arg['default_unit'] )  ? $arg['default_unit'] : 'px',
				'selectors' => [
					'{{WRAPPER}} ' .$selectors . ', {{WRAPPER}} .swiper-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',					
				],
			] )
		);
	}


	/**
	 * Columns
	 */
	public static function add_columns( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_slider( esc_html__( 'Columns', 'briefcasewp-extras' ), $arg, [
				'min'  => isset( $arg['min'] )  ? $arg['min'] : 1,
				'max'  => isset( $arg['max'] )  ? $arg['max'] : 3,
				'default' => isset( $arg['default'] )  ? $arg['default'] : 2,
			] )
		);
	}



	/**
	 * Editor
	 */
	public static function add_uniqid( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			[
				'label' => esc_html__( 'ID', 'briefcasewp-extras' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => uniqid(),
			]
		);

	}



	/**
	 * Editor
	 */
	public static function add_editor( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );
		$widget->add_control(
			$name,
			self::option_wysiwyg( esc_html__( 'Editor', 'briefcasewp-extras' ), $arg )
		);
	}



	/**
	 * Swiper options
	 */
	public static function add_swiper( $widget, $id, $arg = [] ) {
		$name = 't'. $id . substr( __FUNCTION__, 3 );

		$widget->add_control(
			$name .'_autoplay',
			self::option_switch( esc_html__( 'Autoplay slider', 'briefcasewp-extras' ), $arg, [
				'return' => 'yes',
				'default' => 'yes',
			] )
		);

		$widget->add_control(
			$name .'_delay',
			self::option_slider( esc_html__( 'Delay', 'briefcasewp-extras' ), $arg, [
				'min'  => 500,
				'max'  => 10000,
				'step'  => 500,
				'default' => 3000,
				'condition' => [
					$name .'_autoplay' => 'yes',
				],
			] )
		);

	}







	/**
	 * Team members
	 */
	public static function add_team_member( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'image' => [ 'url' => bew_get_img_uri( 'placeholder-avatar.jpg' ) ],
					'name' => esc_html__( 'Morgan Guadis', 'briefcasewp-extras' ),
					'position' => esc_html__( 'Co-Founder & CEO', 'briefcasewp-extras' ),
					'social_twitter' => '#',
					'social_facebook' => '#',
					'social_instagram' => '#',
					'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
				],
			];
		}

		$widget->add_control(
			't'. $id .'_team_member',
			[
				'label' => esc_html__( 'Team members', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'image',
						'label' => esc_html__( 'Image', 'briefcasewp-extras' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => bew_get_img_uri( 'placeholder-avatar.jpg' ),
						],
					],
					[
						'name' => 'name',
						'label' => esc_html__( 'Name', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Hossein Shams' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'position',
						'label' => esc_html__( 'Position', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Co-Founder & CEO' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'biography',
						'label' => esc_html__( 'Biography', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => esc_html__( '' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_facebook',
						'label' => esc_html__( 'Social media links', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Facebook' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_twitter',
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Twitter' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_instagram',
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Instagram' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_linkedin',
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Linkedin' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_dribbble',
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Dribbble' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_github',
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Github' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_telegram',
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Telegram' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'social_xing',
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Xing' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
				],
				'title_field' => '{{{ name }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);
	}



	/**
	 * Testimonials
	 */
	public static function add_testimonials( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'image' => [ 'url' => bew_get_img_uri( 'avatar/1.jpg' ) ],
					'name' => esc_html__( 'Steve Jobs', 'briefcasewp-extras' ),
					'content' => esc_html__( 'When you innovate, you make mistakes. It is best to admit them quickly, and get on with improving your other innovations.', 'briefcasewp-extras' ),
				],
				[
					'image' => [ 'url' => bew_get_img_uri( 'avatar/2.jpg' ) ],
					'name' => esc_html__( 'Bill Gates', 'briefcasewp-extras' ),
					'content' => esc_html__( 'Technology is just a tool. In terms of getting the kids working together and motivating them, the teacher is the most important.', 'briefcasewp-extras' ),
				],
			];
		}

		$widget->add_control(
			't'. $id .'_testimonials',
			[
				'label' => esc_html__( 'Testimonials', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'image',
						'label' => esc_html__( 'Avatar', 'briefcasewp-extras' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => bew_get_img_uri( 'placeholder-avatar.jpg' ),
						],
					],
					[
						'name' => 'name',
						'label' => esc_html__( 'Name', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'content',
						'label' => esc_html__( 'Content', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'placeholder' => esc_html__( 'Write a review', 'briefcasewp-extras' ),
					],
				],
				'title_field' => '{{{ name }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);
	}



	/**
	 * Testimonials-2
	 */
	public static function add_testimonials_2( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'image' => [ 'url' => bew_get_img_uri( 'avatar/1.jpg' ) ],
					'name' => esc_html__( 'Maryam Amiri', 'briefcasewp-extras' ),
					'title' => esc_html__( '@maryami', 'briefcasewp-extras' ),
					'content' => esc_html__( 'When you innovate, you make mistakes. It is best to admit them quickly, and get on with improving your other innovations.', 'briefcasewp-extras' ),
				],
				[
					'image' => [ 'url' => bew_get_img_uri( 'avatar/2.jpg' ) ],
					'name' => esc_html__( 'Hossein Shams', 'briefcasewp-extras' ),
					'title' => esc_html__( '@shamsoft', 'briefcasewp-extras' ),
					'content' => esc_html__( 'Technology is just a tool. In terms of getting the kids working together and motivating them, the teacher is the most important.', 'briefcasewp-extras' ),
				],
			];
		}


		$widget->add_control(
			't'. $id .'_testimonials',
			[
				'label' => esc_html__( 'Testimonials', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'stars',
						'label' => esc_html__( 'Filled stars', 'briefcasewp-extras' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => 5,
							'unit' => 'U',
						],
						'size_units' => [ 'U' ],
						'range' => [
							'U' => [
								'min' => 0,
								'max' => 5,
							],
						],
					],
					[
						'name' => 'image',
						'label' => esc_html__( 'Avatar', 'briefcasewp-extras' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => bew_get_img_uri( 'placeholder-avatar.jpg' ),
						],
					],
					[
						'name' => 'name',
						'label' => esc_html__( 'Name', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'content',
						'label' => esc_html__( 'Content', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'placeholder' => esc_html__( 'Write a review', 'briefcasewp-extras' ),
					],
				],
				'title_field' => '{{{ name }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);
	}



	/**
	 * Feature - full
	 */
	public static function add_feature_full( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'icon' => 'icon-mobile',
					'color' => '#000000',
					'title' => esc_html__( 'Responsive', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Your landing page displays smoothly on any device: desktop, tablet or mobile.', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-gears',
					'color' => '#0e97ff',
					'title' => esc_html__( 'Customizable', 'briefcasewp-extras' ),
					'text' => esc_html__( 'You can easily read, edit, and write your own code, or change everything.', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-tools',
					'color' => '#b5b9bf',
					'title' => esc_html__( 'UI Kit', 'briefcasewp-extras' ),
					'text' => esc_html__( 'There is a bunch of useful and necessary elements for developing your website.', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-layers',
					'color' => '#ffbe00',
					'title' => esc_html__( 'Lego Base', 'briefcasewp-extras' ),
					'text' => esc_html__( 'You can find our code well organized, commented and readable.', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-recycle',
					'color' => '#ff4954',
					'title' => esc_html__( 'Clean Code', 'briefcasewp-extras' ),
					'text' => esc_html__( 'As you can see in the source code, we provided a comprehensive documentation.', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-chat',
					'color' => '#46da60',
					'title' => esc_html__( 'Support', 'briefcasewp-extras' ),
					'text' => esc_html__( 'When you purchase this template, you\'ll freely receive future updates.', 'briefcasewp-extras' ),
				],
			];
		}

		$link_fa = 'https://fontawesome.com/v4.7.0/icons/';
		$link_ti = 'https://themify.me/themify-icons';
		$link_et = 'https://www.elegantthemes.com/blog/resources/how-to-use-and-embed-an-icon-font-on-your-website#codes';

		$widget->add_control(
			't'. $id .'_features',
			[
				'label' => esc_html__( 'Features', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'icon',
						'label' => esc_html__( 'Icon class', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'description' => 'Any of <a href="'. esc_url( $link_fa ) .'" target="_blank">Font Awesome</a>, <a href="'. esc_url( $link_ti ) .'" target="_blank">Themify</a>, or <a href="'. esc_url( $link_et ) .'" target="_blank">Et-line</a>',
					],
					[
						'name' => 'color',
						'label' => esc_html__( 'Icon color', 'briefcasewp-extras' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#b5b9bf',
					],
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'placeholder' => esc_html__( 'Write a content', 'briefcasewp-extras' ),
					],
				],
				'title_field' => '{{{ title }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);

	}



	/**
	 * Feature - slim
	 */
	public static function add_feature_slim( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'icon' => 'icon-browser',
					'text' => esc_html__( 'Works great in all modern browsers', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-grid',
					'text' => esc_html__( 'Based on Bootstrap framework 4', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-paintbrush',
					'text' => esc_html__( 'Elements with multiple colors', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-documents',
					'text' => esc_html__( 'Very well code documentation', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-gift',
					'text' => esc_html__( 'Variety of sample landing pages', 'briefcasewp-extras' ),
				],
				[
					'icon' => 'icon-download',
					'text' => esc_html__( 'Free updates forever', 'briefcasewp-extras' ),
				],
			];
		}


		$link_fa = 'https://fontawesome.com/v4.7.0/icons/';
		$link_ti = 'https://themify.me/themify-icons';
		$link_et = 'https://www.elegantthemes.com/blog/resources/how-to-use-and-embed-an-icon-font-on-your-website#codes';

		$widget->add_control(
			't'. $id .'_features',
			[
				'label' => esc_html__( 'Features', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'icon',
						'label' => esc_html__( 'Icon class', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'description' => 'Any of <a href="'. esc_url( $link_fa ) .'" target="_blank">Font Awesome</a>, <a href="'. esc_url( $link_ti ) .'" target="_blank">Themify</a>, or <a href="'. esc_url( $link_et ) .'" target="_blank">Et-line</a>',
					],
					[
						'name' => 'color',
						'label' => esc_html__( 'Icon color', 'briefcasewp-extras' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#b5b9bf',
					],
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
				],
				'title_field' => '{{{ text }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);

	}



	/**
	 * Feature - image
	 */
	public static function add_feature_img( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'image' => [ 'url' => bew_get_img_uri( 'placeholder-icon.png' ) ],
					'title' => esc_html__( 'Be The First', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Fly beast fourth, you stars. Them seasons sea spirit, which second. Hath May whales, creepeth light.', 'briefcasewp-extras' ),
				],
				[
					'image' => [ 'url' => bew_get_img_uri( 'placeholder-icon.png' ) ],
					'title' => esc_html__( 'Skyrocket You Sells', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Fly beast fourth, you stars. Them seasons sea spirit, which second. Hath May whales, creepeth light.', 'briefcasewp-extras' ),
				],
				[
					'image' => [ 'url' => bew_get_img_uri( 'placeholder-icon.png' ) ],
					'title' => esc_html__( 'Acquire Potential Users', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Fly beast fourth, you stars. Them seasons sea spirit, which second. Hath May whales, creepeth light.', 'briefcasewp-extras' ),
				],
			];
		}


		$widget->add_control(
			't'. $id .'_features',
			[
				'label' => esc_html__( 'Features', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'image',
						'label' => esc_html__( 'Image', 'briefcasewp-extras' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => bew_get_img_uri( 'placeholder-icon.png' ),
						],
					],
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'placeholder' => esc_html__( 'Write a content', 'briefcasewp-extras' ),
					],
				],
				'title_field' => '{{{ title }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);

	}



	/**
	 * Feature - extended
	 */
	public static function add_feature_extended( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'icon' => 'icon-profile-male',
					'title' => esc_html__( 'Customer Acquisition', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Interactively productize worldwide potentialities before long-term high-impact initiatives. Completely disintermediate excellent leadership skills with client-centric content.', 'briefcasewp-extras' ),
					'gray_bg' => 'yes',
				],
				[
					'icon' => 'icon-linegraph',
					'title' => esc_html__( 'Business Grows', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Interactively productize worldwide potentialities before long-term high-impact initiatives. Completely disintermediate excellent leadership skills with client-centric content.', 'briefcasewp-extras' ),
				],
			];
		}


		$link_fa = 'https://fontawesome.com/v4.7.0/icons/';
		$link_ti = 'https://themify.me/themify-icons';
		$link_et = 'https://www.elegantthemes.com/blog/resources/how-to-use-and-embed-an-icon-font-on-your-website#codes';

		$widget->add_control(
			't'. $id .'_features',
			[
				'label' => esc_html__( 'Features', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'icon',
						'label' => esc_html__( 'Icon class', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'description' => 'Any of <a href="'. esc_url( $link_fa ) .'" target="_blank">Font Awesome</a>, <a href="'. esc_url( $link_ti ) .'" target="_blank">Themify</a>, or <a href="'. esc_url( $link_et ) .'" target="_blank">Et-line</a>',
					],
					[
						'name' => 'color',
						'label' => esc_html__( 'Icon color', 'briefcasewp-extras' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#b5b9bf',
					],
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'placeholder' => esc_html__( 'Write a content', 'briefcasewp-extras' ),
					],
					[
						'name' => 'more_text',
						'label' => esc_html__( 'Read more text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Read more', 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'more_link',
						'label' => esc_html__( 'Read more link', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => 'http://',
						'label_block' => true,
					],
					[
						'name' => 'gray_bg',
						'label' => esc_html__( 'Gray background', 'briefcasewp-extras' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
						'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
						'return_value' => 'yes',
					],
				],
				'title_field' => '{{{ title }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);

	}



	/**
	 * Feature - textual
	 */
	public static function add_feature_textual( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'title' => esc_html__( 'Lego Base', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Your landing page displays smoothly on any device: desktop, tablet or mobile.', 'briefcasewp-extras' ),
				],
				[
					'title' => esc_html__( 'Page Builder', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Your landing page displays smoothly on any device: desktop, tablet or mobile.', 'briefcasewp-extras' ),
				],
				[
					'title' => esc_html__( 'Responsive Design', 'briefcasewp-extras' ),
					'text' => esc_html__( 'Your landing page displays smoothly on any device: desktop, tablet or mobile.', 'briefcasewp-extras' ),
				],
			];
		}


		$widget->add_control(
			't'. $id .'_features',
			[
				'label' => esc_html__( 'Features', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'title',
						'label' => esc_html__( 'Title', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'placeholder' => esc_html__( 'Write a content', 'briefcasewp-extras' ),
					],
					[
						'name' => 'more_text',
						'label' => esc_html__( 'Read more text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Read more', 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'more_link',
						'label' => esc_html__( 'Read more link', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => 'http://',
						'label_block' => true,
					],
				],
				'title_field' => '{{{ title }}}',
				'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
			]
		);

	}




	/**
	 * FAQs
	 */
	public static function add_faqs( $widget, $id, $arg = [] ) {
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'question' => esc_html__( 'What is BriefcaseWP?', 'briefcasewp-extras' ),
					'answer' => esc_html__( 'It is a collection of premium templates and Add-ons for Elementor.', 'briefcasewp-extras' ),
				],
				[
					'question' => esc_html__( 'How long are your contracts?', 'briefcasewp-extras' ),
					'answer' => esc_html__( 'You can upgrade, downgrade, or cancel your account at any time with no further obligation.', 'briefcasewp-extras' ),
				],
			];
		}

		$widget->add_control(
			't'. $id .'_faqs',
			[
				'label' => esc_html__( 'Questions', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'question',
						'label' => esc_html__( 'Question', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'answer',
						'label' => esc_html__( 'Answer', 'briefcasewp-extras' ),
						'placeholder' => esc_html__( 'Answer', 'briefcasewp-extras' ),
						'type' => Controls_Manager::WYSIWYG,
						'show_label' => false,
					],
				],
				'title_field' => '{{{ question }}}',
			]
		);

	}



	/**
	 * Pricing plans
	 */
	public static function add_pricing_plan( $widget, $id, $arg = [] ) {
		
		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = [
				[
					'name' => esc_html__( 'Personal', 'briefcasewp-extras' ),
					'features' => esc_html__( "30 days free trial\nBasic support\nSync to cloud database", 'briefcasewp-extras' ),
					'price' => esc_html__( 'free', 'briefcasewp-extras' ),
					'price_yearly' => esc_html__( 'free', 'briefcasewp-extras' ),
					'price_unit' => '',
					'period' => '',
					'period_yearly' => '',
				],
				[
					'name' => esc_html__( 'Team', 'briefcasewp-extras' ),
					'features' => esc_html__( "30 days free trial\nBasic support\nSync to cloud database", 'briefcasewp-extras' ),
					'price' => esc_html__( '9', 'briefcasewp-extras' ),
					'price_yearly' => esc_html__( '99', 'briefcasewp-extras' ),
					'popular' => 'yes',
					'period' => '/mo',
					'period_yearly' => '/yr',
				],
				[
					'name' => esc_html__( 'Business', 'briefcasewp-extras' ),
					'features' => esc_html__( "30 days free trial\nBasic support\nSync to cloud database", 'briefcasewp-extras' ),
					'price' => esc_html__( '19', 'briefcasewp-extras' ),
					'price_yearly' => esc_html__( '199', 'briefcasewp-extras' ),
					'period' => '/mo',
					'period_yearly' => '/yr',
				],
			];
		}


		$has_yearly = 't'. $id .'_yearly_pricing_plan';
		$widget->add_control(
			$has_yearly,
			self::option_switch( esc_html__( 'Monthly and yearly', 'briefcasewp-extras' ), 
				[], 
				['return' => 'yes']
			)
		);

		$widget->add_control(
			't'. $id .'_monthly_text',
			self::option_text( esc_html__( 'Monthly Text', 'briefcasewp-extras' ), [
				'default' => esc_html__( 'Monthly', 'briefcasewp-extras' ),
				'label_block' => false,
				'condition' => [
					$has_yearly => 'yes'
				]
			])
		);

		$widget->add_control(
			't'. $id .'_yearly_text',
			self::option_text( esc_html__( 'Yearly Text', 'briefcasewp-extras' ), [
				'default' => esc_html__( 'Yearly', 'briefcasewp-extras' ),
				'label_block' => false,
				'condition' => [
					$has_yearly => 'yes'
				]
			])
		);

		$widget->add_control(
			't'. $id .'_plans_toggle_color',
			self::option_select( 'Buttons color', [], [
				'options' => [
					'btn-primary'   => esc_html__( 'Primary', 'briefcasewp-extras' ),
					'btn-secondary' => esc_html__( 'Secondary', 'briefcasewp-extras' ),
					'btn-info'      => esc_html__( 'Info', 'briefcasewp-extras' ),
					'btn-success'   => esc_html__( 'Success', 'briefcasewp-extras' ),
					'btn-warning'   => esc_html__( 'Warning', 'briefcasewp-extras' ),
					'btn-danger'    => esc_html__( 'Danger', 'briefcasewp-extras' ),
					'btn-white'     => esc_html__( 'White', 'briefcasewp-extras' ),
					'btn-dark'      => esc_html__( 'Dark', 'briefcasewp-extras' ),
				],
				'label_block' => false,
				'default' => 'btn-dark',
				'condition' => [
					$has_yearly => 'yes'
				]
			] )
		);
		

		$widget->add_control(
			't'. $id .'_pricing_plan',
			[
				'label' => esc_html__( 'Plans', 'briefcasewp-extras' ),
				'type' => Controls_Manager::REPEATER,
				'default' => $arg['default'],
				'fields' => [
					[
						'name' => 'name',
						'label' => esc_html__( 'Name', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Plan name' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'price',
						'label' => esc_html__( 'Price - Default & Monthly', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '9' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'price_yearly',
						'label' => esc_html__( 'Price - Yearly', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '99' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'price_unit',
						'label' => esc_html__( 'Price unit', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '$' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'period',
						'label' => esc_html__( 'Period text - Default & Monthly', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'period_yearly',
						'label' => esc_html__( 'Period text - Yearly', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'features',
						'label' => esc_html__( 'Features', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => esc_html__( '' , 'briefcasewp-extras' ),
						'placeholder' => esc_html__( 'One feature per line' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'btn_text',
						'label' => esc_html__( 'Button text', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'Get started' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'btn_link',
						'label' => esc_html__( 'Button link - Default & Monthly', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '#' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'btn_link_yearly',
						'label' => esc_html__( 'Button link - Yearly', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '#' , 'briefcasewp-extras' ),
						'label_block' => true,
					],
					[
						'name' => 'btn_color',
						'label' => esc_html__( 'Button color', 'briefcasewp-extras' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'btn-primary'   => esc_html__( 'Primary', 'briefcasewp-extras' ),
							'btn-secondary' => esc_html__( 'Secondary', 'briefcasewp-extras' ),
							'btn-info'      => esc_html__( 'Info', 'briefcasewp-extras' ),
							'btn-success'   => esc_html__( 'Success', 'briefcasewp-extras' ),
							'btn-warning'   => esc_html__( 'Warning', 'briefcasewp-extras' ),
							'btn-danger'    => esc_html__( 'Danger', 'briefcasewp-extras' ),
							'btn-white'     => esc_html__( 'White', 'briefcasewp-extras' ),
							'btn-dark'      => esc_html__( 'Dark', 'briefcasewp-extras' ),
						],
						'default' => 'btn-primary',
					],
					[
						'name' => 'btn_outline',
						'label' => esc_html__( 'Button outline style', 'briefcasewp-extras' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
						'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
						'default' => '',
						'return_value' => 'btn-outline',
					],
					[
						'name' => 'btn_round',
						'label' => esc_html__( 'Button round style', 'briefcasewp-extras' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
						'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
						'default' => '',
						'return_value' => 'btn-round',
					],
					[
						'name' => 'btn_class',
						'label' => esc_html__( 'Button extra classes', 'briefcasewp-extras' ),
						'description' => esc_html__( 'Space separated class names', 'briefcasewp-extras' ),
						'type' => Controls_Manager::TEXT,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'popular',
						'label' => esc_html__( 'Popular', 'briefcasewp-extras' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
						'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
						'return_value' => 'yes',
					],
					[
						'name' => 'hidden',
						'label' => esc_html__( 'Hidden', 'briefcasewp-extras' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
						'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
						'return_value' => 'yes',
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);
	}



	/**
	 * Google map
	 */
	public static function add_google_map( $widget, $id, $arg = [] ) {

		$widget->add_control(
			't'. $id .'_lat',
			[
				'label' => esc_html__( 'Latitude', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => '44.540',
				'placeholder' => '44.540',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_lng',
			[
				'label' => esc_html__( 'Longitude', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => '-78.556',
				'placeholder' => '-78.556',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_zoom',
			[
				'label' => esc_html__( 'Zoom level', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
					'unit' => 'U',
				],
				'size_units' => [ 'U' ],
				'range' => [
					'U' => [
						'min' => 1,
						'max' => 22,
					],
				],
			]
		);

		$widget->add_control(
			't'. $id .'_height',
			[
				'label' => esc_html__( 'Height', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 400,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 800,
					],
				],
			]
		);

		$widget->add_control(
			't'. $id .'_skin',
			[
				'label' => esc_html__( 'Skin', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SELECT,
				'default' => isset( $arg['skin'] ) ? $arg['skin'] : 'light',
				'options' => [
					'default'   => esc_html__( 'Default', 'briefcasewp-extras' ),
					'light'   => esc_html__( 'Light', 'briefcasewp-extras' ),
					'dark'   => esc_html__( 'Dark', 'briefcasewp-extras' ),
				],
			]
		);

	}



	/**
	 * Contact
	 */
	public static function add_contact( $widget, $id, $arg = [] ) {

		$widget->add_control(
			't'. $id .'_editor',
			[
				'label' => '',
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>Give us a call or stop by our door anytime, we try to answer all enquiries within 24 hours on business days.</p><p>We are open from 9am - 5pm week days.</p>',
			]
		);

		$widget->add_control(
			't'. $id .'_address',
			[
				'label' => esc_html__( 'Address', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '652 Main Road, Apt 12'. "\n" .'New York, USA 10033',
			]
		);

		$widget->add_control(
			't'. $id .'_email',
			[
				'label' => esc_html__( 'Email', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'info@domain.com',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_phone',
			[
				'label' => esc_html__( 'Phone', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => '+1 (123) 456-7890',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_fax',
			[
				'label' => esc_html__( 'Fax', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => '+1 (987) 654-3210',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_success_msg',
			[
				'label' => esc_html__( 'Success message', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'We received your message and will contact you back soon.', 'briefcasewp-extras' ),
				'description' => esc_html__( 'A text to be display after submiting form.', 'briefcasewp-extras' ),
				'label_block' => true,
			]
		);

	}



	/**
	 * Contact detail
	 */
	public static function add_contact_detail( $widget, $id, $arg = [] ) {

		$widget->add_control(
			't'. $id .'_editor',
			[
				'label' => '',
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>Give us a call or stop by our door anytime, we try to answer all enquiries within 24 hours on business days.</p><p>We are open from 9am - 5pm week days.</p>',
			]
		);

		$widget->add_control(
			't'. $id .'_address',
			[
				'label' => esc_html__( 'Address', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '652 Main Road, Apt 12'. "\n" .'New York, USA 10033',
			]
		);

		$widget->add_control(
			't'. $id .'_email',
			[
				'label' => esc_html__( 'Email', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'info@domain.com',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_phone',
			[
				'label' => esc_html__( 'Phone', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => '+1 (123) 456-7890',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_fax',
			[
				'label' => esc_html__( 'Fax', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => '+1 (987) 654-3210',
				'label_block' => true,
			]
		);

	}



	/**
	 * Contact detail2
	 */
	public static function add_contact_detail_2( $widget, $id, $arg = [] ) {

		if ( isset( $arg['with_bg_image'] ) ) {
			$widget->add_control(
				't'. $id .'_contact_bg_image',
				[
					'label' => esc_html__( 'Background image', 'briefcasewp-extras' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => isset( $arg['contact_bg_image'] ) ? $arg['contact_bg_image'] : bew_get_img_uri( 'bg-laptop.jpg' ),
					],
				]
			);
		}

		$widget->add_control(
			't'. $id .'_contact_small_text',
			[
				'label' => esc_html__( 'Small Text', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => isset( $arg['small_text'] ) ? $arg['small_text'] : '',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_contact_heading_text',
			[
				'label' => esc_html__( 'Heading Text', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => isset( $arg['heading_text'] ) ? $arg['heading_text'] : esc_html__( 'Seattle, WA', 'briefcasewp-extras' ),
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_address',
			[
				'label' => esc_html__( 'Address', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => isset( $arg['address'] ) ? $arg['address'] : '652 Main Road, Apt 12'. "\n" .'New York, USA 10033',
			]
		);

		$widget->add_control(
			't'. $id .'_phone',
			[
				'label' => esc_html__( 'Phone', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => '+1 (123) 456-7890',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_fax',
			[
				'label' => esc_html__( 'Fax', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => isset( $arg['fax'] ) ? $arg['fax'] : '+1 (987) 654-3210',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_email',
			[
				'label' => esc_html__( 'Email', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'info@domain.com',
				'label_block' => true,
			]
		);

		$widget->add_control(
			't'. $id .'_social_icons',
			[
				'label' => esc_html__( 'Social icons', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
				'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
				'default' => isset( $arg['social_icons'] ) ? $arg['social_icons'] : 'yes',
				'return_value' => 'yes',
			]
		);

	}



	/**
	 * Contact form
	 */
	public static function add_contact_form( $widget, $id, $arg = [] ) {


		$widget->add_control(
			't'. $id .'_success_msg',
			[
				'label' => esc_html__( 'Success message', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'We received your message and will contact you back soon.', 'briefcasewp-extras' ),
				'description' => esc_html__( 'A text to be display after submiting form.', 'briefcasewp-extras' ),
				'label_block' => true,
			]
		);


		$widget->add_control(
			't'. $id .'_error_msg',
			[
				'label' => esc_html__( 'Error message', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'There is a problem in our email service. Please try again later.', 'briefcasewp-extras' ),
				'description' => esc_html__( 'A text to be display if an error occurred.', 'briefcasewp-extras' ),
				'label_block' => true,
			]
		);


	}




	/**
	 * Header style
	 */
	public static function add_header_style( $widget, $id, $arg = [] ) {
		$background = 't'. $id .'_background';

		if ( isset( $arg['default'] ) ) {
			$arg = $arg['default'];
		}


		$widget->add_control(
			't'. $id .'_header_id',
			[
				'label' => esc_html__( 'Header ID', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
			]
		);


		$widget->add_control(
			$background,
			[
				'label' => esc_html__( 'Background type', 'briefcasewp-extras' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'color'    => [
						'title' => esc_html__( 'Color', 'briefcasewp-extras' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => esc_html__( 'Gradient', 'briefcasewp-extras' ),
						'icon' => 'fa fa-barcode',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'briefcasewp-extras' ),
						'icon' => 'fa fa-picture-o',
					],
					'video' => [
						'title' => esc_html__( 'Video', 'briefcasewp-extras' ),
						'icon' => 'fa fa-video-camera',
					],
					'slideshow' => [
						'title' => esc_html__( 'Slideshow', 'briefcasewp-extras' ),
						'icon' => 'eicon-slideshow',
					],
				],
				'default' => isset( $arg['background'] ) ? $arg['background'] : 'color',
			]
		);


		$widget->add_control(
			't'. $id .'_bg_color',
			[
				'label' => esc_html__( 'Background color', 'briefcasewp-extras' ),
				'type' => Controls_Manager::COLOR,
				'default' => isset( $arg['bg_color'] ) ? $arg['bg_color'] : '#ff9900',
				'condition' => [
					$background => 'color',
				],
			]
		);
		
		$widget->add_control(
			't'. $id .'_bg_color_img',
			[
				'label' => esc_html__( 'Background pattern image', 'briefcasewp-extras' ),				
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none'   => esc_html__( 'None', 'briefcasewp-extras' ),
					'waves'   => esc_html__( 'Waves', 'briefcasewp-extras' ),
					'diamond' => esc_html__( 'Diamond', 'briefcasewp-extras' ),					
				],
				'default' => isset( $arg['bg_color_img'] ) ? $arg['bg_color_img'] : 'none',
				'condition' => [
					$background => 'color',
				],
			]
		);

		$widget->add_control(
			't'. $id .'_color_1',
			[
				'label' => esc_html__( 'Color 1', 'briefcasewp-extras' ),
				'type' => Controls_Manager::COLOR,
				'default' => isset( $arg['color_1'] ) ? $arg['color_1'] : '#007191',
				'condition' => [
					$background => 'gradient',
				],
			]
		);


		$widget->add_control(
			't'. $id .'_color_2',
			[
				'label' => esc_html__( 'Color 2', 'briefcasewp-extras' ),
				'type' => Controls_Manager::COLOR,
				'default' => isset( $arg['color_2'] ) ? $arg['color_2'] : '#3ec1d3',
				'condition' => [
					$background => 'gradient',
				],
			]
		);


		$widget->add_control(
			't'. $id .'_gradient_dir',
			[
				'label' => esc_html__( 'Direction', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SELECT,
				'default' => isset( $arg['gradient_dir'] ) ? $arg['gradient_dir'] : 'top',
				'options' => [
					'top'   => esc_html__( 'Top', 'briefcasewp-extras' ),
					'right' => esc_html__( 'Right', 'briefcasewp-extras' ),
					'bottom' => esc_html__( 'Bottom', 'briefcasewp-extras' ),
					'left' => esc_html__( 'Left', 'briefcasewp-extras' ),
				],
				'condition' => [
					$background => 'gradient',
				],
			]
		);


		$widget->add_control(
			't'. $id .'_bg_image',
			[
				'label' => esc_html__( 'Background image', 'briefcasewp-extras' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => isset( $arg['bg_image'] ) ? $arg['bg_image'] : bew_get_img_uri( 'bg-hero1.jpg' ),
				],
				'condition' => [
					$background => 'image',
				],
			]
		);


		$widget->add_control(
			't'. $id .'_bg_image_type',
			[
				'label' => esc_html__( 'Type', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SELECT,
				'default' => isset( $arg['bg_image_type'] ) ? $arg['bg_image_type'] : 'cover',
				'options' => [
					'cover'   => esc_html__( 'Cover', 'briefcasewp-extras' ),
					'fixed' => esc_html__( 'Fixed', 'briefcasewp-extras' ),
					'parallax' => esc_html__( 'Parallax', 'briefcasewp-extras' ),
				],
				'condition' => [
					$background => 'image',
				],
			]
		);


		$widget->add_control(
			't'. $id .'_bg_video_poster',
			[
				'label' => esc_html__( 'Video poster', 'briefcasewp-extras' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => bew_get_img_uri( 'video/video.jpg' ),
				],
				'condition' => [
					$background => 'video',
				],
			]
		);

		
		$widget->add_control(
			't'. $id .'_bg_video_link',
			[
				'label' => esc_html__( 'Video Link', 'briefcasewp-extras' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://www.youtube.com/watch?v=fTii6lRgSpo',
				'description' => __( 'YouTube/Vimeo link, or link to video file (mp4 is recommended).', 'briefcasewp-extras' ),
				'label_block' => true,
				'default' => 'https://www.youtube.com/watch?v=fTii6lRgSpo',				
				'of_type' => 'video',
				'frontend_available' => true,				
				'condition' => [
					$background => 'video',					
					't'. $id .'_bg_video_hosted!' => 'yes',
				],
			]
		);
		
		$widget->add_control(
			't'. $id .'_bg_video_hosted',
			[
				'label' => __( 'Self Hosted', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,
				'default' 		=> '',
				'label_on' 		=> __( 'On', 'briefcasewp-extras' ),
				'label_off' 	=> __( 'Off', 'briefcasewp-extras' ),
				'return_value' 	=> 'yes',
				'condition' => [
					$background => 'video',
				],
			]
		);
		
		$widget->add_control(
			't'. $id .'_bg_video_mp4',
			[
				'label' => esc_html__( 'MP4 video', 'briefcasewp-extras' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => bew_get_img_uri( 'video/video.mp4' ),
				],
				'condition' => [
					$background => 'video',					
					't'. $id .'_bg_video_hosted' => 'yes',
				],
			]
		);
		
		$widget->add_control(
			't'. $id .'_mute',
			[
				'label' => esc_html__( 'Video sound mute', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
				'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
				'default' => isset( $arg['fullscreen'] ) ? $arg['fullscreen'] : 'yes',
				'return_value' => 'yes',
				'condition' => [
					$background => 'video',
				],
			]
		);
				
		$widget->add_control(
			't'. $id .'_header_inverse',
			[
				'label' => esc_html__( 'Light text color', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
				'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
				'default' => isset( $arg['header_inverse'] ) ? $arg['header_inverse'] : 'header-inverse',
				'return_value' => 'header-inverse',
				'separator' => 'before',
			]
		);


		$widget->add_control(
			't'. $id .'_fullscreen',
			[
				'label' => esc_html__( 'Fullscreen', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
				'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
				'default' => isset( $arg['fullscreen'] ) ? $arg['fullscreen'] : 'yes',
				'return_value' => 'yes',
			]
		);


		$widget->add_control(
			't'. $id .'_particle',
			[
				'label' => esc_html__( 'Particle', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
				'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
				'default' => isset( $arg['particle'] ) ? $arg['particle'] : 'no',
				'return_value' => 'yes',
			]
		);


		$widget->add_control(
			't'. $id .'_particles_color',
			[
				'label' => esc_html__( 'Particles color', 'briefcasewp-extras' ),
				'type' => Controls_Manager::COLOR,
				'default' => isset( $arg['particles_color'] ) ? $arg['particles_color'] : 'rgba(255,255,255,.8)',
				'condition' => [
					't'. $id .'_particle' => 'yes',
				],
			]
		);


		$widget->add_control(
			't'. $id .'_particles_length',
			[
				'label' => esc_html__( 'Number of particles', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => isset( $arg['particles_length'] ) ? $arg['particles_length'] : 100,
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'condition' => [
					't'. $id .'_particle' => 'yes',
				],
			]
		);


		$widget->add_control(
			't'. $id .'_fadeout',
			[
				'label' => esc_html__( 'Fadeout effect', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'briefcasewp-extras' ),
				'label_on' => esc_html__( 'Yes', 'briefcasewp-extras' ),
				'default' => '',
				'return_value' => 'fadeout',
			]
		);


		$widget->add_control(
			't'. $id .'_overlay',
			[
				'label' => esc_html__( 'Overlay', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => isset( $arg['overlay'] ) ? $arg['overlay'] : 7,
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 9,
					],
				],
				'separator' => 'before',
			]
		);


		$widget->add_control(
			't'. $id .'_overlay_color',
			[
				'label' => esc_html__( 'Overlay color', 'briefcasewp-extras' ),
				'type' => Controls_Manager::COLOR,
				'default' => isset( $arg['overlay_color'] ) ? $arg['overlay_color'] : '#191919',
			]
		);


		$widget->add_control(
			't'. $id .'_padding_top',
			[
				'label' => esc_html__( 'Padding top', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => isset( $arg['padding_top'] ) ? $arg['padding_top'] : 120,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 5,
					],
				],
				'separator' => 'before',
			]
		);


		$widget->add_control(
			't'. $id .'_padding_bottom',
			[
				'label' => esc_html__( 'Padding bottom', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => isset( $arg['padding_bottom'] ) ? $arg['padding_bottom'] : 120,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 5,
					],
				],
			]
		);
				
		if( 1 == $id || 2 == $id ){
		
		$widget->add_control(
			't'. $id .'_custom_position',
			[
				'label' => __( 'Custom Position', 'briefcasewp-extras' ),
				'type' => Controls_Manager::SWITCHER,				
			]
		);

		$widget->add_control(
			't'. $id .'_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'briefcasewp-extras' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'briefcasewp-extras' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'briefcasewp-extras' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'briefcasewp-extras' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .t'. $id .'-cover .custom-position .custom-position-content' => '{{VALUE}}',					
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto !important; width: auto; flex: 0 0 auto;',
					'center' => 'margin: 0 auto !important; width: auto; flex: 0 0 auto;',
					'right' => 'margin-left: auto !important; width: auto; flex: 0 0 auto;',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 't'. $id .'_custom_position',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$widget->add_control(
			't'. $id .'_vertical_position',
			[
				'label' => __( 'Vertical Position', 'briefcasewp-extras' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'briefcasewp-extras' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'briefcasewp-extras' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'briefcasewp-extras' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .t'. $id .'-cover .custom-position .custom-position-content' => 'align-self: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start !important',
					'middle' => 'center !important',
					'bottom' => 'flex-end !important',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 't'. $id .'_custom_position',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$widget->add_control(
			't'. $id .'_text_align',
			[
				'label' => __( 'Text Align', 'briefcasewp-extras' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'briefcasewp-extras' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'briefcasewp-extras' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'briefcasewp-extras' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .t'. $id .'-cover .custom-position' => 'text-align: {{VALUE}}',					
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 't'. $id .'_custom_position',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		}

	}
	
	/**
	 * Default options for text input control
	 */
	public static function option_text( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::TEXT,
			'default'     => isset( $arg['default'] ) ? $arg['default'] : '',
			'placeholder' => isset( $arg['placeholder'] ) ? $arg['placeholder'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'label_block' => isset( $arg['label_block'] ) ? $arg['label_block'] : true,
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
			'dynamic' => [
				'active' => true,
			],
		];
	}


	/**
	 * Default options for textarea control
	 */
	public static function option_textarea( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => isset( $arg['default'] ) ? $arg['default'] : '',
			'placeholder' => isset( $arg['placeholder'] ) ? $arg['placeholder'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'label_block' => isset( $arg['label_block'] ) ? $arg['label_block'] : true,
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
			'dynamic' => [
				'active' => true,
			],
		];
	}


	/**
	 * Default options for URL input control
	 */
	public static function option_url( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::URL,
			'default'     => [
				'url'         => isset( $arg['default'] )  ? $arg['default'] : '',
				'is_external' => isset( $arg['external'] ) ? true : false,
			],
			'placeholder' => isset( $arg['placeholder'] ) ? $arg['placeholder'] : 'http://',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
			'show_external' => isset( $arg['show_external'] ) ? $arg['show_external'] : true,
		];
	}


	/**
	 * Default options for URL input control
	 */
	public static function option_switch( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::SWITCHER,
			'label_off'   => esc_html__( 'No', 'briefcasewp-extras' ),
			'label_on'    => esc_html__( 'Yes', 'briefcasewp-extras' ),
			'return_value' => isset( $arg['return'] )  ? $arg['return'] : '',
			'default'     => isset( $arg['default'] )  ? $arg['default'] : '',
			'placeholder' => isset( $arg['placeholder'] ) ? $arg['placeholder'] : 'http://',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
			'show_external' => isset( $arg['show_external'] ) ? $arg['show_external'] : true,
		];
	}


	/**
	 * Default options for select control
	 */
	public static function option_select( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::SELECT,
			'default'     => isset( $arg['default'] ) ? $arg['default'] : '',
			'options'     => isset( $arg['options'] ) ? $arg['options'] : [],
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'label_block' => isset( $arg['label_block'] ) ? $arg['label_block'] : true,
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}


	/**
	 * Default options for color picker control
	 */
	public static function option_color( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::COLOR,
			'default'     => isset( $arg['default'] ) ? $arg['default'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'label_block' => isset( $arg['label_block'] ) ? $arg['label_block'] : false,
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}
	
	/**
	 * Default options for color picker control
	 */
	public static function option_color_btn( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::COLOR,
			'default'     => isset( $arg['default'] ) ? $arg['default'] : '',
			'selectors'   => isset( $arg['selectors'] ) ? $arg['selectors'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'label_block' => isset( $arg['label_block'] ) ? $arg['label_block'] : false,
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}
	
	/**
	 * Color picker control for content
	 */
	public static function option_color_bg_content( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::COLOR,
			'default'     => isset( $arg['default'] ) ? $arg['default'] : '',
			'selectors'   => isset( $arg['selectors'] ) ? $arg['selectors'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'label_block' => isset( $arg['label_block'] ) ? $arg['label_block'] : false,
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}


	/**
	 * Default options for image selector
	 */
	public static function option_media( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::MEDIA,
			'default'     => [
				'url'     => isset( $arg['default'] )  ? $arg['default'] : bew_get_img_uri( 'placeholder.jpg' ),
			],
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}


	/**
	 * Default options for gallery selector
	 */
	public static function option_gallery( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );

		if ( isset( $arg['default'] ) ) {
			$gallery = array();
			foreach ( $arg['default'] as $image ) {
				$gallery[] = [ 'url' => $image ];
			}
		}

		return [
			'label'       => $label,
			'type'        => Controls_Manager::GALLERY,
			'default'     => $gallery,
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}


	/**
	 * Default options for slider control
	 */
	public static function option_slider( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );

		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = 5;
		}

		if ( ! isset( $arg['min'] ) ) {
			$arg['min'] = 1;
		}

		if ( ! isset( $arg['max'] ) ) {
			$arg['max'] = 9;
		}

		if ( ! isset( $arg['step'] ) ) {
			$arg['step'] = 1;
		}

		return [
			'label'       => $label,
			'type'        => Controls_Manager::SLIDER,
			'default'     => [
				'size' => $arg['default'],
				'unit' => '%',
			],
			'size_units'  => [ '%' ],
			'range' => [
				'%' => [
					'min'  => $arg['min'],
					'max'  => $arg['max'],
					'step' => $arg['step'],
				],
			],					
			'selectors'   => isset( $arg['selectors'] ) ? $arg['selectors'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}
	
	/**
	 * Default options for slider control
	 */
	public static function option_slider_font( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );

		if ( ! isset( $arg['default'] ) ) {
			$arg['default'] = 5;
		}

		if ( ! isset( $arg['min'] ) ) {
			$arg['min'] = 1;
		}

		if ( ! isset( $arg['max'] ) ) {
			$arg['max'] = 9;
		}

		if ( ! isset( $arg['step'] ) ) {
			$arg['step'] = 1;
		}

		return [
			'label'       => $label ,
			'type'        => Controls_Manager::SLIDER,
			'default' => [
				'size' => $arg['default'],
				'unit' => $arg['default_unit'],
			],
			'tablet_default' => [
				'size' => $arg['tablet_default'],
				'unit' => $arg['default_unit'],
			],
			'mobile_default' => [
				'size' => $arg['mobile_default'],
				'unit' => $arg['default_unit'],
			],
			'size_units' => [ '%', 'px', 'vw' ],
			'range' => [
				'%' => [
					'min' => 1,
					'max' => 100,
					'step' => $arg['step'],
				],
				'px' => [
					'min' => $arg['min'],
					'max' => $arg['max'],
				],
				'vw' => [
					'min' => 1,
					'max' => 100,
				],
			],					
			'selectors'   => isset( $arg['selectors'] ) ? $arg['selectors'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}
	

	/**
	 * Default options for WYSIWYG control
	 */
	public static function option_wysiwyg( $label, $arg = [], $extend = [] ) {
		$arg = array_merge( $arg, $extend );
		return [
			'label'       => $label,
			'type'        => Controls_Manager::WYSIWYG,
			'default'     => isset( $arg['default'] ) ? $arg['default'] : '',
			'description' => isset( $arg['description'] ) ? $arg['description'] : '',
			'label_block' => isset( $arg['label_block'] ) ? $arg['label_block'] : true,
			'separator'   => isset( $arg['separator'] ) ? 'before' : 'default',
			'condition'   => isset( $arg['condition'] ) ? $arg['condition'] : [],
		];
	}


}
