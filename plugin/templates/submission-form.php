<?php
/**
 * Frontend event submission form template.
 *
 * Rendered via the [event_submission_form] shortcode.
 *
 * @package WCasia_Event_Submissions
 */

defined( 'ABSPATH' ) || exit;
?>

<?php if ( isset( $_GET['event_submitted'] ) && '1' === $_GET['event_submitted'] ) : ?>
	<div class="wcasia-notice wcasia-notice--success">
		<p><?php esc_html_e( 'Thank you! Your event has been submitted for review.', 'wcasia-events' ); ?></p>
	</div>
<?php endif; ?>

<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="wcasia-submission-form">
	<?php wp_nonce_field( 'wcasia_submit_event', 'wcasia_nonce' ); ?>
	<input type="hidden" name="action" value="wcasia_submit_event">

	<p>
		<label for="event_title"><?php esc_html_e( 'Event Title', 'wcasia-events' ); ?></label>
		<input type="text" id="event_title" name="event_title" required>
	</p>

	<p>
		<label for="event_date"><?php esc_html_e( 'Event Date', 'wcasia-events' ); ?></label>
		<input type="date" id="event_date" name="event_date" required>
	</p>

	<p>
		<label for="event_location"><?php esc_html_e( 'Location', 'wcasia-events' ); ?></label>
		<input type="text" id="event_location" name="event_location" required>
	</p>

	<p>
		<label for="submitter_email"><?php esc_html_e( 'Your Email', 'wcasia-events' ); ?></label>
		<input type="email" id="submitter_email" name="submitter_email" required>
	</p>

	<p>
		<button type="submit" class="wcasia-submit-btn">
			<?php esc_html_e( 'Submit Event', 'wcasia-events' ); ?>
		</button>
	</p>
</form>
