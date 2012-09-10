<?php

class HeroAndColumns extends Page {

    static $singular_name = 'Hero and Columns';
    static $plural_name = 'Heros and Columns';
    static $description = 'A page with huge Hero element and columns.';

	static $db = array(	
		"HeroTitle" => "Text",
		"Subtitle" => "Text",
		"HeroContent" => "HTMLText",
		"HeroButtonTxt" => "Text",
		"Column1Title" => "Text",
		"Column2Title" => "Text",
		"Column3Title" => "Text",
		"Column4Title" => "Text",
		"Column1" => "HTMLText",
		"Column2" => "HTMLText",
		"Column3" => "HTMLText",
		"Column4" => "HTMLText"
	); 
	
	public static $has_one = array(
		'HeroBackgroundImage' => 'BetterImage',
		'JumbotronBackground' => 'BetterImage',
		'HeroLinkLoc' => 'SiteTree',
		'Link1Loc' => 'SiteTree',
		'Link2Loc' => 'SiteTree',
		'Link3Loc' => 'SiteTree',
		'Link4Loc' => 'SiteTree',
		'Column1Image' => 'BetterImage',
		'Column2Image' => 'BetterImage',
		'Column3Image' => 'BetterImage',
		'Column4Image' => 'BetterImage'
	);
	

	
	function getCMSFields() {

		// Settings for UploadFields : Hero Image

		$UploadField = new UploadField("HeroBackgroundImage", _t('Content.HEROBACKGROUNDIMAGE','Hero element background image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads/heroimages');
		
		// Settings for UploadFields : #1 Column Hero Image

		$UploadField2 = new UploadField("Column1Image", _t('Content.COLUMNHEROIMAGE','Mainimage for column'));
		$UploadField2->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField2->setFolderName('Uploads/featuredimages');

		// Settings for UploadFields : #2 Column Hero Image

		$UploadField3 = new UploadField("Column2Image", _t('Content.COLUMNHEROIMAGE','Mainimage for column'));
		$UploadField3->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField3->setFolderName('Uploads/featuredimages');

		// Settings for UploadFields : #3 Column Hero Image

		$UploadField4 = new UploadField("Column3Image", _t('Content.COLUMNHEROIMAGE','Mainimage for column'));
		$UploadField4->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField4->setFolderName('Uploads/featuredimages');

		// Settings for UploadFields : #4 Column Hero Image

		$UploadField5 = new UploadField("Column4Image", _t('Content.COLUMNHEROIMAGE','Mainimage for column'));
		$UploadField5->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField5->setFolderName('Uploads/featuredimages');
		
		// Settings for jumbotron background
		
		$UploadField6 = new UploadField("JumbotronBackgroundImage", _t('Content.JUMBOTRONBACKGROUNDIMAGE','Jumbotron element background image'));
		$UploadField6->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField6->setFolderName('Uploads/jumbotron');

		// Create Tabs

    	$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField("HeroTitle", _t('Content.HEROTITLE','Hero element title')));
		$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));
		$fields->addFieldToTab('Root.Main', new HtmlEditorField("HeroContent", _t('Content.HEROCONTENT','Hero content')));
		$fields->addFieldToTab('Root.Main', $UploadField);
		$fields->addFieldToTab('Root.Main', new TextField("HeroButtonTxt", _t('Content.HEROBUTTONTXT','Hero button text')));
		$fields->addFieldToTab('Root.Main', new TreeDropdownField('HeroLinkLocID', 'Hero Link Location', 'SiteTree'));
		$fields->removeFieldFromTab('Root.Main', 'Content');

		$fields->addFieldToTab('Root.Column1', new TextField("Column1Title", _t('Content.COLUMNTITLE','Column title')));	
		$fields->addFieldToTab('Root.Column1', new HtmlEditorField("Column1", _t('Content.COLUMN1','Column 1')));
		$fields->addFieldToTab('Root.Column1', $UploadField2);
		$fields->addFieldToTab('Root.Column1', new TreeDropdownField('Link1LocID', 'Link 1 Location', 'SiteTree')); 

		$fields->addFieldToTab('Root.Column2', new TextField("Column2Title", _t('Content.COLUMNTITLE','Column title')));	
		$fields->addFieldToTab('Root.Column2', new HtmlEditorField("Column2", _t('Content.COLUMN2','Column 2')));
		$fields->addFieldToTab('Root.Column2', $UploadField3);
		$fields->addFieldToTab('Root.Column2', new TreeDropdownField('Link2LocID', 'Link 2 Location', 'SiteTree'));

		$fields->addFieldToTab('Root.Column3', new TextField("Column3Title", _t('Content.COLUMNTITLE','Column title')));
		$fields->addFieldToTab('Root.Column3', new HtmlEditorField("Column3", _t('Content.COLUMN3','Column 3')));
		$fields->addFieldToTab('Root.Column3', $UploadField4);
		$fields->addFieldToTab('Root.Column3', new TreeDropdownField('Link3LocID', 'Link 3 Location', 'SiteTree')); 

		$fields->addFieldToTab('Root.Column4', new TextField("Column4Title", _t('Content.COLUMNTITLE','Column title')));	
		$fields->addFieldToTab('Root.Column4', new HtmlEditorField("Column4", _t('Content.COLUMN4','Column 4')));	
		$fields->addFieldToTab('Root.Column4', $UploadField5);
		$fields->addFieldToTab('Root.Column4', new TreeDropdownField('Link4LocID', 'Link 4 Location', 'SiteTree'));
		
		$fields->addFieldToTab('Root.Jumbotron', $UploadField6); 

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
 
class HeroAndColumns_Controller extends Page_Controller {

// For LayoutHolder	
	public static $LayoutTemplate = 'HeroAndColumns';
	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder
	
}
?>