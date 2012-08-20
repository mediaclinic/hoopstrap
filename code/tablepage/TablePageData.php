<?php

 
class TablePageData extends DataObject {

	static $db = array(	
		"Column1" => "Varchar(255)",
		"Column2" => "Varchar(255)",
		"SortOrder" => "Int",
	); 
	
	public static $has_one = array(
		"TablePage" => "TablePage"
	);

	public static $summary_fields = array(
		'Column1','Column2'
	);

	// to change the default sorting to the new SortOrder 
	public static $default_sort = 'SortOrder Asc';
	
	function getCMSFields() {
		
		$f = new FieldList();
			
		// Create Tabs
	
		$t = new TabSet(
			'Root',
			new Tab(
				'Main',
				new TextField("Column1", _t('Content.TABLECOLUMN','Table data column')),
				new TextField("Column2", _t('Content.TABLECOLUMN','Table data column'))
			)
			
		);
		
		$f->push($t);
		
		return $f;
	}
}
?>