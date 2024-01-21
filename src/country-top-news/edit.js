import { useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

const Edit = ( { attributes, setAttributes } ) => {
	const { countryCode } = attributes;

	async function fetchData() {
		try {
			const response = await apiFetch( {
				method: 'POST',
				path: `/tnb-top-news/v1/top-headlines/${ countryCode }`,
				data: {},
			} );
			setAttributes( { articles: response.data } );
		} catch ( error ) {
			console.error( 'Error fetching data:', error );
		}
	}

	useEffect( () => {
		fetchData();
	}, [] );

	return '';
};

export default Edit;
