<?php

 
	class SixColumns extends Page {
	
	static $singular_name = 'SixColumns';
	static $plural_name = 'SixColumns';
	static $description = 'Page with six same sized columns.';
	
		static $db = array(	
			"Subtitle" => "Text",
			"IntroTxtBefore" => "Text",
			"IntroTxtAfter" => "Text",
			'Date' => 'Date',
			'Author' => 'Text',
			"Column1" => "HTMLText",
			"Column2" => "HTMLText",
			"Column3" => "HTMLText",
			"Column4" => "HTMLText",
			"Column5" => "HTMLText",
			"Column6" => "HTMLText"
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

			$fields->addFieldToTab('Root.Column3', new HtmlEditorField("Column3", _t('Content.COLUMN3','Column 3')));

			$fields->addFieldToTab('Root.Column4', new HtmlEditorField("Column4", _t('Content.COLUMN4','Column 4')));	

			$fields->addFieldToTab('Root.Column5', new HtmlEditorField("Column5", _t('Content.COLUMN5','Column 5')));	

			$fields->addFieldToTab('Root.Column6', new HtmlEditorField("Column6", _t('Content.COLUMN6','Column 6')));	
	
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
	 
	class SixColumns_Controller extends Page_Controller {
	
	// For LayoutHolder	
		public static $LayoutTemplate = 'SixColumns';
		function renderForHolderPage() {
		   $template = $this->stat('LayoutTemplate');
		   if ($template) return $this->renderWith(array($template));
		   else return '';
		}
	// holder
		
	}
?>