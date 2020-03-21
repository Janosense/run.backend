<?php


namespace App\Controllers\Web;


class PageController {

	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 * @param string $page_slug
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view, $page_slug ) {
		global $post;

		if ( ! empty( $post ) && $page_slug == $post->post_name ) {
			$data = $this->prepare_page_data( $post );

			return \WPEmerge\view( 'templates/page.twig' )->with( [
				'post'       => $data,
			] );
		}

		return \WPEmerge\redirect()->to( '/' );
	}

	/**
	 * @param \WP_Post $post
	 *
	 * @return array
	 */
	private function prepare_page_data( $post ) {
		$data = [
			'ID'         => $post->ID,
			'date'       => date( 'd.m.Y', strtotime( $post->post_date ) ),
			'title'      => $post->post_title,
			'excerpt'    => $post->post_excerpt,
			'content'    => apply_filters( 'the_content', $post->post_content ),
		];

		return $data;
	}
}
