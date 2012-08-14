<?php
 
class StaffHolder extends Page {

	static $singular_name = 'StaffHolder';
	static $plural_name = 'StaffHolders';
	static $description = 'Page type that wraps different staff members together on the same page.';

    static $db = array(
		"Subtitle" => "Text",
		"IntroTxtBefore" => "Text",
		"IntroTxtAfter" => "Text"
    );
	
    static $has_one = array(
		'MainImage' => 'BetterImage'
    );
	  

	function getCMSFields() {
			
    	$fields = parent::getCMSFields();
				
		$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtBefore", _t('Content.INTROTXTBEFORE','Introduction text before main image')));
		$fields->addFieldToTab('Root.Main', new UploadField("MainImage", _t('Content.MAINIMAGE','Main image')));	
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtAfter", _t('Content.INTROTXTAFTER','Introduction text after main image')));	
	

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
  
 
class StaffHolder_Controller extends Page_Controller {

// For LayoutHolder	
	public static $LayoutTemplate = 'StaffHolder';
	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder



	function orderDepartment($num=5) {
		$department = DataObject::get_one('StaffHolder');
		return ($department) ? DataObject::get('StaffPage', $filter, 'Department ASC', $join, $limit) : false ;		
	}
	
}
?>