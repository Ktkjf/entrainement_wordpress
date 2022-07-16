<?php
namespace BriefcasewpExtras\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Bew_Categories_Block_2 {

  const ID = 2;

  public function controls( $widget ) {
    $widget->set_id( self::ID );
    $id = self::ID;

    $widget->panel( 'section', [
      'includes' => [ 'bg_gray' ],
    ] );

    $widget->panel( 'header_content', [
      'small'  => esc_html__( 'Products', 'briefcasewp-extras' ),
      'header' => esc_html__( 'Categories', 'briefcasewp-extras' ),
      'lead'   => esc_html__( 'Ready to find our collections.', 'briefcasewp-extras' ),
    ] );

    Bew_Controls::start_section( $widget, 'categories', $id );
	Bew_Controls::add_font_size( $widget, $id, [ 'default' => 24, 'default_unit' => 'px' , 'selectors' => 'h5' ] );

    $widget->add_control(
      't'. $id . '_columns',
      Bew_Controls::option_slider( esc_html__( 'Columns', 'briefcasewp-extras' ), [], [
        'min'  => 2,
        'max'  => 4,
        'default' => 3,
      ] )
    );
	
	$widget->add_control(
		't'. $id .'cat_hover_bg_color',
		[
			'label' => esc_html__( 'Background color', 'briefcasewp-extras' ),
			'type' => Controls_Manager::COLOR,
			'default' => '#ffffff',
			'selectors' => [
					'{{WRAPPER}} .categories-'. $id .'::before ' => 'background-color: {{VALUE}};',					
				],
		]
	);

    $categories = get_terms( 'product_cat' );

	$options = [];
	$options[0] = esc_html__( 'None', 'briefcasewp-extras' );
	foreach ( $categories as $category ) {
		$options[ $category->term_id ] = $category->name;
	}
	    
    $items = [
      [
        'title' => esc_html__( 'Category 1', 'briefcasewp-extras' ),
        'image' => [ 'url' => bew_get_img_uri( 'category-1.jpg' ) ],
        'button' => 'Shop Now',
        'link' => '#',
      ],
      [
        'title' => esc_html__( 'Category 2', 'briefcasewp-extras' ),
        'image' => [ 'url' => bew_get_img_uri( 'category-2.jpg' ) ],
        'button' => 'Shop Now',
        'link' => '#',
      ],
      [
        'title' => esc_html__( 'Category 3', 'briefcasewp-extras' ),
        'image' => [ 'url' => bew_get_img_uri( 'category-3.jpg' ) ],
        'button' => 'Shop Now',
        'link' => '#',
      ],
      [
        'title' => esc_html__( 'Category 4', 'briefcasewp-extras' ),
        'image' => [ 'url' => bew_get_img_uri( 'category-4.jpg' ) ],
        'button' => 'Shop Now',
        'link' => '#',
      ],
      [
        'title' => esc_html__( 'Category 5', 'briefcasewp-extras' ),
        'image' => [ 'url' => bew_get_img_uri( 'category-5.jpg' ) ],
        'button' => 'Shop Now',
        'link' => '#',
      ],
      [
        'title' => esc_html__( 'Category 6', 'briefcasewp-extras' ),
        'image' => [ 'url' => bew_get_img_uri( 'category-6.jpg' ) ],
        'button' => 'Shop Now',
        'link' => '#',
      ],
    ];

    $widget->add_control(
      't'. $id .'_items',
      [
        'label' => esc_html__( 'Items', 'briefcasewp-extras' ),
        'type' => Controls_Manager::REPEATER,
        'default' => $items,
        'fields' => [
          [
            'name' => 'cat',
            'label' => esc_html__( 'Select a category', 'briefcasewp-extras' ),
            'type' => Controls_Manager::SELECT,
            'label_block' => true,
            'default' => '0',
            'label' => esc_html__( 'Select None to insert manually', 'briefcasewp-extras' ),
            'description' => '<a href="'. admin_url() .'edit-tags.php?taxonomy=product_cat&post_type=product" target="_blank">'. esc_html__( 'Add new category', 'briefcasewp-extras' ) .'</a>',
            'options' => $options,
          ],
          [
            'name' => 'title',
            'label' => esc_html__( 'Title', 'briefcasewp-extras' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'condition' => [
              'cat' => '0',
            ],
          ],
          [
            'name' => 'link',
            'label' => esc_html__( 'Link', 'briefcasewp-extras' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'condition' => [
              'cat' => '0',
            ],
          ],
          [
            'name' => 'image',
            'label' => esc_html__( 'Image', 'briefcasewp-extras' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
              'url' => bew_get_img_uri( 'placeholder.jpg' ),
            ],
            'condition' => [
              'cat' => '0',
            ],
          ],
		   [
            'name' => 'button',
            'label' => esc_html__( 'Button', 'briefcasewp-extras' ),
            'type' => Controls_Manager::TEXT,
            'label_block' => true, 
			'default' => 'Shop Now',
          ],
        ],
        'title_field' => '{{{ title }}}',
        'separator' => isset( $arg['separator'] ) ? 'before' : 'default',
      ]
    );

    Bew_Controls::end_section( $widget );
  }



  public function html( $widget ) {
    $widget->set_id( self::ID );
    $settings = $widget->get_settings();

    $cols = $settings['t2_columns']['size'];
    $col_class = 'bew-col-12';
    switch ( $cols ) {
      case 1:
        $col_class = 'bew-col-12';
        break;

      case 2:
        $col_class = 'bew-col-12 bew-col-md-6';
        break;

      case 3:
        $col_class = 'bew-col-12 bew-col-lg-4';
        break;

      case 4:
        $col_class = 'bew-col-6 bew-col-lg-3';
        break;

      default:
        $col_class = 'bew-col-12 bew-col-md-6';
        break;
    }

    ?>
    <?php $widget->html('section_tag'); ?>
      <?php $widget->html('section_header'); ?>
     
        <div class="bew-row gap-y gap-2">
    
          <?php
          foreach ( $settings['t2_items'] as $item ) :

            $title = $item['title'];            
            $image = !empty( $item['image']['url'] ) ? $item['image']['url'] : bew_get_img_uri( 'cat-placeholder.jpg' );
            $link  = $item['link'];			
			$button = $item['button']; 
            if ( '0' !== $item['cat'] ) {
              $id = intval( $item['cat'] );              
			  $category = get_term_by( 'id', $id, 'product_cat' );			  
              
              $title = $category->name;
			  $thumbnail_id = get_woocommerce_term_meta( $id, 'thumbnail_id', true );
			  if(!empty($thumbnail_id)){
				$image = wp_get_attachment_url( $thumbnail_id );  
			  }else{
				$image = wc_placeholder_img_src();  
			  }
			  
              $link = get_category_link( $category->term_id );			 
                            
            }
          ?>
            
             <div class="cat-block <?php echo $col_class; ?>">
                      
              <a class="categories-2" href="<?php echo esc_url( $link ); ?>">
                <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                <div class="categories-details">
                  <h5><?php echo $title;?></h5> 
				  <span class="categories-button"><?php echo $button ?></span> 	
                </div>
              </a>
            </div>

          <?php endforeach; ?>

    </div></section>
    <?php
  }



  public function javascript( $widget ) {
    $widget->set_id( self::ID );

    ?>

    <?php $widget->js('section_tag'); ?>
      <?php $widget->js('section_header'); ?>

        <p class="text-center">
          <?php esc_html_e( 'You\'ll see categories items after saving and reloading the page.', 'briefcasewp-extras' ); ?>
        </p>

    </div></section>
    <?php
  }

}
