# AI-Powered GitHub Workflows

This repository includes GitHub Actions workflows that use AI to automatically summarize and review pull requests. They demonstrate the **Triggers** concept from the workshop — AI that responds to events in your development lifecycle.

The **Daily AI Digest** workflow demonstrates **Scheduled tasks** (cron): it runs on a schedule, gathers open PRs and issues, optionally summarizes them with Anthropic, and delivers the result to the **Actions job summary**, a **GitHub Discussion**, and optionally **Slack**.

---

## Workflows

### PR Summary (`pr-summary.yml`)

**Triggers on:** Pull request opened or updated (new commits pushed)

**What it does:**
1. Fetches the PR diff using the GitHub CLI
2. Loads the prompt template from `.github/prompts/pr-summary.md`
3. Sends the diff + prompt to the Anthropic API
4. Posts the AI-generated summary as a PR comment

**Output includes:**
- What changed (files and nature of changes)
- Why (inferred purpose)
- Risks (security, breaking changes, performance)
- Testing suggestions

### Daily AI Digest (`daily-digest.yml`)

**Triggers on:** Cron (weekdays, 01:00 UTC) and manual **Run workflow** (`workflow_dispatch`).

**What it does:**

1. Checks out the repo and runs `scripts/daily-digest.sh`.
2. Uses the GitHub CLI to list open PRs and open issues as JSON.
3. If `ANTHROPIC_API_KEY` is set, sends the data plus `.github/prompts/daily-digest.md` to the Anthropic API and writes an AI digest. Otherwise it writes a short **fallback** list (no API call).
4. Appends the digest to the **workflow run’s job summary** (visible on the Actions run page).
5. Creates a new **Discussion** in the **General** category (or the first available category) with title `Daily digest — YYYY-MM-DD`.
6. If `SLACK_WEBHOOK_URL` is set, POSTs the digest text to Slack (truncated if very long).

**Repository setup:**

1. **Enable Discussions:** Repository **Settings → General → Features → Discussions** (create a **General** category if prompted).
2. **Secrets (Settings → Secrets and variables → Actions):**
   - `ANTHROPIC_API_KEY` — optional but recommended; same key as the PR workflows. Without it, the digest is a simple markdown list.
   - `SLACK_WEBHOOK_URL` — optional. Create an [Incoming Webhook](https://api.slack.com/messaging/webhooks) in your Slack app (free workspaces can use this; you only need the webhook URL, not a bot token). Paste the full webhook URL as the secret value—**do not commit it.**

**Workshop demo issues:** run `./scripts/create-workshop-digest-issues.sh` locally (requires `gh`) to open labeled enhancement issues that show up in the digest.

### PR Code Review (`pr-review.yml`)

**Triggers on:** Pull request opened or updated (new commits pushed)

**What it does:**
1. Fetches the PR diff
2. Loads the review prompt from `.github/prompts/pr-review.md`
3. Sends the diff + prompt to the Anthropic API
4. Posts the AI review as a PR comment

**Checks for:**
- Security issues (missing nonces, unsanitized input, unescaped output)
- WordPress standards violations (wrong APIs, missing i18n)
- Code quality concerns (missing error handling, unclear naming)

---

## Setup

### 1. Fork the Repository

Fork this repo to your own GitHub account.

### 2. Add the API Key

1. Go to **Settings > Secrets and variables > Actions**
2. Click **New repository secret**
3. Name: `ANTHROPIC_API_KEY`
4. Value: Your Anthropic API key (get one at https://console.anthropic.com/)

### 3. Open a Pull Request

Create a branch, make a change, and open a PR. The workflows trigger automatically and post AI-generated comments within a minute or two.

---

## Customizing the Prompts

The AI behavior is controlled by prompt templates in `.github/prompts/`. These are plain markdown files — no YAML or code changes needed to customize what the AI checks for.

| File | Controls |
|------|----------|
| `prompts/pr-summary.md` | What the PR summary includes and how it's formatted |
| `prompts/pr-review.md` | What the code review checks for and how issues are reported |

To customize:
1. Edit the relevant prompt file
2. Commit and push
3. The next PR will use the updated prompt

---

## Architecture

```
.github/
├── workflows/
│   ├── pr-summary.yml      ← Workflow definition (when to run, how to run)
│   ├── pr-review.yml       ← Workflow definition
│   └── daily-digest.yml    ← Scheduled digest (cron + manual)
├── prompts/
│   ├── pr-summary.md       ← Prompt template (what the AI should do)
│   ├── pr-review.md        ← Prompt template
│   └── daily-digest.md     ← Prompt for scheduled digest
└── workflows/README.md     ← This file

scripts/                    ← repository root (invoked by daily-digest.yml)
├── daily-digest.sh
└── create-workshop-digest-issues.sh
```

The separation of workflows and prompts is intentional. Workflows define the *mechanics* (trigger, data collection, API call, posting). Prompts define the *intelligence* (what to check, how to report). This lets anyone improve the AI's output by editing a markdown file.

---

## Limitations

- **Diff size:** Large diffs are truncated to 50,000 characters to stay within API limits
- **Cost:** Each workflow run makes one API call to Anthropic (typically < $0.01)
- **Accuracy:** AI-generated reviews should be treated as a first pass, not a final verdict
- **Draft PRs:** Workflows skip draft PRs to avoid unnecessary API calls
