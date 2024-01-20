import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit({attributes, setAttributes}) {
	const { countryCode } = attributes;
	return (
		<p { ...useBlockProps() }>
			{ `${countryCode}` }
		</p>
	);
}
