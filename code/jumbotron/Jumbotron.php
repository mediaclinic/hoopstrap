<?php

	class Jumbotron extends Page {
	
	static $singular_name = 'Jumbotron';
    static $plural_name = 'Jumbotrons';
    static $description = 'A huge background and content element between the header and the content';
	
	static $db = array(	
		"JumbotronTitle" => "Text",
		"JumbotronSubheading" => "Text",
		"JumbotronContent" => "HTMLText",
		"JumbotronButtonTxt" => "Text"
	); 
	
	public static $has_one = array(
		'JumbotronBackground' => 'BetterImage'
	);
	
	function getCMSFields() {
	
		$UploadField = new UploadField("JumbotronBackground", _t('Content.JUMBOTRONBACKGROUND','Jumbotron background image'));
		$UploadField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$UploadField->setFolderName('Uploads/jumbotron');
	
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Jumbotron', new TextField("JumbotronTitle", _t('Content.JUMBOTRONTITLE','Jumbotron title')));
		$fields->addFieldToTab('Root.Jumbotron', new TextField("JumbotronSubheading", _t('Content.JUMBOTRONSUBHEADING','Jumbotron subheading under the title')));
		$fields->addFieldToTab('Root.Jumbotron', new HtmlEditorField("JumbotronContent", _t('Content.JUMBOTRONCONTENT','Jumbotron content')));
		$fields->addFieldToTab('Root.Jumbotron', $UploadField);
		$fields->addFieldToTab('Root.Jumbotron', new TextField("JumbotronButtonTxt", _t('Content.JUMBOTRONBUTTONTXT','Jumbotron button text')));
		$fields->removeFieldFromTab('Root.Main', 'Content');
		
	return $fields;
	}
}	
	
	class Jumbotron_Controller extends Page_Controller {
	
	}
	
?>