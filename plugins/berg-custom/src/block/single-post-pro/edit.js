/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
//import './editor.scss';
import {__} from "@wordpress/i18n";
import {withSelect} from "@wordpress/data";
import {compose, withState} from "@wordpress/compose";
import {InspectorControls} from "@wordpress/block-editor";
import {
	Disabled,
	PanelBody,
	RadioControl,
	SelectControl,
	TextControl,
	ColorPicker,
} from "@wordpress/components";
import ServerSideRender from "@wordpress/server-side-render";
import Select from "react-select";
import SelectAsync from "react-select/async";
import {unstable_batchedUpdates} from "react-dom";
import {coreComponents, coreComponentsTheme} from "../../componentClasses";

const {useEffect, useState} = wp.element;

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

const Edit = (props) => {
	const {attributes, setAttributes, postTypes, taxonomies} = props;
	const {
		selectedPostType,
		selectedPost,
		imageAppearance,
		anchorAppearance,
		dateFormat,
		displayOrder,
		titleTag,
		singlePostClass,
		singlePostClassNames,
		popupDisplayOrder,
		backgroundColor
	} = attributes;

	const [postSelectIsLoading, setPostSelectIsLoading] = useState(false);
	const [posts, setPosts] = useState([]);
	const unwantedPostTypes = ["Media", "Blocks"];

	// filter post types and make post list array to use on post type dropdown
	const filteredPostTypes = _.filter(postTypes, (type) => {
		return !unwantedPostTypes.includes(type.name);
	}).map((type) => {
		return {value: type.slug, label: type.name};
	});

	// decodes unicode decimals(ex: &#8216 -> ')
	const decodeUnicodes = (encodedText) => {
		let textArea = document.createElement("textarea");
		textArea.innerHTML = encodedText;
		return textArea.innerText;
	};

	// To decode already saved values
	if (
		typeof selectedPost === "object" &&
		typeof selectedPost.label === "string"
	) {
		selectedPost.label = decodeUnicodes(selectedPost.label);
	}

	// create post type related taxonomies list
	const taxonomyList = _.map(taxonomies, (taxonomy) => {
		let taxonomyName = taxonomy.labels.singular_name;
		let taxonomySlug = taxonomy.slug;
		let postType = taxonomy.types[0].toString();
		return {postType: postType, value: taxonomySlug, label: taxonomyName};
	});

	// filter taxonomies according to the selected post type
	const filteredTaxonomyList = _.filter(taxonomyList, (taxonomy) => {
		return taxonomy.postType === selectedPostType;
	}).map((taxonomy) => {
		return {value: "taxonomy_" + taxonomy.value, label: taxonomy.label};
	});

	let defaultDisplayOrder = [
		{value: "image", label: "Image"},
		{value: "title", label: "Title"},
		{value: "content", label: "Content"},
		{value: "excerpt", label: "Excerpt"},
		{value: "date", label: "Date"},
		{value: "author", label: "Author Name"},
		{value: "more", label: "Read more"},
		{value: "featured_image", label: "Featured image"},
		{value: "event_date", label: "Event Date [start date - End date]"},
		{value: "post_type", label: "Post Type Name"},
		...filteredTaxonomyList,
	];

	let defaultPopupDisplayOrder = [
		{value: "image", label: "Image"},
		{value: "title", label: "Title"},
		{value: "content", label: "Content"},
		{value: "excerpt", label: "Excerpt"},
		{value: "date", label: "Date"},
		{value: "author", label: "Author Name"},
		{value: "featured_image", label: "Featured image"},
		{value: "event_date", label: "Event Date [start date - End date]"},
		{value: "post_type", label: "Post Type Name"},
		...filteredTaxonomyList,
	];

	//Post type dropdown onchange function
	const onChangePostType = (newVal) => {
		setAttributes({selectedPostType: newVal});
		setAttributes({selectedPost: ""});
		getPosts("", null, newVal);
	};

	//Post dropdown onchange function
	const onChangePosts = (newVal) => {
		setAttributes({selectedPost: newVal});
	};

	//Image Appearance radio button onselect function
	const onSelectImageAppearance = (newVal) => {
		setAttributes({imageAppearance: newVal});
	};

	//Anchor Element Appearance radio button onselect function
	const onSelectAnchorAppearance = (newVal) => {
		setAttributes({anchorAppearance: newVal});
	};

	//Date format on change function
	const onChangeDateFormat = (newVal) => {
		setAttributes({dateFormat: newVal});
	};

	const onChangeTitleTag = (newVal) => {
		setAttributes({titleTag: newVal});
	};

	const onChangeDisplayOrder = (newVal) => {
		setAttributes({displayOrder: newVal});
	};

	const onChangePopupDisplayOrder = (newVal) => {
		setAttributes({popupDisplayOrder: newVal});
	};

	const onChangeBackgroundColor = (newVal) => {
		setAttributes({backgroundColor: newVal.hex});
	};

	//Setting section classes in a state
	const [singlePostClasses, setsinglePostClasses] = useState([]);
	const [defaultClassValues, setDefaultClassValues] = useState([]);

	useEffect(() => {
		if (
			coreComponents["bs-single-post"] &&
			coreComponents["bs-single-post"].length > 0
		) {
			singlePostClasses.push({
				value: `${coreComponents["bs-single-post"]}`,
				label: "Default",
			});
		} else {
			singlePostClasses.push({
				value: "",
				label: "Select Class",
			});
		}

		if (
			coreComponentsTheme["bs-single-post"] &&
			coreComponentsTheme["bs-single-post"].length > 0
		) {
			coreComponentsTheme["bs-single-post"].map((className, index) => {
				let classLabel = className.replace("bs-single-post--", "").split("-");
				classLabel.map((word, index) => {
					classLabel[index] = word[0].toUpperCase() + word.slice(1);
				});
				singlePostClasses.push({
					value: className,
					label: classLabel.join(" "),
				});
			});
		}
		const defaultValues = singlePostClassNames
			? singlePostClassNames
			: [singlePostClasses[0]];

		setDefaultClassValues(defaultValues);
	}, []);

	// Load posts data
	let getPostsTimeout = null;
	const getPosts = (searchQuery = "", callback = null, postType) => {
		if (getPostsTimeout != null) clearTimeout(getPostsTimeout);
		getPostsTimeout = setTimeout(() => {
			if (typeof postType === "undefined" || typeof postType !== "string") {
				postType = selectedPostType;
			}
			setPostSelectIsLoading(true);
			const query = {
				per_page: 100,
				order: "asc",
				orderby: "title",
				status: "publish",
				search: searchQuery,
				searchBy: "post_title",
			};
			const getData = () =>
				wp.data.select("core").getEntityRecords("postType", postType, query);
			const setPostsData = (postList) => {
				const postsOptions = postList.map((post) => ({
					value: post.id,
					label: decodeUnicodes(post.title.rendered),
				}));
				unstable_batchedUpdates(() => {
					setPostSelectIsLoading(false);
					setPosts(postsOptions);
				});
				if (typeof callback === "function") {
					callback(postsOptions);
				}
			};
			// Request posts data
			let postList = getData();
			// If cached data available return or monitor until request resolved
			if (postList && Array.isArray(postList)) {
				setPostsData(postList);
			} else {
				const unsubscribe = wp.data.subscribe(() => {
					const resolved =
						!wp.data
							.select("core")
							.isResolving("getEntityRecords", ["postType", postType, query]) &&
						wp.data
							.select("core")
							.hasFinishedResolution("getEntityRecords", [
								"postType",
								postType,
								query,
							]);
					if (resolved) {
						postList = getData();
						if (postList && Array.isArray(postList)) {
							unsubscribe();
							setPostsData(postList);
						}
					}
				});
			}
		}, 700);
	};

	return [
		<div>
			<InspectorControls>
				<PanelBody title={__("Post Settings", "berg")} initialOpen={true}>
					<SelectControl
						label={__("Post Type", "berg")}
						help={__("Select a post type", "berg")}
						options={filteredPostTypes}
						value={selectedPostType}
						onChange={onChangePostType}
					/>

					<label>{__("Posts", "berg")}</label>
					<SelectAsync
						name="post-list"
						label={__("Post", "berg")}
						help={__("Select a post", "berg")}
						value={selectedPost}
						defaultOptions={posts.length > 0 ? posts : true}
						loadOptions={getPosts}
						isLoading={postSelectIsLoading}
						onChange={onChangePosts}
						onMenuOpen={() => getPosts()}
					/>

					<SelectControl
						label={__("Title Tag", "berg")}
						value={titleTag}
						options={[
							{label: "h1", value: "h1"},
							{label: "h2", value: "h2"},
							{label: "h3", value: "h3"},
							{label: "h4", value: "h4"},
							{label: "h5", value: "h5"},
							{label: "h6", value: "h6"},
							{label: "p", value: "p"},
						]}
						onChange={onChangeTitleTag}
					/>

					<RadioControl
						label={__("Image Appearance", "berg")}
						options={[
							{label: "Image", value: "image"},
							{label: "Background", value: "background"},
						]}
						selected={imageAppearance}
						onChange={onSelectImageAppearance}
					/>

					<RadioControl
						label={__("Anchor Element Appearance", "berg")}
						options={[
							{label: "Wrap All", value: "full"},
							{label: "Inner Link", value: "inner"},
						]}
						selected={anchorAppearance}
						onChange={onSelectAnchorAppearance}
					/>

					<TextControl
						label={__("Post Date format", "berg")}
						help={__(
							"For more info: https://wordpress.org/support/article/formatting-date-and-time/",
							"berg"
						)}
						value={dateFormat}
						onChange={onChangeDateFormat}
					/>

					<label>{__("Display Order", "berg")}</label>
					<Select
						name="display-order"
						value={displayOrder}
						onChange={onChangeDisplayOrder}
						options={defaultDisplayOrder}
						isMulti="true"
					/>

					<label>{__("Popup Display Order", "berg")}</label>
					<Select
						name="display-order"
						value={popupDisplayOrder}
						onChange={onChangePopupDisplayOrder}
						options={defaultPopupDisplayOrder}
						isMulti="true"
					/>

					<label>{__("Background Color", "berg")}</label>
					<ColorPicker
						color={backgroundColor}
						onChangeComplete={onChangeBackgroundColor}
						disableAlpha
					/>
				</PanelBody>

				<PanelBody
					title={__("Single Post Block Class", "")}
					initialOpen={false}
				>
					<Select
						defaultValue={defaultClassValues}
						isMulti
						name="singlePostClasses"
						options={singlePostClasses}
						className="basic-multi-select"
						classNamePrefix="select"
						onChange={(val) => {
							setAttributes({
								singlePostClassNames: val,
							});
							//props.setAttributes({ sectionClass: val });
						}}
					/>
				</PanelBody>
			</InspectorControls>
		</div>,
		<Disabled>
			<ServerSideRender block="e25m-custom/single-post-pro" attributes={attributes}/>
		</Disabled>,
	];
};

const applyWithSelect = withSelect((select, props) => {
	let selectCore = select("core");
	//Get all post types
	let postTypes = selectCore.getPostTypes({per_page: -1});

	let taxonomies = selectCore.getTaxonomies({per_page: -1, public: true});

	return {
		postTypes: postTypes,
		taxonomies: taxonomies,
	};
});

export default compose(applyWithSelect)(Edit);
