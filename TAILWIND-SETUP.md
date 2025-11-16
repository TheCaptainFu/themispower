# ✅ Tailwind CSS Setup Complete!

Tailwind CSS has been successfully installed in your GG theme using the [Tailwind CLI](https://tailwindcss.com/docs/installation/tailwind-cli) method.

## 📦 What Was Installed

```bash
✅ tailwindcss v4.1.17
✅ @tailwindcss/cli v4.1.17
```

## 📁 File Structure

```
themispower/
├── package.json                                # npm scripts for Tailwind
├── node_modules/                               # Tailwind packages
└── web/themes/custom/gg/
    ├── src/
    │   └── input.css                          # Tailwind source (edit this)
    ├── css/
    │   ├── tailwind.css                       # Compiled Tailwind (auto-generated)
    │   ├── style.css                          # Your custom global styles
    │   └── front-page.css                     # Front page styles
    ├── gg.info.yml                            # Theme includes Tailwind
    └── gg.libraries.yml                       # Tailwind library definition
```

## 🎨 How It Works

### 1. Source File (Edit This)
`web/themes/custom/gg/src/input.css`
```css
@import "tailwindcss";

/* Your custom Tailwind styles here */
```

### 2. Build Process
When you run `npm run tw:build`, Tailwind:
- Scans your templates for utility classes
- Generates only the CSS you're using
- Outputs to `css/tailwind.css`

### 3. Drupal Integration
- Tailwind CSS loads on **all pages** (defined in `gg.info.yml`)
- Your custom CSS loads after Tailwind
- Front page CSS loads only on homepage

---

## 🚀 Usage

### Build Tailwind CSS (Production)
Compile Tailwind once:
```bash
npm run tw:build
```

### Watch Mode (Development)
Auto-rebuild when you change templates:
```bash
npm run tw:watch
```

This runs in the background and rebuilds whenever you use new Tailwind classes.

### Clear Drupal Cache
After building Tailwind or making changes:
```bash
drush cr
```

---

## 💡 Using Tailwind in Templates

Now you can use Tailwind utility classes in your Twig templates!

### Example: Update Homepage Template

Edit: `web/modules/custom/gg_homepage/templates/gg-homepage.html.twig`

**Before:**
```twig
<h1 class="hero-title">Welcome to GG</h1>
<p class="hero-subtitle">Your powerful site</p>
```

**After (with Tailwind):**
```twig
<h1 class="text-5xl font-bold text-white mb-4">Welcome to GG</h1>
<p class="text-xl text-white opacity-95">Your powerful site</p>
```

### Example: Tailwind Utility Classes

```html
<!-- Typography -->
<h1 class="text-3xl font-bold">Heading</h1>
<p class="text-gray-600">Paragraph</p>

<!-- Layout -->
<div class="flex items-center justify-between">
  <div class="w-1/2">Half width</div>
  <div class="w-1/2">Half width</div>
</div>

<!-- Spacing -->
<div class="p-4 m-2">Padding & Margin</div>

<!-- Colors -->
<button class="bg-blue-500 text-white hover:bg-blue-600">
  Button
</button>

<!-- Responsive -->
<div class="w-full md:w-1/2 lg:w-1/3">
  Responsive width
</div>
```

---

## 🎯 Workflow

### Development Workflow

1. **Start watch mode:**
   ```bash
   npm run tw:watch
   ```

2. **Edit your templates** and add Tailwind classes:
   ```twig
   <div class="container mx-auto px-4">
     <h1 class="text-4xl font-bold text-center">Hello</h1>
   </div>
   ```

3. **Tailwind auto-rebuilds** when you save

4. **Clear Drupal cache:**
   ```bash
   drush cr
   ```

5. **Refresh browser** to see changes

### Production Workflow

1. **Build Tailwind:**
   ```bash
   npm run tw:build
   ```

2. **Commit the compiled CSS:**
   ```bash
   git add web/themes/custom/gg/css/tailwind.css
   git commit -m "Update Tailwind CSS"
   ```

3. **Deploy to production**

---

## 📚 Tailwind CSS Resources

### Official Documentation
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Utility Classes](https://tailwindcss.com/docs/styling-with-utility-classes)
- [Responsive Design](https://tailwindcss.com/docs/responsive-design)
- [Dark Mode](https://tailwindcss.com/docs/dark-mode)

### Useful Utilities
- **Layout**: `flex`, `grid`, `container`, `mx-auto`
- **Spacing**: `p-4`, `m-2`, `space-x-4`, `gap-4`
- **Typography**: `text-xl`, `font-bold`, `text-center`, `text-gray-600`
- **Colors**: `bg-blue-500`, `text-white`, `border-gray-300`
- **Effects**: `shadow-lg`, `hover:shadow-xl`, `transition`, `opacity-50`
- **Responsive**: `md:flex`, `lg:w-1/2`, `sm:text-sm`

---

## 🎨 Customization

### Add Custom Colors

Edit: `web/themes/custom/gg/src/input.css`

```css
@import "tailwindcss";

/* Custom Tailwind configuration */
@theme {
  --color-brand: #667eea;
  --color-brand-dark: #764ba2;
}
```

Then use in templates:
```html
<div class="bg-brand text-white">Custom brand color</div>
```

### Add Custom Utilities

```css
@import "tailwindcss";

@layer utilities {
  .content-auto {
    content-visibility: auto;
  }
}
```

---

## 🔧 Scripts Reference

| Command | Description |
|---------|-------------|
| `npm run tw:build` | Build Tailwind CSS once (production) |
| `npm run tw:watch` | Watch mode - auto-rebuild on changes (development) |
| `drush cr` | Clear Drupal cache after building |

---

## 📝 Tips & Best Practices

### 1. **Use Watch Mode During Development**
Keep `npm run tw:watch` running in a terminal while you work. It will automatically rebuild when you add new Tailwind classes.

### 2. **Combine with Custom CSS**
- Use Tailwind for **utilities**: spacing, colors, typography
- Use custom CSS for **complex components**: animations, unique layouts

### 3. **Keep Classes Organized**
```twig
{# Good - organized and readable #}
<div class="
  flex items-center justify-between
  p-4 m-2
  bg-white shadow-lg rounded-lg
  hover:shadow-xl transition
">
```

### 4. **Use @apply in Custom CSS (Optional)**
In `src/input.css`:
```css
@import "tailwindcss";

.btn-primary {
  @apply px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600;
}
```

### 5. **Responsive Design**
```html
<!-- Mobile first approach -->
<div class="text-sm md:text-base lg:text-lg">
  Responsive text size
</div>
```

---

## 🐛 Troubleshooting

### Tailwind classes not working?

1. **Build Tailwind:**
   ```bash
   npm run tw:build
   ```

2. **Check if classes are in your templates:**
   Tailwind only includes classes you actually use

3. **Clear Drupal cache:**
   ```bash
   drush cr
   ```

4. **Check browser console** for CSS loading errors

### Watch mode not detecting changes?

- Make sure you're editing files in the correct location
- Restart watch mode: `Ctrl+C` then `npm run tw:watch`

### CSS not loading?

- Check `gg.libraries.yml` has the tailwind library
- Check `gg.info.yml` includes the library
- Clear cache: `drush cr`

---

## 📦 What Files to Commit

**DO commit:**
- ✅ `package.json`
- ✅ `web/themes/custom/gg/src/input.css`
- ✅ `web/themes/custom/gg/css/tailwind.css` (production build)
- ✅ `web/themes/custom/gg/gg.libraries.yml`
- ✅ `web/themes/custom/gg/gg.info.yml`

**DON'T commit:**
- ❌ `node_modules/`
- ❌ `package-lock.json` (unless you want to lock versions)

---

## 🎉 You're Ready!

Tailwind CSS is now fully integrated with your GG theme. Start using utility classes in your templates!

### Quick Start

1. **Start watch mode:**
   ```bash
   npm run tw:watch
   ```

2. **Edit a template** (e.g., `gg-homepage.html.twig`):
   ```twig
   <h1 class="text-5xl font-bold text-center text-blue-600">
     Hello Tailwind!
   </h1>
   ```

3. **Clear cache:**
   ```bash
   drush cr
   ```

4. **Visit your site** and see Tailwind in action! 🚀

---

## 📖 Next Steps

- Explore [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- Start replacing custom CSS with Tailwind utilities
- Use Tailwind's responsive modifiers for mobile-first design
- Check out [Tailwind UI](https://tailwindui.com/) for component examples

**Happy styling with Tailwind CSS!** 🎨

