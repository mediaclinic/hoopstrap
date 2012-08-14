<?php

/**
 * Defines the NewsPage page type
 */

	class NewsPage extends Page {
	
		static $singular_name = 'NewsPage';
		static $plural_name = 'NewsPages';
		static $description = 'Page type including one news item.';
	
		static $db = array(
			"Subtitle" => "Text",
			'Date' => 'Date',
			'Author' => 'Text'
		);
		static $has_one = array(
			'MainImage' => 'BetterImage'
		);
		
		function getCMSFields() {

			// Settings for UploadFields : Main Image
	
			$UploadField = new UploadField("Image", _t('Content.MAINIMAGE','Main Image'));
			$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
			$UploadField->setFolderName('Uploads/NewsImages');
	
			// Create Tabs
			
			$fields = parent::getCMSFields();
			$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));					
			$fields->addFieldToTab('Root.Main', $UploadField);
			$fields->addFieldToTab('Root.Main', new TextField("Author", _t('Content.AUTHOR','Author')));
			$fields->addFieldToTab('Root.Main', $dateField = new DateField("Date", _t('Content.DATE','Date')));
			$dateField->setConfig('showcalendar', true);
			$dateField->setConfig('dateformat', 'dd.MM.YYYY');
			
		return $fields;
		}
	}
 
	class NewsPage_Controller extends Page_Controller {

	}
  
?>