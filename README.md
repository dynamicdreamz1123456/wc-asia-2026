# Building Better WordPress Experiences with AI-Driven Development Workflows

**WordCamp Asia 2026 Workshop** — Micah Wood & Vara Prasad Maruboina

Learn how to integrate AI into your WordPress development workflow — from writing better prompts, to planning and building features with AI agents, to automating code reviews and release notes with CI/CD pipelines.

---

## What's Inside

### [Presentation Deck](https://docs.google.com/presentation/d/1efxQ3AGAfDWvT0x27SGn3UynEkKUP7WspkxoLxwtHxY/edit?usp=sharing)

The workshop slide deck on Google Slides. Covers all three pillars of AI-driven development: AI Input, AI Output, and AI Automation.

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

### [Plugin](plugin/)

A simple WordPress plugin — **Event Submissions** — that serves as the working example throughout the workshop. It registers a custom post type, provides a frontend submission form via shortcode, and handles form processing with proper WordPress security patterns.

### [GitHub Workflows](.github/workflows/)

Working GitHub Actions that use AI to automatically summarize pull requests and review code. Fork this repo, add your API key, and they work out of the box.

---

## Quick Start

```bash
git clone git@github.com:wpscholar/wc-asia-2026.git
cd wc-asia-2026
```

Browse the [examples](examples/) folder, or start with the [deck](https://docs.google.com/presentation/d/1efxQ3AGAfDWvT0x27SGn3UynEkKUP7WspkxoLxwtHxY/edit?usp=sharing) for the full workshop flow.

### Running the Plugin

The easiest way to run the plugin is with [wp-env](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/), which requires [Docker](https://www.docker.com/) and [Node.js](https://nodejs.org/):

```bash
npm -g install @wordpress/env
wp-env start
wp-env run cli -- wp post create --post_type=page --post_title='Submit Event' --post_content='<!-- wp:shortcode -->[event_submission_form]<!--/wp:shortcode -->' --post_status='publish' --post_author=1
```

This spins up a local WordPress instance at `http://localhost:8888` with the plugin already activated. The `.wp-env.json` file handles the configuration.

Alternatively, copy the `plugin/` folder into your existing WordPress `wp-content/plugins/` directory and activate it from the admin.

---

## Using the AI Workflows

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
