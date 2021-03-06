<?php

return [
	'taxonomy' => 'result-type',
	'args'     => [
		'label'                 => __( 'Result type', 'run' ),
		'labels'                => [
			'name'              => __( 'Result type', 'run' ),
			'singular_name'     => __( 'Result type', 'run' ),
			'search_items'      => __( 'Search Result types', 'run' ),
			'all_items'         => __( 'All Result types', 'run' ),
			'view_item '        => __( 'View Result type', 'run' ),
			'parent_item'       => __( 'Parent Result type', 'run' ),
			'parent_item_colon' => '',
			'edit_item'         => __( 'Edit Result type', 'run' ),
			'update_item'       => __( 'Update Result type', 'run' ),
			'add_new_item'      => __( 'Add new Result type', 'run' ),
			'new_item_name'     => __( 'New Result type name', 'run' ),
			'menu_name'         => __( 'Result types', 'run' ),
		],
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => false,
		'show_in_nav_menus'     => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_tagcloud'         => false,
		'show_in_rest'          => true,
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => false,
		'capabilities'          => [],
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_quick_edit'    => true,
	],
];
