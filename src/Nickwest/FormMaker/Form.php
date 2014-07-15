<?php namespace Nickwest\FormMaker;

use View;

class Form{

	/**
	 * Array of Field Objects
	 *
	 * @var array
	 */
	protected $Fields = array();

	/**
	 * Array of field_names to display
	 *
	 * @var array
	 */
	protected $display_fields;

	/**
	 * Array of valid columns for hte model using this trait
	 *
	 * @var array
	 */
	protected $valid_columns = array();
	
	
	/**
	 * Add Delete button?
	 *
	 * @var bool
	 */
	public $allow_delete = false;
	
	/**
	 * Post URL
	 *
	 * @var string
	 */
	public $url = '';
		
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
	
	}
	
	/**
	 * Field  accessor
	 *
	 * @param string $field_name
	 * @return Field
	 */
	public function __get($field_name){
		if(isset($this->Fields[$field_name])){
			return $this->Fields[$field_name];
		}
		
		return null;
	}
	
	/**
	 * Get the whole Fields array
	 *
	 * @return array
	 */
	public function getFields(){
		return $this->Fields;
	}
	
	
	public function makeView($blade_data, $extends='', $section=''){
		$blade_data['Form'] = $this;
		$blade_data['extends'] = $extends;
		$blade_data['section'] = $section;
		
		return View::make('form-maker::form', $blade_data);
	}
		
	/**
	 * add a bunch of fields to the form
	 *
	 * @param array $field_names
	 * @return void
	 */
	public function addFields($field_names){
		foreach($field_names as $field_name){
			$this->Fields[$field_name] = new Field($field_name);
		}
	}
	
	/**
	 * Add a single field to the form
	 *
	 * @param array $field_name
	 * @return void
	 */
	public function addField($field_name){
		$this->Fields[$field_name] = new Field($field_name);
	}

	/**
	 * Remove a bunch of fields to the form
	 *
	 * @param array $field_names
	 * @return void
	 */
	public function removeFields($field_names){
		foreach($field_names as $field_name){
			if(isset($this->Fields[$field_name])){
				unset($this->Fields[$field_name]);
			}
		}
	}

	/**
	 * Remove a single field from the form
	 *
	 * @param array $field_name
	 * @return void
	 */
	public function removeField($field_name){
		if(isset($this->Fields[$field_name])){
			unset($this->Fields[$field_name]);
		}
	}
	
	public function setDisplayFields($fields){
		if(is_array($fields)){
			$this->display_fields = $fields;
		}		
	}
	
	
	public function getDisplayFields(){
		if(is_array($this->display_fields) && sizeof($this->display_fields) > 0){
			$Fields = array();
			foreach($this->display_fields as $field_name){
				$Fields[$field_name] = $this->{$field_name};
			}
			
			return $Fields;
		}
		
		return $this->Fields;
	}
	
	
	
	/**
	 * Is $field_name a field
	 *
	 * @param string $field_name
	 * @return bool
	 */
	public function isField($field_name){
		return isset($this->Fields[$field_name]) && is_object($this->Fields[$field_name]);
	}
	
	/**
	 * Set multiple field labels at once [field_name] => value
	 *
	 * @param array $labels
	 * @return void
	 */
	public function setLabels($labels){
		if(!is_array($labels)) return;
		
		foreach($labels as $field_name => $label){
			if(isset($this->Fields[$field_name])){
				$this->Fields[$field_name]->label = $label;
			}
		}
	}
	
	public function getLabels($field_names=array()){
		if(!is_array($field_names)){
			$field_names = $this->getFields();
		}
		
		$labels = array();
		foreach($field_names as $field_name){
			if(isset($this->Fields[$field_name])){
				$labels[$field_name] = $this->Fields[$field_name]->label;
			}
		}
		
		return $labels;
	}

	/**
	 * Set multiple field values at once [field_name] => value
	 *
	 * @param array $values
	 * @return void
	 */
	public function setValues($values){
		if(!is_array($values)) return;
		
		foreach($values as $field_name => $value){
			if(isset($this->Fields[$field_name])){
				$this->Fields[$field_name]->value = $value;
			}
		}
	}

	/**
	 * Set multiple field types at once [field_name] => value
	 *
	 * @param array $types
	 * @return void
	 */
	public function setTypes($types){
		if(!is_array($types)) return;
		
		foreach($types as $field_name => $type){
			if(isset($this->Fields[$field_name])){
				$this->Fields[$field_name]->type = $type;
			}
		}
	}

	/**
	 * Set multiple field examples at once [field_name] => value
	 *
	 * @param array $examples
	 * @return void
	 */
	public function setExamples($examples){
		if(!is_array($examples)) return;
		
		foreach($examples as $field_name => $example){
			if(isset($this->Fields[$field_name])){
				$this->Fields[$field_name]->example = $example;
			}
		}
	}

	/**
	 * Set multiple field default values at once [field_name] => value
	 *
	 * @param array $default_values
	 * @return void
	 */
	public function setDefaultValues($default_values){
		if(!is_array($default_values)) return;
		
		foreach($default_values as $field_name => $default_value){
			if(isset($this->Fields[$field_name])){
				$this->Fields[$field_name]->default_value = $default_value;
			}
		}
	}

	/**
	 * Set multiple field required fields at oncel takes array of field names
	 *
	 * @param array $required_fields
	 * @return void
	 */
	public function setRequiredFields($required_fields){
		if(!is_array($required_fields)) return;
		
		foreach($required_fields as $field_name){
			if(isset($this->Fields[$field_name])){
				$this->Fields[$field_name]->is_required = true;
			}
		}
	}
	
}
