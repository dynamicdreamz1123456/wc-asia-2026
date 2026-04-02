# WCasia Event Submissions — Project Rules

## What This Plugin Does

A WordPress plugin that lets visitors submit community events through a frontend form. Events are stored as a custom post type (`wcasia_event`) and go through a pending → published workflow.

## Tech Stack

- WordPress 6.4+ (minimum)
- PHP 7.4+ (minimum)
- Custom post type: `wcasia_event`
- No external dependencies or JavaScript frameworks

## Architecture

- `plugin/wcasia-event-submissions.php` — Main plugin file. Registers the post type and shortcode.
- `plugin/includes/class-submission-handler.php` — Handles frontend form validation and processing.
- `plugin/templates/submission-form.php` — Frontend form template rendered via `[event_submission_form]` shortcode.

## Coding Standards

Follow the WordPress Coding Standards:

- Use tabs for indentation, not spaces.
- Prefix all functions, classes, and hooks with `wcasia_`.
- Use Yoda conditions: `if ( 'value' === $variable )`.
- Always use strict comparisons (`===`, `!==`).
- Brace style: opening brace on the same line, closing brace on its own line.

## Security Rules (Critical)

Every form submission MUST have:
1. A nonce field created with `wp_nonce_field()` and verified with `wp_verify_nonce()`.
2. All input sanitized: `sanitize_text_field()`, `sanitize_email()`, `sanitize_textarea_field()`.
3. All output escaped: `esc_html()`, `esc_attr()`, `esc_url()`.
4. All `$_POST` / `$_GET` access wrapped in `wp_unslash()`.

## Common Mistakes to Avoid

- Never use `query_posts()`. Use `WP_Query` or `get_posts()`.
- Never use `extract()`.
- Never use `$_REQUEST`. Be explicit about `$_POST` or `$_GET`.
- Never use `wp_redirect()` — use `wp_safe_redirect()` instead.
- Function names must describe what they do. No `do_thing()` or `stuff()`.

## Post Meta Keys

- `_event_date` — Event date in `Y-m-d` format.
- `_event_location` — Free-text location string.
- `_submitter_email` — Email of the person who submitted the event.

## Hooks

- `wcasia_event_submitted` (action) — Fires after a new event is successfully created. Parameters: `$post_id`, `$data`.
