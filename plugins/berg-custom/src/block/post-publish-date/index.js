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


export const name = 'e25m-custom/post-publish-date'

export const settings = {
	title: __( 'Post Publish Date', 'post-publish-date' ),
	description: __(
		'Fetches and displays the publish date of the current page or post.',
		'post-publish-date'
	),
	icon: 'calendar-alt',
	category: 'widgets',
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},

	attributes: {
		titleTag: {
			type: "string",
			default: "h1",
		},
		dateFormat:{
			type: "string",
			default: "M j, Y",
		},
	},

	edit: Edit,
	save:save,
}