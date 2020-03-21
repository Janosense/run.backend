<?php


namespace App\Controllers\Web;


class AboutController {

	/**
	 * @param $request
	 * @param $view
	 *
	 * @return \Psr\Http\Message\ResponseInterface|\WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		global $post;

		if ( ! empty( $post ) ) {
			$data  = $this->prepare_page_data( $post );
			$goals = $this->get_goals( $post->ID );

			return \WPEmerge\view( 'templates/about.twig' )->with( [
				'statistics' => StatisticsController::get_statistics(),
				'post'       => $data,
				'goals'      => $goals,
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
			'ID'      => $post->ID,
			'date'    => date( 'd.m.Y', strtotime( $post->post_date ) ),
			'title'   => $post->post_title,
			'excerpt' => $post->post_excerpt,
			'content' => apply_filters( 'the_content', $post->post_content ),
		];

		return $data;
	}

	/**
	 * @param int $post_id
	 *
	 * @return mixed
	 */
	private function get_goals( $post_id ) {
		$data  = [];
		$goals = carbon_get_post_meta( $post_id, 'crb_goals' );

		if ( ! empty( $goals ) ) {
			foreach ( $goals as $goal ) {
				$data[] = [
					'state'       => $goal['crb_goal_state'],
					'title'       => $goal['crb_goal_title'],
					'description' => $goal['crb_goal_description'],
				];
			}
		}

		return $data;
	}
}
