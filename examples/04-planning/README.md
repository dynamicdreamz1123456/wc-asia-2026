# Plan Mode

Plan mode is an interaction pattern where an AI system explicitly designs and validates an approach before executing code or actions. Instead of jumping straight to code, you ask the AI to think through the problem, outline an approach, and get your approval before writing a single line.

This is the single most effective technique for reducing wasted iterations, catching architectural mistakes early, and producing higher-quality AI output.

---

## Why Plan Before You Build

When you give an AI a task and it immediately starts coding, several things can go wrong:

- It picks an approach that doesn't fit your architecture
- It makes assumptions you wouldn't have made
- It introduces scope creep — adding features you didn't ask for
- It sequences the work incorrectly, building on foundations that don't exist yet
- You discover these problems mid-build, after tokens and time have been spent

Plan mode avoids all of this by separating the "what should we do" decision from the "let's do it" execution.

## What Makes a Good Plan

A good plan includes five elements:

| Element | What It Answers |
|---------|----------------|
| **Problem statement** | What are we building and why? |
| **Assumptions** | What already exists? What are we depending on? |
| **Architecture / approach** | Which files, classes, hooks, and patterns will we use? |
| **Step-by-step execution plan** | In what order do we make changes? |
| **Success criteria** | How will we know it's done? |

The plan is a contract between you and the AI. Once approved, execution should follow the plan — not deviate from it.

## Plan Mode Benefits

- **Reduces hallucinations** — the AI thinks before acting, catching logical errors early
- **Allows early corrections** — it's cheap to edit a plan; it's expensive to rewrite code
- **Saves tokens** — one good plan + one execution pass is cheaper than five rounds of trial-and-error
- **Sequences work correctly** — dependencies are identified before code is written
- **Fewer turns** — the full approach is agreed upfront, not discovered iteratively
- **Uses tools for extra context** — during planning, the AI can read files and explore before committing to a direction
- **Less context churn** — no abandoned code cluttering the conversation

## When to Use Plan Mode

| Situation | Use Plan Mode? |
|-----------|---------------|
| Multi-file changes | Always |
| New features | Always |
| Architecture decisions | Always |
| Tiny single-line edits | Skip it |
| Trivial refactors | Skip it |
| Known, well-established patterns | Skip it |

A good rule of thumb: if the task touches more than one file or involves a decision about *how* to do something, plan first.

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — plan an "Event Categories" feature step by step, review the AI's plan, and correct it before any code is written.
