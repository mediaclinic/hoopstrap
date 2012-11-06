<?php

class ContactPage extends Page {

    static $singular_name = 'Contact Page';
    static $plural_name = 'Contacts Pages';
    static $description = 'Contact Page is used for simple content, form and Google Maps integration.';
    static $icon = '';

	static $db = array(	
		"Subtitle" => "Text",
		"IntroTxtBefore" => "Text",
		"IntroTxtAfter" => "Text",
		"GoogleAPIKey" => "Text",
		"GoogleMapsAddress" => "Text",
		"Column1" => "HTMLText",
		"Column2" => "HTMLText",
		"FormColumn" => "HTMLText",
		"Mailto" => "Varchar(100)",
		"SuccessMsg" => "HTMLText"
	); 
	
	   static $has_one = array(
        'MainImage' => 'BetterImage'
    );
	

	
	function getCMSFields() {
			
    	$fields = parent::getCMSFields();
				
		$fields->addFieldToTab('Root.Main', new TextField("Subtitle", _t('Content.SUBTITLE','Subtitle under the title')));
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtBefore", _t('Content.INTROTXTBEFORE','Introduction text before main image')));
		$fields->addFieldToTab("Root.Main", new UploadField("MainImage", _t('Content.MAINIMAGE','Main image')));
		$fields->addFieldToTab('Root.Main', new TextField("IntroTxtAfter", _t('Content.INTROTXTAFTER','Introduction text after main image')));

		$fields->removeFieldFromTab('Root.Main', 'Content');
		$fields->addFieldToTab('Root.Column1', new HtmlEditorField("Column1", _t('Content.COLUMN1','Column 1')));
		$fields->addFieldToTab('Root.Column2', new HtmlEditorField("Column2", _t('Content.COLUMN2','Column 2')));
		$fields->addFieldToTab('Root.GoogleMaps', new TextField("GoogleAPIKey", _t('Content.GOOGLEAPIKEY','Google API-key')));
		$fields->addFieldToTab('Root.GoogleMaps', new TextField("GoogleMapsAddress", _t('Content.GOOGLEMAPSADDRESS','Address (Street 12, City, Country)')));

		$fields->addFieldToTab('Root.Form', new HtmlEditorField("FormColumn", _t('Content.FORMCOLUMN','Text before Form')));
		$fields->addFieldToTab('Root.Form', new EmailField("Mailto", _t('Content.MAILTO','Receivers E-mail')));
		$fields->addFieldToTab('Root.Form', new HtmlEditorField("SuccessMsg", _t('Content.SUCCESSMSG','Success message to be displayed after form is sent')));

	return $fields;
   }

// For LayoutHolder
	function RenderAsChild() {
	   $class = $this->ClassName . "_Controller";
	   $controller = new $class($this);
	   return $controller->renderForHolderPage();
	} 

// holder end

}
	 
class ContactPage_Controller extends Page_Controller {


// For LauputHolder	
	public static $LayoutTemplate = 'ContactPage';

	function renderForHolderPage() {
	   $template = $this->stat('LayoutTemplate');
	   if ($template) return $this->renderWith(array($template));
	   else return '';
	}
// holder end

    static $allowed_actions = array(
        'ContactForm'
    );
 
 	public function ContactForm() {

		return BootstrapForm::create(

			$this,
			"ContactForm",

			FieldList::create(
				TextField::create('Name', _t('Content.NAME','Name')),
				EmailField::create('Email',_t('Content.EMAIL', 'Email address'))
					->setAttribute('type','email'),
				TextareaField::create('Message', _t('Content.MESSAGE','Message'))
					->setAttribute('maxlength', 500)
			),
	
			FieldList::create(
				FormAction::create('SendContactForm', _t('Content.SENDEMAIL', 'Send'))
					-> setStyle('success')
			),
			
			new RequiredFields(
			'Email', 'Message'
			)
		)

			->addWell()
			->setLayout("vertical");	
	}
	

	function SendContactForm($data, $form) {
   
        //Set data
        $From = $data['Email'];
        $To = $this->Mailto;
        $Subject = "Viesti www-sivuilta";
		$Header .= "Content-type: text/html; charset=utf-8r\n";
		$Header .= "Content-Transfer-Encodin: 8bitr\n";
 
        $email = new Email($From, $To, $Subject, $Header);

        //Set template to be used in email
        $email->setTemplate('ContactEmail');

        //Populate template
        $email->populateTemplate($data);

        //Send mail
        $email->send();

        //Return and show success message
        $this->redirect($this->Link("?success=1"));
    }
	
	public function Success()
    {
        return isset($_REQUEST['success']) && $_REQUEST['success'] == "1";
    }

}
?>