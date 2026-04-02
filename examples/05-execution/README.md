# Execution Mode

Execution Mode is the phase where the validated plan is translated into concrete outputs — code, file changes, configurations — while adhering strictly to the approved approach. The key discipline of execution mode is that no new decisions are introduced. The plan was the time for decisions. Execution is the time for implementation.

---

## Why Separate Planning from Execution

When planning and execution are mixed, several problems emerge:

- The AI redesigns the approach mid-stream, leading to inconsistent code
- Scope creep introduces features you never asked for
- The conversation context fills up with abandoned attempts
- You lose track of what was decided versus what was improvised

By separating the two phases, you get:

| Benefit | How |
|---------|-----|
| **Fewer surprises** | The plan was already reviewed and approved |
| **No mid-stream redesign** | The approach is locked in before code is written |
| **Follows outlined steps** | Each step maps directly from plan to implementation |
| **Scoped work** | Only what's in the plan gets built |
| **Honors conventions** | Project rules are applied consistently because the scope is clear |

## The Execution Discipline

Execution mode has one rule: **implement the plan, nothing more, nothing less.**

```
Approved Plan                    Execution Output
─────────────                    ────────────────
Step 1: Register taxonomy   →    register_taxonomy() call
Step 2: Flush rewrites      →    activation hook
Step 3: Form dropdown       →    wp_dropdown_categories()
Step 4: Save category       →    wp_set_object_terms()
Step 5: List shortcode      →    WP_Query + tax_query
Step 6: Admin column        →    manage_*_columns hooks
```

Each step produces exactly what the plan described. No bonus features, no alternative approaches, no skipped steps.

---

## Common Execution Problems

Even with a good plan, AI can drift during execution. Watch for these patterns:

| Problem | Example | Response |
|---------|---------|----------|
| **Scope creep** | AI adds a category widget you didn't ask for | "Remove the widget. It's not in the plan." |
| **Mid-stream redesign** | AI switches from `tax_query` to `meta_query` | "Use tax_query as specified in the plan." |
| **Skipped steps** | AI forgets the rewrite rules flush | "You skipped Step 2. Implement it." |
| **Convention violations** | AI uses spaces instead of tabs | "Use tabs per project rules." |
| **New decisions** | AI decides to add pagination to the shortcode | "Only implement what's in the plan." |

When you catch drift, be direct and specific. Don't explain why — just point to the plan and ask for the correction.

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — take the approved plan from the Planning exercise and implement it, checking each step for drift.
