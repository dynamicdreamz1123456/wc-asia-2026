# AI-Powered GitHub Workflows

This repository includes GitHub Actions workflows that use AI to automatically summarize and review pull requests. They demonstrate the **Triggers** concept from the workshop — AI that responds to events in your development lifecycle.

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
│   └── pr-review.yml       ← Workflow definition
├── prompts/
│   ├── pr-summary.md       ← Prompt template (what the AI should do)
│   └── pr-review.md        ← Prompt template
└── README.md               ← This file
```

The separation of workflows and prompts is intentional. Workflows define the *mechanics* (trigger, data collection, API call, posting). Prompts define the *intelligence* (what to check, how to report). This lets anyone improve the AI's output by editing a markdown file.

---

## Limitations

- **Diff size:** Large diffs are truncated to 50,000 characters to stay within API limits
- **Cost:** Each workflow run makes one API call to Anthropic (typically < $0.01)
- **Accuracy:** AI-generated reviews should be treated as a first pass, not a final verdict
- **Draft PRs:** Workflows skip draft PRs to avoid unnecessary API calls
