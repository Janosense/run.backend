<?php


namespace App\Controllers\Web;


class AboutController {
	public function index( $request, $view ) {
		global $post;

		if ( ! empty( $post ) ) {
			$data = $this->prepare_page_data( $post );
		}

		return \WPEmerge\view( 'templates/about.twig' )->with( [
			'statistics' => StatisticsController::get_statistics(),
			'post'       => $data,
		] );
	}

	/**
	 * @param \WP_Post $post
	 *
	 * @return array
	 */
	private function prepare_page_data( $post ) {
		$data = [
			'ID'      => $post->ID,
			'date'    => date( 'd.m.Y', strtotime( $post->post_date ) ),
			'title'   => $post->post_title,
			'excerpt' => $post->post_excerpt,
			'content' => apply_filters( 'the_content', $post->post_content ),
		];

		return $data;
	}
}
