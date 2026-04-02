# Usage

## Adding the Submission Form

To allow frontend users to submit an event, follow these steps:
1. Create a new WordPress Page or Post (or edit an existing one).
2. Insert the shortcode: `[event_submission_form]`.
3. Publish or Update the page.

Visitors navigating to that page will see a standard form prompting them for:
- Event Title
- Event Date
- Location
- Submitter Email

## Form Workflow

1. A user fills out the form and clicks "Submit Event".
2. The form submits securely to `admin-post.php`.
3. If successful, the user is redirected back to the form page with an `?event_submitted=1` query parameter, displaying a "Thank you" notice.
4. Internally, a new custom post of type `wcasia_event` is created with the sub-status of **Pending Review**.

## Managing Events (Admin)

To review submitted events:
1. Log into the WordPress dashboard.
2. Click on **Events** in the left-hand navigation menu.
3. You will see a list of newly submitted events marked as "Pending".
4. Edit any event to view the meta details or make corrections.
5. Publish the event to make it publicly viewable.
