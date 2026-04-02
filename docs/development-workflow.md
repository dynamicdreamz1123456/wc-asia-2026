# Development Workflow

Because this is a vanilla WordPress plugin and features no external dependencies or build tooling (like Webpack or Vite), the development loop is straightforward.

## Local Environment

Any standard local WordPress installation (such as LocalWP, MAMP, or `wp-env`) is sufficient:
1. Map the plugin folder to your `wp-content/plugins/` directory.
2. Edit PHP files directly.
3. Refresh the browser to see the changes.

## Coding Standards

Any developer contributing to the project MUST observe the following rigid standards:

- **Indentation**: Use **tabs** for indentation, not spaces.
- **Naming Conventions**: Prefix all functions, classes, and hooks with `wcasia_` to avoid namespace collisions.
- **Conditions**: Use Yoda conditions (e.g., `if ( 'value' === $variable )` instead of `if ( $variable === 'value' )`).
- **Strictness**: Always use strict comparisons (`===`, `!==`).
- **Braces**: The opening brace should be on the same line, closing brace on its own line.
- **Descriptive Naming**: Write functions that describe exactly what they do. Names like `wcasia_do_thing()` or `wcasia_stuff()` are explicitly forbidden.

*No external JS dependencies (e.g., React, jQuery, Vue) should be introduced unless absolutely necessary and approved by project leads.*
