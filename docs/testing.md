# Testing

Testing for this plugin currently focuses heavily on security standards and functional testing rather than automated PHPUnit integrations.

## Required Manual Test Cases

Whenever a change is proposed, manually execute the following validation steps:

1. **Security / Nonces**: Submit the front-end form using browser developer tools to alter or remove the `wcasia_nonce` hidden field. Verify that WordPress cleanly dies with a `403 Security check failed` message.
2. **Input Validation**: Try to submit incomplete forms or forms with an invalid email address / date format. Verify that a `400` status with the appropriate message is returned.
3. **Happy Path Workflow**: Complete the form with valid information, verify the redirect adds `?event_submitted=1` to the URL, and ensure the thank you message is visible.
4. **Backend Validation**: As an admin, go to the backend "Events" tab and verify the resulting post is indeed titled appropriately and its meta keys (`_event_date`, `_event_location`, `_submitter_email`) correctly reflect the input.

## Future Focus

Currently, tests are manual. If the architecture expands, standard PHPUnit suites referencing the `WP_UnitTestCase` should cover the handler class validation logic. Ensure you verify data validation inputs strictly when contributing code to the backend.
