<?php
/**
 * Handles all the classes initilization
 *
 * @package Lms_ulearn
 */

namespace ulearn;

defined( 'ABSPATH' ) || exit;

/**
 * Init class
 *
 * @package Lms_ulearn
 */
final class Init {

	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return array(
			customizer\customizer::class,
		);
	}

	/**
	 * Loop through the classes, initialize them, and call the register() method if it exists
	 *
	 * @return void
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param class $class class from the services array.
	 *
	 * @return class instance   new instance of the class
	 */
	private static function instantiate( $class ) {
		return new $class();
	}
}
