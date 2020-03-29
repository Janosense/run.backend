<?php
/**
 * Calculates the distance between two points
 *
 * @param float $lat1
 * @param float $lon1
 * @param float $lat2
 * @param float $lon2
 * @param string $unit
 *
 * @return float|int
 */
function calculate_distance_gds_method( $lat1, $lon1, $lat2, $lon2, $unit ) {
	if ( ( $lat1 == $lat2 ) && ( $lon1 == $lon2 ) ) {
		return 0;
	} else {
		$theta = $lon1 - $lon2;
		$dist  = sin( deg2rad( $lat1 ) ) * sin( deg2rad( $lat2 ) ) + cos( deg2rad( $lat1 ) ) * cos( deg2rad( $lat2 ) ) * cos( deg2rad( $theta ) );
		$dist  = acos( $dist );
		$dist  = rad2deg( $dist );
		$miles = $dist * 60 * 1.1515;
		$unit  = strtoupper( $unit );

		if ( $unit == "K" ) {
			return ( $miles * 1.609344 );
		} else if ( $unit == "N" ) {
			return ( $miles * 0.8684 );
		} else {
			return $miles;
		}
	}
}


/**
 * Calculates the great-circle distance between two points, with
 * the Vincenty formula.
 *
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float|int $earthRadius Mean earth radius in [m]
 *
 * @return float|int Distance between points in [m] (same as earthRadius)
 */
function calculate_distance_vincenty_method( $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000 ) {
	// convert from degrees to radians
	$latFrom = deg2rad( $latitudeFrom );
	$lonFrom = deg2rad( $longitudeFrom );
	$latTo   = deg2rad( $latitudeTo );
	$lonTo   = deg2rad( $longitudeTo );

	$lonDelta = $lonTo - $lonFrom;
	$a        = pow( cos( $latTo ) * sin( $lonDelta ), 2 ) +
	            pow( cos( $latFrom ) * sin( $latTo ) - sin( $latFrom ) * cos( $latTo ) * cos( $lonDelta ), 2 );
	$b        = sin( $latFrom ) * sin( $latTo ) + cos( $latFrom ) * cos( $latTo ) * cos( $lonDelta );

	$angle = atan2( sqrt( $a ), $b );

	return $angle * $earthRadius;
}

/**
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 *
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float|int $earthRadius Mean earth radius in [m]
 *
 * @return float|int Distance between points in [m] (same as earthRadius)
 */
function calculate_distance_haversine_method(
	$latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000
) {
	// convert from degrees to radians
	$latFrom = deg2rad( $latitudeFrom );
	$lonFrom = deg2rad( $longitudeFrom );
	$latTo   = deg2rad( $latitudeTo );
	$lonTo   = deg2rad( $longitudeTo );

	$latDelta = $latTo - $latFrom;
	$lonDelta = $lonTo - $lonFrom;

	$angle = 2 * asin( sqrt( pow( sin( $latDelta / 2 ), 2 ) +
	                         cos( $latFrom ) * cos( $latTo ) * pow( sin( $lonDelta / 2 ), 2 ) ) );

	return $angle * $earthRadius;
}
