# Deployment / Releases

Releasing a new version involves standard plugin upgrade mechanics.

## Preparing a Release

When you are ready to prepare a new release bundle:
1. Update the `WCASIA_EVENTS_VERSION` constant within the `plugin/wcasia-event-submissions.php` file.
2. Verify all modifications still support PHP 7.4+ and WordPress 6.4+.
3. Generate a `.zip` archive containing the `wcasia-event-submissions` root directory (ignoring developer specific files such as `.git` or `docs/` or `examples/`).

## Deployment

Administrators can deploy the plugin using typical methods:
- **WP-CLI**: Automatically pull the bundle to the server and execute `wp plugin install wcasia-event-submissions.zip`.
- **Manual FTP/SFTP**: Upload the extracted folder into the remote `wp-content/plugins/` directory.
- **WP Dashboard**: Upload the generated plugin `.zip` via Plugins -> Add New -> Upload Plugin.
