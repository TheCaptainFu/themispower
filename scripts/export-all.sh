#!/bin/bash

# Export All Configuration and Content
# Run this on your DEVELOPMENT site before deploying to live

set -e

echo "================================================"
echo "  Exporting Configuration and Block Content"
echo "================================================"
echo ""

# Export configuration
echo "1. Exporting configuration..."
drush config:export -y
echo "✓ Configuration exported to config/sync/"
echo ""

# Export block content
echo "2. Exporting block content..."
drush block-export
echo "✓ Block content exported to content/blocks/"
echo ""

# Show what was exported
echo "================================================"
echo "  Export Complete!"
echo "================================================"
echo ""
echo "Files ready to commit:"
echo "  - config/sync/     (block configurations)"
echo "  - content/blocks/  (block content)"
echo ""
echo "Next steps:"
echo "  1. Review changes: git status"
echo "  2. Commit: git add . && git commit -m 'Export blocks'"
echo "  3. Push: git push origin main"
echo "  4. On live site: Run ./scripts/import-all.sh"
echo ""

