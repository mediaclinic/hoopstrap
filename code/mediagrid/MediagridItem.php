<?php

 
class MediagridItem extends DataObject {

	static $singular_name = 'MediagridItem';
	static $plural_name = 'MediagridItems';
	static $description = 'Page type that wraps the slides of the slideshow together.';

	static $db = array(	
		"Heading" => "Text",
		"Subtitle" => "Text",
		"Name" => "Text",
		"ItemDescription" => "HTMLText",
		"Category" => "Enum('Category1, Category2, Category3', 'Category1')",
		"ItemSort" => "Enum('Sort1, Sort2, Sort3', 'Sort1')",
		"Span" => "Enum('span1, span2, span3, span4, span6', 'span3')",
		"ButtonText" => "Text",
		"SortOrder" => "Int",
		"Published" => "boolean"
	); 
	
	public static $has_one = array(
		"Image" => "Image",
		"Mediagrid" => "Mediagrid",
		"ButtonLinkLoc" => "SiteTree"
	);
		
	public static $summary_fields = array(
		'Image.CMSThumbnail' => 'Image',
		'Heading' => 'Heading',
		'Subtitle' => 'Subtitle',
		'ItemDescription' => 'ItemDescription'
	);

	// to change the default sorting to the new SortOrder 
	public static $default_sort = 'SortOrder Asc'; 

	// Set default values
	public static $defaults = array(
		'Published' => 1
	);
	
	function getCMSFields() {

		// Settings for UploadFields : Main Image
		
		$f = new FieldList();
			
			$image_field = new UploadField('Image', _t('Content.IMAGE','Mediagrid item image'));
			$image_field->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
			$image_field->setFolderName('Uploads/mediagrid');

		// Create Tabs
	
		$t = new TabSet(
			'Root',
			new Tab(
				'Main',
				new TextField("Heading", _t('Content.HEADING','Heading of Slide')),
				new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle of Slide')),
				new HTMLEditorField("ItemDescription", _t('Content.CONTENT','HTML-content to slide')),
				new TextField("ButtonText", _t('Content.BUTTONTEXT','Button text')),
				new TreeDropdownField('ButtonLinkLocID', 'Button link location', 'SiteTree'),
				new CheckboxField('Published', _t('Content.PUBLISHED','Is item published?'))
			),
			new Tab(
				'Image',
				$image_field
			),
			new Tab(
				'Sorting and options',
				new DropdownField('Category', _t('Content.Category','Category'),singleton('MediagridItem')->dbObject('Category')->enumValues()),
				new DropdownField('ItemSort', _t('Content.ITEMSORT','ItemSort'),singleton('MediagridItem')->dbObject('ItemSort')->enumValues()),
				new DropdownField('Span', _t('Content.SPAN','Span'),singleton('MediagridItem')->dbObject('Span')->enumValues())
			)
			
		);
		
		$f->push($t);
		
		return $f;
	}
}

?>