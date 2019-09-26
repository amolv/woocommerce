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
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_requirements_check' ),
					'permission_callback' => array( $this, 'check_permission' ),
				),
			)
		);
	}

	/**
	 * Check permissions.
	 *
	 * @since 3.7.1
	 * @param WP_REST_Request $request Full details about the request.
	 * @return bool|WP_Error
	 */
	public function check_permission( $request ) {
		if ( ! current_user_can( 'install_plugins' ) || ! current_user_can( 'install_themes' ) ) {
			return new WP_Error( 'woocommerce_rest_cannot_install_product', __( 'You do not have permission to install plugin or theme', 'woocommerce' ), array( 'status' => 401 ) );
		}

		return true;
	}

	/**
	 * Returns the installer/requirements_check response
	 *
	 * @since 3.7.1
	 * @param WP_REST_Request $request The incoming request.
	 * @return WP_REST_Response|mixed
	 */
	public function get_requirements_check( $request ) {
		return rest_ensure_response( WC_WCCOM_Site_Installer_Requirements_Check::get_requirement_check_response() );
	}
}
