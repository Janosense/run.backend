<?php

namespace App\Controllers\Web;

class ArticlesController {

	/**
	 * @param $request
	 * @param $view
	 * @param int $page_number
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view, $page_number = 1 ) {
		$total_count_posts = wp_count_posts()->publish;
		$articles          = $this->get_articles( $total_count_posts, $page_number );
		if ( ! empty( $articles ) ) {
			$data = $this->prepare_articles_data( $articles );

			return \WPEmerge\view( 'templates/articles.twig' )->with( [
				'articles'   => $data,
				'title'      => __( 'Posts', 'run' ),
				'pagination' => $this->get_pagination( $total_count_posts, $page_number, '/articles/page/%_%/' ),
			] );
		}

		return \WPEmerge\redirect()->to( '/articles/' );
	}

	/**
	 * @param $request
	 * @param $view
	 * @param string $category_slug
	 * @param int $page_number
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\WPEmerge\View\ViewInterface
	 */
	public function show_category( $request, $view, $category_slug, $page_number = 1 ) {
		$category          = get_category_by_slug( $category_slug );
		$total_count_posts = $category->category_count;
		$articles          = $this->get_articles( $total_count_posts, $page_number, $category_slug );
		if ( ! empty( $articles ) ) {
			$data            = $this->prepare_articles_data( $articles );
			$pagination_base = '/articles/category/' . $category_slug . '/page/%_%/';

			return \WPEmerge\view( 'templates/articles.twig' )->with( [
				'articles'   => $data,
				'title'      => sprintf( __( 'Category: %s', 'text_domain' ), $category->cat_name ),
				'pagination' => $this->get_pagination( $total_count_posts, $page_number, $pagination_base ),
			] );
		}

		return \WPEmerge\redirect()->to( '/articles/' );
	}

	/**
	 * @param \WP_Post[] $articles
	 *
	 * @return array
	 */
	private function prepare_articles_data( $articles ) {
		$data = [];
		foreach ( $articles as $article ) {
			$date            = date( 'd.m.Y', strtotime( $article->post_date ) );
			$categories      = [];
			$categories_data = wp_get_post_categories( $article->ID, [ 'fields' => 'all' ] );
			$excerpt         = $article->post_excerpt;
			if ( empty( $excerpt ) ) {
				$content = apply_filters( 'the_content', $article->post_content );
				$content = wp_strip_all_tags( $content );
				$excerpt = mb_substr( $content, 0, 172 ) . '...';
			}

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

			$data[ $article->ID ] = [
				'title'      => $article->post_title,
				'date'       => $date,
				'excerpt'    => $excerpt,
				'categories' => $categories,
				'permalink'  => '/articles/' . $article->post_name,
			];
		}

		return $data;
	}

	/**
	 * @param int $page_number
	 * @param string $category_slug
	 *
	 * @return int[]|\WP_Post[]|null
	 */
	private function get_articles( $total_count_posts, $page_number = 1, $category_slug = '' ) {
		$posts_per_page = get_option( 'posts_per_page' );
		if ( ( $posts_per_page * $page_number - $total_count_posts ) < $posts_per_page ) {
			$offset = $posts_per_page * $page_number - $posts_per_page;

			$args = [
				'numberposts' => $posts_per_page,
				'offset'      => $offset,
				'post_type'   => 'post'
			];

			if ( ! empty( $category_slug ) ) {
				$args['category_name'] = $category_slug;
			}


			return get_posts( $args );
		}

		return null;
	}

	/**
	 * @param int $total_count_posts
	 * @param int $page_number
	 * @param string $base
	 *
	 * @return array|string|void
	 */
	private function get_pagination( $total_count_posts, $page_number, $base ) {
		$posts_per_page = get_option( 'posts_per_page' );
		$args           = [
			'base'               => $base,
			'format'             => '%#%',
			'total'              => ceil( $total_count_posts / $posts_per_page ),
			'current'            => $page_number,
			'show_all'           => false,
			'end_size'           => 1,
			'mid_size'           => 1,
			'prev_next'          => true,
			'prev_text'          => __( 'Previous', 'run' ),
			'next_text'          => __( 'Next', 'run' ),
			'type'               => 'array',
			'add_args'           => false,
			'add_fragment'       => '',
			'before_page_number' => '',
			'after_page_number'  => ''
		];

		$pagination = paginate_links( $args );
		if ( ! empty( $pagination ) && $page_number = 2 ) {
			foreach ( $pagination as $key => $link ) {
				$search             = str_replace( '%_%', '', $base );
				$replace            = str_replace( 'page/%_%/', '', $base );
				$pagination[ $key ] = str_replace( $search, $replace, $link );
			}
		}

		return $pagination;
	}
}
