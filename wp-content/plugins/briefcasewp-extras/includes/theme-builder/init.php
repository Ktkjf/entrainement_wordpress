<?php

use Elementor\TemplateLibrary\Source_Local;
use ElementorPro\Modules\ThemeBuilder\Documents\Briefcasewp;
use ElementorPro\Plugin;
use ElementorPro\Modules\ThemeBuilder\Documents\Theme_Document;


require_once BEW_EXTRAS_PATH.'includes/theme-builder/documents/briefcasewp.php';

// Register new Elementor Type	
Plugin::elementor()->documents->register_document_type( 'briefcasewp', Briefcasewp::get_class_full_name() );
Source_Local::add_template_type( 'briefcasewp' );

function bew_get_document( $post_id ) {
		$document = null;

		try {
			$document = Plugin::elementor()->documents->get( $post_id );
		} catch ( \Exception $e ) {}

		if ( ! empty( $document ) && ! $document instanceof Theme_Document ) {
			$document = null;
		}

		return $document;
}

