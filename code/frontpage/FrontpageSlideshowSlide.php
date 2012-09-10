<?php

 
class FrontpageSlideshowSlide extends DataObject {

	static $singular_name = 'FrontpageSlideshowSlide';
	static $plural_name = 'FrontpageSlideshowSlides';
	static $description = 'Frontpage slideshow for Nivoslider Animation on top.';

	static $db = array(
		"Heading" => "Text",
		"Subtitle" => "Text",
		"SlideContent" => "HTMLText",
		"ButtonText" => "Text",
		"SlideEffect" => "Enum('fade, slideDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse', 'fade')",
		"SlideTxtDisplay" => "Enum('On, Off', 'Off')",
		"SortOrder" => "Int",
		"Published" => "boolean"
	); 
	
	public static $has_one = array(
		"SlideImage" => "Image",
		"FrontpageSlideshow" => "FrontpageSlideshow",
		"ButtonLinkLoc" => "SiteTree"
	);

	// Fields to be displayed in GridField
	public static $summary_fields = array(
		'SlideImage.CMSThumbnail' => 'Image',
		'Heading' => 'Heading',
		'SlideContent' => 'SlideContent'
	);
	
	// Set default values
	public static $defaults = array(
		'Published' => '1'
	);

	// to change the default sorting to the new SortID 
	public static $default_sort = 'SortOrder Asc';

	// SiteTree behaviour
	static $can_be_root = false;
	static $default_parent = "FrontpageSlideshow";
	
	function getCMSFields() {

		// Settings for UploadFields : Main Image
		
		$f = new FieldList();
			
			$image_field = new UploadField('SlideImage', _t('Content.SLIDEIMAGE','Slide image'));
			$image_field->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
			$image_field->setFolderName('Uploads/sliderimages');

		// DropDown to select link from SiteTree

			$treedropdownfield = new TreeDropdownField('ButtonLinkLocID', 'Button link location', 'SiteTree');

		// Create Tabs
	
		$t = new TabSet(
			'Root',
			new Tab(
				'Main',
				new TextField("Heading", _t('Content.HEADING','Heading of Slide')),
				new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle of Slide')),
				new HTMLEditorField("SlideContent", _t('Content.CONTENT','HTML-content to slide')),
				new TextField("ButtonText", _t('Content.BUTTONTEXT','Button text')),
				$treedropdownfield,
				new DropdownField('SlideTxtDisplay', _t('Content.SLIDETXTDISPLAY','Enable Texts over slide'),singleton('FrontpageSlideshowSlide')->dbObject('SlideTxtDisplay')->enumValues()),
				new CheckboxField('Published', _t('Content.PUBLISHED','Is item published?'))
			),
			new Tab(
				'Image',
				$image_field
			),
			new Tab(
				'FX',
				new DropdownField('SlideEffect', _t('Content.SLIDEEFFECT','SlideEffect'),singleton('FrontpageSlideshowSlide')->dbObject('SlideEffect')->enumValues())
			)
			
		);
		
		$f->push($t);
		
		return $f;
	}
}

?>