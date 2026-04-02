# Documentation for Humans and AI

Good documentation has always been important. With AI-assisted development, it becomes critical — because now your documentation serves two audiences: human developers and AI agents.

The documents you write for humans and AI look different because they answer different questions. But together, they form the foundation that makes AI-assisted development reliable.

---

## Documentation for Humans

### Purpose

Human documentation helps developers understand the system:

- **What is this?** — Project overview and purpose
- **How do I run it?** — Setup, installation, commands
- **How do I contribute?** — Standards, PR process, branch naming

### Where It Lives

- `README.md` at the project root is the entry point
- A `/docs` folder holds granular documentation, progressively disclosed
- Each file in `/docs` covers one topic: architecture, standards, testing, deployment

### What a Good README Contains

A good README answers the three core questions quickly. It doesn't try to document everything — it links to deeper docs for details.

```
README.md                  → Quick start (what, how to run, how to contribute)
docs/
├── ARCHITECTURE.md        → System design, data flow, key decisions
├── CODING-STANDARDS.md    → Language-specific conventions
├── CONTRIBUTING.md        → PR process, branch naming, review checklist
├── DEPLOYMENT.md          → Release workflow, environments
└── TESTING.md             → How to write and run tests
```

---

## Documentation for AI

### Purpose

AI documentation helps agents operate within the system:

- **What am I allowed to do?** — Scope of changes, restricted areas
- **How should I behave?** — Coding standards, naming conventions, patterns to follow
- **What are the rules?** — Security requirements, anti-patterns to avoid, architectural constraints

### Where It Lives

- `AGENTS.md` at the project root is the AI entry point
- Specific tools may look for specific files: `CLAUDE.md` for Claude Code, `WARP.md` for Warp, etc.
- The same `/docs` folder serves both audiences — AI tools read it too

### What a Good AGENTS.md Contains

A good AGENTS.md is direct and rule-based. It tells the AI what the project is, what standards to follow, what to never do, and what the architecture looks like.

The key sections:

| Section | Purpose |
|---------|---------|
| **What This Project Does** | One-paragraph overview so the AI knows the domain |
| **Tech Stack** | Versions, dependencies — prevents the AI from suggesting incompatible code |
| **Coding Standards** | Indentation, naming prefixes, brace style — ensures consistency |
| **Architecture** | File locations, patterns — the AI knows where things go |
| **Security Rules** | Non-negotiable requirements — nonces, sanitization, escaping |
| **Common Mistakes** | Anti-patterns your team has learned to avoid |

### The Difference It Makes

| Without AGENTS.md | With AGENTS.md |
|---|---|
| Generic code | Code matching your standards |
| Random naming conventions | Consistent prefix (`wcasia_`) |
| Missing security checks | Nonces + sanitization + escaping |
| `wp_redirect()` | `wp_safe_redirect()` |
| `query_posts()` | `WP_Query` |
| Spaces | Tabs (WPCS) |

Write the AGENTS.md once — about 20 minutes. Every AI interaction with your project gets better automatically.

---

## Common Documentation Topics

Whether for humans or AI, most projects need documentation covering:

- **Project Overview** — what it does and why
- **Architecture Overview** — how it's structured
- **Installation / Setup** — how to get it running
- **Usage** — how to use the features
- **Development Workflow** — branching, PR process
- **Testing** — how to write and run tests
- **Deployment / Releases** — how to ship
- **Contributing** — how others can help

The difference is in the tone. Human docs explain and guide. AI docs constrain and direct.

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — write an AGENTS.md from a template and test whether the AI actually follows your rules.
