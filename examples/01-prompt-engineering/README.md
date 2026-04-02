# Prompt Engineering

Prompt engineering is the art and science of designing, testing, and refining inputs (prompts) to guide generative AI models toward producing accurate, relevant, and high-quality outputs.

The quality of an AI's response is directly proportional to the quality of the prompt you give it. A vague prompt produces generic output. A structured prompt produces precise, useful output. This guide covers the eight core techniques that make the difference.

---

## The Eight Techniques

### 1. Define a Role

Clearly specify what role the AI should play. This frames the response with the right expertise, vocabulary, and perspective.

> "You are a senior WordPress plugin developer with deep expertise in the Plugin API and WordPress security best practices."

Without a role, the AI defaults to a generalist. With a role, it draws on domain-specific knowledge and patterns.

### 2. Provide Clear Instructions

**Use simple language.** State what you want explicitly. Give one task at a time.

| Vague | Clear |
|---|---|
| "I need to know about those things people put on their roofs that use sun" | "Write three paragraphs about how solar panels work" |

**Use direct action verbs.** "Write", "Create", "Generate", "List", "Identify" — not questions.

| Question-Style | Direct |
|---|---|
| "What countries use geothermal energy?" | "Identify three countries that use geothermal energy. Include generation stats for each." |

**Positive framing works better.** "Do this" is more reliable than "Don't do this." Instead of "Don't use query_posts()", say "Use WP_Query for all database queries."

### 3. Share Context

Provide relevant information the AI needs to complete the task. But don't overload it — ask yourself: *Is the provided information sufficient for a person to complete this task?*

Good context for a WordPress task:
- The WordPress and PHP versions you're targeting
- Existing code the AI needs to work with
- What the plugin/theme does
- What problem you're solving

### 4. Set Constraints

Constraints narrow the solution space and prevent the AI from making assumptions that don't match your project.

Common constraint types:
- **Format:** "Return the output as a PHP class, not a set of functions"
- **Length:** "Keep the solution under 100 lines"
- **Audience:** "This is for WordPress 6.4+ and PHP 7.4+"
- **Style:** "Follow WordPress Coding Standards — tabs, Yoda conditions"
- **Naming:** "Prefix all functions with `wcasia_`"
- **Exclusions:** "No external dependencies or JavaScript frameworks"

### 5. Define Success Criteria

Tell the AI what "done" looks like. This is especially important for code generation.

- **Functionality:** "The shortcode should render a form with four fields"
- **Security:** "Every form submission must have nonce verification and input sanitization"
- **Quality:** "All output must be escaped with esc_html() or esc_attr()"
- **Readability:** "Include inline comments explaining security-critical decisions"

### 6. Ask for Reasoning

When you ask the AI to think step by step before producing output, it makes better decisions and hallucinates less.

> "Think through the architecture step by step before writing code."

> "Explain your approach before implementing it."

This is especially valuable for complex tasks where the AI might otherwise jump to the first solution that seems plausible.

### 7. Use XML Tags as Delimiters

XML tags help the AI clearly distinguish between your instructions and the data you're providing. This is critical when your prompt includes code, logs, or other content that could be confused with instructions.

```
Here is the plugin code that needs review:

<plugin_code>
{your code here}
</plugin_code>

Review the code above for security issues.
```

Without delimiters, the AI may confuse data with instructions, especially with code that contains natural language strings.

### 8. Provide Examples (Single-Shot and Multi-Shot)

Showing the AI one or more examples of the desired output anchors its response to your exact expectations.

**Single-shot** (one example):
```
Here is an example of a properly secured form handler:

<example>
function scf_process_form() {
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ?? '' ) ), 'scf_action' ) ) {
        wp_die( 'Security check failed.' );
    }
    $name = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    // ... process ...
}
</example>

Now write a similar handler for a contact form.
```

**Multi-shot** (multiple examples for pattern recognition):
```
Classify these support tickets:

<ticket>Plugin crashes on activation</ticket>
<label>Bug</label>

<ticket>Can you add dark mode support?</ticket>
<label>Feature Request</label>

<ticket>The settings page loads slowly on my site</ticket>
<label>???</label>
```

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — compare a bad prompt vs a good prompt side-by-side and see the difference these eight techniques make.
