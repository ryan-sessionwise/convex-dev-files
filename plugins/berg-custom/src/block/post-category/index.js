/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
//import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';


export const name = 'e25m-custom/post-category'

export const settings = {
	title: __( 'Post Category', 'post-category' ),
	description: __(
		'Fetches and displays the category of the current page or post.',
		'post-category'
	),
	icon: 'tag',
	category: 'widgets',
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},

	edit: Edit,
	save:save,
}
