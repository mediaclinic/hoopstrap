<?php

 
class SlideshowSlide extends DataObject {

	static $singular_name = 'SlideshowSlide';
	static $plural_name = 'SlideshowSlides';
	static $description = 'Page type that wraps the slides of the slideshow together.';

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
		"Slideshow" => "Slideshow",
		"ButtonLinkLoc" => "SiteTree"
	);
		
	public static $summary_fields = array(
		'SlideImage.CMSThumbnail' => 'Image',
		'Heading' => 'Heading',
		'SlideContent' => 'SlideContent'
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
			
			$image_field = new UploadField('SlideImage', _t('Content.SLIDEIMAGE','Slide image'));
			$image_field->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
			$image_field->setFolderName('Uploads/SliderImages');

		// Create Tabs
	
		$t = new TabSet(
			'Root',
			new Tab(
				'Main',
				new TextField("Heading", _t('Content.HEADING','Heading of Slide')),
				new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle of Slide')),
				new HTMLEditorField("SlideContent", _t('Content.CONTENT','HTML-content to slide')),
				new TextField("ButtonText", _t('Content.BUTTONTEXT','Button text')),
				new TreeDropdownField('ButtonLinkLocID', 'Button link location', 'SiteTree'),
				new DropdownField('SlideTxtDisplay', _t('Content.SLIDETXTDISPLAY','Enable Texts over slide'),singleton('SlideshowSlide')->dbObject('SlideTxtDisplay')->enumValues()),
				new CheckboxField('Published', _t('Content.PUBLISHED','Is item published?'))
			),
			new Tab(
				'Image',
				$image_field
			),
			new Tab(
				'FX',
				new DropdownField('SlideEffect', _t('Content.SLIDEEFFECT','SlideEffect'),singleton('SlideshowSlide')->dbObject('SlideEffect')->enumValues())
			)
			
		);
		
		$f->push($t);
		
		return $f;
	}
}

?>