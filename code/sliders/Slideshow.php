<<<<<<< HEAD
<?php

 
class Slideshow extends Page {

	static $singular_name = 'Slideshow';
	static $plural_name = 'Slideshows';
	static $description = 'Page presenting a slideshow.';

	static $db = array(	
		'SortOrder' => 'Int'
	); 
		
	public static $has_many = array(
		"SlideshowSlides" => "SlideshowSlide"
	);
	
	function getCMSFields() {

  // Create Grid Field
		$fields = parent::getCMSFields();

        $gridFieldConfig = GridFieldConfig_RelationEditor::create();
        $gridFieldConfig->addComponents(
                new GridFieldSortableRows("SortID")
        );

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
=======
<?php

 
class Slideshow extends Page {

	static $db = array(
	); 
		
	public static $has_many = array(
		"SlideshowSlides" => "SlideshowSlide"
	);
	
	function getCMSFields() {

  // Create Grid Field
		$fields = parent::getCMSFields();

        $gridFieldConfig = GridFieldConfig_RelationEditor::create();
        $gridFieldConfig->addComponents(
                new GridFieldSortableRows("SortOrder"),
				new Slideshow_TogglePublish()
        );

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
>>>>>>> TableData and FrontpageSlideshow updates
?>