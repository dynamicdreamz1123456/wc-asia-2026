# Triggers — AI That Responds to Events

Triggers are automated workflows that run AI tasks in response to specific events in your development lifecycle. Instead of manually asking AI to review code or summarize a PR, it happens automatically every time the event occurs — consistently, reliably, 24/7.

```
Event Occurs           →   AI Task Runs          →   Output Posted
(PR opened)                (Analyze the diff)         (Comment on the PR)
(Ticket created)           (Check for details)        (Comment on the ticket)
(Code pushed)              (Review for issues)        (Report findings)
```

---

## Types of Triggers

### PR Summaries

**Trigger:** Pull Request Opened or Updated

When a new PR is opened (or new commits are pushed to an existing PR), AI reads the diff and posts a structured summary as a PR comment. The summary includes what changed, why, any risks, and testing suggestions.

This saves reviewers time by providing immediate context before they even look at the code.

### PR Code Review

**Trigger:** Pull Request Opened or Updated

AI performs a first-pass code review, checking for:
- Security issues (missing nonces, unsanitized input, unescaped output)
- Standards violations (wrong naming, incorrect API usage)
- Code quality concerns (missing error handling, hardcoded values)

This doesn't replace human review — it augments it. The AI catches the mechanical issues so human reviewers can focus on architecture, logic, and design.

### Ticket Triage

**Trigger:** New Issue/Ticket Opened

AI reviews the ticket details and checks for completeness:
- Does it have a clear description?
- For bugs: are reproduction steps provided?
- For features: are acceptance criteria defined?
- Is the environment specified (WordPress version, PHP version)?

If anything is missing, AI posts a polite comment asking for the details. Well-written tickets get acknowledged and labeled.

---

## How It Works: GitHub Actions + AI

The pattern is the same for all trigger-based workflows:

1. **A GitHub event fires** (PR opened, issue created)
2. **GitHub Actions workflow starts** (triggered by the event)
3. **The workflow collects data** (diff, ticket body, etc.)
4. **A prompt template is loaded** (from `.github/prompts/`)
5. **Data + prompt are sent to the AI API** (Anthropic, OpenAI, etc.)
6. **The AI response is posted** (as a PR comment, issue comment, etc.)

The prompt template is separated from the workflow YAML. This means anyone on your team can edit the review criteria without touching the CI/CD configuration.

---

## Prompt Templates

The quality of the automated output depends on the prompt template. These templates follow the same principles from the Prompt Engineering section — role, constraints, structure, delimiters.

**Example: PR Review Prompt** (`.github/prompts/pr-review.md`)

```markdown
You are a senior WordPress code reviewer.

Review this pull request diff for:

## Security (Critical)
- Missing nonce verification
- Unsanitized input ($_POST, $_GET without sanitize_*)
- Unescaped output (missing esc_html, esc_attr, esc_url)
- Direct database queries without $wpdb->prepare()
- Use of wp_redirect() instead of wp_safe_redirect()

## WordPress Standards
- Proper use of WordPress APIs (WP_Query, not query_posts)
- Correct hook usage and priorities
- Internationalization (missing __() or esc_html__())

## Code Quality
- Functions without descriptive names
- Missing error handling
- Hardcoded values that should be configurable

For each issue found, provide:
- **Severity:** Critical / Warning / Info
- **File and line**
- **Issue description**
- **Suggested fix**
```

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — fork the repo, activate the PR summary workflow, and customize the prompt template.
