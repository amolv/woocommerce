<?php
/**
 * WCCOM Site Installer Requirements Check REST API Controller
 * Handles requests to /installer/requirements_check.
 *
 * @package WooCommerce\WooCommerce_Site\Rest_Api
 * @since   3.7.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * REST API WCCOM Site Installer Requirements Check Controller Class.
 *
 * @package WooCommerce/WCCOM_Site/REST_API
 * @extends WC_REST_Controller
 */
class WC_REST_WCCOM_Site_Installer_Requirements_Check_Controller extends WC_REST_Controller {

	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'wccom-site/v1';

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'installer/requirements_check';

	/**
	 * Register the route for installer requirements check.
	 *
	 * @since 3.7.1
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'  => WP_REST_Server::READABLE,
					'callback' => array( $this, 'get_requirements_check' ),
				),
			)
		);
	}

	/**
	 * Returns the installer/requirements_check response
	 *
	 * @since 3.7.1
	 * @param WP_REST_Request $request The incoming request.
	 * @return WP_REST_Response|mixed
	 */
	public function get_requirements_check( $request ) {
		$response = array(
			'passed' => true,
			'errors' => array(),
		);

		return rest_ensure_response( $response );
	}
}
