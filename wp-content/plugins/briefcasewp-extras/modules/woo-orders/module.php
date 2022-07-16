<?php
namespace BriefcasewpExtras\Modules\WooOrders;

use BriefcasewpExtras\Base\Module_Base;
use BriefcasewpExtras\Modules\WooOrders\Classes;
use BriefcasewpExtras\Modules\WooOrders\Classes\Bew_Opc;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {
	
	public function __construct() {
		parent::__construct();
		
		require BEW_EXTRAS_PATH . 'modules/woo-orders/classes/bew-opc.php';
		
		$this->add_actions();
	}

	public function get_name() {
		return 'woo-orders';
	}

	public function get_widgets() {
		return [
			'Woo_Orders',
			
		];
	}
	 
	function bewwoo_remove_fields( $woo_checkout_fields_array ) {
		 
		// Wanted me to leave these fields in checkout
		// unset( $woo_checkout_fields_array['billing']['billing_first_name'] );
		// unset( $woo_checkout_fields_array['billing']['billing_last_name'] );
		// unset( $woo_checkout_fields_array['billing']['billing_phone'] );
		// unset( $woo_checkout_fields_array['billing']['billing_email'] );
		// unset( $woo_checkout_fields_array['order']['order_comments'] ); // remove order notes
		 
		// and to remove the billing fields below
		unset( $woo_checkout_fields_array['billing']['billing_company'] ); // remove company field
		unset( $woo_checkout_fields_array['billing']['billing_address_1'] );
		unset( $woo_checkout_fields_array['billing']['billing_address_2'] );
		unset( $woo_checkout_fields_array['billing']['billing_city'] );
		unset( $woo_checkout_fields_array['billing']['billing_state'] ); // remove state field
		unset( $woo_checkout_fields_array['billing']['billing_postcode'] ); // remove zip code field
		 
		return $woo_checkout_fields_array;
	}
	
	
	function bew_optional_billing_fields( $address_fields ) {
		$address_fields['billing_address_1']['required'] = false;
		$address_fields['billing_address_2']['required'] = false;
		$address_fields['billing_country']['required'] = false;
		return $address_fields;
	}	
 
	function bewwoo_reorder_fields( $checkout_fields ) {
		$checkout_fields['billing']['billing_email']['priority'] = 4;
		return $checkout_fields;
	}

	private function add_actions() {
		
		if( get_option('wo_fields') == 1 ) { 
		// Filter remove fields
		add_filter( 'woocommerce_checkout_fields', array( $this, 'bewwoo_remove_fields' ) );
		// Filter requried country
		add_filter( 'woocommerce_billing_fields', array( $this, 'bew_optional_billing_fields') , 10, 1 );
		// Filter re-order email
		add_filter( 'woocommerce_checkout_fields', array( $this, 'bewwoo_reorder_fields' ) );		
		}


	}
}
