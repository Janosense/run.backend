<?php


namespace App\Controllers\Web;


class PostController {
	static $post_categories;

	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 * @param string $post_slug
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view, $post_slug ) {
		global $post;

		if ( ! empty( $post ) && $post_slug == $post->post_name ) {
			$data          = $this->prepare_post_data( $post );
			$similar_posts = $this->get_similar_posts( $post );
			$events        = new CalendarController();
			$results       = new ResultsController();

			return \WPEmerge\view( 'templates/post.twig' )->with( [
				'url'              => $request->getUrl(),
				'post'             => $data,
				'statistics'       => StatisticsController::get_statistics(),
				'meta_description' => carbon_get_post_meta( $post->ID, 'crb_meta_description' ),
				'meta_image'       => carbon_get_post_meta( $post->ID, 'crb_meta_image' ),
				'similar_posts'    => $similar_posts,
				'last_results'     => $results->get_last_results( 5 ),
				'last_events'      => $events->get_upcoming_events( 3 ),
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
		$categories_data = $this->get_post_categories( $post );
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

	/**
	 * @param $post
	 *
	 * @return array|\WP_Error
	 */
	private function get_post_categories( $post ) {
		if ( empty( self::$post_categories ) ) {
			$data = wp_get_post_categories( $post->ID, [ 'fields' => 'all' ] );
			if ( ! empty( $data ) && ! is_wp_error( $data ) ) {
				self::$post_categories = $data;

				return $data;
			}

			return [];
		}

		return self::$post_categories;
	}


	/**
	 * @param \WP_Post $post
	 *
	 * @return array
	 */
	private function get_similar_posts( $post ) {
		$data            = [];
		$categories_ids  = [ 19 ];
		$categories_data = $this->get_post_categories( $post );

		if ( ! empty( $categories_data ) && ! is_wp_error( $categories_data ) ) {
			foreach ( $categories_data as $category ) {
				if ( $category->term_id != 1 ) {
					$categories_ids[] = $category->term_id;
				}
			}
		}

		$similar_posts = get_posts( [
			'numberposts' => 5,
			'category'    => $categories_ids,
			'exclude'     => $post->ID,
			'post_type'   => 'post'
		] );

		if ( ! empty( $similar_posts ) ) {
			foreach ( $similar_posts as $similar_post ) {
				$data[] = [
					'title'     => $similar_post->post_title,
					'date'      => date( 'd.m.Y', strtotime( $similar_post->post_date ) ),
					'permalink' => '/articles/' . $similar_post->post_name,
				];
			}
		}

		return $data;
	}
}
