<?php
	class FrontpageSlideshow_TogglePublish implements GridField_ActionProvider, GridField_ColumnProvider {
		function getActions($gridField) {
			return array('togglepublish');
		}
		
		public function handleAction(GridField $gridField, $actionName, $arguments, $data) {
			if($actionName == 'togglepublish') {
				$record = $gridField->getList()->byID($arguments['RecordID']);
				$record->Published = $arguments['Value'];
				$record->write();
			}
		}
		
		public function augmentColumns($gridField, &$columns) {
			$array = array_slice($columns, 0, count($columns) - 1);
			$array[] = 'Published';
			foreach(array_slice($columns, count($columns) - 1) as $item) {
				$array[] = $item;
			}
			$columns = $array;
		}
		
		public function getColumnsHandled($gridField) {
			return array('Published');
		}
		
		public function getColumnContent($gridField, $record, $columnName) {
			$cf = new CheckboxField('Published'.$record->ID, null, $record->Published);
			$field = new GridField_FormAction($gridField, 'TogglePublish'.$record->ID, false, 'togglepublish', array('RecordID' => $record->ID, 'Value' => !$record->Published));
			$field->addExtraClass('gridfield-button-togglepublish');
			$field->setAttribute('title', $record->Published ? 'Published' : 'Not published');
			$field->setAttribute('data-icon', $record->Published ? 'accept' : 'minus-circle_disabled');
			$field->setDescription($record->Published ? 'Published' : 'Not published');
			return $field->Field();
		}
		
		public function getColumnAttributes($gridField, $record, $columnName) {
			return array('class' => 'col-buttons');
		}
		
		public function getColumnMetadata($gridField, $columnName) {
			if($columnName == 'Published') {
				return array('title' => 'Published');
			}
		}
	}
?>