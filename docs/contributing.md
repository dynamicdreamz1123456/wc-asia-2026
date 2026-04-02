# Contributing

We welcome contributions to the WordCamp Asia 2026 Event Submissions plugin! Please respect the project rules below.

## Security Rules (Critical)

Every piece of newly submitted functionality must be resilient. **Your Pull Request will be rejected if you fail any of these rules**:

1. Every form submission MUST have a nonce field created with `wp_nonce_field()` and verified via `wp_verify_nonce()`.
2. **All** inputs must be sanitized using core functions (e.g., `sanitize_text_field()`, `sanitize_email()`, `sanitize_textarea_field()`).
3. **All** outputs must be aggressively escaped (e.g., `esc_html()`, `esc_attr()`, `esc_url()`).
4. Any access to `$_POST` or `$_GET` global variables must be explicitly checked and wrapped in `wp_unslash()`.

## Common Mistakes to Avoid
- **Never** use `query_posts()`. Use `WP_Query` or `get_posts()` instead.
- **Never** use `extract()`.
- **Never** use `$_REQUEST`. Always explicitly use `$_POST` or `$_GET`.
- **Never** use `wp_redirect()`. Use `wp_safe_redirect()` to avoid open redirects.

By adhering strictly to these rules, we ensure the plugin remains fast, localized, and immune to simple manipulation and attacks.
