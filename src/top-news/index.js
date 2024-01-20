import { registerBlockType } from '@wordpress/blocks';
import {useInnerBlocksProps} from '@wordpress/block-editor';
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import metadata from './block.json';

registerBlockType( metadata.name, {
	/**
	 * @see ./edit.js
	 */
	edit: Edit,
	save: () => <section {...useInnerBlocksProps.save()} />,
} );
