<?php

class Mediagrid extends Page {

	static $singular_name = 'Mediagrid';
	static $plural_name = 'Mediagrids';
	static $description = 'Mediagrid for presenting images etc.';

	static $db = array(
		"Layout" => "Enum('masonry, fitRows, cellsByRow, masonryHorizontal, fitColumns', 'masonry')",
	); 
		
	public static $has_many = array(
		"MediagridItems" => "MediagridItem"
	);
	
	function getCMSFields() {

  // Create Grid Field
		$fields = parent::getCMSFields();


		// Mediagrid Gridfield

		$gridFieldConfig = GridFieldConfig_RelationEditor::create()->addComponents(
			new FrontpageSlideshow_TogglePublish()
		);
		
		// Check if GridField Paginator module is installed and set it up

		if(class_exists('GridFieldPaginatorWithShowAll')){
			$paginatorComponent = new GridFieldPaginatorWithShowAll(15);
		}else{
			$paginatorComponent = new GridFieldPaginator(15);
		}
		$gridFieldConfig->addComponent($paginatorComponent);

		// Check if SortableGridField module is installed and set it up

		if(class_exists('GridFieldSortableRows')) {
			$sortableComponent = new GridFieldSortableRows('SortOrder');
			$gridFieldConfig->addComponent($sortableComponent);
		}

        $gridField = new GridField("MediagridItems", "Items:", $this->MediagridItems(), $gridFieldConfig);
		$fields->addFieldToTab("Root.MediagridItems", $gridField);
		
		// Additional text for Content

		$fields->addFieldToTab('Root.Config', new TextField("Layout", _t('Content.LAYOUT','Layout style')));	

		return $fields;
	}

}
 
class Mediagrid_Controller extends Page_Controller {

	public static $allowed_actions = array (
	);
	
	public function init() {
	  parent::init();
	}
	
}

?>