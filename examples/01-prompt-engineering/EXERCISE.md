# Exercise: Bad Prompt vs Good Prompt

This exercise demonstrates how applying the eight prompt engineering techniques transforms AI output quality.

---

## Step 1 — The Bad Prompt

Open any LLM (Claude, ChatGPT, Gemini) and paste this:

```
Make me a contact form plugin for WordPress.
```

Look at the output. It works, but notice:
- It makes assumptions about what fields you need
- Naming conventions are inconsistent
- Security patterns may be incomplete or missing
- It doesn't match any particular coding standard

---

## Step 2 — The Good Prompt

Now paste this structured prompt that applies all eight techniques:

```
You are a senior WordPress plugin developer with deep expertise in the
WordPress Plugin API and security best practices.

Create a WordPress plugin that adds a contact form using a shortcode
[simple_contact_form]. The form should collect: name, email, and message.

<requirements>
- Register a shortcode that renders the form
- Process the submission using admin-post.php
- Send the form data to the site admin email using wp_mail()
- Show a success message after submission
- Redirect back to the form page after processing
</requirements>

<constraints>
- Use WordPress coding standards (tabs, Yoda conditions, brace style)
- Prefix all functions with scf_
- Must work on WordPress 6.4+ and PHP 7.4+
- No external dependencies or JavaScript frameworks
- Single file plugin (under 200 lines)
</constraints>

<security>
Every form submission MUST have:
1. Nonce field created with wp_nonce_field() and verified with wp_verify_nonce()
2. All input sanitized with sanitize_text_field() and sanitize_email()
3. All output escaped with esc_html() and esc_attr()
4. Use wp_safe_redirect() instead of wp_redirect()
</security>

Think through the architecture step by step before writing code.
Then provide the complete plugin file with inline comments explaining
security-critical decisions.
```

---

## Step 3 — Compare

| Aspect | Bad Prompt | Good Prompt |
|--------|-----------|-------------|
| Has nonce verification? | | |
| Input sanitized? | | |
| Output escaped? | | |
| Follows naming convention? | | |
| Uses wp_safe_redirect()? | | |
| Explained its reasoning? | | |

The same AI, the same model, the same day — completely different output quality based on how you asked.

---

## Techniques Used

| Technique | Where It Appears in the Good Prompt |
|-----------|-------------------------------------|
| **Role** | "You are a senior WordPress plugin developer…" |
| **Clear Instructions** | Explicit shortcode name, fields, behavior |
| **Direct Verbs** | "Create", "Register", "Process", "Send" |
| **Context** | WordPress version, PHP version, single file |
| **Constraints** | `<constraints>` block with coding standards, prefix, limits |
| **Success Criteria** | `<security>` block with explicit requirements |
| **Reasoning** | "Think through the architecture step by step…" |
| **XML Delimiters** | `<requirements>`, `<constraints>`, `<security>` tags |
