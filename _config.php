<?php

global $project;
$project = 'hoopstrap';

define('PROJECT_DIR', $project);

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'silverstripe',
	"password" => 'silverstripe',
	"database" => 'silverstripe3_github',
	"path" => '',
);

MySQLDatabase::set_connection_charset('utf8');

require_once('conf/ConfigureFromEnv.php');

// Set the current theme. More themes can be downloaded from
// http://www.silverstripe.org/themes/
SSViewer::set_theme('hoopstraptheme');

// Set default JPG-compression
GD::set_default_quality(85);

// Set the site locale
i18n::set_locale('fi_FI');

// Enable, if you are going to use TRANSLATABLE
// Translatable::set_default_locale("fi_FI");
// Translatable::set_allowed_locales(array( 'fi_FI','en_US', 'ru_RU' ));
// Object::add_extension('SiteTree', 'Translatable');
// Object::add_extension('SiteConfig', 'Translatable'); // 2.4 or newer only

//Enable Search Form
FulltextSearchable::enable();

// Enable nested URLs for this site (e.g. page/sub-page/)
if (class_exists('SiteTree')) SiteTree::enable_nested_urls();

//Force enviroment to Dev ** REMOVE FOR LIVE SITES **
Director::set_environment_type("dev");

if (Director::isDev()) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	// SSViewer::set_source_file_comments(true);
	SSViewer::flush_template_cache();
} else {
	SS_Log::add_writer(new SS_LogFileWriter('../silverstripe.log'), SS_Log::ERR);
	SS_Log::add_writer(new SS_LogEmailWriter('myEmail@mysite.com'), SS_Log::ERR);
	ini_set('display_errors', 0);
	error_reporting(0);
}

// Set up the BootstrapForms form Uncle Cheese to prevent pollution
BootstrapForm::set_bootstrap_included(true);
BootstrapForm::set_jquery_included(true);

// Add an extension to an Object and DataObject
Object::add_extension('SiteConfig','CustomSiteConfig');

//Set HTML Editor Config
HtmlEditorConfig::get('cms')->setOptions(array(
	'apply_source_formatting'=>'false',
	'convert_fonts_to_spans', 'false',
	'content_css' => 'static/css/editor.css',
	'language' => i18n::get_tinymce_lang(),
	'document_base_url' => Director::absoluteBaseURL(),
)); 

HtmlEditorConfig::get('cms')->enablePlugins('searchreplace');
//
HtmlEditorConfig::get('cms')->insertButtonsAfter('pasteword', 'replace');
//
HtmlEditorConfig::get('cms')->enablePlugins('safari');

//Set the admin email address
Email::setAdminEmail('admin@domain.com');

//Set to CC all emails to
Email::cc_all_emails_to('me@mydomain.com');
