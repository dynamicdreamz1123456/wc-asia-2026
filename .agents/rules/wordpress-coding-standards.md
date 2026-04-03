---
trigger: glob
description: WordPress PHP Coding Standards for WordCamp Asia 2026 Event Submissions
globs: *.php
---

# WordPress PHP Coding Standards

Any developer contributing to the project MUST observe the following rigid standards when editing or creating PHP files:

## Coding Standards
- **Indentation**: Use **tabs** for indentation, not spaces.
- **Naming Conventions**: Prefix all functions, classes, and hooks with `wcasia_` to avoid namespace collisions.
- **Conditions**: Use Yoda conditions (e.g., `if ( 'value' === $variable )` instead of `if ( $variable === 'value' )`).
- **Strictness**: Always use strict comparisons (`===`, `!==`).
- **Braces**: The opening brace should be on the same line, closing brace on its own line.
- **Descriptive Naming**: Write functions that describe exactly what they do. Names like `wcasia_do_thing()` or `wcasia_stuff()` are explicitly forbidden.

## Security Rules (Critical)
Every form submission MUST have:
1. **Nonces**: A nonce field created with `wp_nonce_field()` and verified via `wp_verify_nonce()`.
2. **Sanitization**: All input sanitized using core functions (`sanitize_text_field()`, `sanitize_email()`, `sanitize_textarea_field()`).
3. **Escaping**: All output aggressively escaped (`esc_html()`, `esc_attr()`, `esc_url()`).
4. **Globals**: All `$_POST` / `$_GET` access explicitly checked and wrapped in `wp_unslash()`.

## Common Mistakes to Avoid
- **Never** use `query_posts()`. Use `WP_Query` or `get_posts()` instead.
- **Never** use `extract()`.
- **Never** use `$_REQUEST`. Always explicitly use `$_POST` or `$_GET`.
- **Never** use `wp_redirect()`. Use `wp_safe_redirect()` to avoid open redirects.

## Official Documentation
Refer to the [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/) and [Plugin Security Handbook](https://developer.wordpress.org/plugins/security/) for any general rules not explicitly highlighted here.