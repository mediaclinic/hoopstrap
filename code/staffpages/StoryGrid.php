<?php
 
class StoryGrid extends Page {

	static $singular_name = 'StoryGrid';
	static $plural_name = 'StoryGrids';
	static $description = 'Page type presenting a story including for example a picture, title, description etc.';

	 static $db = array(
				'Company' => 'Text',
				'JobTitle' => 'Text',
				'Biography' => 'HTMLText',
				'GSM' => 'Text',
				'Email' => 'Text',
				'LinkedIn' => 'Text',
				'Twitter' => 'Text'
	);
		
	static $has_one = array(
				'Photo' => 'BetterImage'
    );

	// SiteTree behaviour
	static $can_be_root = true;
	static $default_parent = "StoryGridHolder";
	
	function getCMSFields() {

		// Settings for UploadFields : Main Image
		
		$f = new FieldList();
			
			$image_field = new UploadField('Photo', _t('Content.Photo','Photo'));
			$image_field->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
			$image_field->setFolderName('Uploads/Stories');

		// Create Tabs
	
		$t = new TabSet(
			'Root',
			new Tab(
				'Biography',
				new TextField('Title'),
				new HTMLEditorField('Content')
			),
			new Tab(
				'Jobtitle, Company and Photo',
				new TextField("Company", _t('Content.COMPANY','Company')),
				new TextField('JobTitle', _t('Content.JOBTITLE','Job Title')),
				$image_field
			),
			new Tab(
				'Contact info',
				new TextField('GSM', _t('Content.GSM','GSM')),
				new TextField('Email', _t('Content.EMAIL','Email')),
				new TextField('LinkedIn', _t('Content.LINKEDIN','LinkedIn')),
				new TextField('Twitter', _t('Content.TWITTER','Twitter'))
			)
			
		);
		
		$f->push($t);
		
		return $f;
	}
 
// For LayoutHolder
	function RenderAsChild() {
	   $class = $this->ClassName . "_Controller";
	   $controller = new $class($this);
	   return $controller->renderForHolderPage();
	} 
// holder end
  
}
 
class StoryGrid_Controller extends Page_Controller {
	
// For LayoutHolder	
	public static $LayoutTemplate = 'StoryGrid';
		function renderForHolderPage() {
		$template = $this->stat('LayoutTemplate');
		if ($template) return $this->renderWith(array($template));
		else return '';
	}
// holder end
	
}
?>