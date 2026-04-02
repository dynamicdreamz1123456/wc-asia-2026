# Exercise: Plan a WordPress Feature

This exercise demonstrates how to use Plan Mode to design an approach before writing code.

---

## The Task

You need to add an "Event Categories" feature to the workshop's event submission plugin. Events should be assignable to categories, and visitors should be able to filter events by category on the frontend.

This is a multi-file change with architecture decisions — exactly when Plan Mode shines.

---

## Step 1 — Ask for a Plan, Not Code

Paste this into your AI tool. Notice the explicit instruction to plan, not code:

```
You are a senior WordPress plugin developer.

I need to add an "Event Categories" feature to an existing plugin that
uses a custom post type called `wcasia_event`. Here are the requirements:

<requirements>
1. Register a custom taxonomy "event_category" attached to wcasia_event
2. Add a category dropdown to the frontend submission form
3. Save the selected category when an event is submitted
4. Add a shortcode [event_list] that displays events, filterable by category
5. Add category filter to the WordPress admin list table
</requirements>

<constraints>
- Follow WordPress coding standards (tabs, Yoda conditions)
- Prefix everything with wcasia_
- All input must be sanitized, all output escaped
- Use register_taxonomy(), not a plugin
- The taxonomy should be hierarchical (like categories, not tags)
</constraints>

DO NOT write any code yet.

Create a plan that includes:
1. Problem statement (what we're building and why)
2. Assumptions (what already exists, what we're depending on)
3. Architecture approach (which files to create/modify)
4. Step-by-step execution plan (ordered list of changes)
5. Success criteria (how we'll know it's done)

Document the plan in a markdown file in the `./agents/plans/` folder.
```

---

## Step 2 — Review the Plan

The AI will produce a structured plan. Read it carefully and look for:

| Check | Question |
|-------|----------|
| **Missing steps** | Did it account for nonce fields on the new dropdown? |
| **Wrong order** | Is the taxonomy registered before the form tries to list categories? |
| **Scope creep** | Did it add things you didn't ask for (like a category widget)? |
| **Bad assumptions** | Does it assume functions that don't exist? |
| **Security gaps** | Did it plan to sanitize the category input on submission? |

---

## Step 3 — Correct the Plan

If you find issues, tell the AI. For example:

```
Good plan, but two corrections:
1. Step 3 needs to include sanitization of the category term ID
   using absint() before calling wp_set_object_terms()
2. Add a step between 1 and 2: flush rewrite rules on plugin activation
   so the taxonomy permalinks work immediately

Update the plan with these changes.
```

Correcting a plan costs almost nothing. Correcting code costs significantly more.

---

## Step 4 — Approve and Proceed

Once the plan looks right, tell the AI:

```
Plan approved. Proceed with implementation, following each step exactly.
```

This transitions from Plan Mode to Execution Mode (covered in the [next example](../05-execution/)).
