# Careers Webflow Component

A standalone React component for displaying careers/job listings that integrates with the Greenhouse API. This component is designed to work both as a WordPress plugin and as a standalone component for Webflow or other platforms.

## Features

- **Three Component Types**:
  - **Main Listings**: Full job listings with filtering and pagination
  - **Featured Listings**: Priority/featured job positions
  - **Application Form**: Direct job application integration
- **Job Listings**: Display all available job positions from Greenhouse API
- **Filtering**: Filter jobs by location and department
- **Pagination**: Navigate through job listings with pagination
- **Responsive Design**: Mobile-friendly interface
- **Dark Mode Support**: Automatic dark mode detection
- **Standalone**: No WordPress dependencies required

## Installation

### As a WordPress Plugin

1. Upload the plugin to your WordPress site
2. Activate the plugin
3. The components will automatically render in the footer:
   - Main listings: `bl-careers-webflow-root`
   - Featured listings: `bl-careers-webflow-featured`
   - Application form: `bl-careers-webflow-apply`

### As a Standalone Component

1. Include React and ReactDOM in your HTML:
```html
<script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
```

2. Include the component files:
```html
<link rel="stylesheet" href="path/to/bl-careers-webflow.css">
<script src="path/to/bl-careers-webflow.js"></script>
```

3. Add container elements for the components you want to use:
```html
<!-- Main careers listings -->
<div id="bl-careers-webflow-root"></div>

<!-- Featured job listings -->
<div id="bl-careers-webflow-featured"></div>

<!-- Job application form -->
<div id="bl-careers-webflow-apply"></div>
```

4. Initialize the components:
```javascript
// Auto-initialization (if containers exist)
// Components will automatically initialize if they find their containers

// Manual initialization
BLCareersWebflow.init('main-container', 'main');        // Main listings
BLCareersWebflow.init('featured-container', 'featured'); // Featured listings
BLCareersWebflow.init('apply-container', 'apply');      // Application form
```

## API Integration

The component integrates with the Greenhouse API endpoint:
- **Departments**: `https://boards-api.greenhouse.io/v1/boards/boundlessimmigration/departments`

### Data Structure

The component expects job data in the following format:
```javascript
{
  id: "job_id",
  title: "Job Title",
  location: { name: "Location Name" },
  updated_at: "2024-01-01T00:00:00Z",
  metadata: [
    {
      name: "Featured Job Listing",
      value: true
    }
  ]
}
```

## Customization

### Styling

The component uses SCSS with BEM methodology. You can customize the appearance by modifying the `src/styles/careers.scss` file.

### Configuration

You can customize the component behavior by modifying the following:

- **Items per page**: Change the `perPage` constant in `CareersComponent.js`
- **API endpoints**: Modify the endpoint in `useCareersApi.js`
- **Location mapping**: Update the location regex patterns in `useCareersApi.js`

## Development

### Prerequisites

- Node.js (v14 or higher)
- npm or yarn

### Setup

1. Install dependencies:
```bash
npm install
```

2. Start development server:
```bash
npm run dev
```

3. Build for production:
```bash
npm run build
```

### Project Structure

```
src/
├── components/
│   ├── CareersComponent.js    # Main careers listings component
│   ├── FeaturedComponent.js   # Featured job listings component
│   ├── ApplyComponent.js      # Job application form component
│   ├── Filters.js             # Filter controls
│   ├── RolesList.js           # Job listings container
│   ├── RoleRow.js             # Individual job row
│   └── Pagination.js          # Pagination controls
├── hooks/
│   └── useCareersApi.js       # API integration hook
├── styles/
│   └── careers.scss           # Component styles
└── index.js                   # Entry point
```

## Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## License

GPL v2 or later

## Support

For support and questions, please contact the Traffic Team at Boundless.
