<?php
 
	class Logo extends Page {
		static $db = array(	
		); 
		
		public static $has_one = array(
			'Logo' => 'BetterImage',
			'Logov2' => 'BetterImage'
		);
		
		
		function getCMSFields() {
			$fields = parent::getCMSFields();
			$fields->removeFieldFromTab('Root.Main', 'Content');

			$fields->addFieldToTab('Root.Main', new UploadField("Logo", _t('Content.LOGOINCOLORS','Logo in colours'), Null, Null, Null, 'Uploads/logo'));
			$fields->addFieldToTab('Root.Main', new UploadField("Logov2", _t('Content.LOGOINMONO','Logo in mono'), Null, Null, Null, 'Uploads/logo'));

		return $fields;
	   }
	
	}
?>