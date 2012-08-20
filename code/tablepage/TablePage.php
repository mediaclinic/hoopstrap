<?php

 
class TablePage extends Page {

    static $singular_name = 'Tabledata Page';
    static $plural_name = 'Tabledata Pages';
    static $description = 'Show data in table.';
    static $icon = '';

	static $db = array(	
		'TableHeading' => 'Text',
		'TableFooter' => 'Text',
		'Column1Heading' => 'Text',
		'Column2Heading' => 'Text'
	); 
		
	public static $has_many = array(
		"TablePageDatas" => "TablePageData"
	);
	
	public function getCMSFields() {

  // Create Grid Field
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Table', new TextField("TableHeading", _t('Content.TABLEHEADING','Table Heading')));	
		$fields->addFieldToTab('Root.Table', new TextField("TableFooter", _t('Content.TABLEFOOTER','Table Footer')));
		$fields->addFieldToTab('Root.Table', new TextField("Column1Heading", _t('Content.TABLECOLUMNHEADING','Table Column Heading')));
		$fields->addFieldToTab('Root.Table', new TextField("Column2Heading", _t('Content.TABLECOLUMNHEADING','Table Column Heading')));			

        $gridFieldConfig = GridFieldConfig_RelationEditor::create();
        $gridFieldConfig->addComponents(
                new GridFieldSortableRows("SortOrder")
        );

        $gridField = new GridField("TablePageDatas", "Data:", $this->TablePageDatas(), $gridFieldConfig);
		$fields->addFieldToTab("Root.TablePageDatas", $gridField);
		
		return $fields;
	}

}
 
class TablePage_Controller extends Page_Controller {

	public static $allowed_actions = array ('index', 'TableGrid');
	
	public function init() {
	  parent::init();
	}

//	public function TableGrid() {
//	
//		$grid = $this->getGridWithActions(new DataList('TablePageData'));
//		
//		return new Form($this, 'TableGrid', new FieldList($grid), new FieldList());
//	}
//	
//	protected function getDefaultGrid(SS_List $list) {
//		return new GridField('TablePageDatas', 'TablePageDatas', $list);
//	}
//	
//	protected function getFilterableGrid(SS_List $list) {
//		$config = GridFieldConfig::create();
//		$config->addComponent(new GridFieldSortableHeader());
//		$config->addComponent(new GridFieldDefaultColumns());
//		$config->addComponent(new GridFieldPaginator(20));
//		$config->addComponent(new GridFieldFilter());
//		return new GridField('TablePageData', 'TablePageData', $list, $config);
//	}
}
?>