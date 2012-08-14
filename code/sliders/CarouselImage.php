<?php

 
class CarouselImage extends Page {

	static $singular_name = 'CarouselImage';
	static $plural_name = 'CarouselImages';
	static $description = 'Page type including an image of the image carousel.';

	static $db = array(	
		"Caption" => "HTMLText"
	); 
	
	public static $has_one = array(
		"CarouselImage" => "BetterImage"
	);
	

	
	function getCMSFields() {

		// Settings for UploadFields : Main Image

		$UploadField = new UploadField("CarouselImage", _t('Content.CarouselImage','Carousel image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads/CarouselImages');

		// Create Tabs

    	$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.CarouselImage', new HtmlEditorField("Caption", _t('Content.CAPTION','Caption')));
		$fields->addFieldToTab('Root.Main', $UploadField);
		$fields->removeFieldFromTab('Root.Main', 'Content');

	return $fields;
   }

// For CarouselHolder
	function RenderSlide() {
	   $class = $this->ClassName . "_Controller";
	   $controller = new $class($this);
	   return $controller->renderForCaroulselHolderPage();
	}
// holder
  
}
 
class CarouselImage_Controller extends Page_Controller {

// For CarouselHolder	
	public static $LayoutTemplate = 'CarouselImage';
	function renderForCarouselHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder
	
}
?>