#!/usr/bin/env bash
# Creates open issues used to demo the Daily AI Digest (scheduled tasks workshop).
# Prerequisites: GitHub CLI (`gh`) installed and authenticated (`gh auth login`).
#
# Usage:
#   ./scripts/create-workshop-digest-issues.sh
#   ./scripts/create-workshop-digest-issues.sh owner/repo
#
set -euo pipefail

REPO="${1:-}"
if [[ -z "${REPO}" ]]; then
  REPO=$(gh repo view --json nameWithOwner -q .nameWithOwner 2>/dev/null) || {
    echo "Usage: $0 [<owner/repo>]" >&2
    echo "Or run from a git repo with gh authenticated." >&2
    exit 1
  }
fi

create_issue() {
  local title="$1"
  local body="$2"
  if gh issue list --repo "${REPO}" --state open --json title --jq '.[].title' | grep -Fxq "${title}"; then
    echo "Skip (already exists): ${title}"
    return 0
  fi
  gh issue create --repo "${REPO}" --title "${title}" --body "${body}" --label "enhancement"
}

create_issue "[Workshop demo] Export submitted events as CSV (admin)" \
'## Summary

Allow site administrators to export **pending** and **published** `wcasia_event` submissions as CSV (e.g. title, date, location, submitter email).

## Why

Useful for offline review, mail merges, and reporting without database access.

## Notes

_Illustrative issue for the WordCamp Asia workshop daily-digest demo._'

create_issue "[Workshop demo] Email notification when event status changes" \
'## Summary

When an event moves from **pending** to **published** (or is rejected), send an email to the address stored in `_submitter_email`.

## Why

Submitter gets confirmation without checking the site.

## Notes

_Illustrative issue for the WordCamp Asia workshop daily-digest demo._'

create_issue "[Workshop demo] Public read-only REST API for published events" \
'## Summary

Expose a simple REST route (e.g. `GET /wp-json/wcasia/v1/events`) returning published events with date, title, location, and permalink.

## Why

Enables headless consumers, calendars, and partner integrations.

## Notes

_Illustrative issue for the WordCamp Asia workshop daily-digest demo._'

create_issue "[Workshop demo] Honeypot + rate limiting on submission form" \
'## Summary

- Add a honeypot field to reduce bot spam.
- Add basic rate limiting (per IP or per session) for the submission endpoint.

## Why

Reduces abuse on a public form.

## Notes

_Illustrative issue for the WordCamp Asia workshop daily-digest demo._'

create_issue "[Workshop demo] i18n for submission form strings" \
'## Summary

Wrap user-visible strings in the submission form and success/error messages for translation (`__()`, `_e()`, Text Domain consistent with the plugin).

## Why

WordCamp Asia audience is multilingual; translations improve adoption.

## Notes

_Illustrative issue for the WordCamp Asia workshop daily-digest demo._'

echo "Done. Open issues in ${REPO} for digest content."
