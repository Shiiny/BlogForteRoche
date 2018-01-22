<?php 
namespace blog\html;

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
	 * @param  [string] $html
	 * @return [string]
	 */
	protected function surround($html) {
		return "<{$this->surround}>$html</{$this->surround}>";
	}

	/**
	 * [getValue description] Renvoi les valeur d'un champ
	 * @param  [string] $index
	 * @return [array] data || null
	 */
	protected function getValue($index) {
		if(is_object($this->data)) {
			return $this->data->$index;
		}
		return isset($this->data[$index]) ? $this->data[$index] : null;
	}

	/**
	 * [input description] Retourne un input
	 * @param  [string] $name
	 * @param  [string] $label
	 * @param  array  $options
	 * @return [string]
	 */
	public function input($name, $label, $options = []) {
		$type = isset($options['type']) ? $options['type'] : 'text';
		return $this->surround(
			'<input type="'.$type.'" name="'.$name.'" value="'.$this->getValue($name).'">'
		);

	}

	/**
	 * [submit description] Retourne un bouton de soumission de formulaire
	 * @return [string]
	 */
	public function submit() {
		return $this->surround('<button type="submit">Envoyer</button>');
	}
}


?>