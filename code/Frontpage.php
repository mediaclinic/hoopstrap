<?php

 
class Frontpage extends Page {
	static $db = array(	
		"HeroTitle" => "Text",
		"Subtitle" => "Text",
		"HeroContent" => "HTMLText",
		"HeroButtonTxt" => "Text",
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
		'HeroBackgroundImage' => 'BetterImage',
		'HeroLinkLoc' => 'SiteTree',
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
	

	
	function getCMSFields() {
    	$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField("HeroTitle", _t('Content.HEROTITLE','Hero element title')));
		$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));
		$fields->addFieldToTab('Root.Main', new HtmlEditorField("HeroContent", _t('Content.HEROCONTENT','Hero content')));
		$fields->addFieldToTab('Root.Main', new UploadField("HeroBackgroundImage", _t('Content.HEROBACKGROUNDIMAGE','Hero element background image'), Null, Null, Null, 'Uploads/frontpageimages'));
		$fields->addFieldToTab('Root.Main', new TextField("HeroButtonTxt", _t('Content.HEROBUTTONTXT','Hero button text')));
		$fields->addFieldToTab('Root.Main', new TreeDropdownField('HeroLinkLocID', 'Hero Link Location', 'SiteTree'));

		$fields->removeFieldFromTab('Root.Main', 'Content');

		$fields->addFieldToTab('Root.Introduction', new TextField("IntroductionTitle", _t('Content.INTRODUCTIONTITLE','Heading for introduction')));	
		$fields->addFieldToTab('Root.Introduction', new HtmlEditorField("IntroductionCol1", _t('Content.INTRODUCTIONCOLUMN1','Introduction text column 1')));
		$fields->addFieldToTab('Root.Introduction', new HtmlEditorField("IntroductionCol2", _t('Content.INTRODUCTIONCOLUMN2','Introduction text column 2')));

		$fields->addFieldToTab('Root.Featured1', new TextField("Featured1Title", _t('Content.FEATUREDTITLE','Featured title')));	
		$fields->addFieldToTab('Root.Featured1', new HtmlEditorField("Featured1", _t('Content.FEATURED','Featured')));
		$fields->addFieldToTab('Root.Featured1', new UploadField("Featured1Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'), Null, Null, Null, 'Uploads/frontpageimages'));
		$fields->addFieldToTab('Root.Featured1', new TreeDropdownField('Link1LocID', 'Link 1 Location', 'SiteTree')); 
		$fields->addFieldToTab('Root.Featured1', new TextField("Featured1Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc.)')));

		$fields->addFieldToTab('Root.Featured2', new TextField("Featured2Title", _t('Content.FEATUREDTITLE','Featured title')));	
		$fields->addFieldToTab('Root.Featured2', new HtmlEditorField("Featured2", _t('Content.FEATURED','Featured')));
		$fields->addFieldToTab('Root.Featured2', new UploadField("Featured2Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'), Null, Null, Null, 'Uploads/frontpageimages'));
		$fields->addFieldToTab('Root.Featured2', new TreeDropdownField('Link2LocID', 'Link 2 Location', 'SiteTree'));
		$fields->addFieldToTab('Root.Featured2', new TextField("Featured2Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc.)')));

		$fields->addFieldToTab('Root.Featured3', new TextField("Featured3Title", _t('Content.FEATUREDTITLE','Featured title')));
		$fields->addFieldToTab('Root.Featured3', new HtmlEditorField("Featured3", _t('Content.FEATURED','Featured')));
		$fields->addFieldToTab('Root.Featured3', new UploadField("Featured3Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'), Null, Null, Null, 'Uploads/frontpageimages'));
		$fields->addFieldToTab('Root.Featured3', new TreeDropdownField('Link3LocID', 'Link 3 Location', 'SiteTree'));
		$fields->addFieldToTab('Root.Featured3', new TextField("Featured3Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc.)')));

		$fields->addFieldToTab('Root.Featured4', new TextField("Featured4Title", _t('Content.FEATUREDTITLE','Featured title')));	
		$fields->addFieldToTab('Root.Featured4', new HtmlEditorField("Featured4", _t('Content.FEATURED','Featured')));	
		$fields->addFieldToTab('Root.Featured4', new UploadField("Featured4Image", _t('Content.FEATUREDHEROIMAGE','Featured Image'), Null, Null, Null, 'Uploads/frontpageimages'));
		$fields->addFieldToTab('Root.Featured4', new TreeDropdownField('Link4LocID', 'Link 4 Location', 'SiteTree'));
		$fields->addFieldToTab('Root.Featured4', new TextField("Featured4Info", _t('Content.FEATUREDINFO','Additional info (price, new, hot, special offer, etc.)')));	

		$fields->addFieldToTab('Root.SocialMedia', new TextField("SocialMediaInfo", _t('Content.SOCIALMEDIAINFO','What would you say to your visitors to get likes?')));	

		

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
 
class Frontpage_Controller extends Page_Controller {

// For LayoutHolder	
	public static $LayoutTemplate = 'Frontpage';
	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder
	
}
?>