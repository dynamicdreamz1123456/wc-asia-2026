# Context Engineering

Context engineering is the discipline of designing, managing, and optimizing the information provided to a language model at inference time to maximize output quality within token and cost constraints.

While prompt engineering is about *how* you ask, context engineering is about *what information* you include alongside your question. The right context transforms a generic AI response into a precise, actionable answer.

---

## Core Concepts

### Context Window

The context window is the total token budget a model can "see" in a single call. Think of it as the model's available working memory. Everything you send — your prompt, the code you paste, the conversation history — consumes tokens from this budget.

Modern models have large context windows (100K–200K tokens), but bigger doesn't always mean better.

### Size versus Cost

There is a fundamental tradeoff:

- **Longer context** gives the AI more information to work with, but takes more time and money to process
- **Shorter context** is faster and cheaper, but may leave out important details that lead to generic or incorrect answers

Your goal is to find the balance — provide enough context for accuracy without drowning the model in irrelevant information.

### Diminishing Returns

As the context window fills up beyond the 50% mark, the model's ability to reason well begins to diminish. It's like trying to talk to someone who's managing ten conversations at once — technically they can hear you, but they're not fully present.

A focused 2,000-token context often produces better results than a sprawling 50,000-token context with the same question buried inside.

### Progressive Disclosure

Progressive disclosure is a design principle: show only the most essential information upfront, and reveal additional details as the model needs them.

```
Level 1: Start with the specific question + most relevant code
         ↓ (if the answer is insufficient)
Level 2: Add surrounding functions and related files
         ↓ (if still insufficient)
Level 3: Add architecture docs and project rules
         ↓ (only if truly needed)
Level 4: Full project context
```

Don't start at Level 4. Start small, and add context only when the AI's answer shows it needs more information.

### Reset Context

Start a new chat for new topics. Carrying old context from a debugging session into a feature-building conversation confuses the model. The accumulated history of wrong guesses, abandoned approaches, and unrelated questions pollutes the model's reasoning.

A fresh conversation with focused, relevant context will almost always produce better results than a long thread with accumulated noise.

### Using Subagents

For complex tasks, split the work into smaller, focused contexts rather than cramming everything into one conversation.

Subagents protect the model from bad context. Each step operates with the right information, at the right time. And they can be run in parallel to speed up work.

| Instead of... | Do this... |
|---|---|
| One chat: "Debug my plugin, add a feature, and write tests" | **Chat 1:** Debug the specific issue |
| | **Chat 2:** Implement the new feature |
| | **Chat 3:** Write the tests |

Each conversation gets a clean, focused context. Each produces better results than one overloaded conversation.

---

## Exercise

See [EXERCISE.md](EXERCISE.md) — debug the same WordPress bug with three different levels of context and see how the AI's response quality changes.
