<?php

 
class OneWideOne extends Page {

	static $singular_name = 'OneWideOne';
	static $plural_name = 'OneWideOnes';
	static $description = 'Page with one wide column on the left and one narrow on the right.';
	
	static $db = array(	
		"Subtitle" => "Text",
		"IntroTxtBefore" => "Text",
		"IntroTxtAfter" => "Text",		
        'Date' => 'Date',
        'Author' => 'Text',
		"WideColumn" => "HTMLText",
		"SideColumn" => "HTMLText"
	); 
	
	public static $has_one = array(
	  'MainImage' => 'BetterImage'
	);
	
	function getCMSFields() {

		// Settings for UploadFields : Main Image

		$UploadField = new UploadField("MainImage", _t('Content.MAINIMAGE','Main image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads');

		// Create Tabs

    	$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtBefore", _t('Content.INTROTXT1','Introduction text before main image')));
		$fields->addFieldToTab('Root.Main', $UploadField);	
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtAfter", _t('Content.INTROTXT2','Introduction text after main image')));	
        $fields->addFieldToTab('Root.Main', new TextField("Author", _t('Content.AUTHOR','Author')));
	    $fields->addFieldToTab('Root.Main', $dateField = new DateField("Date", _t('Content.DATE','Date')));
	    $dateField->setConfig('showcalendar', true);
    	$dateField->setConfig('dateformat', 'dd.MM.YYYY');
		$fields->removeFieldFromTab('Root.Main', 'Content');

		$fields->addFieldToTab('Root.WideColumn', new HtmlEditorField("WideColumn", _t('Content.WIDECOLUMN','Wide Column')));

		$fields->addFieldToTab('Root.SideColumn', new HtmlEditorField("SideColumn", _t('Content.SIDECOLUMN','Side Column')));

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
 
class OneWideOne_Controller extends Page_Controller {
	
// For LayoutHolder	
	public static $LayoutTemplate = 'OneWideOne';
	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder end
	
}
?>