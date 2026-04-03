---
description: Invoke the rigorous planning mode workflow explicitly before taking action
---

# Planning Mode Workflow

When the user invokes `/plan-mode`, you MUST strictly follow the Planning Mode workflow, regardless of whether the task seems trivially simple. Do not skip the planning phase.

This process will generate multiple artifacts. Based on the user's request, create a folder under `./agents/plans` to store all artifacts for this process.

## Phase 1: Research
- Thoroughly research the user's task using research tools (like file viewers, grep, or terminal commands).
- **DO NOT** make any source code changes or run modifying commands during this phase. Creating or updating artifacts is allowed.
- Understand the codebase, dependencies, architecture, and implications of the requested changes.

## Phase 2: Create Implementation Plan
- Create or update the `implementation-plan.md` artifact with your findings and proposed approach.
- Group files by component and order logically in your proposed changes, detailing [NEW], [MODIFY], and [DELETE] actions for files.
- Include any open questions that require user feedback using GitHub alerts (like `> [!IMPORTANT]`).
- Request feedback from the user by setting `RequestFeedback = true` in the `ArtifactMetadata`.

## Phase 3: Obtain User Approval
- Ask the user any open questions you have, pointing them to the new/updated `implementation_plan.md` (do not re-summarize it).
- **STOP** and wait for the user's explicit approval before proceeding to execution. Do not continue until the user says "approved" or gives go-ahead.

## Phase 4: Execute
- Once the user explicitly approves, execute the implementation plan.
- Create the `task.md` artifact as a checklist with `[ ]`, `[/]`, and `[x]` completion states. Update it as you make progress.
- If you discover issues that require significant changes to the plan, update `implementation-plan.md` and request review again before continuing.

## Phase 5: Verify
- Verify that your changes have the desired effects (e.g. run unit tests, make sure code builds, check functionality).
- Create or update the `walkthrough.md` artifact to summarize what was changed and the validation results (embed screenshots/media if necessary).