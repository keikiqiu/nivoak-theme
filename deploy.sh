#!/bin/bash
# Nivoak Theme Deployment Script
# Downloads theme files from GitHub and deploys to WordPress

set -e

THEME_DIR="/www/wwwroot/nivoak.com/wp-content/themes/nivoak-theme"
MU_DIR="/www/wwwroot/nivoak.com/wp-content/mu-plugins"
TMP_DIR="/tmp/nivoak-deploy"

echo "=== Nivoak Theme Deployment ==="

# Clean up
rm -rf $TMP_DIR

# Clone from GitHub
echo "[1/4] Downloading from GitHub..."
git clone --depth 1 https://github.com/nivoak-dev/nivoak-theme.git $TMP_DIR/nivoak-theme 2>&1 || {
  echo "Git clone failed, trying wget..."
  wget -q -O $TMP_DIR/theme.zip https://github.com/nivoak-dev/nivoak-theme/archive/refs/heads/main.zip 2>&1 || {
    echo "FATAL: Cannot download from GitHub"
    exit 1
  }
  cd $TMP_DIR
  unzip -q theme.zip
  mv nivoak-theme-main nivoak-theme
}

# Backup current theme
echo "[2/4] Backing up current theme..."
if [ -d "$THEME_DIR.bak" ]; then rm -rf "$THEME_DIR.bak"; fi
cp -r $THEME_DIR "$THEME_DIR.bak" 2>/dev/null || true

# Deploy theme files
echo "[3/4] Deploying theme files..."
cp $TMP_DIR/nivoak-theme/style.css $THEME_DIR/style.css
cp $TMP_DIR/nivoak-theme/functions.php $THEME_DIR/functions.php
cp $TMP_DIR/nivoak-theme/header.php $THEME_DIR/header.php
cp $TMP_DIR/nivoak-theme/footer.php $THEME_DIR/footer.php
cp $TMP_DIR/nivoak-theme/index.php $THEME_DIR/index.php
cp $TMP_DIR/nivoak-theme/page.php $THEME_DIR/page.php
cp $TMP_DIR/nivoak-theme/single.php $THEME_DIR/single.php

# Deploy mu-plugin
echo "[4/4] Deploying mu-plugin..."
mkdir -p $MU_DIR
cp $TMP_DIR/nivoak-theme/mu-plugins/nivoak-fix.php $MU_DIR/nivoak-fix.php

# Fix permissions
chown -R www:www $THEME_DIR
chown -R www:www $MU_DIR
chmod 644 $THEME_DIR/*.php $THEME_DIR/*.css
chmod 644 $MU_DIR/*.php

# Clean up
rm -rf $TMP_DIR

echo "=== Deployment Complete! ==="
echo "Theme version: 2.1.0"
echo "Files deployed:"
ls -la $THEME_DIR/*.php $THEME_DIR/*.css
echo ""
echo "Mu-plugin:"
ls -la $MU_DIR/nivoak-fix.php
