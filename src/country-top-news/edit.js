import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import * as Ariakit from '@ariakit/react';
import Article from '../top-news/components/Article';

const Edit = ( { attributes, setAttributes } ) => {
	const { countryCode, articles } = attributes;
	const [ isLoading, setIsLoading ] = useState( false );

	async function fetchData() {
		setIsLoading( true );
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
		setIsLoading( false );
	}

	useEffect( () => {
		fetchData();
	}, [] );

	return '';
};

export default Edit;
