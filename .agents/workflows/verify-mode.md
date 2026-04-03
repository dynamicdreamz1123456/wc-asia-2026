---
description: Invoke the verify mode workflow to test and validate changes
---

# Verify Mode Workflow

When the user invokes `/verify-mode`, you MUST strictly follow this verification workflow to ensure changes have the desired effects and haven't introduced regressions.

## Phase 1: Review Context
- Review the recent changes made to the codebase (or the plan file if one was recently executed).
- Determine what needs to be verified based on the task description or plan.

## Phase 2: Static Verification
- Run syntax checks (e.g., `php -l` for PHP files if applicable).
- Check against coding standards or run linters if they exist in the project and are configured.

## Phase 3: Dynamic Verification
- If applicable to the task, use the browser subagent to interactively test UI changes, user flows, and integrations.
- Actively describe the exact steps you are taking to verify the functionality while running the tests.
- Attempt to consider and test edge cases or security aspects (e.g., nonce checks, escaping) relevant to the changes.

## Phase 4: Documentation
- Ensure that all new functionality has accurate documentation
- Update any existing documentation as necessary

## Phase 5: Testing
- Reference the `./docs/testing.md` file for any additional checks

## Phase 6: Report Results
- Present a clear summary of your testing methodology and the final results.
- If any issues or regressions are found, clearly describe them and pause to ask the user if you should propose a fix or if they prefer to handle it manually.