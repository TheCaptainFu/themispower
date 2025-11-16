# 🚀 Quick Start: Using Tailwind CSS

## ✅ Tailwind is Ready!

Your GG theme now has Tailwind CSS v4.1.17 installed and configured.

---

## 🎯 Try It Now!

### 1. Start Watch Mode
Open a terminal and run:
```bash
cd /home/captainfu/projects/themispower
npm run tw:watch
```

Keep this running while you develop. It will auto-rebuild Tailwind when you add new classes.

### 2. Add Tailwind Classes to Your Homepage

Edit: `web/modules/custom/gg_homepage/templates/gg-homepage.html.twig`

**Replace this:**
```twig
<h1 class="hero-title">Welcome to GG</h1>
```

**With this:**
```twig
<h1 class="text-6xl font-bold text-white mb-6 animate-pulse">
  Welcome to GG
</h1>
```

### 3. Clear Drupal Cache
```bash
drush cr
```

### 4. Refresh Your Browser

Visit your homepage and see Tailwind in action! The title will now be larger, bolder, and pulsing.

---

## 💡 More Examples

### Beautiful Buttons
```twig
<a href="/user/register" 
   class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 
          text-white font-semibold rounded-lg shadow-lg 
          hover:shadow-2xl hover:scale-105 transform transition duration-300">
  Get Started
</a>
```

### Card Grid
```twig
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-8">
  <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-2xl transition">
    <h3 class="text-2xl font-bold mb-2 text-gray-800">Feature 1</h3>
    <p class="text-gray-600">Description here</p>
  </div>
  
  <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-2xl transition">
    <h3 class="text-2xl font-bold mb-2 text-gray-800">Feature 2</h3>
    <p class="text-gray-600">Description here</p>
  </div>
</div>
```

### Hero Section with Gradient
```twig
<section class="min-h-screen flex items-center justify-center 
                bg-gradient-to-br from-purple-600 via-pink-500 to-red-500">
  <div class="text-center text-white px-4">
    <h1 class="text-7xl font-extrabold mb-4 drop-shadow-2xl">
      Your Awesome Title
    </h1>
    <p class="text-2xl mb-8 opacity-90">
      Subheading goes here
    </p>
    <button class="bg-white text-purple-600 px-8 py-4 rounded-full 
                   font-bold text-lg hover:bg-gray-100 transition">
      Click Me
    </button>
  </div>
</section>
```

---

## 🎨 Common Tailwind Classes

### Layout
- `container mx-auto` - Centered container
- `flex items-center justify-between` - Flexbox
- `grid grid-cols-3 gap-4` - Grid layout

### Spacing
- `p-4` - Padding all sides
- `px-6 py-3` - Padding horizontal/vertical
- `m-2` - Margin
- `space-x-4` - Horizontal spacing between children

### Typography
- `text-xl` - Text size (xs, sm, base, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl, 8xl, 9xl)
- `font-bold` - Font weight (thin, light, normal, medium, semibold, bold, extrabold, black)
- `text-center` - Text alignment
- `text-gray-600` - Text color

### Colors
- `bg-blue-500` - Background color
- `text-white` - Text color
- `border-gray-300` - Border color

### Effects
- `shadow-lg` - Box shadow (sm, md, lg, xl, 2xl)
- `rounded-lg` - Border radius (sm, md, lg, xl, 2xl, 3xl, full)
- `opacity-50` - Opacity
- `hover:shadow-xl` - Hover effect
- `transition` - Smooth transitions

### Responsive
- `md:flex` - Apply on medium screens and up
- `lg:w-1/2` - Width on large screens
- `sm:text-sm` - Text size on small screens

Breakpoints:
- `sm:` - 640px and up
- `md:` - 768px and up  
- `lg:` - 1024px and up
- `xl:` - 1280px and up
- `2xl:` - 1536px and up

---

## 📚 Learn More

- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Utility-First Fundamentals](https://tailwindcss.com/docs/utility-first)
- [Responsive Design](https://tailwindcss.com/docs/responsive-design)
- [Hover, Focus, and Other States](https://tailwindcss.com/docs/hover-focus-and-other-states)

---

## 🔄 Development Workflow

1. **Terminal 1** - Keep watch mode running:
   ```bash
   npm run tw:watch
   ```

2. **Terminal 2** - Clear cache when needed:
   ```bash
   drush cr
   ```

3. **Edit templates** - Add Tailwind classes

4. **Browser** - Refresh to see changes

---

**Start building beautiful interfaces with Tailwind CSS!** 🎨

