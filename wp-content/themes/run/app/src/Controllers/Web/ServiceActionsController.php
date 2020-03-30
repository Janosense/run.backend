<?php


namespace App\Controllers\Web;

use SimpleXMLElement;

class ServiceActionsController {
	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function flush_twig_cache( $request, $view ) {
		if ( $request->get( 'access_code' ) === APP_ACCESS_CODE && current_user_can( 'manage_options' ) ) {
			$dirname = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'twig/';
			shell_exec( 'rm -rf ' . $dirname );

			return \WPEmerge\redirect()->to( home_url( '/' ) );
		} else {

			return \WPEmerge\output( 'Access denied.' );
		}
	}

	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function generate_xml_sitemap( $request, $view ) {
		if ( $request->get( 'access_code' ) === APP_ACCESS_CODE && current_user_can( 'manage_options' ) ) {
			$url_base     = site_url();
			$routes       = require APP_APP_SETUP_DIR . 'routes.php';
			$sitemap_path = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';
			$xml_template = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';
			$xml          = new SimpleXMLElement( $xml_template );
			$urls         = [];
			$posts        = get_posts( [
				'numberposts' => - 1,
				'post_type'   => 'post',
				'post_status' => 'publish',
			] );
			$pages        = get_posts( [
				'numberposts' => - 1,
				'post_type'   => 'page',
				'post_status' => 'publish',
			] );

			if ( ! empty( $routes ) ) {
				foreach ( $routes['web'] as $route ) {
					if ( $route['include_in_nav'] == true ) {
						$urls[ trim( $route['url'], '/' ) ] = [
							'url'        => $url_base . $route['url'],
							'priority'   => isset( $route['priority'] ) ? $route['priority'] : 0.6,
							'changefreq' => $route['changefreq'],
							'lastmod'    => date( 'Y-m-d H:i:s', time() - 60 * 60 * 24 ),
						];
					}
				}
			}

			if ( ! empty( $posts ) ) {
				foreach ( $posts as $post ) {
					$urls[ trim( $post->post_name, '/' ) ] = [
						'url'        => $url_base . '/articles/' . $post->post_name,
						'priority'   => 0.6,
						'changefreq' => 'yearly',
						'lastmod'    => $post->post_modified_gmt
					];
				}
			}

			if ( ! empty( $pages ) ) {
				foreach ( $pages as $page ) {
					if ( ! isset( $urls[ trim( $page->post_name, '/' ) ] ) ) {
						$urls[ trim( $post->post_name, '/' ) ] = [
							'url'        => $url_base . '/' . $post->post_name,
							'priority'   => 0.6,
							'changefreq' => 'yearly',
							'lastmod'    => $post->post_modified_gmt
						];
					}
				}
			}

			if ( ! empty( $urls ) ) {
				foreach ( $urls as $item ) {
					$url = $xml->addChild( 'url' );
					$url->addChild( 'loc', $item['url'] );
					$url->addChild( 'lastmod', $item['lastmod'] );
					$url->addChild( 'priority', $item['priority'] );
					$url->addChild( 'changefreq', $item['changefreq'] );
				}

				$xml->asXML( $sitemap_path );
			}

			return \WPEmerge\redirect()->to( home_url( '/' ) );
		} else {

			return \WPEmerge\output( 'Access denied.' );
		}
	}
}
