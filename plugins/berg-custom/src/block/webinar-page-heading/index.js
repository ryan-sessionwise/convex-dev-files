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


export const name = 'e25m-custom/webinar-page-heading'

export const settings = {
	title: __( 'Webinar Page Heading', 'webinar-page-heading' ),
	description: __(
		'Add dynamic heading according to the webinar status.',
		'post-category'
	),
	icon: 'heading',
	category: 'widgets',
	attributes: {
		pastTitle: {
			type: "string",
			default: "Watch On-Demand"
		},
		titleTag: {
			type: "string",
			default: "h4",
		},
	},
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},

	edit: Edit,
	save:save,
}
