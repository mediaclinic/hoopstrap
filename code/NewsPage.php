<?php

/**
 * Defines the NewsPage page type
 */

	class NewsPage extends Page {
		static $db = array(
			"Subtitle" => "Text",
			'Date' => 'Date',
			'Author' => 'Text'
		);
		static $has_one = array(
			'MainImage' => 'BetterImage'
		);
		
		function getCMSFields() {
			
			$fields = parent::getCMSFields();
			$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));					
			$fields->addFieldToTab("Root.Main", new UploadField("Image", _t('Content.MAINIMAGE','Main Image')));
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