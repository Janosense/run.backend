<?php

use App\Controllers\Web\AboutController;
use App\Controllers\Web\ArticlesController;
use App\Controllers\Web\CalendarController;
use App\Controllers\Web\FrontPageController;
use App\Controllers\Web\HistoryController;
use App\Controllers\Web\PostController;
use App\Controllers\Web\ResultsController;

return [
	'web' => [
		[
			'condition'  => 'where',
			'field'      => 'post_type',
			'value'      => 'post',
			'handle'     => PostController::class . '@index',
			'menu_title' => false
		],
		[
			'condition'  => 'url',
			'url'        => '/',
			'handle'     => FrontPageController::class . '@index',
			'menu_title' => __( 'Home', 'run' ),
			'is_active'  => $_SERVER['REQUEST_URI'] === '/' ? true : false,
		],
		[
			'condition'  => 'url',
			'url'        => '/calendar/',
			'handle'     => CalendarController::class . '@index',
			'menu_title' => __( 'Calendar', 'run' ),
			'is_active'  => $_SERVER['REQUEST_URI'] === '/calendar/' ? true : false,
		],
		[
			'condition'  => 'url',
			'url'        => '/results/',
			'handle'     => ResultsController::class . '@index',
			'menu_title' => __( 'Results', 'run' ),
			'is_active'  => $_SERVER['REQUEST_URI'] === '/results/' ? true : false,
		],
		[
			'condition'  => 'url',
			'url'        => '/history/',
			'handle'     => HistoryController::class . '@index',
			'menu_title' => __( 'History', 'run' ),
			'is_active'  => $_SERVER['REQUEST_URI'] === '/history/' ? true : false,
		],
		[
			'condition'  => 'url',
			'url'        => '/articles/',
			'handle'     => ArticlesController::class . '@index',
			'menu_title' => __( 'Posts', 'run' ),
			'is_active'  => $_SERVER['REQUEST_URI'] === '/articles/' ? true : false,
		],
		[
			'condition'  => 'url',
			'url'        => '/about/',
			'handle'     => AboutController::class . '@index',
			'menu_title' => __( 'About me', 'run' ),
			'is_active'  => $_SERVER['REQUEST_URI'] === '/about/' ? true : false,
		],
	],
];
