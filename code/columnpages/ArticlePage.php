<?php
 
class ArticlePage extends Page {

    static $singular_name = 'Article page';
    static $plural_name = 'Article pages';
    static $description = 'A page for article content.';

	static $db = array(	
		"Subtitle" => "Text",
		"Introtext" => "Text",
        'Date' => 'Date',
        'Author' => 'Text'
	); 
	
	public static $has_one = array(
	  'MainImage' => 'BetterImage'
	);
	
	
	function getCMSFields() {

		// Settings for UploadFields : Main Image

		$UploadField = new UploadField("MainImage", _t('Content.MAINIMAGE','Main image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads/articleimages');

		// Create Tabs

    	$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));
		$fields->addFieldToTab('Root.Main', new TextField("Introtext", _t('Content.INTROTEXT','Introduction text')));
        $fields->addFieldToTab('Root.Main', new TextField("Author", _t('Content.AUTHOR','Author')));
		$fields->addFieldToTab('Root.Main', $UploadField);
		$fields->addFieldToTab('Root.Main', $dateField = new DateField("Date", _t('Content.DATE','Date')));
	    $dateField->setConfig('showcalendar', true);
    	$dateField->setConfig('dateformat', 'dd.MM.YYYY');
	return $fields;
   }
   
// For LayoutHolder
	function RenderAsChild() {
	   $class = $this->ClassName . "_Controller";
	   $controller = new $class($this);
	   return $controller->renderForHolderPage();
	} 
// holder end
  
}
 
class ArticlePage_Controller extends Page_Controller {
	
// For LayoutHolder	
	public static $LayoutTemplate = 'ArticlePage';
	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder end
	
}
?>