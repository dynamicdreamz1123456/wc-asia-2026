# Exercise: Find the Bugs

This exercise gives you AI-generated code that runs without errors — but contains multiple security and quality issues. Use the five-category verification checklist to find them all.

---

## The Code

An AI agent generated this submission handler with category support. It runs without errors. But is it correct?

```php
function wcasia_handle_event_submission() {
    if ( ! isset( $_POST['wcasia_nonce'] ) ||
         ! wp_verify_nonce( $_POST['wcasia_nonce'], 'wcasia_submit_event' ) ) {
        wp_die( 'Security check failed.' );
    }

    $title    = sanitize_text_field( $_POST['event_title'] );
    $date     = sanitize_text_field( $_POST['event_date'] );
    $location = sanitize_text_field( $_POST['event_location'] );
    $email    = sanitize_email( $_POST['submitter_email'] );
    $category = intval( $_POST['event_category'] );

    $post_id = wp_insert_post( array(
        'post_title'  => $title,
        'post_type'   => 'wcasia_event',
        'post_status' => 'pending',
    ) );

    if ( $post_id ) {
        update_post_meta( $post_id, '_event_date', $date );
        update_post_meta( $post_id, '_event_location', $location );
        update_post_meta( $post_id, '_submitter_email', $email );
        wp_set_object_terms( $post_id, $category, 'event_category' );
    }

    wp_redirect( home_url( '/events/thank-you/' ) );
    exit;
}
```

---

## Step 1 — Run the Verification Checklist

Go through each category and find every issue:

**Requirements:**
- [ ] Does the handler save title, date, location, and email?
- [ ] Does it save the selected category?
- [ ] Does the post status start as "pending"?

**Functional:**
- [ ] What happens if `wp_insert_post()` returns a `WP_Error`?
- [ ] What happens if required fields are empty?

**Architectural:**
- [ ] Are functions prefixed with `wcasia_`?
- [ ] Does it use the correct post type?

**Constraints:**
- [ ] Is every `$_POST` value wrapped in `wp_unslash()`?
- [ ] Is `wp_safe_redirect()` used instead of `wp_redirect()`?
- [ ] Is `absint()` used instead of `intval()` for the category ID?

**Risk & Edge Cases:**
- [ ] What if `$_POST['event_category']` is not set?
- [ ] What if the date format is invalid?

---

## Step 2 — The Issues

Here are the bugs in the code above:

| # | Issue | Category | Severity |
|---|-------|----------|----------|
| 1 | `$_POST['wcasia_nonce']` not wrapped in `wp_unslash()` | Constraints | Medium |
| 2 | All `$_POST` values missing `wp_unslash()` | Constraints | Medium |
| 3 | Uses `wp_redirect()` instead of `wp_safe_redirect()` | Constraints | High |
| 4 | Uses `intval()` instead of `absint()` for taxonomy term ID | Constraints | Medium |
| 5 | Uses truthy check on `$post_id` — `WP_Error` objects are truthy | Functional | High |
| 6 | No validation that required fields are non-empty | Risk | Medium |
| 7 | No null coalescing (`?? ''`) on `$_POST` values — PHP notice if missing | Risk | Low |
| 8 | No validation of date format before saving | Risk | Low |

---

## Step 3 — Feed Back to the AI

Paste the issues back into the AI and ask for corrections:

```
I've verified the event submission handler and found these issues:

1. All $_POST access must use wp_unslash()
2. Use wp_safe_redirect() instead of wp_redirect()
3. Use absint() instead of intval() for the category term ID
4. Check is_wp_error($post_id), not just truthy
5. Add null coalescing (?? '') for all $_POST values
6. Validate that required fields are non-empty before wp_insert_post()

Fix all 6 issues. Do not change anything else.
```

Then verify the fixed code again. The loop continues until all checks pass.
