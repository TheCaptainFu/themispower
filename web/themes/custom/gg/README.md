# GG Theme

A custom Drupal theme for the Themispower project.

## Features

- Clean, modern design
- Responsive layout
- Based on Stable9 theme
- Custom front page with hero section and features
- Global CSS styling
- Mobile-first responsive design

## Installation

1. The theme is already located in `web/themes/custom/gg`
2. Enable the theme via Drupal admin:
   - Navigate to Appearance (`/admin/appearance`)
   - Find "GG" theme and click "Install and set as default"
3. Clear cache: `drush cr` or via admin UI at `/admin/config/development/performance`

## Front Page

The theme includes a custom front page template with:

- **Hero Section**: Eye-catching gradient header with title and call-to-action
- **Features Section**: Three feature boxes highlighting key aspects
- **Custom Styling**: Dedicated CSS for front page elements

### Customizing the Front Page

Edit `templates/layout/page--front.html.twig` to:
- Change hero title and subtitle
- Modify feature icons and descriptions
- Add or remove sections
- Adjust layout structure

Edit `css/front-page.css` to:
- Change colors and gradients
- Adjust spacing and typography
- Modify animations and hover effects
- Update responsive breakpoints

## Customization

- **Global Styles**: Edit `css/style.css` to modify the overall theme appearance
- **Front Page Styles**: Edit `css/front-page.css` for front page specific styling
- **Theme Functions**: Add custom preprocessing functions in `gg.theme`
- **Libraries**: Add additional CSS/JS libraries in `gg.libraries.yml`
- **Templates**: Create custom Twig templates in `templates/` directory

## File Structure

```
gg/
├── css/
│   ├── style.css          # Main stylesheet (all pages)
│   └── front-page.css     # Front page specific styles
├── templates/
│   └── layout/
│       ├── page.html.twig         # General page template
│       └── page--front.html.twig  # Front page template
├── gg.info.yml            # Theme configuration
├── gg.libraries.yml       # CSS/JS library definitions
├── gg.theme               # PHP preprocessing functions
├── logo.svg               # Theme logo
├── screenshot.png         # Theme screenshot
└── README.md              # This file
```

## Regions

The theme defines the following regions:
- Header
- Primary menu
- Secondary menu
- Page top
- Page bottom
- Highlighted
- Breadcrumb
- Content
- Sidebar first
- Sidebar second
- Footer

## Template Hierarchy

Drupal uses template suggestions to determine which template to use:

- `page--front.html.twig` - Used for the front page only
- `page.html.twig` - Used for all other pages
- Add more specific templates like `page--node--123.html.twig` for individual nodes

## Clearing Cache

After making template or configuration changes, always clear the cache:

```bash
# Using Drush
drush cr

# Or via admin UI
/admin/config/development/performance
```

