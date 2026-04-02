# Verification

Verification is the structured evaluation that confirms the implementation satisfies the plan, requirements, and constraints. It answers a different question than testing:

- **Testing** asks: *Does it work?*
- **Verification** asks: *Is it correct and complete?*

Code can run without errors and still be insecure, non-compliant with standards, or missing edge case handling. Verification catches what tests don't.

---

## The Five Verification Categories

Every piece of AI-generated code should be checked against five categories:

### 1. Requirements

**Did we build the right thing?**

- Does the implementation match what was requested?
- Are all required features present?
- Are there features that weren't requested (scope creep)?

### 2. Functional

**Does it work?**

- What happens with valid input?
- What happens with empty input?
- What happens when an operation fails (e.g., `wp_insert_post()` returns a `WP_Error`)?
- Are edge cases handled?

### 3. Architectural

**Is it built correctly?**

- Does it follow the project's architecture patterns?
- Are files in the right locations?
- Are functions and classes named according to conventions?
- Does it use the correct WordPress APIs?

### 4. Constraints

**Did we break any rules?**

This is where project rules (AGENTS.md) are enforced:
- Is every `$_POST` value wrapped in `wp_unslash()`?
- Is `wp_safe_redirect()` used instead of `wp_redirect()`?
- Is all output escaped?
- Does it follow the coding standards (tabs, Yoda conditions, prefix)?

### 5. Risk & Edge Cases

**Is the solution robust?**

- What if required fields are empty?
- What if a referenced ID doesn't exist?
- What if the date format is invalid?
- Can this be exploited via CSRF, XSS, or SQL injection?

---

## The Feedback Loop

Verification isn't a one-time check — it's part of a loop:

```
Plan → Execute → Verify → Fix → Verify → (done when all checks pass)
```

- **Plan** defines intent
- **Execution** realizes it
- **Verification** enforces it
- **Feedback** refines it

Your **definition of done** is what breaks the loop:
- All five verification categories pass
- No high-severity issues remain
- Code follows all project rules
- You would approve this in a real code review

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — review AI-generated code with 8 planted bugs and use the verification checklist to find them all.
