import * as Ariakit from '@ariakit/react';

import Article from './Article';

export default function App( { tabsData } ) {
	const defaultSelectedId = 'default-selected-tab';
	return (
		<>
			<Ariakit.TabProvider defaultSelectedId={ defaultSelectedId }>
				<Ariakit.TabList className="tab-list" aria-label="Top News">
					{ Object.keys( tabsData ).map( ( tab, index ) => (
						<Ariakit.Tab
							key={ tab }
							id={ index === 0 ? defaultSelectedId : tab }
							className="tab"
						>
							{ tabsData[ tab ].countryName }
						</Ariakit.Tab>
					) ) }
				</Ariakit.TabList>
				<div className="panels">
					{ Object.keys( tabsData ).map( ( tab, panelIndex ) => (
						<Ariakit.TabPanel
							key={ tab }
							tabId={ panelIndex === 0 ? defaultSelectedId : tab }
						>
							<h3 className='tnb-top_news__heading'>
								Headlines for { tabsData[ tab ].countryName }
							</h3>
							<ul className='tnb-top_news__article-list'>
								{ tabsData[ tab ].articles.map(
									( article, index ) => (
										<Article
											key={ `article-${ tabsData[ tab ].countryName }-${ index }` }
											articleData={ article }
										/>
									)
								) }
							</ul>
						</Ariakit.TabPanel>
					) ) }
				</div>
			</Ariakit.TabProvider>
		</>
	);
}
