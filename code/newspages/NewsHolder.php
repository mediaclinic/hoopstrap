<?php

	/**
	 * Defines the NewsHolder page type
	 */

	class NewsHolder extends Page {
	
		static $singular_name = 'NewsHolder';
		static $plural_name = 'NewsHolders';
		static $description = 'Page type that presents different news summaries.';
	
		static $db = array(
		);
		static $has_one = array(
		);
		
		static $allowed_children = array('NewsPage','PressReleasePage');
	}
	  
	class NewsHolder_Controller extends Page_Controller {
		
		function rss() {
			$rss = new RSSFeed($this->Children(), $this->Link(), "RSS");
			$rss->outputToBrowser();
		}
		function init() {
			RSSFeed::linkToFeed($this->Link() . "rss");
			parent::init();
		}
	}
?>