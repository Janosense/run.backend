<?php
/**
 * WP Emerge configuration.
 *
 * @link https://docs.wpemerge.com/#/framework/configuration
 *
 * @package WPEmergeTheme
 */

return [
	'providers' => [
		\App\View\ViewGlobalContextServiceProvider::class,
		\WPEmergeTwig\View\ServiceProvider::class,
	],
	'routes'    => [
		'web' => APP_APP_ROUTES_DIR . 'web.php',
	],
	'twig' => [
		'options' => [
			'cache' => get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'twig',
//			'cache' => false,
		],
	],
];
