# Scheduled Tasks — AI That Runs on a Schedule

Unlike triggers (which respond to events), scheduled tasks run at fixed intervals — every morning, every Monday, every hour. They proactively surface information you'd otherwise have to go hunting for.

```
Schedule Fires        →   AI Analyzes Data      →   Output Delivered
(Every morning)           (Open PRs, tickets)       (Email / Slack digest)
(Every Monday)            (Team workload)           (Health report)
(Every hour)              (Error logs)              (Alert if threshold exceeded)
```

---

## Types of Scheduled Tasks

### Daily Digest

**Schedule:** Every morning (e.g., 8:00 AM, Monday–Friday)

AI reviews your open pull requests and issues, then sends a summary of what needs your attention today:

- **PRs needing review** — no review decision yet, or open for more than 3 days
- **PRs with changes requested** — follow-up needed
- **Unassigned issues** — tickets that need an owner
- **Stale issues** — no activity in 7+ days
- **Recommendation** — what to focus on first based on priority and age

This replaces the morning ritual of opening GitHub and manually scanning your notifications. The AI does the scan and tells you what matters.

### Weekly Team Health

**Schedule:** Every Monday morning

AI reviews the past week's activity and produces a team health report:

- **Velocity** — PRs merged, issues closed, trend comparison
- **Stalled work** — PRs open 5+ days with no review, issues with no activity in 7+ days
- **Team load** — who has the most items assigned, potential overload
- **Recommendations** — top 3 actions for the week, process improvements

This gives engineering managers and team leads a weekly pulse check without manually aggregating data from GitHub.

---

## How It Works: Cron + GitHub Actions + AI

Scheduled tasks use the same GitHub Actions pattern as triggers, but with a `cron` schedule instead of an event trigger:

```yaml
on:
  schedule:
    - cron: '0 8 * * 1-5'  # 8 AM UTC, Monday through Friday
  workflow_dispatch: {}     # Allow manual trigger for testing
```

The workflow:
1. **Cron fires at the scheduled time**
2. **Workflow collects data** (open PRs, open issues, recent activity)
3. **Data + prompt are sent to the AI API**
4. **AI response is delivered** (Slack, email, GitHub Discussion, or logs)

### Delivery Options

The AI's output can be routed to wherever your team already works:

| Destination | Method |
|-------------|--------|
| **Slack** | Webhook URL via `curl` |
| **Email** | SendGrid, SES, or any email API |
| **GitHub Discussions** | `gh api` to post a discussion |
| **Workflow logs** | Default — just `echo` the output |

### Testing Without Waiting

Every scheduled workflow should include `workflow_dispatch` so you can trigger it manually:

1. Go to the **Actions** tab in your GitHub repo
2. Select the workflow (e.g., "Daily AI Digest")
3. Click **Run workflow**
4. Check the output in the workflow run logs

This lets you test and iterate on the prompt without waiting for the cron schedule to fire.

**Reference implementation in this repo:** see `.github/workflows/daily-digest.yml`, `.github/scripts/daily-digest.sh`, and [`.github/workflows/README.md`](../../.github/workflows/README.md) for setup (Discussions, Slack webhook, Anthropic key).

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — design a daily digest prompt, build the workflow, and choose your delivery method.
