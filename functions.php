<?php

class ChildTheme {

	function __construct() {

		add_filter( 'upload_mimes', 		array( $this, 'mime_types' ) );
		add_filter( 'body_class',   		array( $this, 'add_slug_to_body_class' ) );
		add_action( 'send_headers', 		array( $this, 'custom_headers' ) );
		// add_action( 'wp_enqueue_scripts', 	array( $this, 'typekit' ) );

		$this->roots_support();
	}

	/**
	 * Add custom allowed media upload file types.
	 */

	public function mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Add page slug as a body class.
	 */

	public function add_slug_to_body_class( $classes ) {
		global $post;
		if ( isset( $post ) ) {
			$classes[] = $post->post_type . '-' . $post->post_name;
		}
		return $classes;
	}

	/**
	 * Add custom headers.
	 */
	public function custom_headers() {
		header( 'Access-Control-Allow-Origin: *' );
	}

	/**
	 * Add theme support for Soil functions. Helps clean up WordPress markup.
	 */

	public function roots_support() {
		add_theme_support( 'soil-clean-up' );
		add_theme_support( 'soil-disable-asset-versioning' );
		add_theme_support( 'soil-disable-trackbacks' );
		// add_theme_support( 'soil-google-analytics', 'UA-XXXXXXXX-Y' );
		add_theme_support( 'soil-jquery-cdn' );
		// add_theme_support( 'soil-js-to-footer' );
		add_theme_support( 'soil-nav-walker' );
		add_theme_support( 'soil-nice-search' );
		add_theme_support( 'soil-relative-urls' );
	}

	/**
	 * Add typekit support if needed. Replace $kit_id with one from the kit you create.
	 */
	public function typekit() {
		$kit_id = 'abcd123';
		wp_enqueue_script( 'theme_typekit', 'https://use.typekit.net/' . $kit_id . '.js' );
		wp_add_inline_script( 'theme_typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
	}
}

new ChildTheme();
