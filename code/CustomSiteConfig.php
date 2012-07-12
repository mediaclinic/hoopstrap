<?php

	class CustomSiteConfig extends DataExtension {
			static $db = array(
				'CopyrightName' => 'Varchar',
			);
	  
	public function updateCMSFields(FieldList $fields) {
         
        $fields->addFieldToTab("Root.Main", new TextField('CopyrightName', _t('Content.COPYRIGHTNAME','Person, company or organization, who owns the copyright')));

    }
}