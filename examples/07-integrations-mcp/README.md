# Integrations — Model Context Protocol (MCP)

Model Context Protocol (MCP) is a standardized way for AI models to discover, access, and interact with external tools, data sources, and capabilities in a structured, programmatic way.

Without MCP, using AI with your real systems means manually copying and pasting — diffs, ticket descriptions, error logs, database output — into the AI chat. MCP eliminates this by letting the AI read your systems directly.

---

## How MCP Works

MCP creates a bridge between an AI agent and external systems:

```
┌───────────────┐        MCP         ┌────────────────┐
│               │◄──────────────────►│    GitHub       │
│   AI Agent    │        MCP         ├────────────────┤
│               │◄──────────────────►│    Database     │
│  (Claude,     │        MCP         ├────────────────┤
│   Cursor,     │◄──────────────────►│    Slack        │
│   etc.)       │        MCP         ├────────────────┤
│               │◄──────────────────►│  WordPress API  │
└───────────────┘                    └────────────────┘
```

The AI stops guessing. It reads real data from real systems.

## The Three MCP Layers

MCP provides three types of capabilities:

### Tools (Action Layer)

Tools allow AI agents to decide if, when, and how to take actions on external systems. They balance structure with flexibility to enable reliable automation.

Examples:
- Create a GitHub issue
- Run a database query
- Post a message to Slack

### Resources (Context Layer)

Resources provide structured, retrievable context so AI agents can access the right information at the right time. They provide reliable, structured information that informs decisions and guides action.

Examples:
- Read a PR diff
- Fetch issue descriptions
- Retrieve database records

### Prompts (Behavior Layer)

Prompts provide structured, reusable instruction templates that guide AI agents in how to think, reason, and respond in specific contexts. They shape how models interpret context and execute tasks.

Examples:
- "Summarize this PR" template
- "Triage this ticket" template
- "Generate release notes" template

---

## Before and After MCP

### Without MCP

```
1. Open GitHub in browser
2. Navigate to the pull request
3. Copy the diff
4. Copy the PR description
5. Switch to your AI chat
6. Paste everything
7. Write a prompt explaining what you want
8. Get a response
```

### With MCP

```
1. Ask: "Summarize PR #15"
2. Done.
```

The AI fetches the diff, reads the description, understands the context, and produces a summary — no manual data shuttling.

---

## Configuration

Connecting an AI tool to GitHub via MCP takes five lines of configuration.

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

## Available MCP Servers

| Server | What It Provides | Use Case |
|--------|-----------------|----------|
| `@modelcontextprotocol/server-github` | PRs, issues, code, commits | Code review, PR summaries |
| `@modelcontextprotocol/server-postgres` | Database queries | Data analysis, schema review |
| `@modelcontextprotocol/server-slack` | Channel messages | Support ticket context |
| `@modelcontextprotocol/server-filesystem` | Local file access | Project exploration |

Browse the full directory at: https://github.com/modelcontextprotocol/servers

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — set up the GitHub MCP server, run queries against real PR and issue data, and add a second server.
