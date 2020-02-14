<?php


namespace App\Controllers\Web;


class PostController {
	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 * @param string $post_slug
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view, $post_slug ) {
		$post = $this->get_post( $post_slug );
		if ( ! empty( $post ) ) {
			$data = $this->prepare_post_data( $post );

			return \WPEmerge\view( 'templates/post.twig' )->with( [
				'post' => $data,
			] );
		}

		return \WPEmerge\redirect()->to( '/' );
	}

	/**
	 * @param \WP_Post $post
	 *
	 * @return array
	 */
	private function prepare_post_data( $post ) {
		$categories      = [];
		$categories_data = wp_get_post_categories( $post->ID, [ 'fields' => 'all' ] );
		if ( ! empty( $categories_data ) && ! is_wp_error( $categories_data ) ) {
			foreach ( $categories_data as $category ) {
				if ( $category->term_id != 1 ) {
					$categories[] = [
						'title'     => $category->name,
						'permalink' => '/articles/category/' . $category->slug,
					];
				}
			}
		}

		$data = [
			'ID'         => $post->ID,
			'date'       => date( 'd.m.Y', strtotime( $post->post_date ) ),
			'title'      => $post->post_title,
			'excerpt'    => $post->post_excerpt,
			'content'    => apply_filters( 'the_content', $post->post_content ),
			'categories' => $categories,
		];

		return $data;
	}

	/**
	 * @param string $post_slug
	 *
	 * @return \WP_Post|null
	 */
	private function get_post( $post_slug ) {
		$posts = get_posts( [
			'numberposts' => 1,
			'post_type'   => 'post',
			'name'        => $post_slug,
		] );

		if ( ! empty( $posts ) && ! is_wp_error( $posts ) ) {
			return $posts[0];
		}

		return null;
	}
}
