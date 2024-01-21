import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import './editor.scss';
import * as Ariakit from '@ariakit/react';
import { useSelect } from '@wordpress/data';

import Article from './components/Article';

const countries = {
	gb: 'United Kingdom',
	us: 'United States',
	fr: 'France',
	au: 'Australia',
	in: 'India',
};
const TEMPLATE = [
	[ 'tnb/country-top-news', { countryCode: 'gb' } ],
	[ 'tnb/country-top-news', { countryCode: 'us' } ],
	[ 'tnb/country-top-news', { countryCode: 'fr' } ],
	[ 'tnb/country-top-news', { countryCode: 'au' } ],
	[ 'tnb/country-top-news', { countryCode: 'in' } ],
];
export default function Edit( { attributes, setAttributes, clientId } ) {
	const blockProps = useBlockProps( { className: 'wrapper' } );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'panels' },
		{
			allowedBlocks: [ 'tnb/country-top-news' ],
			template: TEMPLATE,
			renderAppender: false,
		}
	);
	const innerBlocks = useSelect(
		(select) => select('core/block-editor').getBlock(clientId).innerBlocks,
	);
console.log(innerBlocks);
	const defaultSelectedId = 'default-selected-tab';
	return (
		<div { ...blockProps }>
			<div { ...innerBlocksProps } />
			<Ariakit.TabProvider defaultSelectedId={ defaultSelectedId }>
				<Ariakit.TabList className="tab-list" aria-label="Top News">
					{ Object.keys( countries ).map( ( country, index ) => (
						<Ariakit.Tab
							key={ country }
							id={ index === 0 ? defaultSelectedId : country }
							className="tab"
						>
							{ countries[ country ] }
						</Ariakit.Tab>
					) ) }
				</Ariakit.TabList>
				<div className="panels">
					{innerBlocks.map(({attributes}, panelIndex) => {
						return (
							<Ariakit.TabPanel
								key={ attributes.countryCode }
								tabId={ panelIndex === 0 ? defaultSelectedId : attributes.countryCode }
							>
								<h3>
									Headlines for { countries[attributes.countryCode] }
								</h3>
								<ul>
									{ attributes.articles.map(
										( article, index ) => (
											<Article
												key={ `article-${ countries[attributes.countryCode] }-${ index }` }
												articleData={ article }
											/>
										)
									) }
								</ul>
							</Ariakit.TabPanel>
						)
					})}
				</div>
			</Ariakit.TabProvider>
		</div>
	);
}
