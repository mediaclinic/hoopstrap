<?php

 
class LeftCenterRight extends Page {
	static $db = array(	
		"IntroTxtBefore" => "Text",
		"IntroTxtAfter" => "Text",		
        'Date' => 'Date',
        'Author' => 'Text',
		"LeftColumn" => "HTMLText",
		"WideColumn" => "HTMLText",
		"RightColumn" => "HTMLText"
	); 
	
	public static $has_one = array(
		'MainImage' => 'BetterImage'
	);
	

	
	function getCMSFields() {
    	$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtBefore", _t('Content.INTROTXTBEFORE','Introduction text before main image')));
		$fields->addFieldToTab('Root.Main', new UploadField("MainImage", _t('Content.MAINIMAGE','Main image')));	
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtAfter", _t('Content.INTROTXTAFTER','Introduction text after main image')));	
        $fields->addFieldToTab('Root.Main', new TextField("Author", _t('Content.AUTHOR','Author')));
	    $fields->addFieldToTab('Root.Main', $dateField = new DateField("Date", _t('Content.DATE','Date')));
	    $dateField->setConfig('showcalendar', true);
    	$dateField->setConfig('dateformat', 'dd.MM.YYYY');
		$fields->removeFieldFromTab('Root.Main', 'Content');
		$fields->addFieldToTab('Root.LeftColumn', new HtmlEditorField("LeftColumn", _t('Content.WIDECOLUMN','Left Column')));
		$fields->addFieldToTab('Root.WideColumn', new HtmlEditorField("WideColumn", _t('Content.COLUMN2','Wide Column')));
		$fields->addFieldToTab('Root.RightColumn', new HtmlEditorField("RightColumn", _t('Content.COLUMN3','Right Column')));	

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
 
class LeftCenterRight_Controller extends Page_Controller {
	
// For LayoutHolder	
	public static $LayoutTemplate = 'LeftCenterRight';
	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder end
	
}
?>