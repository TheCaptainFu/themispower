# How to Set Your Drupal Homepage

## 🎯 What You're Setting

When someone visits **`/`** (your site's root URL), Drupal needs to know what to display. By default, it shows a list of recent content, but you can set it to display anything you want.

---

## Method 1: Admin UI (Recommended)

### Step 1: Navigate to Site Information
Go to: **`/admin/config/system/site-information`**

Or navigate through admin menu:
1. **Configuration** → **System** → **Basic site settings**

### Step 2: Set Front Page Path
Scroll down to the **"Front page"** section.

In the "Default front page" field, enter one of these:

#### Option A: Display a Specific Node
```
/node/1
```
Replace `1` with your node ID. This will display that node as your homepage.

#### Option B: Display a View
```
/articles
```
If you created a view with path `/articles`, this will be your homepage.

#### Option C: Custom Path
```
/home
```
Any custom path you've created.

### Step 3: Save Configuration
Click **"Save configuration"** button at the bottom.

### Step 4: Visit Your Site
Go to `http://yoursite.com/` and see your new homepage!

---

## Method 2: Using Drush (If Available)

### Check Current Homepage
```bash
drush config:get system.site page.front
```

### Set New Homepage
```bash
# Set node 1 as homepage
drush config:set system.site page.front /node/1

# Or set a custom path
drush config:set system.site page.front /home

# Clear cache
drush cr
```

---

## Method 3: Direct Configuration File (Advanced)

If you have access to the database or config files:

### Edit via Configuration Management
1. Go to: `/admin/config/development/configuration/single/export`
2. Configuration type: **System (simple configuration)**
3. Configuration name: **system.site**
4. Find the line: `page.front: /node`
5. Go to: `/admin/config/development/configuration/single/import`
6. Paste modified configuration
7. Import

---

## 📋 Common Homepage Options

### 1. Display a Specific Node
**Use case**: You want a custom "Welcome" page

**Steps**:
1. Create a new page (Content → Add content → Basic page)
2. Title it "Home" or "Welcome"
3. Add your content
4. Save and note the node ID (in the URL: `/node/5`)
5. Set front page to: `/node/5`

**Your `page--front.html.twig` will be used** to render this node!

---

### 2. Display a View (List of Content)
**Use case**: You want to show latest articles, blog posts, etc.

**Steps**:
1. Create a view: `/admin/structure/views/add`
2. Display content of type: **Article** (or your content type)
3. Create a page with path: `/articles`
4. Set front page to: `/articles`

---

### 3. Use Your Custom Front Page Template
**Use case**: You want complete custom HTML (what we built!)

**Steps**:
1. Create a basic node with minimal content (node ID 1)
2. Set front page to: `/node/1`
3. Edit `page--front.html.twig` to override the content:

```twig
{% extends "page.html.twig" %}

{% block main_content %}
  {# Your custom HTML - ignores the node content #}
  <h1>Welcome to My Site</h1>
  <p>Custom homepage content here</p>
{% endblock %}
```

This way:
- ✅ The route is `/` (homepage)
- ✅ `page--front.html.twig` is used
- ✅ You control all the HTML
- ✅ The node content is replaced by your custom content

---

## 🎨 Best Practice for Custom Front Page

### Recommended Approach:

**1. Create a "Front Page" Node:**
- Go to: `/node/add/page`
- Title: "Home"
- Body: Leave blank or add minimal content
- Save (let's say it becomes `/node/1`)

**2. Set it as Homepage:**
- Go to: `/admin/config/system/site-information`
- Set "Default front page" to: `/node/1`
- Save

**3. Customize the Template:**
Edit `web/themes/custom/gg/templates/layout/page--front.html.twig`:

```twig
{% extends "page.html.twig" %}

{% block main_content %}
  {# Your custom hero section #}
  <section class="hero-section">
    <div class="hero-content">
      <h1 class="hero-title">Welcome to GG</h1>
      <p class="hero-subtitle">Your powerful Drupal site</p>
      <div class="hero-actions">
        <a href="#main-content" class="btn btn-primary">Get Started</a>
      </div>
    </div>
  </section>

  {# Your features section #}
  <section class="features-section">
    <div class="features-container">
      <div class="feature-item">
        <div class="feature-icon">🚀</div>
        <h3>Fast</h3>
        <p>Built for speed and performance</p>
      </div>
      <div class="feature-item">
        <div class="feature-icon">🎨</div>
        <h3>Beautiful</h3>
        <p>Modern and clean design</p>
      </div>
      <div class="feature-item">
        <div class="feature-icon">📱</div>
        <h3>Responsive</h3>
        <p>Works on all devices</p>
      </div>
    </div>
  </section>
  
  {# Optionally include the node content too #}
  {# {{ page.content }} #}
{% endblock %}
```

**4. Clear Cache:**
```bash
drush cr
```

**5. Visit:**
- Homepage: `http://yoursite.com/` → Custom front page template
- Node directly: `http://yoursite.com/node/1` → Regular node display

---

## 🔍 How to Find Your Node ID

### Method 1: Look at the URL
After creating/editing a node, look at the URL:
```
http://yoursite.com/node/5/edit
                         ↑
                      Node ID is 5
```

### Method 2: Content List
1. Go to: `/admin/content`
2. Find your node
3. Hover over "Edit" - look at bottom of browser for URL
4. Note the number after `/node/`

### Method 3: Using Drush
```bash
# List recent nodes
drush sqlq "SELECT nid, title FROM node_field_data ORDER BY nid DESC LIMIT 10"
```

---

## ⚠️ Important Notes

### 1. The `<front>` Special Path
- In Drupal, `<front>` is a special keyword meaning "homepage"
- You can link to homepage: `<a href="{{ path('<front>') }}">Home</a>`

### 2. Permissions
- Make sure the node you set as homepage is **Published**
- Make sure anonymous users have permission to view it

### 3. Cache
- Always clear cache after changing front page configuration
- Drupal caches routing

### 4. Template Detection
When you set `/node/1` as homepage, Drupal looks for templates in this order:
1. `page--front.html.twig` ← **Used for homepage!**
2. `page--node--1.html.twig`
3. `page--node--page.html.twig`
4. `page--node.html.twig`
5. `page.html.twig`

---

## 🧪 Testing Your Setup

### 1. Check Current Homepage Setting:
**Admin UI**: `/admin/config/system/site-information`

### 2. Check Template Being Used:
- Visit: `http://yoursite.com/`
- Inspect page (F12)
- Look for:
```html
<!-- THEME DEBUG -->
<!-- FILE NAME SUGGESTIONS:
   ✅ page--front.html.twig
-->
```

### 3. Check if Node is Being Used:
If you set `/node/1` as homepage:
- Visit: `http://yoursite.com/`
- Inspect page
- Look for node debug info

---

## 💡 Quick Start Checklist

- [ ] Create a basic page node
- [ ] Note the node ID (e.g., `/node/5`)
- [ ] Go to `/admin/config/system/site-information`
- [ ] Set "Default front page" to `/node/5`
- [ ] Save configuration
- [ ] Clear cache
- [ ] Visit `/` to see your homepage
- [ ] Inspect page to confirm `page--front.html.twig` is used
- [ ] Customize the template as needed

---

## 🎉 Result

After setting this up:
- ✅ Visiting `/` shows your custom homepage
- ✅ `page--front.html.twig` template is used
- ✅ Your front-page CSS is loaded
- ✅ Complete control over homepage appearance
- ✅ Other pages work normally

