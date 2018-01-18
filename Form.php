<?php 
namespace blog;

class Form{

	private $data;
	public $surround = 'p';

	
	/**
	 * [__construct description] Prend les données passées en paramètre
	 * @param array $data 
	 */
	public function __construct($data = array()) {
		$this->data = $data;
	}

	/**
	 * [surround description] Entoure un élément avec un tag contenu 
	 * @param  [type] $html [description]
	 * @return [type]       [description]
	 */
	protected function surround($html) {
		return "<{$this->surround}>$html</{$this->surround}>";
	}

	protected function getValue($index) {
		if(is_object($this->data)) {
			return $this->data->$index;
		}
		return isset($this->data[$index]) ? $this->data[$index] : null;
	}

	public function input($name, $label, $options = []) {
		$type = isset($options['type']) ? $options['type'] : 'text';
		return $this->surround(
			'<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'">'
		);

	}

	public function submit() {
		return $this->surround('<button type="submit">Envoyer</button>');
	}
}


?>