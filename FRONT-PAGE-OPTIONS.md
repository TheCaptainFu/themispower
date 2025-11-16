# Front Page Template Options

## ✅ You Won't Get Errors!

**Important**: If `page--front.html.twig` doesn't exist, Drupal automatically uses `page.html.twig` for the front page. **This is completely normal and won't cause any errors.**

## Current Setup: Template Inheritance

I've set up your theme to use **template inheritance**, which is the cleanest approach:

- `page.html.twig` = Base template (used by all pages)
- `page--front.html.twig` = Extends the base and only adds front-page-specific content

## 🎯 Three Ways to Handle Your Front Page

### Option 1: Delete `page--front.html.twig` (Use Same Template)

**Result**: Front page looks exactly like all other pages.

```bash
# Delete the front page template
rm web/themes/custom/gg/templates/layout/page--front.html.twig

# Clear cache
drush cr
```

✅ **Pros:**
- Simplest approach
- Consistent design across all pages
- Less maintenance

❌ **Cons:**
- No special front page styling

---

### Option 2: Use Template Inheritance (Current Setup - Recommended)

**Result**: Front page gets everything from `page.html.twig` PLUS extra sections.

This is what you have now! The `page--front.html.twig` uses:

```twig
{% extends "page.html.twig" %}

{% block content_before %}
  <!-- Your hero section and features here -->
{% endblock %}
```

**What happens:**
1. Drupal loads `page--front.html.twig` for the front page
2. That template says "extend page.html.twig"
3. Everything from `page.html.twig` is included
4. Only the `content_before` block is replaced with your custom content

✅ **Pros:**
- Clean code - no duplication
- Easy to maintain
- Front page can add sections without rewriting everything
- If you update `page.html.twig`, front page gets those updates too

❌ **Cons:**
- Slightly more complex concept (but best practice)

**Available Blocks You Can Override:**
- `{% block content_before %}` - Adds content before the main content area
- `{% block main_content %}` - Replaces the main content entirely
- `{% block content_after %}` - Adds content after the main content area

---

### Option 3: Completely Separate Template

**Result**: Front page is totally different from other pages.

Copy everything from `page.html.twig` into `page--front.html.twig` and modify as needed (without the `{% extends %}` line).

✅ **Pros:**
- Complete control
- Front page can be totally different

❌ **Cons:**
- Code duplication
- If you update `page.html.twig`, you must manually update `page--front.html.twig`
- More code to maintain

---

## 🎨 Current File Structure

```
templates/layout/
├── page.html.twig              # Base template (all pages)
└── page--front.html.twig       # Front page (extends base)
```

## 📝 How to Customize

### To modify ALL pages (including front):
Edit `page.html.twig`

### To modify ONLY the front page:
Edit `page--front.html.twig`

Add or modify these blocks:

```twig
{% extends "page.html.twig" %}

{# Add content BEFORE the main content #}
{% block content_before %}
  <section class="hero">
    <h1>Welcome!</h1>
  </section>
{% endblock %}

{# Replace the main content entirely #}
{% block main_content %}
  <div class="custom-content">
    {{ page.content }}
  </div>
{% endblock %}

{# Add content AFTER the main content #}
{% block content_after %}
  <section class="call-to-action">
    <a href="/contact">Get in touch</a>
  </section>
{% endblock %}
```

## 🔄 Template Fallback Order

When Drupal renders the front page, it looks for templates in this order:

1. `page--front.html.twig` ← **Most specific** (if exists, use this)
2. `page.html.twig` ← **Fallback** (if #1 doesn't exist)
3. Core template ← **Last resort** (if your theme has no templates)

**No errors occur** if any template is missing - Drupal just uses the next one in the list!

## 🧪 Test Your Setup

1. **Clear cache**: `drush cr`
2. **Visit your front page** in a browser
3. **Inspect the page** (F12)
4. **Look for HTML comments**:

```html
<!-- THEME DEBUG -->
<!-- THEME HOOK: 'page' -->
<!-- FILE NAME SUGGESTIONS:
   ✅ page--front.html.twig
   * page.html.twig
-->
<!-- BEGIN OUTPUT from 'themes/custom/gg/templates/layout/page--front.html.twig' -->
```

The ✅ shows which template is being used!

## 💡 Recommendation

**Keep the current setup (Option 2)** - it's the most flexible and maintainable approach. You get:

- A base template that works for all pages
- A front page that inherits the base AND adds special sections
- Easy to maintain - changes to the base affect all pages
- No code duplication

If you decide you don't need a special front page, just delete `page--front.html.twig` - no errors, it just falls back to `page.html.twig`!

