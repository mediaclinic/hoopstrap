<?php

 
class FrontpageSlideshow extends Page {

    static $singular_name = 'Frontpage Slideshow';
    static $plural_name = 'Frontpage Slideshows';
    static $description = 'Frontpage slideshow pagetype for Nivoslider Animation on top.';
    static $icon = '';

	static $db = array(	
		"IntroductionTitle" => "Text",
		"IntroductionCol1" => "HTMLText",
		"IntroductionCol2" => "HTMLText",
		"Featured1Title" => "Text",
		"Featured2Title" => "Text",
		"Featured3Title" => "Text",
		"Featured4Title" => "Text",
		"Featured1" => "HTMLText",
		"Featured2" => "HTMLText",
		"Featured3" => "HTMLText",
		"Featured4" => "HTMLText",
		"Featured1Info" => "Text",
		"Featured2Info" => "Text",
		"Featured3Info" => "Text",
		"Featured4Info" => "Text",
		"SocialMediaInfo" => "Varchar(100)"
	); 
	
	public static $has_one = array(
		"SlideImage" => "Image",
		'Link1Loc' => 'SiteTree',
		'Link2Loc' => 'SiteTree',
		'Link3Loc' => 'SiteTree',
		'Link4Loc' => 'SiteTree',
		'Featured1Image' => 'BetterImage',
		'Featured2Image' => 'BetterImage',
		'Featured3Image' => 'BetterImage',
		'Featured4Image' => 'BetterImage',
		'Widgets' => 'WidgetArea'
	);
	
	public static $has_many = array(
		"FrontpageSlides" => "FrontpageSlideshowSlide"
	);
	
	function getCMSFields() {

		// Settings for UploadFields : #1 Featured Image

		$UploadField2 = new UploadField("Featured1Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField2->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField2->setFolderName('Uploads/Frontpage');

		// Settings for UploadFields : #2 Featured Image

		$UploadField3 = new UploadField("Featured2Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField3->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField3->setFolderName('Uploads/Frontpage');

		// Settings for UploadFields : #3 Featured Image

		$UploadField4 = new UploadField("Featured3Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField4->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField4->setFolderName('Uploads/Frontpage');

		// Settings for UploadFields : #4 Featured Image

		$UploadField5 = new UploadField("Featured4Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField5->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField5->setFolderName('Uploads/Frontpage');

		// Create Tabs

		$fields = parent::getCMSFields();

			// Slideshow Gridfield

			$gridFieldConfig = GridFieldConfig_RelationEditor::create();
			$gridFieldConfig->addComponents(
				new GridFieldSortableRows("SortOrder"),
				new FrontpageSlideshow_TogglePublish()
			);
	
			$gridField = new GridField("FrontpageSlides", "Slides:", $this->FrontpageSlides(), $gridFieldConfig);
			$fields->addFieldToTab("Root.FrontpageSlides", $gridField);
	
			$fields->removeFieldFromTab('Root.Main', 'Content');
	
			// Additional text for Frontpage
	
			$fields->addFieldToTab('Root.Introduction', new TextField("IntroductionTitle", _t('Content.INTRODUCTIONTITLE','Heading for introduction')));	
			$fields->addFieldToTab('Root.Introduction', new HtmlEditorField("IntroductionCol1", _t('Content.INTRODUCTIONCOLUMN1','Introduction text column 1')));
			$fields->addFieldToTab('Root.Introduction', new HtmlEditorField("IntroductionCol2", _t('Content.INTRODUCTIONCOLUMN2','Introduction text column 2')));
	
			// Featured Boxes under Slideshow
	
			$fields->addFieldToTab('Root.Featured1', new TextField("Featured1Title", _t('Content.FEATUREDTITLE','Featured title')));	
			$fields->addFieldToTab('Root.Featured1', new HtmlEditorField("Featured1", _t('Content.FEATURED','Featured')));
			$fields->addFieldToTab('Root.Featured1', $UploadField2);
			$fields->addFieldToTab('Root.Featured1', new TreeDropdownField('Link1LocID', 'Link 1 Location', 'SiteTree')); 
			$fields->addFieldToTab('Root.Featured1', new TextField("Featured1Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc. or read more)')));
	
			$fields->addFieldToTab('Root.Featured2', new TextField("Featured2Title", _t('Content.FEATUREDTITLE','Featured title')));	
			$fields->addFieldToTab('Root.Featured2', new HtmlEditorField("Featured2", _t('Content.FEATURED','Featured')));
			$fields->addFieldToTab('Root.Featured2', $UploadField3);
			$fields->addFieldToTab('Root.Featured2', new TreeDropdownField('Link2LocID', 'Link 2 Location', 'SiteTree'));
			$fields->addFieldToTab('Root.Featured2', new TextField("Featured2Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc. or read more)')));
	
			$fields->addFieldToTab('Root.Featured3', new TextField("Featured3Title", _t('Content.FEATUREDTITLE','Featured title')));
			$fields->addFieldToTab('Root.Featured3', new HtmlEditorField("Featured3", _t('Content.FEATURED','Featured')));
			$fields->addFieldToTab('Root.Featured2', $UploadField4);
			$fields->addFieldToTab('Root.Featured3', new TreeDropdownField('Link3LocID', 'Link 3 Location', 'SiteTree'));
			$fields->addFieldToTab('Root.Featured3', new TextField("Featured3Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc. or read more)')));
	
			$fields->addFieldToTab('Root.Featured4', new TextField("Featured4Title", _t('Content.FEATUREDTITLE','Featured title')));	
			$fields->addFieldToTab('Root.Featured4', new HtmlEditorField("Featured4", _t('Content.FEATURED','Featured')));	
			$fields->addFieldToTab('Root.Featured2', $UploadField5);
			$fields->addFieldToTab('Root.Featured4', new TreeDropdownField('Link4LocID', 'Link 4 Location', 'SiteTree'));
			$fields->addFieldToTab('Root.Featured4', new TextField("Featured4Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc. or read more)')));
				
			$fields->addFieldToTab('Root.SocialMedia', new TextField("SocialMediaInfo", _t('Content.SOCIALMEDIAINFO','What would you say to your visitors to get likes?')));	

		

	return $fields;
   }
  
}
 
class FrontpageSlideshow_Controller extends Page_Controller {

	public static $allowed_actions = array (
	);
	
	public function init() {
	  parent::init();
	}
	
}
?>