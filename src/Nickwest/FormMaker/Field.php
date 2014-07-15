<?php namespace Nickwest\FormMaker;


class Field{
	
	/**
	 * Name of hte field
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Human readable formatted name
	 *
	 * @var string
	 */
	protected $label = '';
	
	/**
	 * An example to show by the field
	 *
	 * @var string
	 */
	protected $example = '';

	/**
	 * Field's current value
	 *
	 * @var string
	 */
	protected $value = '';

	/**
	 * A default value (prepopulated if field is blank)
	 *
	 * @var string
	 */
	protected $default_value = '';

	/**
	 * Error message to show on the field
	 *
	 * @var string
	 */
	protected $error_message = '';

	/**
	 * is this field required?
	 *
	 * @var bool
	 */
	protected $is_required = '';

	/**
	 * The maximum length of the field
	 *
	 * @var integer
	 */
	protected $max_length = '';

	/**
	 * Field type [text,select,textarea,radio,checkbox,file] or a custom type
	 *
	 * @var string
	 */
	protected $type = '';

	/**
	 * Options to populate select, radio, checkbox, and other multi-option fields
	 *
	 * @var string
	 */
	private $options;

	/**
	 * If there are multiples of this field in the form (appends [] to the field name)
	 *
	 * @var string
	 */
	protected $is_multi = false;

	/**
	 * Classes to put on this field
	 *
	 * @var string
	 */
	protected $classes;

	/**
	 * The field's id
	 *
	 * @var string
	 */
	protected $id = '';
	
	/**
	 * The template that this field should use
	 *
	 * @var string
	 */
	protected $template = '';
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct($field_name){
		$this->name = $field_name;
		$this->label = $this->makeLabel();
		$this->type = 'text';
		$this->id = 'input-'.$field_name;
		
		$this->options = array();
	}
	
	/**
	 * Field property accessor
	 *
	 * @param string $property
	 * @return mixed
	 */
	public function __get($property){
		//\Helpers::Pre($this->{$property});
		return $this->{$property};
	}
	
	/**
	 * Field property mutator
	 *
	 * @param string $property, mixed $value
	 * @return void
	 */
	public function __set($property, $value){
		
		$this->setProperty($property, $value);
		
	}

	/**
	 * Allows the setting of Field properties from client code (__set magic method is an alias to this)
	 *
	 * @param string $property, mixed $value
	 * @return void
	 */	
	public function setProperty($property, $value){
		$this->{$property} = $value;
	}

	/**
	 * Make a label for the given field, uses $this->label if available, otherwises generates based on field name
	 *
	 * @return string 
	 */		
	protected function makeLabel(){
		// If no label use the name
		if (trim($this->label) == '')
		        $this->label = ucfirst(str_replace('_',' ',$this->name));
		
		// Remove any ":" from the label
		if (substr($this->label,-1) == ':')
		        $this->label = substr($this->label,0,-1);
		        
		// If this is a question or period leave it
		if (substr(strip_tags($this->label),-1) == '?' || substr(strip_tags($this->label),-1) == '.')
		        return $this->label;
		
		return $this->label;
	}
}
