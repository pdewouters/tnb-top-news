import domReady from '@wordpress/dom-ready';
import { createRoot, StrictMode } from '@wordpress/element';

import App from './components/App';
domReady( () => {
	if ( typeof tnbTopNewsAppData === 'undefined' ) {
		return;
	}
	const rootElement = document.getElementById( 'tnb-top-news-app' );

	if ( rootElement ) {
		createRoot( rootElement ).render(
			<StrictMode>
				<App tabsData={ tnbTopNewsAppData } />
			</StrictMode>
		);
	}
} );
