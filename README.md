# Building Better WordPress Experiences with AI-Driven Development Workflows

**WordCamp Asia 2026 Workshop** — Micah Wood & Vara Prasad Maruboina

Learn how to integrate AI into your WordPress development workflow — from writing better prompts, to planning and building features with AI agents, to automating code reviews and release notes with CI/CD pipelines.

---
## AI Test check

This is a test change to verify AI workflow is working.

## Getting Started

### Install an AI Code Editor
Download [AntiGravity](https://antigravity.google/download), we'll use this as our primary AI code editor in the workshop due to it being free, full-featured, and having generous free tier AI limits. You can also use [Cursor](https://cursor.com/download) as an alternative, or another AI code editor of your choice.

### Clone the repository
```bash
git clone https://github.com/wpscholar/wc-asia-2026.git
cd wc-asia-2026
```

### Setup Local WordPress
For the purposes of this workshop, we'll use [wp-env](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/) to create a local WordPress instance. You don't necessarily have to have a local WordPress instance set up to follow along with the workshop, as the focus is on the AI workflows and not on the local WordPress setup itself.

#### Using WP-Env
- Install [Docker](https://www.docker.com/)
- Install [Node.js](https://nodejs.org/) - includes NPM 
- Install [wp-env](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/) as a global package (`npm -g i @wordpress/env`)
- From the root directory of the cloned repository, run `wp-env start` to start a local WordPress instance

## Digging In

### [Plugin](plugin/)

A simple WordPress plugin — **Event Submissions** — that serves as the working example throughout the workshop. It registers a custom post type, provides a frontend submission form via shortcode, and handles form processing with proper WordPress security patterns.

### [Examples](examples/)

Nine concept guides with hands-on exercises, one for each topic in the workshop:

| #                                      | Topic               | What You'll Learn                                          |
| -------------------------------------- | ------------------- | ---------------------------------------------------------- |
| [01](examples/01-prompt-engineering/)  | Prompt Engineering  | Craft prompts that produce accurate, secure WordPress code |
| [02](examples/02-context-engineering/) | Context Engineering | Manage context windows for optimal AI reasoning            |
| [03](examples/03-documentation/)       | Documentation       | Write docs for humans (README) and AI agents (AGENTS.md)   |
| [04](examples/04-planning/)            | Plan Mode           | Design approaches before writing code                      |
| [05](examples/05-execution/)           | Execution Mode      | Translate plans into code without scope creep              |
| [06](examples/06-verification/)        | Verification        | Systematically verify AI-generated code                    |
| [07](examples/07-integrations-mcp/)    | MCP Integrations    | Connect AI to GitHub, databases, and APIs                  |
| [08](examples/08-triggers/)            | Triggers            | Automate AI on PR and ticket events                        |
| [09](examples/09-scheduled-tasks/)     | Scheduled Tasks     | Run recurring AI digests and health checks                 |

### [GitHub Workflows](.github/workflows/)

Working GitHub Actions that use AI to automatically summarize pull requests and review code. Fork this repo, add your API key, and they work out of the box.

#### Using the AI Workflows

To activate the AI-powered GitHub Actions on your own fork:

1. Fork this repository
2. Go to **Settings > Secrets and variables > Actions**
3. Add a repository secret: `ANTHROPIC_API_KEY` ([get one here](https://console.anthropic.com/))
4. Open a pull request — the AI summary and review will appear as comments automatically

See the [workflows documentation](.github/workflows/README.md) for details.

---

## Resources

- [Claude](https://claude.ai/login)
- [Claude Code](https://docs.anthropic.com/en/docs/claude-code)
- [Antigravity](https://antigravity.google/download)
- [Cursor](https://cursor.com/download)
- [MCP Specification](https://modelcontextprotocol.io/)
- [MCP Server Directory](https://github.com/modelcontextprotocol/servers)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [WordPress Plugin Security Handbook](https://developer.wordpress.org/plugins/security/)

---

## License

[MIT](LICENSE) — use, modify, and share freely.
