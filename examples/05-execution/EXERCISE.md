# Exercise: Execute a Plan

This exercise demonstrates how to hand an approved plan to an AI agent and verify that execution stays faithful to the plan.

---

## The Approved Plan (from the [Planning exercise](../04-planning/EXERCISE.md))

```
Step 1: Register a hierarchical custom taxonomy "event_category"
        attached to wcasia_event in the main plugin file.

Step 2: Flush rewrite rules on plugin activation.

Step 3: Add a category dropdown to the frontend submission form
        using wp_dropdown_categories() with the event_category taxonomy.

Step 4: In the submission handler, read the selected category from
        $_POST, sanitize with absint(), and assign using
        wp_set_object_terms().

Step 5: Create a new file includes/class-event-list.php with a
        shortcode [event_list] that displays published events.
        Accept a "category" attribute to filter by event_category.
        Use WP_Query with tax_query.

Step 6: Add a custom admin column for event_category in the
        wcasia_event list table.
```

---

## Step 1 — Hand the Plan to the AI

Paste this prompt into your AI tool:

```
You are a senior WordPress plugin developer.

I have an approved plan for adding event categories to a WordPress plugin.
Implement each step exactly as outlined. Do not add features, change the
approach, or skip steps.

<project_rules>
- Custom post type: wcasia_event (already registered)
- Prefix all functions with wcasia_
- WordPress coding standards: tabs, Yoda conditions, strict comparisons
- All input sanitized, all output escaped
- Nonce verification on all form submissions
</project_rules>

<approved_plan>
Step 1: Register a hierarchical custom taxonomy "event_category"
        attached to wcasia_event in the main plugin file.

Step 2: Add flush_rewrite_rules() on plugin activation.

Step 3: Add a category dropdown to the frontend submission form using
        wp_dropdown_categories() with the event_category taxonomy.

Step 4: In the submission handler, read the selected category from
        $_POST, sanitize with absint(), and assign using
        wp_set_object_terms().

Step 5: Create a new file includes/class-event-list.php with a
        shortcode [event_list] that displays published events.
        Accept a "category" attribute to filter by event_category.
        Use WP_Query with tax_query.

Step 6: Add a custom admin column for event_category in the
        wcasia_event list table using manage_edit-wcasia_event_columns
        and manage_wcasia_event_posts_custom_column hooks.
</approved_plan>

Implement each step. Show me the code for each file that needs to be
created or modified, clearly labeled.
```

---

## Step 2 — Verify Each Step Against the Plan

As the AI produces code, check each step:

| Step | Verification | Pass? |
|------|-------------|-------|
| 1 | Taxonomy is hierarchical and attached to `wcasia_event`? | |
| 2 | Rewrite rules flushed on activation only (not every page load)? | |
| 3 | Dropdown uses `wp_dropdown_categories()` with correct taxonomy? | |
| 4 | Category input sanitized with `absint()` before `wp_set_object_terms()`? | |
| 5 | Shortcode uses `WP_Query` with `tax_query` (not `query_posts()`)? | |
| 6 | Admin column output escaped with `esc_html()`? | |

If any step doesn't match the plan, point it out immediately:

```
Step 4 is missing nonce verification on the category field.
The form handler should verify the existing wcasia_nonce before
reading $_POST['event_category']. Fix this.
```
