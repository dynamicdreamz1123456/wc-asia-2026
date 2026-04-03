---
description: Invoke the execute mode workflow to implement a provided plan
---

# Execute Mode Workflow

When the user invokes `/execute-mode`, they will provide a path to a plan file (e.g., `.agents/plans/feature-x.md`). You MUST strictly follow this execution workflow.

## Phase 1: Review Plan
- Thoroughly review the provided plan file using `view_file`.
- Understand the proposed changes, files to be created/modified/deleted, and any specific instructions or requirements in the plan.
- If the plan is incomplete or unclear, ask the user for clarification before proceeding to execution.

## Phase 2: Execute
- Execute the steps outlined in the implementation plan.
- Make the necessary source code changes, create new files, or run required commands.
- If you discover issues that require significant deviation from the plan, STOP and ask the user for guidance before continuing.
- Ensure that your changes adhere to the project's coding standards and the architectural guidelines.

## Phase 3: Summarize
- Summarize the changes you made based on the plan.
- Let the user know the execution is complete and highlight any important caveats or decisions made during the process.