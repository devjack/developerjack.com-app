<?php
define( 'THEME_VERSION', '0.0.1' );

function developerjack_app_scripts() {
    $root = get_template_directory_uri();

    wp_enqueue_style( 'app', $root . '/static/css/app.css', NULL, null, 'all' );

    wp_enqueue_script('manifest', $root . '/static/js/manifest.js', NULL, null, TRUE);
    wp_enqueue_script('vendor', $root . '/static/js/vendor.js', NULL, null, TRUE);
    wp_enqueue_script('app', $root . '/static/js/app.js', NULL, null, TRUE);
}
add_action( 'wp_enqueue_scripts', 'developerjack_app_scripts' );

// function developerjack_app_customize_register( $wp_customize ) {
//     //All our sections, settings, and controls will be added here
//     $wp_customize->add_setting( 'app_baseurl' , array(
//         'default'   => 'https://app.developerjack.com/',
//         'transport' => 'refresh',
//     ) );

//     $wp_customize->add_section( 'developerjack_app_spa_settings' , array(
//         'title'      => __( 'App Settings', 'spa_settings' ),
//         'priority'   => 30,
//     ) );

//     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'app_baseurl', array(
//         'label'      => __( 'App Base URI', 'developerjack_app' ),
//         'section'    => 'developerjack_app_spa_settings',
//         'settings'   => 'app_baseurl',
//     ) ) );
//  }
//  add_action( 'customize_register', 'developerjack_app_customize_register' );

// function developerjack_app_setup() {
//     add_theme_support( 'title-tag' );
// }
// add_action( 'after_setup_theme', 'developerjack_app_setup');

add_action( 'rest_api_init', function() {
    
	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
	add_filter( 'rest_pre_serve_request', function( $value ) {
        header( 'Access-Control-Allow-Origin: *' );
		header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
		header( 'Access-Control-Allow-Credentials: true' );

		return $value;
		
	});
}, 15 );
?>
