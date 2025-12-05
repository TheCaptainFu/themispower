#!/bin/bash

# Import All Configuration and Content
# Run this on your LIVE site after pulling latest code

set -e

echo "================================================"
echo "  Importing Configuration and Block Content"
echo "================================================"
echo ""

# Check if we're in the right directory
if [ ! -f "composer.json" ]; then
    echo "Error: Must run from project root directory"
    exit 1
fi

# Pull latest code
echo "1. Pulling latest code..."
git pull origin main
echo "✓ Code updated"
echo ""

# Import configuration
echo "2. Importing configuration..."
drush config:import -y
echo "✓ Configuration imported"
echo ""

# Import block content
echo "3. Importing block content..."
drush block-import
echo "✓ Block content imported"
echo ""

# Clear cache
echo "4. Clearing cache..."
drush cr
echo "✓ Cache cleared"
echo ""

# Update database
echo "5. Running database updates..."
drush updatedb -y
echo "✓ Database updated"
echo ""

echo "================================================"
echo "  Import Complete!"
echo "================================================"
echo ""
echo "Your blocks are now live!"
echo "Visit your site to verify the changes."
echo ""

