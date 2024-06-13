/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import {
    Disabled,
	PanelBody,
	PanelRow,
	SelectControl,
	TextControl,
} from "@wordpress/components";
import {InspectorControls} from "@wordpress/block-editor";
import ServerSideRender from "@wordpress/server-side-render";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @param {Object} [props]           Properties passed from the editor.
 * @param {string} [props.className] Class name generated for the block.
 *
 * @return {WPElement} Element to render.
 */

const Edit = ( props ) => {

	const { attributes, setAttributes } = props;

	//set title tag
	const setTitleTag = (titleTagVal) => {
		setAttributes({
			titleTag: titleTagVal,
		});
	};
	//set past title value
	const setPastTitle = (pastTitleVal) => {
		setAttributes({
			pastTitle: pastTitleVal,
		});
	};

	return [
		<InspectorControls>
		<PanelRow>
			<TextControl
				label="Past webinar form title"
				type="text"
				value={attributes.pastTitle}
				onChange={setPastTitle}
			/>
		</PanelRow>
		<PanelRow>
			<SelectControl
				label="Title Tag"
				value={attributes.titleTag}
				options={[
					{ label: "h1", value: "h1" },
					{ label: "h2", value: "h2" },
					{ label: "h3", value: "h3" },
					{ label: "h4", value: "h4" },
					{ label: "h5", value: "h5" },
					{ label: "h6", value: "h6" },
					{ label: "p", value: "p" },
					{ label: "span", value: "span" },
				]}
			   onChange={setTitleTag}
			/>
		</PanelRow>
		</InspectorControls>,
		<Disabled>
            <ServerSideRender block="e25m-custom/webinar-page-heading" attributes={attributes} urlQueryArgs={{ 'isEditor': true }}/>
        </Disabled>
	];
}

export default Edit;
