/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import {__} from '@wordpress/i18n';
import icons from "./images/icons";


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


export const name = 'e25m-custom/single-post-pro'

export const settings = {
	title: __('Single Post Pro', 'single-post-pro'),
	description: __(
		'Example block written with ESNext standard and JSX support – build step required.',
		'single-post-pro'
	),
	icon: icons.singlePostBlock,
	category: 'widgets',
	attributes: {
		selectedPostType: {
			type: 'text',
			default: 'post'
		},
		selectedPost: {
			type: 'object',
			default: ''
		},
		imageAppearance: {
			type: 'text',
			default: 'image'
		},
		anchorAppearance: {
			type: 'text',
			default: 'full'
		},
		dateFormat: {
			type: 'string',
			default: 'd-m-Y'
		},
		displayOrder: {
			type: 'array',
			default: [{value:"title",label:"Title"}]
		},
		popupDisplayOrder: {
			type: 'array',
			default: [{value:"title",label:"Title"}]
		},
		titleTag: {
			type: 'string',
			default: 'h5'
		},
		singlePostClass: {
			type: "string",
			default: "",
		},
		singlePostClassNames: {
			type: "array",
			default: [{value: "bs-single-post---default", label: "Default"}],
		},
		backgroundColor: {
			type: 'string',
			default: '#ffffff'
		}
	},
	supports: {
		// Removes support for an HTML mode.
		html: false,
	},
	edit: Edit,
	save: save,
}
