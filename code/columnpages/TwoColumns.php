<?php

class TwoColumns extends Page {

    static $singular_name = 'Two Columns';
    static $plural_name = 'Two Columns';
    static $description = 'A page with two columns under mainimage and introduction texts.';

	static $db = array(	
		"Subtitle" => "Text",
		"IntroTxtBefore" => "Text",
        'Date' => 'Date',
        'Author' => 'Text',
		"IntroTxtAfter" => "Text",		
		"Column1" => "HTMLText",
		"Column2" => "HTMLText"
	); 
	
	   static $has_one = array(
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
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtBefore", _t('Content.INTROTXTBEFORE','Introduction text before main image')));
		$fields->addFieldToTab('Root.Main', $UploadField);
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtAfter", _t('Content.INTROTXTAFTER','Introduction text after main image')));
        $fields->addFieldToTab('Root.Main', new TextField("Author", _t('Content.AUTHOR','Author')));
	    $fields->addFieldToTab('Root.Main', $dateField = new DateField("Date", _t('Content.DATE','Date')));
	    $dateField->setConfig('showcalendar', true);
    	$dateField->setConfig('dateformat', 'dd.MM.YYYY');
		$fields->removeFieldFromTab('Root.Main', 'Content');

		$fields->addFieldToTab('Root.Column1', new HtmlEditorField("Column1", _t('Content.COLUMN1','Column 1')));

		$fields->addFieldToTab('Root.Column2', new HtmlEditorField("Column2", _t('Content.COLUMN2','Column 2')));

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
	 
	class TwoColumns_Controller extends Page_Controller {


// For LauputHolder	
	public static $LayoutTemplate = 'TwoColumns';
	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder end

	
}
?>