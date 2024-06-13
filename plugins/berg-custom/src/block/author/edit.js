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
const {useState} = wp.element;
const {useSelect} = wp.data;

const Edit = ( props ) => {

	const { attributes, setAttributes } = props;
	const { selectedTemplate, titleTag, prefix} = attributes;
	const innerElements = [];

	const setSelectedTemplate = (selectedTemplateVal) => {
		setAttributes({
			selectedTemplate: selectedTemplateVal,
		});
	};

	//set title tag
	const setTitleTag = (titleTagVal) => {
		setAttributes({
			titleTag: titleTagVal,
		});
	};

	const setPrefix = (prefixVal) => {
		setAttributes({
			prefix: prefixVal,
		});
	};

	if (selectedTemplate == "basic") {
		innerElements.push(
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
			</PanelRow>,
			<PanelRow>
				<TextControl
					label="Prefix"
					type="text"
					value={attributes.prefix}
					onChange={setPrefix}
				/>
			</PanelRow>,
		);
	}

	return [
		<InspectorControls>
            <PanelBody title={__("General Settings", "")}>
				<PanelRow>
					<SelectControl
						label="Template"
						value={attributes.selectedTemplate}
						options={[
							{ label: "Basic", value: "basic" },
							{ label: "Bio", value: "bio" },
						]}
						onChange={setSelectedTemplate}
					/>
				</PanelRow>
				{innerElements}
            </PanelBody>
        </InspectorControls>
		,
		<Disabled>
            <ServerSideRender block="e25m-custom/author" attributes={attributes}/>
        </Disabled>
	];
}

export default Edit;