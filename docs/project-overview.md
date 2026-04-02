# Project Overview

WordCamp Asia Event Submissions is a WordPress plugin that allows visitors to submit community events through a frontend form. Submitted events are saved securely as a custom post type (`wcasia_event`) and undergo a pending-to-published moderation workflow.

## Key Features

- **Custom Post Type**: Uses the `wcasia_event` custom post type to store all event details appropriately within the WordPress database.
- **Frontend Submissions**: Provides the `[event_submission_form]` shortcode that can be used on any page or post to render an event submission form.
- **Moderation Workflow**: By default, submitted events are saved with a "pending" status, ensuring an administrator reviews and publishes them.
- **Lightweight**: Zero external dependencies or JS frameworks are required. It relies entirely on native WordPress functionality.
