<?php

	/**
	 * Defines the NewsHolder page type
	 */

	class NewsHolder extends Page {
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