<?php

function app_register_taxonomies() {
	$taxonomies       = [];
	$taxonomies_files = glob( APP_APP_SETUP_DIR . 'taxonomies/*.php' );

	foreach ( $taxonomies_files as $file ) {
		$taxonomies[] = require( $file );
	}

	foreach ( $taxonomies as $taxonomy ) {
		if ( isset( $taxonomy['taxonomy'] ) && isset( $taxonomy['args'] ) ) {
			register_taxonomy( $taxonomy['taxonomy'], '', $taxonomy['args'] );
		}
	}
}
