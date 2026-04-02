# Exercise: Set Up a PR Summary Workflow

This exercise walks you through activating the AI-powered PR summary workflow on your own fork.

---

## Step 1 — Review the Prompt Template

This repo includes a prompt template at `.github/prompts/pr-summary.md`. Open it and read through the instructions it gives the AI:

- What sections to include in the summary
- What to look for (security, breaking changes, performance)
- How to format the output

This is the "brain" of the workflow — the part you can customize without touching any YAML.

---

## Step 2 — Review the Workflow

Open `.github/workflows/pr-summary.yml` and trace the flow:

1. **Trigger:** `pull_request` event (opened or updated)
2. **Fetch diff:** Uses `gh pr diff` to get the changes
3. **Load prompt:** Reads the prompt template from `.github/prompts/`
4. **Call API:** Sends diff + prompt to the Anthropic API
5. **Post comment:** Writes the AI response as a PR comment

---

## Step 3 — Activate on Your Fork

1. **Fork this repository** on GitHub
2. Go to **Settings > Secrets and variables > Actions**
3. Add a repository secret: `ANTHROPIC_API_KEY` ([get one here](https://console.anthropic.com/))
4. Create a branch, make a small change to the plugin code
5. Open a pull request
6. Wait 1-2 minutes — the AI summary appears as a PR comment automatically

---

## Step 4 — Customize

Edit `.github/prompts/pr-summary.md` to change what the AI checks for. Some ideas:

- Add a "WordPress Compatibility" section
- Ask the AI to flag any use of deprecated functions
- Change the output format to use a checklist instead of prose
- Add project-specific concerns (e.g., "Flag any changes to the submission handler")

Commit your changes and open another PR to see the updated output. No workflow YAML changes needed.
