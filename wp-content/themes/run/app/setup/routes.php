<?php

use App\Controllers\Web\AboutController;
use App\Controllers\Web\ArticlesController;
use App\Controllers\Web\CalendarController;
use App\Controllers\Web\FrontPageController;
use App\Controllers\Web\HistoryController;
use App\Controllers\Web\PageController;
use App\Controllers\Web\PostController;
use App\Controllers\Web\ResultsController;

return [
	'web' => [
		[
			'condition'      => 'url',
			'url'            => '/',
			'handle'         => FrontPageController::class . '@index',
			'menu_title'     => __( 'Home', 'run' ),
			'include_in_nav' => true,
			'is_active'      => $_SERVER['REQUEST_URI'] === '/' ? true : false,
			'priority'       => 1,
			'changefreq'     => 'weekly',
		],
		[
			'condition'      => 'url',
			'url'            => '/calendar/',
			'handle'         => CalendarController::class . '@index',
			'menu_title'     => __( 'Calendar', 'run' ),
			'include_in_nav' => true,
			'is_active'      => $_SERVER['REQUEST_URI'] === '/calendar/' ? true : false,
			'priority'       => 0.9,
			'changefreq'     => 'monthly',
		],
		[
			'condition'      => 'url',
			'url'            => '/results/',
			'handle'         => ResultsController::class . '@index',
			'menu_title'     => __( 'Results', 'run' ),
			'include_in_nav' => true,
			'is_active'      => $_SERVER['REQUEST_URI'] === '/results/' ? true : false,
			'priority'       => 0.9,
			'changefreq'     => 'monthly',
		],
		[
			'condition'      => 'url',
			'url'            => '/history/',
			'handle'         => HistoryController::class . '@index',
			'menu_title'     => __( 'History', 'run' ),
			'include_in_nav' => true,
			'is_active'      => $_SERVER['REQUEST_URI'] === '/history/' ? true : false,
			'priority'       => 0.9,
			'changefreq'     => 'monthly',
		],
		[
			'condition'      => 'url',
			'url'            => '/articles/',
			'handle'         => ArticlesController::class . '@index',
			'menu_title'     => __( 'Posts', 'run' ),
			'include_in_nav' => true,
			'is_active'      => ( strpos( $_SERVER['REQUEST_URI'], '/articles/' ) !== false ) ? true : false,
			'priority'       => 0.9,
			'changefreq'     => 'daily',
		],
		[
			'condition'      => 'url',
			'url'            => '/articles/page/{page_number}',
			'matches'        => [ 'page_number' => '/^\d+$/', ],
			'handle'         => ArticlesController::class . '@index',
			'include_in_nav' => false,
		],
		[
			'condition'      => 'url',
			'url'            => '/articles/category/{category_slug}',
			'handle'         => ArticlesController::class . '@show_category',
			'include_in_nav' => false,
		],
		[
			'condition'      => 'url',
			'url'            => '/articles/category/{category_slug}/page/{page_number}',
			'matches'        => [ 'page_number' => '/^\d+$/', ],
			'handle'         => ArticlesController::class . '@show_category',
			'include_in_nav' => false,
		],
		[
			'condition'      => 'url',
			'url'            => '/articles/{post_slug}',
			'handle'         => PostController::class . '@index',
			'include_in_nav' => false,
		],
		[
			'condition'      => 'url',
			'url'            => '/about/',
			'handle'         => AboutController::class . '@index',
			'menu_title'     => __( 'About me', 'run' ),
			'include_in_nav' => true,
			'is_active'      => $_SERVER['REQUEST_URI'] === '/about/' ? true : false,
			'priority'       => 0.9,
			'changefreq'     => 'yearly',

		],
//		[
//			'condition'      => 'url',
//			'url'            => '/trainings/',
//			'handle'         => AboutController::class . '@index',
//			'menu_title'     => __( 'About me', 'run' ),
//			'include_in_nav' => true,
//			'is_active'      => $_SERVER['REQUEST_URI'] === '/about/' ? true : false,
//			'priority'       => 0.9,
//			'changefreq'     => 'yearly',
//
//		],
		[
			'condition'      => 'url',
			'url'            => '/{page_slug}',
			'handle'         => PageController::class . '@index',
			'include_in_nav' => false,
		],
	],
];
