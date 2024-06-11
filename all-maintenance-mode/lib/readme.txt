   === All-maintenance-mode ===
   Contributors: Oluwaseyi 
Tags: move, transfer, copy, migrate, maintenance, clone, restore, db migration, wordpress migration,website
Requires at least: 3.3
Tested up to: 4.9
Stable tag: 6.68
License: GPLv2 or later

   ## Description
   **all-maintenance-mode** is a lightweight WordPress plugin that allows you to put your site into maintenance mode. During maintenance mode, only administrators, logged-in users, and whitelisted IP addresses can access the site. All other visitors will see a customizable maintenance message.

   ## Features
   - Enable or disable maintenance mode with a single click.
   - Display a user-friendly maintenance message to non-logged-in visitors.
   - Administrators can bypass maintenance mode and access the site normally.
   - IP whitelist functionality to allow specific IP addresses to bypass maintenance mode.

   ## Installation

   1. Download the plugin and upload the `all-maintenance-mode` folder to your `/wp-content/plugins/` directory.
   2. Activate the plugin through the 'Plugins' menu in WordPress.
   3. Go to `Settings -> Maintenance Mode` to configure the plugin.

   ## Usage

   1. **Enable Maintenance Mode**:
      - Navigate to `Settings -> Maintenance Mode` in your WordPress admin dashboard.
      - Check the "Enable Maintenance Mode" checkbox and save changes.

   2. **IP Whitelist**:
      - In the same settings page, enter the IP addresses you want to whitelist in the "IP Whitelist" field.
      - Separate multiple IP addresses with commas.

   3. **Verification**:
      - Visit your site from a non-whitelisted IP or in an incognito window to see the maintenance mode message.
      - Ensure whitelisted IPs and administrators can still access the site.

   ## Settings
   - **Enable Maintenance Mode**: Activate maintenance mode to show the maintenance message to all non-logged-in and non-whitelisted visitors.
   - **IP Whitelist**: Enter a comma-separated list of IP addresses that should bypass maintenance mode.

   ## Changelog

   ### 1.1
   - Added IP whitelist feature to allow specific IP addresses to access the site during maintenance mode.

   ### 1.0
   - Initial release with basic maintenance mode functionality.

   ## License
   This plugin is licensed under the GPL2. See the [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html) file for more details.

   ## Author
   Developed by [Oluwaseyi ogunjinmi](https://github.com/Oluwaseyieniola).
