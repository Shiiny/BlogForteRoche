<?php

namespace blog\html;


class BootstrapForm extends Form {

	/**
	 * [surround description] Entoure un élément du formulaire
	 * @param  [string] $html
	 * @return [string]
	 */
	protected function surround($html) {
		return '<div class="form-group">'.$html.'</div>';
	}

	/**
	 * [input description] Crée un élément du formulaire type input ou textarea
	 * @param  [string] $name => attibut nom de la balise
	 * @param  [string] $label => label de la balise
	 * @param  array  $options
	 * @return [string]
	 */
	public function input($name, $label, $options = [], $url = false) {
		$type = isset($options['type']) ? $options['type'] : 'text';
		$value = isset($options['value']) ? $options['value'] : '';
		$label = '<label>'. $label .'</label>';
		if($type === 'textarea') {
			$input = '<textarea name="'.$name.'" class="form-control">'.$this->getValue($name).'</textarea>';
		}
		elseif($type === 'checkbox') {
			$input = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'">';
			return $this->surround($input.$label);
		}
		elseif($type === 'password') {
			if($url) {
				$lien = '<a href="'.$url.'">(Mot de passe oublié)</a>';	
				$label = '<label>'. $label . ' ' . $lien .'</label>';
			}
			$input = '<input type="'.$type.'" name="'.$name.'" class="form-control" value="'.$this->getValue($name).'">';
		}
		else {
			$input = '<input type="'.$type.'" name="'.$name.'" class="form-control" value="'.$this->getValue($name).'">';
		}
		return $this->surround($label.$input);
	}

	/**
	 * [select description] Crée un élément select d'un formulaire
	 * @param  [string] $name => attibut nom de la balise
	 * @param  [string] $label => label de la balise
	 * @param  array  $options
	 * @return [string]
	 */
	public function select($name, $label = '', $options) {
		$label = '<label>'. $label .'</label>';
		$input = '<select class="form-control" name="'. $name .'">';
		foreach ($options as $key => $value) {
			$attributes = '';
			if($key == $this->getValue($name)) {
				$attributes = 'selected';
			}
			$input .= "<option value='$key'$attributes>$value</option>";
		}
		$input .= '</select>';
		return $this->surround($label.$input);
	}

	/**
	 * [submit description] Crée un bouton de soumission
	 * @return [string]
	 */
	public function submit() {
		return '<button type="submit" class="btn btn-primary">Envoyer</button>';
	}
}