<?php

class Slideshow extends Page {

	static $singular_name = 'Slideshow';
	static $plural_name = 'Slideshows';
	static $description = 'Page presenting a slideshow.';

	static $db = array(
	); 
		
	public static $has_many = array(
		"SlideshowSlides" => "SlideshowSlide"
	);
	
	function getCMSFields() {

  // Create Grid Field
		$fields = parent::getCMSFields();


		// Slideshow Gridfield
	
		$gridFieldConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldFilterHeader(),
			new GridFieldSortableHeader(),
			new GridFieldDataColumns(),
			new GridFieldEditButton(),
			new GridFieldDetailForm(),
			new Slideshow_TogglePublish()
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

        $gridField = new GridField("SlideshowSlides", "Slides:", $this->SlideshowSlides(), $gridFieldConfig);
		$fields->addFieldToTab("Root.SlideshowSlides", $gridField);
		
		return $fields;
	}

}
 
class Slideshow_Controller extends Page_Controller {

	public static $allowed_actions = array (
	);
	
	public function init() {
	  parent::init();
	}
	
}

?>