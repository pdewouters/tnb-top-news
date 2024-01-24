import domReady from '@wordpress/dom-ready';
import { createRoot, StrictMode } from '@wordpress/element';
import { QueryClient } from '@tanstack/react-query';
import { PersistQueryClientProvider } from '@tanstack/react-query-persist-client';
import { createSyncStoragePersister } from '@tanstack/query-sync-storage-persister';
import App from './components/App';
domReady( () => {
	const rootElement = document.getElementById( 'tnb-top-news-app' );

	if ( rootElement ) {
		const queryClient = new QueryClient( {
			defaultOptions: {
				queries: {
					gcTime: 24 * 60 * 60 * 1000,
					staleTime: 2 * 60 * 1000,
				},
			},
		} );
		const persister = createSyncStoragePersister( {
			storage: window.localStorage,
		} );
		createRoot( rootElement ).render(
			<StrictMode>
				<PersistQueryClientProvider
					client={ queryClient }
					persistOptions={ { persister } }
				>
					<App />
				</PersistQueryClientProvider>
				,
			</StrictMode>
		);
	}
} );
