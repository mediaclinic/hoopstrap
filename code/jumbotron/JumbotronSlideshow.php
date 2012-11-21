<?php

 
class JumbotronSlideshow extends Page {

    static $singular_name = 'Jumbotron Slideshow';
    static $plural_name = 'Jumbotron Slideshows';
    static $description = 'Jumbotron slideshow pagetype for Nivoslider Animation on top.';
    static $icon = '';

	static $db = array(	
		"IntroductionTxt" => "Text",
		"IntroductionCol1" => "HTMLText",
		"IntroductionCol2" => "HTMLText",
		"IntroductionCol3" => "HTMLText",
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
		'JumbotronBackground' => 'BetterImage',
		"SlideImage" => "Image",
		'Link1Loc' => 'SiteTree',
		'Link2Loc' => 'SiteTree',
		'Link3Loc' => 'SiteTree',
		'Link4Loc' => 'SiteTree',
		'Featured1Image' => 'BetterImage',
		'Featured2Image' => 'BetterImage',
		'Featured3Image' => 'BetterImage',
		'Featured4Image' => 'BetterImage'
	);
	
	public static $has_many = array(
		"JumbotronSlides" => "JumbotronSlideshowSlide"
	);
	
	function getCMSFields() {

		// Settings for UploadFields : Jumbotron Background

		$UploadField = new UploadField("JumbotronBackground", _t('Content.JUMBOTRONBACKGROUND','Jumbotron background image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads/jumbotron');

		// Settings for UploadFields : #1 Featured Image

		$UploadField2 = new UploadField("Featured1Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField2->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField2->setFolderName('Uploads/featuredimages');

		// Settings for UploadFields : #2 Featured Image

		$UploadField3 = new UploadField("Featured2Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField3->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField3->setFolderName('Uploads/featuredimages');

		// Settings for UploadFields : #3 Featured Image

		$UploadField4 = new UploadField("Featured3Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField4->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField4->setFolderName('Uploads/featuredimages');

		// Settings for UploadFields : #4 Featured Image

		$UploadField5 = new UploadField("Featured4Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'));
		$UploadField5->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField5->setFolderName('Uploads/featuredimages');

		// Create Tabs

		$fields = parent::getCMSFields();

		
			// Slideshow Gridfield
		
			$gridFieldConfig = GridFieldConfig::create()->addComponents(
				new GridFieldToolbarHeader(),
				new GridFieldFilterHeader(),
				new GridFieldSortableHeader(),
				new GridFieldDataColumns(),
				new GridFieldEditButton(),
				new GridFieldDetailForm(),
				new JumbotronSlideshow_TogglePublish()
			);
			
			// Check if GridField Paginator module is installed and set it up

			if(class_exists('GridFieldPaginatorWithShowAll')){
				$paginatorComponent = new GridFieldPaginatorWithShowAll(15);
			}else{
				$paginatorComponent = new GridFieldPaginator(15);
			}
			$gridFieldConfig->addComponent($paginatorComponent);

			// Check if SortableGridField module is installed and set it up
	
			if(class_exists('GridFieldSortableRows')) {
				$sortableComponent = new GridFieldSortableRows('SortOrder');
				$gridFieldConfig->addComponent($sortableComponent);
			}
	
			$gridField = new GridField("JumbotronSlides", "Slides:", $this->JumbotronSlides(), $gridFieldConfig);
			$fields->addFieldToTab("Root.JumbotronSlides", $gridField);
	
			$fields->removeFieldFromTab('Root.Main', 'Content');
	
			// Additional text for Content
	
			$fields->addFieldToTab('Root.Introduction', new TextField("IntroductionTxt", _t('Content.INTRODUCTIONTEXT','Introduction text')));	
			$fields->addFieldToTab('Root.Introduction', new HtmlEditorField("IntroductionCol1", _t('Content.INTRODUCTIONCOLUMN1','Introduction text column 1')));
			$fields->addFieldToTab('Root.Introduction', new HtmlEditorField("IntroductionCol2", _t('Content.INTRODUCTIONCOLUMN2','Introduction text column 2')));
			$fields->addFieldToTab('Root.Introduction', new HtmlEditorField("IntroductionCol3", _t('Content.INTRODUCTIONCOLUMN3','Introduction text column 3')));

			$fields->addFieldToTab('Root.Jumbotron', $UploadField);
	
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
			$fields->addFieldToTab('Root.Featured3', $UploadField4);
			$fields->addFieldToTab('Root.Featured3', new TreeDropdownField('Link3LocID', 'Link 3 Location', 'SiteTree'));
			$fields->addFieldToTab('Root.Featured3', new TextField("Featured3Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc. or read more)')));
	
			$fields->addFieldToTab('Root.Featured4', new TextField("Featured4Title", _t('Content.FEATUREDTITLE','Featured title')));	
			$fields->addFieldToTab('Root.Featured4', new HtmlEditorField("Featured4", _t('Content.FEATURED','Featured')));	
			$fields->addFieldToTab('Root.Featured4', $UploadField5);
			$fields->addFieldToTab('Root.Featured4', new TreeDropdownField('Link4LocID', 'Link 4 Location', 'SiteTree'));
			$fields->addFieldToTab('Root.Featured4', new TextField("Featured4Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc. or read more)')));
				
			$fields->addFieldToTab('Root.SocialMedia', new TextField("SocialMediaInfo", _t('Content.SOCIALMEDIAINFO','What would you say to your visitors to get likes?')));	

		

	return $fields;
   }
  
}
 
class JumbotronSlideshow_Controller extends Page_Controller {

	public static $allowed_actions = array (
	);
	
	public function init() {
	  parent::init();
	}
	
}
?>