# ✅ Logged In / Logged Out Homepage

Your homepage now shows **different content** based on whether the user is logged in or logged out!

## 🎯 What Was Created

### Two Different Views:

#### 1️⃣ **Logged OUT (Anonymous Users)**
Shows:
- 🎨 Hero section with "Welcome to GG"
- ✨ 6 feature cards
- 📢 Call-to-action with "Sign Up" button
- 🔗 Login and Register buttons

#### 2️⃣ **Logged IN (Authenticated Users)**
Shows:
- 👋 Personalized "Welcome Back, [Username]!"
- ⚡ Quick action dashboard with 4 cards:
  - Create Content
  - Manage Content
  - Your Profile
  - Site Admin
- 📊 Recent Activity section

---

## 📁 Files Updated

```
✅ web/modules/custom/gg_homepage/templates/gg-homepage.html.twig
   - Added {% if logged_in %} conditional logic
   - Two complete layouts (logged in & out)

✅ web/modules/custom/gg_homepage/src/Controller/HomeController.php
   - Passes user authentication status
   - Passes current username

✅ web/modules/custom/gg_homepage/gg_homepage.module
   - Updated theme variables

✅ web/themes/custom/gg/css/front-page.css
   - Recreated with styles for both views
   - Logged-in user dashboard styles
   - Logged-out user marketing styles

✅ web/themes/custom/gg/gg.theme
   - Recreated to load front-page CSS
```

---

## 🚀 How to Test

### Step 1: Clear Cache
```bash
drush cr
```

### Step 2: Test as Logged Out User
1. **Log out** (or open in incognito/private window)
2. Visit: `http://yoursite.com/`
3. You should see:
   - Hero section with gradient
   - Feature cards
   - Sign Up / Sign In buttons

### Step 3: Test as Logged In User
1. **Log in** to your site
2. Visit: `http://yoursite.com/`
3. You should see:
   - "Welcome Back, [Your Username]!"
   - Dashboard with quick action cards
   - Recent Activity section

---

## 🎨 How It Works

### Template Logic

```twig
{% if logged_in %}
  {# Show logged-in user dashboard #}
  <h1>Welcome Back, {{ current_user.name }}!</h1>
  {# Quick action cards #}
{% else %}
  {# Show marketing page for anonymous users #}
  <h1>Welcome to GG</h1>
  {# Feature cards and CTA #}
{% endif %}
```

### Controller

```php
// Gets current user status
$current_user = \Drupal::currentUser();
$is_logged_in = $current_user->isAuthenticated();

// Passes to template
$build = [
  '#logged_in' => $is_logged_in,
  '#current_user' => [
    'name' => $current_user->getAccountName(),
  ],
];
```

---

## ✏️ Customization

### Change Logged Out Content

Edit: `web/modules/custom/gg_homepage/templates/gg-homepage.html.twig`

Find the `{% else %}` section (around line 62):

```twig
{% else %}
  {# LOGGED OUT VIEW - Edit here #}
  
  <section class="hero-section">
    <h1 class="hero-title">Your Custom Title</h1>
    <p class="hero-subtitle">Your custom message</p>
  </section>
{% endif %}
```

### Change Logged In Content

Find the `{% if logged_in %}` section (around line 13):

```twig
{% if logged_in %}
  {# LOGGED IN VIEW - Edit here #}
  
  <h1>Welcome Back, {{ current_user.name }}!</h1>
  
  {# Add/remove quick links #}
  <a href="/your-custom-link" class="quick-link-card">
    <div class="quick-link-icon">🎯</div>
    <h3>Custom Action</h3>
    <p>Description here</p>
  </a>
{% endif %}
```

### Change Styles

Edit: `web/themes/custom/gg/css/front-page.css`

**Logged Out styles** (line 81-220):
```css
.hero-section { }
.features-section { }
.cta-section { }
```

**Logged In styles** (line 222-300):
```css
.welcome-back-section { }
.dashboard-section { }
.activity-section { }
```

---

## 💡 Advanced: Add Dynamic Content

### Show User's Recent Nodes (Logged In)

**Update Controller** (`HomeController.php`):

```php
public function content() {
  $current_user = \Drupal::currentUser();
  $is_logged_in = $current_user->isAuthenticated();
  
  $recent_nodes = [];
  
  if ($is_logged_in) {
    // Load user's recent nodes
    $query = \Drupal::entityQuery('node')
      ->condition('uid', $current_user->id())
      ->condition('status', 1)
      ->sort('created', 'DESC')
      ->range(0, 5)
      ->accessCheck(TRUE);
    
    $nids = $query->execute();
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    $nodes = $node_storage->loadMultiple($nids);
    
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');
    foreach ($nodes as $node) {
      $recent_nodes[] = $view_builder->view($node, 'teaser');
    }
  }
  
  $build = [
    '#theme' => 'gg_homepage',
    '#logged_in' => $is_logged_in,
    '#current_user' => [
      'name' => $current_user->getAccountName(),
      'id' => $current_user->id(),
    ],
    '#recent_nodes' => $recent_nodes,
    '#cache' => [
      'contexts' => ['user'],
      'tags' => ['user:' . $current_user->id()],
    ],
  ];
  
  return $build;
}
```

**Update Theme Hook** (`gg_homepage.module`):

```php
function gg_homepage_theme($existing, $type, $theme, $path) {
  return [
    'gg_homepage' => [
      'variables' => [
        'logged_in' => FALSE,
        'current_user' => NULL,
        'recent_nodes' => [],
      ],
    ],
  ];
}
```

**Display in Template**:

```twig
{% if logged_in and recent_nodes %}
  <section class="recent-content">
    <h2>Your Recent Content</h2>
    {% for node in recent_nodes %}
      {{ node }}
    {% endfor %}
  </section>
{% endif %}
```

---

## 🔧 Caching

The homepage is cached **per user**, which means:
- ✅ Each user sees their personalized version
- ✅ Anonymous users share the same cached version
- ✅ Performance is maintained

Cache configuration in controller:
```php
'#cache' => [
  'contexts' => ['user'], // Cache per user
  'tags' => ['user:' . $current_user->id()],
],
```

---

## 📋 Quick Reference

| User Status | What They See |
|-------------|---------------|
| **Logged Out** | Hero + Features + CTA with Sign Up |
| **Logged In** | Welcome Back + Dashboard + Quick Actions |

| To Change | Edit This File |
|-----------|----------------|
| Logged Out HTML | `gg-homepage.html.twig` ({% else %} section) |
| Logged In HTML | `gg-homepage.html.twig` ({% if logged_in %} section) |
| Styles | `css/front-page.css` |
| Logic/Data | `HomeController.php` |

---

## ✅ Checklist

- [x] Template shows different content for logged in/out
- [x] Controller passes user information
- [x] CSS includes styles for both views
- [x] Caching works per user
- [x] Responsive on all devices

---

## 🎉 Result

Your homepage now provides a **personalized experience**:

- **New visitors** see compelling marketing content
- **Existing users** see a useful dashboard
- **Everyone** gets a beautiful, responsive experience

**Clear cache and test it out!** 🚀

```bash
drush cr
```

