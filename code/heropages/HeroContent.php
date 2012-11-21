<?php

class HeroContent extends Page {

    static $singular_name = 'Hero Content page';
    static $plural_name = 'Hero Content pages';
    static $description = 'Hero page to be used as marketing page, for example inside Content Slider.';

	static $db = array(	
		"HeroButtonTxt" => "Text"
	); 
	
	public static $has_one = array(
		'HeroBackgroundImage' => 'BetterImage',
		'Link1Loc' => 'SiteTree',
		'MainImage' => 'BetterImage'
	);
	

	
	function getCMSFields() {

		// Settings for UploadFields : Hero Image

		$UploadField = new UploadField("HeroBackgroundImage", _t('Content.HEROBACKGROUNDIMAGE','Hero element background image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads/heroimages');
		
		// Settings for UploadFields : #1 MainImage

		$UploadField2 = new UploadField("MainImage", _t('Content.MAINIMAGE','Mainimage on hero over backgroundimage'));
		$UploadField2->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField2->setFolderName('Uploads/heroimages');

		// Create Tabs

    	$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField("HeroButtonTxt", _t('Content.HEROBUTTONTXT','Hero button text')));
		$fields->addFieldToTab('Root.Main', new TreeDropdownField('Link1LocID', 'Button Link', 'SiteTree'));

		$fields->addFieldToTab('Root.Images', $UploadField);
		$fields->addFieldToTab('Root.Images', $UploadField2);

	return $fields;
   }

// For LayoutHolder
	function RenderAsChild() {
	   $class = $this->ClassName . "_Controller";
	   $controller = new $class($this);
	   return $controller->renderForHolderPage();
	}
// holder
  
}
 
class HeroContent_Controller extends Page_Controller {

// For LayoutHolder	
	public static $LayoutTemplate = 'HeroContent';

	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder
	
}
?>