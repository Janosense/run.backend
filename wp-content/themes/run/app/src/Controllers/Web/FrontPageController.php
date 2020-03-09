<?php


namespace App\Controllers\Web;

use App\Controllers\Web\TrainingsController;

class FrontPageController {

	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		$articles_data = [];
		$articles      = $this->get_articles();

		if ( ! empty( $articles ) ) {
			$articles_controller = new ArticlesController();
			$articles_data       = $articles_controller->prepare_articles_data( $articles );
		}

		return \WPEmerge\view( 'templates/front-page.twig' )->with( [
			'articles'   => $articles_data,
			'statistics' => StatisticsController::get_statistics(),
			'activities' => TrainingsController::get_activities_list(),
		] );
	}

	/**
	 * @return int[]|\WP_Post[]
	 */
	private function get_articles() {
		return get_posts( [
			'numberposts' => 3,
			'post_type'   => 'post',
		] );
	}
}
