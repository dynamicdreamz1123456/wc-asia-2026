# Architecture Overview

The plugin adheres to a simple yet secure architecture using native WordPress integration points. 

## Files and Structure

* `plugin/wcasia-event-submissions.php`
  * This is the main plugin file. It handles bootstrapping, defines constants (`WCASIA_EVENTS_VERSION`, `WCASIA_EVENTS_PATH`), registers the `wcasia_event` custom post type, and registers the `[event_submission_form]` shortcode.
* `plugin/includes/class-submission-handler.php`
  * Contains the core business logic in the `WCASIA_Submission_Handler` class. 
  * Intercepts frontend submissions using `admin-post.php` via the hooks `admin_post_wcasia_submit_event` and `admin_post_nopriv_wcasia_submit_event`.
  * Runs security checks (nonces), sanitizes inputs, validates the payload, triggers insertion using `wp_insert_post()`, updates specific post meta, and fires the `wcasia_event_submitted` action hook.
* `plugin/templates/submission-form.php`
  * The frontend HTML template. Included via output buffering when the shortcode is processed.
  * Implements security elements such as `wp_nonce_field()` and ensures action targets point to `admin-post.php` correctly. Contains the success feedback message for users post-submission.

## Database & Data Model

- **Post Type**: `wcasia_event`
- **Post Meta**:
  - `_event_date`: Event date stored in `Y-m-d` format.
  - `_event_location`: Free-text location string.
  - `_submitter_email`: Submitter's email address.

## Custom Hooks
- **Action**: `wcasia_event_submitted($post_id, $data)` fires successfully after a valid event post is created.
- **Filter**: `wcasia_submission_errors($errors)` allows filtering the array of validation error messages.
