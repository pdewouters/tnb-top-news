//import "./style.css";
import * as Ariakit from "@ariakit/react";
import TabList from './TabList';
import TabPanel from './TabPanel';
export default function App({tabsData}) {

	return (
		<div className="wrapper">
			{JSON.stringify(tabsData)}
		</div>
	);
}
