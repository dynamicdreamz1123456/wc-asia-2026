---
description: Invoke the rigorous planning mode workflow
---

# Planning Mode Workflow

When the user invokes `/plan-mode`, you MUST strictly follow the Planning Mode workflow, regardless of whether the task seems trivially simple. Do not skip the planning phase.

This process will generate a single document file directly in the `./.agents/plans/` directory (e.g. `./.agents/plans/fix-permalinks.md`). Do NOT use the system 'artifact' feature and do NOT create task-specific subdirectories.

## Phase 1: Research
- Thoroughly research the user's task using research tools (like file viewers, grep, or terminal commands).
- **DO NOT** make any source code changes or run modifying commands during this phase. Creating or updating the plan file in the `./.agents/plans/` directory is allowed.
- Understand the codebase, dependencies, architecture, and implications of the requested changes.

## Phase 2: Create Implementation Plan
- Create a single regular `[task-name].md` file directly in the `./.agents/plans/` directory with your findings and proposed approach.
- Group files by component and order logically in your proposed changes, detailing [NEW], [MODIFY], and [DELETE] actions for files.
- Include any open questions that require user feedback using GitHub alerts (like `> [!IMPORTANT]`).
- A good plan includes:
  - Problem statement
  - Assumptions
  - Architecture/approach
  - Step-by-step execution plan
  - Success criteria


## Phase 3: Ask user for approval
- Ask the user any open questions you have, pointing them to the new/updated `[task-name].md` plan (do not re-summarize it).
- If the user requests changes, make them. Otherwise, the workflow is complete.