import * as Ariakit from '@ariakit/react';

export default function TabList( {tabData} ) {
	console.log(tabData);
	return (
		<Ariakit.TabList className="tab-list" aria-label="Groceries">
			{Object.keys(tabData).map((tab) => (
				<Ariakit.Tab
					key={tab.countryName}
					id={'sdfsd'}
					className="tab"
				>
					{tabData[tab].title}
				</Ariakit.Tab>
			)
			)}
		</Ariakit.TabList>
	);
}
