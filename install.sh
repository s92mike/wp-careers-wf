#!/bin/bash

# Careers Webflow Component Installation Script

echo "🚀 Installing Careers Webflow Component..."

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js 14 or higher first."
    echo "   Download from: https://nodejs.org/"
    exit 1
fi

# Check Node.js version
NODE_VERSION=$(node -v | cut -d'v' -f2 | cut -d'.' -f1)
if [ "$NODE_VERSION" -lt 14 ]; then
    echo "❌ Node.js version 14 or higher is required. Current version: $(node -v)"
    exit 1
fi

echo "✅ Node.js $(node -v) detected"

# Install dependencies
echo "📦 Installing dependencies..."
npm install

if [ $? -ne 0 ]; then
    echo "❌ Failed to install dependencies"
    exit 1
fi

echo "✅ Dependencies installed successfully"

# Build the component
echo "🔨 Building component..."
npm run build

if [ $? -ne 0 ]; then
    echo "❌ Build failed"
    exit 1
fi

echo "✅ Component built successfully"

# Check if build files exist
if [ ! -f "dist/fm-careers-webflow.js" ] || [ ! -f "dist/fm-careers-webflow.css" ]; then
    echo "❌ Build files not found. Build may have failed."
    exit 1
fi

echo ""
echo "🎉 Installation completed successfully!"
echo ""
echo "📁 Plugin files created:"
echo "   - fm-careers-webflow.php (WordPress plugin)"
echo "   - dist/fm-careers-webflow.js (Component JavaScript)"
echo "   - dist/fm-careers-webflow.css (Component styles)"
echo ""
echo "🔧 To use as a WordPress plugin:"
echo "   1. Activate the plugin in WordPress admin"
echo "   2. All three components will render in the footer:"
echo "      - Main listings: fm-careers-webflow-root"
echo "      - Featured listings: fm-careers-webflow-featured"
echo "      - Application form: fm-careers-webflow-apply"
echo ""
echo "🌐 To use as a standalone component:"
echo "   1. Include React and ReactDOM in your HTML"
echo "   2. Include the component CSS and JS files"
echo "   3. Add container elements for the components you want:"
echo "      - Main listings: fm-careers-webflow-root"
echo "      - Featured listings: fm-careers-webflow-featured"
echo "      - Application form: fm-careers-webflow-apply"
echo ""
echo "📖 See README.md for detailed usage instructions"
echo "🎯 Open demo.html in a browser to see all three components in action"
