# GG Homepage Module

This module provides a custom homepage route at `/home` for your Drupal site.

## What It Does

- Creates a custom route: `/home`
- Provides a beautiful, modern homepage with:
  - Hero section
  - Features grid (6 feature cards)
  - Call-to-action section
- Styled using your theme's front-page CSS

## Installation

### Step 1: Enable the Module

**Via Drush:**
```bash
drush en gg_homepage -y
drush cr
```

**Via Admin UI:**
1. Go to: `/admin/modules`
2. Find "GG Homepage" under "Custom"
3. Check the box
4. Click "Install"

### Step 2: Set as Homepage

**Via Admin UI:**
1. Go to: `/admin/config/system/site-information`
2. In "Default front page" field, enter: `/home`
3. Click "Save configuration"

**Via Drush:**
```bash
drush config:set system.site page.front /home -y
drush cr
```

### Step 3: Visit Your Homepage

Go to `http://yoursite.com/` and see your new homepage!

## Customization

### Edit Content

Edit the template file:
```
web/modules/custom/gg_homepage/templates/gg-homepage.html.twig
```

Change:
- Titles and text
- Feature icons and descriptions
- Button links
- Add/remove sections

**After editing, clear cache:**
```bash
drush cr
```

### Edit Styling

The homepage uses CSS from your theme:
```
web/themes/custom/gg/css/front-page.css
```

Styles are automatically loaded when viewing the front page.

### Add Dynamic Content

Edit the controller to load nodes, views, or other data:
```php
// File: src/Controller/HomeController.php

public function content() {
  // Load nodes
  $node_storage = \Drupal::entityTypeManager()->getStorage('node');
  $nodes = $node_storage->loadMultiple([1, 2, 3]);
  
  $build = [
    '#theme' => 'gg_homepage',
    '#nodes' => $nodes,
  ];
  
  return $build;
}
```

Then access in template:
```twig
{% for node in nodes %}
  <h3>{{ node.title.value }}</h3>
{% endfor %}
```

## File Structure

```
gg_homepage/
├── gg_homepage.info.yml           # Module definition
├── gg_homepage.module             # Hooks
├── gg_homepage.routing.yml        # Route definition
├── src/
│   └── Controller/
│       └── HomeController.php     # Page controller
├── templates/
│   └── gg-homepage.html.twig      # Homepage template
└── README.md                      # This file
```

## How It Works

1. **Route**: `/home` is defined in `gg_homepage.routing.yml`
2. **Controller**: `HomeController` returns a render array
3. **Theme**: Render array uses `gg_homepage` theme hook
4. **Template**: `gg-homepage.html.twig` renders the content
5. **Page Template**: Content is wrapped by `page--front.html.twig` (or `page.html.twig`)
6. **CSS**: Front page styles are automatically loaded

## Uninstall

### Via Drush:
```bash
drush pmu gg_homepage -y
drush cr
```

### Via Admin UI:
1. First, change homepage back to default: `/admin/config/system/site-information`
2. Set "Default front page" to: `/node`
3. Save
4. Go to: `/admin/modules/uninstall`
5. Check "GG Homepage"
6. Uninstall

## Notes

- The route is `/home`, not `/front` or `/`
- To make it your homepage, set it in site configuration
- Template debugging is helpful for development
- Always clear cache after changes

