import { useBlockProps } from '@wordpress/block-editor';

import App from './components/App';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';


export default function Edit() {
	const blockProps = useBlockProps( { className: 'wrapper' } );
	const queryClient = new QueryClient();
	return (
		<div { ...blockProps }>
			<QueryClientProvider client={ queryClient }>
				<App />
			</QueryClientProvider>
		</div>
	);
}
