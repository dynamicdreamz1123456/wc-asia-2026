# Exercise: Write an AGENTS.md

This exercise walks you through writing an AI documentation file for a project and testing whether the AI actually follows it.

---

## Step 1 — Write the Document

Pick a project you work on (or use this workshop's plugin as practice). Write a `AGENTS.md` that includes:

1. **What the project does** (2-3 sentences)
2. **Tech stack** (versions, key dependencies)
3. **Coding standards** (indentation, naming, style)
4. **Security rules** (what every form/API endpoint must have)
5. **Common mistakes to avoid** (things your team has gotten wrong before)

Here's a starter template:

```markdown
# [Project Name] — Project Rules

## What This Project Does

[2-3 sentences describing the project]

## Tech Stack

- WordPress [version]+ (minimum)
- PHP [version]+ (minimum)
- [Other key technologies]

## Coding Standards

- Use tabs for indentation in PHP
- Prefix all functions and hooks with `[prefix]_`
- Use Yoda conditions: `if ( 'value' === $variable )`
- Always use strict comparisons (`===`, `!==`)

## Security Rules

Every form submission MUST have:
1. Nonce verification with wp_verify_nonce()
2. All input sanitized with sanitize_text_field() / sanitize_email()
3. All output escaped with esc_html() / esc_attr() / esc_url()
4. All $_POST / $_GET access wrapped in wp_unslash()

## Common Mistakes to Avoid

- Never use query_posts() — use WP_Query
- Never use wp_redirect() — use wp_safe_redirect()
- Never use extract()
- Function names must be descriptive
```

---

## Step 2 — Test It

Paste your AGENTS.md into an AI tool, then ask:

```
Based on the project rules above, write a helper function that
fetches the 5 most recent published events and returns them as an array.
```

Check the AI's output:
- [ ] Does it use your naming prefix?
- [ ] Does it use `WP_Query` (not `query_posts()`)?
- [ ] Does it escape output?
- [ ] Does it follow your coding standards (tabs, Yoda conditions)?
- [ ] Is the function name descriptive?

If the AI doesn't follow the rules, the AGENTS.md needs to be clearer or more explicit.

---

## Step 3 — Compare With and Without

Try the same request **without** pasting the AGENTS.md first. Compare:

| Aspect | Without AGENTS.md | With AGENTS.md |
|--------|-------------------|----------------|
| Naming prefix | | |
| Uses WP_Query? | | |
| Output escaped? | | |
| Coding style | | |
| Function name | | |

This is the difference one file makes.
