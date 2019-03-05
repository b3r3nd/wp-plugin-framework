# Coding Standards #
 Please read the WordPress coding standards here: https://codex.wordpress.org/WordPress_Coding_Standards

 Also change your Code Style in your Editor to WordPress too (for PHPStorm):
 1. Navigate to Project Settings > Code style > PHP.
 2. Select "Set From.." on the right side > Predefined Style > WordPress.
 3. Reformat your code using Ctrl + Alt + R, do this before you commit your code.
 
 Surely these code standards are debatable and there isn't one perfect way to do it, however we are already working inside
 WordPress, so lets keep true to their coding standards as well.
 
# Object Oriented PHP #
 We choose an OO approach to writing plugins, not matter the size - you can just use the template. We do this for a couple
 reasons:
 1. **Structure and Readability** - Bringing structure to our code is important, its easy to understand where the code is located and what each class/function does it adds a lot to readability.
 2. **Scaleable** - Its easier to expand and expand and expand on a plugin written according to the OOP rules. Think about it when you place everything in just a functions.php file..
 3. **Somewhat Modular** - Take a look at our Plugin class, it requires only little change to add or remove a few functions there, and that is what we aim for! Easy to maintain, easy to enable/disable a couple parts of the plugin without breaking everything.
 
 
# Examples Added #
 The plugin adds examples for the following situations:
 - Register styles and scripts in wp_admin.
 - Register styles and script on the frontend.
 - Register 3 admin menu's.
    - Default admin menu.
    - Default admin sub menu.
    - Menu Settings page.
- Add one example setting.
- How to change the example setting using the Menu Settings page.
- Register custom Post type.
- Register shortcodes.
- Check for required plugins and dependencies
- Hooks on plugin activation and deactivation.
 
# Other #
 Read the template, and learn to understand how it works! We are constantly trying out new best practices and try to
 figure out what works best for us, this is just a first version. We added for example a Class called Constants
 in which we keep track of global plugin information usually called upon in multiple occasions. This way its easy to change
 to values later as well (if required).
 - Language domain
 - Plugin slug
 - Plugin short name
 - Used options group
 - Options page
 - Options sub menu page
 - Settings sub menu page
 - Plugin version
 - Plugin author
 - Plugin url.


**Author:** Berend de Groot<br>
**Version:** 1.0