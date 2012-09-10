<?php

	class Page extends SiteTree {
	
		public static $db = array(
		);
	
		public static $has_one = array(
			'Image' => 'BetterImage'
		);
	
		// CHANGE LINKINGMODE FROM .CURRENT TO .ACTIVE INSTEAD (FOR BOOTSTRAP COMBATIBILITY)
	
		public function LinkingMode() {
			if($this->isCurrent()) {
				return 'active';
			} elseif($this->isSection()) {
				return 'active section';
			} else {
				return 'link';
			}
		}
	
	}
	
	define('CMS_JAVASCRIPT_PATH', 'PROJECT_DIR' . '/javascript');
	
	class Page_Controller extends ContentController {
	
		/**
		 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
		 * permissions or conditions required to allow the user to access it.
		 *
		 * <code>
		 * array (
		 *     'action', // anyone can access this action
		 *     'action' => true, // same as above
		 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
		 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
		 * );
		 * </code>
		 *
		 * @var array
		 */
		public static $allowed_actions = array (
		);
	
		public function init() {
			parent::init();
	
			// Note: you should use SS template require tags inside your templates 
			// instead of putting Requirements calls here.  However these are 
			// included so that our older themes still work
		
			$theme = SSViewer::current_theme();
	
	
			// COMPILED LESS TO CSS LOADED IN HERE
			// Requirements::themedCSS('bootstrap', 'screen');
	
			// SPECIAL STYLING FOR PRINT
			// Requirements::themedCSS('print', 'print');
	
			//Requirements::themedCSS('layout'); 
			//Requirements::themedCSS('typography'); 
			//Requirements::themedCSS('form'); 
			Requirements::themedCSS('editor'); 
		
			// HANDLE JAVASCRIPTS		
			//Requirements::block(THIRDPARTY_DIR . '/prototype/prototype.js');
			//Requirements::block(THIRDPARTY_DIR . '/behaviour/behaviour.js');
			//Requirements::block(SAPPHIRE_DIR . '/javascript/prototype_improvements.js');
			//Requirements::block(SAPPHIRE_DIR . '/javascript/ConfirmedPasswordField.js');
			//Requirements::block(SAPPHIRE_DIR . '/javascript/ImageFormAction.js');
			//Requirements::block(THIRDPARTY_DIR . '/jquery/jquery.js');
			//Requirements::block(THIRDPARTY_DIR . '/jquery/jquery-packed.js');
			
			// LATEST JQUERY FROM GOOGLE
			Requirements::javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-transition.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-alert.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-modal.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-dropdown.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-scrollspy.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-tab.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-tooltip.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-popover.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-button.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-collapse.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-carousel.js');
			Requirements::javascript(THEMES_DIR . '/' . $theme . '/js/bootstrap-typeahead.js');
			
		}
	
		// CREATE FUNCTIONS FOR LOGO AND FOOTER
	
		public function getLogo(){
			return DataObject::get_one("Logo");
		}
	
		public function getFooter(){
			return DataObject::get_one("Footer");
		}
	
		// CREATE HOLDER PAGE CHECKER (FOR SUBMENU USE)
		
		public function InsideLayoutHolder() {
	
				switch($this->ClassName) { 
				case 'LayoutHolder':
				return 'true'; 
				break;
				default: 
				return 'false'; 
				}
		}		
	
		// CREATE SLIDERHOLDER CHECKER
		
		public function SliderHolder() {
	
				switch($this->ClassName) { 
				case 'SliderHolder':
				case 'CarouselHolder':
				return 'true'; 
				break;
				default: 
				return 'false'; 
				}
		}

		// CREATE JUMBOTRON CHECKER
		
		public function JumbotronActive() {
	
				switch($this->ClassName) { 
				case 'Jumbotron':
				case 'JumbotronSlideshow':
				case 'JumbotronSlideshowSlide':
				return 'true'; 
				break;
				default: 
				return 'false'; 
				}
		}

	}