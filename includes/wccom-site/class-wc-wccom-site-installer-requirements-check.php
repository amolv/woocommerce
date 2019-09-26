<?php
/**
 * WooCommerce.com Product Installation Requirements Check.
 *
 * @package WooCommerce\WooCommerce_Site
 * @since   3.7.1
 */

defined( 'ABSPATH' ) || exit;

/**
 * WC_WCCOM_Site_Installer_Requirements_Check Class
 * Contains functionality to check the necessary requirements for the installer.
 */
class WC_WCCOM_Site_Installer_Requirements_Check {
	/**
	 * Builds and return the requirements check.
	 *
	 * @version 3.7.1
	 * @return array
	 */
	public static function get_requirement_check_response() {
		$passed = true;
		$errors = array();

		if ( ! self::met_wp_cron_requirement() ) {
			$passed   = false;
			$errors[] = 'wp_cron';
		}

		if ( ! self::met_filesystem_requirement() ) {
			$passed   = false;
			$errors[] = 'filesystem';
		}

		return array(
			'passed' => $passed,
			'errors' => $errors,
		);
	}

	/**
	 * Validates if WP CRON is enabled.
	 *
	 * @since 3.7.1
	 * @return bool
	 */
	private static function met_wp_cron_requirement() {
		return ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON );
	}

	/**
	 * Validates if `WP_CONTENT_DIR` is writable.
	 *
	 * @since 3.7.1
	 * @return bool
	 */
	private static function met_filesystem_requirement() {
		return is_writable( WP_CONTENT_DIR );
	}
}
