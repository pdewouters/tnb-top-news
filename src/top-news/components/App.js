import * as Ariakit from '@ariakit/react';

import CountryPanel from './CountryPanel';

const countries = {
	gb: 'United Kingdom',
	us: 'United States',
	fr: 'France',
	au: 'Australia',
	in: 'India',
};

export default function App() {
	const defaultSelectedId = 'default-selected-tab';
	return (
		<>
			<Ariakit.TabProvider defaultSelectedId={ defaultSelectedId }>
				<Ariakit.TabList className="tab-list" aria-label="Top News">
					{ Object.keys( countries ).map( ( countryCode, index ) => (
						<Ariakit.Tab
							key={ countryCode }
							id={ index === 0 ? defaultSelectedId : countryCode }
							className="tab"
						>
							{ countries[ countryCode ] }
						</Ariakit.Tab>
					) ) }
				</Ariakit.TabList>
				<div className="panels">
					{ Object.keys( countries ).map(
						( countryCode, panelIndex ) => (
							<CountryPanel
								key={ countryCode }
								countryCode={ countryCode }
								panelIndex={ panelIndex }
								defaultSelectedId={ defaultSelectedId }
							/>
						)
					) }
				</div>
			</Ariakit.TabProvider>
		</>
	);
}
