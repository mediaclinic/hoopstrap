<?php

	class Footer extends Page {
		
		static $db = array(	
			"Column1" => "HTMLText",
			"Column2" => "HTMLText",
			"Column3" => "HTMLText",
			"Column4" => "HTMLText"
		); 
		
		static $allowed_children = 'none';
		
		function getCMSFields() {
			$fields = parent::getCMSFields();
			$fields->removeFieldFromTab('Root.Main', 'Content');
			$fields->addFieldToTab('Root.Column1', new HtmlEditorField("Column1", _t('Content.COLUMN1','Column 1')));
			$fields->addFieldToTab('Root.Column2', new HtmlEditorField("Column2", _t('Content.COLUMN2','Column 2')));
			$fields->addFieldToTab('Root.Column3', new HtmlEditorField("Column3", _t('Content.COLUMN3','Column 3')));
			$fields->addFieldToTab('Root.Column4', new HtmlEditorField("Column4", _t('Content.COLUMN4','Column 4')));	
	
		return $fields;
	   }
		
	}
	
	class Footer_Controller extends Page_Controller 
	{
	
	
	}

?>