# Twig Debug Mode Guide

## ✅ Twig Debug Enabled!

Twig debugging has been enabled in your Drupal site. This will help you see template suggestions when inspecting your site.

## 🔍 How to View Template Suggestions

### Step 1: Clear Cache
After enabling Twig debug mode, you MUST clear the cache:

```bash
# If you have Drush installed:
drush cr

# Or via web UI:
# Visit: /admin/config/development/performance
# Click "Clear all caches"
```

### Step 2: View Your Site
Open your site in a web browser and navigate to any page (especially the front page).

### Step 3: Inspect the HTML
- Right-click on any element and select "Inspect" or "Inspect Element"
- OR press F12 to open Developer Tools
- Look at the HTML source code

### Step 4: Find Template Suggestions
You'll see HTML comments like this:

```html
<!-- THEME DEBUG -->
<!-- THEME HOOK: 'page' -->
<!-- FILE NAME SUGGESTIONS:
   * page--front.html.twig
   ✅ page.html.twig
   * page--node.html.twig
   * page--node--1.html.twig
-->
<!-- BEGIN OUTPUT from 'themes/custom/gg/templates/layout/page--front.html.twig' -->

... your page content ...

<!-- END OUTPUT from 'themes/custom/gg/templates/layout/page--front.html.twig' -->
```

## 📋 What the Comments Tell You

1. **THEME HOOK**: The base template name (e.g., 'page', 'node', 'block')
2. **FILE NAME SUGGESTIONS**: All possible template names you can use (in order of priority)
   - The ✅ or ⭐ marks the template currently being used
   - Templates listed above the active one have higher priority
   - Templates listed below are fallbacks
3. **BEGIN/END OUTPUT**: Shows exactly which template file is rendering that section

## 🎯 Example: Front Page Template

When you inspect your **front page**, you should see:

```html
<!-- FILE NAME SUGGESTIONS:
   ✅ page--front.html.twig
   * page.html.twig
-->
<!-- BEGIN OUTPUT from 'themes/custom/gg/templates/layout/page--front.html.twig' -->
```

This confirms your `page--front.html.twig` is being used on the front page!

## 🔄 Creating New Templates

Based on the suggestions you see, you can create new templates:

1. Look at the FILE NAME SUGGESTIONS in the debug output
2. Copy a base template (like `page.html.twig`)
3. Rename it to match one of the suggestions (e.g., `page--node--article.html.twig`)
4. Place it in your theme's templates directory
5. Clear cache
6. The new template will be used automatically!

## ⚠️ Important Notes

- **Always clear cache** after creating or modifying templates
- **Don't use in production** - Twig debug adds comments to your HTML and slows down the site
- **Auto-reload is enabled** - Templates will recompile when you change them (you still need to clear cache for new templates)

## 🔧 Settings Changed

In `/web/sites/default/services.yml`:

```yaml
twig.config:
  debug: true          # Shows template suggestions
  auto_reload: true    # Recompiles templates on changes
```

## 🚫 To Disable Twig Debug

When moving to production, change in `services.yml`:

```yaml
twig.config:
  debug: false
  auto_reload: null
```

Then clear cache again.

---

**Ready to test?** Clear your cache and inspect your front page!

