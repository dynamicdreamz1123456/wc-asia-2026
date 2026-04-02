# Exercise: Context Levels in Action

This exercise demonstrates how different levels of context change AI output for the exact same question.

---

## The Bug

The event submission form saves posts but doesn't store the event date. We need AI to help debug it.

---

## Level 1 — Too Little Context

Paste only this into your LLM:

```
My WordPress plugin isn't saving the event date. How do I fix it?
```

The AI gives generic advice: "check your meta key," "make sure you're calling update_post_meta()." It has to guess because it has no information about your code, your data model, or your architecture.

---

## Level 2 — Right-Sized Context

Now paste this — the same question, but with the two relevant code blocks:

```
My WordPress plugin creates events as a custom post type called wcasia_event.
The form submits fine and the post is created, but the event date is never
saved to post meta.

Here is the form handler that processes submissions:

<form_handler>
function wcasia_handle_event_submission() {
    if ( ! isset( $_POST['wcasia_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wcasia_nonce'] ) ), 'wcasia_submit_event' ) ) {
        wp_die( 'Security check failed.' );
    }

    $title    = sanitize_text_field( wp_unslash( $_POST['event_title'] ?? '' ) );
    $location = sanitize_text_field( wp_unslash( $_POST['event_location'] ?? '' ) );
    $email    = sanitize_email( wp_unslash( $_POST['submitter_email'] ?? '' ) );

    $post_id = wp_insert_post( array(
        'post_title'  => $title,
        'post_type'   => 'wcasia_event',
        'post_status' => 'pending',
    ) );

    if ( ! is_wp_error( $post_id ) ) {
        update_post_meta( $post_id, '_event_location', $location );
        update_post_meta( $post_id, '_submitter_email', $email );
    }
}
</form_handler>

Here is the form template:

<form_template>
<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
    <?php wp_nonce_field( 'wcasia_submit_event', 'wcasia_nonce' ); ?>
    <input type="hidden" name="action" value="wcasia_submit_event">

    <label for="event_title">Event Title</label>
    <input type="text" name="event_title" required>

    <label for="event_date">Event Date</label>
    <input type="date" name="event_date" required>

    <label for="event_location">Location</label>
    <input type="text" name="event_location" required>

    <label for="submitter_email">Your Email</label>
    <input type="email" name="submitter_email" required>

    <button type="submit">Submit Event</button>
</form>
</form_template>

Why isn't the event date being saved?
```

With the right context, the AI immediately spots the bug: the form collects `event_date`, but the handler never reads `$_POST['event_date']` and never calls `update_post_meta()` for `_event_date`. It will also provide the exact fix.

---

## Level 3 — Too Much Context

Imagine pasting the entire plugin (500+ lines), plus the CSS file, plus the REST API class, plus the test file — when the bug is only in the form handler.

What happens:
- The AI has to search through irrelevant code
- Processing takes longer and costs more
- The AI may get distracted by issues in unrelated files
- Response quality can actually decrease as attention is diluted

**The right amount of context was Level 2** — just the handler and the form template. Enough to identify the bug, nothing more.
