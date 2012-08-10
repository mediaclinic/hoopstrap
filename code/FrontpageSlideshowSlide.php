<?php

 
class FrontpageSlideshowSlide extends DataObject {

	static $db = array(	
		"Heading" => "Text",
		"Subtitle" => "Text",
		"SlideContent" => "HTMLText",
		"ButtonText" => "Text",
		"SlideEffect" => "Enum('fade, slideDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse', 'fade')",
		"SlideTxtDisplay" => "Enum('On, Off', 'Off')",
		"SortID" => "Int",
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

	// to change the default sorting to the new SortID 
	public static $default_sort = 'SortID Asc'; 
	
	function onBeforeWrite() { 
		parent::onBeforeWrite(); 
		if (!$this->SortID) { 
		return $this->SortID = $this->getNextSortID(); 
		} 
	}

	public function getNextSortID() { 
		return $this->Slideshow()->SlideshowSlides()->Last()->SortID + 1; 
	}

	
	function getCMSFields() {

		// Settings for UploadFields : Main Image
		
		$f = new FieldList();
			
			$image_field = new UploadField('SlideImage', _t('Content.SLIDEIMAGE','Slide image'));
			$image_field->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
			$image_field->setFolderName('Uploads/SliderImages');

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