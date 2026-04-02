<?php
/**
 * Handles frontend event submission form processing.
 *
 * @package WCasia_Event_Submissions
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class WCasia_Submission_Handler
 */
class WCasia_Submission_Handler {

	/**
	 * Hook into WordPress.
	 */
	public static function init() {
		add_action( 'admin_post_wcasia_submit_event', array( __CLASS__, 'handle_submission' ) );
		add_action( 'admin_post_nopriv_wcasia_submit_event', array( __CLASS__, 'handle_submission' ) );
	}

	/**
	 * Process the submitted event form.
	 */
	public static function handle_submission() {
		if ( ! isset( $_POST['wcasia_nonce'] ) ||
			! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wcasia_nonce'] ) ), 'wcasia_submit_event' ) ) {
			wp_die( esc_html__( 'Security check failed.', 'wcasia-events' ), 403 );
		}

		$title    = sanitize_text_field( wp_unslash( $_POST['event_title'] ?? '' ) );
		$date     = sanitize_text_field( wp_unslash( $_POST['event_date'] ?? '' ) );
		$location = sanitize_text_field( wp_unslash( $_POST['event_location'] ?? '' ) );
		$email    = sanitize_email( wp_unslash( $_POST['submitter_email'] ?? '' ) );

		$errors = self::validate( $title, $date, $location, $email );

		if ( ! empty( $errors ) ) {
			wp_die( esc_html( implode( ' ', $errors ) ), 400 );
		}

		$post_id = wp_insert_post( array(
			'post_title'  => $title,
			'post_type'   => 'wcasia_event',
			'post_status' => 'pending',
		) );

		if ( is_wp_error( $post_id ) ) {
			wp_die( esc_html__( 'Failed to create event.', 'wcasia-events' ), 500 );
		}

		update_post_meta( $post_id, '_event_date', $date );
		update_post_meta( $post_id, '_event_location', $location );
		update_post_meta( $post_id, '_submitter_email', $email );

		/**
		 * Fires after a new event is successfully created.
		 *
		 * @param int   $post_id The new post ID.
		 * @param array $data    Submitted form data.
		 */
		do_action( 'wcasia_event_submitted', $post_id, array(
			'title'    => $title,
			'date'     => $date,
			'location' => $location,
			'email'    => $email,
		) );

		$redirect = add_query_arg( 'event_submitted', '1', wp_get_referer() );
		wp_safe_redirect( esc_url_raw( $redirect ) );
		exit;
	}

	/**
	 * Validate form fields.
	 *
	 * @param string $title    Event title.
	 * @param string $date     Event date.
	 * @param string $location Event location.
	 * @param string $email    Submitter email.
	 * @return array Validation errors (empty if valid).
	 */
	private static function validate( $title, $date, $location, $email ) {
		$errors = array();

		if ( empty( $title ) ) {
			$errors[] = __( 'Event title is required.', 'wcasia-events' );
		}

		if ( empty( $date ) || ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ) {
			$errors[] = __( 'A valid event date is required (YYYY-MM-DD).', 'wcasia-events' );
		}

		if ( empty( $location ) ) {
			$errors[] = __( 'Event location is required.', 'wcasia-events' );
		}

		if ( empty( $email ) || ! is_email( $email ) ) {
			$errors[] = __( 'A valid email address is required.', 'wcasia-events' );
		}

		/** This filter allows modifying the validation error messages. */
		return apply_filters( 'wcasia_submission_errors', $errors );
	}
}

WCasia_Submission_Handler::init();
