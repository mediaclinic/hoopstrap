<?php
/**
 * Defines the LayoutHolder page type
 */
class LayoutHolder extends Page {

	static $singular_name = 'LayoutHolder';
	static $plural_name = 'LayoutHolders';
	static $description = 'Holder page that ties different kind of column pages together.';

    static $db = array(
    );
    static $has_one = array(
    );
    
   static $allowed_children = array('HeroAndColumns','FullPage','TwoColumns','ThreeColumns','FourColumns','SixColumns','OneWideTwoColumns','OneSidestory','LeftCenterRight','StaffHolder','SliderHolder','CarouselHolder','Jumbotron');
	

}
	
  
class LayoutHolder_Controller extends Page_Controller {
 
	 
}
  
?>