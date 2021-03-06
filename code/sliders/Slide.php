<?php

 
class Slide extends Page {

	static $singular_name = 'Slide';
	static $plural_name = 'Slides';
	static $description = 'Page type including a slide presented in the slideshow.';

	static $db = array(	
		"Subtitle" => "Text",
		"SlideContent" => "HTMLText",
		"SlideEffect" => "Enum('fade, slideDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse', 'fade')",
		"SlideTxtDisplay" => "Enum('On, Off', 'Off')"
	); 
	
	public static $has_one = array(
		"SlideImage" => "BetterImage"
	);
	

	
	function getCMSFields() {

		// Settings for UploadFields : Main Image

		$UploadField = new UploadField("SlideImage", _t('Content.SLIDEIMAGE','Slide image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads/CarouselImages');

		// Create Tabs

    	$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));
		$fields->addFieldToTab('Root.Main', new HtmlEditorField("SlideContent", _t('Content.SLIDECONTENT','Slide content')));

		$fields->addFieldToTab('Root.Main', $UploadField);

		$fields->addFieldToTab("Root.Main", new DropdownField('SlideEffect',_t('Content.SLIDEEFFECT','Choose an effect'), $this->dbObject('SlideEffect')->enumValues()));
		$fields->addFieldToTab("Root.Main", new DropdownField('SlideTxtDisplay',_t('Content.SLIDETXTDISPLAY','Do you want to display text over the slide image?'), $this->dbObject('SlideTxtDisplay')->enumValues()));
		$fields->removeFieldFromTab('Root.Main', 'Content');

	return $fields;
   }

// For SliderHolder
	function RenderSlide() {
	   $class = $this->ClassName . "_Controller";
	   $controller = new $class($this);
	   return $controller->renderForSlideHolderPage();
	}
// holder
  
}
 
class Slide_Controller extends Page_Controller {

// For SliderHolder	
	public static $LayoutTemplate = 'Slide';
	function renderForSlideHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder
	
}
?>