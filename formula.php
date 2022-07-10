<?php
// pre get posts filter
add_filter('pre_get_posts','better_editions_archive');
function better_editions_archive( $query ) {

    if( $query->query['post_type'] == 'community_post' ){
        /*$meta_query = array(
          array(
            'lat_clause' => array(
              'key' => 'lat',
              'compare' => 'EXISTS'
            )
          ),
          array(
            'lng_clause' => array(
              'key' => 'lng',
              'compare' => 'EXISTS'
            )
          )
        );
        $query->set('meta_query', $meta_query);
        $query->set('orderby', array('lat_clause' => 'ASC', 'lng_clause' => 'ASC'));*/
 
        $query->set('geo_query', array(
            'lat_field' => 'lat',// this is the name of the meta field storing latitude
            'lng_field' => 'lng', // this is the name of the meta field storing longitude 
            'latitude' => get_user_current_location('lat'), // this is the latitude of the point we are getting distance from
            'longitude' => get_user_current_location('lng'),// this is the longitude of the point we are getting distance from
            'distance' => 30,// this is the maximum distance to search
            'units' => 'km'// this supports options: miles, mi, kilometers, km
        ));

        $query->set( 'orderby', 'distance' );
        $query->set('order', 'ASC'); 
        //$query->set('orderby', array('lat_clause' => 'ASC', 'lng_clause' => 'ASC'));
    
    }
    
    print_r('<pre>');
	//print_r( $query );
	print_r('</pre>');	
	
    return $query;
}

//WP QUERY
    $query = new WP_Query(array(
        'post_type' => 'community_post',
        'geo_query' => array(
            'lat_field' => 'lat',// this is the name of the meta field storing latitude
            'lng_field' => 'lng', // this is the name of the meta field storing longitude 
            'latitude' => get_user_current_location('lat'), // this is the latitude of the point we are getting distance from
            'longitude' => get_user_current_location('lng'),// this is the longitude of the point we are getting distance from
            'distance' => 30,// this is the maximum distance to search
            'units' => 'km'// this supports options: miles, mi, kilometers, km
        ),
        'orderby' => 'distance', // this tells WP Query to sort by distance
        'order' => 'ASC'
    ));
