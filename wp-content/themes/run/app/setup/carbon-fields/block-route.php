<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

Block::make( __( 'Route' ) )
     ->add_fields( [
	     Field::make( 'file', 'crb_route_file_id', __( 'File', 'run' ) )
	          ->set_type( '.gpx' ),
	     Field::make( 'text', 'crb_route_distance', __( 'Route distance', 'run' ) ),
	     Field::make( 'text', 'crb_route_location', __( 'Route location', 'run' ) ),
     ] )
     ->set_icon( 'location-alt' )
     ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
	     global $post;

	     if ( ! is_single() ) {
		     return null;
	     }

	     if ( empty( $fields['crb_route_file_id'] ) ) {
		     return null;
	     }

	     $meta_key   = 'route_' . $fields['crb_route_file_id'] . '_' . $post->ID;
	     $route_data = get_post_meta( $post->ID, $meta_key, true );

	     if ( empty( $route_data ) ) {

		     $file_path = get_attached_file( $fields['crb_route_file_id'] );

		     if ( ! empty( $file_path ) ) {

			     $route                  = simplexml_load_file( $file_path );
			     $route_data             = [];
			     $kms                    = 1;
			     $index                  = 0;
			     $route_data['distance'] = 0;

			     foreach ( $route->trk->trkseg->trkpt as $point ) {
				     $route_data['points'][] = [
					     'lat' => (float) $point['lat'],
					     'lng' => (float) $point['lon'],
				     ];

				     if ( $route_data['distance'] >= $kms ) {
					     $route_data['markers'][] = [
						     'lat' => (float) $point['lat'],
						     'lng' => (float) $point['lon'],
					     ];
					     $kms ++;
				     }

				     if ( $index > 0 ) {
					     $route_data['distance'] += calculate_distance_gds_method( $route_data['points'][ $index - 1 ]['lat'], $route_data['points'][ $index - 1 ]['lng'], (float) $point['lat'], (float) $point['lon'], 'K' );
				     }

				     $index ++;
			     }

			     update_post_meta( $post->ID, $meta_key, $route_data );
		     }
	     } ?>

	     <div class="map">
		     <ul class="map__info">
			     <li class="map__info-item">
				     <span>Дистанция:</span> <?php echo $fields['crb_route_distance']; ?> км
			     </li>
			     <li class="map__info-item">
				     <span>Локация:</span> <?php echo $fields['crb_route_location']; ?>
			     </li>
		     </ul>
		     <div class="map__holder">
			     <div class="map__content" data-meta-key="<?php echo $meta_key; ?>" data-post-id="<?php echo $post->ID; ?>"></div>
		     </div>
	     </div>

	     <script>
		     async function app_init_map() {
			     const map_container = document.querySelector('.map__content');
			     const post_id = map_container.dataset.postId;
			     const meta_key = map_container.dataset.metaKey;

			     if (post_id && meta_key) {
				     const url = `/wp-json/run-app/v1/route/?post_id=${post_id}&meta_key=${meta_key}`;
				     const response = await fetch(url);
				     const route_data = await response.json();

				     const map_settings = {
					     zoom: 14,
					     mapTypeId: 'roadmap',
				     };
				     const polyline_settings = {
					     path: route_data[0]['points'],
					     geodesic: true,
					     strokeColor: '#000000',
					     strokeOpacity: 0.4,
					     strokeWeight: 4
				     };
				     const icon_settings = {
					     path: 'M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5Z',
					     fillColor: 'black',
					     fillOpacity: 1,
					     scale: 1.2,
					     strokeColor: 'white',
					     strokeWeight: 2,
					     anchor: new google.maps.Point(8, 8),
					     labelOrigin: new google.maps.Point(9, 8),
				     };

				     const map = new google.maps.Map(map_container, map_settings);
				     const polyline = new google.maps.Polyline(polyline_settings);
				     const bounds = new google.maps.LatLngBounds();

				     route_data[0]['markers'].forEach((marker, index) => {
					     const position = new google.maps.LatLng(marker['lat'], marker['lng']);

					     new google.maps.Marker({
						     position: position,
						     map: map,
						     label: {
							     text: index + 1 + "",
							     color: '#FFFFFF',
							     fontSize: '12px',
							     fontFamily: 'Source Sans Pro',
							     fontWeight: '600',
						     },
						     zIndex: index,
						     icon: icon_settings,
					     });

					     bounds.extend(position);
				     });

				     polyline.setMap(map);
				     map.fitBounds(bounds);
			     }
		     }
	     </script>
	     <script async
	             src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiqkYQYJ-rZ4SSMalpJo5PlbtvfNhnn5I&callback=app_init_map">
	     </script>

     <?php } );
