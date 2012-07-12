<?php
 
class StaffPage extends Page {

	 static $db = array(
				'Firstname' => 'Text',
				'Lastname' => 'Text',
				'JobTitle' => 'Text',
				'Department' => 'Text',
				'Phone' => 'Text',
				'GSM' => 'Text',
				'Email' => 'Text',
				'LinkedIn' => 'Text',
				'Twitter' => 'Text'
	);
		
	static $has_one = array(
				'Photo' => 'BetterImage'
    );
			
	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('Firstname', _t('Content.FIRSTNAME','First name')));
		$fields->addFieldToTab('Root.Main', new TextField('Lastname', _t('Content.LASTNAME','Last name')));	
		$fields->addFieldToTab('Root.Main', new TextField('JobTitle', _t('Content.JOBTITLE','Job Title')));
		$fields->addFieldToTab('Root.Main', new TextField('Department', _t('Content.DEPARTMENT','Department')));
		$fields->addFieldToTab('Root.Main', new TextField('Phone' ,_t('Content.PHONE','Phone')));
		$fields->addFieldToTab('Root.Main', new TextField('GSM', _t('Content.GSM','GSM')));
		$fields->addFieldToTab('Root.Main', new TextField('Email', _t('Content.EMAIL','Email')));
		$fields->addFieldToTab("Root.Main", new UploadField('Photo', _t('Content.PHOTO','Photo')));
		$fields->addFieldToTab("Root.Main", new TextField('LinkedIn', _t('Content.LINKEDIN','LinkedIn')));
		$fields->addFieldToTab("Root.Main", new TextField('Twitter', _t('Content.TWITTER','Twitter')));
     
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
 
class StaffPage_Controller extends Page_Controller {
	
// For LayoutHolder	
	public static $LayoutTemplate = 'StaffPage';
		function renderForHolderPage() {
		$template = $this->stat('LayoutTemplate');
		if ($template) return $this->renderWith(array($template));
		else return '';
	}
// holder end
	
}
?>