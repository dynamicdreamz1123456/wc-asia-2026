# Exercise: Design a Daily Digest

This exercise walks you through designing the prompt and structure for a daily AI-generated digest.

---

## Step 1 — Define What Matters

Before writing the workflow, decide what you want surfaced in your daily digest. Here's a starting template:

```
## Morning Digest

### PRs Needing Attention
- PRs with no review after 24 hours
- PRs with changes requested but no follow-up
- PRs open for more than 5 days

### Issues to Watch
- Unassigned issues
- Issues with no labels (may need triage)
- Issues older than 7 days with no activity

### Today's Recommendation
- Suggest what to focus on based on priority and staleness
```

---

## Step 2 — Write the Prompt

The prompt follows the same principles from the Prompt Engineering section — role, context, constraints, structure:

```
You are a development team assistant.

Create a morning digest for a WordPress plugin developer.

<open_pull_requests>
{PR data from GitHub CLI}
</open_pull_requests>

<open_issues>
{Issue data from GitHub CLI}
</open_issues>

Format the digest as:
- PRs Needing Attention (prioritized)
- Issues to Watch (categorized)
- Today's Recommendation (actionable)

Keep it concise. Use bullet points. No fluff.
```

---

## Step 3 — Build the Workflow

The workflow gathers data using the GitHub CLI, sends it to the AI API with the prompt, and outputs the result. Follow the same pattern from the [Triggers exercise](../08-triggers/EXERCISE.md):

```yaml
name: Daily AI Digest
on:
  schedule:
    - cron: '0 8 * * 1-5'  # 8 AM UTC, Monday-Friday
  workflow_dispatch: {}     # Manual trigger for testing

jobs:
  digest:
    runs-on: ubuntu-latest
    steps:
      - name: Gather open PRs
        run: |
          gh pr list --repo ${{ github.repository }} \
            --state open --json number,title,author,createdAt
        env:
          GH_TOKEN: ${{ secrets.GITHUB_TOKEN }}

      - name: Gather open issues
        run: |
          gh issue list --repo ${{ github.repository }} \
            --state open --json number,title,labels,assignees
        env:
          GH_TOKEN: ${{ secrets.GITHUB_TOKEN }}

      # Send data + prompt to AI API, output the result
```

---

## Step 4 — Choose Your Delivery

Decide where the digest should land:
- **For yourself:** Workflow logs are enough to start
- **For a team:** Post to Slack via webhook
- **For a record:** Create a GitHub Discussion

---

## Step 5 — Test It

Use `workflow_dispatch` to trigger the workflow manually without waiting for the cron schedule:

1. Go to the **Actions** tab in your GitHub repo
2. Select "Daily AI Digest"
3. Click **Run workflow**
4. Check the output in the workflow run logs
