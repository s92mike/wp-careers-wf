import React from 'react';
import { createRoot } from 'react-dom/client';
import CareersComponent from './components/CareersComponent';
import FeaturedComponent from './components/FeaturedComponent';
import ApplyComponent from './components/ApplyComponent';
import './styles/careers.scss';

// Initialize the component when DOM is ready
document.addEventListener( 'DOMContentLoaded', () => {
	// Initialize main careers component
	const mainContainer = document.getElementById( 'bl-careers-webflow-root' );
	if ( mainContainer ) {
		const root = createRoot( mainContainer );
		root.render( <CareersComponent /> );
	}

	// Initialize featured component
	const featuredContainer = document.getElementById( 'bl-careers-webflow-featured' );
	if ( featuredContainer ) {
		const root = createRoot( featuredContainer );
		root.render( <FeaturedComponent /> );
	}

	// Initialize apply component
	const applyContainer = document.getElementById( 'bl-careers-webflow-apply' );
	if ( applyContainer ) {
		const root = createRoot( applyContainer );
		root.render( <ApplyComponent /> );
	}
} );

// Export for external use
window.BLCareersWebflow = {
	CareersComponent,
	FeaturedComponent,
	ApplyComponent,
	init: ( containerId, componentType = 'main' ) => {
		const container = document.getElementById( containerId );
		if ( container ) {
			const root = createRoot( container );
			let component;
			
			switch ( componentType ) {
				case 'featured':
					component = <FeaturedComponent />;
					break;
				case 'apply':
					component = <ApplyComponent />;
					break;
				default:
					component = <CareersComponent />;
			}
			
			root.render( component );
		}
	},
};
