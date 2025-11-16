# Manual Node Display Guide

## ✅ You've Disabled Automatic Node Display!

The `{{ page.content }}` is now commented out in `page.html.twig`. This means **Drupal will NOT automatically display nodes** - you have full control!

## 🎯 How to Manually Display Nodes

### Method 1: Display Specific Node by ID (In Template)

**Step 1:** Add code to `gg.theme`:

```php
function gg_preprocess_page(&$variables) {
  if ($variables['is_front']) {
    $variables['#attached']['library'][] = 'gg/front-page';
    
    // Load node by ID
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');
    
    // Load node 5 (change the number to your node ID)
    $node = $node_storage->load(5);
    if ($node) {
      // Render it in 'full' view mode
      $variables['my_custom_node'] = $view_builder->view($node, 'full');
    }
  }
}
```

**Step 2:** Display it in your template (`page.html.twig` or `page--front.html.twig`):

```twig
{% block main_content %}
  <h1>My Custom Page</h1>
  
  {# Display the manually loaded node #}
  {{ my_custom_node }}
{% endblock %}
```

---

### Method 2: Display Multiple Nodes

**In `gg.theme`:**

```php
function gg_preprocess_page(&$variables) {
  if ($variables['is_front']) {
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');
    
    // Load multiple nodes by ID
    $nids = [1, 5, 10]; // Your node IDs
    $nodes = $node_storage->loadMultiple($nids);
    
    $variables['featured_nodes'] = [];
    foreach ($nodes as $node) {
      // Render in 'teaser' view mode
      $variables['featured_nodes'][] = $view_builder->view($node, 'teaser');
    }
  }
}
```

**In your template:**

```twig
{% block main_content %}
  <h1>Featured Articles</h1>
  
  <div class="featured-grid">
    {% for node in featured_nodes %}
      <div class="featured-item">
        {{ node }}
      </div>
    {% endfor %}
  </div>
{% endblock %}
```

---

### Method 3: Load Nodes by Criteria (Query)

**In `gg.theme`:**

```php
function gg_preprocess_page(&$variables) {
  if ($variables['is_front']) {
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');
    
    // Query for nodes
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'article')        // Content type
      ->condition('status', 1)               // Published only
      ->sort('created', 'DESC')              // Newest first
      ->range(0, 5)                          // Limit to 5
      ->accessCheck(TRUE);
    
    $nids = $query->execute();
    $nodes = $node_storage->loadMultiple($nids);
    
    $variables['latest_articles'] = [];
    foreach ($nodes as $node) {
      $variables['latest_articles'][] = $view_builder->view($node, 'teaser');
    }
  }
}
```

**In your template:**

```twig
{% block main_content %}
  <h1>Latest Articles</h1>
  
  {% if latest_articles %}
    <div class="articles-list">
      {% for article in latest_articles %}
        {{ article }}
      {% endfor %}
    </div>
  {% else %}
    <p>No articles found.</p>
  {% endif %}
{% endblock %}
```

---

### Method 4: Access Node Fields Directly

If you want **complete control** over the HTML structure:

**In `gg.theme`:**

```php
function gg_preprocess_page(&$variables) {
  if ($variables['is_front']) {
    $node = \Drupal::entityTypeManager()
      ->getStorage('node')
      ->load(5);
    
    if ($node) {
      // Pass the entire node object
      $variables['hero_node'] = $node;
    }
  }
}
```

**In your template:**

```twig
{% block main_content %}
  {% if hero_node %}
    <section class="hero">
      <h1>{{ hero_node.title.value }}</h1>
      <div class="hero-image">
        {{ hero_node.field_image|view }}
      </div>
      <div class="hero-body">
        {{ hero_node.body.value|raw }}
      </div>
    </section>
  {% endif %}
{% endblock %}
```

---

## 🎨 View Modes

When rendering nodes, you can use different **view modes**:

- `'full'` - Full content display
- `'teaser'` - Summary/teaser display
- `'card'` - Card display (if configured)
- Custom view modes you create

```php
$view_builder->view($node, 'full');    // Full content
$view_builder->view($node, 'teaser');  // Teaser/summary
```

---

## 📍 Where to Put This Code

### For Front Page Only:
- Add to `gg_preprocess_page()` with `if ($variables['is_front'])`
- Display in `page--front.html.twig`

### For All Pages:
- Add to `gg_preprocess_page()` without the `is_front` check
- Display in `page.html.twig`

### For Specific Pages:
```php
// For node pages only
if (!empty($variables['node'])) {
  // Do something
}

// For specific content type
if (!empty($variables['node']) && $variables['node']->getType() == 'article') {
  // Do something for articles only
}

// For specific path
$current_path = \Drupal::service('path.current')->getPath();
if ($current_path == '/my-custom-page') {
  // Do something
}
```

---

## ⚠️ Important Notes

1. **Clear cache** after modifying `gg.theme`:
   ```bash
   drush cr
   ```

2. **Check permissions** - Make sure nodes are published and accessible

3. **Handle missing nodes** - Always check if node exists:
   ```php
   if ($node && $node->access('view')) {
     // Node exists and user can view it
   }
   ```

4. **Performance** - Don't load too many nodes on one page

---

## 🔄 Want Automatic Display Back?

Just uncomment `{{ page.content }}` in `page.html.twig`:

```twig
{% block main_content %}
  {{ page.content }}  {# Uncomment this line #}
{% endblock %}
```

Clear cache and you're back to automatic!

---

## 💡 Best Practice

**For complete control over your front page:**

1. ✅ Keep `{{ page.content }}` commented out in `page.html.twig`
2. ✅ Override `main_content` block in `page--front.html.twig`
3. ✅ Use preprocess functions to load exactly what you need
4. ✅ Build your custom HTML structure in the template

This gives you **total control** while keeping other pages working normally!

