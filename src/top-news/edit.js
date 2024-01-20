import {useBlockProps, useInnerBlocksProps} from '@wordpress/block-editor';
import './editor.scss';

const TEMPLATE = [
	['core/heading', {placeholder: 'Add Title', level: 2}],
	['tnb/country-top-news', {country: 'uk'}],
	['tnb/country-top-news', {country: 'us'}],
	['tnb/country-top-news', {country: 'fr'}],
	['tnb/country-top-news', {country: 'au'}],
	['tnb/country-top-news', {country: 'in'}],
];
export default function Edit() {
	const blockProps = useBlockProps( { className: 'my-class' } );
	const innerBlocksProps = useInnerBlocksProps(
		blockProps,
		{ allowedBlocks: [ 'tnb/country-top-news' ], template: TEMPLATE }
	);
	return (
		<section {...innerBlocksProps} />
	);
}
