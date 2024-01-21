import * as Ariakit from '@ariakit/react';

export default function TabPanel({key,articles}) {
	return (
		<Ariakit.TabPanel>
			<ul>
				<li>🍎 Apple</li>
				<li>🍇 Grape</li>
				<li>🍊 Orange</li>
			</ul>
		</Ariakit.TabPanel>
	);
}
