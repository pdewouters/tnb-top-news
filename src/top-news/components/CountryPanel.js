import * as Ariakit from '@ariakit/react';
import { useQuery } from '@tanstack/react-query';
import apiFetch from '@wordpress/api-fetch';
import PanelContent from './PanelContent';
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
			// eslint-disable-next-line no-console
			console.error( 'Error fetching data:', error );
		}
	};
	const { data, isPending, isError } = useQuery( {
		queryKey: [ `articles-${ countryCode }` ],
		queryFn: fetchCountryArticles,
	} );

	// eslint-disable-next-line no-nested-ternary
	const status = isPending ? 'loading' : isError ? 'error' : 'success';

	return (
		<Ariakit.TabPanel
			key={ countryCode }
			tabId={ panelIndex === 0 ? defaultSelectedId : countryCode }
		>
			<>
				<h2 className="tnb-top_news__country-title">
					{ sprintf(
						/** translators: %s: country name */
						__( 'Top news from %s', 'tnb-top-news' ),
						countries[ countryCode ]
					) }
				</h2>
				<PanelContent status={ status } articles={ data } />
			</>
		</Ariakit.TabPanel>
	);
}
