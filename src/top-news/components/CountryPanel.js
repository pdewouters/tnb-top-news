import Article from './Article';
import * as Ariakit from '@ariakit/react';
import { useQuery } from '@tanstack/react-query';
import apiFetch from '@wordpress/api-fetch';
import { __, sprintf } from '@wordpress/i18n';

const countries = {
	gb: 'United Kingdom',
	us: 'United States',
	fr: 'France',
	au: 'Australia',
	in: 'India',
};

export default function CountryPanel( {
	countryCode,
	panelIndex,
	defaultSelectedId,
} ) {
	const fetchCountryArticles = async () => {
		try {
			const response = await apiFetch( {
				method: 'POST',
				path: `/tnb-top-news/v1/top-headlines/${ countryCode }`,
				data: {},
			} );
			return response.data;
		} catch ( error ) {
			console.error( 'Error fetching data:', error );
		}
	};
	const { data, isPending, isError } = useQuery( {
		queryKey: [ `articles-${ countryCode }` ],
		queryFn: fetchCountryArticles,
	} );

	if ( isPending ) return <div>Loading...</div>;
	if ( isError ) return <div>An error occurred</div>;
	return (
		<Ariakit.TabPanel
			key={ countryCode }
			tabId={ panelIndex === 0 ? defaultSelectedId : countryCode }
		>
			<h3 className="tnb-top_news__heading">
				{ sprintf(
					/* translators: %s: country name */
					__( 'Headlines for %s', 'tnb-top-news' ),
					countries[ countryCode ]
				) }
			</h3>
			<ul className="tnb-top_news__article-list">
				{ data.map( ( article, index ) => (
					<Article
						key={ `article-${ countries[ countryCode ] }-${ index }` }
						articleData={ article }
					/>
				) ) }
			</ul>
		</Ariakit.TabPanel>
	);
}
