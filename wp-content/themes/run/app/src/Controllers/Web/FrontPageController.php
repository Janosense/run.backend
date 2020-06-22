<?php


namespace App\Controllers\Web;

class FrontPageController {

	/**
	 * @param \WPEmerge\Requests\Request $request
	 * @param string $view
	 *
	 * @return \WPEmerge\View\ViewInterface
	 */
	public function index( $request, $view ) {
		$articles_data = [];
		$articles      = $this->get_articles( 10 );

		if ( ! empty( $articles ) ) {
			$articles_controller = new ArticlesController();
			$articles_data       = $articles_controller->prepare_articles_data( $articles );
		}

		$results = new ResultsController();
		$events  = new CalendarController();

		return \WPEmerge\view( 'templates/front-page.twig' )->with( [
			'latest_posts' => $articles_data,
			'statistics'   => StatisticsController::get_statistics(),
//			'activities'   => TrainingsController::get_activities_list(),
			'last_results' => $results->get_last_results( 5 ),
//			'last_events'  => $events->get_upcoming_events( 3 ),
		] );
	}

	/**
	 * @return int[]|\WP_Post[]
	 */
	private function get_articles( $numberposts = 3 ) {
		return get_posts( [
			'numberposts' => $numberposts,
			'post_type'   => 'post',
		] );
	}
}
