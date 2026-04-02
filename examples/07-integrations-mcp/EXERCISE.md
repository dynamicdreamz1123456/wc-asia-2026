# Exercise: Connect and Query

This exercise walks you through connecting an AI tool to GitHub via MCP and running queries against real data.

---

## Step 1 — Set Up

Create a `.mcp.json` file in your project root:

```json
{
  "mcpServers": {
    "github": {
      "command": "npx",
      "args": ["-y", "@modelcontextprotocol/server-github"],
      "env": {
        "GITHUB_PERSONAL_ACCESS_TOKEN": "ghp_your_token_here"
      }
    }
  }
}
```

### Getting a GitHub Token

1. Go to https://github.com/settings/tokens
2. Click "Generate new token (classic)"
3. Select scopes: `repo`, `read:org`
4. Copy the token into the config above

---

## Step 2 — Try These Queries

Once connected, try these prompts in your AI tool (Claude Code, Cursor, etc.):

**Query 1 — Summarize a PR:**
```
Summarize the most recent pull request on this repository.
Include: what changed, why, and any potential risks.
```

**Query 2 — List open issues:**
```
What open issues does this repository have?
Categorize them by type (bug, feature, enhancement) and
suggest which one should be worked on next.
```

**Query 3 — Cross-reference code and tests:**
```
Look at the most recent PR. Are there any test files that
should have been updated but weren't?
```

In each case, the AI reads the actual data from GitHub — no copying, no pasting, no context-switching.

---

## Step 3 — Add a Second Server

Extend your configuration to connect to your local filesystem as well:

```json
{
  "mcpServers": {
    "github": {
      "command": "npx",
      "args": ["-y", "@modelcontextprotocol/server-github"],
      "env": {
        "GITHUB_PERSONAL_ACCESS_TOKEN": "ghp_your_token_here"
      }
    },
    "filesystem": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-filesystem",
        "/path/to/your/project"
      ]
    }
  }
}
```

Now the AI can read both your GitHub data and your local project files in the same conversation.
